@extends('layouts.logedApp')

@section('content')
    <div class="container">
        <h1>Welcome back {{auth()->user()->name}}!</h1>
    </div>
@endsection

