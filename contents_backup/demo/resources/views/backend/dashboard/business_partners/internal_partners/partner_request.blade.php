@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2> Business Ecosystem</h2>-->
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

@include('navigation_tabs.business_ecosystem_tabs')  

<div class="card">
    <div class="card-header bgm-blue head-title">
        <h2>Join Request</h2>
    </div><!-- .card-header -->
    <div class="card-body card-padding">
      {!!Form::open(array('route'=>['invite.inter.partner.store', $data['user_id']]))!!}
      {!!Form::hidden('request_type', 'partner')!!}
      {!!Form::hidden('invitee_id', $data['owner_id'])!!}
      <div class="form-group clearfix">
              {!! Form::label('email', 'Invitee Email', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12'))!!} 
        <div class="col-md-6 col-sm-6 col-xs-12">
              {!!  Form::email('invitee_email', $data['owner_email'], array("readonly", 'class'=>'form-control'))!!}
        </div>
      </div>
      <div class="form-group clearfix">
              {!! Form::label('email', 'Site Slug', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12'))!!} 
        <div class="col-md-6 col-sm-6 col-xs-12">
              {!!  Form::text('site_slug', $shopid,array("readonly", 'class'=>'form-control'))!!}
        </div>
      </div>
      <div class="form-group clearfix">
              {!! Form::label('interest', 'Interest In', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12'))!!} 
        <div class="col-md-6 col-sm-6 col-xs-12">
              {!!  Form::text('interest', '',array( 'class'=>'form-control'))!!}
        </div>
      </div>
      <div class="form-group clearfix">
              {!! Form::label('message', 'Message', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12'))!!} 
        <div class="col-md-6 col-sm-6 col-xs-12">
              {!!  Form::textarea('message', null,array('size' => '30x5', 'class'=>'form-control'))!!}
        </div>
      </div>
      <div class="form-group clearfix">
          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
            <button  type="submit" class="btn btn-success" onclick='return confirm("Are you sure you want to join?")'>Join</button>
          </div>
      </div>
      {!!Form::close()!!}
    </div>
</div>
@endsection    
 