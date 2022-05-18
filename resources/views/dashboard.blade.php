@extends('layouts.logedApp')

@section('content')
    <div class="container py-4">
        <h1>{{__('translations.welcome')}}, {{auth()->user()->name}}!</h1>
    </div>
@endsection

