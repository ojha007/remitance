<?php


namespace Modules\Backend\Entities;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Backend\Http\Controllers\BackendController;

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

    protected $with = ['sender', 'receiver', 'paymentType'];
    protected $appends = ['status'];

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

    public function sender(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Sender::class);
    }

    public function receiver(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Receiver::class);
    }

    public function paymentType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PaymentType::class);
    }

    /**
     * @return mixed
     */
    public function getStatusAttribute()
    {
        return (new BackendController())
            ->getLatestStatusOfTransactions()
            ->select('s.name as status')
            ->join('statuses as s', 's.id', 'ts.status_id')
            ->where('ts.transaction_id', '=', $this->getAttribute('id'))
            ->first()->status;
    }


    public function receiverBank()
    {
        return DB::table('transactions as t')
            ->select('b.name as bank', 'rb.account_number', 'rb.branch')
            ->join('receiver_banks as rb', 't.receiver_bank_id', '=', 'rb.id')
            ->join('banks as b', 'rb.bank_id', '=', 'b.id')
            ->where('t.id', '=', $this->getAttribute('id'))
            ->first();
    }
}
