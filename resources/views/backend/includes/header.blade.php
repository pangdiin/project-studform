<header class="main-header"+>

    <a href="{{ route('frontend.index') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
           {{ substr(app_name(), 0, 1) }}
        </span>

        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
            {{ app_name() }}
        </span>
    </a>

    <nav class="navbar navbar-static-top" role="navigation" id="navbar_Profile">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">{{ trans('labels.general.toggle_navigation') }}</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                @if (config('locale.status') && count(config('locale.languages')) > 1)
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <i class="fa fa-language"></i> {{ trans('menus.language-picker.language') }} <span class="caret"></span>
                        </a>
                        @include('includes.partials.lang')
                    </li>
                @endif

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ $logged_in_user->picture }}" class="user-image" alt="User Avatar"/>
                        <span class="hidden-xs">{{ $logged_in_user->name }}</span>
                    </a>

                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="{{ $logged_in_user->picture }}" class="img-circle" alt="User Avatar" />
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
                                <a href="{!! route('frontend.user.account') !!}" class="btn btn-primary btn-flat">
                                    <i class="fa fa-user"></i>
                                    Profile
                                </a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="{!! route('frontend.auth.logout') !!}" class="btn btn-danger btn-flat">
                                    <i class="fa fa-sign-out"></i>
                                    {{ trans('navs.general.logout') }}
                                </a>
                            </div>
                        </li>

                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-custom-menu -->
    </nav>
</header>
