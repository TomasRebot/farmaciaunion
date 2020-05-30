<?php

use App\Entities\Form;
use App\Entities\Permission;
use App\Entities\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionFormTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $idRoleSuperAdmin = Role::where('name','Super usuario')->first()->id;
        $permissions = Permission::all()->pluck('id')->toArray();
        $forms = Form::all()->pluck('id')->toArray();

        foreach($forms as $form){
            for($i = 0 ; $i < count($permissions) ;$i++){
                DB::table('role_permissions_forms')->insert([
                    'role_id' => intval($idRoleSuperAdmin),
                    'permission_id' => intval($permissions[$i]),
                    'form_id' => intval($form),
                ]);
            }
        }
    }
}
