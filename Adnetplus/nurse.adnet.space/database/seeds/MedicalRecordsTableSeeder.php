<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MedicalRecordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('medical_records')->insert([
            [
                'user_id' => 1,
                'morning_blood_pressure_high' => 2,
                'morning_blood_pressure_low' => 2,
                'morning_pulse' => 2,
                'morning_body_temperature' => 2,
                'morning_weight' => 2,
                'meal_breakfast_side_dish_vn' => 1,
                'meal_breakfast_side_dish_ja' => 1,
                'meal_breakfast_staple_food_vn' => 1,
                'meal_breakfast_staple_food_ja' => 1,
                'meal_lunch_side_dish_vn' => 1,
                'meal_lunch_side_dish_ja' => 1,
                'meal_lunch_staple_food_vn' => 1,
                'meal_lunch_staple_food_ja' => 1,
                'meal_snack_side_dish_vn' => 1,
                'meal_snack_side_dish_ja' => 1,
                'meal_snack_staple_food_vn' => 1,
                'meal_snack_staple_food_ja' => 1,
                'meal_dinner_side_dish_vn' => 1,
                'meal_dinner_side_dish_ja' => 1,
                'meal_dinner_staple_food_vn' => 1,
                'meal_dinner_staple_food_ja' => 1,
                'excretion_morning_urine_vn' => 1,
                'excretion_morning_urine_ja' => 1,
                'excretion_morning_flight_vn' => 1,
                'excretion_morning_flight_ja' => 1,
                'excretion_afternoon_urine_vn' => 1,
                'excretion_afternoon_urine_ja' => 1,
                'excretion_afternoon_flight_vn' => 1,
                'excretion_afternoon_flight_ja' => 1,
                'excretion_night_urine_vn' => 1,
                'excretion_night_urine_ja' => 1,
                'excretion_night_flight_vn' => 1,
                'excretion_night_flight_ja' => 1,
                'excretion_moisture' => 'Do not know it',
                'body_bath_vn' => 1,
                'body_bath_ja' => 1,
                'wipe_people_vn' => 1,
                'wipe_people_ja' => 1,
                'rejection_vn' => 1,
                'rejection_ja' => 1,
                'prohibition_vn' => 1,
                'prohibition_ja' => 1,
                'work_day' => 'Work 24/7 hours',
                'work_night' => 'Not work at night',
                'check_21_hour_ja' => 1,
                'check_21_hour_vn' => 1,
                'check_0_hour_ja' => 2,
                'check_0_hour_vn' => 2,
                'check_3_hour_ja' => 3,
                'check_3_hour_vn' => 3,
                'check_6_hour_ja' => 4,
                'check_6_hour_vn' => 4,
                'remarks' => 'No remark here',
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'user_id' => 1,
                'morning_blood_pressure_high' => 2,
                'morning_blood_pressure_low' => 2,
                'morning_pulse' => 2,
                'morning_body_temperature' => 2,
                'morning_weight' => 2,
                'meal_breakfast_side_dish_vn' => 1,
                'meal_breakfast_side_dish_ja' => 1,
                'meal_breakfast_staple_food_vn' => 1,
                'meal_breakfast_staple_food_ja' => 1,
                'meal_lunch_side_dish_vn' => 1,
                'meal_lunch_side_dish_ja' => 1,
                'meal_lunch_staple_food_vn' => 1,
                'meal_lunch_staple_food_ja' => 1,
                'meal_snack_side_dish_vn' => 1,
                'meal_snack_side_dish_ja' => 1,
                'meal_snack_staple_food_vn' => 1,
                'meal_snack_staple_food_ja' => 1,
                'meal_dinner_side_dish_vn' => 1,
                'meal_dinner_side_dish_ja' => 1,
                'meal_dinner_staple_food_vn' => 1,
                'meal_dinner_staple_food_ja' => 1,
                'excretion_morning_urine_vn' => 1,
                'excretion_morning_urine_ja' => 1,
                'excretion_morning_flight_vn' => 1,
                'excretion_morning_flight_ja' => 1,
                'excretion_afternoon_urine_vn' => 1,
                'excretion_afternoon_urine_ja' => 1,
                'excretion_afternoon_flight_vn' => 1,
                'excretion_afternoon_flight_ja' => 1,
                'excretion_night_urine_vn' => 1,
                'excretion_night_urine_ja' => 1,
                'excretion_night_flight_vn' => 1,
                'excretion_night_flight_ja' => 1,
                'excretion_moisture' => 'Do not know it',
                'body_bath_vn' => 1,
                'body_bath_ja' => 1,
                'wipe_people_vn' => 1,
                'wipe_people_ja' => 1,
                'rejection_vn' => 1,
                'rejection_ja' => 1,
                'prohibition_vn' => 1,
                'prohibition_ja' => 1,
                'work_day' => 'Work 24/7 hours',
                'work_night' => 'Not work at night',
                'check_21_hour_ja' => 1,
                'check_21_hour_vn' => 1,
                'check_0_hour_ja' => 2,
                'check_0_hour_vn' => 2,
                'check_3_hour_ja' => 3,
                'check_3_hour_vn' => 3,
                'check_6_hour_ja' => 4,
                'check_6_hour_vn' => 4,
                'remarks' => 'No remark here',
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
        ]);
    }
}
