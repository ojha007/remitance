<?php


namespace Modules\Backend\Entities;


use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{

    protected $table = 'payment_types';
    protected $fillable = ['name'];


}
