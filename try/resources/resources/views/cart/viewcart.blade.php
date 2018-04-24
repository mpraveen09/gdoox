@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <!--<h2>Cart</h2>-->
@endsection

@section('right_col')

    <!-- will be used to show any messages -->
    @if (Session::has('message'))
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!!  Session::get('message')  !!}
        </div>
    @endif
    
    @if (!$products->count())
    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>Cart</h2>
        </div>
        <div class="card-body ">
            <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    You have no Items in the Cart
                </div>
            </div>
        </div>
    </div>
    @endif
     
    @foreach($shopids as $shopid)
                      
    <div class="card">
        <div class="card-header bgm-blue">
            <h2>{!! $shopid[0] !!}</h2>
        </div><!-- .card-header -->
        <div class="card-body ">
            <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                <table class="table table-striped responsive-utilities jambo_table ">
                    <tr>
                        <th>Item</th>
                        <th>Description</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Tax</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                 <!--<tr>-->
                     <?php 
                        $final_amt = 0;
                        $final_tax_amt = 0;
                        $amt = 0;
                      ?>
                     @foreach( $products as $product)
                         @if($product->shopid === $shopid[0])
                         <?php  
                            $total_amt = 0;
                            $total_tax_amt = 0;
                          ?>
                         <tr>
                                <td class="col-md-1 col-sm-2">
                                       {!! HTML::image($product->thumb_path.$product->thumb, 'product thumb', array('class' => 'product-thumb thumb')) !!}
                                </td>
                                <td>{!! $product->desc !!}</td>
                                <td class="">
                                    <div class="cart-qty-panel-read qty_val"> 
                                        <a class="cart-qty" id="cart-qty" onclick="$(this).closest('td').addClass('change').find('.cart-qty-textbox').val($(this).html()).select().end().find('.cart-qty-panel-write').removeAttr('style');$(this).closest('td').find('.qty_val').css('display','none');">{!! $product->qty !!}</a> 
                                    </div>

                                    <div class="cart-qty-panel-write qty_text_val" style="display: none;">
                                        {!!Form::hidden('id',$product->_id, array('id'=>'id'))!!}
                                        <input type="text" name="qty" id="qty" value="{!! $product->qty !!}" class="cart-qty-textbox">
                                        <a class="cart-qty-save">Save</a> 
                                    </div>
                                </td>
                                <td>
                                   <?php
                                        $price = $product->price * $product->qty;
                                        $amt = $amt + $price;
                                        $total_amt = $total_amt + $price;
                                        echo $price;
                                    ?>
                                </td>
                                <td>
                                    <table>
                                        @if(!empty($product->vat) && $product->vat!== 0)
                                            <tr>
                                                <td>Vat({!! $product->vat !!}%)</td>
                                                <td style="padding-left:10px">{!! round($product->price * ($product->vat/100),2) !!}</td>
                                                <?php 
                                                    $vat = round($product->price * ($product->vat/100),2);
                                                    $total_amt = $total_amt + $vat;
                                                    $total_tax_amt = $total_tax_amt + $vat;
                                                ?>
                                            </tr>
                                        @else
                                            <tr>
                                                <td>Vat(0%)</td>
                                                <td style="padding-left:10px">0.00</td>
                                            </tr>
                                        @endif
                                        @if(!empty($product->eco_tax) && $product->eco_tax!== 0)
                                            <tr>
                                                <td>Eco Tax({!! $product->eco_tax !!}%)</td>
                                                <td align="right">{!! round($product->price * ($product->eco_tax/100),2) !!}</td>
                                                <?php 
                                                    $eco_tax = round($product->price * ($product->eco_tax/100),2);
                                                    $total_amt = $total_amt + $eco_tax;
                                                    $total_tax_amt = $total_tax_amt + $eco_tax;
                                                ?>
                                            </tr>
                                         @else
                                            <tr>
                                                <td>Eco Tax(0%)</td>
                                                <td style="padding-left:10px">0.00</td>
                                            </tr>
                                        @endif
                                        @if(!empty($product->duty_tax) && $product->duty_tax!== 0)
                                            <tr>
                                                <td>Duty Tax({!! $product->duty_tax !!}%)</td>
                                                <td align="right">{!! round($product->price * ($product->duty_tax/100),2) !!}</td>
                                                <?php 
                                                    $duty_tax = round($product->price * ($product->duty_tax/100),2);
                                                    $total_amt = $total_amt + $duty_tax;
                                                    $total_tax_amt = $total_tax_amt + $duty_tax;
                                                ?>
                                            </tr>
                                        @else 
                                            <tr>
                                                <td>Duty Tax(0%)</td>
                                                <td style="padding-left:10px">0.00</td>
                                            </tr>
                                        @endif
                                        
                                        @if(!empty($product->local_tax) && $product->local_tax!== 0)
                                            <tr>
                                                <td>Local Tax({!! $product->local_tax !!}%)</td>
                                                <td align="right">{!! round($product->price * ($product->local_tax/100),2) !!}</td>
                                                <?php 
                                                    $local_tax = round($product->price * ($product->local_tax/100),2);
                                                    $total_amt = $total_amt + $local_tax; 
                                                    $total_tax_amt = $total_tax_amt + $local_tax;
                                                ?>
                                            </tr>
                                         @else
                                            <tr>
                                                <td>Local Tax(0%)</td>
                                                <td style="padding-left:10px">0.00</td>
                                            </tr>
                                        @endif 
                                    </table>    
                                </td>
                                <td><?php echo $total_amt; ?></td>
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
                        @endif 
                     @endforeach
                 <!--</tr>-->
                </table>
                
                <table class="table table-striped responsive-utilities jambo_table ">
                    <tr><td><b>Amount :</b></td><td align="center"><b> {!! $amt !!}</b></td></tr>
                    <tr><td><b>Total Tax :</b></td><td align="center"><b>{!! $final_tax_amt !!}</b></td></tr>
                    <tr><td><b>Total Amount :</b></td><td align="center"><b>{!! $final_amt !!}</b></td></tr>
                </table>
            </div>
            <hr>
            <div class="text-center">
                <button class="btn btn-info waves-effect" onclick="goBack()">Go Back</button>
                <a href="{!! route('checkout.payment_proceed',['storeid'=>$shopid[0]]) !!}" type="submit" class="btn btn-round btn-primary">Proceed to Checkout</a> 
            </div>
            <br>
        </div>        
    </div>                        
    
    @endforeach
