@extends('layouts.app')

@section('header')
    <a href="{{Route('myFoods')}}">{{__('myfoods.tittle')}}</a>
    <a href="{{Route('Workouts')}}">Entrenamientos</a>
    <a href="#">Recetas</a>
@endsection

@section('content')
    @yield('conten')
@endsection