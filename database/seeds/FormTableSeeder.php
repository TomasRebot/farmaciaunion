<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $config_module_forms = [
            [
                'module_id' => 1,
                'name' => 'Usuarios',
                'key' => 'usersForm',
                'target' => 'panel/users',
                'icon' => '',
                'order' => '0'
            ],
            [
                'module_id' => 1,
                'name' => 'Roles',
                'key' => 'rolesForm',
                'target' => 'panel/roles',
                'icon' => '',
                'order' => '1'
            ],
            [
                'module_id' => 1,
                'name' => 'Permisos',
                'key' => 'permissionsForm',
                'target' => 'panel/permissions',
                'icon' => '',
                'order' => '2'
            ],
            [
                'module_id' => 1,
                'name' => 'Modulos',
                'key' => 'modulesForm',
                'target' => 'panel/modules',
                'icon' => '',
                'order' => '3'
            ],
            [
                'module_id' => 1,
                'name' => 'Formularios',
                'key' => 'formsForm',
                'target' => 'panel/forms',
                'icon' => '',
                'order' => '4'
            ],
            [
                'module_id' => 1,
                'name' => 'Global',
                'key' => 'siteConfigForm',
                'target' => 'panel/global-config',
                'icon' => '',
                'order' => '5'
            ]
        ];
        $client_module_forms = [
            [
                'module_id' => 2,
                'name' => 'Activos',
                'key' => 'activeClients',
                'target' => 'panel/clients',
                'icon' => '',
                'state' => '1',
            ],
            [
                'module_id' => 2,
                'name' => 'Inactivos',
                'key' => 'unactiveClients',
                'target' => 'panel/unactive-clients',
                'icon' => '',
                'state' => '1',
            ],
        ];

        DB::table('forms')->insert(array_merge($config_module_forms,$client_module_forms));
    }
}
