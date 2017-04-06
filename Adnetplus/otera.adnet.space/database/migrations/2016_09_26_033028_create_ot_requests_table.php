<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOtRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ot_requests', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('funeral_id');
            $table->string('funeral_name');
            $table->date('start_time');
            $table->string('religious');
            $table->string('faction');
            $table->string('otera_name');
            $table->string('venue');
            $table->string('venue_address');
            $table->integer('times_funeral');
            $table->text('contact_matter');
            $table->integer('type_id');
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
        Schema::drop('ot_requests');
    }
}
