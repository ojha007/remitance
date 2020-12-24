<?php


namespace Modules\Backend\Entities;


use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $fillable = ['date', 'customer_rate', 'agent_rate'];

}
