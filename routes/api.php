<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/update-product','MerlinInterfaceController@updateProduct')->name('api.update.product');
Route::get('/fire-initial-load','MerlinInterfaceController@fireInitialLoad')->name('api.fire.intial.load');

Route::post('/get-categories','ApiRouterController@categories')->name('api.get.categories');
Route::post('/get-drugs','ApiRouterController@drugs')->name('api.get.drugs');
Route::post('/get-therapeutic-actions','ApiRouterController@therapeuticActions')->name('api.get.therapeutic.actions');
Route::post('/get-product-support-data','ApiRouterController@productSupportData')->name('api.get.product.support.data');


Route::post('/store-drugs','ApiRouterController@storeTherapeuticAction')->name('api.therapeutic.actions.store');



//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
