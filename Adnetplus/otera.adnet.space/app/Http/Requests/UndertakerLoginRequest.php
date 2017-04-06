<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UndertakerLoginRequest extends Request
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
            'account_id' => 'required|string|min:7',
            'password' => 'required|string|min:8',
        ];
    }
}