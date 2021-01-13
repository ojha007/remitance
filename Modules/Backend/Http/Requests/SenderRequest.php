<?php

namespace Modules\Backend\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Backend\Entities\Receiver;
use Modules\Backend\Entities\Sender;

class SenderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {

        $id = $this->route()->parameter('sender');
        return [
            'first_name' => 'required|string:min:1|max:255',
            'last_name' => 'required|string:min:1|max:255',
            'email' => 'required|email',
            'phone_number' => 'required',
            'street' => 'required|string|min:1',
            'suburb_id' => 'required|exists:suburbs,id',
            'state_id' => 'required|exists:states,id',
            'post_code' => 'required_with:state_id|numeric',
            'country_id' => 'required|exists:countries,id',
            'identity_type_id' => 'required|exists:identity_types,id',
            'issued_by' => 'required|in:' . implode(',', array_keys(Sender::getIssuedByArray())),
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
    public function authorize()
    {
        return true;
    }
}
