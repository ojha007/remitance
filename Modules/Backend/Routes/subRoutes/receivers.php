<?php
Route::get('receivers/create/senders/{sender_id}', 'ReceiverController@create');
Route::resource('receivers', 'ReceiverController');
