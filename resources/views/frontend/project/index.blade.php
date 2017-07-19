@extends('frontend.layouts.app')
@section('meta_description', $page->meta)
@section('meta')
    <meta name="seo" content="{{ $page->seo }}">
@stop

@section('wide-banner')
    <div id="projMainHolder">
        <div class="container-fluid">
            <div class="bgGray hidden-medium-down" style="margin-top: -9px;"></div>
            <div class="bgGray show-in-medium-down" style="margin-top: -55px;"></div>
                <div class="container">
                    <div style="background: #fff;">
                        <div class="row">
                            <div class="col-md-12" >
                                <div class="col-md-10">
                                    @forelse($projects as $p => $project)
                                        <a href="{{ route('frontend.project.show', $project) }}" class="projLink">
                                          <div class="projHolder" >
                                            <div class="projImgHolder">
                                              <img src="{{ asset($project->image) }}" width="100" height="200">
                                            </div>
                                            <div class="projDescHolder">
                                              <h4 class="hidden-medium-down" style="font-family:Museo-300;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;width: 23em; ">{{ ucfirst($project->name) }}</h4>
                                              <h4 class="show-in-medium-down" style="font-family:Museo-300;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;width: 13em; ">{{ ucfirst($project->name) }}</h4>
                                              <p style="height:80px;font-family:Museo-300;">{!! desc_limit($project->content) !!}</p>
                                              <p class="hidden-medium-down" style="font-family:Museo-500;" >&gt; Learn More</p>
                                            </div>
                                          </div>
                                        </a>
                                    @empty
                                        <div class="h2 text-center"><i>There are no projects created yet.</i></div>
                                    @endforelse
                                    @if($projects->count())
                                    <div class="col-sm-12">
                                        <div class="text-center">
                                            {!! $projects->links() !!}
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="col-md-2" >
                                    <a href="contact-us"  style="width: 100% !important;background-color: red !important;">
                                      <div class="efHolder" style="position: relative; float: left;">
                                          <p style="font-family:Museo-500;">Enquiry Form</p>
                                      </div>
                                    </a>
                                </div>
                            </div>  
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>

    </div>
    {{-- @permission('manage-page')
        <div class="button-container">
            <a class="button" href="{{ route('admin.page.edit', $page) }}">
                <div class="button-text" data-toggle="tooltip" title="Edit" data-placement="left">
                  <i class="fa fa-pencil"></i>
                </div>
            </a>
            <div class="button-outline"></div>
        </div>
      @endauth --}}
@endsection