@extends('frontend.layouts.app')
@section('wide-banner')
    <div class="jumbotron">
        <div class="container">
            <div class="ImgTagHolder hidden-medium-down"><img src="{{ asset($product->imagePath) }}"></div>
            <div class="ImgTagHolder show-in-medium-down"><img src="{{ asset($product->imagePath) }}" style="width: 100%;height: 256px;"></div>
            @if($product->brand)
            <div class="tlHolder hidden-medium-down">
                <div>
                    <img src="{{ asset($product->brand->image) }}">
                </div>
                <div>
                    <p>{!! strip_tags($product->brand->description) !!}</p>
                </div>
            </div>
            {{-- for mobile and laptop --}}
            <div class="tlHolder show-in-medium-down" style="width: 100%;height: 180px;">
                <div>
                    <img src="{{ asset($product->brand->image) }}">
                </div>
                <div>
                    <p>{!! strip_tags($product->brand->description) !!}</p>
                </div>
            </div>
            @endif
        </div>
    </div>

    <div id="DescMainHolder">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-md-10 matchHeight" id="main-block">
                        @if($product->description)
                        {{-- for desktop and laptop --}}
                        <div class="prodHolder-block hidden-medium-down" style="font-family:Museo-300;position:relative;float: left;height: 184px;background-color: #78909c;">
                            <p>{!! strip_tags($product->description) !!}</p>
                        </div>

                        {{-- for mobile and tablet --}}
                        <div class="prodHolder-block show-in-medium-down" style="font-family:Museo-300;position:relative;float: left;height: 184px; width:100%;background-color: #78909c;">
                            <p>{!! strip_tags($product->description) !!}</p>
                        </div>
                        @endif

                        @if($product->thumbnail)
                        <div class="prodHolder-block hidden-medium-down" style="position:relative;float: left;width: 404px;background: red;height: 184px;">
                          <img src="{{ asset($product->thumbnailPath) }}" style="width: 100%;height: 100%;">
                        </div>
                        <div class="prodHolder-block show-in-medium-down" style="position:relative;float: left;width: 100%;background: red;height: 184px;">
                          <img src="{{ asset($product->thumbnailPath) }}" style="width: 100%;height: 100%;">
                        </div>

                        @endif
                        <span class="altenative_break_line">&nbsp;</span>
                        @unless(access()->guest())
                            @permission('manage-product')

                                
                                <div id="content">
                                    <div class="proHolder-desc-block" style="font:18px Museo-500;padding-top: 20px;">
                                        {!! $product->content !!}
                                    </div>
                                </div>
                                
                                <div class="button-container" style="z-index: 1;">
                                    <a class="button" href="{{ route('admin.product.edit', $product) }}">
                                        <div class="button-text" data-toggle="tooltip" title="Edit" data-placement="left">
                                          <i class="fa fa-pencil"></i>
                                        </div>
                                    </a>
                                    <div class="button-outline"></div>
                                </div>
                            @else
                                
                                <div class="proHolder-desc-block" style="font:18px Museo-500;padding-top: 20px;">
                                    {!! $product->content !!}
                                </div>
                            @endauth
                        @else
                            
                            <div class="proHolder-desc-block" style="font:18px Museo-500;padding-top: 20px;">
                                {!! $product->content !!}
                            </div>
                        @endif
                        
                    </div>
                    <div class="col-md-2 matchHeight">
                        <a href="/contact-us" style="z-index: -1;">
                          <div class="efHolder" style="position:relative;float:left; width: 100%;background-color: #78909c;">
                              <p style="font-family:Museo-500;">Enquiry Form</p>
                          </div>
                        </a>
                        @if($product->brochures->count())
                            <img src="{{ $product->brochures->first()->thumbnail() }}" class="img-responsive" style="height: 100%; max-height: 194px;">
                            <a href="{{ $product->brochures->first()->full_path }}" target="_blank" name="btn_brochure" class="btn-block">
                              <div class="dbHolder" style="position:relative;float:left; width: 100%;" >
                                  <p style="font-family:Museo-500;">Download Brochure</p>
                              </div>
                            </a>
                        @endif
                        
                        @if($product->galleries->count())
                            @foreach($product->galleries as $gallery)
                                @if($loop->first)
                                    <img src="{{ $gallery->full_path }}" class="img-responsive" style="height: 100%; max-height: 194px;width: 100%;">
                                @endif
                            @endforeach

                            <a href="#" class="launch-fancybox" style="text-decoration: none;">
                                <div class="igHolder">
                                  <p style="font-family:Museo-500;">Image Gallery</p>
                                </div>
                            </a>

                            <!-- Fancy box -->
                              <div style="display: none">
                                @foreach($product->galleries as $gallery)
                                  <a class="fancybox" href="{{ $gallery->full_path }}" data-fancybox-group="gallery">
                                    <img src="{{ $gallery->full_path }}" class="img-responsive" style="height: 100%; max-height: 194px;">
                                  </a>
                                @endforeach
                              </div>
                            <!--End Fancy box -->
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
@append

<script type="text/javascript" src=" {{ asset('gallery/basic/lib/jquery.mousewheel.pack.js?v=3.1.3') }} "></script>
<script type="text/javascript" src=" {{ asset('gallery/basic/source/jquery.fancybox.pack.js?v=2.1.5') }} "></script>


@section('after-scripts')
<script type="text/javascript">
    $('.matchHeight').matchHeight();

    $('.launch-fancybox').on('click', function() {
        $.fancybox($('a.fancybox'));
    }); 
</script>
@append
