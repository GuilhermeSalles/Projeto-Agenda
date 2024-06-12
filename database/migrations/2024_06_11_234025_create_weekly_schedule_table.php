<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeeklyScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weekly_schedule', function (Blueprint $table) {
            $table->id();
            $table->string('day_of_week');
            $table->time('opening_time')->nullable(); // Alteração para permitir valores nulos
            $table->time('closing_time')->nullable();
            $table->boolean('working')->default(false);
            $table->boolean('special_day')->default(false);
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
        Schema::dropIfExists('weekly_schedule');
    }
}
