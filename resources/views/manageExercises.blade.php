@extends('layouts.logedApp')

@section('content')
    <div class="container" id="app">
        <workouts :userid={{ Auth::user()->id }} :translations="{{json_encode(Lang::get('workout'))}}"></workouts>
    </div>
@endsection