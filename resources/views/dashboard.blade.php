@extends('layouts.logedApp')

@section('content')
    <div class="container py-4" id="app">
        <h1>{{__('translations.welcome')}}, {{auth()->user()->name}}!</h1>
        <home :userid="{{ Auth::user()->role == 0 ? Auth::user()->id : -1}}" :translations="{{json_encode(Lang::get('translations'))}}" :foodsroute="{{json_encode(Route('myFoods'))}}" :workoutsroute="{{json_encode(Route('Workouts'))}}" :recipesroute="{{json_encode(Route('recipes'))}}"></home>
    </div>
@endsection

