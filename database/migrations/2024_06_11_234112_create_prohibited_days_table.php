<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProhibitedDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prohibited_days', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->enum('type', ['off_day', 'vacation_start', 'vacation_end', 'holiday']);
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
        Schema::dropIfExists('prohibited_days');
    }
}
