  @extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>Product Management</h2>-->
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
            <h2>Search Site</h2>
        </div><!-- .card-header -->
        @if(empty($ecosystem))
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                You have not listed any business
            </div>    
        @else
          {!! Form::open(array('route' => 'products/list', 'method'=>'GET', 'class'=>'form-horizontal form-label-left')) !!}
            <div class="card-body card-padding">
                    @if(!empty($site['site_name']))
                        <div class="row">           
                            <div class="col-sm-5 col-md-5">
                                <p class="form-group c-black f-500 m-b-20">Select Company</p>
                                <div class="form-group">
                                    {!! Form::select('site_slug', $site['site_name'], $siteslug , array("required",'class'=>'form-control')) !!}
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-sm-5 col-md-5">
                            <p class="form-group c-black f-500 m-b-20">Search Product</p>
                            <div class="form-group">
                                {!! Form::text('keyword', $keyword, array('id'=>'keyword','placeholder'=>'Search Products','class'=>'form-control')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix">      
                        <button type="submit" class="btn btn-primary waves-effect">Search</button>
                    </div>
            </div>
          @endif  
          {!! Form::close() !!}
    </div>
    
    
    <div class="card">
        <div class="card-header bgm-blue">
                <h2>VIEW PRODUCTS/SERVICES</h2>
        </div><!-- .card-header -->
        <div class="card-body card-padding-sm">
            @if (!$products->count())
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    No Product found for site.
                </div>
            @else
                <div class="row">
                    <div class="text-right col-md-12">
                      {!!$products->appends(['site_slug'=>$data])->render()!!}
                    </div>
                </div> 
            <br/>
                <div class="row">
                    @foreach( $products as $product)
                    <?php $key = 0; ?>
                      <div class="col-md-12 ">
                            <div class="col-md-1">
                                @if(!empty($product->shopid))
                                    <h6>{!!  $product->shopid  !!}</h6>
                                @endif
                            </div>
                           
                            <div class="col-md-3">
                                <a href="{!! route('products/show', $product->id)  !!}" class="prod_thumb">
                                    @if(isset($product->product_images))
                                        @if(!empty($product->product_images))
                                           <?php $count = count($product->product_images); ?>
                                            <img src="{!! asset($product->product_images[$count-1])  !!}" alt="Product Image" width="100px;" height="100px;"/>
                                        @else
                                            @if(!empty($product->thumb))
                                                @if (file_exists($product->thumb_path.$product->thumb))
                                                    <img src="{!!  asset($product->thumb_path.$product->thumb)  !!}" alt="Product Image" width="100px;" height="100px;"/>
                                                @else
                                                    <img src="{{ asset('images/product_img.png') }}" alt="Product Image" width="100px;" height="150px;" />
                                                @endif
                                            @else
                                                <img src="{{ asset('images/product_img.png') }}" alt="Product Image" width="100px;" height="150px;" />
                                            @endif
                                        @endif
                                    @else
                                        @if(!empty($product->thumb))
                                                @if (file_exists($product->thumb_path.$product->thumb))
                                                    <img src="{!!  asset($product->thumb_path.$product->thumb)  !!}" alt="Product Image" width="100px;" height="100px;"/>
                                                @else
                                                    <img src="{{ asset('images/product_img.png') }}" alt="Product Image" width="100px;" height="150px;" />
                                                @endif
                                            @else
                                                <img src="{{ asset('images/product_img.png') }}" alt="Product Image" width="100px;" height="150px;" />
                                            @endif
                                    @endif
                                </a>
                            </div>
                            
                            <div class="col-md-3">
                                @if(!empty($product->desc))
                                  <h6>{!!  $product->desc  !!}</h6>
                                @endif
                            </div>

                            <div class="col-md-2">
                                @if(!empty($product->postdate))
                                  <p>Post Date: {!!  $product->postdate  !!}</p>
                                @endif
                            </div>

                            <div class="col-md-3">
                                    @if(isset($product->type))
                                        @if(!empty($product->type))
                                            <a href="{!! route('product.destroy', $product->id)  !!}" class="btn btn-primary btn-xs waves-effect">Delete Product</a>
                                        @else
                                            @if($product->status === "disabled")
                                                <a href="{!! route('products.toggle', [$product->id, 'status'=>'enabled'])  !!}" class="btn btn-primary btn-xs waves-effect">Show On Site</a><br/>
                                            @else
                                                <a href="{!! route('products.toggle', [$product->id, 'status'=>'disabled'])  !!}" class="btn btn-primary btn-xs waves-effect">Hide From Site</a><br/>
                                            @endif
                                        @endif
                                    @else
                                        @if($product->status === "disabled")
                                            <a href="{!! route('products.toggle', [$product->id, 'status'=>'enabled'])  !!}" class="btn btn-primary btn-xs waves-effect">Show On Site</a><br/>
                                        @else
                                            <a href="{!! route('products.toggle', [$product->id, 'status'=>'disabled'])  !!}" class="btn btn-primary btn-xs waves-effect">Hide From Site</a><br/>
                                        @endif
                                    @endif
                                    
                                    <a href="{!! route('product_promo.create', $product->id)  !!}" class="btn btn-primary btn-xs waves-effect">Add Product Promotional Banner</a><br/>
                                    <a href="{!! route('product.edit', $product->id) !!}" class="btn btn-primary btn-xs waves-effect">Edit Product</a><br/>
                                    <a href="{!! route('duplicate_this_product', $product->id)  !!}" target="_blank" class="btn btn-primary btn-xs waves-effect">Duplicate This Product</a><br/>
                                    <a href="{!! route('products/variation', ['productid'=>$product->id])  !!}" target="_blank" class="btn btn-primary btn-xs waves-effect">Add Variation</a><br/>
                            </div>
                      </div>
                    @endforeach
                </div>
            
                <div class="row">
                    <div class="text-right col-md-12">
                      {!!$products->appends(['site_slug'=>$data])->render()!!}
                    </div>
                </div>    
            @endif
        </div><!-- .card-body -->
    </div>

@endsection   
