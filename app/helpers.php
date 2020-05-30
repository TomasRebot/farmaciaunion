<?php

use App\Entities\User;
use Illuminate\Support\Facades\Auth;

if (! function_exists('isCurrentSuperAdmin')) {
    function isCurrentSuperAdmin()
    {
        return Auth::user()->hasRole('Super usuario');
    }
}


