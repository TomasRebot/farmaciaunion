<?php
namespace App\Core\Traits;




use App\Entities\RolePermissionsForms;
use App\Entities\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait RulesManager
{

    public function hasRole($role): bool
    {

        $founded = $this->roles->where('name', $role)->first()   ? true : false;
        return is_null($founded) ? false : $founded;
    }

    public function hasAnyRole(array $params, string $key = 'name'): bool
    {
        $roles = $this->roles;

        if(is_array($params) && $roles->count() )
        {
            $retval = false;
            foreach($params as $role)
            {
                if($roles->where($key, '===', $role)->count())
                {
                    $retval = true;
                }
            }
            return $retval;
        }
    }

    public function can($permission)
    {
        //todo implementar cache

        //llega permission key del formulario . accion
        //explode 0 es la key de form, explode 1 es la accion
        try{

            $searched = explode('.',$permission);
            $roles = Auth::user()->roles->pluck('id')->unique();
            $form = $searched[0];
            $action = $searched[1];

            $permission = DB::table('permissions')->where('action', $searched[1])->first('id');
            $form = DB::table('forms')->where('key', $searched[0])->first('id');

            $triada = DB::table('role_permissions_forms')
                ->where('permission_id', $permission->id)
                ->where('form_id', $form->id)
                ->whereIn('role_id', $roles)->count();
            if($triada){
                return true;
            }else{
                return false;
            }
        }catch(Exception $e){
            return abort(500, 'Crash in Rule manager, probably this is caused by incorrect form name added, check your database form names');
        }


    }

    public function roleCan($triada)
    {
        $exploded = explode('-', $triada);

        $r = RolePermissionsForms::where('role_id', intval($exploded[0]))
            ->where('form_id', intval($exploded[1]))
            ->where('permission_id', intval($exploded[2]))->first();
        return !is_null($r);
    }

    public function hasAccessToPanel()
    {
        foreach ($this->roles()->get() as $role)
        {
            if ($role->name === 'Cliente')
            {
                return false;
            }
        }
        return true;
    }




}
