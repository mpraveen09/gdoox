<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @yield('meta')

    <!-- Bootstrap core CSS -->

    <link href="{{ asset('/admin-ui/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('/admin-ui/fonts/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/admin-ui/css/animate.min.css') }}" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="{{ asset('/admin-ui/css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('/admin-ui/css/maps/jquery-jvectormap-2.0.1.css') }}" />
    <link href="{{ asset('/admin-ui/css/icheck/flat/green.css') }}" rel="stylesheet" />
    <link href="{{ asset('/admin-ui/css/floatexamples.css') }}" rel="stylesheet" type="text/css" />
    
    <link href="{{ asset('/admin-ui/css/normalize.css') }}" rel="stylesheet" type="text/css" />
    
    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,100italic,300italic,400italic,700italic|Roboto:500,400italic,100,300,500italic,100italic,300italic,400' rel='stylesheet' type='text/css'>

    <script src="{{ asset('/admin-ui/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/admin-ui/js/nprogress.js') }}"></script>
    
    @yield('header_add_js_files')
    
    @yield('header_add_js_script') 
    
    
    <script>
        NProgress.start();
    </script>
    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    
     <!--main css -->
    
    <link href="{{ asset('/css/custom.css') }}" rel="stylesheet">
    
    @yield('header_custom_css') 
     
</head>


<body class="nav-md">

    <div class="container body">


        <div class="main_container">

            <div class="col-md-3 left_col">
                @yield('left_col')
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                @yield('top_nav')
            </div>
            <!-- /top navigation -->


            <!-- page content -->
            <div class="right_col " role="main">
                @yield('right_col_title')
                <div class="clearfix"></div>
                @yield('right_col')


                <!-- footer content -->
                <footer>
                    @yield('footer')
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>
            <!-- /page content -->

        </div>

    </div>

    
    
    
    <div id="custom_notifications" class="custom-notifications dsp_none">
        @yield('custom_notifications')
    </div>

    
    
    
    <?php /*---------------- @  Footer javascripts -----------*/ ?>
    
    <script src="{{ asset('/admin-ui/js/bootstrap.min.js') }}"></script>

    @yield('footer_add_js_files') 

    <script src="{{ asset('/admin-ui/js/nicescroll/jquery.nicescroll.min.js') }}"></script>    
    <script src="{{ asset('/admin-ui/js/custom.js') }}"></script>
    <script src="{{ asset('/admin-ui/js/validator/validator.js') }}"></script>
    
    <script src="{{ asset('/admin-ui/js/datepicker/daterangepicker.js') }}"></script>
    
    <script>
        //Form Validation
        $('form').submit(function (e) {
            e.preventDefault();
            var submit = true;
            // evaluate the form using generic validaing
            if (!validator.checkAll($(this))) {
                submit = false;
            }

            if (submit)
                this.submit();
            return false;
        });
    </script>
    
    @yield('footer_add_js_script') 
    
    <script>
        NProgress.done();
    </script>

    <!-- /footer content -->
</body>

</html>
