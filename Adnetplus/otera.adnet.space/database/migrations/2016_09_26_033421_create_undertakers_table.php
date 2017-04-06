<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUndertakersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('undertakers', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('undertaker_id');
            $table->string('undertaker_name');
            $table->string('other_name');
            $table->string('address');
            $table->string('phone');
            $table->string('mail');
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
        Schema::drop('undertakers');
    }
}
