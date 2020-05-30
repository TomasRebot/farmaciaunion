<?php

Route::post('/bulk-delete', 'HomeController@bulkDelete')->name('bulk-delete');


Route::namespace('Admin')
    ->middleware(['auth', 'checkPermissions'])
    ->group(function () {
    Route::post('synchronizePermissions','RolesController@synchronizePermissions')->name('roles.synchronize');
    Route::resource('users', 'UsersController');
    Route::resource('roles', 'RolesController');
    Route::resource('forms', 'FormsController');
    Route::resource('modules', 'ModuleController');
    Route::resource('permissions', 'PermissionsController');
    Route::resource('global-config', 'GlobalConfigController');
});

Route::namespace('Client')->group(function () {
    Route::get('unactive-clients', 'ClientController@unactives')->name('clients.unactives');
    Route::get('requests-clients', 'ClientController@requestClients')->name('clients.requests');
    Route::resource('clients', 'ClientController');
});
