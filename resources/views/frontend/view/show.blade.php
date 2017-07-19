@extends('frontend.layouts.app')

@section('wide-banner')
    <div class="jumbotron">
        <div class="container">
            <div class="ImgTagHolder hidden-xs"><img src="{{ asset($item->image) }}"></div>
            <div class="ImgTagHolder hidden-in-large"><img src="{{ asset($item->image) }}" style="height: 400px;"></div>
          <div class="tlHolder hidden-xs">
              <div class="panel-body">
                <p>{{ $item->description }}</p>
              </div>
            </div>
        </div>
        <div class="tlHolder hidden-in-large" style="width: 100%;">
              <div class="panel-body">
                <p>{{ $item->description }}</p>
              </div>
            </div>
        </div>
    </div>
    <div id="DescMainHolder">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-md-10 matchHeight" id="main-block">
                        @unless(access()->guest())
                            @permission('manage-item')
                                <div id="content">
                                    <div class="proHolder-desc-block" style="font:18px sans-serif;padding-top: 20px;">
                                        {!! $item->content !!}
                                    </div>
                                </div>
                                <div class="button-container">
                                    <a class="button" href="{{ route('admin.project.edit', $item) }}">
                                        <div class="button-text">
                                          <i class="fa fa-pencil"></i>
                                        </div>
                                    </a>
                                    <div class="button-outline"></div>
                                </div>
                            @else
                                <hr/>
                                <div class="proHolder-desc-block" style="font:18px sans-serif;padding-top: 20px;">
                                    {!! $item->content !!}
                                </div>
                            @endauth
                        @else
                            <hr/>
                            <div class="proHolder-desc-block" style="font:18px sans-serif;padding-top: 20px;">
                                {!! $item->content !!}
                            </div>
                        @endif
                        
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
@append


@section('after-scripts')
    <script type="text/javascript">
        $('.matchHeight').matchHeight();
    </script>

    

@append


