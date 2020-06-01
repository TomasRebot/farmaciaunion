<?php
namespace App\Api\MerlinInterface;
ini_set('upload_max_filesize', '60M');
ini_set('max_execution_time', '999');
ini_set('memory_limit', '128M');
ini_set('post_max_size', '60M');
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class XmlProcessor implements MerlinContract
{

    public function inform($data)
    {
        // TODO: Implement inform() method.
    }

    public function updateDB(Request $request)
    {
        try{
            $path = Carbon::now()->timestamp.'.xml';
            Storage::disk('merlin_interface')->put($path ,$request->getContent());

            $file = storage_path('merlin_interface').'/'.$path;
            $json_data = simplexml_load_file($file);
            return response()->json($json_data);

            //process xml and return if ok in xml
            return response()->json([
                'status' => 200,
                'message' => 'OK',
                'time' => Carbon::now()->timestamp,
            ]);
        }catch (\Exception $e){
            return response()->json([
                'status' => $e->getCode(),
                'message' => $e->getMessage(),
                'time' => Carbon::now()->timestamp
            ]);
        }

    }
}
