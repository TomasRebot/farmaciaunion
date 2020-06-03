<?php

use App\Entities\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

if (! function_exists('isCurrentSuperAdmin')) {
    function isCurrentSuperAdmin()
    {
        return Auth::user()->hasRole('Super usuario');
    }
}


if (! function_exists('permissionsTo')) {
    function permissionsTo($form)
    {


        $permissions = DB::table('permissions')->pluck('action');
        $aviables = $permissions->map(function($per)use($form){
            return [
                $per => Auth::user()->can($form.'.'.$per),
            ];
        })->collapse();
        return $aviables;



    }
}


