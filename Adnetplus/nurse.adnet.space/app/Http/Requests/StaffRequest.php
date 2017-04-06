<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StaffRequest extends Request
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
            'name' => 'required', 
            'gender' => 'required',
            'address' => 'required',
            'birth_date' => 'required',
            'nationality' => 'required',
            'tel' => 'required',
            'email' => 'required|email|unique:staffs,email,' . $this->id,
            'password' => 'required',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'  => 'A name is required',
            'gender.required' => 'A gender is required',
            'address.required' => 'An address is required',
            'birth_date.required'  => 'A birth date is required',
            'nationality.required' => 'A nationality is required',
            'tel.required' => 'A telephone is required',
            'email.required'  => 'An email is required',
            'email.unique' => 'is.not.unique',
            'password.required' => 'A password is required',
        ];
    }
}
