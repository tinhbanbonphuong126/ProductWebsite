<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalRecordFormatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_record_formats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->text('value');
            $table->boolean('required')->default(true);
            $table->boolean('delete_flag')->default(false);
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
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
        Schema::drop('medical_record_formats');
    }
}
