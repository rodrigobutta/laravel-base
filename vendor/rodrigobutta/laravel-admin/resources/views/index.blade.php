<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ Admin::title() }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{ admin_asset("/vendor/laravel-admin/AdminLTE/bootstrap/css/bootstrap.min.css") }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ admin_asset("/vendor/laravel-admin/font-awesome/css/font-awesome.min.css") }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ admin_asset("/vendor/laravel-admin/AdminLTE/dist/css/skins/" . config('admin.skin') .".min.css") }}">

    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
    <link rel="manifest" href="/favicon/manifest.json">
    <link rel="mask-icon" href="/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="theme-color" content="#ffffff">


    <link rel="stylesheet" href="{{ admin_asset("/vendor/laravel-admin/laravel-admin/laravel-admin.css") }}">
    <link rel="stylesheet" href="{{ admin_asset("/vendor/laravel-admin/nprogress/nprogress.css") }}">
    <link rel="stylesheet" href="{{ admin_asset("/vendor/sweetalert2/dist/sweetalert2.css") }}">
    <link rel="stylesheet" href="{{ admin_asset("/vendor/laravel-admin/nestable/nestable.css") }}">
    <link rel="stylesheet" href="{{ admin_asset("/vendor/laravel-admin/toastr/build/toastr.min.css") }}">
    <link rel="stylesheet" href="{{ admin_asset("/vendor/laravel-admin/bootstrap3-editable/css/bootstrap-editable.css") }}">
    <link rel="stylesheet" href="{{ admin_asset("/vendor/laravel-admin/google-fonts/fonts.css") }}">
    <link rel="stylesheet" href="{{ admin_asset("/vendor/laravel-admin/AdminLTE/dist/css/AdminLTE.css") }}">
    <link rel="stylesheet" href="{{ admin_asset("/vendor/laravel-admin/AdminLTE/plugins/iCheck/all.css") }}">

    <link rel="stylesheet" href="{{ admin_asset("/vendor/laravel-admin/jquery-ui/themes/smoothness/jquery-ui.css") }}">
    {!! Admin::css() !!}



    <!-- REQUIRED JS SCRIPTS -->
    <script src="{{ admin_asset ("/vendor/laravel-admin/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js") }}"></script>

    {{-- reb lo pongo acá por https://stackoverflow.com/questions/31506671/jquery-uncaught-error-cannot-call-methods-on-button-prior-to-initialization-at --}}
    <script src="{{ admin_asset ("/vendor/laravel-admin/jquery-ui/jquery-ui.min.js") }}"></script>

    <script src="{{ admin_asset ("/vendor/laravel-admin/AdminLTE/bootstrap/js/bootstrap.min.js") }}"></script>
    <script src="{{ admin_asset ("/vendor/laravel-admin/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js") }}"></script>
    <script src="{{ admin_asset ("/vendor/laravel-admin/AdminLTE/plugins/iCheck/icheck.min.js") }}"></script>
    <script src="{{ admin_asset ("/vendor/laravel-admin/AdminLTE/dist/js/app.min.js") }}"></script>
    <script src="{{ admin_asset ("/vendor/laravel-admin/jquery-pjax/jquery.pjax.js") }}"></script>
    <script src="{{ admin_asset ("/vendor/laravel-admin/nprogress/nprogress.js") }}"></script>




    {!! HTML::style('vendor/font-awesome-animation/dist/font-awesome-animation.min.css') !!}

    {!! HTML::script('vendor/tmp/jquery-living-tooltip/dist/jquery-living-tooltip.js') !!}
    {!! HTML::style('vendor/tmp/jquery-living-tooltip/dist/jquery-living-tooltip.css') !!}

    {!! HTML::script('vendor/tmp/jquery-living-editable/dist/jquery-living-editable.js') !!}
    {!! HTML::style('vendor/tmp/jquery-living-editable/dist/jquery-living-editable.css') !!}

    {!! HTML::script('vendor/tmp/jquery-living-editable/dist/inputs-ext/wysihtml5/bootstrap-wysihtml5-0.0.2/wysihtml5-0.3.0.min.js') !!}
    {!! HTML::style('vendor/tmp/jquery-living-editable/dist/inputs-ext/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5.css') !!}
    {!! HTML::script('vendor/tmp/jquery-living-editable/dist/inputs-ext/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5.js') !!}
    {!! HTML::script('vendor/tmp/jquery-living-editable/dist/inputs-ext/wysihtml5/bootstrap-wysihtml5-0.0.2/locales/bootstrap-wysihtml5.es-AR.js') !!}
    {!! HTML::script('vendor/tmp/jquery-living-editable/dist/inputs-ext/wysihtml5/wysihtml5-0.0.2.js') !!}

    {!! HTML::script('vendor/tmp/jquery-living-dialog/dist/jquery-living-dialog.js') !!}
    {!! HTML::style('vendor/tmp/jquery-living-dialog/dist/jquery-living-dialog.css') !!}

    {!! HTML::script('vendor/bootstrap-select/dist/js/bootstrap-select.min.js') !!}
    {!! HTML::script('vendor/bootstrap-select/dist/js/i18n/defaults-es_ES.js') !!}
    {!! HTML::style('vendor/bootstrap-select/dist/css/bootstrap-select.min.css') !!}

    {!! HTML::script('vendor/moment/moment.js') !!}

    {!! HTML::script('vendor/chart.js/dist/Chart.js') !!}

    {!! HTML::style('css/admin.css') !!}
    {!! HTML::script('js/admin.js') !!}

    {!! HTML::style('vendor/tmp/jquery-living-table2/dist/bootstrap-table.css') !!}
    {!! HTML::style('//rawgit.com/vitalets/x-editable/master/dist/bootstrap3-editable/css/bootstrap-editable.css') !!}
    {!! HTML::script('vendor/tmp/jquery-living-table2/dist/bootstrap-table.js') !!}
    {!! HTML::script('vendor/tmp/jquery-living-table2/dist/locale/bootstrap-table-es-ES.js') !!}


    {!! HTML::script('vendor/jquery-living-table/jquery.living.table.js') !!}
    {!! HTML::script('vendor/bootstrap-daterangepicker/daterangepicker.js') !!}
    {!! HTML::style('vendor/bootstrap-daterangepicker/daterangepicker.css') !!}

    {!! HTML::script('vendor/toastr/toastr.min.js') !!}
    {!! HTML::style('vendor/toastr/toastr.min.css') !!}



    {!! HTML::script('vendor/tmp/jquery-living-gantt/dist/jquery-living-gantt.js') !!}


    {!! HTML::script('vendor/tmp/living-maileditor/dist/automizy-email-editor.js') !!}
    {!! HTML::style('vendor/tmp/living-maileditor/dist/automizy-email-editor.css') !!}


    {!! HTML::style('/css/admin.css') !!}


    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="hold-transition {{config('admin.skin') }} {{join(' ', config('admin.layout')) }}">
<div class="wrapper">

    @include('admin::partials.header')

    @include('admin::partials.sidebar')

    <div class="content-wrapper" id="pjax-container">
        @yield('content')
        {!! Admin::script() !!}
    </div>

    {{-- @include('admin::partials.footer') --}}

</div>

<!-- ./wrapper -->

<script>
    function LA() {}
    LA.token = "{{ csrf_token() }}";

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

</script>

<!-- REQUIRED JS SCRIPTS -->

{{-- <script src="{{ admin_asset ("/vendor/laravel-admin/nestedSortable/jquery.ui.nestedSortable.js") }}"></script>  --}}

<script src="{{ admin_asset ("/vendor/laravel-admin/nestable/jquery.nestable.js") }}"></script>
<script src="{{ admin_asset ("/vendor/laravel-admin/toastr/build/toastr.min.js") }}"></script>
<script src="{{ admin_asset ("/vendor/laravel-admin/bootstrap3-editable/js/bootstrap-editable.min.js") }}"></script>
<script src="{{ admin_asset ("/vendor/sweetalert2/dist/sweetalert2.min.js") }}"></script>
{!! Admin::js() !!}
<script src="{{ admin_asset ("/vendor/laravel-admin/laravel-admin/laravel-admin.js") }}"></script>

@if(Session::has('flashSuccess'))
    <script>
        $(document).ready(function() {
            toastr["success"]('{{ Session::get('flashSuccess') }}');
        });
    </script>
@endif

@if(Session::has('flashError'))
    <script>
        $(document).ready(function() {
            toastr["error"]('{{ Session::get('flashError') }}');
        });
    </script>
@endif

@if(Session::has('errors'))
    <script>
        $(document).ready(function() {
            toastr["error"]('{{ Session::get('errors')->first() }}');
        });
    </script>
@endif




</body>
</html>
