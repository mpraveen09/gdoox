@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
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
            <h2>Gdoox Subscription</h2>
            <button onclick="goBack()" class="btn btn-default waves-effect">Back</button>
        </div>
        <div class="card-body card-padding">    
            {!! Form::open([
                'method' => 'POST',
                'route' => 'country-subscription.store',
                'class' => 'form-horizontal form-label-left'
            ]) !!}

            <div class="form-group clearfix">
                {!! Form::label('country','Country', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::select('country', $filtered_countries, null, array('required', 'placeholder' =>'--Select--', 'class'=>'form-control')) !!}
                </div>    
            </div>
            
            <div class="form-group clearfix">
                {!! Form::label('currency','Currency', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::select('currency', $currency, null, array('required', 'placeholder' =>'--Select--', 'class'=>'form-control')) !!}
                </div>    
            </div>
            

            <div class="form-group clearfix">
                {!! Form::label('personal_user','Personal User Charges' , array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('personal_user_price','', array('required','placeholder'=>'Price','class'=>'form-control')) !!}
                </div>    
             </div>
 
			<div class="form-group clearfix">
                {!! Form::label('mono_user','Mono User Charges' , array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('mono_user_price','', array('required','placeholder'=>'Price','class'=>'form-control')) !!}
                </div>    
             </div>
           <div class="form-group clearfix">
                {!! Form::label('multi_user','Multi User Charges' , array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('multi_user_price','', array('required','placeholder'=>'Price','class'=>'form-control')) !!}
                </div>    
             </div>
            
            <div class="form-group clearfix">
                {!! Form::label('multi_site_user','Company Network User Charges' , array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('multi_site_user_price','', array('required','placeholder'=>'Price','class'=>'form-control')) !!}
                </div>    
             </div>
            
            <div class="form-group clearfix">
                {!! Form::label('ecosystem_user','Ecosystem User Charges' , array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('ecosystem_user_price','', array('required','placeholder'=>'Price','class'=>'form-control')) !!}
                </div>    
             </div>
            
            
            <div class="form-group clearfix">
                {!! Form::label('status','Status', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::select('status', $status, null, array('required', 'placeholder' =>'--Select--', 'class'=>'form-control')) !!}
                </div>    
            </div>

            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button id="send" type="submit" class="btn btn-round btn-success">Create</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>       
@endsection

@section('footer_add_js_files') 
@endsection       

@section('footer_add_js_script')

<script type="text/javascript">
function goBack() {
    window.history.back();
}
</script>

@endsection



