@extends('backend.layouts.app')
@section ('title', 'Page Management')

@section('page-header')
    <h1>
        Page Management
        <small>Create Page</small>
    </h1>
@endsection

@section('content')

    {!! Form::open(['url' => route('admin.page.store'), 'file' => 'mutlipart/enctype', 'files' => true, 'id' => 'page-form' ]) !!}
        <div class="row">
            <div class="col-sm-8">
                @include('backend.page.partials.field')
                @include('backend.page.partials.seo')
            </div>
            <div class="col-sm-4">
                @include('backend.page.partials.image')
                @include('backend.page.partials.submit')
            </div>
        </div>  
    {!! Form::close() !!}
    
@endsection

