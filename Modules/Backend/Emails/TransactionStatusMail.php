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

    /**
     * Create a new message instance.
     *
     * @param SendMoney $transaction
     */
    public function __construct(SendMoney $transaction)
    {
        $this->transaction =$transaction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): TransactionStatusMail
    {
        return $this->view('backend::emails.transactionStatusChanged');
    }
}
