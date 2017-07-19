
@extends('frontend.layouts.app')

@section('wide-banner')
    <div class="jumbotron">
        <div class="container">
            <div class="ImgTagHolder hidden-medium-down"><img src="{{ asset($project->image) }}"></div>
            <div class="ImgTagHolder show-in-medium-down"><img src="{{ asset($project->image) }}" style="height: 400px;"></div>
          <div class="tlHolder-project hidden-medium-down">
              <div class="panel-body">
                <p>{{ $project->description }}</p>
              </div>
            </div>
        </div>
        <div class="tlHolder-project show-in-medium-down" style="width: 100%;">
              <div class="panel-body">
                <p>{{ $project->description }}</p>
              </div>
            </div>
        </div>
    </div>
    <div id="DescMainHolder">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-md-10 matchHeight" id="main-block">
                        <span class="altenative_break_line">&nbsp;</span>
                        @unless(access()->guest())
                            @permission('manage-project')
                                <div id="content">
                                    <div class="proHolder-desc-block" style="font-family:Museo-500;font-size:18px;padding-top: 20px;">
                                        {!! $project->content !!}
                                    </div>
                                </div>
                                <div class="button-container" style="z-index: 1;">
                                    <a class="button" href="{{ route('admin.project.edit', $project) }}">
                                        <div class="button-text" data-toggle="tooltip" title="Edit" data-placement="left">
                                          <i class="fa fa-pencil"></i>
                                        </div>
                                    </a>
                                    <div class="button-outline"></div>
                                </div>
                            @else
                                
                                <div class="proHolder-desc-block" style="font-family:Museo-500;font-size:18px;padding-top: 20px;">
                                    {!! $project->content !!}
                                </div>
                            @endauth
                        @else
                            
                            <div class="proHolder-desc-block" style="font-family:Museo-500;font-size:18px;padding-top: 20px;">
                                {!! $project->content !!}
                            </div>
                        @endif
                    </div>
                    <div class="col-md-2 matchHeight">
                        <a href="/contact-us">
                          <div class="efHolder" style="position:relative;float:left;width: 100%;">
                              <p style="font-family:Museo-500;">Enquiry Form</p>
                          </div>
                        </a>

                        @if($project->galleries->count())
                            @foreach($project->galleries as $gallery)
                                @if($loop->first)
                                    <img src="{{ $gallery->full_path }}" class="img-responsive" style="height: 100%; max-height: 194px;">
                                @endif
                            @endforeach

                             <a href="#" class="launch-fancybox" style="text-decoration: none;">
                                <div class="igHolder">
                                  <p style="font-family:Museo-500;">Image Gallery</p>
                                </div>
                              </a>

                            <!-- Fancy box -->
                              <div style="display: none">
                                @foreach($project->galleries as $gallery)
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


@section('after-scripts')

<script type="text/javascript" src=" {{ asset('gallery/basic/lib/jquery.mousewheel.pack.js?v=3.1.3') }} "></script>
<script type="text/javascript" src=" {{ asset('gallery/basic/source/jquery.fancybox.pack.js?v=2.1.5') }} "></script>

<script type="text/javascript">
    $('.matchHeight').matchHeight();

    $('.launch-fancybox').on('click', function() {
        $.fancybox($('a.fancybox'));
    });
</script>
@endsection


