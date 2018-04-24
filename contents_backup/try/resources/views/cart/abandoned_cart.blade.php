    @extends('layout.backend.master')
    @extends('layout.backend.userinfo')
    
    @section('right_col_title_left')
    @endsection
    
    @section('right_col_title_right')
    @endsection

    @section('right_col')
      <!-- will be used to show any messages -->
        @if (Session::has('message'))
            <div class="alert alert-info">{!!  Session::get('message')  !!}</div>
        @endif
      
        @include('navigation_tabs.product_mgmt_tabs')
      
        <div class="card">
            <div class="card-header card-padding-sm bgm-blue head-title">
                <h2>Abandoned Cart</h2>
            </div>

            <div class="card-body card-padding">
                  <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                      @if($products->count())
                          <table class="table table-striped responsive-utilities jambo_table ">
                              <thead>
                                  <th>Store Name</th>
                                  <th>User Name</th>
                                  <th>Email Id</th>
                                  <th>Product Name</th>
                                  <th>Quantity</th>
                                  <th>Part No.</th>
                                  <th>Reference No.</th>
                                  <th>Date</th>
                                  <th>Action</th>
                              </thead>
                              <?php 
                                  $amt = 0;
                                  $total_amt = 0;
                              ?>
                              <tbody>
                                  @foreach ($products as $product)
                                       <tr>
                                           <td>
                                               @if(!empty($product->shopid))
                                                    {!! $store[$product->shopid] !!} ({!! $product->shopid !!})
                                               @else
                                                    {!! 'N/A' !!}
                                               @endif
                                           </td>
                                           <td>
                                               @if(!empty($product->userid))
                                                    {!! $user_name[$product->userid] !!}
                                               @else
                                                    {!! 'N/A' !!}
                                               @endif
                                           </td>
                                           <td>
                                               @if(!empty($product->email))
                                                    {!! $product->email !!}
                                               @else
                                                    {!! 'Not Available' !!}
                                               @endif
                                           </td>
                                           <td>{!! $product->product_name !!}</td>
                                           <td>{!! $product->qty !!}</td>
                                           <td>{!! $product->part_number !!}</td>
                                           <td>{!! $product->seller_ref_code !!}</td>
                                           <td>{!! $product->created_at !!}</td>
                                           <td><a href="{!! route('view_abandoned_cart',[$product->shopid, $product->_id])  !!}">View</a></td>
                                       </tr>
                                       <?php                              
                                           $amount = $product->price * $product->qty;
                                           $total_amt = $total_amt + $amount;
                                       ?>

                                      @if(!empty($product->vat) && $product->vat!== 0)
                                          <?php 
                                              $vat = round($product->price * ($product->vat/100),2);
                                              $total_amt = $total_amt + $vat;
                                          ?>
                                      @endif

                                      @if(!empty($product->eco_tax) && $product->eco_tax!== 0)
                                         <?php 
                                              $eco_tax = round($product->price * ($product->eco_tax/100),2);
                                              $total_amt = $total_amt + $eco_tax;
                                          ?>
                                      @endif

                                      @if(!empty($product->duty_tax) && $product->duty_tax!== 0)
                                          <?php 
                                              $duty_tax = round($product->price * ($product->duty_tax/100),2);
                                              $total_amt = $total_amt + $duty_tax;
                                          ?>
                                      @endif

                                      @if(!empty($product->local_tax) && $product->local_tax!== 0) 
                                          <?php
                                              $local_tax = round($product->price * ($product->local_tax/100),2);
                                              $total_amt = $total_amt + $local_tax;
                                          ?>
                                      @endif
                                   @endforeach
                               </tbody>
                               <tfoot>
                                   <tr style="background-color: #2196f3">
                                       <td><b>Total Amount</b></td><td align="right" colspan="8"><b>{!! $total_amt !!}</b></td>
                                   </tr>
                               </tfoot>
                           </table>
                       @else 
                          <div class="card-body card-padding">
                              <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                                   There are no Items in the Abandoned Cart.
                              </div>
                           </div> 
                       @endif
                  </div>
            </div>    
        </div>             
                    

    @endsection

@section('footer_add_js_script')

@endsection