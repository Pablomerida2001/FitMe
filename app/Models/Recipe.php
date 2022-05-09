<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    protected $table = "recipes";
    public $timestamps = false;
    protected $primaryKey = 'id';

    public function foods(){
        return $this->belongsToMany('App\Models\Food', 'recipes_foods', 'recipeId', 'foodId')->withPivot('quantity');
    }
}
