<?php


namespace App\Api\MerlinInterface;
ini_set('memory_limit', '2G');
ini_set('max_execution_time', -1);
use App\Entities\Category;
use App\Entities\Drug;
use App\Entities\Laboratory;
use App\Entities\TherapeuticAction;
use App\Jobs\FireInitialLoadJob;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class InitialLoadProcessor implements MerlinContract
{


    public function inform($data)
    {
        // TODO: Implement inform() method.
    }

    public function updateDB(Request $request)
    {

        $this->handle();
        return response()->json(['status' => 200,'message' => 'queue running on secondary thread']);

    }
    public function handle()
    {

        $file = storage_path('merlin_interface').'/initial_load.xml';
        if(!file_exists($file)){
            return response()->json(['status' => 500,'message' => 'initial product loader dont exists']);
        }
        $file = preg_replace("/&(?!#?[a-z0-9]+;)/", "&amp;",Storage::disk('merlin_interface')->get('initial_load.xml'));
        $xml   = simplexml_load_string($file, 'SimpleXMLElement', LIBXML_NOCDATA);
        $array = json_decode(json_encode((array)$xml), true);

        $productos = $array['productos']['producto'];

        $prod_collect = collect($productos)->chunk(1000);

        $drugs = new Collection();
        $therapeutic_actions = new Collection();
        $laboratories = new Collection();
        $products = new Collection();
        $categories = new Collection();
        foreach($prod_collect as $chunkeds)
        {
            foreach($chunkeds as $item)
            {
                try {
                    DB::beginTransaction();

                    $created_laboratory = null;
                    $created_category = null;
                    $created_drug = null;
                    $created_terap = null;

                    if($this->isValidEntity($item['laboratorio'])){
                        $exist = $laboratories->where('merlin_id',$item['laboratorio']['merlin_id']);

                        if(!count($exist)){
                            $created_laboratory = Laboratory::create([
                                'merlin_id' => $item['laboratorio']['merlin_id'],
                                'name' => $this->getCleanFromArray($item['laboratorio']['nombre']),
                                'description' => $this->getCleanFromArray($item['laboratorio']['nombre']),
                            ]);

                            $laboratories->push($created_laboratory);
                        }else{
                            $created_laboratory = $exist->first();
                        }

                    }

                    if($this->isValidEntity($item['rubro'])){
                        $exist = $categories->where('merlin_id', $item['rubro']['merlin_id']);

                        if(!count($exist)) {
                            $created_category = Category::create([
                                'name' => $this->getCleanFromArray($item['rubro']['descripcion']),
                                'description' => $this->getCleanFromArray($item['rubro']['descripcion']),
                                'merlin_id' => $item['rubro']['merlin_id'],
                            ]);
                            $categories->push($created_category);
                        }else{
                            $created_category = $exist->first();
                        }

                    }
                    if($this->isValidEntity($item['droga'])) {
                        $exist = $drugs->where('merlin_id',$item['droga']['merlin_id']);
                        if(!count($exist)) {
                            $created_drug = Drug::create([
                                'merlin_id' => $item['droga']['merlin_id'],
                                'name' => $this->getCleanFromArray($item['droga']['nombre']),
                                'description' => $this->getCleanFromArray($item['droga']['nombre']),
                            ]);
                            $drugs->push($created_drug);
                        }else{
                            $created_drug = $exist->first();
                        }
                    }
                    if($this->isValidEntity($item['accion'])) {
                        $exist = $therapeutic_actions->where('merlin_id',$item['accion']['merlin_id']);
                        if(!count($exist)) {
                            $created_terap = TherapeuticAction::create([
                                'merlin_id' => $item['accion']['merlin_id'],
                                'name' => $this->getCleanFromArray($item['accion']['nombre']),
                                'description' => $this->getCleanFromArray($item['accion']['nombre']),
                            ]);

                            $therapeutic_actions->push($created_terap);
                        }else{
                            $created_terap = $exist->first();
                        }
                    }
                    if($this->isValidEntity($item)) {

                        DB::table('products')->insert([
                            'name' => $this->getCleanFromArray($item['nombre']),
                            'description' => $this->getCleanFromArray($item['nombre']),
                            'bar_code' => $this->getCleanFromArray($item['codigo_barras']),
                            'merlin_id' => $item['merlin_id'],
                            'die_number' => $this->getCleanFromArray($item['numero_troquel']),
                            'presentation' => $this->getCleanFromArray($item['presentacion']),
                            'fragment_unit' => $this->getCleanFromArray($item['unidad_fragmentada']),
                            'stock' => $this->getCleanFromArray(intval($item['stock'])),
                            'price' => $this->getCleanFromArray($this->parsePrice($item['precio'])),
                            'laboratory_id' => ($created_laboratory !== null) ? $created_laboratory->id : null,
                            'category_id' => ($created_category !== null) ? $created_category->id : null,
                            'primary_therapeutic_action_id' => ($created_terap !== null) ? $created_terap->id : null,
                            'drug_id' => ($created_drug !== null) ? $created_drug->id : null,
                        ]);
                    }
                    DB::commit();

                }catch (\Exception $e){
                    dd($e->getMessage());
                    DB::rollBack();

                }
            }
            usleep(500000);
        }

    }
    private function isValidEntity($entity){
        $value = $entity['merlin_id'];
        if(($value === [] || is_array($value) || $value === ''))
            return false;
        return true;
    }




    private function getCleanFromArray($value){
        if($value !== [] && !is_array($value) && $value !== ''){
            return trim($value);
        }else{
            return 'No presente en archivo importador';
        }
    }

    private function parsePrice($string){
        $array = str_split($string);
        if(count($array) < 3){
            return 0.00;
        }
        $position = count($array) - 2;
        $insert = '.';
        if (is_int($position)) {
            array_splice($array, $position, 0, $insert);
        } else {
            $pos   = array_search($position, array_keys($array));
            $array = array_merge(
                array_slice($array, 0, $pos),
                $insert,
                array_slice($array, $pos)
            );
        }
        return floatval(number_format(implode($array), 2));
    }

}
