@extends('frontend.layouts.app')
@section('meta_description', $page->meta)
@section('meta')
    <meta name="seo" content="{{ $page->seo }}">
@stop

@section('wide-banner')
    <div class="jumbotron">
        <div class="container">
            <div class="ImgTagHolder hidden-medium-down"><img src="{{ asset($page->image) }}" style="margin-top: 100px;"></div>
            <div class="ImgTagHolder-mobile show-in-medium-down"><img src="{{ asset($page->image) }}" style="margin-top: 50px;" width="100%" height="200px"></div>
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
                        <div class="prodHolder-block panel-body hidden-xs" style="font-family:Museo-300;position:relative;float: left;width: 404px;height: 184px; font-size: 18px;background-color: #78909c;">
                            {!! strip_tags($page->description) !!}
                        </div>
                        <div class="prodHolder-block panel-body hidden-in-large" style="font-family:Museo-300;position:relative;float: left;width: 100%;height: 234px; font-size: 18px;background-color: #78909c;">
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
                        <b>&nbsp;</b>
                        <div class="proHolder-desc-block" style="font:18px Museo-500;padding-top: 20px;">
                            @permission('manage-page')
                                    <div role="tabpanel" class="tab-pane active" id="content">
                                        {!! $page->content !!}

                                    </div>
                                    <div class="button-container" style="z-index: 1;">
                                        <a class="button" href="{{ route('admin.page.edit', $page) }}">
                                            <div class="button-text" data-toggle="tooltip" title="Edit" data-placement="left">
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
                    </div>
                    <div class="col-md-2 matchHeight">
                        <a href="http://studform.dev/contactus">
                          <div class="efHolder" style="position:relative;float:left;width: 100%;">
                              <p style="font-family:Museo-500;">Enquiry Form</p>
                          </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
@append


@section('after-scripts')
    <script type="text/javascript">
        $('.matchHeight').matchHeight();
    </script>
@append


