<?php
Route::resource('transactions', 'TransactionController', ['expect' => ['edit', 'update', 'destroy']]);
Route::post('transactions/changeStatus/{id}', 'TransactionController@changeStatus')->name('transactions.changeStatus');
