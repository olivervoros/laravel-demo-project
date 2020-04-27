<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SchedulablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedulables', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('schedule_id')->unsigned();
            $table->bigInteger('schedulable_id')->unsigned();
            $table->string('schedulable_type');
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedulables');
    }
}
