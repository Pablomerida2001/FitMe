@extends('layouts.app')

@section('header')
    <a href="{{Route('myFoods')}}">Mis comidas</a>
    <a href="#">Entrenamientos</a>
    <a href="#">Recetas</a>
@endsection

@section('content')
    @yield('conten')
@endsection