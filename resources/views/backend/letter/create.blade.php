@extends('backend.layouts.app')
@section ('title', 'Letter Management')

@section('page-header')
    <h1>
        Letter Management
        <small>Create Product</small>
    </h1>
@endsection

@section('content')
    <div class="row">
         <form action="{{ route('admin.letter.store') }}" method="POST" enctype="multipart/form-data" id="letter-form">
            {{ csrf_field() }}
            <div class="col-sm-10">
                @include('backend.letter.partials.fields')
            </div>
            <div class="col-sm-2">
                @include('backend.letter.partials.submit')
            </div>
        </form>
    </div>
@endsection

@section('after-scripts')
    {{-- @include('backend.product.script.dropzone') --}}
@endsection