<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FlightPilot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flight_pilot', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('flight_id')->unsigned();
            $table->integer('pilot_id')->unsigned();

            // TODO!
            //$table->foreign('flight_id')->references('id')->on('flights');
            //$table->foreign('pilot_id')->references('id')->on('pilots');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flight_pilot');
    }
}
