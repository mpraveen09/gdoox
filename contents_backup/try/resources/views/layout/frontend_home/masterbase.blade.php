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
    <body>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-75590151-1', 'auto');
  ga('send', 'pageview');

</script>        
        
        <header id="header">
            <!-- top navigation -->
            <ul class="header-inner">
                <li id="menu-trigger" data-trigger="#sidebar">
<!--                    <div class="line-wrap">
                        <div class="line top"></div>
                        <div class="line center"></div>
                        <div class="line bottom"></div>
                    </div>--> 
               </li>

                <li class="logo">
                    <a href="@yield('header-logo-url')" class="site_title"><img src="@yield('header-logo')" alt="logo" class="logo-header" /></a>
                </li>

                
                <li class="pull-right">
                    <a href="<?php echo URL::to('/');?>" class="langlink">EN</a>
                    &nbsp; &nbsp; &nbsp;
                    <a href="<?php echo URL::to('/l/it');?>" class="langlink">IT</a>
                    &nbsp; &nbsp; &nbsp;                            
                    <a href="<?php echo URL::to('/l/es');?>" class="langlink">ES</a>       
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<!--                <ul class="top-menu">

                    <li >
                        <div class="pull-right">
                            Your IP Address: 
                            <?php
                              if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                                  $ip = $_SERVER['HTTP_CLIENT_IP'];
                              } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                                  $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                              } else {
                                  $ip = $_SERVER['REMOTE_ADDR'];
                              }
                              echo $ip;
                            ?>
                            
                          
                        </div>
                    </li>

                            
                            
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="tm-settings" href=""></a>
                        <ul class="dropdown-menu dm-icon pull-right">

                            <li>
                                <a href="<?php echo URL::to('/');?>" class="langlink">EN - English</a>
                            </li>
                            <li>
                                <a href="<?php echo URL::to('l/it');?>" class="langlink">IT - Italian</a>
                            </li>
                            <li>
                                <a href="<?php echo URL::to('l/es');?>" class="langlink">ES - Spanish</a>
                            </li>
                        </ul>
                    </li>

                </li>
            </ul>-->


          </li> 
          <li class="pull-right">&nbsp;&nbsp;&nbsp;
              <a href="<?php echo URL::route('marketplace');?>" class="langlink">Gdoox  Marketplace </a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          </li>    

        </ul>
            <!-- Top Search Content -->

            <!-- /top navigation -->            
        </header>

<!--        <section id="header-logo-xs" class="hidden-sm hidden-md hidden-lg">
            <div class="logo-xs text-center">
                <a href="@yield('header-logo-url')" class="site_title"><img src="{{ asset('images/gdoox.png') }}" alt="logo" /></a>
            </div>
        </section>        -->
        
        <section id="main">
            
            @yield('header_banner')
            
            @yield('right_col_title')
            
            <section id="content">
                <!--<div class="container">-->
                    @yield('right_col')
                <!--</div>-->            
            </section>
            
            
        </section>        

        
        
        <footer id="footer">
            @yield('footer')            
        </footer>
        
    
        <div id="custom_notifications" class="custom-notifications dsp_none">
            @yield('custom_notifications')
        </div>


        <!-- Older IE warning message -->
        <!--[if lt IE 9]>
            <div class="ie-warning">
                <h1 class="c-white">Warning!!</h1>
                <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
                <div class="iew-container">
                    <ul class="iew-download">
                        <li>
                            <a href="http://www.google.com/chrome/">
                                <img src="{{ asset('/m-admin-ui/img/browsers/chrome.png')}}" alt="">
                                <div>Chrome</div>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.mozilla.org/en-US/firefox/new/">
                                <img src="{{ asset('/m-admin-ui/img/browsers/firefox.png')}}" alt="">
                                <div>Firefox</div>
                            </a>
                        </li>
                        <li>
                            <a href="http://www.opera.com">
                                <img src="{{ asset('/m-admin-ui/img/browsers/opera.png')}}" alt="">
                                <div>Opera</div>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.apple.com/safari/">
                                <img src="{{ asset('/m-admin-ui/img/browsers/safari.png')}}" alt="">
                                <div>Safari</div>
                            </a>
                        </li>
                        <li>
                            <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                                <img src="{{ asset('/m-admin-ui/img/browsers/ie.png')}}" alt="">
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
        
        <script src="{{ asset('/m-admin-ui/vendors/bower_components/jquery.nicescroll/jquery.nicescroll.min.js') }}"></script>
        <script src="{{ asset('/m-admin-ui/vendors/bower_components/Waves/dist/waves.min.js') }}"></script>
        <script src="{{ asset('/m-admin-ui/vendors/bootstrap-growl/bootstrap-growl.min.js') }}"></script>
        <script src="{{ asset('/m-admin-ui/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.min.js') }}"></script>
        
        <!-- Placeholder for IE9 -->
        <!--[if IE 9 ]>
            <script src="{{ asset('/m-admin-ui/vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js') }}"></script>
        <![endif]-->
        
        
        
        <!--moved to other page-->        

<!--        <script src="{{ asset('/m-admin-ui/vendors/bower_components/fullcalendar/dist/fullcalendar.min.js') }}"></script>

        <script src="{{ asset('/m-admin-ui/vendors/bower_components/flot/jquery.flot.js') }}"></script>
        <script src="{{ asset('/m-admin-ui/vendors/bower_components/flot/jquery.flot.resize.js') }}"></script>
        <script src="{{ asset('/m-admin-ui/vendors/bower_components/flot.curvedlines/curvedLines.js') }}"></script>
        <script src="{{ asset('/m-admin-ui/vendors/sparklines/jquery.sparkline.min.js') }}"></script>
        <script src="{{ asset('/m-admin-ui/vendors/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js') }}"></script>

        <script src="{{ asset('/m-admin-ui/vendors/bower_components/moment/min/moment.min.js') }}"></script>
        <script src="{{ asset('/m-admin-ui/vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js') }}"></script>
        <script src="{{ asset('/m-admin-ui/js/flot-charts/curved-line-chart.js') }}"></script>
        <script src="{{ asset('/m-admin-ui/js/flot-charts/line-chart.js') }}"></script>
        <script src="{{ asset('/m-admin-ui/js/charts.js') }}"></script>-->

        <!--moved to other page-->

        <!--<script src="{{ asset('/m-admin-ui/js/functions.js') }}"></script>-->
        <!--<script src="{{ asset('/m-admin-ui/js/demo.js') }}"></script>-->        
        
        <script src="{{ asset('/js/jquery.validate.min.js') }}"></script>        
        

        <?php /*---------------- @  Footer javascripts -----------*/ ?>

        @yield('footer_add_js_files') 

        <script>
            $('form').validate();
        </script>

        @yield('footer_add_js_script')         

</body>

</html>
