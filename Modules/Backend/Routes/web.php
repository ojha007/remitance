<?php


Route::group(
    [
        'prefix' => 'backend',
        'as' => 'backend.',
        'routePrefix' => 'backend.',
        'middleware' => 'auth'
    ], function () {
    Route::get('/', 'BackendController@index');
    Route::get('/dashboard', 'BackendController@index')->name('dashboard');
    include __DIR__ . '/subRoutes/rates.php';
});
