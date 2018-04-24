@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <!--<h2>Business Ecosystem</h2>-->
    <!--<div class="page-top-links">-->
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
    @include('navigation_tabs.network_tabs')
    <div class="row">
        <div class="col-md-12">
          <div class="card">
              <div class="card-header card-padding-sm bgm-blue head-title">
                  <h2><i class="zmdi zmdi-account m-r-5"></i> Import Products</h2>
                  <button onclick="goBack()" class="btn btn-default waves-effect">Back</button>
              </div>
              
              <div id="error_div"></div>
              
              <div class="card-body card-padding">
                    <div class="row">
                        <div class="text-right col-md-12">
                            
                        </div>
                    </div>
                    <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                        @if(!$products->count())
                            <div class="card-body card-padding">
                                <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                                     There are no Products in this store to Share.
                                </div>
                             </div> 
                        @else
                            <table class="table table-striped responsive-utilities jambo_table ">
                                <thead>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </thead>

                                 <tbody>
                                    @foreach($products as $product)
                                    <tr data_id="{!! $product->_id !!}">
                                        <td>
                                            @if(isset($product->product_images))
                                              @if(!empty($product->product_images))
                                                 <?php $count = count($product->product_images); ?>
                                                <img style="width: 40px; height: 40px;" src="{!! asset($product->product_images[$count-1])  !!}" alt="prodcuct"/>
                                              @else
                                                  @if(!empty($product->thumb))
                                                      @if (file_exists($product->thumb_path.$product->thumb))
                                                          <img style="width: 40px; height: 40px;"  src="{!!  asset($product->thumb_path.$product->thumb)  !!}" alt="Product Image"/>
                                                      @else
                                                          <img style="width: 40px; height: 40px;"  src="{{ asset('images/product_img.png') }}" alt="Product Image"/>
                                                      @endif
                                                  @else
                                                      <img style="width: 40px; height: 40px;"  src="{{ asset('images/product_img.png') }}" alt="Product Image"/>
                                                  @endif
                                              @endif
                                          @else
                                              @if(!empty($product->thumb))
                                                  @if (file_exists($product->thumb_path.$product->thumb))
                                                      <img style="width: 40px; height: 40px;"  src="{!!  asset($product->thumb_path.$product->thumb)  !!}" alt="Product Image"/>
                                                  @else
                                                      <img style="width: 40px; height: 40px;"  src="{{ asset('images/product_img.png') }}" alt="Product Image"/>
                                                  @endif
                                              @else
                                                  <img style="width: 40px; height: 40px;"  src="{{ asset('images/product_img.png') }}" alt="Product Image"/>
                                              @endif
                                          @endif
                                        </td>
                                        <td>{!! $product->desc !!}</td>
                                        <td>{!! $product->created_at !!}</td>
                                        <td>
                                            {!! Form::open(['route'=>'import_net_product.import_products']) !!}
                                                <input type="hidden" id="productid" name="productid" value="{!! $product->_id !!}">
                                                <input type="hidden" id="from_store" name="from_store" value="{!! $from_store !!}">
                                                <input type="hidden" id="to_store" name="to_store" value="{!! $to_store !!}">
                                                <button type="submit" id="import_product" class="btn btn-primary waves-effect importproduct">Import</button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                    @endforeach
                                  </tbody>
                             </table>
                         @endif
                    </div>
                    <div class="row">
                        <div class="text-right col-md-12">
                            
                        </div>
                    </div>
              </div>    
          </div>               
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

