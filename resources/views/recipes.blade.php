@extends('layouts.logedApp')

@section('content')
    <div id="app">
        <recipes :userid="{{ Auth::user()->id }}" :translations="{{json_encode(Lang::get('recipes'))}}"></recipes>
    </div>
@endsection