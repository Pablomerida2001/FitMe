@extends('layouts.logedApp')

@section('content')
    <div id="app">
        <recipes :user="{{ Auth::user() }}" :translations="{{json_encode(Lang::get('recipes'))}}"></recipes>
    </div>
@endsection