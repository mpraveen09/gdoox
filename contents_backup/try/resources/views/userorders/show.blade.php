@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <h2>Orders</h2>
@endsection

@section('right_col_title_right')
    <br/>
    <br/>
    <button onclick="goBack()" class="btn btn-primary waves-effect">Back</button>
@endsection

@section('right_col')
    <!-- will be used to show any messages -->
    @if (Session::has('message'))
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!!  Session::get('message') !!}
        </div>           
    @endif
    
    @include('navigation_tabs.general_tabs')
    
    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>Order Details</h2>
            <a href="{!! route('contact-seller-create',['orderid' => $orderid,'store'=>$productdetail['store'],'suborderid'=>$suborderid]) !!}" class="btn btn-default">Contact Seller</a>
        </div><!-- .card-header -->
        
        @if ( !$order_details->count())
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                No Data Found.
            </div>                 
        @else
            <div class="card-body card-padding">
                <div style="padding-top: 10px;" class="row">
                    <div class="col-md-6 col-xs-12">
                        <h6>Status</h6>
                        <div><b>Order Id: {!! $orderid !!}</b></div>
                        <div><b>Sub Order Id: {!! $suborderid !!}</b></div>
                        <div>Seller: {!! $productdetail['store'] !!}</div>
                        <div>Amount: {!! $productdetail['prduct_price'] !!}</div> 
                        <div>Quantity: {!! $productdetail['qty'] !!}</div> 
                        <div>Order Date: {!! $order_details->created_at !!}</div>
                    </div>
                    <div class="col-md-3 col-xs-12">
                        <h6><b>Shipping Address</b></h6>
                        <div>{!! $order_details->shipping_address['s_first_name']." ".$order_details->shipping_address['s_last_name'] !!}</div>
                        <div>{!! $order_details->shipping_address['s_street_add']." ".$order_details->shipping_address['s_city'] !!}</div>
                        <div>{!! $order_details->shipping_address['s_country']." ".$order_details->shipping_address['s_country_area'] !!}</div>
                        <div>{!! $order_details->shipping_address['s_ph_no'] !!}</div>
                    </div>
                    <div class="col-md-3 col-xs-12">
                        <h6><b>Billing Address</b></h6>
                        <div>{!! $order_details->billing_address['b_first_name']." ".$order_details->billing_address['b_last_name'] !!}</div>
                        <div>{!! $order_details->billing_address['b_street_add']." ".$order_details->billing_address['b_city'] !!}</div>
                        <div>{!! $order_details->billing_address['b_country']." ".$order_details->billing_address['b_country_area'] !!}</div>
                        <div>{!! $order_details->billing_address['b_ph_no'] !!}</div>
                    </div>
                </div> 
            </div>
        @endif
    </div>

     <div class="card">
        <div class="card-header bgm-blue">
            <h2>Product Details</h2>
        </div><!-- .card-header -->
        
        @if ( !$order_details->count())
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                No Data Found.
            </div>                 
        @else
            <div class="card-body card-padding">
                <div class="row">
                    <table cellspacing="0" cellpadding="0" width="100%" align="left" class="order-details-table">
                        <tbody>
                            <tr>
                                <th colspan="4" align="left">
                                    <div><span class="text">PRODUCT DETAILS</span></div>
                                </th>
                                <th style="padding-left: 100px;">
                                    <span style="padding-right: 40px;" class="text">APPROVAL</span>
                                    <span style="padding-right: 40px;" class="text">PROCESSING</span>
                                    <span style="padding-right: 40px;" class="text">SHIPPING</span>
                                    <span class="text">DELIVERED</span>
                                </th>
                                <th><div><span class="text">TOTAL</span></div></th>
                            </tr>
                            <tr>
                                <th colspan="4" align="left">
                                    <div><span class="text"></span></div>
                                </th>
                                
                                <th style="padding-left: 100px;">
                                    <span style="padding-right: 100px;" class="text">
                                        @if($tracking->status === 'Approved' || $tracking->status === 'Processing' ||  $tracking->status === 'Shipped' || $tracking->status === 'Delivered')
                                            <a href=" " title="Product approved at {!! $tracking->status_log['approved_date'] !!}" style="background-color:#FFFFFF;color:#000000;text-decoration:none">
                                                <i class="cp-value" style="color: rgb(0, 0, 0); background-color: rgb(139, 195, 74);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>
                                            </a>    
                                        @else
                                            <a href=" " title="N/A" style="background-color:#FFFFFF;color:#000000;text-decoration:none">
                                                <i class="cp-value" style="color: rgb(0, 0, 0); background-color: rgb(189, 193, 184);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>
                                           </a> 
                                        @endif
                                    </span>
                                    
                                    <span style="padding-right: 100px;" class="text">
                                        @if($tracking->status === 'Processing' ||  $tracking->status === 'Shipped' || $tracking->status === 'Delivered')
                                            <a href=" " title="Product approved at {!! $tracking->status_log['approved_date'] !!}" style="background-color:#FFFFFF;color:#000000;text-decoration:none">
                                                <i class="cp-value" style="color: rgb(0, 0, 0); background-color: rgb(139, 195, 74);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>
                                            </a>    
                                        @else
                                            <a href=" " title="N/A" style="background-color:#FFFFFF;color:#000000;text-decoration:none">
                                                <i class="cp-value" style="color: rgb(0, 0, 0); background-color: rgb(189, 193, 184);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>
                                           </a> 
                                        @endif
                                    </span>
                                    
                                    <span style="padding-right: 100px;" class="text">
                                        @if($tracking->status === 'Shipped' || $tracking->status === 'Delivered')
                                            <a href=" " title="Product approved at {!! $tracking->status_log['approved_date'] !!}" style="background-color:#FFFFFF;color:#000000;text-decoration:none">
                                                <i class="cp-value" style="color: rgb(0, 0, 0); background-color: rgb(139, 195, 74);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>
                                            </a>    
                                        @else
                                            <a href=" " title="N/A" style="background-color:#FFFFFF;color:#000000;text-decoration:none">
                                                <i class="cp-value" style="color: rgb(0, 0, 0); background-color: rgb(189, 193, 184);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>
                                           </a> 
                                        @endif
                                    </span>
                                    
                                     <span style="padding-right: 100px;" class="text">
                                        @if($tracking->status === 'Delivered')
                                            <a href=" " title="Product delivered on {!! $tracking->status_log['delivered_date'] !!}" style="background-color:#FFFFFF;color:#000000;text-decoration:none">
                                                <i class="cp-value" style="color: rgb(0, 0, 0); background-color: rgb(139, 195, 74);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>
                                            </a>    
                                        @else
                                            <a href=" " title="N/A" style="background-color:#FFFFFF;color:#000000;text-decoration:none">
                                                <i class="cp-value" style="color: rgb(0, 0, 0); background-color: rgb(189, 193, 184);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>
                                           </a> 
                                        @endif
                                    </span>
                                </th>
                                
                                <th><div><span class="text">{!! $tracking->price !!}</span></div></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div style="padding-top: 10px;" class="row">
                    <div class="col-md-2">
                        <div class="prod_thumb">                  
                            <img src="{!! asset($productdetail['image']) !!}" alt="Product" />
                        </div> 
                        <div><b>Item: {!! $productdetail['product_name'] !!}</b></div>
                        <div>Quantity: {!! $productdetail['qty'] !!}</div>
                        <br/>                  
                    </div>
                    <div class="col-md-6 col-xs-12">
                        
                    </div>
                    <div class="col-md-6 col-xs-12">
                        

                    </div>
                </div>   
            </div>
        @endif
    </div>
@endsection

@section('footer_add_js_script')
<script>
function goBack() {
    window.history.back();
}
</script>
@endsection