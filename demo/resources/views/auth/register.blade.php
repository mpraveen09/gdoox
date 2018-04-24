@extends('layout.backend.masterlogin')
@section('content_register')
@if (Session::has('message'))
<div class="alert alert-info">{!!  Session::get('message')  !!}</div>
@endif

@if (HTML::ul($errors->all()))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        {!! HTML::ul($errors->all()) !!}
    </div>
@endif

<div id="l-register" class="lc-block toggled">
   {!! Form::open(array(
        'url' => 'auth/register', 
        'method' => 'post'), 
        array('class'=>"form-signin"))
    !!}
    
    @if($errors->any())
        <ul>{!! implode('', $errors->all('<li>:message</li>'))!!}</ul>
    @endif
    
    @if(isset($data['type'] ))
        <input type="hidden" value="<?php echo $data['type'] ?>" name="user_type" id="user_type">
    @endif
    
    @if(!empty($fm_data->labels))
        <div class="input-group m-b-20">
            <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
            <div class="fg-line">
                 @if(!empty($fm_data->labels['username']))
                      {!!Form::text('username',null, array("required",'placeholder' => $fm_data->labels['username'],'class'=>'form-control'))!!}
                 @endif 
            </div>
        </div>

        <div class="input-group m-b-20">
           @if(!empty($fm_data->labels['email']))
              <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
              <div class="fg-line">
                @if(!empty($email))
                  {!! Form::email('email', $email, array("required", 'readonly', 'placeholder' => $fm_data->labels['email'],'class'=>'form-control'))!!}
                @else
                  {!! Form::email('email', null, array("required", 'placeholder' => $fm_data->labels['email'],'class'=>'form-control'))!!}
                @endif 
              </div>
           @endif 
        </div>
    
        @if(isset($gdoox_code))
           <div class="input-group m-b-20">
              @if(!empty($fm_data->labels['gdoox_code']))
                 <span class="input-group-addon"><i class="zmdi zmdi-code-smartphone"></i></span>
                 <div class="fg-line">
                     {!! Form::text('gdoox_code', $gdoox_code, array('readonly', 'placeholder' => $fm_data->labels['gdoox_code'],'class'=>'form-control'))!!}
                 </div>
              @endif 
           </div>
        @endif 
     
        <div class="input-group m-b-20">
            <span class="input-group-addon"><i class="zmdi zmdi-male"></i></span>
            <div class="fg-line">
                 @if(!empty($fm_data->labels['password']))
                     {!! Form::password('password',array("required",'placeholder' =>$fm_data->labels['password'],'class'=>'form-control')) !!}
                 @endif 
            </div>
        </div>
    
        <div class="input-group m-b-20">
            <span class="input-group-addon"><i class="zmdi zmdi-male"></i></span>
            <div class="fg-line">
                 @if(!empty($fm_data->labels['confirm']))
                      {!! Form::password('password_confirmation',array("required",'placeholder' =>$fm_data->labels['confirm'], 'class'=>'form-control')) !!}
                 @endif 
            </div>
        </div>

        <div class="clearfix"></div>

        <!--div class="checkbox">
            <label>
                <input type="checkbox" value="">
                <i class="input-helper"></i>
               {!!$fm_data->labels['license']!!}
            </label>
        </div-->
   @endif
    <!--<a class="btn btn-login btn-danger btn-float waves-effect waves-circle waves-float" href=""><i class="zmdi zmdi-arrow-forward"></i></a>-->
    @if(!empty($fm_data->labels['submit']))
        {!! Form::button('<i class="zmdi zmdi-arrow-forward"></i>',array('type'=>'submit', 'class'=>'btn btn-login btn-danger btn-float waves-effect waves-circle waves-float')) !!}
    @endif
    
   {!! Form::close()!!}
    <ul class="login-navigation">
        <li class="bgm-green" data-block="#l-login">{!!HTML::link('/auth/login',$fm_data->labels['button'], array('class'=>'')) !!}</li>
        <li class="bgm-orange" data-block="#l-forget-password">{!!HTML::link('/password/email',$fm_data->labels['forget'], array('class'=>'forgot-password')) !!}</li>
    </ul>
</div>
@endsection