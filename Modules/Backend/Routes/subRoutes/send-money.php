<?php
Route::GET('send-money', 'SendMoneyController@create');
Route::POST('send-money', 'SendMoneyController@store');
Route::get('send-money/{send_money}', 'SendMoneyController@show')->name('send-money.show');
