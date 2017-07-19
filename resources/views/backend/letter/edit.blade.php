@extends('backend.layouts.app')
@section ('title', 'Letters')

@section('page-header')
    <h1>
        Letters
        <small>Edit Letter</small>
    </h1>
@endsection

@section('content')
   {!! Form::open(['url' => route('admin.letter.update', $letter), 'file' => 'mutlipart/enctype', 'files' => true, 'id' => 'letter-form', 'method' => 'PATCH' ]) !!}
        <div class="row">
            <div class="col-sm-8">
                @include('backend.letter.partials.fields')
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ trans('history.backend.recent_history') }}</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div><!-- /.box tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        {!! history()->renderEntity('Letter', $letter->id) !!}
                    </div><!-- /.box-body -->
                </div>
            </div>
            <div class="col-sm-4">
                @include('backend.letter.partials.submit')
            </div>
        </div>  
    {!! Form::close() !!}
@endsection

