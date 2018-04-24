@extends('layout.frontend_home.masterbase')

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
    <!--<link href="{{ asset('/css/custom-2.css') }}" rel="stylesheet">-->
    <style>
        #header {
            /*background: #FFFFFF;*/
        }        
        .form-group{
                /*margin-bottom: 10px;*/
        }
        .header-banner{
            max-width: 100%;
        }
        .card-header.no-padding{
            padding: 0 !important;
        }
/*        .clist li{
            font-size: 12px;
        }*/
        
        .home-banner-text{
/*            background: url(../../../../public/images/analyst.jpg);
            background-size: cover*/
        }
        
        .home-banner-text {
            font-family: "Lato", Helvetica, Arial, sans-serif;
            /*color: #fff;*/
            
        }
        .home-banner-text h1, .home-banner-text h2, .home-banner-text h3{
            /*color: #fff;*/
            font-weight: 300;
            color: #5e5e5e

        }
        .home-banner-text h1{
            padding: 20px 0;
            font-family: "Lato", Helvetica, Arial, sans-serif;
            font-size: 60px;
            /*color: #fff;*/
            /*color: #4285F4;*/
            /*color: #f44336;*/
        }
        .home-banner-text ul{
            font-family: 'Roboto', sans-serif;
            font-size: 18px;
            font-weight: normal;
            line-height: 150%;       
            /*text-shadow: 1px 1px 0 #000;*/
        }
        .home-banner-text h2, .home-banner-text h3{
            font-weight: 500 
        }
        
        .gdoox-serv{
            font-family: 'Roboto', sans-serif;            
        }        
        .gdoox-serv .card-header h2{
            font-family: "Lato", Helvetica, Arial, sans-serif;
            font-family: 'Roboto', sans-serif;
            font-weight: 400;
            font-size: 22px;      
            text-transform: uppercase;
            /*text-shadow: 0px 0px 0 #000;*/
            word-wrap: break-word
        }
        .card-banner{
            width: 100%
        }
        .gdoox-serv .card-footer{
                font-size: 20px;
                color: #fff;
                font-weight: 400;
                padding: 20px 0;
                font-family: "Lato", Helvetica, Arial, sans-serif;
                font-size: 50px;
                font-weight: 300;                
                line-height: 100%;
                word-wrap:break-word; 
                 
        }
        
        .gdoox-serv .card-body .clist{
            font-size: 15px;
            font-weight: 300;
            padding-right: 10px;
        }
        .gdoox-serv .card-body .clist li{
            margin-bottom: 5px
        }
        
        .langlink{
            font-size: 16px;
            color: #fff;
            text-decoration: none;
            padding-top: 5px;
                display: inline-block;
            
        }
        .langlink:hover{
            text-decoration: none;
            color: #fffba4;
        }


        .gdoox-c {
            display: inline-block;
            background: #2a8bcd;
            color: #fff;
            font-family: "Lato", Helvetica, Arial, sans-serif;
            font-size: 20px;
            line-height: 60px;
            border-radius: 100%;
            width: 60px;
            height: 60px;
            font-weight: normal;
            background: #1b4792;
            margin: 5px;
        }
        
        .sitetype{
            font-size: 20px;
            color: #1b4792;
            font-weight: 300;       
            padding: 30px 5px;
        }
        .footer-inv h1{
            padding: 20px 0;
            font-family: "Lato", Helvetica, Arial, sans-serif;
            font-size: 50px;     
            font-weight: 300;
            color: #f44336
        }
        .footer-inv h1 a{
            text-transform: none;
            color: #f44336
            
        }
        .footer-inv h1:hover{
            background: #f44336;
        }
        .footer-inv h1:hover a{
            color: #fff
        }
        
        .clist.clist-star > li:before {
            color: #f44336;
        }        
        
        .contaact-head{
            font-family: "Lato", Helvetica, Arial, sans-serif;
            font-size: 50px;     
            font-weight: 300;
            
        }
        .thnx{
            color: #f44336;
            color: #009688
        }
        
/*        .gdoox-serv .card .card-header .btn.btn-float{
            right: 15px !important;
            bottom: -15px !important;           
            width: 35px !important;
            height: 35px !important;
            border-radius: 50% !important;
            line-height: 35px!important;    
            padding: 5px 5px !important;
        }
        .gdoox-serv .card .card-header i.zmdi{
            font-size: 20px !important;
        }*/
        
