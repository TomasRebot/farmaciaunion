<?php

namespace App\Http\Controllers\Panel\Admin;

use App\Core\Controllers\BaseController;
use App\Core\DynamicTableResources\RoleTableResource;
use App\Core\interfaces\ControllerContract;
use App\Entities\Form;
use App\Entities\Permission;
use App\Entities\Role;
use App\Entities\RolePermissionsForms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class RolesController extends BaseController implements ControllerContract
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $resource;

    public function __construct(RoleTableResource $resource)
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

        return view('panel.admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            $request['name'] = ucfirst(strtolower($request['name']));
            $rol = Role::create($request->all());
            DB::commit();
            $request->session()->flash('flash_message', 'El rol se ha creado exitosamente!');
            return redirect()->route('roles.index');
        }catch (\Exception $e){
            DB::rollBack();
            $request->session()->flash('flash_error', 'El rol no se pudo crear!');
            return redirect()->route('roles.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Role $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $forms = Form::all();
        $permissions = Permission::all();

        return view('panel.admin.roles.permission-synchronization', compact('role', 'forms','permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('panel.admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {


        DB::beginTransaction();
        try{
            $role->update($request->all());
            DB::commit();
            $request->session()->flash('flash_message', 'El Rol se ha actualizado exitosamente!');
            return redirect()->route('roles.index');

        }catch (\Exception $e){
            DB::rollBack();
            $request->session()->flash('flash_error', 'El Rol no se pudo actualizar!');
            return redirect()->route('roles.index');
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

    public function synchronizePermissions(Request $request)
    {
        DB::beginTransaction();

        try{
            RolePermissionsForms::where('role_id', intval($request->roleId))->delete();
            $permissions = $request->permissions != null ? $request->permissions : [];
            foreach($permissions as $permission)
            {
                $items = explode('-', $permission);
                DB::table('role_permissions_forms')->insert([
                    'form_id' => intval($items[0]),
                    'permission_id' =>intval($items[1]),
                    'role_id' => intval($request->roleId),
                ]);
            }
            DB::commit();

            $request->session()->flash('flash_message', 'El Rol se ha actualizado exitosamente!');
            return redirect()->route('roles.index');



        }catch(Exception $e){
            DB::rollBack();
            dd($e->getMessage());
        }



    }

}
