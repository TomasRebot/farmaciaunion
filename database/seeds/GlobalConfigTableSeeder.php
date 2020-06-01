<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GlobalConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('global_configs')->insert([
            'bussines_name' => 'Farmacia union',
            'bussines_description'=> 'Farmacia ',
            'bussiness_schedule'=> '{ "morningOpen": "8am","morningClose":"13pm","afternoonOpen":"17pm","afternoonClose":"22pm","full":"false" }',
            'whatsapp_phone'=> '+54 9 3454199555',
            'pixel_facebook'=> 'https://www.google.com.ar',
            'google_analitycs'=> 'https://www.google.com.ar',
            'facebook_link'=> 'https://www.facebook.com/FarmaciaUnionConcordia/',
            'instagram_link'=> '-',
            'twitter_link'=> '-',
            'youtube_link'=> '-',
            'linkedin_link'=> '-',
            'data_fiscal_link'=> '-',
            'login_logo'=> 'union_login.jpg',
            'email_sender'=> 'info@farmaciaunion.com.ar',
            'email_reciver'=> 'info@farmaciaunion.com.ar',
            'email_suport'=> 'tomasrebot@farmaciaunion.com.ar',


        ]);
    }
}
