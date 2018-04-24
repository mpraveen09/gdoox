@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
   <!--<h2>CRM</h2>-->
   <!--<div class="page-top-links">-->
   <!--</div>-->
@endsection

@section('right_col_title_right')
@endsection

@section('right_col')
    <!-- if there are creation errors, they will show here -->
    @if (HTML::ul($errors->all()))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!! HTML::ul($errors->all()) !!}
        </div>
    @endif
    
    <div class="card">
        <!--<div class="card-header bgm-blue head-title">
            <h2>Payment Methods</h2>
        </div>-->

        <div class="card-header bgm-blue head-title">
            <h2>Confirm Payment</h2>
        </div>
        
<!--        {!! Form::open(array('route' => 'checkout.payment_confirm','method'=>'POST', 'class'=>'form-horizontal form-label-left')) !!}                -->
            
            {!! Form::open([
                'method' => 'POST',
                //'url' => 'https://www.sandbox.paypal.com/cgi-bin/webscr',
				'url' => 'https://www.paypal.com/cgi-bin/webscr',		
                'class' => 'form-horizontal form-label-left'
            ]) !!}
            
                {!! Form::hidden('storeid', $storeid) !!}
                
                <input type="hidden" name="business" value="<?php echo $paypal_id ?>">
                <input type="hidden" name="cmd" value="_xclick">
                <input type="hidden" name="amount" value="<?php echo $request['net_payable_amount']; ?>">
                <input type="hidden" name="item_name" value="Payment for order Id {!! $orderid !!}">
                <input type="hidden" name="type" value="">
                <input type="hidden" name="userId" value="<?php echo $user->_id; ?>"> 
                <input type="hidden" name="quantity" value="">
                <input type="hidden" name="currency_code" value="{!! $currency_code !!}">
                <input type="hidden" name="handling" value="0">
                <input type="hidden" name="no_shipping" value="1">
                <input type="hidden" name="rm" value="2">
                <input type="hidden" name="custom" class="custom" value="{!! $orderid !!}, {!! $storeid !!}">
                <input type="hidden" name="return" value="{!! route('checkout.payment_confirm',['orderid'=>$orderid,'storeid'=>$storeid]) !!}">
                

                <div class="card-body card-padding">
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6">
                            <input type="radio" checked="checked" value="checked"> &nbsp;&nbsp;&nbsp;
                            <img src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/cc-badges-ppmcvdam.png" alt="Credit Card Badges">
                        </div>
                        <div class="col-md-2 col-sm-2">
                            Payment Amount: <b>{!! $request['net_payable_amount'] !!}</b>
                        </div>
                        @if (!empty($formFields->labels['submit']))
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <button id="continue" type="submit" class="btn btn-round btn-success">Confirm Payment</button>
                            </div>
                        @endif
                    </div>
                </div>
            {!! Form::close() !!}
    </div>
@endsection

@section('footer_add_js_script')
<script type="text/javascript">
function goBack() {
    window.history.back();
}
</script>
@endsection


