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
    
   <?php // echo "<pre>"; print_r($formFields->labels); exit; ?>
    
    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>Items</h2>
        </div>
        
        <div class="card-body card-padding">
            <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                <table class="table table-striped responsive-utilities jambo_table ">
                    <tr>
                        <th>Item</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Total Amount</th>
                        <th>Action</th>
                    </tr>
                 <!--<tr>-->
                     <?php
                            $final_amt = 0;
                            $final_tax_amt = 0;
                            $amt = 0;
                      ?>
                    @if($products->count())
                     @foreach( $products as $product)
                         <?php
                            $total_amt = 0;
                            $total_tax_amt = 0;
                          ?>
                         <tr>
                                <td class="col-md-1 col-sm-2">
                                    @if(!empty($product->thumb))
                                         {!! HTML::image($product->thumb_path.$product->thumb, 'product thumb', array('class' => 'product-thumb thumb')) !!}
                                    @else
                                        <img src="{{ asset('images/product_img.png') }}" alt="Product Image" class="product-thumb thumb">
                                    @endif
                                   
                                </td>
                                <td>{!! $product->desc !!}</td>
                                <td class="">{!! $product->qty !!}</td>
                                        <?php
                                             $price = $product->price * $product->qty;
                                             $amt = $amt + $price;
                                             $total_amt = $total_amt + $price;
                                         ?>
                               
                                        @if(!empty($product->vat) && $product->vat!== 0)  
                                            <?php 
                                                $vat = round($product->price * ($product->vat/100),2);
                                                $total_amt = $total_amt + $vat;
                                                $total_tax_amt = $total_tax_amt + $vat;
                                            ?>
                                        @endif
                                        
                                        @if(!empty($product->eco_tax) && $product->eco_tax!== 0)
                                           <?php 
                                                $eco_tax = round($product->price * ($product->eco_tax/100),2);
                                                $total_amt = $total_amt + $eco_tax;
                                                $total_tax_amt = $total_tax_amt + $eco_tax;
                                            ?>
                                        @endif
                                        
                                        @if(!empty($product->duty_tax) && $product->duty_tax!== 0)
                                            <?php 
                                                $duty_tax = round($product->price * ($product->duty_tax/100),2);
                                                $total_amt = $total_amt + $duty_tax;
                                                $total_tax_amt = $total_tax_amt + $duty_tax;
                                            ?>
                                        @endif
                                        
                                        @if(!empty($product->local_tax) && $product->local_tax!== 0) 
                                            <?php 
                                                $local_tax = round($product->price * ($product->local_tax/100),2);
                                                $total_amt = $total_amt + $local_tax; 
                                                $total_tax_amt = $total_tax_amt + $local_tax;
                                            ?>
                                        @endif
                                <td><?php echo $total_amt ?></td>
                                
                                <td>
                                    <div class="remove_product">
                                       {!! Form::open(['route'=>'cart_remove_item', 'method'=>'POST'])!!}
                                            {!!Form::hidden('id',$product->_id, array('id'=>'id'))!!}
                                            <a onclick="$(this).closest('form').submit();"><i class="zmdi zmdi-delete zmdi-hc-fw"></i></a>
                                       {!! Form::close() !!}
                                    </div>
                                </td>
                        </tr>
                        <?php 
                            $final_amt = $final_amt + $total_amt; 
                            $final_tax_amt = $final_tax_amt + $total_tax_amt;
                        ?>
                     @endforeach
                   @endif
                </table>
                <table class="table table-striped responsive-utilities jambo_table ">
                    <tr><td></td><td align="center"></td></tr>
                    <tr><td></td><td align="center"></td></tr>
                    <tr><td>Total Payable Amount</td><td align="center"><b>{!! $final_amt !!}</b></td></tr>
                </table>
            </div>
        </div>  

        {!! Form::open(array('route' => 'checkout.store','method'=>'POST', 'class'=>'form-horizontal form-label-left')) !!}
            {!! Form::hidden('net_payable_amount', $final_amt) !!}
            {!! Form::hidden('storeid', $storeid) !!}
            <div class="card-header bgm-blue head-title">
                <h2>Shipping Address</h2>
            </div>
         
            <div class="card-body card-padding">
                  @if (!empty($formFields->labels))
                  <div class="form-group clearfix">
                      @if(!empty($formFields->labels['first_name']))
                           {!! Form::label('name', $formFields->labels['first_name'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              @if(!empty($address->shipping_address['s_first_name']))
                                  {!! Form::text('s_first_name',$address->shipping_address['s_first_name'], array('placeholder' =>$formFields->labels['first_name'],'class'=>'form-control')) !!}
                              @else
                                  {!! Form::text('s_first_name','', array('required','placeholder' =>$formFields->labels['first_name'],'class'=>'form-control')) !!}
                              @endif
                          </div>    
                      @endif
                  </div>
                  
                  <div class="form-group clearfix">
                      @if(!empty($formFields->labels['last_name']))
                            {!! Form::label('surname', $formFields->labels['last_name'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                @if(!empty($address->shipping_address['s_first_name']))
                                      {!! Form::text('s_last_name',$address->shipping_address['s_last_name'],array('placeholder' =>$formFields->labels['last_name'],'class'=>'form-control')) !!}
                                @else
                                     {!! Form::text('s_last_name','',array('placeholder' =>$formFields->labels['last_name'],'class'=>'form-control')) !!}
                                @endif 
                            </div>    
                      @endif
                  </div>
                  
                  
                  <div class="form-group clearfix">
                      @if(!empty($formFields->labels['company_name']))
                            {!! Form::label('company_name', $formFields->labels['company_name'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                @if(!empty($address->shipping_address['s_company_name']))
                                      {!! Form::text('s_company_name',$address->shipping_address['s_company_name'],array('placeholder'=>$formFields->labels['company_name'],'class'=>'form-control')) !!}
                                @else
                                     {!! Form::text('s_company_name','',array('placeholder'=>$formFields->labels['company_name'],'class'=>'form-control')) !!}
                                @endif 
                            </div>    
                      @endif
                  </div>

                  <div class="form-group clearfix">
                      @if(!empty($formFields->labels['street_add']))
                            {!! Form::label('street_add', $formFields->labels['street_add'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                  @if(!empty($address->shipping_address['s_first_name']))
                                      {!! Form::text('s_street_add', $address->shipping_address['s_street_add'], array('required', 'placeholder' =>$formFields->labels['street_add'],'class'=>'form-control')) !!}
                                  @else
                                      {!! Form::text('s_street_add','', array('required', 'placeholder' =>$formFields->labels['street_add'],'class'=>'form-control')) !!}
                                  @endif 
                            </div>   
                      @endif
                  </div>

                    <div class="form-group clearfix">
                      @if(!empty($formFields->labels['city']))
                          {!! Form::label('city', $formFields->labels['city'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                          <div class="col-md-6 col-sm-6 col-xs-12">
                                @if(!empty($address))
                                    @if(!empty($address->shipping_address['s_first_name']))
                                      {!! Form::text('s_city',$address->shipping_address['s_city'], array('required','placeholder' =>$formFields->labels['city'],'class'=>'form-control')) !!}
                                    @endif
                                @else
                                     {!! Form::text('s_city','', array('required','placeholder' =>$formFields->labels['city'],'class'=>'form-control')) !!}
                                @endif 
                          </div>    
                      @endif
                    </div>

                  <div class="form-group clearfix">
                      @if(!empty($formFields->labels['country']))
                           {!! Form::label('country', $formFields->labels['country'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                          <div class="col-md-6 col-sm-6 col-xs-12">
                                @if(!empty($address))
                                    @if(!empty($address->shipping_address['s_first_name']))
                                      {!! Form::select('s_country', $country, $address->shipping_address['s_country'], array('required', 'class'=>'form-control')) !!}
                                    @endif
                                @else
                                    {!! Form::select('s_country', $country, null, array('required', 'class'=>'form-control')) !!}
                                @endif
                          </div>    
                      @endif
                  </div>

                  <div class="form-group clearfix">
                      @if(!empty($formFields->labels['zip']))
                        {!! Form::label('country_area', $formFields->labels['zip'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            @if(!empty($address))
                                @if(!empty($address->shipping_address['s_first_name']))
                                  {!! Form::text('s_country_area', $address->shipping_address['s_country_area'] ,array('required','placeholder' =>$formFields->labels['zip'],'class'=>'form-control')) !!}
                                @endif
                            @else
                                  {!! Form::text('s_country_area','' ,array('required','placeholder' =>$formFields->labels['zip'],'class'=>'form-control')) !!}
                            @endif
                        </div>  
                      @endif
                  </div>

                  <div class="form-group clearfix">
                      @if(!empty($formFields->labels['ph_no']))
                          {!! Form::label('ph_no', $formFields->labels['ph_no'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            @if(!empty($address))
                                @if(!empty($address->shipping_address['s_first_name']))
                                    {!! Form::text('s_ph_no', $address->shipping_address['s_ph_no'], array('required','placeholder'=>$formFields->labels['ph_no'],'class'=>'form-control')) !!}
                                @endif
                            @else
                                {!! Form::text('s_ph_no', '', array('required','placeholder'=>$formFields->labels['ph_no'],'class'=>'form-control')) !!}
                            @endif 
                          </div>  
                      @endif
                  </div>
                 @endif
            </div>

    
            <div class="card-header bgm-blue head-title">
                <h2>Billing Address</h2>
            </div>
 
            <div class="card-body card-padding">
                <div class="ln_solid"></div>
                @if (!empty($formFields->labels))
                  <div class="form-group clearfix">
                      @if(!empty($formFields->labels['first_name']))
                           {!! Form::label('name', $formFields->labels['first_name'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                           <div class="col-md-6 col-sm-6 col-xs-12">
                                @if(!empty($address))
                                    @if(!empty($address->billing_address['b_first_name']))
                                        {!! Form::text('b_first_name',$address->billing_address['b_first_name'], array('required','placeholder' =>$formFields->labels['first_name'],'class'=>'form-control')) !!}
                                    @endif
                                @else
                                    {!! Form::text('b_first_name','', array('required','placeholder' =>$formFields->labels['first_name'],'class'=>'form-control')) !!}
                                @endif
                           </div>  
                      @endif
                  </div>

                    <div class="form-group clearfix">
                        @if(!empty($formFields->labels['last_name']))
                             {!! Form::label('surname', $formFields->labels['last_name'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                  @if(!empty($address))
                                      @if(!empty($address->billing_address['b_first_name']))
                                          {!! Form::text('b_last_name', $address->billing_address['b_last_name'] ,array('placeholder' =>$formFields->labels['last_name'],'class'=>'form-control')) !!}
                                      @endif
                                  @else
                                      {!! Form::text('b_last_name','',array('placeholder' =>$formFields->labels['last_name'],'class'=>'form-control')) !!}
                                  @endif
                            </div>    
                        @endif
                    </div>

                    <div class="form-group clearfix">
                        @if(!empty($formFields->labels['company_name']))
                            {!! Form::label('company_name', $formFields->labels['company_name'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                  @if(!empty($address->billing_address['company_name']))
                                      {!! Form::text('b_company_name',$address->shipping_address['b_company_name'],array('placeholder'=>$formFields->labels['company_name'],'class'=>'form-control')) !!}
                                  @else
                                      {!! Form::text('b_company_name','',array('placeholder'=>$formFields->labels['company_name'],'class'=>'form-control')) !!}
                                  @endif 
                            </div>    
                        @endif
                    </div>
                
                    <div class="form-group clearfix">
                        @if(!empty($formFields->labels['street_add']))
                            {!! Form::label('street_add', $formFields->labels['street_add'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                  @if(!empty($address))
                                      @if(!empty($address->billing_address['b_street_add']))
                                         {!! Form::text('b_street_add', $address->billing_address['b_street_add'] , array('required', 'placeholder' =>$formFields->labels['street_add'],'class'=>'form-control')) !!}
                                      @endif
                                  @else
                                      {!! Form::text('b_street_add','' , array('required', 'placeholder' =>$formFields->labels['street_add'],'class'=>'form-control')) !!}
                                  @endif
                            </div>    
                        @endif
                    </div>

                    <div class="form-group clearfix">
                        @if(!empty($formFields->labels['city']))
                             {!! Form::label('city', $formFields->labels['city'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                 @if(!empty($address))
                                      @if(!empty($address->billing_address['b_city']))
                                         {!! Form::text('b_city', $address->billing_address['b_city'] , array('required','placeholder' =>$formFields->labels['city'],'class'=>'form-control')) !!}
                                      @endif
                                 @else
                                      {!! Form::text('b_city', '' , array('required','placeholder' =>$formFields->labels['city'],'class'=>'form-control')) !!}
                                 @endif
                            </div>    
                        @endif
                    </div>

                    <div class="form-group clearfix">
                        @if(!empty($formFields->labels['country']))
                             {!! Form::label('country', $formFields->labels['country'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                 @if(!empty($address))
                                      @if(!empty($address->billing_address['b_country']))
                                         {!! Form::select('b_country', $country, $address->billing_address['b_country'] , array('required', 'class'=>'form-control')) !!}
                                      @endif
                                 @else
                                      {!! Form::select('b_country', $country, '' , array('required', 'class'=>'form-control')) !!}
                                 @endif
                            </div>    
                        @endif
                    </div>

                    <div class="form-group clearfix">
                        @if(!empty($formFields->labels['zip']))
                             {!! Form::label('country_area', $formFields->labels['zip'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                 @if(!empty($address))
                                      @if(!empty($address->billing_address['b_country_area']))
                                         {!! Form::text('b_country_area', $address->billing_address['b_country_area'] ,array('required','placeholder' =>$formFields->labels['zip'],'class'=>'form-control')) !!}
                                      @endif
                                 @else
                                      {!! Form::text('b_country_area', '',array('required','placeholder' =>$formFields->labels['zip'],'class'=>'form-control')) !!}
                                 @endif
                            </div>    
                        @endif
                    </div>

                    <div class="form-group clearfix">
                        @if(!empty($formFields->labels['ph_no']))
                             {!! Form::label('ph_no', $formFields->labels['ph_no'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                @if(!empty($address))
                                    @if(!empty($address->billing_address['b_ph_no']))
                                       {!! Form::text('b_ph_no', $address->billing_address['b_ph_no'] , array('required','placeholder'=>$formFields->labels['ph_no'],'class'=>'form-control')) !!}
                                    @endif
                               @else
                                    {!! Form::text('b_ph_no','', array('required','placeholder'=>$formFields->labels['ph_no'],'class'=>'form-control')) !!}
                               @endif
                            </div>    
                        @endif
                    </div>

                    <div class="form-group">
                      @if (!empty($formFields->labels['submit']))
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                              {!!HTML::linkRoute('dashboard-index', $formFields->labels['cancel'], array(), array('class'=>"btn btn-round btn-primary"))!!}
                                <button id="send" type="submit" class="btn btn-round btn-success">Proceed to Payment</button>
                          </div>
                      @endif
                    </div>
                 @endif
                <div class="ln_solid"></div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection

@section('footer_add_js_script')
    <script type="text/javascript">
        function goBack() {
            window.history.back();
        }
        
        jQuery(function($) {
            $(".cart_remove_item").click(function() {
            var id = $(this).attr('id');
            var click = $(this);
            $.ajax({
                    url: "{!! URL::route('cart_remove_item')  !!}",
                    data: {
                            id: id
                    },
                    success: function(data) {
                        $('.tm-cart .tmn-counts').html(data);
                        click.closest('tr').remove();
                    }
                }); 
            });
        });
    </script>
@endsection


