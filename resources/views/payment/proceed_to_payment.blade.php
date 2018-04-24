@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <h2></h2>
@endsection

@section('right_col_title_right')
@endsection

@section('right_col')
    @if (Session::has('message'))
        <div class="alert alert-info alert-dismissible" role="alert">
            {!!  Session::get('message')  !!}
        </div>
    @endif
 
    <div class="card">
        <div class="card-header bgm-cyan ">
            <h2>Proceed To Payment</h2>
        </div>

        <div class="card-body card-padding">
            @if(!empty($zerocost) && $zerocost===true)
				<h3>Your 1 year free subscription is updated.</h3>
			@else
			
			
<!--            <form name="checkout" method="post" class="form-horizontal form-label-left" action="https://www.sandbox.paypal.com/cgi-bin/webscr" enctype="multipart/form-data">-->
			
			
            {!! Form::open([
                'method' => 'POST',
                //'url' => 'https://www.sandbox.paypal.com/cgi-bin/webscr',
				'url' => 'https://www.paypal.com/cgi-bin/webscr',
                'class' => 'form-horizontal form-label-left'
            ]) !!}

			
    <!-- Identify your business so that you can collect the payments. -->
    <input type="hidden" name="business" value="<?php echo $paypal_id ?>">

    <!-- Specify a Subscribe button. -->
    <input type="hidden" name="cmd" value="_xclick-subscriptions">

    <!-- Identify the subscription. -->
    <input type="hidden" name="item_name" value="Gdoox - <?php echo $GdooxSubscriptionType['label'] ?> Plan Subscription">
    <input type="hidden" name="item_number" value="Gdoox Subscription">

    <!-- Set the terms of the recurring payments. -->
    <input type="hidden" name="a3" value="<?php echo ($amount + $vat_amount); ?>">
    <input type="hidden" name="p3" value="1">
    <input type="hidden" name="t3" value="Y">

    <!-- Set recurring payments to stop after 1 billing cycles. -->
    <input type="hidden" name="src" value="1">
    <!--input type="hidden" name="srt" value="1"-->

			
	<input type="hidden" name="userId" value="<?php echo $user->_id; ?>"> 			
	<input type="hidden" name="currency_code" value="<?php echo $GdooxSubscriptionCharges['currency'] ?>">
        @if(!empty($disc_percentage))
            <input type="hidden" name="custom" class="custom" value="{!! 'item='. $GdooxSubscriptionType['label'] . '&amount=' . $amount . '&vat_amount=' . $vat_amount . '&vat=' . $vat . '&userid=' . $user->_id . '&currency=' . $GdooxSubscriptionCharges['currency'] . '&country=' . $country . '&plan_id=' .$GdooxSubscriptionCharges['_id']. '&discount=' . $disc_percentage . '%&org_amount=' . $original_amount  !!}"> 
	@else
            <input type="hidden" name="custom" class="custom" value="{!! 'item='. $GdooxSubscriptionType['label'] . '&amount=' . $amount . '&vat_amount=' . $vat_amount . '&vat=' . $vat . '&userid=' . $user->_id . '&currency=' . $GdooxSubscriptionCharges['currency'] . '&country=' . $country . '&plan_id=' .$GdooxSubscriptionCharges['_id'] . '&amount_org=' . $original_amount  !!}">
        @endif
	<input type="hidden" name="handling" value="0">
	<input type="hidden" name="no_shipping" value="1">
	<input type="hidden" name="rm" value="2">
			
	<input type="hidden" name="cancel_return" value="{!! route('account-payment.create') !!}">
	<input type="hidden" name="return" value="{!! route('account-payment.success') !!}">
			<!--input type="hidden" name="return" value="http://ugihosting.com/project/testipn/index.php"-->
			
	<input type="hidden" name="notify_url" value="{!! route('account-payment.ipn') !!}">
			<!--input type="hidden" name="notify_url" value="http://ugihosting.com/project/testipn/ipn.php"-->
			

			
	
            
            
            
            <div class="item form-group">
                {!! Form::label('email','E-Mail:', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('email', $user->email, ['readonly','class' => 'form-control col-md-7 col-xs-12']) !!}
                </div>
            </div>
            
            <div class="item form-group">
                {!! Form::label('plan','Subscription duration:', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('plan', $data['payment'], ['readonly','class' => 'form-control col-md-7 col-xs-12']) !!}
                </div>
            </div>
            
            @if(!empty($disc_percentage))
                <div class="item form-group">
                    {!! Form::label('plan_price','Original Amount in '. $GdooxSubscriptionCharges['currency'] .':', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('plan_price', $original_amount, ['readonly','class' => 'form-control col-md-7 col-xs-12']) !!}
                    </div>
                </div>   
                <div class="item form-group">
                    {!! Form::label('discount','Discount :', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('discount', $disc_percentage . '%', ['readonly','class' => 'form-control col-md-7 col-xs-12']) !!}
                    </div>
                </div>               
            @endif            
                        
            <div class="item form-group">
                {!! Form::label('amount','Amount in '. $GdooxSubscriptionCharges['currency'] .':', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('amount', $amount, ['readonly','class' => 'form-control col-md-7 col-xs-12']) !!}
					<br/>
					Per month cost {!! $GdooxSubscriptionCharges['currency'] . ' ' . ceil($amount / 12 ) !!}, Paid Yearly
					
					@if($vat !== 0)
						<br/>
						+ {!! $vat !!} % VAT = {!! $vat_amount . ' ' . $GdooxSubscriptionCharges['currency'] !!} 
						<br />
						Final Amount = <strong> {!! ($amount + $vat_amount) . ' ' . $GdooxSubscriptionCharges['currency']!!} </strong> / Year

					@endif
					
                </div>
				
            </div>
            <div class="item form-group">
                {!! Form::label('plans','Your Plan', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}

                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! $GdooxSubscriptionType['label'] !!} <a href="/plans?country=<?php echo $country;?>" target="_blank">view details</a>
                </div>
            </div>            

            <div class="item form-group">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="image" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!" id="place-order">
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                    <!--<a type="submit" href="javascript:void(0)" class="btn btn-round btn-success">Proceed To Pay</a>-->
					
					<!-- Display the payment button. -->
					<input type="image" name="submit"
					src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_subscribe_113x26.png"
					alt="Subscribe">
					<img alt="" width="1" height="1"
					src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
					
                                        
                                        <br/><br/>
                                        <a id="back"href="{!! route('account-payment.create') !!}" class="btn btn-round btn-danger">Go Back and configure plan again</a>
                </div>
            </div>
        {!! Form::close() !!}
		@endif
    </div>
    </div>
@endsection
 
@section('footer_add_js_script')
    <script type="text/javascript"></script>
@endsection