<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'notifications', 'as' => 'notifications.'], function () {
    Route::get('notifications', 'NotificationController@index')->name('index');
    Route::get('markAllAsRead', 'NotificationController@markAllAsRead')->name('markAllAsRead');
    Route::get('getNotifications', 'NotificationController@getNotifications')->name('getNotifications');
    Route::get('getNotificationCount', 'NotificationController@getNotificationCount')->name('getNotificationCount');
    Route::get('/{notification}/markAsRead', 'NotificationController@markAsRead')->name('markAsRead');
});
