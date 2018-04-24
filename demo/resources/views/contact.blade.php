@extends('layout.frontend_home.master')



@section('right_col')


       
<div class="container text-center ">
    <br/>
    <h1 class="text-center contaact-head">Request here your Invitation Code for FREE ACCESS</h1>
    <br/>
    <br/>

          <div class="row">
            <div class="col-md-6 col-sm-6 col-md-offset-3 col-sm-offset-3">

                
        <div class="card">

            <div class="card-body  card-padding">
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
                
                
                
     
            </div>
          </div>
    <br/>
</div>


@endsection
