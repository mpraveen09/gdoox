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
        <link href="{{ asset('/m-admin-ui/vendors/bower_components/fullcalendar/dist/fullcalendar.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/m-admin-ui/vendors/bower_components/animate.css/animate.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/m-admin-ui/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.css') }}" rel="stylesheet">
        <link href="{{ asset('/m-admin-ui/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/m-admin-ui/vendors/farbtastic/farbtastic.css') }}" rel="stylesheet">

        <link href="{{ asset('/m-admin-ui/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css') }}" rel="stylesheet">
        
        <link rel="stylesheet" href="{{asset('/css/jquery-ui.css')}}">

        <link href="{{ asset('/m-admin-ui/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/m-admin-ui/vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.css') }}" rel="stylesheet">
        <link href="{{ asset('/m-admin-ui/vendors/bower_components/nouislider/distribute/jquery.nouislider.min.css') }}" rel="stylesheet">

         
        <!-- CSS -->
        <link href="{{ asset('/m-admin-ui/css/app.min.1.css') }}" rel="stylesheet">
        <link href="{{ asset('/m-admin-ui/css/app.min.2.css') }}" rel="stylesheet">  
        <link href="{{ asset('/css/jquery.tagsinput.css') }}" rel="stylesheet">  
    
        <link href="{{ asset('/m-admin-ui/vendors/bower_components/summernote/dist/summernote.css') }}" rel="stylesheet">
        
        <link href="{{ asset('/admin-ui/css/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/admin-ui/css/datatables/css/buttons.dataTables.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/admin-ui/css/datatables/css/fixedColumns.dataTables.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/js/bxslider/bxslider.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('/css/jquery-ui.css')}}">
    
    @yield('header_add_js_files')
    @yield('header_add_js_script') 
    
    <!--custom css -->
    <!--<link href="{{ asset('/css/custom.css') }}" rel="stylesheet">-->

    <link href="{{ asset('/css/custom-1.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/custom-2.css') }}" rel="stylesheet">
    
    @yield('header_custom_css')     
    </head>
    <body>
   
<!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50ab7d7e6b1e820c" async="async"></script>     
        
        <?php
            use Gdoox\Helpers\UUID ;
            use Gdoox\Models\ShoppingCart;
            use Gdoox\Models\BusinessEcommerceCompany;
            use Gdoox\Models\PersonalSiteDetail;
            use Gdoox\Models\UserLanguagePreference;
            use Gdoox\Models\ChatMessages;
            use Gdoox\Models\CompanyInvitation;
            use Gdoox\Models\BusinessInfo;
            use Gdoox\Models\BusinessPartner;
            use Gdoox\Models\AlertSystem;
            use Carbon\Carbon;
  
//          Getting and setting the Cart Items in the session
                if(!isset($_COOKIE['gdoox_shopping_cart']) || empty($_COOKIE['gdoox_shopping_cart'])){
                    $timestamp= time();
                    $cookie_value= UUID::v4() . "-" . $timestamp;
                    setcookie('gdoox_shopping_cart', $cookie_value, time() + (86400 * 30), "/");
                }
                else {
                    $cookie_val = $_COOKIE['gdoox_shopping_cart'];
                    if(Auth::user()){
                        $userid = Auth::user()->id;
                        $total = ShoppingCart::where('userid','=', $userid)->orwhere('cart_id','=', $cookie_val)->where('status','=','0')->count('product_id');
                    }
                    else {
                        $total = ShoppingCart::where('cart_id','=', $cookie_val)->where('status','=','0')->count('product_id'); 
                    }

                    session(['cart_items' => $total]);
                }
            
             // In IF Setting the Global Cookie for the Gdoox Application which can be used further.
             // In ELSE getting the Web Application Languare selected by the user.  
                if(!isset($_COOKIE['gdoox_global_val']) || empty($_COOKIE['gdoox_global_val'])){
                    $timestamp= time();
                    $cookie = UUID::v4() . "-" . $timestamp;
                    setcookie('gdoox_global_val', $cookie, time() + (86400 * 30), "/");
                }
                
            // Setting the defalut language as English in session.
