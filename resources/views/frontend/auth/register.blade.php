@extends('frontend.layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-push-3">
                <div class="h2">Join Us</div>

                {{ Form::open(['route' => 'frontend.auth.register']) }}
                    <div class="form-group has-feedback">
                        {{ Form::input('text', 'username', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.username')]) }}
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        {{ Form::input('email', 'email', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.email')]) }}
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        {{ Form::input('password', 'password', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.password')]) }}
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        {{ Form::input('password', 'password_confirmation', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.password_confirmation')]) }}
                        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    </div>
                    
                    @if (config('access.captcha.registration'))
                        <div class="form-group">
                                {!! Form::captcha() !!}
                                {{ Form::hidden('captcha_status', 'false') }} {{-- Temp --}}
                        </div><!--form-group-->
                    @endif

                    <div class="row">
                        <div class="col-xs-8">
                        </div>
                        <div class="col-xs-4 text-right">
                            {{ Form::submit('Submit', ['class' => 'btn btn-primary btn-flat']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ link_to_route('frontend.auth.login', trans('labels.frontend.auth.login_box_title')) }}<br>
                        {{ link_to_route('frontend.auth.password.reset', trans('labels.frontend.passwords.forgot_password')) }}<br>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
        
    </div>
@endsection

@section('after-scripts')
          <script src="{{asset('js/vue-frontend.js')}}" charset="utf-8"></script>
          @if (config('access.captcha.registration'))
                    {!! Captcha::script() !!}
          @endif

          <script type="text/javascript">
          function isNumber (o) {
            return ! isNaN (o-0);
          }

          $(".zip").keyup(function(e){
                    txtVal = $(this).val();
                    if(isNumber(txtVal) && txtVal.length>4){
                              $(this).val(txtVal.substring(0,4) )
                    }
          });
          $("#zip").keyup(function() {
              $("#zip").val(this.value.match(/[0-9]*/));
          });
          </script>
@endsection
