<?php

Route::group([
    'domain' => config('app.admin_domain'),
    'as' => 'admin.',
    'middleware' => 'auth',
    'routePrefix' => 'admin.'], function () {
    Route::get('/', 'BackendController@index')->name('index');
    Route::get('/dashboard', 'BackendController@index')->name('dashboard');
    include __DIR__ . '/subRoutes/rates.php';
    include __DIR__ . '/subRoutes/senders.php';
    include __DIR__ . '/subRoutes/receivers.php';
    include __DIR__ . '/subRoutes/roles.php';
    Route::get('/states/country/{country_id}', 'BackendController@getStates');
    Route::get('/districts/state/{state_id}', 'BackendController@getDistricts');
    Route::get('/municipalities/district/{district_id}', 'BackendController@getMunicipalities');
});