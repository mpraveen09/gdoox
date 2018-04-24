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
    @if(Session::has('message'))
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!!  Session::get('message') !!}
        </div>           
    @endif
    
    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>Product Return Requests</h2>
        </div><!-- .card-header -->
         <div class="card-body card-padding">
            <div style="padding-top: 10px;" class="row">
                <table cellspacing="0" cellpadding="0" width="100%" align="left" class="order-details-table">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Store</th>
                            <th>Order ID</th>
                            <th>Reason</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr> 
                    </thead>
                    
                    <tbody>
                        @foreach($returnrequests as $requests)
                        <tr>
                            <td class="product-name">{!! $requests->product_name !!}</td>
                            <td class="product-store">{!! $requests->store !!}</td>
                            <td class="sub-order-id">{!! $requests->sub_order_id !!}</td>
                            <td>{!! $requests->reason !!}</td>
                            <td class="action-status">
                                @if($requests->return_accepted==='true')
                                    Accepted
                                @elseif($requests->return_accepted==='false')
                                    Rejected
                                @else
                                    Pending
                                @endif
                            </td>
                            <td>
                                <button type="submit" id="accept_return" name="accept_return" data-attr-val="Accept" class="change-return-status btn-xs btn bgm-green waves-effect">Accept</button>
                                <br />
                                <button type="submit" id="reject_return" name="reject_return" data-attr-val="Reject" class="change-return-status btn-xs btn bgm-red waves-effect">Reject</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('footer_add_js_script')
<script type="text/javascript">
    $(document).ready(function(){
       $('.change-return-status').click(function (){
            var store = $(this).parent().parent().children('.product-store').text();
            var suborderid = $(this).parent().parent().children('.sub-order-id').text();
            var action = $(this).attr("data-attr-val");
            var ref = $(this);
            console.log(store+"====>"+ suborderid +"====>"+action);
            $.ajax({
                url: "{!! URL::route('product-return-request.store') !!}",
                data: {
                    store: store,
                    suborderid: suborderid,
                    action: action
                },
                cache: false,
                success: function(data){
                   if(data==='error'){
                       swal("Something went wrong! Please try Again");
                   }
                   else {
                       ref.parent().parent().children('.action-status').text(data);
                   }
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