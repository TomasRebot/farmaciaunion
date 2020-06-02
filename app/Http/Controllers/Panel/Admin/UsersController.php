<?php

namespace App\Http\Controllers\Panel\Admin;
use App\Core\Controllers\BaseController;
use App\Core\DynamicTableResources\UserTableResource;
use App\Core\Interfaces\ControllerContract;

use App\Entities\Role;
use App\Entities\User;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class UsersController extends BaseController implements ControllerContract
{

    protected $resource;

    public function __construct(UserTableResource $resource)
    {
        $this->resource = $resource;
    }


    public function edit(User $user)
    {
        $roles = Role::forCurrentUser();
        return view('panel.admin.users.edit', compact('user','roles'));
    }

    public function create()
    {
        $roles = Role::forCurrentUser();
        return view('panel.admin.users.create', compact('roles'));
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            $user = new User();
            $user->fill($request->all());
            $user->roles()->sync($request->roles);
            $new_password = $request->password;

            if(isset($new_password) && $new_password !== ''){
                $user->password = bcrypt($request->password);
            }
            $user->save();
            DB::commit();
            $request->session()->flash('flash_message', 'El usuario se ha creado exitosamente!');
            return redirect()->route('users.index');
        }catch (\Exception $e){
            DB::rollBack();
            dd($e->getMessage());
            $request->session()->flash('flash_error', 'El usuario no se pudo crear!');
            return redirect()->route('users.index')->withErrors();
        }

    }
    public function update(Request $request, User $user)
    {
        DB::beginTransaction();
        try{
            $stmt = $request->password == '' ? $request->except('password') : $request->all();

            $user->fill($stmt);
            $user->roles()->sync($request->roles);
            $new_password = $request->password;
            if(isset($new_password) && $new_password !== ''){
                $user->password = bcrypt($request->password);
            }

            $user->save();
            $user->roles()->sync($request->roles);

            DB::commit();
            $request->session()->flash('flash_message', 'El usuario se ha actualizado exitosamente!');
            return redirect()->route('users.index');

        }catch (\Exception $e){
            DB::rollBack();
            $request->session()->flash('flash_error', $e->getMessage());
            return redirect()->route('users.index');
        }

    }


}
