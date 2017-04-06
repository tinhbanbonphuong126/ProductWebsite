<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'medical_records';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'morning_blood_pressure_high',
        'morning_blood_pressure_low',
        'morning_pulse',
        'morning_body_temperature',
        'morning_weight',
        'meal_breakfast_side_dish_ja',
        'meal_breakfast_side_dish_vn',
        'meal_breakfast_staple_food_ja',
        'meal_breakfast_staple_food_vn',
        'meal_lunch_side_dish_ja',
        'meal_lunch_side_dish_vn',
        'meal_lunch_staple_food_ja',
        'meal_lunch_staple_food_vn',
        'meal_snack_side_dish_ja',
        'meal_snack_side_dish_vn',
        'meal_snack_staple_food_ja',
        'meal_snack_staple_food_vn',
        'meal_dinner_side_dish_ja',
        'meal_dinner_side_dish_vn',
        'meal_dinner_staple_food_ja',
        'meal_dinner_staple_food_vn',
        'excretion_morning_urine_ja',
        'excretion_morning_urine_vn',
        'excretion_morning_flight_ja',
        'excretion_morning_flight_vn',
        'excretion_afternoon_urine_ja',
        'excretion_afternoon_urine_vn',
        'excretion_afternoon_flight_ja',
        'excretion_afternoon_flight_vn',
        'excretion_daytime_urine_ja',
        'excretion_daytime_urine_vn',
        'excretion_daytime_flight_ja',
        'excretion_daytime_flight_vn',
        'excretion_night_urine_ja',
        'excretion_night_urine_vn',
        'excretion_night_flight_ja',
        'excretion_night_flight_vn',
        'excretion_moisture',
        'body_bath_ja',
        'body_bath_vn',
        'wipe_people_ja',
        'wipe_people_vn',
        'rejection_ja',
        'rejection_vn',
        'prohibition_ja',
        'prohibition_vn',
        'work_day',
        'work_night',
        'check_21_hour_ja',
        'check_21_hour_vn',
        'check_0_hour_ja',
        'check_0_hour_vn',
        'check_3_hour_ja',
        'check_3_hour_vn',
        'check_6_hour_ja',
        'check_6_hour_vn',
        'remarks',
        'created_by',
        'updated_by',
        'delete_flag'
    ];

    // updated by
    public function updatedBy()
    {
        return $this->belongsTo(Staff::class, 'updated_by');
    }

    // created by
    public function createdBy()
    {
        return $this->belongsTo(Staff::class, 'created_by');
    }
}
