@extends('backend.layouts.app')
@section ('title', 'Project Management')

@section('page-header')
    <h1>
        Project Management
        <small>Create Project</small>
    </h1>
@endsection

@section('content')

    {!! Form::open(['url' => route('admin.project.store'), 'file' => 'mutlipart/enctype', 'files' => true, 'id' => 'page-form' ]) !!}
        <div class="row">
            <div class="col-sm-8">
                @include('backend.project.partials.field')
            </div>
            <div class="col-sm-4">
                @include('backend.project.partials.image')
                @include('backend.project.partials.submit')
            </div>
        </div>  
    {!! Form::close() !!}
    
@endsection

