@extends('layouts.app')

@section('header')
    <a href="{{Route('myFoods')}}">{{__('myfoods.tittle')}}</a>
    <a href="{{Route('Workouts')}}">{{__('workout.tittle')}}</a>
    <a href="#">Recetas</a>
@endsection

@section('content')
    @yield('conten')
@endsection