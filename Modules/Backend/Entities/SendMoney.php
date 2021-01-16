<?php


namespace Modules\Backend\Entities;


use Illuminate\Database\Eloquent\Model;

class SendMoney extends Model
{


    const CODE = 'TR';
    const AWAITING = 'Awaiting';
    const PENDING = 'Pending';
    const PROCESSING_TO_NEPAL = 'Processing to Nepal';
    const PROCESSING_IN_NEPAL = 'Processing In Nepal';
    const TRANSFERRED = 'Transferred';
    const COMPLETED = 'Completed';
    const PAID = 'Paid';
    const IME_READY = 'IME Ready';
    const IME_PROCESSING = 'IME Processing';
    const HOLD = 'HOLD';
    const CANCELLED = 'CANCELLED';
    const PROCESSING = 'PROCESSING';
    const READY_TO_COLLECT = 'Ready to Collect';
    const READY_TO_TRANSFERRED = 'Ready to Transferred';
    const REVIEW = 'Review';
    const BANK_READY = 'Bank Ready';

    protected $table = 'transactions';

    protected $fillable = [
        'sending_amount',
        'receiver_bank_id', 'receiving_amount',
        'sender_id', 'receiver_id', 'code', 'date',
        'rate', 'charge', 'currency_id', 'charge',
        'payment_type_id', 'notes', 'file',
        'created_by', 'updated_by'];

    public static function getAllTransactionStatues(): array
    {
        return [
            self::AWAITING,
            self::PAID,
            self::COMPLETED,
            self::PENDING,
            self::HOLD,
            self::TRANSFERRED,
            self::BANK_READY,
            self::REVIEW,
            self::READY_TO_TRANSFERRED,
            self::READY_TO_COLLECT,
            self::PROCESSING,
            self::CANCELLED,
            self::HOLD,
            self::IME_PROCESSING,
            self::IME_READY,
            self::PROCESSING_IN_NEPAL,
            self::PROCESSING_TO_NEPAL,
        ];
    }

}
