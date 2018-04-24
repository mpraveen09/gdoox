@extends('layout.backend.masterlogin')
@section('forgot_password')
<div id="l-forget-password" class="lc-block toggled">
    <p class="text-left">Send Password Reset Link</p>
    @if (Session::has('message'))
        <div class="alert alert-info">{!!  Session::get('message')  !!}</div>
    @endif
   @if($errors->any())
      <ul>
        {!!implode('', $errors->all('<li>:message</li>'))!!}
      </ul>
    @endif
   {!! Form::open(['url'=>'/password/email'])!!}
     <div class="input-group m-b-20">
        <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
        <div class="fg-line">
         {!! Form::email('email', Input::old('email'), array("required",'placeholder' => 'Email address','class'=>'form-control','id'=>'inputEmail'))!!}
        </div>
    </div>

    <!--<a class="btn btn-login btn-danger btn-float waves-effect waves-circle waves-float" href=""><i class="zmdi zmdi-arrow-forward"></i></a>-->
     {!! Form::button('<i class="zmdi zmdi-arrow-forward"></i>',array('type'=>'submit', 'class'=>'btn btn-login btn-danger btn-float waves-effect waves-circle waves-float'))  !!}
   {!!Form::close()!!}
    <ul class="login-navigation">
        <li class="bgm-green" data-block="#l-login">{!!HTML::link('/auth/login','login', array('class'=>'')) !!}</li>
        <li class="bgm-red" data-block="#l-register">{!!HTML::link('/auth/register','Register', array('class'=>'')) !!}</li>
    </ul>
</div>

@endsection