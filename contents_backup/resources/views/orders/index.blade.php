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
            <h2> Orders</h2>
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
                    <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                        <table class="table table-striped responsive-utilities jambo_table ">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Customer Name</th>
                                    <th>Amount</th>
                                    <th>Payment By</th>
                                    <th>Payment Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>    
                               @foreach($orders as $order)
                                    <tr>
                                        <td>{!! $order->items['product_name'] !!}</td>
                                        <td>{!! $order->shipping_address['s_first_name']." ".$order->shipping_address['s_last_name'] !!}</td>
                                        <td>{!! $order->items['product_price'] !!}</td>
                                        <td>{!! $order->transaction['payment_type'] !!}</td>
                                        <td>{!! $order->payment_status !!}</td>
                                        <td>{!! $order->created_at !!}</td>
                                        <td><a href="{!! route('orders.show', ['orderid' => $order->items['sub_order_id']])!!}" class="btn btn-default">View</a></td>
                                    </tr> 
                                @endforeach
                            </tbody>
                        </table>
                    </div>    
                </div>
            
                <div class="text-right col-md-12">
                    {!! $orders->render() !!}             
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