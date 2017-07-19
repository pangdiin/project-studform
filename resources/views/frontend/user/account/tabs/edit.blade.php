{{ Form::model($logged_in_user, ['route' => 'frontend.user.profile.update', 'class' => 'form-horizontal', 'method' => 'PATCH', 'id' => 'profile-form' , 'style' => 'font-family: Museo-300']) }}
    
    <div class="form-group">
        {{ Form::label('username', trans('validation.attributes.frontend.username'), ['class' => 'col-md-4 control-label']) }}
        <div class="col-md-6">
            {{ Form::input('text', 'username', $logged_in_user->username, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.username') , 'maxlength' => '25']) }}
        </div>
    </div>

    @if ($logged_in_user->canChangeEmail())
        <div class="form-group">
            {{ Form::label('email', trans('validation.attributes.frontend.email'), ['class' => 'col-md-4 control-label']) }}
            <div class="col-md-6">
                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i> {{  trans('strings.frontend.user.change_email_notice') }}
                </div>

                {{ Form::input('email', 'email', $logged_in_user->email, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.email')]) }}
            </div>
        </div>
    @endif

    {{-- Image --}}
    <div class="form-group">
        <label class="control-label col-md-4">Image</label>
        <div class="col-md-6">
            <div id="dropzone" class="dropzone text-center">
                <div class="default-dz-message dz-message">
                    <div id="image-default" class="text-center">
                        @if($logged_in_profile && $logged_in_profile->image)
                            <img src="{{ $logged_in_profile->image }}" class="img-thumbnail img-responsive" style="max-height: 100%; width: auto">
                        @else
                            <div class="dropzone-icon"><i class="fa fa-5x fa-image"></i></div>
                            <span>Drop images here or click to select images.</span>
                        @endif
                    </div>
                </div>
            </div>
            <span class="help-block"></span>
        </div>
    </div>

    {{-- First Name --}}
    <div class="form-group">
        {{ Form::label('first_name', 'First Name', ['class' => 'col-md-4 control-label']) }}
        <div class="col-md-6">
            {{ Form::text('first_name', $logged_in_profile ? $logged_in_profile->first_name : old('first_name'), ['class' => 'form-control', 'placeholder' => 'Enter First Name' , 'maxlength' => '25']) }}
        </div>
    </div>

    {{-- Last Name --}}
    <div class="form-group">
        {{ Form::label('last_name', 'Last Name', ['class' => 'col-md-4 control-label']) }}
        <div class="col-md-6">
            {{ Form::text('last_name', $logged_in_profile ? $logged_in_profile->last_name : old('last_name'), ['class' => 'form-control', 'placeholder' => 'Enter Last Name' , 'maxlength' => '25']) }}
        </div>
    </div>

    {{-- Address --}}
    <div class="form-group">
        {{ Form::label('address', 'Address', ['class' => 'col-md-4 control-label']) }}
        <div class="col-md-6">
            {{ Form::text('address', $logged_in_profile ? $logged_in_profile->address : old('address'), ['class' => 'form-control', 'placeholder' => 'Enter Address']) }}
        </div>
    </div>

    {{-- Contact --}}
    <div class="form-group">
        {{ Form::label('contact_number', 'Contact Number', ['class' => 'col-md-4 control-label']) }}
        <div class="col-md-6">
            {{ Form::text('contact_number', $logged_in_profile ? $logged_in_profile->contact_number : old('contact_number'), ['class' => 'form-control', 'placeholder' => 'Enter Contact Number']) }}
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <a name="btn_submit" class="btn btn-primary"><i class="fa fa-pencil"></i> Update Profile</a>
        </div>
    </div>

{!! Form::close() !!}
@include('includes.partials.dropzone')
@section('after-scripts')

    <script type="text/javascript">
        $('#profile-form').singleDropzoneForm({
            dropzone: '#dropzone',
            has_image: {{ ($logged_in_profile && $logged_in_profile->image) ? 'true' : 'false' }},
            is_image_required: false,
        });
    </script>
@append