//                if(isset($_COOKIE['gdoox_global_val'])){
//                    if(Auth::user()){
//                        $applang = UserLanguagePreference::where('user_id',Auth::user()->id)->orWhere('cookie_id', $_COOKIE['gdoox_global_val'])->first();
//                        if(!empty($applang)){
//                            session(['app_language' => $applang->language]);
//                        }
//                        else {
//                            $lang = new UserLanguagePreference();
//                            $lang->language = 'en';
//                            $lang->cookie_id = $_COOKIE['gdoox_global_val'];
//                            $lang->user_id = Auth::user()->id;
//                            $lang->save();
//                            session(['app_language' => 'en']);
//                        }
//                    }
//                    else {
//                        $applang = UserLanguagePreference::where('cookie_id', $_COOKIE['gdoox_global_val'])->first();
//                        if(!empty($applang)){
//                            session(['app_language' => $applang->language]);
//                        }
//                        else {
//                            $lang = new UserLanguagePreference();
//                            $lang->language = 'en';
//                            $lang->cookie_id = $_COOKIE['gdoox_global_val'];
//                            $lang->user_id = '';
//                            $lang->save();
//                            session(['app_language' => 'en']);
//                        }
//                    }
//                }
        ?>
        
        <header id="header" class="clearfix" data-current-skin="blue">
            <!-- top navigation -->
            <ul class="header-inner">
                <li id="menu-trigger" data-trigger="#sidebar">
                    <div class="line-wrap">
                        <div class="line top"></div>
                        <div class="line center"></div>
                        <div class="line bottom"></div>
                    </div>
                </li>

                <li class="logo hidden-xs">
                    <a href="@yield('header-logo-url')" class="site_title">
                        <img src="@yield('header-logo')" alt="logo" class="logo-header" />
                    </a>
                </li>
                
                <li >
                    <h2 class="header-sitename">
                    @if( !empty($storename->ecomm_company_name))
                      {!!  $storename->ecomm_company_name !!}
                    @elseif(isset($personalsitedetails->site_name))
                        {!! $personalsitedetails->site_name !!}
                    @elseif(!empty($personalsitedetails->general_info) )
                      @if(!empty($personalsitedetails->general_info['first_name']) )
                        {{ $personalsitedetails->general_info['first_name'] }} 
                      @endif
<!--                  @if(!empty($personalsitedetails->general_info['second_name']) )
                        {{ $personalsitedetails->general_info['second_name'] }} 
                      @endif-->
                      @if(!empty($personalsitedetails->general_info['surname']) )
                        {{ $personalsitedetails->general_info['surname'] }} 
                      @endif                      
                    @endif
                  </h2>
                </li>
                <li class="pull-right">
                <ul class="top-menu">
                    <li id="web-app-lang">
                        <div>
                            <?php 
                            
                            $lang = array('en'=>'EN','it'=>'IT');
                            if(isset($_COOKIE['gdoox_global_val'])){
                                if(Auth::user()){
                                    $applang = UserLanguagePreference::where('user_id',Auth::user()->id)->orWhere('cookie_id', $_COOKIE['gdoox_global_val'])->first();
                                    if(!empty($applang)){
                                        Form::select('app-lang', $lang, $applang->language, array('id'=>'app-lang', 'class'=>'btn btn-default save-btn waves-effect pull-right','style'=>'display: block'));
                                    }
                                    else {
                                        Form::select('app-lang', $lang, 'en', array('id'=>'app-lang', 'class'=>'btn btn-default save-btn waves-effect pull-right','style'=>'display: block'));
                                    }
                                }
                                else {
                                    $applang = UserLanguagePreference::where('cookie_id', $_COOKIE['gdoox_global_val'])->first();
                                    if(!empty($applang)){
                                        Form::select('app-lang', $lang, $applang->language, array('id'=>'app-lang', 'class'=>'btn btn-default save-btn waves-effect pull-right','style'=>'display: block'));
                                    }
                                    else {
                                        Form::select('app-lang', $lang, 'en', array('id'=>'app-lang', 'class'=>'btn btn-default save-btn waves-effect pull-right','style'=>'display: block'));
                                    }
                                }
                            }
                            ?>
							@if(!empty($applang))
                            	{!! Form::select('app-lang', $lang, $applang->language, array('id'=>'app-lang', 'class'=>'btn btn-default save-btn waves-effect pull-right','style'=>'display: block')) !!}
							@else
								{!! Form::select('app-lang', $lang, 'en', array('id'=>'app-lang', 'class'=>'btn btn-default save-btn waves-effect pull-right','style'=>'display: block')) !!}
							@endif
                        </div>
                    </li>

                    <li id="toggle-width">
                        <div class="toggle-switch" data-toggle="tooltip" title="Hide/Show Side Menu">
                            <input id="tw-switch" type="checkbox" hidden="hidden">
                            <label for="tw-switch" class="ts-helper"></label>
                        </div>
                    </li>
                    
                    <li id="top-search">
                        <a href=""><i class="tm-icon zmdi zmdi-search"></i></a>
                    </li>
                        
