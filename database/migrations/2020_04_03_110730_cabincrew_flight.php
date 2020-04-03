<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CabincrewFlight extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('cabincrew_flight', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cabincrew_id')->unsigned();
            $table->integer('flight_id')->unsigned();

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
        Schema::dropIfExists('cabincrew_flight');
    }
}
