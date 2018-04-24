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

    @if(!empty($opportunities))
        <div class="card">
            <div class="card-header bgm-blue head-title">
                <h2>Abandoned Cart Opportunities</h2>
                <a href="{!! route('crm_ab_cart_opportunities.create')  !!}" class="btn  btn-default">Create New</a>
<!--            <a href="{!! route('crm_opportunities.index')  !!}" class="btn  btn-default">View All</a>-->
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
<!--                                             <a href="{!! route('crm_opportunities.edit', $opportunity->_id)  !!}">
                                                 <i class='zmdi zmdi-edit zmdi-hc-fw'></i>
                                             </a>-->
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

@endsection
 
@section('footer_add_js_script')
<script>
function goBack() {
    window.history.back();
}
</script>
@endsection