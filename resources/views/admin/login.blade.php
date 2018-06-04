<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('static/images/favicon.png') }}">
    <title>Admin - Log in</title>

    <link href="{{ asset('static/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('static/css/style.css') }}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{ asset('static/css/colors/blue.css') }}" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>

    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper">
        <div class="login-register">
            <div class="login-box card">
                <div class="card-body">
                    <form class="form-horizontal form-material" id="loginform" method="post">
                        {{ csrf_field() }}
                        <h3 class="box-title m-b-20">Admin Panel</h3>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" id="name" name="name" type="text" required="" placeholder="Name">
                            </div>
                            @if($errors->has('name'))
                                <div class="help-block animated fadeInDown">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" id="password" name="password" type="password" required="" placeholder="Password">
                            </div>
                            @if($errors->has('password'))
                                <div class="help-block animated fadeInDown">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-info btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
                            </div>
                        </div>
                        {{--<div class="form-group m-b-0">--}}
                            {{--<div class="col-sm-12 text-center">--}}
                                {{--<p>Don't have an account? <a href="pages-register.html" class="text-info m-l-5"><b>Sign Up</b></a></p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('static/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('static/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('static/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('static/js/jquery.slimscroll.js') }}"></script>
    <!--Wave Effects -->
{{--    <script src="{{ asset('static/js/waves.js') }}"></script>--}}
    <!--Menu sidebar -->
    <script src="{{ asset('static/js/sidebarmenu.js') }}"></script>
    <!--stickey kit -->
    <script src="{{ asset('static/plugins/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
    <script src="{{ asset('static/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('static/js/custom.min.js') }}"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
{{--    <script src="{{ asset('static/plugins/styleswitcher/jQuery.style.switcher.js') }}"></script>--}}

    <script src="{{ asset('static/pages/login.js') }}"></script>
</body>
</html>