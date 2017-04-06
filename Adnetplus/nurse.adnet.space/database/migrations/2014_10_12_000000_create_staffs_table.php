<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 10);
            $table->string('name')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->date('birth_date')->nullable();
            $table->smallInteger('nationality')->nullable();
            $table->string('address')->nullable();
            $table->string('tel')->nullable();
            $table->string('email', 30)->unique();
            $table->string('password');
            $table->boolean('is_admin')->default(false);
            $table->rememberToken();

            // 5 common fields
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
        Schema::drop('staffs');
    }
}
