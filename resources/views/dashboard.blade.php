@extends('layouts.logedApp')

@section('content')
    <div class="container">
        <h1>{{__('translations.welcome')}}, {{auth()->user()->name}}!</h1>
    </div>
@endsection

