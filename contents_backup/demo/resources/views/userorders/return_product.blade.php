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
            <h2>Return Product</h2>
        </div><!-- .card-header -->

        <div class="card-body card-padding">
            <div style="padding-top: 10px;" class="row">
                <div class="col-md-6 col-xs-12">
                    <h6><b>Product : {!! $product->product_name !!}</b></h6>
                    <div><b>Seller: {!! $product->store !!}</b></div>
                    <div>
                        Shipped Date: @if(isset($product->status_log['shipped_date']))
                            {!! $product->status_log['shipped_date'] !!}
                        @else
                            Not Available
                        @endif
                    </div>
                    <div>Delivered Date: {!! $product->status_log['delivered_date'] !!}</div>
                </div>

                <div class="col-md-6 col-xs-12">
                    <h6><b>Return Status : </b></h6>
                    <h6><b>Reason :</b></h6>
                    <div>{!! Form::select('reason',$reasons,'', array('id'=>'reason')) !!}</div><br/>
                    <div>
                        <button type="submit" id="returnproduct" name="returnproduct" class="btn-xs btn bgm-green waves-effect">Continue</button>
                    </div>
                </div>
            </div> 
        </div>
        
         <div class="card-body card-padding">
            <div style="padding-top: 10px;" class="row">
                <table cellspacing="0" cellpadding="0" width="100%" align="left" class="order-details-table">
                    <tbody>
                        <tr><td id="return_staus"><div></div></td></tr>
                        @if(!empty($returnstatus))
                        <tr><td><b>Reason:</b> {!! $returnstatus->reason !!}</td></tr>
                            @if($returnstatus->return_accepted==='false')
                            <tr><td><b>Order Status:</b> Order Return Request Rejected By the Seller. Please contact the Seller for more Assistance.</td></tr>
                            @elseif($returnstatus->return_accepted==='true')
                            <tr><td><b>Order Status:</b> Order Return Request is Accepted by the Seller. </td></tr> 
                            @else
                            <tr><td><b>Order Status:</b> Order Return Request is Sent to the Seller. Wait for the Seller Response. </td></tr> 
                            @endif
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('footer_add_js_script')
<script type="text/javascript">
    $(document).ready(function(){
       $('#returnproduct').click(function (){
            var store = '{!! $product->store !!}';
            var orderid = '{!! $product->order_id !!}';
            var suborderid = '{!! $product->sub_order_id !!}';
            var reason = $('#reason :selected').text();
            $.ajax({
                url: "{!! URL::route('return-product.store')  !!}",
                data: {
                    store: store,
                    orderid: orderid,
                    suborderid: suborderid,
                    reason: reason
                },
                cache: false,
                success: function(data){
                   $('#return_staus').html(data);
                },
            });
       });
    });
</script>

<script>
function goBack() {
    window.history.back();
}
</script>
@endsection