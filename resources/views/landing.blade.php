@extends('layouts.app')

@section('content')
        <div class="landing-container">
                <div class="landing-column">
                        <div class="landing-content">
                                <h1>{{Lang::get('landing.tittle1')}}</h1>

                                <p>{{Lang::get('landing.createAcc')}}</p>

                                <a class="btn btn-primary landing-register-btn" href="{{ route('register') }}"> {{__('Register')}} </a>
                                <p>{{Lang::get('landing.alreadyHaveAcc')}}<a href="{{ route('login') }}" style="color: #0d6efd;">{{__('login')}}</a></p>
                        </div>

                        <div class="landing-content-second">
                                <h1>Las herramientas para tus objetivos</h1>
                                <p>Sea cual sea tu objetivo FitMe te ayudara a cumplirlo</p>
                                <div class="landing-tools">
                                        <div class="landing-tool">
                                                <img src="{{asset('img/landing/foods.svg')}}">
                                                <h3>Registra tus comidas</h3>
                                                <p>Registra las comidas que consumes y lleva un control de la calorías que consumes diariamente</p>
                                        </div>

                                        <div class="landing-tool">
                                                <img src="{{asset('img/landing/workouts.svg')}}">
                                                <h3>Guarda tus entrenamientos</h3>
                                                <p>Con FitMe puedes guardar los entrenamientos que realizes para llevar un control de tu progreso.</p>
                                        </div>
                                        
                                        <div class="landing-tool">
                                                <img src="{{asset('img/landing/recipes.svg')}}">
                                                <h3>Recetas</h3>
                                                <p>Explora y crea tus propias recetas. Las recetas recetas contendran la información nutricional de la misma</p>
                                        </div>
                                </div>
                        </div>

                </div>
        </div>
@endsection


