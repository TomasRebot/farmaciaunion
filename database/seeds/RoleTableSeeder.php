<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Administrador',
            'Super usuario',
            'Cliente'
        ];

        foreach($names as $name){
            DB::table('roles')->insert([
                'name' => $name,
                'description' => $name,
                'state' => 1
            ]);
        }
    }
}
