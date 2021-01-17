<?php

namespace Modules\Backend\Listeners;

use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Modules\Backend\Events\TransactionEvent;
use Modules\Backend\Notifications\TransactionNotification;
use Spatie\Permission\Models\Permission;

class SendTransactionEvent
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param TransactionEvent $event
     * @return void
     */
    public function handle(TransactionEvent $event)
    {
        $users = Permission::findByName('transaction-notification', 'admin')->users;
        if (count($users) < 1) $users = User::where('is_super', true)->get();
        Notification::send($users, new TransactionNotification($event->transaction, $event->url, $event->message));

    }
}
