@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>{!!$product_type['title']!!} Products</h2>-->
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
            <h2>Edit</h2>
            <a href="{!! route($product_type['type'].'.create')  !!}" class="btn btn-default">Create New</a>
            <a href="{!! route($product_type['type'].'.index')  !!}" class="btn btn-default">View All</a>
        </div><!-- .card-header -->
        <div class="card-body card-padding">    
          {!! Form::model($multi_item_product, array(
                        'method'=>'PUT', 
                        'route' => [$product_type["type"].'.update', $multi_item_product->id], 
                        'class'=>'form-horizontal form-label-left')
                        ) !!}

              @if (!empty($field))
                  <div class="form-group clearfix">
                      @if(!empty($field['shop_id']))
                        {!! Form::label('Company Site', 'Company Site'."*", array('class'=>'control-label col-md-3 col-sm-3 col-xs-12', 'data-toggle'=>"tooltip", 'data-placement'=>"bottom", 'title'=>'Company Site')) !!}
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::select("attr_id[".$field['shop_id']->attr_id."]", $site, $multi_item_product->shopid, array('class'=>'form-control')) !!}
                          </div>    
                      @endif
                  </div>
      
                  <div class="form-group clearfix">
                      @if(!empty($field['post_date']))
                           {!! Form::label($field['post_date']->desc, $field['post_date']->label."*", array('class'=>'control-label col-md-3 col-sm-3 col-xs-12', 'data-toggle'=>"tooltip", 'data-placement'=>"bottom", 'title'=>$field['post_date']->desc)) !!} 
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::date("attr_id[".$field['post_date']->attr_id."]", $multi_item_product->postdate, array('required', 'class'=>'form-control',  "min"=> date("Y-m-d"))) !!}
                          </div>    
                      @endif
                  </div>
              
                  <div class="form-group clearfix">
                      @if(!empty($field['product_name']))
                           {!! Form::label($field['product_name']->desc, $field['product_name']->label."*", array('class'=>'control-label col-md-3 col-sm-3 col-xs-12', 'data-toggle'=>"tooltip", 'data-placement'=>"bottom", 'title'=>$field['product_name']->desc)) !!} 
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::text("attr_id[".$field['product_name']->attr_id."]", $multi_item_product->desc, array('required', 'class'=>'form-control')) !!}
                          </div>    
                      @endif
                  </div>

                  <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                           <button id="send" type="submit" class="btn btn-round btn-success">Next</button>
                          {!!HTML::linkRoute($product_type["type"].'.index', 'Cancel', array(), array('class'=>"btn btn-round btn-primary"))!!}
                      </div>
                  </div>
                 @endif
            {!! Form::close() !!}
        </div>
    </div>    
@endsection


@section('footer_add_js_script')

<script type="text/javascript">
function goBack() {
        window.history.back();
}
</script>
@endsection
