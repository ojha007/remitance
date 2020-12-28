<?php

Route::group([
    'domain' => config('app.admin_url'),
    'as' => 'admin.',
    'middleware' => 'auth',
    'routePrefix' => 'admin.'], function () {
    Route::get('/', 'BackendController@index');
    Route::get('/dashboard', 'BackendController@index')->name('dashboard');
    include __DIR__ . '/subRoutes/rates.php';
    include __DIR__ . '/subRoutes/senders.php';
    include __DIR__ . '/subRoutes/roles.php';
});
