<?php
Route::post('senders/{id}/changeStatus', 'SenderController@changeStatus')->name('senders.changeStatus');
Route::resource('senders', 'SenderController');
