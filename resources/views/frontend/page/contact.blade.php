@extends('frontend.layouts.app')

@section('wide-banner')
    <div class="jumbotron">
      <div class="container" >
        <div class="ImgTagHolder hidden-medium-down">
          <img src="{{ asset($page->image) }}" style="margin-top: 180px;">
        </div>
        <div class="ImgTagHolder show-in-medium-down">
          <img src="{{ asset($page->image) }}" style="height: 300px;">
        </div>
        <div class="tlHolderContact hidden-medium-down">
            <div class="paragHolder">
            	<p style="font-family:Museo-300">{!! strip_tags($page->description) !!}</p>
            </div>
        </div>
        <div class="tlHolderContact show-in-medium-down" style="width: 100%;">
            <div class="paragHolder">
              <p style="font-family:Museo-300">{!! strip_tags($page->description) !!}</p>
            </div>
        </div>
      </div>
    </div>
    <div id="ContactMainHolder" style="background-color:white;font-family: Arial; ">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-5">
              <div class="contact-details">
               @unless(access()->guest())
                  @permission('manage-page')
                    <div class="row">
                      <div role="tabpanel" style="font-family:Museo-300" >
                          <ul class="nav nav-tabs" role="tablist">
                              <li role="presentation" class="active">
                                  <a href="#content" aria-controls="content" role="tab" data-toggle="tab"><i class="fa fa-search"></i> View</a>
                              </li>
                              <li role="presentation">
                                  <div class="button-container" style="z-index: 1;">
                                      <a class="button" href="{{ route('admin.page.edit', $page) }}">
                                          <div class="button-text" data-toggle="tooltip" title="Edit" data-placement="left">
                                            <i class="fa fa-pencil"></i>
                                          </div>
                                      </a>
                                  <div class="button-outline"></div>
                              </li>
                              @permission('manage-inquiry')
                              <li role="presentation">
                                  <a href="{{ route('admin.inquiry.index') }}"><i class="fa fa-wpforms"></i> Enquiries </a>
                              </li>
                              @endauth
                          </ul>
                          <div class="tab-content">
                              <div role="tabpanel" class="tab-pane active" id="content" style="font-family: Museo-300 !important;">
                                  {!! $page->content !!}
                              </div>
                          </div>
                      </div>
                    </div>
                  @else
                      <hr/>
                      {!! $page->content !!}
                  @endauth
              @else
                  <hr/>
                  {!! $page->content !!}
              @endif
              </div>
            </div>
            <div class="col-md-7">
              @include('frontend.includes.components.inquiry')
                
              
            </div>
          </div>
        </div>  
      </div>
    </div>
@endsection