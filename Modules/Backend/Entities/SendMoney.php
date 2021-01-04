<?php


namespace Modules\Backend\Entities;


use Illuminate\Database\Eloquent\Model;

class SendMoney extends Model
{


    const CODE = 'TR';

    protected $table = 'transactions';

    protected $fillable = ['sending_amount', 'receiving_amount',
        'sender_id', 'receiving_id', 'code', 'date',
        'rate', 'charge', 'currency_id', 'payment_type_id', 'notes', 'file',
        'created_by', 'updated_by'];


}
