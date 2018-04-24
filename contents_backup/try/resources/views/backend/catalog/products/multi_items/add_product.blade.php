
@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<h2>{!!$product_type['title']!!} Products</h2>
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
            <h2>Add Product (Please add/remove your existing products to {!!$product_type['title']!!} )</h2>
            <a href="{!! route($product_type["type"].'.index')  !!}" class="btn btn-round btn-default">View All</a>
        </div><!-- .card-header -->
        <div class=" card-body card-padding">
          @if (!$products->count() )
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    No Product found for site.
                </div>
           @else
                <div class="row">
                    {!! Form::open(['method' => 'POST', 'class' => 'form-horizontal form-label-left', 'novalidate'=>'' ]) !!}
                    <div class="col-md-4 col-sm-4 col-xs-10  form-group top_search" style="padding: 20px 0; margin-left: 0px;">
                        <div class="input-group">
                            {!! Form::text('term',$term, array('required','placeholder'=>'Search Products...','class'=>'searchproducts form-control'))!!}
                            <span class="input-group-btn">
                                <button class="btn btn-default btn-icon-text waves-effect"><i class="zmdi zmdi-search"></i></button>
                            </span>                          
                        </div>
                    </div>
                    {!! Form::close() !!}
                    <div class="text-right col-md-8">
                            {!! $products->appends(['term' => $term])->render() !!}
                    </div>
                </div><!-- .card-body -->
                <div class="row">
                @foreach( $products as $product )
                    <div class="col-md-12 ">
                      <div class="col-md-3">
                        <a href="{!! route('products/show', $product->id)  !!}" class="prod_thumb" target="_blank">
                          @if (!empty($product->thumb)) 

                          <img src="{!!  asset($product->thumb_path.$product->thumb)  !!}" alt="prodcuct" width="100px;" height="100px;"/>
                          @else
                              <img src="{{ asset('images/product_img.png') }}" alt="prodcuct" width="100px;" height="100px;"/>
                          @endif
                          </a>
                      </div>
                        <div class="col-md-3">
                            @if(!empty($product->desc))
                              <h6>{!!  $product->desc  !!}</h6>
                            @endif
                        </div>
                        <div class="col-md-3">
                            @if(!empty($product->postdate))
                              <p>Post Date: {!!  $product->postdate  !!}</p>
                            @endif
                        </div>
                        <div class="col-md-3">
                             {!!Form::hidden('product_id',$product->id, array('class'=>'product_id'))!!}
                             @if(isset($multi_product->multi_item_products) && in_array($product->id, $multi_product->multi_item_products))
                                     <button href="#" class="btn btn-danger waves-effect remove_product" >Remove Product</button>
                                     <button href="#" class="btn btn-primary waves-effect add_product" style="display: none;">Add Product</button>
                             @else      
                                     <button href="#" class="btn btn-primary waves-effect add_product">Add Product</button>
                                     <button href="#" class="btn btn-danger waves-effect remove_product" style="display: none;">Remove Product</button>
                             @endif      
                         </div>
                    </div>

                    <div class="col-md-12 ">                                    
                        <br/>
                        <hr/>
                    </div>
                @endforeach
                    <div class="col-md-3 col-md-offset-5">
                          <a href="{!! route($product_type["type"].'.add_multi_item_details', $multi_product->id)  !!}" class="btn btn-round btn-success">Save</a>
                    </div>
                </div>
           @endif
        </div>
    </div>
@endsection
@section('footer_add_js_script')
<script>
    $( document ).ready(function() {
        $(this).on( "click", '.add_product', function(e){
             e.preventDefault(); 
             var add_ref=  $(this);
             var product_id= $(add_ref).parent().find('.product_id').val(); 
//             console.log(product_id);
             $.ajax({
                    url: "{!! URL::route($product_type["type"].'.store_product', $id)  !!}",
                    data: {
                        product_id: product_id,
                    },
                    success: function(data) {
//                      console.log(data);
                      if(data==='Added'){
                         $(add_ref).parent().find('.remove_product').show()
                         add_ref.hide();
                      }
                      else {
                          $("#error_div").append('<span class="label label-important">The product could not be shared!Please try Again</span>');
                         alert('Something Went Wrong! Not Able to Share. Please try Again');
                      } 
                    }
                });
        });
         $(this).on( "click", '.remove_product', function(e){
             e.preventDefault(); 
             var remove_ref=  $(this);
             var product_id=$(remove_ref).parent().find('.product_id').val(); 
//             console.log(product_id);
             $.ajax({
                    url: "{!! URL::route($product_type["type"].'.remove_product', $id)  !!}",
                    data: {
                            product_id: product_id,
                    },
                    success: function(data) {
                      console.log(data);
                        if(data==='removed'){
                           $(remove_ref).parent().find('.add_product').show()
                           remove_ref.hide();
                        }
                        else {
                            $("#error_div").append('<span class="label label-important">The product could not be Un shared!Please try Again</span>');
                        }
                    }
                });
        });
    });    
    
    function goBack() {
        window.history.back();
    }
    
</script>
<script type="text/javascript">
    jQuery(function($) {
        $(".searchproducts").autocomplete({
            source: function( request, response ) {   
                $.ajax({
                    url: "{!! URL::route($product_type["type"].'.auto_search')  !!}",
                    dataType: "json",
                    data: {
                            term: request.term,
                    },
                    success: function(json) {
                        response( $.map( json, function( item ) {
                            return {
                                value: item.desc
                            }
                        }));
                    }
                });
            },
            autoFocus: true,
            minLength: 3,
            });
        });
</script>
@endsection
