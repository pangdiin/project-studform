@extends('backend.layouts.app')
@section ('title', 'View Management')

@section('page-header')
    <h1>
        Views
        <small>Edit view</small>
    </h1>
@endsection

@section('content')
   {!! Form::open(['url' => route('admin.view.update', $view), 'file' => 'mutlipart/enctype', 'files' => true, 'id' => 'view-form', 'method' => 'PATCH' ]) !!}
        <div class="row">
            <div class="col-sm-8">
                @include('backend.view.partials.field')
                @include('backend.view.partials.content')
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ trans('history.backend.recent_history') }}</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div><!-- /.box tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        {!! history()->renderEntity('view', $view->id) !!}
                    </div><!-- /.box-body -->
                </div>
            </div>
            <div class="col-sm-4">
                {{-- @include('backend.view.partials.image') --}}
                {{-- @include('backend.view.partials.seo') --}}
                @include('backend.view.partials.optional')
                @include('backend.view.partials.submit')
            </div>
        </div>  
    {!! Form::close() !!}
@endsection

