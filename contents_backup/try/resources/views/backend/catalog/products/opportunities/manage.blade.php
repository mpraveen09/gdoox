@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>Opportunity Product</h2>-->
<!--<div class="page-top-links">-->
    
<!--</div>-->

@endsection
    @section('right_col_title_right')
@endsection

@section('right_col')
    @if (Session::has('message'))
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!!  Session::get('message')  !!}
        </div>
    @endif
    @if (HTML::ul($errors->all()))
          <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
              {!! HTML::ul($errors->all()) !!}
          </div>
    @endif
    <div class="card">
            <div class="card-header bgm-blue head-title">
                <h2>Manage</h2>
                <a href="{!! route('opportunities.product')  !!}" class="btn btn-default">List Products</a>
                <a href="{!! route('opportunities.index')  !!}" class="btn btn-default">View All</a>
            </div><!-- .card-header -->
            <!-- will be used to show any messages -->
            <div class="card-body card-padding">
                <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                    <table class="table table-striped responsive-utilities jambo_table ">
                    <tbody>
                        @if($product->thumb)
                         <tr>
                              <td >Product Image</td>
                              <td><img src="{!!asset($product->thumb_path.$product->thumb)!!}" width="100"></td>
                         </tr>
                        @endif
                        @if($product->desc)
                            <tr>
                                <td >Product Name</td>
                                <td>{!!$product->desc!!}</td>
                            </tr>
                        @endif
                        @if($product->postdate)
                            <tr>
                                <td>Post Date</td>
                                <td>{!!$product->postdate!!}</td>
                            </tr>
                        @endif
                        @if(isset($product->product_data[4]))
                            <tr>
                                 <td >Part Number</td>
                                 <td>{!!$product->product_data[4]!!}</td>
                            </tr>
                        @endif
                        @if(isset($product->product_data[8]))
                            <tr>
                                 <td>Quantity</td>
                                 <td>{!!$product->product_data[8]!!}</td>
                            </tr>
                        @endif
                        @foreach($attributes as $attribute)
                          @if(!empty($product->product_data[$attribute->attr_id]))
                            <tr>
                                 <td >{!!$attribute->label!!}</td>
                                 <td>{!!$product->product_data[$attribute->attr_id]!!}</td>
                            </tr>
                          @endif
                        @endforeach 
                    </tbody>
                  </table>
                </div>
                <div class="form-group clearfix">
                    <div class="col-md-3 col-md-offset-4">
                          <a href="{!! route('opportunities.extract', $product->id)  !!}" class="btn btn-success">Extract</a>
                    </div>
                </div>
            </div>
    </div><!-- .card -->
        
@endsection


