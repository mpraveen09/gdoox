
@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2> Product</h2>-->
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

@include('navigation_tabs.marketing_tabs')

<div class="card">
    <div class="card-header bgm-blue head-title">
        <h2>Select Product</h2>
        <a href="{!! route('business-info-index')  !!}" class="btn btn-round btn-default">View All</a>
    </div><!-- .card-header -->
    
    <div class=" card-body card-padding-sm">
        @if (empty($products))
              <div class="alert alert-warning alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  No Product found for site.
              </div>
         @else
              <div class="row">
                  @foreach( $products as $product )
                        <div class="col-md-12 ">
                            <div class="col-md-3">
                              <a href="{!! route('products/show', $product->id)  !!}" class="prod_thumb">
                                @if (!empty($product->thumb)) 

                                <img src="{!! asset( $product->thumb_path.$product->thumb)  !!}" alt="prodcuct" width="100px;" height="100px;"/>
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
                               <a href="{!!route('product_promo.create', $product->id)!!}" class="btn btn-default">Add</a>
                             </div>
                        </div>
          <!--                          <div class="col-md-12 ">                                    
                            <br/>
                            <hr/>
                        </div>-->
                  <div class="col-md-12 ">                                    
                      <br/>
                      <hr/>
                  </div>
                @endforeach
            </div>
         @endif
    </div>
</div>
@endsection
