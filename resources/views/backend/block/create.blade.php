@extends('backend.layouts.app')
@section ('title', 'Block Management')

@section('page-header')
    <h1>
        Block Management
        <small>Create Block</small>
    </h1>
@endsection

@section('content')

    {!! Form::open(['url' => route('admin.block.store'), 'file' => 'mutlipart/enctype', 'files' => true, 'id' => 'block-form' ]) !!}
        <div class="row">
            <div class="col-sm-8 col-sm-push-2">
                @include('backend.block.partials.field')
                @include('backend.block.partials.submit')
            </div>
        </div>  
    {!! Form::close() !!}
    
@endsection

