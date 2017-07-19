@extends('frontend.layouts.app')
@section('meta_description', $page->meta)
@section('meta')
    <meta name="seo" content="{{ $page->seo }}">
@stop

@section('wide-banner')
<div class="section">
	<div class="jumbotron">
            <div class="container">
                <img src="img/samplehome.jpg" style="width: 100%;height: auto;">
            </div>
        </div>
    <div class="container">
            <div class="col-sm-12" id="descHolder">
                <div class="col-sm-4">
                    <a href="http://studform.dev/about"><div class="descHoldertext">
                        <span style="font-family: sans-serif;">
                        <br><br>
                            Studform continually partner with the architectural and building sector to provide award winning modern spaces for people.
                            <br><br>
                            &gt; Learn More 
                        </span>
                    </div></a>
                </div>
                <div class="col-sm-4">
                    <div>
                        <a href="http://studform.dev/specified"><img src="img/samplespec.jpg"></a>
                    </div>
                </div>
                <div class="col-sm-3">
                   <a href="http://studform.dev/projects"><div class="descHoldertext">
                        <span style="font-family: sans-serif;">
                        <h4>Projects</h4>
                            We are proud to have been involved in many exciting and successful projects and developments.
                            <br><br>
                            &gt; Learn More 
                        </span>
                    </div></a>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="slick_carousel">
                <a href="#"><div><img src="img/slider-images/satellite1.jpg" >
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
                </div></a>
                <a href="#"><div><img src="img/slider-images/entrex1.jpg" >
                    <div class="col-sm-12">
                       <div class="col-sm-6">
                           <img src="img/slider-images/entrex.png" >
                       </div>
                       <div class="col-sm-6" id="bgTeal">
                           <div>
                           <h5>Entrex</h5>
                           <p>Entrex doors by Studform offer a cost effective solution to all PA door requirements</p>
                           <h4>>&nbspLearn More</h4>
                        </div>
                       </div>
                    </div>
                </div></a>
                <a href="#"><div><img src="img/slider-images/imaj1.jpg" >
                    <div class="col-sm-12">
                       <div class="col-sm-6">
                           <img src="img/slider-images/imaj.png" >
                       </div>
                       <div class="col-sm-6" id="bgTeal">
                           <div>
                           <h5>Imaj</h5>
                           <p>Studform continues to extend the boundaries with Imaj Washroom Partitions</p>
                           <h4>>&nbspLearn More</h4>
                        </div>
                       </div>
                    </div>
                </div></a>
                <a href="#"><div><img src="img/slider-images/kingdom1.jpg" >
                    <div class="col-sm-12">
                       <div class="col-sm-6">
                           <img src="img/slider-images/kingdom.png" >
                       </div>
                       <div class="col-sm-6" id="bgBlue">
                           <div>
                           <h5>Kingdom</h5>
                           <p>Kingdom Doors. Exacting craftsmanship</p>
                           <h4>>&nbspLearn More</h4>
                        </div>
                       </div>
                    </div>
                </div></a>
                <a href="#"><div><img src="img/slider-images/korporate1.jpg" >
                    <div class="col-sm-12">
                       <div class="col-sm-6">
                           <img src="img/slider-images/korporate.png" >
                       </div>
                       <div class="col-sm-6" id="bgBlue">
                           <div>
                           <h5>Korporate</h5>
                           <p>Designed to enhance the image and environment of today's office interior</p>
                           <h4>>&nbspLearn More</h4>
                        </div>
                       </div>
                    </div>
                </div></a>
                <a href="#"><div><img src="img/slider-images/accoulite1.jpg" >
                    <div class="col-sm-12">
                       <div class="col-sm-6">
                           <img src="img/slider-images/kwikloc.png" >
                       </div>
                       <div class="col-sm-6" id="bgBlue">
                           <div>
                           <h5>Kwikloc</h5>
                           <p>Build it outside the square with a Kwikloc ceiling</p>
                           <h4>>&nbspLearn More</h4>
                        </div>
                       </div>
                    </div>
                </div></a>
                <a href="#"><div><img src="img/slider-images/comet1.jpg" >
                    <div class="col-sm-12">
                       <div class="col-sm-6">
                           <img src="img/slider-images/comet.png" >
                       </div>
                       <div class="col-sm-6 test" id="bgRed">
                           <div>
                           <h5>Comet</h5>
                           <p>Comet Access hatches are a continuation of many years of quality under the kwikloc brand</p>
                           <h4>>&nbspLearn More</h4>
                        </div>
                       </div>
                    </div>
                </div></a>   
            </div>
        </div>

        <div class="container">
            <div class="col-sm-12" id="descHolder">
                <div class="col-sm-4">
                    <a href="#"><div class="certHoldertext">
                        <span>
                           
                        </span>
                    </div></a>
                </div>
                <div class="col-sm-4">
                    <a href="#"><div class="certHoldertext" >
                        <h4>GCE Certification</h4><h5>
                        <span style="font:15px sans-serif;padding-top: 10px;">
                            Our primary Ceiling Sections are manufactured from 100% recycled Aluminium greatly reducing the aggregate CO2 / Square Metre on contained product emissions for Ceiling Installations.
                            <br>
                            This is confirmation that our materials used to make our custom products have been carefully selected to ensure we are committed to lessening our impact on the environment.
                         
                        </span>
                    </h5></div>
                </a></div><a href="#">
                </a><div class="col-sm-3"><a href="#">
                   </a><a href="http://studform.dev/download"><div class="certHoldertextDL">
                        <span style="font-family: sans-serif;">
                            Download<br>
                            Product<br>
                            Materials
                        </span>
                    </div></a>
                </div>
            </div>
        </div>
</div>
@endsection
{{-- @section('content')
=======
@section('content')
>>>>>>> 82448512715a1643e5acc40c135eacbff718b840
	{!! $page->content !!}
@endsection --}}
