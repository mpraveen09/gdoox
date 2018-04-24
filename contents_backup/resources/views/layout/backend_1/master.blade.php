@extends('layout.backend.masterbase')

@section('meta')        
    <title>GDoox - Re-Inventing eCommerce</title>
	<meta name="description" content="Gdoox is a powerful  ecosystem platform. Its the e-commerce new frontier where over 200 business sectors containing more than 25.000  products categories organized by plant machinery equipment, products and services allow you to trade in any distribution channel. Sharing economy at your finger.">
	<meta property="og:title"         content="GDoox - Re-Inventing eCommerce" />
	<meta property="og:description"   content="Gdoox is a powerful  ecosystem platform. Its the e-commerce new frontier where over 200 business sectors containing more than 25.000  products categories organized by plant machinery equipment, products and services allow you to trade in any distribution channel. Sharing economy at your finger." />
@endsection

@section('header_add_js_files')        
    <!--header_add_js_files-->
@endsection

@section('header_add_js_script')        
 @endsection

@section('header_custom_css')        
    <!--header_custom_css-->
    <link href="{{ asset('/css/custom-1.css') }}" rel="stylesheet">
@endsection


@section('left_col')
  
    <div class="left_col scroll-view">

        <div class="navbar nav_title" style="border: 0;">
            <a href="<?php echo URL::to('/');?>" class="site_title"><img src="{{ asset('images/gdoox.png') }}" alt="GDoox" class="logo-header"/></a>

        </div>
        <div class="clearfix"></div>

        <!-- menu prile quick info -->
        <div class="profile">
            <div class="profile_pic">
                <img src="@yield('profile_pic')" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>@yield('profile_name')</h2>
            </div>
        </div>
        <!-- /menu prile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
                <br />&nbsp;<br />
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="{!! route('dashboard-index')!!}">Dashboard</a></li>
                            </li>
                            <li><a href="#">Dashboard2</a>
                            </li>
                            <li><a href="#">Dashboard3</a>
                            </li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-edit"></i>Personal Profiles <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="{!! route('dashboard-user-profile')!!}">View User Profile</a></li>
                            <li><a href="{!! route('personal-profiles-create')!!}">Create</a></li>
                            <li><a href="{!! route('personal-profiles-index')!!}">View All</a></li>
                        </ul>
                    </li> 
                    
                    <li><a><i class="fa fa-edit"></i>Company Profiles <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="{!! route('company-profiles-create')!!}">Create</a></li>
                            <li><a href="{!! route('company-profiles-index')!!}">View All</a></li>
                        </ul>
                    </li> 
                    
                    <li><a><i class="fa fa-edit"></i>User Management <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="{!! route('dashboard-user-create')!!}">Create User</a></li>
                            <li><a href="{!! route('dashboard-users')!!}">All Users</a></li>
                        </ul>
                    </li>  

                    <!--Navigations added by Deep-->
                    @include('layout.backend.navs-deep')
                    
                    <!--Navigations added by Sanjay-->
                    @include('layout.backend.navs-sanjay')
                
                </ul>
                
            </div>
            

        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
@endsection


@section('top_nav')
                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> 
                                    <img src="@yield('profile_pic')" alt="">@yield('profile_name')
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                               
                                    <?php if(Auth::user()){ $id= Auth::user()->id;}?>
                                    <li>
                                      <a href="{!! route('dashboard-profile-index')!!}">Profile</i>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span>Settings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">Help</a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-sign-out pull-right"></i><?php echo HTML::link('auth/logout','Log Out');?> </a>
                                    </li>
                                </ul>
                            </li>

                            <li role="presentation" class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="badge bg-green">@yield('alert_count')</span>
                                </a>
                                <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                                    @yield('alert_content')
                                </ul>
                            </li>

                        </ul>
                    </nav>
                </div>
@endsection

@section('right_col_title')
<div class="page-title">
    <div class="title_left">
        @yield('right_col_title_left')
    </div>

    <div class="title_right">
        @yield('right_col_title_right')
    </div>
</div>
@endsection

@section('right_col')
<!--page content-->
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>

@endsection



@section('footer')
                    <div class="">
                        <p class="pull-right"><a>Privacy Policy</a> | <a>Terms Of Use</a> .
                            <span class="lead"> &copy; Gdoox</span>
                        </p>
                    </div>
@endsection


@section('custom_notifications')
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
@endsection