/*gdoox-serv .card .card-header .btn-float {
    right: 25px;
    bottom: -23px;
    z-index: 1;
}
.btn-float {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    line-height: 45px!important;
}*/

.gdoox-serv i.zmdi-plus:before{
    content: '\f278';
}
.gdoox-serv .collapsed i.zmdi-plus:before{
    content: '\f278';
}

.gdoox-serv .collapsed i.zmdi-plus[aria-expanded="true"]:before{
    content: '\f273';
}


/*____________________*/
.home-banner{
  background: url("{{ asset('images/business-163464_.jpg') }}") no-repeat center center fixed #444;
  background-attachment: fixed !important;
  -webkit-background-size: 100%;
  -moz-background-size: 100%;
  -o-background-size: 100%;
  background-size: 100%;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;


}
.home-banner-row{
  padding-top: 50px;
  padding-bottom: 50px;  
  min-height: 300px;
}
.home-banner-row h1{
    padding: 20px 0;
    font-family: "Lato", Helvetica, Arial, sans-serif;
    font-size: 60px;
    color: #fff;
    font-weight: 300;
    line-height: 100%;  
}
.home-banner-row .carousel-indicators {
   position: relative; 
   left: 0%; 
   width: 100%; 
   margin-left: 0%; 
   /*text-align: left*/
   background: transparent
}
.home-banner-row .carousel-inner{
  padding: 25px 10%;
  /*text-align: left;*/
}
.home-banner-row .carousel-inner .item{
  min-height: 180px;
}

.banner-title{
  color: #fff;
  text-shadow: rgba(0, 0, 0, 0.6) 0px 1px 2px;
}

.home-banner-row .panel-title{
  font-size: 22px;
  font-weight: 300; 
}

.quote-form{
  padding: 5px 5%;
}

.quote-form h3{
  color: #fff;
  margin-bottom: 20px;
  font-family: "Lato", Helvetica, Arial, sans-serif;
}

.quote-form input{
  color: #fff;
  
}

.quote-form .form-control {
  /*background-image: linear-gradient(#1b4792, #1b4792), linear-gradient(#d2d2d2, #d2d2d2) !important;*/
  /*background-image: linear-gradient(#fff, #fff), linear-gradient(#d2d2d2, #d2d2d2) !important;*/
  background: transparent;
  color: #fff;
}


.quote-form.form-white-bg h3{
  color: #2a8bcd;
  font-weight: 500
}

.quote-form.form-white-bg input{
  color: #444;
}

.quote-form.form-white-bg .form-control {
  /*background-image: linear-gradient(#1b4792, #1b4792), linear-gradient(#d2d2d2, #d2d2d2) !important;*/
  /*background-image: linear-gradient(#2a8bcd, #2a8bcd), linear-gradient(#d2d2d2, #d2d2d2) !important;*/
}





#header{
    position: relative !important;
}
body{
    padding-top: 0;
}

.quote-form input::-webkit-input-placeholder {
   color: #e0e0e0;
}

.quote-form input:-moz-placeholder { /* Firefox 18- */
   color: #e0e0e0;  
}

.quote-form input::-moz-placeholder {  /* Firefox 19+ */
   color: #e0e0e0;  
}

.quote-form input:-ms-input-placeholder {  
   color: #e0e0e0;  
}


/*.gdoox-serv .card .card-header:not(.ch-alt) {
    padding: 23px 13px;
}*/

.home-banner-text .clist{
    /*text-align: justify;*/
}

    </style>
    
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,100italic,300italic,400italic,700italic|Roboto:500,400italic,100,300,500italic,100italic,300italic,400' rel='stylesheet' type='text/css'>
@endsection

@section('header-logo-url')
{{ URL::to('/') }}
@endsection
@section('header-logo')
{{ asset('images/gdoox__.png') }}
@endsection




@section('right_col')
<!--page content-->
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
@endsection

@section('footer')
<!--                    <ul class="f-menu">
                        <li><a href="">Home</a></li>
                        <li><a href="">Dashboard</a></li>
                        <li><a href="">Reports</a></li>
                        <li><a href="">Support</a></li>
                        <li><a href="">Contact</a></li>
                        <li><a href="">Privacy Policy</a></li>
                        <li><a href="">Terms Of Use</a></li>
                    </ul>-->

                    <div class="">
                        <p class="">
                            <span class=""> Copyright &copy; {{ date('Y') }} Gdoox. All Rights Reserved.</span>
                        </p>
                    </div>
@endsection

@section('footer_add_js_script')
@endsection
@section('custom_notifications')
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
@endsection
