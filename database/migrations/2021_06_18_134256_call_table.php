<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CallTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id');
            $table->mediumInteger('call_from');
            $table->mediumInteger('call_to');
            $table->dateTime('call_date');
            $table->dateTime('incoming_time');
            $table->dateTime('responce_time');
            $table->dateTime('connect_time');
            $table->smallInteger('call_duration');
            $table->string('direction');
            $table->string('call_sid');
            $table->string('call_type');
            $table->string('status')->nullable();
            $table->string('response')->nullable();
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
        Schema::dropIfExists('call');

    }
}
