@extends('layouts.app')

@section('header')
    @if (Auth::user()->role == 0)
        <a href="{{Route('myFoods')}}">{{__('myfoods.tittle')}}</a>
        <a href="{{Route('Workouts')}}">{{__('workout.tittle')}}</a>
        <a href="#">Recetas</a>
    @else
        <a href="{{Route('manageFoods')}}">{{__('myfoods.manage')}}</a>
        <a href="{{Route('manageExercises')}}">{{__('workout.manage')}}</a>
        <a href="#">Recetass</a>
    @endif
    
@endsection

@section('content')
    @yield('conten')
@endsection