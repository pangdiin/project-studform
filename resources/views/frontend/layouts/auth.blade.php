<!doctype html>
<html class="no-js" lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', app_name())</title>

        <!-- Meta -->
        <meta name="description" content="@yield('meta_description', 'Default Description')">
        <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">
        @yield('meta')

        <!-- Styles -->
        @yield('before-styles')
        
        <!-- Check if the language is set to RTL, so apply the RTL layouts -->
        <!-- Otherwise apply the normal LTR layouts -->
        @langRTL
            {{ Html::style(getRtlCss(mix('css/backend.css'))) }}
        @else
            {{ Html::style(mix('css/backend.css')) }}
        @endif

        {{ Html::style(asset('css/auth.css')) }}
        @yield('after-styles')
        

        <!-- Html5 Shim and Respond.js IE8 support of Html5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        {{ Html::script('https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js') }}
        {{ Html::script('https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js') }}
        <![endif]-->

        <!-- Scripts -->
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
    </head>
   <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
    <body class="skin-{{ config('frontend.theme') }} {{ config('frontend.layout') }} sidebar-collapse processing-page-load" style="height: auto;">
        <div class=" main-wrapper" style="opacity: 0;">    
            @include('includes.partials.logged-in-as')
            <div class="wrapper" style="height: auto;">
                @include('frontend.includes.auth.header')
                @include('frontend.includes.auth.sidebar')
                <!-- Content Wrapper. Contains page content -->

                <div class="content-wrapper">
                    <div class="container">
                        <section class="content-header">
                            @yield('page-header')
                            {!! Breadcrumbs::renderIfExists() !!}
                        </section>

                        <section class="content">
                            @include('includes.partials.messages')
                            @include('frontend.includes.components.subscription')

                            


                            @yield('content')
                        </section>
                      <!-- /.content -->
                    </div>
                </div>
                @include('frontend.includes.auth.footer')
            </div><!-- ./wrapper -->
            @include('includes.partials.loader')
        </div>
        <!-- JavaScripts -->
        @yield('before-scripts')
        {!! Html::script(asset('js/plugin/sweetalert2.min.js')) !!}
        {!! Html::script(mix('js/backend.js')) !!}
        {!! Html::script(asset('js/helper.js')) !!}
        @yield('after-scripts')
    </body>
</html>
