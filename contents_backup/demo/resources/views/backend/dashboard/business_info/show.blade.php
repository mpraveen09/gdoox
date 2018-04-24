@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
  <!--<h2>{!!$fm_data->labels['form_title']!!}</h2>-->
<!--<div class="page-top-links">-->
<!--</div>-->
@endsection
@section('right_col_title_right')
@endsection

@section('right_col')

    @if (Session::has('message'))
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!!  Session::get('message')  !!}
        </div>
    @endif
    
    @if (HTML::ul($errors->all()))
      <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          {!! HTML::ul($errors->all()) !!}
      </div>
    @endif
  
  @include('navigation_tabs.general_tabs')
  
<div class="card">
    <div class="card-header bgm-blue head-title">
        <h2>{!!$fm_data->labels['view']!!}</h2>
        <a href="{!! route('business-info-create')  !!}" class="btn btn-default">Create New</a>
        <a href="{!! route('business-info-edit', $business->_id)  !!}"class="btn btn-round btn-default">Edit</a>
        <a href="{!! route('ecomm-index')  !!}" class="btn btn-default">View All</a>
    </div><!-- .card-header -->
    <!-- will be used to show any messages -->

    <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
        <table class="table table-striped responsive-utilities jambo_table ">
            <tbody>
               <tr>
                    <td >{!!$fm_data->labels['company_name']!!}</td>
                    <td>{!! $business->company_name !!}</td>
                </tr>
               <tr>
                    <td >{!!$fm_data->labels['street_add']!!}</td>
                    <td>{!! $business->street_add !!}</td>
                </tr>
               <tr>
                    <td >{!!$fm_data->labels['city']!!}</td>
                    <td>{!! $business->city !!}</td>
                </tr>
               <tr>
                    <td >{!!$fm_data->labels['country']!!}</td>
                    <td>{!! $business->country !!}</td>
                </tr>
               <tr>
                    <td >{!!$fm_data->labels['zip']!!}</td>
                    <td>{!! $business->zip !!}</td>
                </tr>
                @if(!empty($business->phone_no1))
                  <tr>
                       <td >{!!$fm_data->labels['phone_no1']!!}</td>
                       <td>{!! $business->phone_no1 !!}</td>
                   </tr>
                @endif
                @if(!empty($business->phone_no2))
                <tr>
                     <td >{!!$fm_data->labels['phone_no2']!!}</td>
                     <td>{!! $business->phone_no2 !!}</td>
                 </tr>
                @endif
                @if(!empty($business->fax_no))
                  <tr>
                       <td >{!!$fm_data->labels['fax_no']!!}</td>
                       <td>{!! $business->fax_no !!}</td>
                   </tr>
                @endif  
                @if(!empty($business->skype))
                <tr>
                     <td >{!!$fm_data->labels['mobile']!!}</td>
                     <td>{!! $business->mobile !!}</td>
                 </tr>
                @endif
                @if(!empty($business->skype))
                <tr>
                     <td >{!!$fm_data->labels['skype']!!}</td>
                     <td>{!! $business->skype !!}</td>
                 </tr>
                 @endif
                @if(!empty($business->business_email2))
                  <tr>
                       <td >{!!$fm_data->labels['business_email1']!!}</td>
                       <td>{!! $business->business_email1 !!}</td>
                   </tr>
                @endif   
                @if(!empty($business->business_email2))
                  <tr>
                       <td >{!!$fm_data->labels['business_email2']!!}</td>
                       <td>{!! $business->business_email2 !!}</td>
                   </tr>
                @endif
                @if(!empty($business->desc))
                  <tr>
                       <td >{!!$fm_data->labels['desc']!!}</td>
                       <td>{!! $business->desc !!}</td>
                   </tr>
                @endif
                @if(!empty($business->business_desc_tags))
                <tr>
                     <td >{!!$fm_data->labels['tags']!!}</td>
                     <td>{!! $business->business_desc_tags !!}</td>
                 </tr>
                @endif 
                @if(!empty($business->org_type))
                <tr>
                     <td >{!!$fm_data->labels['org_type']!!}</td>
                     <td>{!! implode(', ', $business->org_type) !!}</td>
                 </tr>
                @endif
                <tr>
                    <td >{!!$fm_data->labels['actvity_type']!!}</td>
                    <td>{!! $business->actvity_type !!}</td>
                </tr>
               <tr>
                    <td >{!!$fm_data->labels['operation']!!}</td>
                    <td>{!! $business->operation !!}</td>
                </tr>
                @if(!empty($business->brands))
               <tr>
                    <td >{!!$fm_data->labels['brands']!!}</td>
                    <td>{!! $business->brands !!}</td>
                </tr>
                @endif
    <!--            @if(!empty($business->payment_form))
                <tr>
                    <td >{!!$fm_data->labels['payment_form']!!}</td>
                    <td>{!! implode(', ', $business->payment_form) !!}</td>
                </tr>
                @endif-->
    <!--           <tr>
                    <td >{!!$fm_data->labels['credit_card']!!}</td>
                    <td>{!! implode(', ', $business->credit_card) !!}</td>
                </tr>-->
    <!--            @if(!empty($business->paypal))
                  <tr>
                       <td >{!!$fm_data->labels['paypal']!!}</td>
                       <td>{!! $business->paypal !!}</td>
                   </tr>
                @endif-->
                @if(!empty($business->policy_doc))
               <tr>
                    <td >{!!$fm_data->labels['return_policy']!!}</td>
                    <td>
                              <?php $img = $business->doc_path.$business->policy_doc;?>
                              <a href="{!!asset($img)!!}">{!!$business->policy_doc!!}</a>
                    </td>
                </tr>
                @elseif(!empty($policy_doc_data))
               <tr>
                    <td >{!!$fm_data->labels['return_policy']!!}</td>
                    <td>{!! $business->policy_doc_data !!}</td>
                </tr>
                @endif
               <tr>
                    <td >{!!$fm_data->labels['market']!!}</td>
                    <td>{!! $business->market !!}</td>
                </tr>
              @if(!empty($business->logo))
               <tr>
                    <td >{!!$fm_data->labels['logo']!!}</td>
                    <td>@if(!empty($business->logo))
                            <?php $img = $business->logo_path.$business->logo;?>
                            <br/>
                            <img src='{!!asset($img)!!} ' class='' style="width:150px;">
                       @endif
                    </td>
                </tr>
              @endif
            </tbody>
        </table>
    </div><!-- .table-responsive -->
</div><!-- .card -->
        
@endsection


