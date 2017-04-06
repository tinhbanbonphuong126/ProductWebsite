<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MedicalRecordRequest extends Request
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
            'morning_blood_pressure_high' => 'required',
            'morning_blood_pressure_low' => 'required',
            'morning_pulse' => 'required',
            'morning_body_temperature' => 'required',
            'morning_weight' => 'required',
            'meal_breakfast_side_dish' => 'required',
            'meal_breakfast_staple_food' => 'required',
            'meal_lunch_side_dish' => 'required',
            'meal_lunch_staple_food' => 'required',
            'meal_snack_side_dish' => 'required',
            'meal_snack_staple_food' => 'required',
            'meal_dinner_side_dish' => 'required',
            'meal_dinner_staple_food' => 'required',
            'body_bath' => 'required',
            'wipe_people' => 'required',
            'rejection' => 'required',
            'prohibition' => 'required',
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
            'morning_blood_pressure_high.required' => 'The field is required',
            'morning_blood_pressure_low.required' => 'The field is required',
            'morning_pulse.required' => 'The field is required',
            'morning_body_temperature.required' => 'The field is required',
            'morning_weight.required' => 'The field is required',
            'meal_breakfast_side_dish.required' => 'The field is required',
            'meal_breakfast_staple_food.required' => 'The field is required',
            'meal_lunch_side_dish.required' => 'The field is required',
            'meal_lunch_staple_food.required' => 'The field is required',
            'meal_snack_side_dish.required' => 'The field is required',
            'meal_snack_staple_food.required' => 'The field is required',
            'meal_dinner_side_dish.required' => 'The field is required',
            'meal_dinner_staple_food.required' => 'The field is required',
            'body_bath.required' => 'The field is required',
            'wipe_people.required' => 'The field is required',
            'rejection.required' => 'The field is required',
            'prohibition.required' => 'The field is required',
        ];
    }
}