<!--              <table class="table table-striped responsive-utilities jambo_table ">
                  <thead>
                      <tr>
                          <th>Item</th>
                          <th>Store</th>
                          <th>Description</th>
                          <th>Qty</th>
                          <th>Price</th>
                      </tr>
                  </thead>

                  <tbody>
                    @foreach( $products as $product)
                         <tr>
                              <td>{!! $product->product_name  !!}</td>
                              <td>{!! $product->shopid  !!}</td>
                              <td>{!! $product->desc !!}</td>
                              <td class="">
                                    <div class="cart-qty-panel-read qty_val"> 
                                        <a class="cart-qty" id="cart-qty" onclick="$(this).closest('td').addClass('change').find('.cart-qty-textbox').val($(this).html()).select().end().find('.cart-qty-panel-write').removeAttr('style');$(this).closest('td').find('.qty_val').css('display','none');">{!! $product->qty !!}</a> 
                                    </div>
                                    <div class="cart-qty-panel-write qty_text_val" style="display: none;">
                                        {!!Form::hidden('id',$product->_id, array('id'=>'id'))!!}
                                        <input type="text" name="qty" id="qty" value="{!! $product->qty !!}" class="cart-qty-textbox">
                                        <a class="cart-qty-save">Save</a> 
                                    </div> 
                             </td>

                              <td>{!! $product->price * $product->qty !!}</td>
                        </tr>                
                    @endforeach
                  </tbody>
              </table>-->         
 @endsection
 
@section('footer_add_js_script')
<script type="text/javascript">
    jQuery(function($) {
        $(".cart-qty-save").click(function() {
            var qty = $(this).closest('div').find('input#qty').val();
            var cart_id = '{!!  Session::get('cart_items')  !!}';
            var id = $(this).closest('div').find('input#id').val();
            var click = $(this);
            $.ajax({
                    url: "{!! URL::route('cart_add_qty')  !!}",
                    data: {
                            qty: qty,
                            cart_id : cart_id,
                            id: id
                    },
                    success: function(data) {
                        click.closest('td').find('.qty_val').find('a.cart-qty').text(data.qty);                
                        click.closest('td').find('.qty_val').css('display','');
                        click.closest('td').find('.qty_text_val').css('display','none');
                        click.closest('td').next('td').text(data.price);
                    }
                }); 
            });
            
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