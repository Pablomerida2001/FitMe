<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Food;
use App\Events\SearchEvent;
use DateTime;

class FoodController extends Controller
{

    public function getAll(Request $req){
        return Food::all();
    }

    public function search(Request $request) {
            $query = $request->query('query');
            
            $foods = Food::where('name', 'like', '%' . $query . '%') ->get();
                //->orWhere('description', 'like', '%' . $query . '%')
               
            //broadcast search results with Pusher channels
            //event(new SearchEvent($foods));
    
            return $foods;
    }

    public function get(Request $req){
        return User::find($req->user)->consumedFoods()->wherePivot('date', '=', $req->date)->get();
    }

    public function add(Request $req){
        Food::find($req->food)->consumedFoods()->attach($req->user, ["quantity" => $req->quantity, "meal" => $req->meal,  "date" => $req->date]);
    }

    public function remove(Request $req){
        Food::find($req->food)->consumedFoods()->wherePivot('date','=',$req->date)->wherePivot('meal','=',$req->meal)->detach($req->user);
    }

    public function edit(Request $req){
        Food::find($req->food)->consumedFoods()->updateExistingPivot($req->user, ["quantity" => $req->quantity, "meal" => $req->meal,  "date" => $req->date]);
    }
}
