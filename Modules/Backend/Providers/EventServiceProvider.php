<?php


namespace Modules\Backend\Providers;


use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Backend\Events\TransactionEvent;
use Modules\Backend\Listeners\SendTransactionEvent;


class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        TransactionEvent::class => [
            SendTransactionEvent::class,
        ],

    ];

    public function boot()
    {
        //
    }
}
