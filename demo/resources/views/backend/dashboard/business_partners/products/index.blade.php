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

    @include('navigation_tabs.business_ecosystem_tabs')

    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>View Products</h2>
        </div><!-- .card-header -->
        @if(!$ecosystem->count())
          <div class="alert alert-warning alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
              You have not listed any business
          </div>    
        @else
            {!! Form::open(array('route' => 'ecosys.product.index', 'method'=>'GET', 'class'=>'form-horizontal form-label-left')) !!}
              <div class="card-body card-padding">
                  <div class="row">           
                      <div class="col-sm-6">
                          <p class="c-black f-500 m-b-20">Select business ecosystem site</p>
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
            @if(!$products->count())
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    No Product found for site.
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
                    <div class="col-md-12"><hr></div>   
                    @foreach($products as $product)
                    <div class="col-md-2">
                        <a style="width: 70px; height: 70px; "href="{!! route('products/show', $product->id)  !!}" class="prod_thumb">    
                            @if(isset($product->product_images))
                                  @if(!empty($product->product_images))
                                     <?php $count = count($product->product_images); ?>
                                      <img src="{!! asset($product->product_images[$count-1])  !!}" alt="prodcuct" width="100px;" height="100px;"/>
                                  @else
                                      @if(!empty($product->thumb))
                                          @if (file_exists($product->thumb_path.$product->thumb))
                                              <img src="{!!  asset($product->thumb_path.$product->thumb)  !!}" alt="prodcuct" width="100px;" height="100px;"/>
                                          @else
                                              <img src="{{ asset('images/product_img.png') }}" alt="prodcuct" width="100px;" height="150px;" />
                                          @endif
                                      @else
                                          <img src="{{ asset('images/product_img.png') }}" alt="prodcuct" width="100px;" height="150px;" />
                                      @endif
                                  @endif
                              @else
                                  @if(!empty($product->thumb))
                                      @if (file_exists($product->thumb_path.$product->thumb))
                                          <img src="{!!  asset($product->thumb_path.$product->thumb)  !!}" alt="prodcuct" width="100px;" height="100px;"/>
                                      @else
                                          <img src="{{ asset('images/product_img.png') }}" alt="prodcuct" width="100px;" height="150px;" />
                                      @endif
                                  @else
                                      <img src="{{ asset('images/product_img.png') }}" alt="prodcuct" width="100px;" height="150px;" />
                                  @endif
                              @endif
                        </a>
                    </div>
                    <div class="col-md-2">
                      @if(!empty($product->desc))
                            <h6>{!!  $product->desc  !!}</h6>
                      @endif
                    </div>
                    <div class="col-md-2">
                        @if(!empty($product->shopid))
                            <h6>{!!  $product->shopid  !!}</h6>
                        @endif
                    </div>
                    <div class="col-md-2">
                      @if(isset($product->old_slug))
                        <h6>{!!  $product->old_slug  !!}</h6>
                      @else
                        <h6>N/A</h6>
                      @endif
                    </div>
                    
                    <div class="col-md-2">
                     @if(!empty($product->postdate))
                        <p>{!! $product->postdate  !!}</p>
                      @endif
                     </div>
                    <div class="col-md-2">
                        @if($product->status === "disabled")
                             <a href="{!! route('ecosys.products.toggle', [$product->id, 'status'=>'enabled', 'site_slug'=>$slug]) !!}" class="btn btn-primary btn-xs waves-effect">Show On Site</a><br/>
                        @else
                             <a href="{!! route('ecosys.products.toggle', [$product->id, 'status'=>'disabled', 'site_slug'=>$slug]) !!}" class="btn btn-primary btn-xs waves-effect">Hide From Site</a><br/>
                        @endif
                        <a href="{!!route('product_promo.create', $product->id)  !!}" class="btn btn-primary btn-xs waves-effect">Add Promotional Banner</a>
                        <br/>
                        <a href="{!!route('ecosys_product.edit', ['ecosystem', $product->id])  !!}" class="btn btn-primary btn-xs waves-effect">Edit Product</a>
                    </div>
                    <div class="col-md-12 ">
                    <hr/>
                    </div>
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
 