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
    include __DIR__ . '/subRoutes/send-money.php';
    include __DIR__ . '/subRoutes/notifications.php';
    include __DIR__ . '/subRoutes/transactions.php';
    Route::get('/states/country/{country_id}', 'BackendController@getStates')->name('getStateByCountry');
    Route::get('/districts/state/{state_id}', 'BackendController@getDistricts')->name('getDistrictByState');
    Route::get('/municipalities/district/{district_id}', 'BackendController@getMunicipalities')->name('getMunicipalitiesByDistrict');
    Route::get('/suburbs/state/{state_id}', 'BackendController@getSuburbs')->name('getSuburbsByStates');
    Route::get('/postalCode/suburbs/{suburb_id}', 'BackendController@getPostalCodeBySuburbs')->name('getPostalCodeBySuburbs');
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
});
