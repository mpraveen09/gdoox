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
<!--    <div class="card-header bgm-blue head-title">
            <h2>Payment Methods</h2>
        </div>-->

        <div class="card-header bgm-blue head-title">
            <h2>Confirm Payment</h2>
        </div>
        
        {!! Form::open(array('route' => 'checkout.payment_confirm','method'=>'POST', 'class'=>'form-horizontal form-label-left')) !!}                
            {!! Form::hidden('storeid', $storeid) !!}
            <div class="card-body card-padding">
                <div class="form-group">
                    @if (!empty($formFields->labels['submit']))
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                              <button id="continue" type="submit" class="btn btn-round btn-success">Confirm Payment</button>
                        </div>
                    @endif
                </div>
            </div>
         {!! Form::close() !!}
        
<!--         {!! Form::open(array('route' => 'checkout.index','method'=>'POST', 'class'=>'form-horizontal form-label-left')) !!}                
            <div class="card-body card-padding">
                @if(!empty($formFields->labels['credit_card']))
                     <div class="radio m-b-15">
                        <label>
                            <input type="radio" id="credit_card" name="sample" value="">
                            <i class="input-helper"></i>
                            <strong>{!! $formFields->labels['credit_card'] !!}</strong>
                        </label>
                         
                        <div>
                            <img src="https://images-eu.ssl-images-amazon.com/images/G/31/checkout/payselect/pay-method-logos/credit-cards-in-amex-beacon._CB362086986_.png" alt="Credit Card Logo">
                            <span class="vcc-info-prompt js-hide" style="display: none;">We'll save this card so you can use it again later.</span>
                        </div>
                    </div>
                
                    <div class="row" id="credit_card_div" style="display: none;">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="fg-line">
                                    <input type="text" class="form-control" placeholder="Name On Card">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="fg-line">
                                    <input type="text" class="form-control" placeholder="Card Number">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="fg-line">
                                    {!! Form::select('month', $month,'', array('placeholder'=>'Expiration Month','required', 'class'=>'form-control')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="fg-line">
                                    {!! Form::select('year', $year,'', array('placeholder'=>'Expiration Year','required', 'class'=>'form-control')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif


                <div class="radio m-b-15">
                    <label>
                        <input type="radio" id="debit_card" name="sample" value="">
                        <i class="input-helper"></i>
                        <strong>{!! $formFields->labels['debit_card'] !!}</strong>
                    </label>
                </div>

                <div class="row" id="debit_card_div" style="display: none;">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="fg-line">
                                {!! Form::select('bank', $bank,'', array('placeholder'=>'Choose A Bank','required', 'class'=>'form-control')) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="radio m-b-15">
                    <label>
                        <input type="radio" id="net_banking" name="sample" value="">
                            <i class="input-helper"></i>
                        <strong>{!! $formFields->labels['net_banking'] !!}</strong>
                    </label>
                </div>

                <div class="row" id="net_banking_div" style="display: none;">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="fg-line">
                                {!! Form::select('bank', $bank,'', array('placeholder'=>'Choose A Bank','required', 'class'=>'form-control')) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    @if (!empty($formFields->labels['submit']))
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                              <button id="continue" type="submit" class="btn btn-round btn-success">{!! $formFields->labels['continue'] !!}</button>
                        </div>
                    @endif
                </div>
            </div>
         {!! Form::close() !!}-->
    </div>
@endsection

@section('footer_add_js_script')
    <script type="text/javascript">
        function goBack() {
            window.history.back();
        }
        
        jQuery(function($) {
            $('#credit_card').click(function() {
                $('#credit_card_div').show();
                $('#debit_card_div').hide();
                $('#net_banking_div').hide();
            });
            $('#debit_card').click(function() {
                $('#debit_card_div').show();
                $('#credit_card_div').hide();
                $('#net_banking_div').hide();
            });
            $('#net_banking').click(function() {
                $('#net_banking_div').show();
                $('#credit_card_div').hide();
                $('#debit_card_div').hide();
            });
        });
    </script>
@endsection


