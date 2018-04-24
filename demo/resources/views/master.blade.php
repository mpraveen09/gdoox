<!DOCTYPE html>
<html lang="en">

    <head>
        <title>
           GDoox - Re-Inventing eCommerce
        </title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
        <!-- Include roboto.css to use the Roboto web font, material.css to include the theme and ripples.css to style the ripple effect -->
        <link href="{{ asset('/bootmd/css/roboto.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/bootmd/css/material.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/bootmd/css/material-fullpalette.css') }}" rel="stylesheet">
        <link href="{{ asset('/bootmd/css/ripples.min.css') }}" rel="stylesheet">
        
        <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,100italic,300italic,400italic,700italic|Roboto:500,400italic,100,300,500italic,100italic,300italic,400' rel='stylesheet' type='text/css'>
        
        <link href="{{ asset('/css/styles.css') }}" rel="stylesheet">

    </head>

    <body>
      @if (Session::has('message'))
        <div class="alert alert-info">{!!  Session::get('message')  !!}</div>
    @endif
 
      
      <div class="row header-logo-row">
          <div class="col-md-6 col-sm-6">
              <a href="<?php echo URL::to('/');?>">
                <img src="{{ asset('images/gdoox.png') }}" alt="GDoox" class="logo-header"/>
              </a>
          </div>
        <div class="col-md-6 col-sm-6">
              <div class="col-md-12 text-right">
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
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="<?php echo URL::to('/');?>" class="langlink">EN </a> &nbsp;|&nbsp; <a href="<?php echo URL::to('lang/it');?>" class="langlink">IT</a> &nbsp;|&nbsp; <a href="<?php echo URL::to('lang/es');?>" class="langlink">ES</a>
              </div>
              <div class="col-md-12 text-right header-links">
                <a href="<?php echo URL::to('contact');?>"><h4>About Us</h4></a>
                <a href="<?php echo URL::to('contact');?>"><h4>Investors</h4></a>
              </div>
          
        </div>
          
      </div>
      
      
      @yield('header_banner')
      
      <div class="navbar navbar-default">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!--a class="navbar-brand" href="javascript:void(0)"><span>Project C</span> <i class="mdi-maps-local-shipping"></i></a-->
        </div>
        <div class="navbar-collapse collapse navbar-responsive-collapse">
          <ul class="nav navbar-nav">
              <li><a href="<?php echo URL::to('contact');?>">MARKETPLACE</a></li>
              <li><a href="<?php echo URL::to('contact');?>">PROCUREMENT</a></li>
              <li><a href="<?php echo URL::to('contact');?>">AUCTION</a></li>
              <li><a href="<?php echo URL::to('contact');?>">REVERSE AUCTION</a></li>
              <li><a href="<?php echo URL::to('contact');?>">TRAINING CENTER</a></li>
              <li><a href="<?php echo URL::to('contact');?>">CROWDFUNDING</a></li>
          </ul>

          
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo URL::to('contact');?>">SIGN UP</a></li>
            <li><a href="<?php echo URL::to('contact');?>">LOGIN</a></li>
          </ul>
        </div>
      </div>
      
        
      @yield('content')

      
      <!-- SCRIPTS AND STYLES -->

      <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

      <script src="{{ asset('/bootmd/js/ripples.min.js') }}"></script>
      <script src="{{ asset('/bootmd/js/material.min.js') }}"></script>

      <script>
          $(document).ready(function() {
              // This command is used to initialize some elements and make them work properly
              $.material.init();
          });
      </script>

    </body>

</html>