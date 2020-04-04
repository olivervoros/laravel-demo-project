<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrewFlight extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('crew_flight', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->integer('crew_id')->unsigned();
            $table->integer('flight_id')->unsigned();
            $table->timestamps();

            // TODO!
            //$table->foreign('cabincrew_id')->references('id')->on('cabincrews');
            //$table->foreign('flight_id')->references('id')->on('flights');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crew_flight');
    }
}
