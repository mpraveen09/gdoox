<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="{{ asset('/m-admin-ui/vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script type=text/javascript>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
         </script>
         
        @yield('meta')
    
        <!-- Vendor CSS -->
        <link href="{{ asset('/m-admin-ui/vendors/bower_components/fullcalendar/dist/fullcalendar.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/m-admin-ui/vendors/bower_components/animate.css/animate.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/m-admin-ui/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.css') }}" rel="stylesheet">
        <link href="{{ asset('/m-admin-ui/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css') }}" rel="stylesheet">
        
        
            
        <!-- CSS -->
        <link href="{{ asset('/m-admin-ui/css/app.min.1.css') }}" rel="stylesheet">
        <link href="{{ asset('/m-admin-ui/css/app.min.2.css') }}" rel="stylesheet">    

    
    @yield('header_add_js_files')
    @yield('header_add_js_script') 
    
    <!--custom css -->
    <!--<link href="{{ asset('/css/custom.css') }}" rel="stylesheet">-->
    
    @yield('header_custom_css')     
    </head>
    <body class="login-content sw-toggled">
        <!-- Login -->
    @yield('content_login')
      
        
        <!-- Register -->
    @yield('content_register')
     
        
        <!-- Forgot Password -->
    @yield('forgot_password')
        
        
        <!-- Older IE warning message -->
        <!--[if lt IE 9]>
            <div class="ie-warning">
                <h1 class="c-white">Warning!!</h1>
                <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
                <div class="iew-container">
                    <ul class="iew-download">
                        <li>
                            <a href="http://www.google.com/chrome/">
                                <img src="img/browsers/chrome.png" alt="">
                                <div>Chrome</div>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.mozilla.org/en-US/firefox/new/">
                                <img src="img/browsers/firefox.png" alt="">
                                <div>Firefox</div>
                            </a>
                        </li>
                        <li>
                            <a href="http://www.opera.com">
                                <img src="img/browsers/opera.png" alt="">
                                <div>Opera</div>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.apple.com/safari/">
                                <img src="img/browsers/safari.png" alt="">
                                <div>Safari</div>
                            </a>
                        </li>
                        <li>
                            <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                                <img src="img/browsers/ie.png" alt="">
                                <div>IE (New)</div>
                            </a>
                        </li>
                    </ul>
                </div>
                <p>Sorry for the inconvenience!</p>
            </div>   
        <![endif]-->
        
        <!-- Javascript Libraries -->
        <script src="{{ asset('/m-admin-ui/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        
        <script src="{{ asset('/m-admin-ui/vendors/bower_components/Waves/dist/waves.min.js') }}"></script>
        
        <!-- Placeholder for IE9 -->
        <!--[if IE 9 ]>
            <script src="vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js"></script>
        <![endif]-->
        
        <script src="{{ asset('/m-admin-ui/js/functions.js') }}"></script>
        
    
</body>

</html>
