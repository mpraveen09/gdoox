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
         <div class="card-header bgm-blue head-title">
                <h2>Order Details</h2>
                <a class="btn btn-float bgm-red" id="btnPrint" onclick="PrintDiv();" name="btnPrint"><i class="zmdi zmdi-print"></i></a>
        </div><!-- .card-header -->
        
        @if (!$order_details->count())
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                No Data Found.
            </div>                 
        @else
            <div class="card-body card-padding">
                <div style="padding-top: 10px;" class="row">
                    <div class="col-md-6 col-xs-12">
                            <h6>Order Details</h6>
                            <div><b>Order Id: {!! $suborderid !!}</b></div>
                            <div>Product: {!! $productdetail['product_name'] !!}</div>
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
                <hr>
                <div class="row">
                    <div class="status_log_div col-md-6 col-xs-12">
                        <h6><b>Product Status</b></h6>
                        @foreach($status_log->status_log as $key=>$log)
                            <div>
                                @if($key==='order_date')
                                    <div style="background-color: rgba(76, 175, 80, 0.67);">Product ordered On {!! $log !!}</div>
                                @endif
                                
                                @if($key==='approved_date')
                                    <div style="background-color: rgba(255, 193, 7, 0.57);">Product Approved on {!! $log !!}</div>
                                @endif
                                
                                @if($key==='cancelled_date')
                                    <div style="background-color: rgba(96, 175, 80, 0.67);">Product Cancelled on {!! $log !!}</div>
                                @endif
                                
                                @if($key==='delivered_date')
                                    <div style="background-color: rgba(255, 193, 7, 0.57);">Product Delivered on {!! $log !!}</div>
                                @endif
                                
                                @if($key==='shipped_date')
                                    <div style="background-color: rgba(96, 175, 80, 0.67);">Product Shipped on {!! $log !!}</div>
                                @endif
                                
                                @if($key==='refund_date')
                                    <div style="background-color: rgba(255, 193, 7, 0.57);">Amount Refunded on {!! $log !!}</div>
                                @endif
                                
                                @if($key==='payment_accepted_date')
                                    <div style="background-color: rgba(96, 175, 80, 0.67);">Product Accepted on {!! $log !!}</div>
                                @endif
                                
                                @if($key==='payment_error_date')
                                    <div style="background-color: rgba(255, 193, 7, 0.57);">Payment Error on {!! $log !!}</div>
                                @endif
                                
                                 @if($key==='payment_processing_date')
                                    <div style="background-color: rgba(96, 175, 80, 0.67);">Product Processed on {!! $log !!}</div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <h6><b>Select Status</b></h6>
                        {!! Form::hidden('orderid', $suborderid, ['id'=>'orderid','class' => 'form-control']) !!}
                        {!! Form::select('order_status', $orderstates, '', ['id'=>'order_status','class' => 'form-control']) !!}
                    </div>
                </div>
            </div>

            <div id="dvContents" style="display: none;">
                <div class="card">
                    <div class="card-body card-padding">
