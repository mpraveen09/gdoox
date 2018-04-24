@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <!--<h2>{!!$fm_data->labels['form_title']!!}</h2>-->
@endsection
@section('right_col_title_right')
<!--    <a href="{!! route('business-info-index')  !!}" class="btn btn-round btn-default">View All</a>
    <a href="{!! route('business-info-create') !!}" class="btn btn-round btn-default">Create New</a>
    <a href="{!! route('business-info-edit', $business->_id)  !!}"class="btn btn-round btn-default">Edit</a>-->
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
                <td>{!! implode(', ', $business->org_type) !!}</td>
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
  
            
          <tr>
                <td >{!!$fm_data->labels['payment_form']!!}</td>
                <td>{!! implode(', ', $business->payment_form)!!}</td>
            </tr>
           <tr>
                <td >{!!$fm_data->labels['credit_card']!!}</td>
                <td>{!! implode(', ', $business->credit_card) !!}</td>
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
                <td >{!!$fm_data->labels['logo']!!}</td>
                <td>@if(!empty($business->logo))
                        <?php $img = $business->logo_path.$business->logo;?>
                        <br/>
                        <img src='{!!asset($img)!!} ' class='' style="width:150px;">
                   @endif
                </td>
            </tr>
           <tr>
                <td >{!!$fm_data->labels['return_policy']!!}</td>
                <td>{!! $business->return_policy !!}</td>
            </tr>
            <tr>
                <td >{!!$fm_data->labels['vat_fiscal_id']!!}</td>
                <td>{!! $business->vat_fiscal_id !!}</td>
            </tr>
            <tr>
                <td >{!!$fm_data->labels['status']!!}</td>
                <td>{!! $business->status !!}</td>
           </tr>
         </tbody>
      </table>
  </div>
</div><!-- .card -->
<div class="card">
    <div class="card-header bgm-blue">
        <h2>View and Verify Documents</h2>
    </div><!-- .card-header -->
    @if($verification_info->count())
         <div class="card-body card-padding clearfix">
            <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                  <table class="table table-striped responsive-utilities jambo_table ">
                    <tbody>
                       <?php $i = 1; ?>
                        @if(isset($verification_info->doc))
                            @foreach($verification_info->doc as $doc)
                                <tr>
                                    <td>Document {!!$i , $verification_info->ext!!}</td>
                                    <td><a href="{{ asset('/uploads/company_docs/'.$doc) }}">@if($verification_info->ext=='pdf'){!!HTML::image('images/pdf.png'),$doc!!}@else{!!HTML::image('images/jpg.png'),$doc!!}@endif</a></td>
                                </tr>
                              <?php $i++ ?>
                            @endforeach
                        @else
                            <tr>
                                <td>Vat Fiscal Id: </td>
                                <td>{!! $verification_info->vat_fiscal_id !!}</td>
                            </tr>
                        @endif
                    </tbody>
                  </table>
            </div>
            {!! Form::open(array('method'=>'PUT', 'route' => array('business-details-update',  $business->id))) !!}
               <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                     {!!HTML::linkRoute('business-info-index', $fm_data->labels['cancel'], array(), array('class'=>"btn btn-round btn-primary"))!!}
                     <button id="send" type="submit" class="btn btn-round btn-success" onclick='return confirm("Are you sure you verify these documnets?")'>Verify</button>
                  </div>
               </div>
            {!! Form::close()!!}
        </div>
    @else
        <div class="card-body card-padding clearfix">
            <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                Verification Info Not Available.
            </div>
        </div>
    @endif
</div><!-- .card -->
@endsection


