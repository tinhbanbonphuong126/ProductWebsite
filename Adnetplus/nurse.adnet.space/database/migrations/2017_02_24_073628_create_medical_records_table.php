<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_records', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id');

            // morning
            $table->smallInteger('morning_blood_pressure_high', false, true);
            $table->smallInteger('morning_blood_pressure_low', false, true);
            $table->smallInteger('morning_pulse', false, true);
            $table->smallInteger('morning_body_temperature', false, true);
            $table->smallInteger('morning_weight', false, true);

            // meal
            $table->tinyInteger('meal_breakfast_side_dish_ja', false, true);
            $table->tinyInteger('meal_breakfast_side_dish_vn', false, true);
            $table->tinyInteger('meal_breakfast_staple_food_ja', false, true);
            $table->tinyInteger('meal_breakfast_staple_food_vn', false, true);
            $table->tinyInteger('meal_lunch_side_dish_ja', false, true);
            $table->tinyInteger('meal_lunch_side_dish_vn', false, true);
            $table->tinyInteger('meal_lunch_staple_food_ja', false, true);
            $table->tinyInteger('meal_lunch_staple_food_vn', false, true);
            $table->tinyInteger('meal_snack_side_dish_ja', false, true);
            $table->tinyInteger('meal_snack_side_dish_vn', false, true);
            $table->tinyInteger('meal_snack_staple_food_ja', false, true);
            $table->tinyInteger('meal_snack_staple_food_vn', false, true);
            $table->tinyInteger('meal_dinner_side_dish_ja', false, true);
            $table->tinyInteger('meal_dinner_side_dish_vn', false, true);
            $table->tinyInteger('meal_dinner_staple_food_ja', false, true);
            $table->tinyInteger('meal_dinner_staple_food_vn', false, true);

            // excretion
            $table->tinyInteger('excretion_morning_flight_ja', false, true);
            $table->tinyInteger('excretion_morning_flight_vn', false, true);
            $table->tinyInteger('excretion_morning_urine_ja', false, true);
            $table->tinyInteger('excretion_morning_urine_vn', false, true);
            $table->tinyInteger('excretion_afternoon_flight_ja', false, true);
            $table->tinyInteger('excretion_afternoon_flight_vn', false, true);
            $table->tinyInteger('excretion_afternoon_urine_ja', false, true);
            $table->tinyInteger('excretion_afternoon_urine_vn', false, true);
            $table->tinyInteger('excretion_night_flight_ja', false, true);
            $table->tinyInteger('excretion_night_flight_vn', false, true);
            $table->tinyInteger('excretion_night_urine_ja', false, true);
            $table->tinyInteger('excretion_night_urine_vn', false, true);
            $table->string('excretion_moisture', 128);

            // take a bath
            $table->tinyInteger('body_bath_ja', false, true);
            $table->tinyInteger('body_bath_vn', false, true);
            $table->tinyInteger('wipe_people_ja', false, true);
            $table->tinyInteger('wipe_people_vn', false, true);
            $table->tinyInteger('rejection_ja', false, true);
            $table->tinyInteger('rejection_vn', false, true);
            $table->tinyInteger('prohibition_ja', false, true);
            $table->tinyInteger('prohibition_vn', false, true);

            // working time
            $table->text('work_day');
            $table->text('work_night');

            // checking time
            $table->tinyInteger('check_21_hour_ja', false, true);
            $table->tinyInteger('check_21_hour_vn', false, true);
            $table->tinyInteger('check_0_hour_ja', false, true);
            $table->tinyInteger('check_0_hour_vn', false, true);
            $table->tinyInteger('check_3_hour_ja', false, true);
            $table->tinyInteger('check_3_hour_vn', false, true);
            $table->tinyInteger('check_6_hour_ja', false, true);
            $table->tinyInteger('check_6_hour_vn', false, true);

            // Reference information
            $table->text('remarks');

            // common fields
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->boolean('delete_flag')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('medical_records');
    }
}
