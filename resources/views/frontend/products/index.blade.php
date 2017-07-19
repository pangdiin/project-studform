@extends('frontend.layouts.app')
@section('meta_description', $page->meta)
@section('meta')
    <meta name="seo" content="{{ $page->seo }}">
@stop

@section('wide-banner')
      <div class="jumbotron">
        <div class="container">
          <div class="ImgTagHolder">
            <img src="http://studform.dev/uploads/product/allum.kwikloc.jpg">
          </div>
          <div class="tlHolder">
              <div>
                <img src="http://studform.dev/uploads/brand/kwikloc.png">
              </div>
              <div>
                <p>Designed to enhance the image and environment of todays</p>
              </div>
            </div>
        </div>
      </div>
      <div id="DescMainHolder">
        <div class="container">
          <div class="row">
            <div class="col-md-12">

              <div class="col-md-10" id="main-block">
                <div class="prodHolder-block" style="position:relative;float: left;width: 404px;height: 184px;">
                  <p style="font-size: 16px;">Clients in the construction market consistently benefit from the flexibility and leading designs of Kwikloc ceilings. Ranging from simple exposed aluminium grid to custom made mitred-top-hat ceilings, there is a Kwikloc package to suit your project.</p>
                </div>
                <div class="prodHolder-block" style="position:relative;float: left;width: 404px;background: red;height: 184px;">
                  <img src="http://studform.dev/uploads/product/allum.kwikloc_head.jpg" style="width: 100%;height: 100%;">
                </div>

                <div class="proHolder-desc-block" style="font:18px sans-serif;padding-top: 20px;">
                  
                    
              Kwikloc was born around 20 years ago with the launch of the popular ‘regal’ and ‘premium’ Aluminium grid systems. These systems both feature a unique engineered locking system which offers installers flexibility and speed, and clients a premium finish.

              The trend continued with the launch in 2004 of the Corporate series Mitred Tophat Aluminium grid, which quickly gained wide market acceptance as a quality system for modular and one way exposed grid architectural ceilings.

              From these foundations the kwikloc name has expanded and now includes metal pan tiles, custom extrusion design, and complete ceiling packages including HVAC and Light diffusers.

              Kwikloc - A developers dream.

              Kwikloc Aluminium grid and AMF ceiling tiles – a winning combination
              
              A close partnership with ceiling tile manufacturer AMF from Germany, allows Studform the ability to tick all the boxes when providing a ceiling to your project requirements.

              AMF THERMATEX is a range of innovative, high performance, acoustic tiles for grid ceilings. The tiles are made from new generation, high density, bio-soluble mineral wool, clay and starch. AMF THERMATEX tiles offer superior acoustic performance and their high density mineral core provides excellent fire resistance
                

                              <a href="http://studform.dev/alluminium-ceilings/specification/kwikloc">Architectural Specifications</a>
                          <br>

                        </div>

                  
              </div>  

              <div class="col-md-2" id="main-block">
                <a href="http://studform.dev/contactus">
                  <div class="efHolder" style="position:relative;float:left;">
                      <p style="font-family:sans-serif;">Enquiry Form</p>
                  </div>
                </a>

               

                <!--Brochures -->
            
                        </div>
            </div>
          </div>  
           <div id="product-gallery" style="display: none">
                    </div>
        </div>
      </div>
@endsection