<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CORE Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware(['auth', 'checkPermissions'])->group(function () {
    Route::post('/dynamic-table', 'DynamicTableController@resolve')->name('api.dynamic.table');
});



