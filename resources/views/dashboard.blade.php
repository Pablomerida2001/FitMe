@extends('layouts.logedApp')

@section('content')
    <div class="container py-4" id="app">
        <h1>{{__('translations.welcome')}}, {{auth()->user()->name}}!</h1>
        @if (Auth::user()->role == 0)
            <home :userid="{{ Auth::user()->id}}" :translations="{{json_encode(Lang::get('translations'))}}" :foodsroute="{{json_encode(Route('myFoods'))}}" :workoutsroute="{{json_encode(Route('Workouts'))}}" :recipesroute="{{json_encode(Route('recipes'))}}"></home>
        @else
        <div>
            <div class="calories-container">
                <h3>{{__('translations.food')}}</h3>
                <a class="link" href="{{Route('manageFoods')}}">{{__('translations.addFood')}}</a>
            </div>
    
            <div class="exercises-container">
                <h3>{{__('translations.workout')}}</h3>
                <a class="link" href="{{Route('manageExercises')}}">{{__('translations.registerWorkout')}}</a>
            </div>
    
            <div class="calories-container">
                <h3>{{__('translations.recipes')}}</h3>                
                <h5>{{__('translations.recipesText')}}  <a class="link" href="{{Route('recipes')}}">{{__('translations.browseRecipes')}}</a></h5>
            </div>
        </div>
        @endif
    </div>
@endsection

