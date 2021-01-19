<?php

namespace Modules\Backend\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Backend\Entities\SendMoney;

class TransactionStatusMail extends Mailable
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var SendMoney
     */
    public $transaction;
    public $type;

    /**
     * Create a new message instance.
     *
     * @param SendMoney $transaction
     * @param $type
     */
    public function __construct(SendMoney $transaction, $type)
    {
        $this->transaction = $transaction;
        $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): TransactionStatusMail
    {
        if ($this->type == 'CREATED') {
            return $this->view('backend::emails.transactions.created');
        }
        return $this->view('backend::emails.transactions.statusChanged');
    }
}
