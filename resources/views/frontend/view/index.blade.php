@extends('frontend.layouts.app')
@section('wide-banner')
    <div id="projMainHolder">
        <div class="container-fluid">
            <div class="bgGray hidden-xs" style="margin-top: -10px;"></div>
            <div class="bgGray hidden-lg" style="margin-top: -55px;"></div>
                <div class="container">
                    <div style="background: #fff;">
                        <div class="row">
                            <div class="col-md-12" >
                                <div class="col-md-10">
                                  @include('frontend.view.template.' . $view->template)
                                </div>
                                <div class="col-md-2">
                                    <a href="http://studform.dev/contactus" style="width: 100%;">
                                      <div class="efHolder" style="position:relative;float:left;width: 100%;">
                                          <p style="font-family:Museo-300;">Enquiry Form</p>
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