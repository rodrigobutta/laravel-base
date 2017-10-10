<!doctype html>
<html class="js csstransitions" lang="en-US">
    @include('front/master/head')
    <body class="@yield('bodyClass')">

       {{--  <div id="preloader" class="se-pre-con">
            <div class="fa fa-cog fa-spin fa-2x fa-fw"></div>
        </div> --}}
        <div class="page-wrap">
            @include('front/master/notices')
            @include('front/master/header')

            @yield('sidebar')
            @yield('content')
        </div>
        @include('front/master/footer')
        @include('front/master/foot')

    </body>
</html>
