@extends('layouts.logedApp')

@section('content')
    <div id="app">
        <recipes :userid="{{ Auth::user()->role == 0 ? Auth::user()->id : -1}}" :translations="{{json_encode(Lang::get('recipes'))}}"></recipes>
    </div>
@endsection