<?php
Route::get('receivers/create/senders/{sender_id}', 'ReceiverController@create');
Route::get('all-receivers-by/sender/{sender_id}', 'ReceiverController@receiverBySender');
Route::get('/banks-details/receiver/{id}', 'ReceiverController@getReceiverBankDetails');
Route::resource('receivers', 'ReceiverController');
