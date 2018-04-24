
@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2> Business Follow</h2>-->
@endsection

@section('right_col_title_right')
 @endsection

@section('right_col')

@if (Session::has('message'))
    <div class="alert alert-info">{!!  Session::get('message')  !!}</div>
@endif

@if (HTML::ul($errors->all()))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        {!! HTML::ul($errors->all()) !!}
    </div>
@endif

@include('navigation_tabs.general_tabs')

<div class="card">
    <div class="card-header bgm-blue head-title">
        <h2>Follow Request</h2>
    </div><!-- .card-header -->
    <div class="card-body card-padding">
      <h4>If you are already a Gdoox member please login {!!HTML::link('auth/login', 'here!')!!} or if you are new user please fill below details.</h4>
    {!! Form::open(array('route' => 'follower.store', 'method'=>'POST', 'class'=>'form-horizontal form-label-left')) !!}
    {!!Form::hidden('shop_id', $shop_id)!!}
   
      <div class="form-group clearfix">
         {!! Form::label('follower_name', 'Name'.'*', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
         <div class="col-md-6 col-sm-6 col-xs-12">
         {!! Form::text('follower_name', null, array('required',  'class'=>'form-control')) !!}
         </div>    
      </div>
      <div class="form-group clearfix">
         {!! Form::label('follower_email', 'Email'.'*', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
         <div class="col-md-6 col-sm-6 col-xs-12">
         {!! Form::email('follower_email', '', array('required', 'class'=>'form-control')) !!}
         </div>    
      </div>
      <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
             <button id="send" type="submit" class="btn btn-round btn-success">Submit</button>
        </div>
      </div>
    {!!Form::close()!!}
    </div>
</div>
@endsection    
 