@extends('layouts.logedApp')

@section('content')
    <div class="container" id="app">
        <h3>{{__('myfoods.tittle')}}</h3>
        <consumed-foods :userid={{ Auth::user()->id }} :translations="{{json_encode(Lang::get('myfoods'))}}"></consumed-foods>
    </div>
@endsection