@extends('frontend.layouts.app')

@section('wide-banner')
    <div id="projMainHolder">
        <div class="container-fluid">
            <div class="bgGray hidden-medium-down" style="margin-top: -9px;"></div>
            <div class="bgGray show-in-medium-down" style="margin-top: -55px;"></div>
                <div class="container">
                    <div style="background: #fff;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-10">
                                    <div class="product_card">
                                    @forelse($products as $p => $product)
                                        {{-- <a href="{{ route('frontend.product.show', $product) }}" class="projLink">
                                          <div class="projHolder">
                                            <div class="projImgHolder">
                                              <img src="{{ asset($product->image) }}" width="100" height="200">
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="col-sm-6">
                                                   <img src="img/slider-images/satellite.png" >
                                                </div>
                                                <div class="col-sm-6">
                                                  <h4>{{ ucfirst($product->name) }}</h4>
                                                  <p>&gt; Learn More</p>
                                                </div>
                                            </div>
                                          </div>
                                        </a> --}}
                                        <a class="product_card hidden-medium-down" href="{{ route('frontend.product.show', $product) }}">
                                            <div>
                                                <img src="{{ asset($product->image) }}" >
                                                <div class="col-sm-12">
                                                    <div class="col-sm-6">
                                                       <img src="{{ asset($product->brand->image) }}" >
                                                    </div>
                                                <div class="col-sm-6" id="bgTeal">
                                                   <div>
                                                       <h5>{{ ucfirst($product->name) }}</h5>
                                                       <h5>{{ ucfirst($product->description) }}</h5>
                                                       <h4 style="font-family: Museo-500;">>&nbspLearn More</h4>
                                                    </div>
                                                   </div>
                                                </div>
                                            </div>
                                        </a>

                                    <a class="product_card show-in-medium-down" href="{{ route('frontend.product.show', $product) }}" style="color:white;background: #008c97;">
                                        <div>
                                            <img src="{{ asset($product->image) }}" style="width: 100.2%;margin-left: -0.5px;filter: grayscale(0);">
                                            <div class="col-sm-12" style="width: 100%;">
                                                <div class="col-sm-6 hidden-medium-down">
                                                   <img src="{{ asset($product->brand->image) }}" >
                                                </div>
                                                <div class="col-sm-6" id="bgTeal">
                                                   <div class="description-mobile">
                                                       <b style="font-weight: bold">{{ ucfirst($product->name) }}</b><br>
                                                       <br>
                                                       {{ ucfirst($product->description) }}
                                                       <br><br>
                                                       <span style="font-family:Museo-500;">&nbspLearn More</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>                                   
                                    @empty
                                        <div class="h2 text-center"><i>There are no products created yet.</i></div>
                                    @endforelse
                                    
                                          {{-- <a href="#" style="text-decoration: none;width: 395px;float: left;margin-right: 1px;margin-bottom: 1px;">
                                            <div>
                                                <img src="img/slider-images/satellite1.jpg" style="width: 100%;">
                                                <div class="col-sm-12">
                                                    <div class="col-sm-6">
                                                       <img src="img/slider-images/satellite.png" >
                                                    </div>
                                                <div class="col-sm-6" id="bgTeal">
                                                   <div>
                                                       <h5>Satellite</h5>
                                                          <p>Expand your horizons, open a satellite door</p>
                                                       <h4>>&nbspLearn More</h4>
                                                    </div>
                                                   </div>
                                                </div>
                                            </div>
                                          </a> --}}
                                    </div>
                                    @if($products->count())
                                    <div class="col-sm-12">
                                        <div class="text-center">
                                            {!! $products->links() !!}
                                        </div>
                                    </div>
                                    @endif

                                </div>
                                <div class="col-md-2">
                                    <a href="contact-us">
                                      <div class="efHolder" >
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
    
@endsection

