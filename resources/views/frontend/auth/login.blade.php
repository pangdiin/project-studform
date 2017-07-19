@extends('frontend.layouts.login')
@section('body-class', 'login-page')
@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="/">
            {{ app_name() }}
                {{-- <img src="{{ config('app.logo', asset('img/no-image.png')) }}">   --}}
            </a>
        </div>
        <div class="login-box-body">
            <p class="login-box-msg">{{ trans('labels.frontend.auth.login_box_title') }}</p>
            {{ Form::open(['route' => 'frontend.auth.login']) }}
                
                <div class="form-group has-feedback">
                    {{ Form::input('email', 'email', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.email')]) }}
                </div>
                    
                <div class="form-group has-feedback">
                    {{ Form::input('password', 'password', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.password')]) }}
                </div>

                <div class="row">
                    <div class="col-xs-8">
                        <label style="font-weight: normal;">{{ Form::checkbox('remember') }} {{ trans('labels.frontend.auth.remember_me') }}</label>
                    </div>
                    <div class="col-xs-4">
                        {{ Form::submit(trans('labels.frontend.auth.login_button'), 
                            ['class' => 'btn btn-primary btn-block btn-flat', 'style' => 'margin-right:15px']
                            ) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ link_to_route('frontend.auth.password.reset', trans('labels.frontend.passwords.forgot_password')) }}<br>
                    @if(config('access.users.registration'))
                    {{ link_to_route('frontend.auth.register', trans('labels.frontend.auth.register_box_title')) }}<br>
                    @endif
                </div>
                <div class="row text-center">
                    {!! $socialite_links !!}
                </div>
            {{ Form::close() }}

        </div>
    </div>
   
@endsection