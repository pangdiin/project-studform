 <link href="{{ asset('css/dashboard_nav.css') }}" rel="stylesheet">
<header class="main-header">
    <nav class="navbar navbar-static-top" >
        <div class="container">
            <div class="navbar-header" >
                <a href="{{ route('frontend.index') }}" class="logo hidden-xs" id="image_logo_panel"  >
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini">
                       {{ substr(app_name(), 0, 1) }}
                    </span>

                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg">
                        <img src="{{ asset('logo.png') }}"  class="logo navbar-brand" id="image_logo" >
                    </span>
                </a>

                {{-- <button type="button" class="navbar-toggle collapsed" class="dropdown-toggle" data-toggle="dropdown" >
                    <i class="fa fa-bars"></i>
                </button> --}}
            </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu" id="dropdown" >
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu"  >
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" >
                            <div id="dropdown-menu">

                                <img src="{{ $logged_in_user->picture }}"  id="user-image"/>
                                <span class="dropdown-toggle-title hidden-xs" id="user-name" >{{ $logged_in_user->name }}</span>
                            </div>
                        </a>

                        <ul class="dropdown-menu">
                            <li class="user-header">
                                <img src="{{ $logged_in_user->picture }}" class="img-circle" alt="User Avatar"/>
                                <p>
                                    {{-- $logged_in_user->name }} - {{ implode(", ", $logged_in_user->roles->lists('name')->toArray()) --}}
                                    <small>{{ trans('strings.backend.general.member_since') }} {{ $logged_in_user->created_at->format("m/d/Y") }}</small><br/>
                                    <span >{{ $logged_in_user->name }}</span>
                                </p>
                            </li>

                        <li class="user-footer">
                            <div class="col-xs-4 text-center" >
                                <a href="{!! route('frontend.index') !!}" class="btn btn-default btn-flat">
                                    <i class="fa fa-home"></i>
                                    {{ trans('navs.general.home') }}
                                </a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="{!! route('frontend.user.account') !!}" class="btn btn-primary btn-flat blue-btn">
                                    <i class="fa fa-user"></i>
                                    Profile
                                </a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="{!! route('frontend.auth.logout') !!}" class="btn btn-danger btn-flat red-btn">
                                    <i class="fa fa-sign-out"></i>
                                    {{ trans('navs.general.logout') }}
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>

        </div>
    </nav>
</header>

