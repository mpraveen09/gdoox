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

@include('navigation_tabs.network_tabs')

<div class="card">
    <div class="card-header bgm-blue head-title">
        <h2>View Products</h2>
    </div><!-- .card-header -->
      @if(!$networksites->count())
          <div class="alert alert-warning alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
              You don't have any Company Network to view Products.
          </div>    
      @else
        {!! Form::open(array('route' => 'comnetwork.product.index', 'method'=>'GET', 'class'=>'form-horizontal form-label-left')) !!}
            <div class="card-body card-padding">
                <div class="row">           
                    <div class="col-sm-6">
                        <p class="c-black f-500 m-b-20">Select Network Site</p>
                        <div class="form-group">
                            {!! Form::select('site_slug', $site['site_name'], null, array("required",'class'=>'form-control')) !!} 
                        </div>
                    </div>
                </div>
                <div class="form-group clearfix">      
                    <button type="submit" class="btn btn-primary waves-effect">Search</button>
                </div>
            </div>
        {!! Form::close()!!}
      @endif
</div>
@if($term['term']==1)
    <div class="card">
        <div class="card-header bgm-blue">
            <h2></h2>
        </div><!-- .card-header -->
        <div class="card-body card-padding-sm">
            @if (!$products->count())
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    No Product found for site in the Company Network.
                </div>
            @else
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="col-md-2"><b>Product</b></div>
                        <div class="col-md-2"><b>Product Name</b></div>
                        <div class="col-md-2"><b>Store</b></div>
                        <div class="col-md-2"><b>Imported From</b></div>
                        <div class="col-md-2"><b>Post Date</b></div>
                        <div class="col-md-2"><b>Actions</b></div>
                        <hr>
                        @foreach($products as $pro)
                                <div class="col-md-2">
                                    <a style="width: 70px; height: 70px;" href="{!! route('products/show', $pro->id)  !!}">
                                          @if(isset($pro->product_images))
                                              @if(!empty($pro->product_images))
                                                 <?php $count = count($pro->product_images); ?>
                                                  <img style="width: 70px; height: 70px;"  src="{!! asset($pro->product_images[$count-1])  !!}" alt="prodcuct"/>
                                              @else
                                                  @if(!empty($pro->thumb))
                                                      @if (file_exists($pro->thumb_path.$pro->thumb))
                                                          <img style="width: 70px; height: 70px;"  src="{!!  asset($pro->thumb_path.$pro->thumb)  !!}" alt="prodcuct"/>
                                                      @else
                                                          <img style="width: 70px; height: 70px;"  src="{{ asset('images/product_img.png') }}" alt="prodcuct"/>
                                                      @endif
                                                  @else
                                                      <img style="width: 70px; height: 70px;"  src="{{ asset('images/product_img.png') }}" alt="prodcuct" />
                                                  @endif
                                              @endif
                                          @else
                                              @if(!empty($pro->thumb))
                                                  @if (file_exists($pro->thumb_path.$pro->thumb))
                                                      <img style="width: 70px; height: 70px;"  src="{!!  asset($pro->thumb_path.$pro->thumb)  !!}" alt="prodcuct"/>
                                                  @else
                                                      <img style="width: 70px; height: 70px;"  src="{{ asset('images/product_img.png') }}" alt="prodcuct"/>
                                                  @endif
                                              @else
                                                  <img style="width: 70px; height: 70px;"  src="{{ asset('images/product_img.png') }}" alt="prodcuct"/>
                                              @endif
                                          @endif
                                    </a>
                                </div>  
                                <div class="col-md-2">
                                    @if(!empty($pro->desc))
                                        <h6>{!!  $pro->desc  !!}</h6>
                                    @endif
                                </div>
                                <div class="col-md-2">
                                    @if(!empty($pro->shopid))
                                        <h6>{!!  $pro->shopid  !!}</h6>
                                    @endif
                                </div>
                                <div class="col-md-2">
                                    @if(!empty($pro->old_slug))
                                    <p><b>{!!  $pro->old_slug  !!}</b></p>
                                    @endif
                                </div>
                                <div class="col-md-2">
                                    @if(!empty($pro->postdate))
                                        <p>{!!  $pro->postdate  !!}</p>
                                    @endif
                                </div>
                                <div class="col-md-2">
                                    @if($pro->status === "disabled")
                                        <a href="{!! route('network.products.toggle', [$pro->id, 'status'=>'enabled', 'site_slug'=>$data]) !!}" class="btn btn-primary btn-xs waves-effect">Show On Site</a><br/>
                                    @else
                                        <a href="{!! route('network.products.toggle', [$pro->id, 'status'=>'disabled', 'site_slug'=>$data]) !!}" class="btn btn-primary btn-xs waves-effect">Hide From Site</a><br/>
                                    @endif
                                    <a href="{!!route('product_promo.create', $pro->id)  !!}" class="btn btn-primary btn-xs waves-effect">Add Promotional Banner</a>
                                    <br/>
                                    <a href="{!! route('ecosys_product.edit',['network', $pro->id]) !!}" class="btn btn-primary btn-xs waves-effect">Edit Product</a><br/>
<!--                                <a href="{!!route('company_network_item.edit', $pro->id)  !!}" class="btn btn-primary btn-xs waves-effect">Edit Product</a>-->
                                </div>
                        <div class="col-md-12"><hr></div>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="text-right col-md-12">
                      {!!$products->appends(['site_slug'=>$data])->render()!!}
                    </div>
                </div>    
            @endif
        </div><!-- .card-body -->
    </div>
@endif
@endsection    
 