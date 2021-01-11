<?php
Route::GET('send-money/create', 'SendMoneyController@create')->name('send-money.create');
Route::POST('send-money', 'SendMoneyController@store')->name('send-money.store');
Route::get('send-money/{send_money}', 'SendMoneyController@show')->name('send-money.show');
