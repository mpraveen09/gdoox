@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>Distribution Network</h2>-->
<!--<div class="page-top-links">-->
<!--</div>-->
@endsection

@section('right_col_title_right')
@endsection

@section('header_add_js_script')        
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

   <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>Gdoox Subscription Payment - PayPal Info</h2>
            <a href="{!! route('dashboard-index')  !!}" type="submit" class="btn btn-default"><i class='zmdi zmdi-home'></i>Home</a>
            <button onclick="goBack()" class="btn btn-default waves-effect">Back</button>
        </div><!-- .card-header -->
        

        <div class="card-body card-padding">    
            <div role="tabpanel" class="tab-pane active" id="sales">
              {!! Form::model($paypalinfo, [
                  'method' => 'PUT',
                  'route' => ['gdoox-paypal.update', $paypalinfo->_id],
                  'class' => 'form-horizontal form-label-left',
                  'novalidate'=>''
              ]) !!}

             
                    <div class="form-group clearfix">
                        {!! Form::label('paypal_name','Paypal Name', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('paypal_name', $paypalinfo->paypal_name, array('required' => 'required','class'=>'form-control')) !!}
                        </div>    
                    </div>
                    <div class="form-group clearfix">
                        {!! Form::label('paypal_id','Paypal ID/Email', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('paypal_id', $paypalinfo->paypal_id, array('required' => 'required','class'=>'form-control')) !!}
                        </div>    
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                            {!!HTML::linkRoute('gdoox-paypal.index','Cancel', array(), array('class'=>"btn btn-round btn-primary"))!!}
                            <button id="send" type="submit" class="btn btn-round btn-success">Update</button>
                        </div>
                    </div>
            {!! Form::close() !!}
            </div>
        </div>

   </div>

@endsection

@section('footer_add_js_script')
<script>
function goBack() {
    window.history.back();
}
</script>
@endsection



