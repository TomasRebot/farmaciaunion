<?php

namespace App\Http\Controllers\Panel\Admin;

use App\Core\Controllers\BaseController;
use App\Core\DynamicTableResources\ModuleTableResource;
use App\Core\interfaces\ControllerContract;
use App\Entities\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModuleController extends BaseController implements ControllerContract
{
    protected $resource;

    public function __construct(ModuleTableResource $resource)
    {
        $this->resource = $resource;
    }
    public function index()
    {
        $apiResource = $this->resource->getResource();
        return view('panel.admin.modules.index', compact('apiResource'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $limit = Module::count();
        return view('panel.admin.modules.create', compact('limit'));
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
            $module = Module::create($request->all());
            DB::commit();
            $request->session()->flash('flash_message', 'El módulo se ha creado exitosamente!');
            return redirect()->route('modules.index');
        }catch (\Exception $e){
            dd($e->getMessage());
            DB::rollBack();
            $request->session()->flash('flash_error', 'El módulo no se pudo crear!');
            return redirect()->route('modules.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Module $module)
    {
        $limit = Module::count();
        return view('panel.admin.modules.edit', compact('module', 'limit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Module $module)
    {
        DB::beginTransaction();
        try{
            $module->update($request->all());
            DB::commit();
            $request->session()->flash('flash_message', 'El Módulo se ha actualizado exitosamente!');
            return redirect()->route('modules.index');

        }catch (\Exception $e){
            DB::rollBack();
            $request->session()->flash('flash_error', 'El Módulo no se pudo actualizar!');
            return redirect()->route('modules.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
