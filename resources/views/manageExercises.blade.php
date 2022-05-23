@extends('layouts.logedApp')

@section('content')
    <div class="container" id="app">
        <h3>{{__('workout.manage')}}</h3>
        <manage-exercises :userid={{ Auth::user()->id }} :translations="{{json_encode(Lang::get('workout'))}}"></manage-exercises>
    </div>
@endsection