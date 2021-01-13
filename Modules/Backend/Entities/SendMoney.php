<?php


namespace Modules\Backend\Entities;


use Illuminate\Database\Eloquent\Model;

class SendMoney extends Model
{


    const CODE = 'TR';
    const AWAITING = 'Awaiting';
    const PENDING = 'Pending';
    protected $table = 'transactions';

    protected $fillable = ['sending_amount',
        'receiver_bank_id', 'receiving_amount',
        'sender_id', 'receiver_id', 'code', 'date',
        'rate', 'charge', 'currency_id', 'charge',
        'payment_type_id', 'notes', 'file',
        'created_by', 'updated_by'];

    public static function getAllTransactionStatues(): array
    {
        return [
            self::AWAITING,
            self::PENDING,
        ];
    }

}
