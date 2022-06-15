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
        $recipe = new Recipe(['id' => null, 'owner' => $req->owner == -1 ? null : $req->owner, 'name' => $req->name, 'description' => $req->description]);
        $recipe->save();

        return $recipe->id;
    }

    public function getFoods(Request $req){
        return Recipe::find($req->recipe)->foods()->get();
    }

    public function addFood(Request $req){
        Recipe::find($req->recipe)->foods()->attach($req->food, ["quantity" => $req->quantity]);
    }

    public function removeFood(Request $req){
        Recipe::find($req->recipe)->foods()->where('quantity', $req->quantity)->detach($req->food);
    }

    public function delete(Request $req){
        Recipe::find($req->recipe)->delete();
    }

    public function edit(Request $req){
        Recipe::find($req->recipe)->update(['name' => $req->name, 'description' => $req->description]);

        for($i = 0; $i < count($req->ingredients); $i++){

            if(Recipe::find($req->recipe)->foods()->where('id', $req->ingredients[$i]["food"]["id"])->exists()){
                Recipe::find($req->recipe)->foods()->updateExistingPivot($req->ingredients[$i]["food"]["id"], ["quantity" => $req->ingredients[$i]["quantity"]]);
            }else{
                Recipe::find($req->recipe)->foods()->attach($req->ingredients[$i]["food"]["id"], ["quantity" => $req->ingredients[$i]["quantity"]]);
            }
        }
    }
}
