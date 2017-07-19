@extends('backend.layouts.app')
@section ('title', 'View Management')

@section('page-header')
    <h1>
        View Management
        <small>Create View</small>
    </h1>
@endsection

@section('content')

    {!! Form::open(['url' => route('admin.view.store'), 'file' => 'mutlipart/enctype', 'files' => true, 'id' => 'view-form' ]) !!}
        <div class="row">
            <div class="col-sm-8">
                @include('backend.view.partials.field')
                @include('backend.view.partials.content')
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

