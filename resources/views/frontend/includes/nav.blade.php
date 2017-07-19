<div class="header" id="header-overlay">
    <div class="container">
        <div class="row" style="background: #fafafa;">
            <div class="col-sm-12" >
                <div class="col-sm-3">
                    <a href="/"><img src="{{ asset('logo.png') }}" class="imgLogo hidden-medium-down" style="width: auto;height: auto;"></a>
                    <a href="/"><img src="{{ asset('logo.png') }}" class="imgLogo show-in-medium-down" style="position:absolute;left:-10px;top:-10px;height: 40px;width: auto;z-index: 1;"></a>
                </div>
                <div class="col-sm-9">
                    <nav class="navbar navbar-default" role="navigation">
                        <div class="mainheaderInfoHolder" style="background: #fafafa;">
                            <div class="headerInfoHolder" style="background: #fafafa;">
                              @permission('manage-menu')
                                <div class="quick-link-container">
                                  <div class="quick-links">
                                      <a href="{{ route('admin.setting.show', 'account') }}" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="bottom" title="Edit"></i></a>
                                  </div>
                                  <div class="blurred">
                                    <table class="hidden-xs">

                                      <tbody><tr>
                                        <td class="tdSpace" style="background: #fafafa;"></td>
                                        <td>
                                          <ul class="headerInfo" style="background: #fafafa;">
                                            <li class="contactNo" style="font-family:Museo-500;font-size:20px;text-align: right;">
                                                {{ setting()->key('telephone') }}
                                            </li>
                                            <li class="address" style="font-family:Museo-500;font-size:20px;">
                                                {{ strtoupper(setting()->key('address')) }}
                                            </li>
                                          </ul>
                                        </td>
                                      </tr>
                                    </tbody></table>
                                  </div>
                                </div>
                              @else
                               <table class="hidden-xs">
                                  <tbody><tr>
                                    <td class="tdSpace" style="background: #fafafa;"></td>
                                    <td>
                                      <ul class="headerInfo" style="background: #fafafa;">
                                        <li class="contactNo" style="font-family:Museo-500;font-size:20px;text-align: right;">
                                            {{ setting()->key('telephone') }}
                                        </li>
                                        <li class="address" style="font-family:Museo-500;font-size:20px;">
                                            {{ strtoupper(setting()->key('address')) }}
                                        </li>
                                      </ul>
                                    </td>
                                  </tr>
                                </tbody></table>
                              @endauth
                            </div> 
                            <div class="navbar-header" style="background: #fafafa;">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-container">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                               </button>
                            </div>
                            
                            
                            <div class="collapse navbar-collapse navbar-exl-collapse" id="navbar-container" style="background: #fafafa;">
                                            
                                    {{-- <ul id="menuList" class="nav navbar-nav"> --}}
                                        @include('frontend.menu.partials.list', ['menus' => $menu_top_center, 'type' => 'dropdown', 'style' => 'background: #fafafa;'])
                                    {{-- </ul> --}}

                                  {{--   <li><a href="{{ route('frontend.index') }}">Home</a></li>
                                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle" id="about-page">About <b class="caret" style="display: none;"></b></a>
                                        <ul class="dropdown-menu" id="dropdownList">
                                            <li><a href="{{ route('frontend.about_us') }}">Page Name</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle brand-navigation">Products<b class="caret" style="display: none;"></b></a>
                                        <ul class="dropdown-menu" id="dropdownList">
                                          
                                                                                      <li><a href="{{ route('frontend.products') }}">Product Names</a></li>
                                          
                                        </ul>
                                    </li>
                                     <li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle brand-navigation">Products by Brand <b class="caret" style="display: none;"></b></a>
                                        <ul class="dropdown-menu" id="dropdownList">
      
                                                                                      <li><a href="{{ route('frontend.brands') }}">Brand Names</a></li>
                                                                       
                                     
                                        </ul>
                                    </li>
                                    <li><a href="{{ route('frontend.projects') }}">Projects</a></li>
                                    <li><a href="{{ route('frontend.contact_us') }}">Contact</a></li> --}}
                                   
                                {{-- </ul> --}}
                            </div>
                          </div>
                      </nav>            
                  </div>
              </div>
          </div>
      </div> 
  </div>

