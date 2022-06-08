<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller{
    
    public function getAll(Request $req){
        return Recipe::all()->whereIn('owner', [null, $req->user]);
    }

    public function getByUser(Request $req){
        return Recipe::all()->whereIn('owner', [$req->user]);
    }

    public function search(Request $request) {
            $query = $request->query('query');
            
            $recipes = Recipe::where('name', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%')->get();
    
            return $recipes;
    }

    public function create(Request $req){
        $recipe = new Recipe(['id' => null, 'owner' => $req->owner, 'name' => $req->name, 'description' => $req->description]);
        $recipe->save();
    }

    public function getFoods(Request $req){
        return Recipe::find($req->recipe)->foods()->get();
    }

    public function addFood(Request $req){
        Recipe::find($req->recipe)->foods()->attach($req->food, ["quantity" => $req->quantity]);
    }
}
