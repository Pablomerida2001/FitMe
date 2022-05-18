@extends('layouts.logedApp')

@section('content')
    <div id="app">
        <profile :userid={{ Auth::user()->id }} :translations="{{json_encode(Lang::get('profile'))}}"></profile>
    </div>
@endsection