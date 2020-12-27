<?php

namespace Modules\Backend\Http\Requests;

use App\Requests\FormRequestForApi;

class UserRequest extends FormRequestForApi
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->user,
            'roles' => 'required|exists:roles,id',
            'is_active' => 'required|boolean',
            'is_super' => 'boolean'
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
