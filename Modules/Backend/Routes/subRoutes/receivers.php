<?php
Route::get('receivers/create/senders/{sender_id}', 'ReceiverController@create');
Route::get('all-receivers-by/sender/{sender_id}', 'ReceiverController@receiverBySender');
Route::resource('receivers', 'ReceiverController');
