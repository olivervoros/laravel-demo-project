<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightreviews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flightreviews', function (Blueprint $table) {
            $table->id();
            $table->integer('passenger_id')->unsigned();
            $table->string('airline');
            $table->string('flight_number');
            $table->integer('review_points')->unsigned();
            $table->string('review_title');
            $table->mediumText('review_body');
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
        Schema::dropIfExists('flightreviews');
    }
}
