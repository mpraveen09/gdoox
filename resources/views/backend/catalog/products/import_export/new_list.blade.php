  @extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2> Import Products</h2>
<div class="page-top-links">
<a href="{!!route('import_product.import')!!}" class="btn btn-default">Import</a>
<a href="{!!route('import_product.list_product')!!}" class="btn btn-default">List Product</a>-->
<!--</div>-->
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
    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>Products List</h2>
            <a href="{!!route('import_product.import')!!}" class="btn btn-default">Import</a>
            <a href="{!!route('import_product.list_product')!!}" class="btn btn-default">List Product</a>
        </div><!-- .card-header -->
        @if(!$products->count())
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                You have not any new product.
            </div>    
        @else
        <div class="card-body card-padding-sm">
            <div class="row">
                @foreach( $products as $product )
                    <div class="col-md-12 ">
                        <div class="col-md-3">
                            <a href="{!! route('products/show', $product->id)  !!}" class="prod_thumb">
                            @if (!empty($product->thumb)) 

                              <img src="{!!  $product->thumb  !!}" alt="prodcuct" width="100px;" height="100px;"/>
                            @else
                              <img src="{{ asset('images/product_img.png') }}" alt="prodcuct" width="100px;" height="100px;"/>
                            @endif
                            </a>
                        </div>
                        <div class="col-md-3">
                         @if(!empty($product->desc))
                            <p>Post Date: {!! $product->desc  !!}</p>
                          @endif
                         </div>
                        <div class="col-md-3">
                         @if(!empty($product->postdate))
                            <p>Post Date: {!!  $product->postdate  !!}</p>
                          @endif
                         </div>
                          <div class="col-md-3">
                            <a href="{!!route('import_product.edit', $product->id)  !!}" class="btn btn-default"><i class="zmdi zmdi-edit zmdi-hc-fw"></i>Edit</a>
                      @if($product->status === "disabled")
                      <a href="{!!route('import_product.toggle', [$product->id, 'status'=>'enabled'])!!}"data-toggle="tooltip" data-placement="bottom" title="Enable" class="btn btn-default">Enable On Site</a>
                      @else
                      <a href="{!!route('import_product.toggle', [$product->id, 'status'=>'disabled'])!!}" data-toggle="tooltip" data-placement="bottom" title="Disable" class="btn btn-default">Disable From Site</a>
                      @endif
                         </div>
                    </div>
                    <div class="col-md-12 ">                                    
                        <br/>
                        <hr/>
                    </div>
                  @endforeach
              </div>
        </div><!-- .card-body -->
    </div>
  @endif

@endsection    
@section('footer_add_js_files') 
<script type="text/javascript">
  function goBack() {
        window.history.back();
  }
</script>
@endsection