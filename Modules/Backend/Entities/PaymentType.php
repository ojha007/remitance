<?php


namespace Modules\Backend\Entities;


use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{

    const LOCAL_REMIT = 'Local Remit';
    const BANK_TRANSFER = 'Bank Transfer';
    const CASH_ON_HAND = 'Cash On Hand';

    protected $table = 'payment_types';
    protected $fillable = ['name'];

    public static function getPaymentTypes(): array
    {
        return [
            self::LOCAL_REMIT,
            self::BANK_TRANSFER,
            self::CASH_ON_HAND,

        ];
    }


}