<!--                            <div class="row m-b-25">
                                <div class="col-md-4 col-xs-12">
                                        <h6>Order Details</h6>
                                        <div><b>Order Id: {!! $suborderid !!}</b></div>
                                        <div>Product: {!! $productdetail['product_name'] !!}</div>
                                        <div>Amount: {!! $productdetail['prduct_price'] !!}</div> 
                                        <div>Quantity: {!! $productdetail['qty'] !!}</div>
                                        <div>Order Date: {!! $order_details->created_at !!}</div>
                                </div>
                                <div class="col-md-4 col-xs-12">
                                    <div class="i-to">
                                        <h2>Shipping Address</h2>
                                        
                                        <h3>{!! $order_details->shipping_address['s_first_name']." ".$order_details->shipping_address['s_last_name'] !!}</h3>
                                        
                                        <span class="text-muted">
                                            <address>
                                                {!! $order_details->shipping_address['s_street_add']." ".$order_details->shipping_address['s_city'] !!}
                                                <br>
                                                {!! $order_details->shipping_address['s_country']." ".$order_details->shipping_address['s_country_area'] !!}<br>
                                                {!! $order_details->shipping_address['s_ph_no'] !!}
                                            </address><br>
                                        </span>
                                    </div>
                                </div>
                               
                                <div class="col-md-4 col-xs-12">
                                    <div class="i-to">
                                        <h2>Billing Address</h2>
                                        <h3>{!! $order_details->billing_address['b_first_name']." ".$order_details->billing_address['b_last_name'] !!}</h3>
                                        
                                        <span class="text-muted">
                                            <address>
                                                {!! $order_details->billing_address['b_street_add']." ".$order_details->billing_address['b_city'] !!}
                                                <br>
                                                {!! $order_details->billing_address['b_country']." ".$order_details->billing_address['b_country_area'] !!}<br>
                                                {!! $order_details->billing_address['b_ph_no'] !!}
                                            </address><br>
                                        </span>
                                    </div>
                                </div>
                            </div>-->
                        
                            <table align="center" style="width: 70%; border-collapse: collapse; border: 1px solid black;">
                                <thead  style="-webkit-print-color-adjust: exact;background-color: #b3b3cc">
                                    <th colspan="2" style="padding: 10px; height:30px; text-align: center; border: 1px solid black;">Order Details</th>
                                </thead>
                                <tbody style="-webkit-print-color-adjust: exact;">
                                    <tr style="border: 1px solid black;">
                                        <td style="padding: 8px; border: 1px solid black;">Order ID: </td>
                                        <td style="padding: 8px; border: 1px solid black;"> {!! $suborderid !!}</td>                 
                                    </tr>
                                    <tr style="background-color: #e0ebeb;">
                                        <td style="padding: 8px; border: 1px solid black;">Product Name: </td>
                                        <td style="padding: 8px; border: 1px solid black;"> {!! $productdetail['product_name'] !!}</td>   
                                    </tr>
                                    <tr>
                                        <td style="padding: 8px; border: 1px solid black;">Amount: </td>
                                        <td style="padding: 8px; border: 1px solid black;"> {!! $productdetail['prduct_price'] !!}</td>   
                                    </tr>
                                    <tr style="background-color: #e0ebeb;">
                                        <td style="padding: 8px; border: 1px solid black;">Quantity: </td>
                                        <td style="padding: 8px; border: 1px solid black;"> {!! $productdetail['qty'] !!}</td>   
                                    </tr>
                                    <tr>
                                        <td style="padding: 8px; border: 1px solid black;">Order Date: </td>
                                        <td style="padding: 8px; border: 1px solid black;"> {!! $order_details->created_at !!}</td> 
                                    </tr>
                                </tbody>
                            </table>
                        <hr>
                        <table align="center" style="width: 70%; border-collapse: collapse; border: 1px solid black;">
                            <thead>
                                <th style="border: 1px solid black;">Shipping Address</th>
                                <th style="border: 1px solid black;">Billing Address</th>
                            </thead>
                            <tbody style="-webkit-print-color-adjust: exact;">
                                <tr style="border: 1px solid black;">
                                    <td style="border: 1px solid black;">
                                        <table style="width: 100%">
                                            <tr style="background-color: #e0ebeb;">
                                                <td style="padding: 8px;">Street:</td><td>{!! $order_details->shipping_address['s_street_add'] !!}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px;">City:</td><td>{!! $order_details->shipping_address['s_city'] !!}</td>
                                            </tr>
                                            <tr style="background-color: #e0ebeb;">
                                                <td style="padding: 8px;">Pincode</td><td>{!! $order_details->shipping_address['s_country_area'] !!}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px;">Country:</td><td>{!! $order_details->shipping_address['s_country'] !!}</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td style="border: 1px solid black;">
                                        <table style="width: 100%">
                                            <tr style="background-color: #e0ebeb;">
                                                <td style="padding: 8px;">Street:</td><td>{!! $order_details->billing_address['b_street_add'] !!}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px;">City:</td><td>{!! $order_details->billing_address['b_city'] !!}</td>
                                            </tr>
                                            <tr style="background-color: #e0ebeb;">
                                                <td style="padding: 8px;">Pincode</td><td>{!! $order_details->billing_address['b_country_area'] !!}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px;">Country:</td><td>{!! $order_details->billing_address['b_country'] !!}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
    
@endsection
@section('footer_add_js_script')

<script>
    $( document ).ready(function() {
        $(this).on( "change", '#order_status', function(e){
             var status = $( "#order_status option:selected" ).val();
             var suborderid = $("#orderid").val();
             $.ajax({
                    url: "{!! URL::route('orders.change-product-status')  !!}",
                    data: {
                            status : status,
                            suborderid : suborderid
                    },
                    success: function(data) {
                        if(data!=='failure'){
                           $( ".status_log_div").append(data);
                        }
                        else {
                            $("#status_log_div").append('<span class="label label-important">The product status could not be updated! Please try Again</span>');
                        } 
                    }
                });
            });  
    });    
</script>

<script type="text/javascript">
        function PrintDiv() {
            var contents = document.getElementById("dvContents").innerHTML;
            var frame1 = document.createElement('iframe');
            frame1.name = "frame1";
            frame1.style.position = "absolute";
            frame1.style.top = "-1000000px";
            document.body.appendChild(frame1);
            var frameDoc = (frame1.contentWindow) ? frame1.contentWindow : (frame1.contentDocument.document) ? frame1.contentDocument.document : frame1.contentDocument;
            frameDoc.document.open();
            frameDoc.document.write('<html><head><title>Invoice Details</title>');
            frameDoc.document.write('</head><body>');
            frameDoc.document.write(contents);
            frameDoc.document.write('</body></html>');
            frameDoc.document.close();
            setTimeout(function () {
                window.frames["frame1"].focus();
                window.frames["frame1"].print();
                document.body.removeChild(frame1);
            }, 500);
            return false;
        }
    </script>

<script type="text/javascript">
    function goBack() {
        window.history.back();
    }
</script>
@endsection

