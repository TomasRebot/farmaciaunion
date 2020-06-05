<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(RoleTableSeeder::class);
         $this->call(UserTableSeeder::class);
         $this->call(PermissionTableSeeder::class);
         $this->call(ModuleTableSeeder::class);
         $this->call(FormTableSeeder::class);
         $this->call(RolePermissionFormTableSeeder::class);
         $this->call(GlobalConfigTableSeeder::class);
         $this->call(ClientSeeder::class);
         $this->call(InitialProcessorSeeder::class);
    }
}
