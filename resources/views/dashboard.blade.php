@extends('layouts.logedApp')

@section('content')
    <div class="container py-4" id="app">
        <h1>{{__('translations.welcome')}}, {{auth()->user()->name}}!</h1>
    </div>
@endsection

