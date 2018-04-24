@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>{!!$product_type['title']!!} Products</h2>-->

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
            <h2>Add Quantity</h2>
            <a href="{!! route($product_type['type'].'.create')  !!}" class="btn btn-round btn-default">Create New</a>
            <a href="{!! route($product_type['type'].'.index')  !!}" class="btn btn-round btn-default">View All</a>
        </div><!-- .card-header -->
        <div class="card-body card-padding">    
          {!! Form::open(array('route' =>[ $product_type["type"].'.store_quantity', $id], 'method'=>'POST ', 'class'=>'form-horizontal form-label-left', 'files'=>true)) !!}

              {!!Form::hidden('multi_product_id', $id)!!}

              @if (!empty($field))
                  <div class="form-group clearfix">
                      @if(!empty($field['quantity']))
                           {!! Form::label($field['quantity']->desc, $field['quantity']->label."*", array('class'=>'control-label col-md-3 col-sm-3 col-xs-12', 'data-toggle'=>"tooltip", 'data-placement'=>"bottom", 'title'=>$field['quantity']->desc)) !!} 
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::number("attr_id[".$field['quantity']->attr_id."]", null, array('required', 'class'=>'form-control', 'min'=>0)) !!}
                          </div>    
                      @endif
                  </div>
                  <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                           <button id="send" type="submit" class="btn btn-round btn-success">Save</button>
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
