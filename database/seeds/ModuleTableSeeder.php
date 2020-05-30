<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = [
            [
                'name' => 'Configuraciones',
                'description' => 'Modulo de administracion',
                'internal_handler' => 'config_handler',
                'icon' => 'fa fa-cog',
                'order' => '1'
            ],
            [
                'name' => 'Clientes',
                'description' => 'Modulo de clientes',
                'internal_handler' => 'client_handler',
                'icon' => 'fa fa-user',
                'order' => '1'
            ],
        ];
        DB::table('modules')->insert($modules);
    }
}
