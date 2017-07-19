@extends('backend.layouts.app')
@section ('title', 'Product Management')

@section('page-header')
    <h1>
        Product Management
        <small>Create Product</small>
    </h1>
@endsection

@section('content')
    <div class="row">
         <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data" id="product-form">
            {{ csrf_field() }}
            <div class="col-sm-8">
                @include('backend.product.partials.fields')
            </div>
            <div class="col-sm-4">
                @include('backend.product.partials.images')
                @include('backend.product.partials.submit')
            </div>
        </form>
    </div>
@endsection

@section('after-scripts')
    {{-- @include('backend.product.script.dropzone') --}}
@endsection