<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MedicalRecordFormatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('medical_record_formats')->insert([
            [
                'name' => 'meal_breakfast_side_dish_vn',
                'value' => '{"1":"VN_breakfast_side_dish_1","2":"VN_breakfast_side_dish_2","3":"VN_breakfast_side_dish_3","4":"VN_breakfast_side_dish_4"}',
                'required' => true,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'meal_breakfast_side_dish_ja',
                'value' => '{"1":"JP_breakfast_side_dish_1","2":"JP_breakfast_side_dish_2","3":"JP_breakfast_side_dish_3","4":"JP_breakfast_side_dish_4"}',
                'required' => true,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'meal_breakfast_staple_food_vn',
                'value' => '{"1":"VN_breakfast_staple_food_1","2":"VN_breakfast_staple_food_2","3":"VN_breakfast_staple_food_3","4":"VN_breakfast_staple_food_4"}',
                'required' => true,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'meal_breakfast_staple_food_ja',
                'value' => '{"1":"JP_breakfast_staple_food_1","2":"JP_breakfast_staple_food_2","3":"JP_breakfast_staple_food_3","4":"JP_breakfast_staple_food_4"}',
                'required' => true,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'meal_lunch_side_dish_vn',
                'value' => '{"1":"VN_lunch_side_dish_1","2":"VN_lunch_side_dish_2","3":"VN_lunch_side_dish_3","4":"VN_lunch_side_dish_4"}',
                'required' => true,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'meal_lunch_side_dish_ja',
                'value' => '{"1":"JP_lunch_side_dish_1","2":"JP_lunch_side_dish_2","3":"JP_lunch_side_dish_3","4":"JP_lunch_side_dish_4"}',
                'required' => true,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'meal_lunch_staple_food_vn',
                'value' => '{"1":"Lunch_staple_food_1","2":"Lunch_staple_food_2","3":"Lunch_staple_food_3","4":"Lunch_staple_food_4"}',
                'required' => true,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'meal_lunch_staple_food_ja',
                'value' => '{"1":"Lunch_staple_food_1","2":"Lunch_staple_food_2","3":"Lunch_staple_food_3","4":"Lunch_staple_food_4"}',
                'required' => true,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'meal_snack_side_dish_vn',
                'value' => '{"1":"Snack_side_dish_1","2":"Snack_side_dish_2","3":"Snack_side_dish_3","4":"Snack_side_dish_4"}',
                'required' => true,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'meal_snack_side_dish_ja',
                'value' => '{"1":"Snack_side_dish_1","2":"Snack_side_dish_2","3":"Snack_side_dish_3","4":"Snack_side_dish_4"}',
                'required' => true,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'meal_snack_staple_food_vn',
                'value' => '{"1":"Snack_staple_food_1","2":"Snack_staple_food_2","3":"Snack_staple_food_3","4":"Snack_staple_food_4"}',
                'required' => true,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'meal_snack_staple_food_ja',
                'value' => '{"1":"Snack_staple_food_1","2":"Snack_staple_food_2","3":"Snack_staple_food_3","4":"Snack_staple_food_4"}',
                'required' => true,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'meal_dinner_side_dish_vn',
                'value' => '{"1":"Dinner_side_dish_1","2":"Dinner_side_dish_2","3":"Dinner_side_dish_3","4":"Dinner_side_dish_4"}',
                'required' => true,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'meal_dinner_side_dish_ja',
                'value' => '{"1":"Dinner_side_dish_1","2":"Dinner_side_dish_2","3":"Dinner_side_dish_3","4":"Dinner_side_dish_4"}',
                'required' => true,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'meal_dinner_staple_food_vn',
                'value' => '{"1":"Dinner_staple_food_1","2":"Dinner_staple_food_2","3":"Dinner_staple_food_3","4":"Dinner_staple_food_4"}',
                'required' => true,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'meal_dinner_staple_food_ja',
                'value' => '{"1":"Dinner_staple_food_1","2":"Dinner_staple_food_2","3":"Dinner_staple_food_3","4":"Dinner_staple_food_4"}',
                'required' => true,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'excretion_morning_urine_vn',
                'value' => '{"1":"Morning_urine_1","2":"Morning_urine_2","3":"Morning_urine_3","4":"Morning_urine_4"}',
                'required' => false,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'excretion_morning_urine_ja',
                'value' => '{"1":"Morning_urine_1","2":"Morning_urine_2","3":"Morning_urine_3","4":"Morning_urine_4"}',
                'required' => false,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'excretion_morning_flight_vn',
                'value' => '{"1":"Morning_flight_1","2":"Morning_flight_2","3":"Morning_flight_3","4":"Morning_flight_4"}',
                'required' => false,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'excretion_morning_flight_ja',
                'value' => '{"1":"Morning_flight_1","2":"Morning_flight_2","3":"Morning_flight_3","4":"Morning_flight_4"}',
                'required' => false,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'excretion_afternoon_urine_vn',
                'value' => '{"1":"Afternoon_urine_1","2":"Afternoon_urine_2","3":"Afternoon_urine_3","4":"Afternoon_urine_4"}',
                'required' => false,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'excretion_afternoon_urine_ja',
                'value' => '{"1":"Afternoon_urine_1","2":"Afternoon_urine_2","3":"Afternoon_urine_3","4":"Afternoon_urine_4"}',
                'required' => false,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'excretion_afternoon_flight_vn',
                'value' => '{"1":"Afternoon_flight_1","2":"Afternoon_flight_2","3":"Afternoon_flight_3","4":"Afternoon_flight_4"}',
                'required' => false,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'excretion_afternoon_flight_ja',
                'value' => '{"1":"Afternoon_flight_1","2":"Afternoon_flight_2","3":"Afternoon_flight_3","4":"Afternoon_flight_4"}',
                'required' => false,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'excretion_night_urine_vn',
                'value' => '{"1":"Night_urine_1","2":"Night_urine_2","3":"Night_urine_3","4":"Night_urine_4"}',
                'required' => false,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'excretion_night_urine_ja',
                'value' => '{"1":"Night_urine_1","2":"Night_urine_2","3":"Night_urine_3","4":"Night_urine_4"}',
                'required' => false,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'excretion_night_flight_vn',
                'value' => '{"1":"Night_flight_1","2":"Night_flight_2","3":"Night_flight_3","4":"Night_flight_4"}',
                'required' => false,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'excretion_night_flight_ja',
                'value' => '{"1":"Night_flight_1","2":"Night_flight_2","3":"Night_flight_3","4":"Night_flight_4"}',
                'required' => false,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],

            // bath
            [
                'name' => 'body_bath_vn',
                'value' => '{"1":"Body_bath_1","2":"Body_bath_2","3":"Body_bath_3","4":"Body_bath_4"}',
                'required' => true,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'body_bath_ja',
                'value' => '{"1":"Body_bath_1","2":"Body_bath_2","3":"Body_bath_3","4":"Body_bath_4"}',
                'required' => true,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'wipe_people_vn',
                'value' => '{"1":"Wipe_people_1","2":"Wipe_people_2","3":"Wipe_people_3","4":"Wipe_people_4"}',
                'required' => true,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'wipe_people_ja',
                'value' => '{"1":"Wipe_people_1","2":"Wipe_people_2","3":"Wipe_people_3","4":"Wipe_people_4"}',
                'required' => true,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'rejection_vn',
                'value' => '{"1":"Rejection_1","2":"Rejection_2","3":"Rejection_3","4":"Rejection_4"}',
                'required' => true,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'rejection_ja',
                'value' => '{"1":"Rejection_1","2":"Rejection_2","3":"Rejection_3","4":"Rejection_4"}',
                'required' => true,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'prohibition_vn',
                'value' => '{"1":"Prohibition_1","2":"Prohibition_2","3":"Prohibition_3","4":"Prohibition_4"}',
                'required' => true,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'prohibition_ja',
                'value' => '{"1":"Prohibition_1","2":"Prohibition_2","3":"Prohibition_3","4":"Prohibition_4"}',
                'required' => true,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],

            // check time
            [
                'name' => 'check_21_hour_ja',
                'value' => '{"1":"check_21_ja_1","2":"check_21_ja_2","3":"check_21_ja_3","4":"check_21_ja_4"}',
                'required' => false,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'check_21_hour_vn',
                'value' => '{"1":"check_21_vn_1","2":"check_21_vn_2","3":"check_21_vn_3","4":"check_21_vn_4"}',
                'required' => false,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'check_0_hour_ja',
                'value' => '{"1":"check_0_ja_1","2":"check_0_ja_2","3":"check_0_ja_3","4":"check_0_ja_4"}',
                'required' => false,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'check_0_hour_vn',
                'value' => '{"1":"check_0_vn_1","2":"check_0_vn_2","3":"check_0_vn_3","4":"check_0_vn_4"}',
                'required' => false,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'check_3_hour_ja',
                'value' => '{"1":"check_3_ja_1","2":"check_3_ja_2","3":"check_3_ja_3","4":"check_3_ja_4"}',
                'required' => false,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'check_3_hour_vn',
                'value' => '{"1":"check_3_vn_1","2":"check_3_vn_2","3":"check_3_vn_3","4":"check_3_vn_4"}',
                'required' => false,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'check_6_hour_ja',
                'value' => '{"1":"check_6_ja_1","2":"check_6_ja_2","3":"check_6_ja_3","4":"check_6_ja_4"}',
                'required' => false,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'check_6_hour_vn',
                'value' => '{"1":"check_6_vn_1","2":"check_6_vn_2","3":"check_6_vn_3","4":"check_6_vn_4"}',
                'required' => false,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
        ]);
    }
}
