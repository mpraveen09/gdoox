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

    @if(Session::has('message'))
        <div class="alert alert-info alert-dismissible" role="alert">
            {!!  Session::get('message')  !!}
        </div>
    @endif
    
      @include('navigation_tabs.crm_tabs')
        
      <div class="card">
            <div class="card-header bgm-blue">
                <h2>Search Opportunity</h2>
            </div>
        
            {!! Form::open([
                'method' => 'GET',
                'route' => 'crm_opportunities.index',
                'class' => 'form-horizontal form-label-left'
            ]) !!}

                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Search Opportunity Type:</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::select('opportunity_type',$opportunitytype,null, ['placeholder'=>'Select Opportunity Type','id'=>'opportunity_type','class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="ln_solid"></div>
                
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-5">
                        <a href="{!! route('crm_opportunities.index')  !!}" type="submit" class="btn btn-round btn-primary">Cancel</a>
                        <button id="send" type="submit" class="btn btn-round btn-success">Search</button>
                    </div>
                </div>
                
                <div class="ln_solid"></div>
                <br />
        {!! Form::close() !!}
    </div>
    
    
    @if(!empty($opportunities))
        <div class="card">
            <div class="card-header bgm-blue head-title">
                <h2>CRM Opportunities</h2>
                <a href="{!! route('crm_opportunities.create')  !!}" class="btn  btn-default">Create New</a>
                <a href="{!! route('crm_opportunities.index')  !!}" class="btn  btn-default">View All</a>
            </div>
            @if(!empty($opportunities->count()))
                <div class="row">
                    <div class="text-right col-md-12">
                         {!! $opportunities->render() !!}
                    </div>
                </div>
                <div class="card-body card-padding">  
                    <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                          <table class="table table-striped responsive-utilities jambo_table ">
                              <thead>
                                    <th>Opportunity Name</th>
                                    <th>Expected </br> Closing Date</th>
                                    <th>Type</th>
                                    <th>Opportunity Amt. </th>
                                    <th>Sales Stage</th>
                                    <th>Lead Source</th>
                                    <th>Probability</th>
                                    <th>Action</th>
                               </thead>

                               <tbody>
                                   @foreach($opportunities as $opportunity)
                                    <tr>
                                         <td>{!! $opportunity->opportunity_name !!}</td>
                                         <td>{!! $opportunity->excected_closing_date !!}</td>
                                         <td>{!! $opportunity->type !!}</td>
                                         <td>{!! $opportunity->opportunity_amt !!} {!! substr($opportunity->currency, -3) !!}</td>
                                         <td>{!! $opportunity->sales_stage !!}</td>
                                         <td>{!! $opportunity->lead_source !!}</td>
                                         <td>{!! $opportunity->probability !!}</td>

                                         <td>
                                             <a href="{!! route('crm_opportunities.show', $opportunity->_id)  !!}">
                                                 <i class='zmdi zmdi-eye zmdi-hc-fw'></i>
                                             </a> &nbsp; 
                                             <a href="{!! route('crm_opportunities.edit', $opportunity->_id)  !!}">
                                                 <i class='zmdi zmdi-edit zmdi-hc-fw'></i>
                                             </a>
                                         </td>
                                     </tr>
                                    @endforeach
                               </tbody>  
                           </table>
                  </div>
               </div>
                <div class="row">
                    <div class="text-right col-md-12">
                         {!! $opportunities->render() !!}
                    </div>
                </div>
            @else
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-warning alert-dismissible" role="alert">
                             You have no Opportunities
                        </div>  
                    </div>
                </div>
            @endif
        </div>
    @endif
    
    
    @if(!empty($ab_cart_opportunities))
    <div class="card">
       <div class="card-header card-padding-sm bgm-blue head-title">
           <h2>Abandoned Cart Opportunities</h2>
       </div>

       <div class="card-body card-padding">
             <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                 @if($ab_cart_opportunities->count())
                     <table class="table table-striped responsive-utilities jambo_table ">
                         <thead>
                             <th>Store Name</th>
                             <th>User Name</th>
                             <th>Email Id</th>
                             <th>Product Name</th>
                             <th>Quantity</th>
                             <th>Date</th>
                             <th>Price</th>
                         </thead>
                         <?php 
                             $amt = 0;
                             $total_amt = 0;
                         ?>
                         <tbody>
                            @foreach ($ab_cart_opportunities as $cart_opportunities)
                                  <tr>
                                      <td>
                                          @if(!empty($cart_opportunities->shopid))
                                               {!! $store[$cart_opportunities->shopid] !!} ({!! $cart_opportunities->shopid !!})
                                          @else
                                               {!! 'N/A' !!}
                                          @endif
                                      </td>
                                      <td>
                                          @if(!empty($cart_opportunities->userid))
                                               {!! $user_name[$cart_opportunities->userid] !!}
                                          @else
                                               {!! 'N/A' !!}
                                          @endif
                                      </td>
                                      <td>
                                          @if(!empty($cart_opportunities->email))
                                               {!! $cart_opportunities->email !!}
                                          @else
                                               {!! 'Not Available' !!}
                                          @endif
                                      </td>
                                      <td>{!! $cart_opportunities->product_name !!}</td>
                                      <td>{!! $cart_opportunities->qty !!}</td>
                                      <td>{!! $cart_opportunities->created_at !!}</td>
                                      <td>
                                          <?php                              
                                               $amount = $cart_opportunities->price * $cart_opportunities->qty;
                                               $total_amt = $total_amt + $amount;
                                           ?>

                                           @if(!empty($cart_opportunities->vat) && $cart_opportunities->vat!== 0)  
                                               <?php 
                                                   $vat = round($cart_opportunities->price * ($cart_opportunities->vat/100),2);
                                                   $total_amt = $total_amt + $vat;
                                               ?>
                                           @endif

                                           @if(!empty($cart_opportunities->eco_tax) && $cart_opportunities->eco_tax!== 0)
                                              <?php 
                                                   $eco_tax = round($cart_opportunities->price * ($cart_opportunities->eco_tax/100),2);
                                                   $total_amt = $total_amt + $eco_tax;
                                               ?>
                                           @endif

                                           @if(!empty($cart_opportunities->duty_tax) && $cart_opportunities->duty_tax!== 0)
                                               <?php 
                                                   $duty_tax = round($cart_opportunities->price * ($cart_opportunities->duty_tax/100),2);
                                                   $total_amt = $total_amt + $duty_tax;
                                               ?>
                                           @endif

                                           @if(!empty($cart_opportunities->local_tax) && $cart_opportunities->local_tax!== 0) 
                                               <?php
                                                   $local_tax = round($cart_opportunities->price * ($cart_opportunities->local_tax/100),2);
                                                   $total_amt = $total_amt + $local_tax;
                                               ?>
                                           @endif
                                           {!! $total_amt !!}
                                      </td>
<!--                                           <td><a href="{!! route('view_abandoned_cart',[$cart_opportunities->shopid, $cart_opportunities->cart_id])  !!}">View</a></td>-->
                                  </tr>
                            @endforeach
                          </tbody>
                      </table>
                  @else 
                     <div class="card-body card-padding">
                         <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                              There are no Opportunities for Abandoned Cart.
                         </div>
                      </div> 
                  @endif
             </div>
       </div>    
    </div>     
    @endif
    
    @if(!empty($sales_opportunities))
        <div class="card">
            <div class="card-header bgm-blue">
                <h2>Sales Representatives</h2>
            </div>
            @if(!$sales_opportunities->count())
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-warning alert-dismissible" role="alert">
                             You have no Opportunities
                        </div>  
                    </div>
                </div>               
            @else
            <div class="row">
                <div class="text-right col-md-12">
                     {!! $sales_opportunities->render() !!}
                </div>
            </div>
            <div class="card-body card-padding">  
                <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                      <table class="table table-striped responsive-utilities jambo_table ">
                          <thead>
                                <th>Name</th>
                                <th>Country of Work</th>
                                <th>Region</th>
                                <th>Email</th>
                                <th>Market Area</th>
                                <th>Business Description</th>
                           </thead>

                           <tbody>
                               @foreach($sales_opportunities as $opportunity)
                                <tr>
                                     <td>{!! $opportunity->first_name." ".$opportunity->last_name  !!}</td>
                                     <td>{!! $opportunity->country_of_work !!}</td>
                                     <td>{!! $opportunity->region !!}</td>
                                     <td>{!! $opportunity->business_email !!}</td>
                                     <td>{!! $opportunity->market_area !!}</td>
                                     <td>{!! $opportunity->your_business !!}</td>
                                 </tr>
                                @endforeach
                           </tbody>  
                       </table>
              </div>
           </div>
            <div class="row">
                <div class="text-right col-md-12">
                     {!! $sales_opportunities->render() !!}
                </div>
            </div>
            @endif  
        </div>
    @endif
    
    @if(!empty($externalpartners))
        <div class="card">
            <div class="card-header bgm-blue">
                <h2>Invitations (External Partners)</h2>
            </div>
            @if(!$externalpartners->count())
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-warning alert-dismissible" role="alert">
                             There are no Invitations to External Partners.
                        </div>  
                    </div>
                </div>               
            @else
            <div class="row">
                <div class="text-right col-md-12">
                     {!! $externalpartners->render() !!}
                </div>
            </div>
            <div class="card-body card-padding">  
                <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                      <table class="table table-striped responsive-utilities jambo_table ">
                          <thead>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Inviter Email</th>
                                <th>Invitation Date</th>
                           </thead>

                           <tbody>
                               @foreach($externalpartners as $invitations)
                                <tr>
                                     <td>{!! $invitations->name !!}</td>
                                     <td>{!! $invitations->email !!}</td>
                                     <td>{!! $invitations->inviter_email !!}</td>
                                     <td>{!! $invitations->invitation_date !!}</td>
                                 </tr>
                                @endforeach
                           </tbody>  
                       </table>
              </div>
           </div>
            <div class="row">
                <div class="text-right col-md-12">
                     {!! $externalpartners->render() !!}
                </div>
            </div>
            @endif  
        </div>
    @endif
    
    
@endsection
 
@section('footer_add_js_script')
<script>
function goBack() {
    window.history.back();
}
</script>
@endsection