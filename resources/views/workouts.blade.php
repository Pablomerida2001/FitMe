@extends('layouts.logedApp')

@section('content')
    <div class="container" id="app">
        <workouts :userid={{ Auth::user()->id }}></workouts>
    </div>
@endsection