<!--                 <li id="top-search">
                        <a class="tm-search" href=""></a>
                    </li>-->
                    
                    <li class="dropdown">   
                        @if (Session::has('cart_items'))
                          <a data-toggle="dropdown" href="">
                              <i class="tm-icon zmdi zmdi-shopping-cart"></i>
                              <i class="tmn-counts">{!!  Session::get('cart_items')  !!}</i>
                          </a>
                        
                          <div class="dropdown-menu dropdown-menu-lg pull-right">
                              <div class="listview">
                                    <a class="tm-cart " href=""><i class="tmn-counts"></i></a>  
<!--                                @yield('cart_link');-->
                                    <div style="padding:5px 20px">
                                        <a href="{!! route('view_cart')  !!}">View All Carts</a>
                                    </div>
                                    @if (Session::has('cart_items'))
                                        @if( Session::get('cart_items') !== 0)
                                            <div class="cart_links"></div>
                                        @endif  
                                    @endif
                              </div>
                          </div>
                        @else
                          <a class="" href="">
                              <i class="tm-icon zmdi zmdi-shopping-cart"></i>
                              <i class="tmn-counts">0</i>
                          </a>
                        @endif
                    </li>
                    
                    @if(Auth::user())
                        <li class="dropdown" id="user_alerts"></li>
                    @endif
                    
                    
                    @if(Auth::user())
