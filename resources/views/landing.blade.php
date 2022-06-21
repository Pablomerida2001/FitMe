@extends('layouts.app')

@section('content')
        <div class="landing-container">
                <div class="landing-column">
                        <div class="landing-content">
                                <h1>{{Lang::get('landing.tittle1')}}</h1>

                                <p>{{Lang::get('landing.createAcc')}}</p>

                                <a class="btn btn-primary landing-register-btn" href="{{ route('register') }}"> {{Lang::get('landing.register')}} </a>
                                <p>{{Lang::get('landing.alreadyHaveAcc')}}<a href="{{ route('login') }}" style="color: #0d6efd;">{{Lang::get('landing.login')}}</a></p>
                        </div>

                        <div class="landing-content-second">
                                <h1>{{Lang::get('landing.tools')}}</h1>
                                <p>{{Lang::get('landing.text2')}}</p>
                                <div class="landing-tools">
                                        <div class="landing-tool">
                                                <img src="{{asset('img/landing/foods.svg')}}">
                                                <h3>{{Lang::get('landing.registerFoods')}}</h3>
                                                <p>{{Lang::get('landing.foodsText')}}</p>
                                        </div>

                                        <div class="landing-tool">
                                                <img src="{{asset('img/landing/workouts.svg')}}">
                                                <h3>{{Lang::get('landing.saveWorkouts')}}</h3>
                                                <p>{{Lang::get('landing.workoutsText')}}</p>
                                        </div>
                                        
                                        <div class="landing-tool">
                                                <img src="{{asset('img/landing/recipes.svg')}}">
                                                <h3>{{Lang::get('landing.recipes')}}</h3>
                                                <p>{{Lang::get('landing.recipesText')}}</p>
                                        </div>
                                </div>
                        </div>

                </div>
        </div>
@endsection


