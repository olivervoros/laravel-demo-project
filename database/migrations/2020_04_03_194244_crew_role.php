<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrewRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('crew_role', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->integer('crew_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->timestamps();

            // TODO!
            //$table->foreign('crew_id')->references('id')->on('crews');
            //$table->foreign('role_id')->references('id')->on('roles');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crew_role');
    }
}
