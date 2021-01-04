<?php
Route::GET('send-money', 'SendMoneyController@create');
Route::POST('send-money', 'SendMoneyController@store');
