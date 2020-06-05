<?php

use App\Api\MerlinInterface\InitialLoadProcessor;
use Illuminate\Database\Seeder;

class InitialProcessorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        (new InitialLoadProcessor())->handle();
    }
}
