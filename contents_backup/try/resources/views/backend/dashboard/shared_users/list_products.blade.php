@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <!--<h2></h2>-->
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
    
    <div class="row">
        <div class="col-md-12">
          <div class="card">
              <div class="card-header card-padding-sm bgm-blue head-title">
                  <h2><i class="zmdi zmdi-account m-r-5"></i> {!! $fm_data->labels['share_products'] !!}</h2>
              </div>
              
              <div id="error_div"></div>
              
              <div class="card-body card-padding">
                    <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                        @if($list_products->count())
                            <table class="table table-striped responsive-utilities jambo_table ">
                                <thead>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </thead>

                                 <tbody>
                                        @foreach($list_products as $products)
                                            <tr data_id="{!! $products->_id !!}">
                                                <td><img width=40px" height="40px" alt="Product" src="{!! $products->thumb !!}"/></td>
                                                <td>{!! $products->desc !!}</td>
                                                <td>{!! $products->created_at !!}</td>
                                                <td>
                                                   
                                                    
                                                    @if(array_key_exists($products->_id, $shared_status) && $shared_status[$products->_id]=='unshared')
                                                         <button type="button" id="share_product" class="btn btn-primary waves-effect shareproduct">Share</button>
                                                         <button style="display: none;"type="button" id="unshare_product" class="btn btn-primary waves-effect unshareproduct">Un Share</button>
                                                    @elseif(array_key_exists($products->_id, $shared_status) && $shared_status[$products->_id]=='shared')
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
                         @else 
                            <div class="card-body card-padding">
                                <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                                     There are no Products to Share. Please add some Products to the Store and try again.
                                </div>
                             </div> 
                         @endif
                    </div>
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
             var share_ref=  $(this);
             var unshare_ref= $(this).next('button');
             var product_id= $(this).parent().parent().attr('data_id'); 
             var store_id= '{!! $store_id->siteslug !!}';
             var invitee_id= '{!! $invited_user_id !!}';
             var invitee_name= '{!! $store_id->invitee_name !!}';
             $.ajax({
                    url: "{!! URL::route('invited-business-partners.share_product')  !!}",
                    data: {
                            product_id: product_id,
                            store_id:store_id,
                            invitee_id:invitee_id,
                            invitee_name:invitee_name
                    },
                    success: function(data) {
                        if(data==='shared'){
                           unshare_ref.show();
                           share_ref.hide();
                        }
                        else {
                            $("#error_div").append('<span class="label label-important">The product could not be shared!Please try Again</span>');
                           alert('Something Went Wrong! Not Able to Share. Please try Again');
                        } 
                    }
                });
        });
        
         $(this).on( "click", '.unshareproduct', function(e){
             e.preventDefault(); 
             var unshare_ref=  $(this);
             var share_ref= $(this).prev('button');
             var product_id= $(this).parent().parent().attr('data_id');
             var store_id= '{!! $store_id->siteslug !!}';
             var invitee_id= '{!! $invited_user_id !!}';
             var invitee_name= '{!! $store_id->invitee_name !!}';
             $.ajax({
                    url: "{!! URL::route('invited-business-partners.unshare_product')  !!}",
                    data: {
                            product_id: product_id,
                            store_id:store_id,
                            invitee_id:invitee_id,
                            invitee_name:invitee_name
                    },
                    success: function(data) {
                        if(data==='unshared'){
                           unshare_ref.hide();
                           share_ref.show();
                        }
                        else {
                            $("#error_div").append('<span class="label label-important">The product could not be Un shared!Please try Again</span>');
                        }
                    }
                });
        });
    });    
</script>
@endsection

