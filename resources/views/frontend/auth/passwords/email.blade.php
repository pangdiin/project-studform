@extends('frontend.layouts.login')
@section('body-class', 'login-page')
@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="/">
                <b>Peppermint </b>Grove</a>
            </a>
        </div>
        <div class="login-box-body">

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <p class="login-box-msg">{{ trans('labels.frontend.passwords.reset_password_box_title') }}</p>
            {{ Form::open(['route' => 'frontend.auth.password.email']) }}
                
                <div class="form-group has-feedback @if($errors->has('email')) has-error @endif">
                    {{ Form::input('email', 'email', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.email')]) }}
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if($errors->has('email'))
                        <span class="help-block">
                            {{ $errors->first('email') }}
                        </span>
                    @endif
                </div>
                    
                <div class="row">
                    <div class="col-xs-6"></div>
                    <div class="col-xs-6">
                        {{ Form::submit(trans('labels.frontend.passwords.reset_password_button'), 
                            ['class' => 'btn btn-primary btn-block btn-flat', 'style' => 'margin-right:15px']
                            ) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ link_to_route('frontend.auth.login',     trans('labels.frontend.auth.login_button')) }}<br>
                    @if(config('access.users.registration'))
                    {{ link_to_route('frontend.auth.register',  trans('labels.frontend.auth.register_box_title')) }}<br>
                    @endif
                </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection