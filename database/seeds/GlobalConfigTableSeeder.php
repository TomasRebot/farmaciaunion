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
            'bussines_name' => 'Mestizos comunicacion',
            'bussines_description'=> 'Agencia de publicidad de rosario',
            'bussiness_schedule'=> '{ "morningOpen": "8am","morningClose":"13pm","afternoonOpen":"17pm","afternoonClose":"22pm","full":"false" }',
            'whatsapp_phone'=> '+54 9 341 514-3422',
            'pixel_facebook'=> 'https://www.google.com.ar',
            'google_analitycs'=> 'https://www.google.com.ar',
            'facebook_link'=> 'https://www.facebook.com/mestizosfan/',
            'instagram_link'=> 'https://www.instagram.com/mestizosgram/',
            'twitter_link'=> 'Mestizos comunicacion',
            'youtube_link'=> 'https://www.youtube.com.ar',
            'linkedin_link'=> 'https://www.linkedin.com.ar',
            'data_fiscal_link'=> 'https://www.google.com.ar',
            'login_logo'=> 'mestizos_login.png',
            'email_sender'=> 'mtz-app@mestizosweb.com.ar',
            'email_reciver'=> 'info@mestizosweb.com.ar',
            'email_suport'=> 'soporte@mestizosweb.com.ar',


        ]);
    }
}
