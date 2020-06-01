<?php

use App\Entities\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleSuperAdmin = Role::where('name', 'Super usuario')->first()->id;
        $idsuperadmin = DB::table('users')->insertGetId([
            'name' => 'Super usuario',
            'email' => 'super@super.com',
            'password' => bcrypt('123456'),
        ]);
        DB::table('user_roles')->insert([
            'user_id' => $idsuperadmin,
            'role_id' => $roleSuperAdmin,
        ]);

        $roleAdmin = Role::where('name', 'Administrador')->first()->id;
        $idAdmin = DB::table('users')->insertGetId([
            'name' => 'Administrador',
            'email' => 'admin@farmaciaunion.com',
            'password' => bcrypt('123456'),
        ]);
        DB::table('user_roles')->insert([
            'user_id' => $idAdmin,
            'role_id' => $roleAdmin,
        ]);

        for($i = 2; $i < 20; $i++){
            $idAdmin = DB::table('users')->insertGetId([
                'name' => 'Administrador'.$i,
                'email' => 'admin'.$i.'@farmaciaunion.com',
                'password' => bcrypt('123456'),
            ]);
            DB::table('user_roles')->insert([
                'user_id' => $idAdmin,
                'role_id' => $roleAdmin,
            ]);
        }
    }
}
