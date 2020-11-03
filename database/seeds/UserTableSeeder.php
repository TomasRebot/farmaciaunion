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
            'email' => 'super@farmaciaunion.com',
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


        $roleVisitador = Role::where('name', 'Visitador medico')->first()->id;
        for($i=1; $i < 10; $i ++){
            $idVisitador = DB::table('users')->insertGetId([
                'name' => 'visitador_'.$i,
                'email' => 'visitador_'.$i.'@farmaciaunion.com',
                'password' => bcrypt('123456'),
            ]);
            DB::table('user_roles')->insert([
                'user_id' => $idVisitador,
                'role_id' => $roleVisitador,
            ]);
        }

        $roleEncargadoMedico = Role::where('name', 'Encargado medicamentos')->first()->id;
        for($i=1; $i < 10; $i ++){
            $idEncargado = DB::table('users')->insertGetId([
                'name' => 'encargado_'.$i,
                'email' => 'encargado_'.$i.'@farmaciaunion.com',
                'password' => bcrypt('123456'),
            ]);
            DB::table('user_roles')->insert([
                'user_id' => $idEncargado,
                'role_id' => $roleEncargadoMedico,
            ]);
        }
    }
}
