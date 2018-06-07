<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('static/images/favicon.png') }}">
    <title>Admin Panel</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('static/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- morris CSS -->
    <link href="{{ asset('static/plugins/morrisjs/morris.css') }}" rel="stylesheet">

    <!-- Page plugins css -->
    <link href="{{ asset('static/plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('static/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('static/plugins/toast-master/css/jquery.toast.css') }}" rel="stylesheet">
    <link href="{{ asset('static/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('static/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('static/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="{{ asset('static/css/style.css') }}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{ asset('static/css/colors/blue.css') }}" id="theme" rel="stylesheet">
    <link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
    <link href="{{ asset('static/plugins/file-upload/css/jquery.fileupload.css') }}" rel="stylesheet">
    <link href="{{ asset('static/plugins/file-upload/css/jquery.fileupload-ui.css') }}" rel="stylesheet">
    <noscript><link rel="stylesheet" href="{{ asset('static/plugins/file-upload/css/jquery.fileupload-noscript.css') }}"></noscript>
    <noscript><link rel="stylesheet" href="{{ asset('static/plugins/file-upload/css/jquery.fileupload-ui-noscript.css') }}"></noscript>

    <link href="{{ asset('static/plugins/Magnific-Popup-master/dist/magnific-popup.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('static/plugins/dropify/dist/css/dropify.min.css') }}">
    <link href="{{ asset('static/css/admin.css') }}" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="fix-header fix-sidebar card-no-border">

<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
    </svg>
</div>

<div id="main-wrapper">
    <!-- Header -->
@include('admin.partial.header')

<!-- Sidebar -->
    @include('admin.partial.sidebar')

    <div class="page-wrapper">

        @yield('content')

    </div>

    {{--<div class="">--}}
    {{--<button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>--}}
    {{--</div>--}}
<!-- Footer -->
    {{--@include('admin.partial.footer')--}}
</div>
<!-- REQUIRED JS SCRIPTS -->

<script src="{{ asset('static/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('static/plugins/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('static/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('static/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('static/js/waves.js') }}"></script>
<script src="{{ asset('static/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('static/plugins/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
<script src="{{ asset('static/js/custom.min.js') }}"></script>
<script src="{{ asset('static/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('static/plugins/raphael/raphael-min.js') }}"></script>
<script src="{{ asset('static/plugins/morrisjs/morris.min.js') }}"></script>
<script src="{{ asset('static/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('static/plugins/jquery-loading-overlay/dist/loadingoverlay.min.js') }}"></script>
<script src="{{ asset('static/plugins/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('static/plugins/sweetalert/jquery.sweet-alert.custom.js') }}"></script>
<script src="{{ asset('static/pages/common.js') }}"></script>

@yield('scripts')

</div>
</body>
</html>