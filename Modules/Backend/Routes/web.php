<?php


Route::group(['prefix' => 'backend', 'as' => 'backend.', 'routePrefix' => 'backend.'], function () {
    Route::get('/', 'BackendController@index');
    include __DIR__ . '/subRoutes/rates.php';
});
