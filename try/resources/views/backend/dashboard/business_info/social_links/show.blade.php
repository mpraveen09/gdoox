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
<div class="card">
    <div class="card-header bgm-blue head-title">
        <h2>{!!$fm_data->labels['view']!!}</h2>
        <a href="{!! route('business-info-create') !!}" class="btn btn-round btn-default">Create New</a>
        <a href="{!! route('business-info-edit', $business->_id)  !!}"class="btn btn-round btn-default">Edit</a>
        <a href="{!! route('business-info-index')  !!}" class="btn btn-round btn-default">View All</a>
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
           <tr>
                <td >{!!$fm_data->labels['phone_no1']!!}</td>
                <td>{!! $business->phone_no1 !!}</td>
            </tr>
           <tr>
                <td >{!!$fm_data->labels['phone_no2']!!}</td>
                <td>{!! $business->phone_no2 !!}</td>
            </tr>
           <tr>
                <td >{!!$fm_data->labels['fax_no']!!}</td>
                <td>{!! $business->fax_no !!}</td>
            </tr>
    
            
           <tr>
                <td >{!!$fm_data->labels['mobile']!!}</td>
                <td>{!! $business->mobile !!}</td>
            </tr>
           <tr>
                <td >{!!$fm_data->labels['skype']!!}</td>
                <td>{!! $business->skype !!}</td>
            </tr>
           <tr>
                <td >{!!$fm_data->labels['business_email1']!!}</td>
                <td>{!! $business->business_email1 !!}</td>
            </tr>
           <tr>
                <td >{!!$fm_data->labels['business_email2']!!}</td>
                <td>{!! $business->business_email2 !!}</td>
            </tr>
     
            
           <tr>
                <td >{!!$fm_data->labels['desc']!!}</td>
                <td>{!! $business->desc !!}</td>
            </tr>
           <tr>
                <td >{!!$fm_data->labels['tags']!!}</td>
                <td>{!! $business->tags !!}</td>
            </tr>
           <tr>
                <td >{!!$fm_data->labels['org_type']!!}</td>
                <td>{!! $business->org_type !!}</td>
            </tr>
            <tr>
                <td >{!!$fm_data->labels['actvity_type']!!}</td>
                <td>{!! $business->actvity_type !!}</td>
            </tr>
           <tr>
                <td >{!!$fm_data->labels['operation']!!}</td>
                <td>{!! $business->operation !!}</td>
            </tr>
           <tr>
                <td >{!!$fm_data->labels['brands']!!}</td>
                <td>{!! $business->brands !!}</td>
            </tr>
            <tr>
                <td >{!!$fm_data->labels['payment_form']!!}</td>
                <td>{!! $business->payment_form !!}</td>
            </tr>
           <tr>
                <td >{!!$fm_data->labels['credit_card']!!}</td>
                <td>{!! $business->credit_card !!}</td>
            </tr>
           <tr>
                <td >{!!$fm_data->labels['paypal']!!}</td>
                <td>{!! $business->paypal !!}</td>
            </tr>
           <tr>
                <td >{!!$fm_data->labels['return_policy']!!}</td>
                <td>{!! $business->return_policy !!}</td>
            </tr>
           <tr>
                <td >{!!$fm_data->labels['market']!!}</td>
                <td>{!! $business->market !!}</td>
            </tr>
           <tr>
                <td >{!!$fm_data->labels['company_logo']!!}</td>
                <td>@if(!empty($business->company_logo))
                        <?php $img=$business->company_logo?>
                        <br/>
                        <img src='{!!asset("uploads/$img")!!} 'class='' style="width:150px;">
                   @endif
                </td>
            </tr>
           <tr>
                <td >{!!$fm_data->labels['return_policy']!!}</td>
                <td>{!! $business->return_policy !!}</td>
            </tr>
        </tbody>
    </table>
</div><!-- .card -->
        
@endsection


