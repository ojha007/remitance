<?php

namespace Modules\Backend\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Backend\Entities\Receiver;

class ReceiverRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {

        $id = $this->route()->parameter('receiver');
        return [
            'first_name' => 'required|string:min:1|max:255',
            'middle_name' => 'nullable|string:min:1|max:255',
            'last_name' => 'required|string:min:1|max:255',
            'email' => 'nullable|email',
            'sender_id' => 'required|exists:senders,id',
            'phone_number' => 'required|numeric',
            'street' => 'required|string|min:1',
            'state_id' => 'required|exists:states,id',
            'country_id' => 'required|exists:countries,id',
            'identity_type_id' => 'required|exists:identity_types,id',
            'issued_by' => 'required|in:' . implode(',', array_keys(Receiver::getIssuedByArray())),
            'id_number' => 'required|unique:senders,id_number,' . $id,
            'expiry_date' => 'required|date|after:date_of_birth',
            'date_of_birth' => 'required|date|before:expiry_date',
            'file' => 'nullable'
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
