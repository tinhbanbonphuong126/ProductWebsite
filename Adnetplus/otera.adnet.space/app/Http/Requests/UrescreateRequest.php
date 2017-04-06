<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UrescreateRequest extends Request
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
        $rule = [
            'funeral_id' => 'required',
            'undertaker_id' => 'required',
            'funeral_name' => 'required|string|max:32',
            'start_time' => 'required|date',
            'religious' => 'required|string|max:16',
            'faction' => 'required|string|max:16',
            'otera_name' => 'required|string|max:64',
            'venue' => 'required|string|max:64',
            'venue_address' => 'string|max:128',
            'times_funeral' => 'integer',
            'chief_name' => 'required',
            'request_1_count_nin' => 'integer',
            'request_2_count_nin' => 'integer',
            'request_3_count_nin' => 'integer',
            'request_4_count_nin' => 'integer',
            'contact_matter' => 'string',
        ];
        if(! is_null(Request::get('request_1_count_nin') ) )
        {
            $value = $this->checkField(Request::get('request_1_count_nin'));
            $rule['request_1_time_start'] = $value;
            $rule['request_1_time_end'] = $value;
        }
        if(! is_null(Request::get('request_2_count_nin') ) )
        {
            $value = $this->checkField(Request::get('request_2_count_nin'));
            $rule['request_2_time_start'] = $value;
            $rule['request_2_time_start'] = $value;
        }
        if(! is_null(Request::get('request_3_count_nin') ) )
        {
            $value = $this->checkField(Request::get('request_3_count_nin'));
            $rule['request_3_time_start'] = $value;
            $rule['request_3_time_start'] = $value;
        }
        if(! is_null(Request::get('request_4_count_nin') ) )
        {
            $value = $this->checkField(Request::get('request_4_count_nin'));
            $rule['request_4_time_start'] = $value;
            $rule['request_4_time_start'] = $value;
        }
        return $rule;
    }

    protected function checkField($count_nin)
    {
        return ($count_nin > 0) ? 'required' : '';
    }

}
