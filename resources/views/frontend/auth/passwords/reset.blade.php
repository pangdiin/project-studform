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
            {{ Form::open(['route' => 'frontend.auth.password.reset']) }}
                <input type="hidden" name="token" value="{{ $token }}">
                
                <div class="form-group row">
                    {{ Form::label('email', trans('validation.attributes.frontend.email') . ' :', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                        <p class="form-control-static">{{ $email }}</p>
                        {{ Form::input('hidden', 'email', $email, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.email')]) }}
                    </div>
                </div>

                 <div class="form-group has-feedback @if($errors->has('password')) has-error @endif">
                    {{ Form::input('password', 'password', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.password')]) }}
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                     @if($errors->has('password'))
                        <span class="help-block">
                            {{ $errors->first('password') }}
                        </span>
                    @endif
                </div>

                 <div class="form-group has-feedback">
                    {{ Form::input('password', 'password_confirmation', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.password_confirmation')]) }}
                    <span class="glyphicon glyphicon-repeat form-control-feedback"></span>
                </div>

                <div class="row">
                    <div class="col-xs-6"></div>
                    <div class="col-xs-6">
                        {{ Form::submit(trans('labels.frontend.passwords.reset_password_button'), 
                            ['class' => 'btn btn-primary btn-block btn-flat', 'style' => 'margin-right:15px']
                            ) }}
                    </div>
                </div>

            {{ Form::close() }}
        </div>
    </div>
@endsection