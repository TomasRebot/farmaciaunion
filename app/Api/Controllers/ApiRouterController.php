<?php

namespace App\Api\Controllers;
use App\Entities\Brand;
use App\Entities\Category;
use App\Entities\Drug;
use App\Entities\Laboratory;
use App\Entities\Product;
use App\Entities\Provider;
use App\Entities\TherapeuticAction;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;


class ApiRouterController extends BaseController
{
    public function categories()
    {
        return response()->json(Category::actives()->get());
    }
    public function drugs()
    {
        return response()->json(Drug::actives()->get());
    }
    public function therapeuticActions()
    {
        return response()->json(TherapeuticAction::actives()->get());
    }
    public function productSupportData(Request $request)
    {

        $data = [
            'drugs' => Drug::actives()->get(),
            'therapeutic_actions' => TherapeuticAction::actives()->get(),
            'laboratories' => Laboratory::actives()->get(),
            'categories' => Category::actives()->get(),
            'brands' => Brand::actives()->get(),
            'providers' => Provider::actives()->get(),
            'product' => []
        ];

        if(isset($request->product)){
            $product = Product::find($request->product);
            $data['product'] = [
              'drug' => isset($product->drug) ? $product->drug->id : '',
              'therapeutic_action' =>isset($product->primaryTherapeuticAction) ? $product->primaryTherapeuticAction->id : '',
              'laboratory' => isset($product->laboratory) ? $product->laboratory->id : '',
              'category' =>isset($product->category) ? $product->category->id : '',
            ];
        }
        return response()->json($data);
    }

    public function storeTherapeuticAction(Request $request)
    {
        DB::beginTransaction();
        try{
            $created_therap = TherapeuticAction::create($request->all());
            DB::commit();
            return response()->json(['therapeutic_action' => $created_therap, 'status' => 200]);

        }catch (\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 500,'error' => $e->getMessage()]);
        }
    }


}
