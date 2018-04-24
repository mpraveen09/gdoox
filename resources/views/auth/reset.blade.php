@extends('master')
@section('content')
    <!-- will be used to show any messages -->
    @if (Session::has('message'))
        <div class="alert alert-info">{!!  Session::get('message')  !!}</div>
    @endif
    <div class="container">
          {!! Form::open(['url'=>'/password/reset']) !!}
          {!! Form::hidden('token',$token)!!}
          <h3 class="well text-center">Reset Password</h3>
          <div class="col-md-6 col-md-offset-2"
              <p>
             @if($errors->any())
                <ul>
                  <?php echo implode('', $errors->all('<li>:message</li>'))?>
                </ul>
              @endif
                <span class="reauth-email" id="reauth-email"></span>
                    {!! Form::label('email', 'Email Address')  !!}  
                    {!! Form::email('email', Input::old('email'), array("required",'placeholder' => 'Email address','class'=>'form-control','id'=>'inputEmail'))!!}
                    {!!Form::label('password', 'Enter your new password')!!}
                    {!! Form::password('password',array("required",'placeholder' => 'Password','class'=>'form-control'))!!}
                    {!!Form::label('password', 'Confirm new password')!!}
                    {!! Form::password('password_confirmation',array("required",'placeholder' => 'Re-enter your password','class'=>'form-control'))!!}
             </p>                         
              <p>{!! Form::submit('Reset',array('class'=>'btn  btn-primary'))  !!}</p>
          </div>   
          {!!Form::close()!!}
    </div>    

@endsection