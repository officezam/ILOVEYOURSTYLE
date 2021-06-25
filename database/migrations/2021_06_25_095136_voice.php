<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Voice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voice', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('voice_from');
            $table->string('voice_to');
            $table->string('voiceAudio');
            $table->string('voice_text');
            $table->string('recording')->default(true);
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
        Schema::dropIfExists('voice');
    }
}