<!--                    
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="tm-message" href=""><i class="tmn-counts">@yield('msg_count')</i></a>
                        <div class="dropdown-menu dropdown-menu-lg pull-right">
                            <div class="listview">
                                @yield('msg_content')
                            </div>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="tm-notification" href=""><i class="tmn-counts">@yield('alert_count')</i></a>
                        <div class="dropdown-menu dropdown-menu-lg pull-right">
                            <div class="listview" id="notifications">
                                @yield('alert_content')
                            </div>

                        </div>
                    </li>
                    <li class="dropdown hidden-xs">
                        <a data-toggle="dropdown" class="tm-task" href=""><i class="tmn-counts">@yield('task_count')</i></a>
                        <div class="dropdown-menu pull-right dropdown-menu-lg">
                            <div class="listview">
                                @yield('task_content')
                            </div>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="tm-settings" href=""></a>
                        @yield('page_settings')
                    </li>
                    
                    -->
        <!--            <li class="hidden-xs" id="chat-trigger" data-trigger="#chat">
                        <a class="tm-chat" href=""></a>
                    </li>-->
                    @endif
                  </ul>
                </li>
            </ul>
            
            {!! Form::model('$products_list', [
                'method' => 'GET',
                'route' => ['marketplace'],
                'class' => 'form-label-left',
                'novalidate'=>''
            ]) !!} 
                <!-- Top Search Content -->
                <div id="top-search-wrap">
                    <div class="tsw-inner">
                    <i id="top-search-close" class="zmdi zmdi-arrow-left"></i>
                    {!! Form::text('keyword','',array('','placeholder'=>'Search...','class'=>'searchall')) !!}
                    </div>
                </div>
                <!-- /top navigation -->            
             {!! Form::close() !!}
             
            </header>

        <section id="header-logo-xs" class="hidden-sm hidden-md hidden-lg">
            <div class="logo-xs text-center">
                <a href="@yield('header-logo-url')" class="site_title">
                    <img src="@yield('header-logo')" alt="logo" /></a>
            </div>
        </section>        
        
        <section id="main">
            <aside id="sidebar" class="sidebar c-overflow">@yield('left_col')</aside>
            
            <section id="content">
                <div class="container">
                    @if(Auth::user())
                      <div class="row">
                            <div class="col-md-9 col-sm-8"><div class="breadcrumbs"></div></div>
                            <div class="col-md-3 col-sm-4 text-right">
                                <?php
                                  if(Auth::user()->hasRole('user') || Auth::user()->hasRole('personal-site-user')){
                                    $site_info = PersonalSiteDetail::where('user_id', Auth::user()->id)->project('slug')->first();
                                    if(!empty($site_info->slug)) {
                                        echo '<a class="btn btn-danger" href="'.URL::to('/site/') .'/'. $site_info->slug . '">View My Site <i class="zmdi zmdi-arrow-forward"></i></a><br/><br/>';
                                    }          
                                  }
                                  elseif(Auth::user()->hasRole('multi-site-admin')){
                                        echo '<a class="btn btn-danger" href="'. route('ecomm-index') . '">View My Sites <i class="zmdi zmdi-arrow-forward"></i></a><br/><br/>';
                                  }
                                  else {
                                    $site_info =  BusinessEcommerceCompany::where('type', '=', 'business')->where('user_id',Auth::user()->id)->project('slug')->first();
                                    if(!empty($site_info->slug)) {
                                        echo '<a class="btn btn-danger" href="'.URL::to('/site/') .'/'. $site_info->slug . '">View My Site <i class="zmdi zmdi-arrow-forward"></i></a>';
                                    }
                                  }        
                                ?>      
                            </div>
                      </div>
                    @endif
                    @yield('right_col_title')
                    @yield('right_col')
                </div>            
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

        
      <!--Page loading animation - all pages before closing body tag-->    
      <div class="page-loader">
          <div class="preloader pls-blue">
              <svg class="pl-circular" viewBox="25 25 50 50">
                  <circle class="plc-path" cx="50" cy="50" r="20" />
              </svg>
              <p>Please wait...</p>
          </div>
      </div>        
      <!--Page loading animation - all pages before closing body tag-->    
        <!-- Javascript Libraries -->
        <script src="{{ asset('/m-admin-ui/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('/m-admin-ui/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>
        <script src="{{ asset('/m-admin-ui/vendors/bower_components/Waves/dist/waves.min.js') }}"></script>
        <script src="{{ asset('/m-admin-ui/vendors/bootstrap-growl/bootstrap-growl.min.js') }}"></script>
        <script src="{{ asset('/m-admin-ui/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.min.js') }}"></script>
        <script src="{{ asset('/m-admin-ui/vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.js') }}"></script>
        <script src="{{ asset('/m-admin-ui/vendors/bower_components/nouislider/distribute/jquery.nouislider.all.min.js') }}"></script>
        
        
        <!-- Placeholder for IE9 -->
        <!--[if IE 9 ]>
            <script src="{{ asset('/m-admin-ui/vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js') }}"></script>
        <![endif]-->
        
        
        
        <!--moved to other page-->        
        <script src="{{ asset('/m-admin-ui/vendors/bower_components/moment/min/moment.min.js') }}"></script>
        <script src="{{ asset('/m-admin-ui/vendors/bower_components/fullcalendar/dist/fullcalendar.min.js') }}"></script>

        <script src="{{ asset('/m-admin-ui/vendors/bower_components/flot/jquery.flot.js') }}"></script>
        <script src="{{ asset('/m-admin-ui/vendors/bower_components/flot/jquery.flot.resize.js') }}"></script>
        <script src="{{ asset('/m-admin-ui/vendors/bower_components/flot.curvedlines/curvedLines.js') }}"></script>
        <script src="{{ asset('/m-admin-ui/vendors/sparklines/jquery.sparkline.min.js') }}"></script>
        <script src="{{ asset('/m-admin-ui/vendors/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js') }}"></script>

        <script src="{{ asset('/m-admin-ui/vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js') }}"></script>
        <script src="{{ asset('/m-admin-ui/js/flot-charts/curved-line-chart.js') }}"></script>
        <script src="{{ asset('/m-admin-ui/js/flot-charts/line-chart.js') }}"></script>
        <script src="{{ asset('/m-admin-ui/js/charts.js') }}"></script>
        
        <script src="{{ asset('/m-admin-ui/vendors/fileinput/fileinput.min.js') }}"></script>

        <script src="{{ asset('/m-admin-ui/vendors/farbtastic/farbtastic.min.js') }}"></script>
        <script src="{{ asset('/m-admin-ui/vendors/farbtastic/farbtastic.js') }}"></script>
        <script src="{{ asset('/m-admin-ui/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
        <script src="{{ asset('/m-admin-ui/vendors/bower_components/summernote/dist/summernote.min.js') }}"></script>        

        <!--moved to other page-->

        <script src="{{ asset('/m-admin-ui/js/functions.js') }}"></script>
        <!--<script src="{{ asset('/m-admin-ui/js/demo.js') }}"></script>-->        
        
        <script src="{{ asset('/js/jquery.validate.min.js') }}"></script>      
        
        <script src="{{ asset('/js/jquery.url.js') }}"></script>      
        
        <script src="{{ asset('/admin-ui/js/datatables/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('/admin-ui/js/datatables/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('/admin-ui/js/datatables/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('/admin-ui/js/datatables/js/dataTables.select.min.js') }}"></script>
        <script src="{{ asset('/admin-ui/js/datatables/js/jszip.min.js') }}"></script>
        <script src="{{ asset('/admin-ui/js/datatables/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('/admin-ui/js/datatables/js/buttons.colVis.min.js') }}"></script>
        <script src="{{ asset('/admin-ui/js/datatables/js/dataTables.fixedColumns.min.js') }}"></script>
        <script src="{{asset('/js/jquery-ui.js')}}"></script>
        <script src="{{ asset('/js/bxslider/bxslider.min.js') }}"></script>

        <?php /*---------------- @  Footer javascripts -----------*/ ?>

        
