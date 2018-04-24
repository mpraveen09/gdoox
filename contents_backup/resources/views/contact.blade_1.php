@extends('master')

@section('header_banner')
<!--  <div class="container-fluid home-banner">
    <div class="row home-banner-row">
      <div class="col-xs-12 col-sm-8 col-md-8 text-center">

        
        
        
        
          <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                  <div class="item active">
                    <h1>All that you need to inprove your business</h1>
                  </div>
                  <div class="item">
                    <h1>Re-Inventing eCommerce</h1>
                  </div>
                  <div class="item">
                    <h1>Free access : Request your Invitation Code</h1>
                  </div>
                </div>
                <ol class="carousel-indicators">
                  <li data-target="#carousel-example-generic" data-slide-to="0" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="1" class="active"></li>
                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                </ol>

              </div>        
        
        
        
        
        
      </div>
      <div class="col-xs-12 col-sm-4 col-md-4">
                <form method="GET" action="<?php echo URL::to('/contactus');?>" accept-charset="UTF-8" class="bs-component quote-form">  
                    <fieldset>
                      <h3 class="panel-title">Request here your Invitation Code for FREE ACCESS</h3>
                        
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required="required">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Your Business Email" required="required">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-warning">Submit</button>
                        </div>
                    </fieldset>
                  </form>        


        
      </div>
    </div>  
  </div>-->
@endsection

@section('content')

<div class="container home-feature text-center big-txt">
    <br/>
    <h1 class="color-primary text-center">Contact Us <br/><small>Request here your Invitation Code for FREE ACCESS</small></h1>
    <br/>
    <br/>

          <div class="row">
            <div class="col-md-6 col-sm-6 col-md-offset-3 col-sm-offset-3">
                <form method="GET" action="<?php echo URL::to('/contactus');?>" accept-charset="UTF-8" class="bs-component quote-form form-white-bg">  
                    <fieldset>
                      
  <?php
  if(isset($data)){
      if(!empty($data['error']) && $data['error']===true){
  ?>
  <div class="alert alert-dismissable alert-warning">
      <p>All fields are mandatory.</p>
  </div>                      
  <?php                      
      }
    }
  ?>                      
                      
                        
                        <div class="form-group">
                          <input type="text" class="form-control" id="name_" name="name" placeholder="Your Name" required="required">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="email_" name="email" placeholder="Your Business Email"  required="required">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-warning">Submit</button>
                        </div>
                    </fieldset>
                  </form>        
            </div>
          </div>
    <br/>
</div>


<hr/>




<div class="container-fluid home-feature ">
      <div class="row header-logo-row">
          <div class="col-md-12 text-center">
            <br/><br/>
              <a href="<?php echo URL::to('/');?>">
                <img src="{{ asset('images/gdoox.png') }}" alt="GDoox" class="logo-header"/>
              </a>
            
              
            <p class="copyright"><br/>&copy; 2015 All Rights Reserved.</p>
          </div>

      </div>
  
</div>


       



@endsection
