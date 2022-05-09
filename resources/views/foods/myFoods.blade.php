@extends('layouts.logedApp')

@section('content')
    <div class="container" id="app">
        <h3>My Foods</h3>
        <consumed-foods :userid={{ Auth::user()->id }}></consumed-foods>
    </div>
@endsection