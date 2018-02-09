<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="author" content="Rodrigo Butta" />
    <meta property="fb:app_id" content="{{ env('FACEBOOK_ID') }}" />
    <base href="{{ URL::to('/') }}">

    @include('front.master.meta_default')
    @yield('meta')

    <title>@yield('title', siteSettings('siteName'))</title>

    <link rel="shortcut icon" href="{{ URL::to('/') }}/favicon.ico?v=1" type="image/x-icon"/>

    @if (config('app.debug') == true)
        @include('front.master.debug')
    @endif

    <!--[if IE 8]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    {{-- {!! HTML::style('http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css') !!} --}}
    {!! HTML::style('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css') !!}
    {!! HTML::style('/vendor/sweetalert2/dist/sweetalert2.min.css') !!}
    {!! HTML::style('/vendor/toastr/toastr.min.css') !!}

    {!! HTML::style('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css') !!}


    {!! HTML::style('/css/app.css') !!}


    @yield('style')

    @yield('head')

    {{-- preloader --}}
    <style>
        .no-js #loader { display: none;  }
        .js #loader { display: block; position: absolute; left: 100px; top: 0; }
        .se-pre-con {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: #fff;
        }
    </style>

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', '{{ env('ANALYTICS_ID') }}', 'auto');
      ga('send', 'pageview');

    </script>

    <script>

      window.fbAsyncInit = function() {
        FB.init({
          appId      : '{{ env('FACEBOOK_ID') }}',
          xfbml      : true,
          version    : 'v2.8'
        });
      };

      (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));

    </script>


    @include('front.master.includes')


</head>