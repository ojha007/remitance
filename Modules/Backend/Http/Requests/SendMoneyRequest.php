<?php

namespace Modules\Backend\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendMoneyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {

        return [
            'receiver_id' => 'required|exists:receivers,id',
            'sender_id' => 'required|exists:senders_id',
            'sending_amount' => 'required|numeric',
            'rate' => 'required|numeric',
            'receiving_amount' => 'required|numeric',
            'payment_type_id' => 'required|exists:payment_types,id',
            'charge' => 'nullable|numeric',
            'notes' => 'nullable',
            'file' => 'nullable',

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
