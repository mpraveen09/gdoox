@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <!--<h2>Wishlist</h2>-->
@endsection

@section('right_col')

    <!-- will be used to show any messages -->
    @if (Session::has('message'))
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!!  Session::get('message')  !!}
        </div>
    @endif
        @include('navigation_tabs.general_tabs')
        @if ($products->count())
            <div class="card">
                <div class="card-header bgm-blue head-title">
                    <h2>Wishlist</h2>
                    <button class="btn btn-info waves-effect" onclick="goBack()">Go Back</button>
                </div><!-- .card-header -->
                <div class="card-body ">  
                    <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                          <table class="table table-striped responsive-utilities jambo_table ">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Store</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                              @foreach($products as $product)
                                <tr id="{!! $product->_id !!}">
                                    <td class="col-md-2 col-sm-2">
                                      {!! HTML::image($product->thumb_path.$product->thumb, 'product thumb', array('class' => 'product-thumb thumb')) !!}
                                    </td>
                                    <td id="shopid" class="shopid">{!! $product->shopid  !!}</td>
                                    <td>{!! $product->desc !!}</td>
                                    <td>@if(isset($product->product_data[15]))
                                            B2C Price&nbsp;:&nbsp;{!! $product->product_data[15] !!}
                                        @elseif(isset($product->product_data[16]))
                                            B2B Price&nbsp;:&nbsp;{!! $product->product_data[16] !!}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary waves-effect add_to_cart" id="add_to_cart"><i class="zmdi zmdi-shopping-cart zmdi-hc-fw"></i>Add to Cart</button>
                                        <button type="button" class="btn btn-primary waves-effect remove_wishlist_item" id="remove_wishlist_item"><i class="zmdi zmdi-delete zmdi-hc-fw"></i>Remove from Wishlist</button>                                        
                                    </td>
                                </tr>               
                              @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else 
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                You have no Items in the Wishlist
            </div> 
        @endif
    @endsection
 
    @section('footer_add_js_script')
        <script type="text/javascript"> 
            jQuery(function($) {
                $("#add_to_cart").click(function() {
                    var product_id=  $(this).closest('tr').attr('id');
                    var shopid=  $(this).closest('tr').find('td.shopid').html();

                    $.ajax({
                            url: "{!! URL::route('add_to_cart')  !!}",
                            data: {
                                    product_id: product_id,
                                    shopid: shopid
                            },
                            success: function(data) { 
                               // $('#item_count_in_cart_top_displayed').html(data);
                                $('.tm-cart .tmn-counts').html(data);
                            }
                        }); 
                    });
                
                $(".remove_wishlist_item").click(function() {
                var product_id=  $(this).closest('tr').attr('id');
                var shopid=  $(this).closest('tr').find('td.shopid').html();
                var click = $(this);
                $.ajax({
                        url: "{!! URL::route('remove_wishlist_item')  !!}",
                        data: {
                                product_id: product_id,
                                shopid:shopid
                        },
                        success: function(response) {
                            if(response='1')
                            {
                                click.parent().parent().html('<div class="alert alert-warning alert-dismissible" role="alert">\n\
                                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
                                                 <span aria-hidden="true"></span></button>You have no Items in the Wishlist</div>');
                            }
                            else
                            {
                                 click.closest('tr').remove();
                            }
                           
                        }
                    }); 
                });
            });
        </script>

    @endsection