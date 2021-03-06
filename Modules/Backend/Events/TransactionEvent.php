<?php

namespace Modules\Backend\Events;

use Illuminate\Queue\SerializesModels;

class TransactionEvent
{
    use SerializesModels;

    public $transaction;
    public $message;
    public $url;
    public $eventType;

    /**
     * Create a new event instance.
     *
     * @param $transaction
     * @param $message
     * @param $url
     * @param string $eventType
     */
    public function __construct($transaction, $message, $url, $eventType = 'created')
    {

        $this->transaction = $transaction;
        $this->message = $message;
        $this->url = $url;
        $this->eventType = $eventType;
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
