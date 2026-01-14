<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta name="title" content="GVACARS">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        @yield('meta')
        <title>@yield('title') | GVACARS</title>
        <link rel="shortcut icon" href="/front/assets/img/favicon.webp">
        <!-- CSS Files
        ================================================== -->
        <link href="/front/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap">
        <!-- <link href="/front/css/mdb.min.css" rel="stylesheet" type="text/css" id="mdb"> -->
        <link href="/front/css/plugins.css" rel="stylesheet" type="text/css">
        <link href="/front/css/style.css" rel="stylesheet" type="text/css">
        <link href="/front/css/coloring.css" rel="stylesheet" type="text/css">
        <!-- color scheme -->
        <link id="colors" href="/front/css/colors/scheme-01.css" rel="stylesheet" type="text/css">
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-8VG4L50DKD"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-8VG4L50DKD');
        </script>
        @yield('links')
        @yield('custom_css')
    </head>
    <body>
        <div id="wrapper">
            <!-- page preloader begin -->
            <div id="de-preloader"></div>
            <!-- page preloader close -->
            @include('front.layouts.header')
            <div class="no-bottom no-top" id="content">
                <div id="top"></div>
                @yield('content')
            </div>
            <!-- <a href="#" id="back-to-top"></a> -->
            @include('front.layouts.footer')
           <div class="whatsup">
            <a href="https://api.whatsapp.com/send?phone=+41762653397">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#1ECB15"  viewBox="0 0 50 50" width="50px" height="50px">    
                    <path d="M25,2C12.318,2,2,12.318,2,25c0,3.96,1.023,7.854,2.963,11.29L2.037,46.73c-0.096,0.343-0.003,0.711,0.245,0.966 C2.473,47.893,2.733,48,3,48c0.08,0,0.161-0.01,0.24-0.029l10.896-2.699C17.463,47.058,21.21,48,25,48c12.682,0,23-10.318,23-23 S37.682,2,25,2z M36.57,33.116c-0.492,1.362-2.852,2.605-3.986,2.772c-1.018,0.149-2.306,0.213-3.72-0.231 c-0.857-0.27-1.957-0.628-3.366-1.229c-5.923-2.526-9.791-8.415-10.087-8.804C15.116,25.235,13,22.463,13,19.594 s1.525-4.28,2.067-4.864c0.542-0.584,1.181-0.73,1.575-0.73s0.787,0.005,1.132,0.021c0.363,0.018,0.85-0.137,1.329,1.001 c0.492,1.168,1.673,4.037,1.819,4.33c0.148,0.292,0.246,0.633,0.05,1.022c-0.196,0.389-0.294,0.632-0.59,0.973 s-0.62,0.76-0.886,1.022c-0.296,0.291-0.603,0.606-0.259,1.19c0.344,0.584,1.529,2.493,3.285,4.039 c2.255,1.986,4.158,2.602,4.748,2.894c0.59,0.292,0.935,0.243,1.279-0.146c0.344-0.39,1.476-1.703,1.869-2.286 s0.787-0.487,1.329-0.292c0.542,0.194,3.445,1.604,4.035,1.896c0.59,0.292,0.984,0.438,1.132,0.681 C37.062,30.587,37.062,31.755,36.57,33.116z"/>
                </svg>
            </a>
           </div>
        </div>

        <script src="/front/js/plugins.js"></script>
        <script src="/front/js/designesia.js"></script>
        <script>
            $('#de-preloader .car .text').text("{{ __('messages.loading') }}");
        </script>
        @include('front.newsletter.js')
        @yield('scripts')
        @yield('custom_script')
    </body>
</html>