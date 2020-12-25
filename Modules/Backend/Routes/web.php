<?php

Route::group([
    'domain' => env('ADMIN_DOMAIN'),
    'as' => 'admin.',
    'routePrefix' => 'admin.'], function () {
    Route::get('/', 'BackendController@index');
//    Route::get('/dashboard', 'BackendController@index')->name('dashboard');
    include __DIR__ . '/subRoutes/rates.php';
});
