<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UsersRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'religion' => 'string',
            'birthday' => 'required|date',
            'address' => 'required|string|max:128',
            'phone' => 'required|tel',
            'emails' => 'required|string|email|max:256|unique:users,emails,'.$this->get('id'),
        ];
    }
}
