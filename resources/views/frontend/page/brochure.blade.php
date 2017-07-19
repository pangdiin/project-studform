@extends('frontend.layouts.app')
@section('meta_description', $page->meta)
@section('meta')
    <meta name="seo" content="{{ $page->seo }}">
@stop

@section('wide-banner')
    <div class="jumbotron">
        <div class="container">
            <div class="ImgTagHolder hidden-xs"><img src="{{ asset($page->image) }}"></div>
            <div class="ImgTagHolder-mobile hidden-in-large"><img src="{{ asset($page->image) }}" width="100%" height="300px"></div>
          {{-- <div class="tlHolder">
              <div>
                <img src="http://studform.dev/uploads/brand/kwikloc.png">
              </div>
              <div>
                <p>Designed to enhance the image and environment of todays</p>
              </div>
            </div> --}}
        </div>
    </div>
    <div id="DescMainHolder">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-md-10 matchHeight" id="main-block">
                        @if($page->description)
                        <div class="prodHolder-block panel-body hidden-xs" style="position:relative;float: left;width: 404px;height: 184px; font-size: 18px;background-color: #78909c;">
                            {!! strip_tags($page->description) !!}
                        </div>
                        <div class="prodHolder-block panel-body hidden-in-large" style="position:relative;float: left;width: 100%;height: 234px; font-size: 18px;background-color: #78909c;">
                            {!! strip_tags($page->description) !!}
                        </div>
                        @endif
                        @if($page->thumbnail)
                        <div class="prodHolder-block hidden-xs" style="position:relative;float: left;width: 404px;background: red;height: 184px;">
                          <img src="{{ asset($page->thumbnail) }}" style="width: 100%;height: 100%;">
                        </div>
                        <div class="prodHolder-block hidden-in-large" style="position:relative;float: left;width: 100%;background: red;height: 184px;">
                          <img src="{{ asset($page->thumbnail) }}" style="width: 100%;height: 100%;">
                        </div>
                        @endif

                        <div class="proHolder-desc-block" style="font:18px sans-serif;padding-top: 20px;">
                            @permission('manage-page')
                                    <div role="tabpanel" class="tab-pane active" id="content">
                                        {!! $page->content !!}
                                    </div>
                                    <div class="button-container" style="z-index: 1;">
                                        <a class="button" href="{{ route('admin.page.edit', $page) }}">
                                            <div class="button-text">
                                              <i class="fa fa-pencil"></i>
                                            </div>
                                        </a>
                                    <div class="button-outline"></div>
                                </div>
                            @else
                                <hr/>
                                {!! $page->content !!}
                            @endauth

                        </div>
                        
                        @foreach($brochures as $brochure)
                            <div class="col-md-3 brochure">
                                <a href="{{ $brochure->fullPath }}" target="_blank" style="margin-top: 10px;">
                                    <img src="{{ $brochure->thumbnail() }}" style="width: 100%;">
                                </a>
                                <p style="margin-top: 10px;">{{ $brochure->product->brand->name }} {{ $brochure->product->name }}</p>
                            </div>
                        @endforeach

                    </div>

                    <div class="col-md-2 matchHeight">
                        <a href="http://studform.dev/contactus">
                          <div class="efHolder" style="position:relative;float:left;width: 100%;">
                              <p style="font-family:sans-serif;">Enquiry Form</p>
                          </div>
                        </a>
                    </div>
                </div>
                 
            </div>
        </div>
    </div>
    <br>
@append

@section('after-styles')

<style>
    .brochure {
        margin-top: 10px;
        padding: 0;
        padding-right: 5px;
    }
</style>

@append

@section('after-scripts')
    <script type="text/javascript">
        $('.matchHeight').matchHeight();
    </script>
@append

