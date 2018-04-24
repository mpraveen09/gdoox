@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
   <!--<h2>CRM</h2>-->
    <!--<div class="page-top-links">-->
    <!--</div>-->
@endsection

@section('right_col_title_right')
@endsection

@section('right_col')

    @if (Session::has('message'))
        <div class="alert alert-info">{!!  Session::get('message')  !!}</div>
    @endif
    <!-- if there are creation errors, they will show here -->
    @if (HTML::ul($errors->all()))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!! HTML::ul($errors->all()) !!}
        </div>
    @endif

    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>B2B Price Request</h2>
            <a href="{!! route('dashboard-index') !!}" type="submit" class="btn btn-default"><i class='zmdi zmdi-home'></i></a>
        </div><!-- .card-header -->
        <div class="card-body card-padding">    
            {!! Form::open([
                'method' => 'POST',
                'route' => 'price-request.store',
                'class' => 'form-horizontal form-label-left'
            ]) !!}

                <input type="hidden" name="product_id" id="product_id" value="{!! $product_id !!}">
                   
                <div class="form-group clearfix">
                    {!! Form::label('shopid','Store', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('shopid', $shopid, array('readonly','placeholder'=>'Store','class'=>'form-control')) !!}
                    </div>
                </div>
                
<!--            <div class="form-group clearfix">
                    {!! Form::label('subject','Subject', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('subject','', array('required','placeholder' =>'Subject','class'=>'form-control')) !!}
                    </div>    
                </div>-->

                <div class="form-group clearfix">
                    {!! Form::label('message','Message', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::textarea('message', '', array('required','placeholder' =>'Message','class'=>'form-control')) !!}
                    </div>    
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button id="send" type="submit" class="btn btn-round btn-success">Send Request</button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
     </div>
@endsection

@section('footer_add_js_script')

<script>

</script>
@endsection


