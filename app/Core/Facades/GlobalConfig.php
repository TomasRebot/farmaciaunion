<?php


namespace App\Core\Facades;


use Illuminate\Support\Facades\Facade;

class GlobalConfig extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'globalconfig';
    }

}
