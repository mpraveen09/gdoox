@extends('layout.backend.master')
@extends('layout.backend.userinfo')
@section('right_col')
    @if (Session::has('message'))
        <div class="alert alert-info">{!!  Session::get('message')  !!}</div>
    @endif

    @if (HTML::ul($errors->all()))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!! HTML::ul($errors->all()) !!}
        </div>
    @endif

    <div id="l-register" style="background: #fff;
        box-shadow: 0 1px 11px rgba(0, 0, 0, 0.27);
        border-radius: 2px;
        width: 100%;
        height: 100%;
        display: inline-block;
        margin-top: 20px;
        margin-bottom: 20px;
        vertical-align: middle;
        position: relative;
        z-index: 10;" class="lc-block toggled">
        
       {!! Form::open(array('url' => 'auth/register', 'method' => 'post'), array('class'=>"form-signin")) !!}
       
            <div class="card-body card-padding">
                <div class="row">
                    <div class="col-md-12 input-group">
                        <div style="text-align: center; font-weight: 500; font-size: 20px; color: #008000;" class="fg-line">How to start working with Gdoox Platform</div>
                    </div>
                    <hr>    
                    <div class="col-md-12 input-group">
                        <div class="col-md-12 input-group">
                            <div style="text-align: center; font-size: 15px;"class="fg-line"><b>Welcome in Gdoox Business Ecosystem Platform. Please take a look at which is the better way to work  with Gdoox.</b></div>
                        </div>
                    </div>
                    <br /><br />
                    <div class="col-md-12 input-group">
                        <span style="float: left;" class="input-group-addon">General information</span>
                    </div>
                    
                    <div class="col-md-12">
                        <div style="text-align: left;">The Platform needs information about the administrator’s account and of course about your company.
                        Please note that all the information requested are protected and no one other than Gdoox Team can access to them.</div>
                    </div>
                    <br /><br />
                    
                    <div class="col-md-12 input-group">
                        <br /><br />
                        <span style="float: left;" class="input-group-addon">Information about the Administrator:</span>
                    </div>
                    
                    <div class="col-md-12">
                        <div style="text-align: left;">The Platform needs information about the administrator’s account and of course about your company.
                        Please note that all the information requested are protected and no one other than Gdoox Team can access to them.</div>
                    </div>
                    
                     <div class="col-md-12">
                         <div style="text-align: left;"><b><i>You will need to provide the following info:</i></b></div>
                     </div>
                    
                    <div class="col-md-12">
                        <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                            <table class="table table-striped responsive-utilities jambo_table ">
                                <tbody>    
                                    <tr>
                                        <td style="width: 30px;"><img style="width: 30px; height: 30px;" src="{{ asset('/images/icons/admin_info/Name.png') }}"></td>
                                        <td style="text-align: left;">Name</td>
                                        <td style="width: 30px;"><img style="width: 30px; height: 30px;" src="{{ asset('/images/icons/admin_info/Surname.png') }}"></td>
                                        <td style="text-align: left;">Surname</td>
                                        <td style="width: 30px;"><img style="width: 30px; height: 30px;" src="{{ asset('/images/icons/admin_info/eMail.png') }}"></td>
                                        <td style="text-align: left;">Email Address</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30px;"><img style="width: 30px; height: 30px;" src="{{ asset('/images/icons/admin_info/Position.png') }}"></td>
                                        <td style="text-align: left;">Your position in the Company</td>
                                        <td style="width: 30px;"><img style="width: 30px; height: 30px;" src="{{ asset('/images/icons/admin_info/Personal_phone.png') }}"></td>
                                        <td style="text-align: left;">Your Phone Number</td>
                                        <td style="width: 30px;"><img style="width: 30px; height: 30px;" src="{{ asset('/images/icons/admin_info/Mobile.png') }}"></td>
                                        <td style="text-align: left;">Your Mobile Number</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div style="text-align: left;">Please note that phone and mobile number will be used by Gdoox only for business communications regarding your sites or the products you already uploaded. Gdoox will never use these information for promotion or any other communication.</div>
                    </div>

                    <div class="col-md-12 input-group">
                        <br /><br />
                        <span style="float: left;" class="input-group-addon">Information about the Company:</span>
                    </div>
                    
                    <div class="col-md-12">
                        <div style="text-align: left;"><b><i>Gdoox platform and the customers need to know something about you.</i></b></div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                            <table class="table table-striped responsive-utilities jambo_table ">
                                <tbody>    
                                    <tr>
                                        <td style="width: 30px;"><img style="width: 30px; height: 30px;" src="{{ asset('/images/icons/company_info/company.png') }}"></td>
                                        <td style="text-align: left;">Company Name</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30px;"><img style="width: 30px; height: 30px;" src="{{ asset('/images/icons/company_info/address.png') }}"></td>
                                        <td style="text-align: left;">Address</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30px;"><img style="width: 30px; height: 30px;" src="{{ asset('/images/icons/company_info/Phone.png') }}"></td>
                                        <td style="text-align: left;">Phone Number</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30px;"><img style="width: 30px; height: 30px;" src="{{ asset('/images/icons/company_info/Fax.png') }}"></td>
                                        <td style="text-align: left;">Fax Number</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30px;"><img style="width: 30px; height: 30px;" src="{{ asset('/images/icons/company_info/VAT.png') }}"></td>
                                        <td style="text-align: left;">Fiscal identification (VAT Number or alternative)</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div style="text-align: left;"><b><i>Information about the products you must have available:</i></b></div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                            <table class="table table-striped responsive-utilities jambo_table ">
                                <thead>
                                    <th colspan="2"><img style="width: 50px; height: 50px;" src="{{ asset('/images/icons/product_info/Product.png') }}"></th>
                                    <th><img style="width: 50px; height: 50px;" src="{{ asset('/images/icons/product_info/Price.png') }}"></th>
                                    <th><img style="width: 50px; height: 50px;" src="{{ asset('/images/icons/product_info/Image.png') }}"></th>
                                </thead>
                                <tbody>    
                                    <tr>
                                        <td style="color: #0066ff"><b>Part Number</b></td>
                                        <td style="color: #0066ff"><b>SKU Code</b></td>
                                        <td style="color: #0066ff"><b>Price</b></td>
                                        <td style="color: #0066ff"><b>Pictures</b></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">That allow to identify your product letting your customer to better understand your offer. You need also to have all the information you need to define your offer (product specs, description, etc.)</td>
                                        <td>Gdoox platform supports B2B and B2C prices. You need also to have all the information you need to define your offer (product specs, description, etc.).
                                            Prices can be modified at any time, and any change will be stored in our platform.</td>
                                        <td>Pictures are very important. Customers want to watch nice and professional pictures and so they are a powerful marketing  tool. 
                                            Notes: Remember that you can add pictures at any time. Pictures should be already available in your PC allowing you to load them easily. Uploaded pictures will be stored in our platform.</td>
                                    </tr> 
                                </tbody>
                            </table>
                        </div>
                        <br />
                        <br />
                    </div>
                    
                    <div class="col-md-12 input-group">
                        <div style="text-align: center; font-weight: 400; font-size: 15px; color: #008000;" class="fg-line">Gdoox is a powerful Management Tool.</div>
                    </div>
                    
                    <div class="col-md-12 input-group">
                        <div style="text-align: center; font-weight: 400; font-size: 15px; color: #008000;" class="fg-line">Gdoox protects your Privacy.</div>
                    </div>
                    
                    <div class="col-md-12 input-group">
                        <div style="text-align: center; font-weight: 400; font-size: 15px; color: #008000;" class="fg-line">Gdoox protects your Business.</div>
                    </div>
                    
                    <div class="col-md-12 input-group">
                        <div style="text-align: center; font-weight: 400; font-size: 15px; color: #008000;" class="fg-line">Gdoox supports you in the Market Competition.</div>
                    </div>
                    
                    <div class="col-md-12 form-group clearfix">
                        <div style="float: right;">
                          {!! HTML::link('/auth/login','Continue to Login', array('class'=>'btn btn-success waves-effect')) !!}
                        </div>
                    </div>
                </div>
            </div>
       {!! Form::close()!!}
    </div>
@endsection