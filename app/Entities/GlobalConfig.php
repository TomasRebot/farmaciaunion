<?php

namespace App;

use App\Core\Entities\BaseEntity;


class GlobalConfig extends BaseEntity
{
    protected $table = 'global_configs';

    protected $fillable = [
        'bussines_name',
        'bussines_description',
        'schedule_time',
        'fix_phone',
        'bussiness_schedule',
        'whatsapp_phone',
        'pixel_facebook',
        'google_analitycs',
        'facebook_link',
        'instagram_link',
        'twitter_link',
        'youtube_link',
        'linkedin_link',
        'data_fiscal_link',
        'login_logo',
        'email_sender',
        'email_reciver',
        'email_suport',
    ];


    public function loginImage()
    {
        return asset('images/configs/'.$this->login_logo);
    }
    public function favicon()
    {
        return asset('images/configs/favicon_union.ico');
    }
    public function bussinesName()
    {
        return $this->bussines_name;
    }

    public function suportContactMail()
    {
        return $this->email_suport;
    }
    public function siteName()
    {
        return $this->bussines_name;
    }

    public function networks()
    {
        return [
            [ 'attr' => $this->facebook_link, 'label' =>'Facebook', 'icon' => 'icons' ],
            [ 'attr' => $this->instagram_link, 'label' =>'Instagram', 'icon' => 'icons' ],
            [ 'attr' => $this->twitter_link, 'label' =>'Twitter', 'icon' => 'icons' ],
            [ 'attr' => $this->youtube_link, 'label' =>'Youtube', 'icon' => 'icons' ],
            [ 'attr' => $this->linkedin_link, 'label' =>'Linkedin', 'icon' => 'icons' ],
        ];
    }


}
