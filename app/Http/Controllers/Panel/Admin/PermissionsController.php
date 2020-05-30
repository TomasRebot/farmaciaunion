<?php

namespace App\Http\Controllers\Panel\Admin;

use App\Core\DynamicTableResources\PermissionTableResource;
use App\Entities\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    protected $resource;

    public function __construct(PermissionTableResource $resource)
    {
        $this->resource = $resource;
    }
    public function index()
    {
        $apiResource = $this->resource->getResource();
        return view('panel.admin.permissions.index', compact('apiResource'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.admin.permissions.create');
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
            $permission = Permission::create($request->all());
            DB::commit();
            $request->session()->flash('flash_message', 'El Permiso se ha creado exitosamente!');
            return redirect()->route('permissions.index');
        }catch (\Exception $e){
            dd($e->getMessage());
            DB::rollBack();
            $request->session()->flash('flash_error', 'El Permiso no se pudo crear!');
            return redirect()->route('permissions.index');
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
    public function edit(Permission $permission)
    {
        return view('panel.admin.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        DB::beginTransaction();
        try{
            $permission->update($request->all());
            DB::commit();
            $request->session()->flash('flash_message', 'El Permiso se ha actualizado exitosamente!');
            return redirect()->route('permissions.index');

        }catch (\Exception $e){
            DB::rollBack();
            $request->session()->flash('flash_error', 'El Permiso no se pudo actualizar!');
            return redirect()->route('permissions.index');
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
