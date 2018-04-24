@extends('layout.backend.masterlogin')
@section('content_login')
    

 <div id="l-login" class="lc-block toggled">
    @if (Session::has('message'))
        <div class="">{!!  Session::get('message')  !!}</div>
    @endif

    @if (HTML::ul($errors->all()))
      <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          {!! HTML::ul($errors->all()) !!}
      </div>
    @endif
    
   {!!Form::open(array('url' => 'auth/login', 'method' => 'post'),array('class'=>"form-signin")) !!}
    <!-- if there are login errors, show them here -->
    <p>
       {!!$errors->first('email') !!}
       {!!$errors->first('password') !!}
    </p>
    <div class="input-group m-b-20">
        <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
        <div class="fg-line">
          {!!Form::email('email', Input::old('email'), array("required",'placeholder' =>$fm_data->labels['email'],'class'=>'form-control','id'=>'inputEmail'))!!}
        </div>
    </div>

    <div class="input-group m-b-20">
        <span class="input-group-addon"><i class="zmdi zmdi-male"></i></span>
        <div class="fg-line">
           {!!Form::password('password', array("required",'placeholder' =>$fm_data->labels['password'],'class'=>'form-control','id'=>'inputPassword')) !!}
        </div>
    </div>

    <div class="clearfix"></div>

    <!--div class="checkbox">
        <label>
            <input type="checkbox" value="">
            <i class="input-helper"></i>
           {!!$fm_data->labels['remember']!!}
        </label>
    </div-->

    {!! Form::button('<i class="zmdi zmdi-arrow-forward"></i>',array('type'=>'submit', 'class'=>'btn btn-login btn-danger btn-float waves-effect waves-circle waves-float'))!!}
    {!! Form::close()!!}
    <ul class="login-navigation">
        <li class="bgm-red" data-block="#l-register">{!!HTML::link('/auth/register',$fm_data->labels['submit'], array('class'=>'')) !!}</li>
        <li class="bgm-orange" data-block="#l-forget-password">{!!HTML::link('/password/email',$fm_data->labels['forget'], array('class'=>'forgot-password')) !!}</li>
    </ul>
</div>
@endsection