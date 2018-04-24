@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <!--<h2> Products</h2>-->
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
    
    @include('navigation_tabs.product_mgmt_tabs')
    
    <div class="card">
        <div class="card-header bgm-blue head-title">
          <h2>Product Promotional Banner/Stickers Create</h2>
          <a href="{!! route('business-info-create') !!}" class="btn btn-round btn-default">Create New</a>
          <a href="{!! route('business-info-index')  !!}" class="btn btn-round btn-default">View All</a>
        </div><!-- .card-header -->
        <div class="card-body card-padding">    
          {!! Form::model($products_promo, [
                    'method' =>'PUT', 
                    'route' =>[ 'product_promo.update', $products_promo->id], 
                    'class'=>'form-horizontal form-label-left'
                    ]) !!}

              <div class="form-group clearfix">
                  {!! Form::label('promo_product_text', 'Product Promotional Banner Text'.$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                  <div class="col-md-6 col-sm-6 col-xs-12">
                  {!! Form::text('product_promo_text', $products_promo->product_promo_text, array('required', 'class'=>'form-control')) !!}
                 </div>    
              </div>
              
              <div class='cp-container'>
                  {!! Form::label('banner_bg_color', 'Banner Background Color', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                <div class='input-group form-group'>
                    <div class='fg-line dropdown'>
                        {!! Form::text('banner_bg_color', $products_promo->banner_bg_color, array('class'=>'form-control cp-value', 'data-toggle'=>'dropdown')) !!}
                       <div class='dropdown-menu'>
                        <div class='color-picker' data-cp-default='{!!$products_promo->banner_bg_color!!}'></div>
                      </div>
                      <i class='cp-value'></i>
                    </div>
                </div>
              </div>
              
              <div class='cp-container'>
                  {!! Form::label('product_promo_text_color', 'Product Promotional Banner Text', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                    <div class='input-group form-group'>
                        <div class='fg-line dropdown'>
                            {!! Form::text('product_promo_text_color', $products_promo->product_promo_text_color, array('class'=>'form-control cp-value', 'data-toggle'=>'dropdown')) !!}
                           <div class='dropdown-menu'>
                            <div class='color-picker' data-cp-default='{!!$products_promo->product_promo_text_color!!}'></div>
                          </div>
                          <i class='cp-value'></i>
                        </div>
                    </div>
              </div>
                    
              <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4">
                       <button  type="submit" class="btn btn-round btn-success">Update & Preview</button>
                       @if($products_promo->status === "disabled")
                       <a href="{!!route('product_promo.toggle', [$products_promo->id, 'enabled'])!!}" class="btn btn-default" >Show On Site</a>  
                       @else
                       <a href="{!!route('product_promo.toggle', [$products_promo->id, 'disabled'])!!}" class="btn btn-default" >Hide From Site</a>  
                       @endif
                      {!!HTML::linkRoute('product_promo.index', 'Cancel', array(), array('class'=>"btn btn-round btn-primary"))!!}
                  </div>
              </div>
          {!! Form::close() !!}
        </div>
    </div>    
@endsection

@section('footer_add_js_files') 
      <script src="{{ asset('/m-admin-ui/vendors/fileinput/fileinput.min.js') }}"></script>
      <script src="{{ asset('/m-admin-ui/vendors/input-mask/input-mask.min.js') }}"></script>
@endsection       