<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('status',['cancelled','pending','confirmed','created']);
            $table->date('date');
            $table->time('time');
            $table->foreignId('host_id');
            $table->foreignId('court_id')->nullable();
            $table->smallInteger('player_num');
            $table->bigInteger('timestamp');
            $table->timestamps();

            $table->foreign('host_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('court_id')
                ->references('id')
                ->on('courts')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event');
    }
}
