<?php

namespace App\Http\Controllers\Panel\Store;
use App\Core\Controllers\BaseController;
use App\Core\DynamicTableResources\DrugTableResource;
use App\Core\DynamicTableResources\ProductTableResource;
use App\Core\Interfaces\ControllerContract;
use App\Entities\Brand;
use App\Entities\Category;
use App\Entities\Drug;
use App\Entities\Laboratory;
use App\Entities\Price;
use App\Entities\Product;
use App\Entities\Subcategory;
use App\Entities\TherapeuticAction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ProductController extends BaseController implements ControllerContract
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $resource;

    public function __construct(ProductTableResource $resource)
    {
        $this->resource = $resource;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('panel.store.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        DB::beginTransaction();
        try{
            $stmt =  $request->except('price');
            $prod = new Product();
            $prod->fill($stmt);
            $prod->price = (float) $request->price;
            $prod->save();
            DB::commit();
            $request->session()->flash('flash_message', 'El producto se ha creado exitosamente!');
            return redirect()->route('products.index');
        }catch (\Exception $e){
            DB::rollBack();
            dd($e->getMessage());
            $request->session()->flash('flash_error', 'El producto no se pudo crear!');
            return redirect()->route('products.index')->withErrors();
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('panel.store.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        DB::beginTransaction();
        try{
            $product->update($request->all());

            DB::commit();
            $request->session()->flash('flash_message', 'El producto se ha actualizado exitosamente!');
            return redirect()->route('products.index');

        }catch (\Exception $e){

            DB::rollBack();
            $request->session()->flash('flash_error', $e->getMessage());
            return redirect()->route('products.index');
        }
    }


}
