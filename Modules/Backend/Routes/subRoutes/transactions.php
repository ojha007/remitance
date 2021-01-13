<?php
Route::resource('transactions', 'TransactionController', ['expect' => ['index', 'edit', 'update', 'destroy']]);
