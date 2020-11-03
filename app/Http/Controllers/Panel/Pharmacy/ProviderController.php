<?php

namespace App\Http\Controllers\Panel\Pharmacy;
use App\Core\Controllers\BaseController;
use App\Core\DynamicTableResources\DrugTableResource;
use App\Core\DynamicTableResources\ProviderTableResource;
use App\Core\Interfaces\ControllerContract;
use App\Entities\Provider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ProviderController extends BaseController implements ControllerContract
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $resource;

    public function __construct(ProviderTableResource $resource)
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

        return view('panel.pharmacy.providers.create');
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
            Provider::create($request->all());
            DB::commit();
            $request->session()->flash('flash_message', 'El proveedor se ha creado exitosamente!');
            return redirect()->route('providers.index');
        }catch (\Exception $e){
            DB::rollBack();
            $request->session()->flash('flash_error', 'El proveedor no se pudo crear!');
            return redirect()->route('providers.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Provider $provider
     * @return \Illuminate\Http\Response
     */
    public function edit(Provider $provider)
    {
        return view('panel.pharmacy.providers.edit', compact('provider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Provider $provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provider $provider)
    {
        DB::beginTransaction();
        try{
            $provider->update($request->all());
            DB::commit();
            $request->session()->flash('flash_message', 'El proveedor se ha actualizado exitosamente!');
            return redirect()->route('providers.index');
        }catch (\Exception $e){
            dd($request->all());
            DB::rollBack();
            $request->session()->flash('flash_error', 'El proveedor no se pudo actualizar!');
            return redirect()->route('providers.index');
        }
    }
}
