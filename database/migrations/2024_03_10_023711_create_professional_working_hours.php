<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('professional_working_hours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('professional_id')->constrained()->onDelete('cascade');
            $table->string('day_of_week');
            $table->time('start_time');
            $table->time('end_time');
            $table->time('break_start')->nullable(); // Hora de início do intervalo
            $table->time('break_end')->nullable();   // Hora de término do intervalo
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('professional_working_hours');
    }
};
