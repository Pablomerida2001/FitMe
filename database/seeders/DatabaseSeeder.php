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
        /*\App\Models\Food::factory(10)->create();
        $recipe = new \App\Models\Recipe(["id" => null, "name" => "receta test", "owner" => "1", "description" => "esto es una prueba"]);
        $recipe->save();
        \App\Models\Recipe::find(1)->foods()->attach(1, array('quantity' => rand(1,5)));
        $a = new \App\Models\Exercise(["id" => null, "name" => "banquita", "description" => "asies"]);
        $a->save();
        for($i = 0; $i < 4; $i++){
            $a->workout()->attach(1, ["id" => null, "date" => "2022/05/19"]);
            $set = new \App\Models\Set(['id' => null, 'reps' => '8', 'weight' => '65', 'workoutId' => $a->workout()->wherePivot('exerciseId','=',1)->get()->pivot->id]);
            $set->save();
        }*/
        $set = new \App\Models\Set(['id' => null, 'reps' => '8', 'weight' => '65', 'workoutId' => '1']);
        $set->save();
    }
}
