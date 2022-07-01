<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsByThemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events_by_themes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreignId('theme_id')->references('id')->on('event_themes')->onDelete('cascade');
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
        Schema::dropIfExists('event_by_themes');
    }
}
