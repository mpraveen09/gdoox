<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="{{ asset('/m-admin-ui/vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('/m-admin-ui/vendors/bootgrid/jquery.bootgrid.min.js') }}"></script>
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
        
        <link href="{{ asset('/m-admin-ui/vendors/bower_components/animate.css/animate.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/m-admin-ui/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.css') }}" rel="stylesheet">
        <link href="{{ asset('/m-admin-ui/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/m-admin-ui/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('/css/jquery-ui.css')}}">
        <link href="{{ asset('/m-admin-ui/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/m-admin-ui/vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.css') }}" rel="stylesheet">
        <link href="{{ asset('/m-admin-ui/vendors/bower_components/nouislider/distribute/jquery.nouislider.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/m-admin-ui/css/app.min.1.css') }}" rel="stylesheet">
        <link href="{{ asset('/m-admin-ui/css/app.min.2.css') }}" rel="stylesheet"> 
        
 
        <!-- CSS -->
        <link href="css/app.min.1.css" rel="stylesheet">
        <link href="css/app.min.2.css" rel="stylesheet">
    
        @yield('header_add_js_files')
        @yield('header_add_js_script') 
    
        <link href="{{ asset('/css/custom-1.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/custom-2.css') }}" rel="stylesheet">
    
        @yield('header_custom_css')     
    </head>
    
    <body>
       @yield('maincontent') 
        
      
    </body>

        <script src="{{ asset('/m-admin-ui/vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('/m-admin-ui/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('/m-admin-ui/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>
        <script src="{{ asset('/m-admin-ui/vendors/bower_components/Waves/dist/waves.min.js') }}"></script>
        <script src="{{ asset('/m-admin-ui/vendors/bootstrap-growl/bootstrap-growl.min.js') }}"></script>
        <script src="{{ asset('/m-admin-ui/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.min.js') }}"></script>
        <script src="{{ asset('/m-admin-ui/vendors/bower_components/autosize/dist/autosize.min.js') }}"></script>
        <script src="{{ asset('/m-admin-ui/js/functions.js') }}"></script>
<!--        <script src="{{ asset('/m-admin-ui/js/demo.js') }}"></script>-->
        <script src="{{ asset('/m-admin-ui/vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.js') }}"></script>  

        @yield('footer_add_js_files') 
            <script src="{{asset('/js/jquery-ui.js')}}"></script>
        @yield('footer_add_js_script')
        
        @section('footer_add_js_script')
            <script type="text/javascript">
                $(function(){
                    $.ajax({
                      url:"{!! route('alertsytem.index') !!}",
                      type:'POST',
                      success:function(data){
                            console.log(data);
                            $('#user_alerts').html(data);
                      }
                    });
                });
            </script>
        @endsection
        
</html>
