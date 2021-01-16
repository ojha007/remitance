<?php


namespace Modules\Backend\Entities;


use Illuminate\Database\Eloquent\Model;

class Sender extends Model
{


    const CODE = 'SE';

    protected $appends = ['name', 'address'];

    protected $fillable = ['name',  'email', 'code', 'is_active',
        'phone_number', 'street', 'suburb_id', 'identity_type_id', 'issued_by', 'id_number',
        'issued_date', 'date_of_birth', 'file', 'expiry_date', 'created_by', 'updated_by'];

    public static function getIssuedByArray(): array
    {
        return [
            'np' => 'Nepal Government',
            'aus' => 'Australian Government',
        ];
    }


    public function getNameAttribute(): string
    {
        return ucwords($this->getAttribute('first_name')) . ' ' . ucwords($this->getAttribute('last_name'));
    }


}
