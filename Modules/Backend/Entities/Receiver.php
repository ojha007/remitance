<?php


namespace Modules\Backend\Entities;


use Illuminate\Database\Eloquent\Model;

class Receiver extends Model
{


    const CODE = 'RE';
    protected $appends = ['name', 'address'];
    protected $fillable = ['first_name', 'last_name', 'email', 'code', 'is_active',
        'phone_number', 'street', 'suburb_id', 'identity_type_id', 'issued_by', 'id_number',
        'issued_date', 'date_of_birth', 'file', 'expiry_date', 'created_by', 'updated_by'];

    public static function getIssuedByArray()
    {
        return [
            'np' => 'Nepal Government',
            'aus' => 'Australian Government',
        ];
    }


    public function getNameAttribute()
    {
        return ucwords($this->getAttribute('first_name')) . ' ' . ucwords($this->getAttribute('last_name'));
    }


}
