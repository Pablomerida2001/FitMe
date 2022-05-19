@extends('layouts.logedApp')

@section('content')
    <div id="app">
        <profile :user="{{ Auth::user() }}" :translations="{{json_encode(Lang::get('profile'))}}"></profile>
    </div>
@endsection