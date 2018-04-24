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
            {!!  Session::get('message')  !!}
        </div>           
    @endif
    
    @include('navigation_tabs.general_tabs')
    
    
    <div class="card">
        <div class="card-header bgm-blue">
            <h2>Your Orders</h2>
        </div><!-- .card-header -->
        
            @if ( !$orders->count())
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    You have no Orders
                </div>                 
            @else
                <div class="text-right col-md-12">
                    {!! $orders->render() !!}             
                </div>
                
                <div class="card-body card-padding">
                    @foreach($orders as $order)
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{!! route('userorders.show',['order_id'=>$order->order_id,'sub_order_id'=>$order->items['sub_order_id']]) !!}" class="btn btn-info waves-effect">{!! $order->items['sub_order_id'] !!}</a>
                            </div>
                        </div>
                         
                        <div style="padding-top: 10px;" class="row">
                            <div class="col-md-2">
                                <div class="prod_thumb">                  
                                    <img src="{!! asset($order->items['image']) !!}" alt="Product" />
                                </div>        
                                <br/>                  
                            </div>
                            
                            <div class="col-md-4">
                                <h6><b>Product Details</b></h6>
                                <div>Name: {!! $order->items['product_name'] !!}</div>
                                <div>Price: {!! $order->items['product_price'] !!}</div>
                                <div>Quantity: {!! $order->items['qty'] !!}</div>
                                <div>Seller: {!! $order->store !!}</div>
                                <div>Date: {!! $order->created_at !!}</div>
                            </div>
                            
                            <div class="col-md-3">
                                <h6>Status</h6>
                                @foreach($tracking as $track)
                                    @if($track->sub_order_id === $order->items['sub_order_id'])
                                        <div><b>{!! $track->status !!}</b></div>
                                        <div>
                                            @foreach($track->status_log as $key=>$date)
                                                <div>
                                                    @if($key==='order_date')
                                                        Product ordered On {!! $date !!}
                                                    @endif

                                                    @if($key==='approved_date')
                                                        Product Approved on {!! $date !!}
                                                    @endif

                                                    @if($key==='cancelled_date')
                                                        Product Cancelled on {!! $date !!}
                                                    @endif

                                                    @if($key==='delivered_date')
                                                        Product Delivered on {!! $date !!}
                                                    @endif

                                                    @if($key==='shipped_date')
                                                        Product Shipped on {!! $date !!}
                                                    @endif

                                                    @if($key==='refund_date')
                                                        Amount Refunded on {!! $date !!}
                                                    @endif

                                                    @if($key==='payment_accepted_date')
                                                        Product Accepted on {!! $date !!}
                                                    @endif

                                                    @if($key==='payment_error_date')
                                                        Payment Error on {!! $date !!}
                                                    @endif

                                                    @if($key==='payment_processing_date')
                                                       Product Processed on {!! $date !!}
                                                    @endif
                                                    
                                                    @if($key==='return_rejected_date')
                                                       Product Return Rejected On {!! $date !!}
                                                    @endif
                                                    
                                                    @if($key==='return_accepted_date')
                                                       Return Accepted On {!! $date !!}
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="col-md-3">
                                <h6>Action</h6>
                                <a href="{!! route('contact-seller-create',['orderid' => $order->order_id,'store'=>$order->store,'suborderid'=>$order->items['sub_order_id']]) !!}" class="btn btn-primary btn-success btn-xs waves-effect">Contact Seller</a><br /><br />
                                @if(isset($tracking[0]->status_log['delivered_date']))
                                    <a href="{!! route('return-product',['orderid' => $order->order_id,'store'=>$order->store,'suborderid'=>$order->items['sub_order_id']]) !!}" class="btn btn-primary btn-success btn-xs waves-effect">Return Product</a>
                                @endif
                            </div>
                        </div>
                    @endforeach 
                  </div>
            @endif 
 
            <div class="text-right col-md-12">
                {!! $orders->render() !!}             
            </div>
    </div>
@endsection

@section('footer_add_js_script')
<script>
function goBack() {
    window.history.back();
}
</script>
@endsection