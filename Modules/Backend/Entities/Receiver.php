<?php


namespace Modules\Backend\Entities;


use Illuminate\Database\Eloquent\Model;

class Receiver extends Model
{


    const CODE = 'RE';
    protected $fillable = [
        'name',
        'code',
        'is_active',
        'phone_number',
        'district_id',
        'identity_type_id',
        'issued_by',
        'id_number',
        'sender_id',
        'issued_date',
        'date_of_birth',
        'file',
        'expiry_date',
        'created_by',
        'updated_by'
    ];

    public static function getIssuedByArray(): array
    {
        return [
            'np' => 'Nepal Government',
        ];
    }


}
