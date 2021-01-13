<?php

use \Illuminate\Support\Facades\Route;

//Route::get('notifications', 'NotificationController')->name('getAllNotifications');
Route::get('notifications', 'NotificationController@index')->name('notifications.index');