@yield('footer_add_js_files') 
<script>
//    $('form').validate();
    $(document).ready(function () {      
      $( "form" ).each(function() {
        $( this ).validate();
      });
    });  

    function goBack() {
        window.history.back();
    }
</script>
<style>
    .ui-menu-item{
        width: 300px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;        
        font-size: 11px;
    }   
    .ui-widget-content{
        max-height: 400px;
        overflow: scroll;
    }
</style>


<script src="{{asset('/js/jquery-ui.js')}}"></script>

<script type="text/javascript">
jQuery(function($) {
      $('.edit-btn').on('click', function(){
        $(this).hide();
//      $('.hide-btn').show();
        $('.instruction_title').css('display', 'none');
        $('.instruction_text').css('display', 'none');
        $('.help_title').css('display', 'block');
        $('.help_text').css('display', 'block');
        $('.save-btn').css('display', 'block');
    });
      
    $('.tm-cart').click(function(){
        $.ajax({
            url: "{!! URL::route('view_cart_list')  !!}",
            success: function(data) {
                $('.cart_links').html(data);
            }
        });
    });
    
    $(".searchall").autocomplete({
        source: function( request, response ) {   
            $.ajax({
                url: "{!! URL::route('auto_search_all') !!}",
                dataType: "json",
                data: {
                        term: request.term
                },
                success: function(json) {
                    response( $.map( json, function( item ) {
                        return {
                            value: item.attribute
                        }
                    }));
                }
            });
        },
        autoFocus: true,
        minLength: 3,
    });
            
            
    //Set navigation
    var $page = $.url.attr("source");
//    console.log(encodeURIComponent($page));
    var ptemp = $.url.attr("relative");
    if( ptemp !== '/permission-denied' && ptemp !== '/crm/under-testing'){
      $('.main-menu a').each(function(){
        var $href = $(this).attr('href');
//        console.log(decodeURIComponent($href));
//        console.log(decodeURIComponent($page));
        if ( (decodeURIComponent($href) === decodeURIComponent($page)) ) {
          $(this).addClass('active');
          $(this).parents('li.sub-menu').addClass('active').addClass('toggled');
        } 
      }); 
    
    
      //Set breadcrumb
      var url = decodeURIComponent($page);//location.pathname.substring(location.pathname.lastIndexOf("/") + 1);
      var currentItem = $(".side-main-menu").find("[href$='" + url + "']");
      var path = "";
      $(currentItem.parents("li").get().reverse()).each(function () {
          path += ' <i class="zmdi zmdi-chevron-right zmdi-hc-fw"></i> ' + $(this).children("a").text();
      });
      if(path !== ""){
            $('.breadcrumbs').html("<div class='breadcrumb'><a href='{!! route('dash-board')!!}'>Home</a>"+path+"</div>");
      }
    }
//    console.log();

//      $('.sub-menu ul > li > a').each(function(){
//        $(this).prepend('<i class="zmdi zmdi-caret-right zmdi-hc-fw"></i>');
//        $(this).prepend('<i class="zmdi zmdi-chevron-right zmdi-hc-fw"></i>');
//      }); 
      
      
});
</script>
 
