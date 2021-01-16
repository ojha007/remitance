<?php

use Diglactic\Breadcrumbs\Breadcrumbs;

Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('admin.dashboard'));
});
Breadcrumbs::resource('admin.rates', 'Rates');
Breadcrumbs::resource('admin.receivers', 'Receiver');

