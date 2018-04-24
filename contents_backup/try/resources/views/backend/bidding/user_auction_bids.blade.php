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
                <h2>Your Bids</h2>
            </div>

            <div class="card-body card-padding">
                  <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                    @if($user_biddings->count())
                          <table class="table table-striped responsive-utilities jambo_table ">
                              <thead>
                                <th>Product Name</th>
                                <th>Store</th>
                                <th>Highest Bid</th>
                                <th>Your Bid</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Action</th>
                              </thead>
                              
                              <tbody>
                                  @foreach ($user_biddings as $bidding)
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
                                               @if(!empty($bidding->highest_bid_amt))
                                                   {!! $bidding->highest_bid_amt !!}
                                               @else
                                                    {!! 'N/A' !!}
                                               @endif
                                           </td>
                                           <td @if($bidding->highest_bid_amt === $bidding->product_bid_users[Auth::user()->id]['bid_amount']) bgcolor="#70db70" @else bgcolor="#ff6666" @endif>
                                               @if(!empty($bidding->product_bid_users))
                                                   {!! $bidding->product_bid_users[Auth::user()->id]['bid_amount'] !!} 
                                               @else
                                                    {!! 'N/A' !!}
                                               @endif
                                           </td>
                                           <td>
                                               @if(!empty($bidding->start_date))
                                                   {!! $bidding->start_date !!}
                                               @else
                                                    {!! 'N/A' !!}
                                               @endif
                                           </td>
                                           <td>
                                               @if(!empty($bidding->end_date))
                                                   {!! $bidding->end_date !!}
                                               @else
                                                    {!! 'N/A' !!}
                                               @endif
                                           </td>
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
                                You have not participated in any Bids.
                            </div>
                        </div>
                    @endif
                  </div>
            </div>    
        </div>             
    @endsection

@section('footer_add_js_script')

@endsection