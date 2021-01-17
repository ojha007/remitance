<?php

namespace Modules\Backend\Events;

use Illuminate\Queue\SerializesModels;

class TransactionEvent
{
    use SerializesModels;

    public $transaction;
    public $message;
    public $url;

    /**
     * Create a new event instance.
     *
     * @param $transaction
     * @param $message
     * @param $url
     */
    public function __construct($transaction, $message, $url)
    {

        $this->transaction = $transaction;
        $this->message = $message;
        $this->url = $url;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn(): array
    {
        return [];
    }
}
