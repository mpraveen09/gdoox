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
    

@include('navigation_tabs.business_ecosystem_tabs')

<div class="card">
    <div class="card-header card-padding-sm bgm-blue head-title">
        <h2><i class="zmdi zmdi-account m-r-5"></i> {!! $fm_data->labels['share_your_products'] !!}</h2>
        <button onclick="goBack()" class="btn btn-primary waves-effect">Back</button>
    </div>

    <div id="error_div"></div>

    <div class="card-body card-padding">
          <div class="row">
              <div class="text-right col-md-12">
                  {!! $list_products->render() !!} 
              </div>
          </div>

          {!! Form::open(array('route' => 'invited-business-partners.share_product')) !!}
          <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
              @if(!$list_products->count())
                  <div class="card-body card-padding">
                      <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                           There are no Products in this store to Share.
                      </div>
                   </div> 
              @else

                  {!! Form::hidden('store_id', $store_id) !!}
                  {!! Form::hidden('inviter_id', $inviter_id) !!}
                  {!! Form::hidden('type','Business Ecosystem') !!}

                  <table class="table table-striped responsive-utilities jambo_table ">
                      <thead>
                          <th>Product Image</th>
                          <th>Product Name</th>
                          <th>Created</th>
                          <th>Action</th>
                      </thead>

                       <tbody>
                          @foreach($list_products as $products)
                              <tr data_id="{!! $products->_id !!}">
                                  <td><img width=40px" height="40px" alt="Product" src="{!! asset($products->thumb_path.$products->thumb) !!}"/></td>
                                  <td>{!! $products->desc !!}</td>
                                  <td>{!! $products->created_at !!}</td>
                                  <td>  
                                      <input type="hidden" name="" class="hidden_prod_id" value="{!! $products->_id !!}">
                                      @if(array_key_exists($products->_id, $shared_status) && $shared_status[$products->_id]=='unshared')
                                           <button type="button" id="share_product" class="btn btn-primary waves-effect shareproduct">Share</button>
                                           <button style="display: none;"type="button" id="unshare_product" class="btn btn-primary waves-effect unshareproduct">Un Share</button>
                                      @elseif(array_key_exists($products->_id, $shared_status) && $shared_status[$products->_id] == 'shared')
                                           <button style="display: none;" type="button" id="share_product" class="btn btn-primary waves-effect shareproduct">Share</button>
                                           <button type="button" id="unshare_product" class="btn btn-primary waves-effect unshareproduct">Un Share</button>
                                       @else 
                                          <button type="button" id="share_product" class="btn btn-primary waves-effect shareproduct">Share</button>
                                          <button style="display: none; "type="button" id="unshare_product" class="btn btn-primary waves-effect unshareproduct">Un Share</button>
                                       @endif
                                  </td>
                              </tr>
                          @endforeach
                        </tbody>
                   </table>
               @endif
          </div>
          <div class="form-group clearfix">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                  <button type="submit" class="btn btn-primary waves-effect">Save</button>
              </div>
          </div>
          {!! Form::close() !!}

          <div class="row">
              <div class="text-right col-md-12">
                  {!! $list_products->render() !!} 
              </div>
          </div>
    </div>    
</div>               

    
@endsection
@section('footer_add_js_script')
<script>
    $( document ).ready(function() {
        $(this).on( "click", '.shareproduct', function(e){
             e.preventDefault();
             $(this).parent().find('input').attr('name', 'share_products[]');
             $(this).hide();
             $(this).next('button').show();
             return false;
        });
        
         $(this).on( "click", '.unshareproduct', function(e){
             e.preventDefault(); 
             e.preventDefault();
             $(this).parent().find('input').attr('name', 'unshare_products[]');
             $(this).hide();
             $(this).prev('button').show();
             return false;
        });
        
        
//        $(this).on( "click", '.shareproduct', function(e){
//             e.preventDefault(); 
//             var share_ref =  $(this);
//             var unshare_ref = $(this).next('button');
//             var product_id = $(this).parent().parent().attr('data_id'); 
//             var store_id = '{!! $store_id !!}';
//             var invitee_id = '{!! Auth::user()->id !!}';
//             var inviter_id = '{!! $inviter_id !!}';
//             $.ajax({
//                    url: "{!! URL::route('invited-business-partners.share_product')  !!}",
//                    data: {
//                        product_id: product_id,
//                        store_id: store_id,
//                        invitee_id: invitee_id,
//                        inviter_id : inviter_id
//                    },
//                    success: function(data) {
//                        if(data==='shared'){
//                           unshare_ref.show();
//                           share_ref.hide();
//                        }
//                        else {
//                            $("#error_div").append('<span class="label label-important">The product could not be shared!Please try Again</span>');
//                            alert('Something Went Wrong! Not Able to Share. Please try Again');
//                        } 
//                    }
//                });
//            });
//        
//         $(this).on( "click", '.unshareproduct', function(e){
//             e.preventDefault(); 
//             var unshare_ref=  $(this);
//             var share_ref= $(this).prev('button');
//             var product_id= $(this).parent().parent().attr('data_id'); 
//             var store_id= '{!! $store_id !!}';
//             var invitee_id= '{!!Auth::user()->id !!}';
//             var inviter_id= '{!! $inviter_id !!}';
//             $.ajax({
//                    url: "{!! URL::route('invited-business-partners.unshare_product')  !!}",
//                    data: {
//                            product_id: product_id,
//                            store_id:store_id,
//                            invitee_id:invitee_id,
//                            inviter_id:inviter_id
//                    },
//                    success: function(data) {
//                        if(data === 'unshared'){
//                           unshare_ref.hide();
//                           share_ref.show();
//                        }
//                        else {
//                            $("#error_div").append('<span class="label label-important">The product could not be Un shared!Please try Again</span>');
//                        }
//                    }
//                });
//        });
    });    
</script>
<script type="text/javascript">
    function goBack() {
        window.history.back();
    }
</script>
@endsection

