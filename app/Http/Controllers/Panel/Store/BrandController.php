<?php

namespace App\Http\Controllers\Panel\Store;

use App\Core\Controllers\BaseController;
use App\Core\DynamicTableResources\BrandTableResource;

use App\Core\Interfaces\ControllerContract;
use App\Entities\Brand;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class BrandController extends BaseController implements ControllerContract
{
    protected $resource;


    public function __construct(BrandTableResource $resource)
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

        return view('panel.store.brands.create');
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
            Brand::create($request->all());
            DB::commit();
            $request->session()->flash('flash_message', 'La marca se ha creado exitosamente!');
            return redirect()->route('brands.index');
        }catch (\Exception $e){
            DB::rollBack();
            dd($e->getMessage());
            $request->session()->flash('flash_error', 'La marca no se pudo crear!');
            return redirect()->route('brands.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('panel.store.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        DB::beginTransaction();
        try{
            $brand->update($request->all());
            DB::commit();
            $request->session()->flash('flash_message', 'La marca se ha actualizado exitosamente!');
            return redirect()->route('brands.index');
        }catch (\Exception $e){
            DB::rollBack();
            $request->session()->flash('flash_error', 'La marca no se pudo actualizar!');
            return redirect()->route('brands.index');
        }
    }
}
