@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--    <h2>{!!$fm_data->labels['form_title']!!}</h2>-->
@endsection

@section('right_col')
<h1>{!!$business->company_name!!}</h1>
@include('navigation_tabs.general_tabs')
<div class="card">  
    <div class="card-body">
        @if(!empty($business->company_image))
            <img src='{!!asset("uploads/$business->company_image")!!} 'class='' style="width:100%;">
        @endif
    </div>
    <div class="card-header bgm-blue">
            <h2>{!!$business->company_name!!}</h2>      
    </div>

    <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;"> 
    <table class="table table-striped responsive-utilities jambo_table ">
        <tbody>
            <tr>
                <td >{!!$fm_data->labels['company_logo']!!}</td>
                <td>
                </td>
            </tr>
            <tr>
                <td>@if(!empty($business->company_logo))
                        <img src='{!!asset("uploads/$business->company_logo")!!} 'class='' style="width:150px;">
                   @endif
                </td>
                <td></td>
            </tr>
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
<!--           <tr>
                <td >{!!$fm_data->labels['phone_no1']!!}</td>
                <td>{!! $business->phone_no1 !!}</td>
            </tr>-->
<!--           <tr>
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
            </tr>-->
     
            
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
                <td >{!!$fm_data->labels['position']!!}</td>
                <td>{!!  implode(', ',$business->position)!!}</td>
            </tr>

           <tr>
                <td >{!!$fm_data->labels['dimensions']!!}</td>
                <td>{!! $business->dimensions !!}</td>
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
  
            
<!--          <tr>
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
            </tr>-->
<!--           <tr>
                <td >{!!$fm_data->labels['return_policy']!!}</td>
                <td>{!! $business->return_policy !!}</td>
            </tr>
            
         <tr>
                <td >{!!$fm_data->labels['market']!!}</td>
                <td>{!! $business->market !!}</td>
            </tr>
           <tr>
                <td >{!!$fm_data->labels['credit_card']!!}</td>
                <td> @if(!empty($business->company_image))
                        {!! $img=$business->company_image !!}
                        <br/>
                        <img src='{!!asset("uploads/$img")!!} 'class='' style="width:150px;">
                   @endif
                </td>
            </tr>-->
           
<!--           <tr>
                <td >{!!$fm_data->labels['return_policy']!!}</td>
                <td>{!! $business->return_policy !!}</td>
            </tr>-->
        </tbody>
    </table>
    </div>
</div>        
@endsection


