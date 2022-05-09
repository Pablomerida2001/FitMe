<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipesFoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes_foods', function (Blueprint $table) {
            $table->unsignedBigInteger('recipeId');
            $table->unsignedBigInteger('foodId');
            $table->integer('quantity');
        });

        Schema::table('recipes_foods', function (Blueprint $table) {
            $table->foreign('recipeId')->references('id')->on('recipes')->onDelete('cascade');
            $table->foreign('foodId')->references('id')->on('foods')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipes_foods');
    }
}
