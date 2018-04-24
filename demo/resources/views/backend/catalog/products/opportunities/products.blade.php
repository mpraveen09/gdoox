  @extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--    <h2>Opportunities</h2>-->
   
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
    
    @include('navigation_tabs.marketing_tabs')
    
    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>Select Products</h2>
            <a href="{!! route('opportunities.index')  !!}" class="btn btn-default">View All</a>
        </div><!-- .card-header -->
        @if(!$products->count())
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                You have not listed any product or no product remaining for create opportunity
            </div>    
        @else
            <div class="card-body card-padding-sm">
                <div class="row">
                    @foreach( $products as $product )
                              <div class="col-md-12 ">
                                  <div class="col-md-3">
                                      <a href="{!! route('products/show', $product->id)  !!}" class="prod_thumb">
                                      @if (!empty($product->thumb)) 

                                        <img src="{!!  asset($product->thumb_path.$product->thumb)  !!}" alt="prodcuct" width="100px;" height="100px;"/>
                                      @else
                                        <img src="{{ asset('images/product_img.png') }}" alt="prodcuct" width="100px;" height="100px;"/>
                                      @endif
                                      </a>
                                  </div>
                                  <div class="col-md-3">
                                   @if(!empty($product->desc))
                                      <p>{!! $product->desc  !!}</p>
                                    @endif
                                   </div>
                                  <div class="col-md-3">
                                   @if(!empty($product->postdate))
                                      <p>Post Date: {!!  $product->postdate  !!}</p>
                                    @endif
                                   </div>
                                    <div class="col-md-3">
                                     <a href="{!!route('opportunities.manage', $product->id)  !!}" class="btn btn-default">Manage Product</a>
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
                  <div class="row">
                      <div class="text-right col-md-12">
                        {!!$products->render()!!}
                      </div>
                  </div>    
            </div><!-- .card-body -->
        @endif
    </div>
@endsection    
@section('footer_add_js_script')

<script type="text/javascript">
  function goBack() {
         window.history.back();
  }
</script>
@endsection
