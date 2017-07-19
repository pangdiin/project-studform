@extends('frontend.layouts.app')
@section('meta_description', $page->meta)
@section('meta')
    <meta name="seo" content="{{ $page->seo }}">
@stop

@section('wide-banner')
    <div id="projMainHolder">
        <div class="container-fluid">
            <div class="bgGray"></div>
                <div class="container">
                    <div style="background: #fff;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-10">
                                    @forelse($brochures as $p => $brochure)
                                        <a href="{{ asset($brochure->path) }}" class="projLink">
                                          <div class="projHolder">
                                            <div class="projImgHolder">
                                              <img src="{{ asset($product->image) }}" width="100" height="200">
                                            </div>
                                            <div class="projDescHolder">
                                              <h4>{{ ucfirst($brochure->product->name) }}</h4>
                                            </div>
                                          </div>
                                        </a>
                                    @empty
                                        <div class="h2 text-center"><i>There are no brochures created yet.</i></div>
                                    @endforelse
                                    @if($brochures->count())
                                        <div class="text-center">
                                            {!! $brochures->links() !!}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-2">
                                    <a href="http://studform.dev/contactus">
                                      <div class="efHolder" style="position:relative;float:left;">
                                          <p style="font-family:sans-serif;">Enquiry Form</p>
                                      </div>
                                    </a>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

