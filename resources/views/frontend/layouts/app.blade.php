<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', app_name())</title>

        <!-- Meta -->
        <meta name="description" content="@yield('meta_description', app_name())">
        <meta name="author" content="@yield('meta_author', app_name())">
        @yield('meta')

        <!-- Styles -->


        @yield('before-styles')
        <!-- Check if the language is set to RTL, so apply the RTL layouts -->
        <!-- Otherwise apply the normal LTR layouts -->
        @langRTL
            {{ Html::style(getRtlCss(mix('css/frontend.css'))) }}
        @else
            {{ Html::style(mix('css/frontend.css')) }}
        @endif

        <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>
        {{ Html::style(asset('js/slick/slick.css')) }}
        {{ Html::style(asset('js/slick/slick-theme.css')) }}
        {{ Html::style(asset('css/front.css')) }}
        {{ Html::style(asset('css/about_style.css')) }}
        {{ Html::style(asset('css/project_style.css')) }}
        {{ Html::style(asset('css/contacts_style.css')) }}
        {{ Html::style(asset('css/products_style.css')) }}
        <link rel="stylesheet" type="text/css" href="{{ asset('gallery/basic/source/jquery.fancybox.css?v=2.1.5') }}" media="screen" />

        @yield('after-styles')
        <!-- Scripts -->
        <script>
            window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token(),]); ?>
        </script>
        <script src='https://www.google.com/recaptcha/api.js'></script>

    </head>

    <body class="processing-page-load" id="app-layout" style="overflow-x: hidden;">
        <div class=" main-wrapper" style="opacity: 1;">    
            <div id="app">
                @include('includes.partials.logged-in-as')
                @include('frontend.includes.nav')

                <div class="wrapper">
                    <div class="container">
                    </div>
                    @yield('wide-banner')
                    @include('includes.partials.messages')
                    <div class="container">
                        @yield('content')
                    </div>
                </div><!-- container -->
            </div><!--#app-->
            @include('frontend.includes.footer')
            @unless(access()->guest())
            {{-- for desktop --}}
            <div class="admin_button-container">
                        <a class="admin_button" href="{{ route('admin.dashboard') }}">
                            <div class="admin_button-text" data-toggle="tooltip" title="Dashboard" data-placement="left">
                              <i class="fa fa-dashboard" ></i>
                            </div>
                        </a>
                <div class="admin_button-outline" ></div>
            </div>
            @endif
        </div>
        
        <!-- Scripts -->
        <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        {{-- <script src="//code.jquery.com/jquery-3.2.1.min.js"></script> --}}
        @yield('before-scripts')
        {!! Html::script(asset('js/plugin/sweetalert2.min.js')) !!}
        {!! Html::script(mix('js/frontend.js')) !!}
        {!! Html::script(asset('js/slick.js')) !!}
        {!! Html::script(asset('js/slick/slick.min.js')) !!}
        {!! Html::script(asset('js/helper.js')) !!}
        @yield('after-scripts')
        
        @include('includes.partials.ga')

        <script type="text/javascript" src=" {{ asset('gallery/basic/lib/jquery.mousewheel.pack.js?v=3.1.3') }} "></script>
        <script type="text/javascript" src=" {{ asset('gallery/basic/source/jquery.fancybox.pack.js?v=2.1.5') }} "></script>
        <style>
        .media{
            margin-top: 0;
        }
        #footer-items{
            cursor:pointer;
            font-size: 15px;
            color:white;
            font-family: Museo-500;
        }
        #footer-items:hover{
            text-decoration: none;
            font-weight: bold;
        }
        #frontend-content{
            /*width:55%;*/
            margin-top: 50px;
            position: relative;
            /*left:25%;*/
        }
        #frontend-footer{
            background-color: #bcbec0;
            font-family:Museo-500;
            font-size: 12px;
        }
        #copyright-text{
            color:white;
            position:relative;
            left: 52%;
            margin-top: 30px;
        }
        @media(max-width: 768px){ 
          #frontend-content{
            width:100%;
            left:10%;
          }
          #copyright-text{
            left: 10%;
            margin-top: 20px;
          }
        }
        #btnSubscribe {
            margin-top: 10px;
            border: 0 none;
            border-radius: 3px 3px 3px 3px;
            color: #000000;
            margin-top: 10px;
            padding: 3px;
            background-color: #e0e0e0;
            font-weight: bold;
            transition:0.3s;
        }
        #btnSubscribe:hover {
            box-shadow: 5px 5px 3px #888888;
        }
        </style>
      
        {{-- <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script type="text/javascript" src="js/slick/slick.min.js"></script> --}}
        @include('includes.partials.loader')
    </body>
    
</html>