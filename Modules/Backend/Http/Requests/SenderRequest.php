<?php

namespace Modules\Backend\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SenderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'first_name' => 'required|string:min:1|max:255',
            'last_name' => 'required|string:min:1|max:255',
            'email' => 'required|email',
            'phone_number' => 'required',
            'street' => 'required|string|min:1',
            'suburb_id' => 'required|exists:suburbs,id',
            'state_id' => 'required|exits:states,id',
            'post_code' => 'required_with:state_id|numeric',
            'country_id' => 'required|exists:countries,id',
            'id_type_id' => 'required|exists:identities_types,id',
            'issued_by' => 'required|exists:issued_by,id',
            'id_number' => 'required',
            'expiry_date' => 'required|date',
            'date_of_birth' => 'required|date',
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
