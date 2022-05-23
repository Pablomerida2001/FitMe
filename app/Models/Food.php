<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    protected $table = "foods";
    public $timestamps = false;
    protected $fillable = ['id', 'name', 'calories', 'fats', 'carbohydrates', 'protein'];

    public function recipes(){
        return $this->belongsToMany('App\Models\Recipe', 'recipes_foods', 'foodId', 'recipeId')->withPivot('quantity');
    }

    public function consumedFoods(){
        return $this->belongsToMany('App\Models\User', 'consumed_foods', 'foodId', 'userId')->withPivot(["quantity", "meal", "date"]);
    }
}
