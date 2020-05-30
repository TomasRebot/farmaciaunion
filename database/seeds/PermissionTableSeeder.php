<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('permissions')->insert([
            'name' =>'Visualizar',
            'action' => 'view',
            'description' => 'Permite visualizar registros',
            'icon' => 'fa fa-th-large',
        ]);

        DB::table('permissions')->insert([
            'name' =>'Crear',
            'action' => 'create',
            'description' => 'Permite crear registros',
            'icon' => 'fa fa-th-large',
        ]);
        DB::table('permissions')->insert([
            'name' =>'Eliminar',
            'action' => 'delete',
            'description' => 'Permite eliminar registros',
            'icon' => 'fa fa-th-large',
        ]);
        DB::table('permissions')->insert([
            'name' =>'Actualizar',
            'action' => 'update',
            'description' => 'Permite actualizar registros',
            'icon' => 'fa fa-th-large',
        ]);

    }
}
