@extends('backend.layouts.app')
@section ('title', 'Pages')

@section('page-header')
    <h1>
        Pages
        <small>Edit Page</small>
    </h1>
@endsection

@section('content')
   {!! Form::open(['url' => route('admin.page.update', $page), 'file' => 'mutlipart/enctype', 'files' => true, 'id' => 'page-form', 'method' => 'PATCH' ]) !!}
        <div class="row">
            <div class="col-sm-8">
                @include('backend.page.partials.field')
                @include('backend.page.partials.seo')
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ trans('history.backend.recent_history') }}</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div><!-- /.box tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        {!! history()->renderEntity('Page', $page->id) !!}
                    </div><!-- /.box-body -->
                </div>
            </div>
            <div class="col-sm-4">
                @include('backend.page.partials.image')
                @include('backend.page.partials.submit')
            </div>
        </div>  
    {!! Form::close() !!}
@endsection

