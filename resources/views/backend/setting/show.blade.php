@extends('backend.layouts.app')
@section ('title', 'Settings')


@section('page-header')
    <h1>
        <i class="fa fa-cogs"></i> Settings
    </h1>
@endsection

@section('content')

    <div class="box box-success">
        <div class="box-header">
            <h3 class="box-title">
                {{ $group['name'] }} Configurations
            </h3>
        </div>
        <div class="box-body">
            <p class="text-muted">
                {{ $group['description'] }}
            </p>
            <hr/>
            <div class="row">
                <div class="col-sm-8 col-sm-push-2">
                    {!! Form::open(['method' => 'PATCH', 'url' => route('admin.setting.update', $key)]) !!}
                        @forelse($settings as $s => $setting)
                            @if($setting->type == "color")
                                <div class="form-group">
                                    <label><i class="{{ $setting->icon }}"></i> {{ $setting->display }}</label>
                                    <div class="input-group colorpicker-component">
                                        <input type="text" name="color[{{ $setting->key }}]" value="{{ $setting->value }}" class="form-control" />
                                        <span class="input-group-addon"><i></i></span>
                                    </div>
                                </div>
                            @elseif($setting->type == "number")
                                <div class="form-group">
                                    <label><i class="{{ $setting->icon }}"></i> {{ $setting->display }}</label>
                                    {!! Form::number('number['.$setting->key.']', $setting->value, ['class' => 'form-control']) !!}
                                    <span class="help-block"></span>
                                </div>
                            @elseif($setting->type == "email")
                                <div class="form-group">
                                    <label><i class="{{ $setting->icon }}"></i> {{ $setting->display }}</label>
                                    {!! Form::email('email['.$setting->key.']', $setting->value, ['class' => 'form-control']) !!}
                                    <span class="help-block"></span>
                                </div>
                            @else
                                <div class="form-group">
                                    <label><i class="{{ $setting->icon }}"></i> {{ $setting->display }}</label>
                                    {!! Form::text('text['.$setting->key.']', $setting->value, ['class' => 'form-control']) !!}
                                    <span class="help-block"></span>
                                </div>
                            @endif
                        @empty
                            <div class="text-center form-group">
                                
                                <b class="h3">There are no settings set. Please contact the developers if you want to add.</b>
                            </div>
                        @endforelse
                        <div class="form-group">
                            <div class="clearfix">
                                <a href="{{ route('admin.setting.index') }}" class="btn btn-flat btn-info"><i class="fa fa-angle-left"></i> <i class="fa fa-cogs"></i> Setting List</a>
                                <div class="pull-right">
                                    {!! Form::submit('Save Changes', ['class' => 'btn btn-primary btn-flat']) !!}
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div><!-- /.box-body -->
    </div><!--box-->
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('history.backend.recent_history') }}</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            {!! history()->renderType('Setting') !!}
        </div><!-- /.box-body -->
    </div><!--box box-success-->
@endsection