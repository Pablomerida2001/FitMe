@extends('layouts.app')

@section('content')
        <div class="landing-container">
                <div class="landing-column">
                        <div class="landing-content">
                                <h1>Start Your fitness journey now</h1>

                                <p>Create an account and start tracking your calories and your workouts with FitMe.  </p>

                                <a class="btn btn-primary landing-register-btn" href="{{ route('register') }}"> {{__('Register')}} </a>
                                <p>Already have an account? <a href="{{ route('login') }}" style="color: #0d6efd;">{{__('login')}}</a></p>
                        </div>
                </div>
        </div>
@endsection


