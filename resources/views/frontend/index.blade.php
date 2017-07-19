@extends('frontend.layouts.app')
@section('meta_description', $page->meta)
@section('meta')
    <meta name="seo" content="{{ $page->seo }}">
@stop


@section('wide-banner')
<br>
<br>
<div class="section">
	<div class="jumbotron">
        <div class="container">
            <img class="hidden-medium-down" src="{{ asset($page->image) }}" style="width: 100%;height: auto;">
            <img class="show-in-medium-down" src="{{ asset($page->image) }}" style="width: 100%;height:250px;">
        </div>
    </div>
    <div class="container">
      @include('frontend.view.render.index')
    </div>
    
      @permission('manage-page')
        <div class="button-container" style="z-index: 1;">
            <a class="button" href="{{ route('admin.page.edit', $page) }}" >
                <div class="button-text" data-toggle="tooltip" title="Edit" data-placement="left">
                  <i class="fa fa-pencil"></i>
                </div>
            </a>
            <div class="button-outline"></div>
        </div>
      @endauth
</div>
@endsection
{{-- @section('content')
=======
@section('content')
>>>>>>> 82448512715a1643e5acc40c135eacbff718b840
	{!! $page->content !!}
@endsection --}}
