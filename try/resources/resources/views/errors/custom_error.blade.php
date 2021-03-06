
<!DOCTYPE html>
    <!--[if IE 9 ]><html class="ie9"><![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Error Found</title>
        
        <!-- Vendor CSS -->
        <link href="{{ asset('/m-admin-ui/vendors/bower_components/animate.css/animate.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/m-admin-ui/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css') }}" rel="stylesheet">
            
        <!-- CSS -->
        <link href="{{ asset('/m-admin-ui/css/app.min.1.css') }}" rel="stylesheet">
        <link href="{{ asset('/m-admin-ui/css/app.min.2.css') }}" rel="stylesheet">
        
        <script src="{{ asset('/m-admin-ui/vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>
        <style>
          .four-zero.width-medium {
              width: 1000px;
              left: 30%;
            }
        </style>
    </head>
    
    <body class="four-zero-content">        
        <div class="four-zero width-medium">
          <h1>Error Found</h1>
              @if (Session::has('message'))
                  <div class="alert alert-info alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                      {!!  Session::get('message')  !!}
                  </div>
              @endif
              @if (HTML::ul($errors->all()))
                  <div class="alert alert-danger alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                      {!! HTML::ul($errors->all()) !!}
                  </div>
              @endif
            <footer>
                <a href="" class="a_back"><i class="zmdi zmdi-arrow-back"></i></a>
                <a href="{{ URL::to('/') }}"><i class="zmdi zmdi-home"></i></a>
            </footer>
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
    </body>
</html>

<script>
    $(document).ready(function(){
            $('a.a_back').click(function(){
                    parent.history.back();
                    return false;
            });
    });
</script>