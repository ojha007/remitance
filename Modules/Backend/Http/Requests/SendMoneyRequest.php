<?php

namespace Modules\Backend\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Modules\Backend\Database\Seeders\PaymentTypeSeeder;
use Modules\Backend\Database\Seeders\StatesSeeder;
use Modules\Backend\Rules\RequiredIf;

class SendMoneyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {

        $requiredIf = null;
        $pickupTypes = DB::table('payment_types')->where('id', $this->get('payment_type_id'))->first();
        if ($pickupTypes) {
            $requiredIf = $pickupTypes->name;
        }
        return [
            'receiver_id' => 'required|exists:receivers,id',
            'sender_id' => 'required|exists:senders,id',
            'sending_amount' => 'required|numeric',
            'date' => 'required|date:format,Y-m-d',
            'rate' => 'required|numeric',
            'receiving_amount' => 'required|numeric',
            'payment_type_id' => 'required|exists:payment_types,id',
            'charge' => 'required|numeric',
            'notes' => 'nullable',
            'file' => 'nullable',
            'pickup_address' => new RequiredIf($requiredIf,PaymentTypeSeeder::LOCAL_REMIT),


        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
}
