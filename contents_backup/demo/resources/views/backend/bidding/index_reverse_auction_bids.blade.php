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
      
        @include('navigation_tabs.marketing_tabs')
      
        <div class="card">
            <div class="card-header card-padding-sm bgm-blue head-title">
                <h2>Reverse Auction Bids</h2>
            </div>

            <div class="card-body card-padding">
                  <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                      @if($reverse_biddings->count())
                          <table class="table table-striped responsive-utilities jambo_table ">
                              <thead>
                                    <th>Product Name</th>
                                    <th>Store</th>
                                    <th>Highest Bid</th>
                                    <th>Bid User</th>
                                    <th>View All Bids</th>
                                    <th>Action</th>
                              </thead>
                              
                              <tbody>
                                  @foreach ($reverse_biddings as $bidding)
                                       <tr>
                                           <td>
                                               @if(!empty($bidding->desc))
                                                   {!! $bidding->desc !!}
                                               @else
                                                    {!! 'N/A' !!}
                                               @endif
                                           </td>
                                           <td>
                                               @if(!empty($bidding->shopid))
                                                   {!! $bidding->shopid !!}
                                               @else
                                                    {!! 'N/A' !!}
                                               @endif
                                           </td>
                                           <td>
                                               @if(!empty($bidding->lowest_bid_amt))
                                                   {!! $bidding->lowest_bid_amt !!}
                                               @else
                                                    {!! 'N/A' !!}
                                               @endif
                                           </td>
                                           <td>
                                               @if(!empty($bidding->lowest_bid_username))
                                                   {!! $bidding->lowest_bid_username !!}
                                               @else
                                                    {!! 'N/A' !!}
                                               @endif
                                           </td>
                                           <td data-toggle="modal" href="#noAnimation" data-val="{!! $bidding->product_id !!}" class="other_bids"><a href="#">Bids</a></td>
                                           <td>
                                               <a target="_blank" href="<?php echo URL('site/'.$bidding->shopid.'/show', $bidding->product_id)?>" class="btn btn-info">View</a>
                                           </td>
                                       </tr>
                                   @endforeach
                               </tbody>
                           </table>
                       @else 
                          <div class="card-body card-padding">
                              <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                                   You have No products in Reverse Auction.
                              </div>
                           </div> 
                       @endif
                  </div>
                <!-- Dialog box to view the Bids of the Auction.-->
                <div class="modal" id="noAnimation" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Product Bids</h4>
                            </div>
                            <div class="modal-body" style="overflow-y: scroll; height:auto;"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        </div>             
    @endsection

@section('footer_add_js_script')
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click', '.other_bids', function() {
            var productid = $(this).attr('data-val');
            $.ajax({
                url: "{!! URL::route('view_product_bids') !!}",
                data: {
                    productid: productid,
                },
                success: function(html) {
                    $('.modal-body').html('');
                    $('.modal-body').html(html);
                }
            });
        }); 
    });
</script>
@endsection