<script type="text/javascript">
// jQuery(function($) {
//      $('.edit_btn').on('click', function(){
//        alert("hello");
//        $('.instruction_title').css('display', 'none');
//        $('.instruction_text').css('display', 'none');
//        $('.help_title').css('display', 'block');
//        $('.help_text').css('display', 'block');
//      });
//  });
</script>
<script>
    $(document).ready(function() {      
        if ($('.html-editor-help')[0]) {
         $('.html-editor-help').summernote({
                height: 150
            });
        }      
    });  
    
    
//    function setHelpContent() {
//        var sHTML = $('.html-editor-help').code();
//        $('#help_text').val(sHTML);  
//    }

    function setHelpContent() {
        var sHTML = $('.html-editor-help').code();
        var route =  "{!! \Request::route()->getName(); !!}";
        var lang = $('#lang').val();
        var help_title = $('.help_title').val();
        var url = "{!! route('pagehelp.store') !!}";
        $('#help_text').val(sHTML);
        $.ajax({
                url: url,
                type:'POST',
                data: {
                    lang : lang,
                    route_name : route,
                    help_text : sHTML,
                    help_title : help_title
                },
                success:function(data){
                  if(data.success == true){
                      $('.help_title').hide();
                      $('.instruction_title').show();
                      $('.edit-btn').show();
                      $('#page-help-collapse-one').removeClass('in');
                      $('#save_help_btn').hide();
                      $('#lang').hide();
                      $('#help_text').val(data.help_text);
    //                $('.html-editor-help').code(data.data.help_text);
                  }
                  else {
                        $('.html-editor-help').code('');
                        alert("No data found. Please add data");
                  }
                }
            }); 
        }

        $(document).ready(function() {
            $('.html-editor-help').code($('#help_text').val());
        });
</script>

<script type="text/javascript">
    $(".help_data").on('change', function(){
          ref = $(this);
          var lang = $(ref).val();
          var route =  "{!!\Request::route()->getName();!!}";
          $.ajax({
            url:"{!! route('pagehelp.data') !!}",
            data: {
                lang:lang, 
                route:route
            },
            type:'POST',
            success:function(data){
              if(data.success == true){
                  $('.help_title').val(data.data.help_title);
                  $('.help_text').val(data.data.help_text);
                  $('.html-editor-help').code(data.data.help_text);
              }
              else {
                $('.html-editor-help').code('');
                alert("No data found. Please add data");
              }
            }
          });
    });
  
 //  Ajax request to set the User Selected Language to the Session.
  
    $("#app-lang").on('change', function(){
        ref = $(this);
        var lang = $(ref).val();
        $.ajax({
            url:"{!! route('web-app-lang') !!}",
            data: {
                lang: lang, 
            },
            type:'POST',
            success:function(data){
                if(data.success == true){
//                    alert("Application Language Selected Successfully");
//                    window.location.reload();
                    setTimeout(window.location.reload(), 2000);
                }
                else {
//                    alert("Something went wrong!. Please try again.");
                }
            }
        });
    });
</script>

<script type="text/javascript">
$(function(){
    $.ajax({
      url:"{!! route('alertsytem.index') !!}",
      type:'POST',
      success:function(data){
            $('#user_alerts').html(data);
        }
    });
});
</script>

@yield('footer_add_js_script')         
<?php
    use Gdoox\Models\BreadcrumbLinks;
    $curr_url = str_replace( URL::to('/'), "", Request::url() ); 
    $burl = BreadcrumbLinks::where('child_url','=', $curr_url)->Where('child_url','!=', "")->first();

    if(empty($burl)){
      $burl = BreadcrumbLinks::where('main_url','=', $curr_url)->first();
    }
    if(empty($burl)){
      $burls = BreadcrumbLinks::project( array('main_url','child_url') )->get();

      if(!empty($burls)){
        $sortedurls=array();
        foreach ($burls as $k => $burldata) {
          $sortedurls[]=array("main_url" => $burldata->main_url, "child_url" => $burldata->child_url);
          /*
          $sortedurls[]=$burldata->main_url;
          if(!empty($burldata->child_url)){
            $sortedurls[]=$burldata->child_url;
          }*/
        } 
      }  
    }
?>

</body>

</html>
