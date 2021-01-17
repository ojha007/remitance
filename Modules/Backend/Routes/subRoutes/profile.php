<?php

Route::get('profile', 'UserController@profile')->name('profile');
Route::post('profile', 'UserController@updateAvatar')->name('profile.avatar');
Route::match(['put', 'patch'], 'profile/{user}', 'UserController@updateProfile')->name('profile.update');
