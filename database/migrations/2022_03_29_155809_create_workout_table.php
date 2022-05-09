<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkoutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workout', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exerciseId');
            $table->unsignedBigInteger('userId');
            $table->integer('sets');
            $table->integer('reps');
            $table->double('weight');
            $table->date('date');
        });

        Schema::table('workout', function (Blueprint $table) {
            $table->foreign('exerciseId')->references('id')->on('exercises')->onDelete('cascade');
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workout');
    }
}
