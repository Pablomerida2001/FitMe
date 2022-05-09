<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        //\App\Models\Food::factory(10)->create();
        //$recipe = new \App\Models\Recipe(["id" => null, "name" => "receta test", "owner" => "1", "description" => "esto es una prueba"]);
        //$recipe->save();
        //\App\Models\Recipe::find(1)->foods()->attach(1, array('quantity' => rand(1,5)));
        //$a = new \App\Models\Exercise(["id" => null, "name" => "banquita", "description" => "bum pechito"]);
        //$a->save();
        //$a->workout()->attach(1, ["id" => null, "sets" => 3, "reps" => 8, "weight" => 65, "date" => "2022/04/11"]);
        $b = \App\Models\User::find(1);
        $b->consumedFoods()->attach(4, ["quantity" => 250, "meal" => 1,  "date" => "2022/04/25"]);
    }
}
