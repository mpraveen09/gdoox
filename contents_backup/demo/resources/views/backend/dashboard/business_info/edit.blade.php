@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>  {!!$fm_data->labels['form_title']!!}</h2>-->
<!--<div class="page-top-links">-->
<!--</div>-->
@endsection

@section('right_col_title_right')
@endsection


@section('header_add_js_script')        
@endsection

@section('right_col')
    @if (Session::has('message'))
        <div class="alert alert-info">{!!  Session::get('message')  !!}</div>
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
         <h2>{!!$fm_data->labels['edit']!!}</h2>
         <a href="{!! route('business-info-create')  !!}" class="btn btn-default">Create New</a>
         <a href="{!! route('ecomm-index')  !!}" class="btn btn-default">View All</a>
    </div><!-- .card-header -->
   <div class="card-body card-padding">    
        {!! Form::model($business_info, [
            'method' => 'PUT',
            'route' => ['business-info-update', $business_info->id],
            'class' => 'form-horizontal form-label-left',
            'files'=>true
            ]) !!}

    @if (!empty($fm_data->labels))
        <div class="form-group clearfix">
            @if(!empty($fm_data->labels['company_name']))
                 {!! Form::label('company_name', $fm_data->labels['company_name'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
            @endif

            @if (!empty($fm_data->labels['company_name']))
                <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::text('company_name', $business_info->company_name, array('required','placeholder' =>$fm_data->labels['company_name'],'class'=>'form-control')) !!}
                </div>    
            @endif
        </div>

        <div class="form-group clearfix">
            @if(!empty($fm_data->labels['street_add']))
                 {!! Form::label('street_add', $fm_data->labels['street_add'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
            @endif

            @if (!empty($fm_data->labels['street_add']))
                <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::text('street_add', $business_info->street_add, array('placeholder' =>$fm_data->labels['street_add'],'class'=>'form-control')) !!}
                </div>    
            @endif
        </div>

        <div class="form-group clearfix">
            @if(!empty($fm_data->labels['city']))
                 {!! Form::label('city', $fm_data->labels['city'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
            @endif

            @if (!empty($fm_data->labels['city']))
                <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::text('city', $business_info->city, array('required','placeholder' =>$fm_data->labels['city'],'class'=>'form-control')) !!}
                </div>    
            @endif
        </div>

        <div class="form-group clearfix">
            @if(!empty($fm_data->labels['country']))
                 {!! Form::label('country', $fm_data->labels['country'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
            @endif
            @if (!empty($fm_data->labels['country']))
                <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::select('country', $country, $business_info->country, array('class'=>'form-control')) !!}
                </div>    
            @endif
        </div>

        <div class="form-group clearfix">
            @if(!empty($fm_data->labels['zip']))
                 {!! Form::label('zip', $fm_data->labels['zip'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
            @endif

            @if (!empty($fm_data->labels['zip']))
                <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::text('zip', $business_info->zip, array('required','placeholder' =>$fm_data->labels['zip'],'class'=>'form-control')) !!}
                </div>    
            @endif
        </div>

        <div class="form-group clearfix">
            @if(!empty($fm_data->labels['phone_no1']))
                 {!! Form::label('phone_no1', $fm_data->labels['phone_no1'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
            @endif

            @if (!empty($fm_data->labels['phone_no1']))
                <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::text('phone_no1', $business_info->phone_no1, array('required','placeholder' =>$fm_data->labels['phone_no1'],'class'=>'form-control')) !!}
                </div>    
            @endif
        </div>

        <div class="form-group clearfix">
            @if(!empty($fm_data->labels['phone_no2']))
                 {!! Form::label('phone_no2', $fm_data->labels['phone_no2'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
            @endif

            @if (!empty($fm_data->labels['phone_no2']))
                <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::text('phone_no2', $business_info->phone_no2, array('placeholder' =>$fm_data->labels['phone_no2'],'class'=>'form-control')) !!}
                </div>    
            @endif
        </div>

       <div class="form-group clearfix">
            @if(!empty($fm_data->labels['fax_no']))
                 {!! Form::label('fax_no', $fm_data->labels['phone_no2'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
            @endif

            @if (!empty($fm_data->labels['fax_no']))
                <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::text('fax_no', $business_info->fax_no, array('placeholder' =>$fm_data->labels['fax_no'],'class'=>'form-control')) !!}
                </div>    
            @endif
        </div>

       <div class="form-group clearfix">
            @if(!empty($fm_data->labels['mobile']))
                 {!! Form::label('mobile', $fm_data->labels['mobile'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
            @endif

            @if (!empty($fm_data->labels['mobile']))
                <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::text('mobile', $business_info->mobile, array('placeholder' =>$fm_data->labels['mobile'],'class'=>'form-control')) !!}
                </div>    
            @endif
        </div>

       <div class="form-group clearfix">
            @if(!empty($fm_data->labels['skype']))
                 {!! Form::label('skype', $fm_data->labels['skype'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
            @endif

            @if (!empty($fm_data->labels['skype']))
                <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::text('skype', $business_info->skype, array('placeholder' =>$fm_data->labels['skype'],'class'=>'form-control')) !!}
                </div>    
            @endif
        </div>

       <div class="form-group clearfix">
            @if(!empty($fm_data->labels['business_email1']))
                 {!! Form::label('business_email1', $fm_data->labels['business_email1'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
            @endif

            @if (!empty($fm_data->labels['business_email1']))
                <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::email('business_email1', $business_info->business_email1, array('required', 'placeholder' =>$fm_data->labels['business_email1'],'class'=>'form-control')) !!}
                </div>    
            @endif
        </div>

        <div class="form-group clearfix">
            @if(!empty($fm_data->labels['business_email2']))
                 {!! Form::label('business_email2', $fm_data->labels['business_email2'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
               <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::email('business_email2', $business_info->business_email2, array( 'placeholder' =>$fm_data->labels['business_email1'],'class'=>'form-control')) !!}
                </div>    
            @endif
        </div>
        
       <div class="form-group clearfix">
            @if(!empty($fm_data->labels['desc']))
                 {!! Form::label('desc', $fm_data->labels['desc'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::textarea('desc', $business_info->desc, array('size' => '30x4  ', 'placeholder' =>$fm_data->labels['desc'],'class'=>'form-control')) !!}
                </div>    
            @endif
       </div>
        
       <div class="form-group clearfix">
            @if(!empty($fm_data->labels['tags']))
                 {!! Form::label('tags', $fm_data->labels['tags'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('business_desc_tags', $business_info->business_desc_tags, array('id' => 'tags_1','class'=>'tags form-control')) !!}
                    <br><small><i>(Add some TAGS related to your business to help customers find you more easily)</i></small>
<!--                 <div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>-->
                </div>                
            @endif  
       </div>
        
        <div class="form-group clearfix">
            @if(!empty($fm_data->labels['org_type']))
                 {!! Form::label('org_type', $fm_data->labels['org_type'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                 <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::select('org_type[]', $organization, $business_info->org_type, array('required', 'multiple',  'class'=>'form-control')) !!}
                </div>    
            @endif
        </div>
    
       <div class="form-group clearfix">
            @if(!empty($fm_data->labels['actvity_type']))
                 {!! Form::label('actvity_type', $fm_data->labels['actvity_type'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 

                 <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::select('actvity_type', $activity, $business_info->actvity_type, array('required', 'class'=>'form-control')) !!}
                </div>    
            @endif
        </div>
        
       <div class="form-group clearfix">
            @if(!empty($fm_data->labels['operation']))
                 {!! Form::label('operation', $fm_data->labels['operation'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
            @endif

            @if (!empty($fm_data->labels['operation']))
                <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::select('operation', $business_opt, $business_info->operation, array('required', 'placeholder' =>$fm_data->labels['operation'],'class'=>'form-control')) !!}
                </div>    
            @endif
        </div>
        <div class="form-group clearfix">
              {!! Form::label('brands', "Brands You Deal With".$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
               <div class="col-md-6 col-sm-6 col-xs-12">
                   {!! Form::text('brands', $business_info->brands, array('required', 'id' => "tags_2", 'class'=>'form-control tags')) !!}<br>
                   <small>(If you want you can specify the main brands you deal with) </small>
             </div>    
         </div>
<!--       <div class="form-group clearfix">
            @if(!empty($fm_data->labels['payment_form']))
                 {!! Form::label('payment_form', $fm_data->labels['payment_form'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
            @endif

            @if (!empty($fm_data->labels['payment_form']))
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::select('payment_form[]', $accept_payment, $business_info->payment_form, array('required', 'multiple', 'class'=>'form-control')) !!}
                    <br>
                    <small>(Please specify the methods of payment you accept from other users) </small>
                </div>
                
            @endif
        </div>-->
        
<!--       <div class="form-group clearfix">
            @if(!empty($fm_data->labels['credit_card']))
                 {!! Form::label('credit_card', $fm_data->labels['credit_card'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
          
                 <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::select('credit_card[]', $credit_card, $business_info->credit_card, array( 'placeholder' =>$fm_data->labels['credit_card'], 'multiple', 'class'=>'form-control')) !!}
                <br>
                <small>(Please specify the types of credit card you accept for the payment from other users)</small>
                 </div>    
            @endif
        </div>-->
        
<!--      <div class="form-group clearfix">
            @if(!empty($fm_data->labels['paypal']))
                 {!! Form::label('paypal', $fm_data->labels['paypal'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
            @endif

            @if (!empty($fm_data->labels['paypal']))
                <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::text('paypal', $business_info->paypal, array('placeholder' =>$fm_data->labels['paypal'],'class'=>'form-control')) !!}
                <br>
                <small>Please add here your company PayPal address for the payment from other users)</small>
                </div>    
            @endif
        </div>-->
        
        <div class="row">
            <div class="col-sm-12">
                {!! Form::label('policy_doc','Accept Return Policy:',array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12"))!!}
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <span class="btn btn-primary btn-file m-r-10">
                        <span class="fileinput-new">Select policy document</span>
                        <span class="fileinput-exists">Change</span>
                        {!! Form::file('policy_doc') !!}
                    </span>
                    <span class="fileinput-filename"></span>
                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput">&times;</a>
                  
                    @if(!empty($business_info->policy_doc))
                          <?php $img = $business_info->doc_path.$business_info->policy_doc;?>
                          <a href="{!!asset($img)!!}">{!!$business_info->policy_doc!!}</a>
                    @elseif(!empty($business_info->policy_doc_data))
                        <br/><br/>
                        <h5>Or</h5>
                        {!! Form::textarea('policy_doc_data', $business_info->policy_doc_data, array('placeholder' =>'Your return policy, maximum 1000 characters', 'maxlength' => '1000', 'class'=>'form-control')) !!}
                    @endif
                 </div>
            </div>
        </div>
        
       <div class="form-group clearfix">
            @if(!empty($fm_data->labels['market']))
                {!! Form::label('market', $fm_data->labels['market'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::select('market', $market, $business_info->market, array('class'=>'form-control')) !!}
                </div>    
            @endif
       </div>
        
        <div class="form-group clearfix">
            {!! Form::label('file','Browse Logo',array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12"))!!}
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                    <div>
                        <span class="btn btn-info btn-file">
                            <span class="fileinput-new">Select Logo</span>
                            <span class="fileinput-exists">Change</span>
                            {!! Form::file('logo',array('id'=>'logo','class'=>'form_control')) !!}
                        </span>
                        <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                </div>    
            </div>
         </div>
    
    
<!--      <div class="form-group clearfix">
            {!! Form::label('file','Browse Image',array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12"))!!}
            <div class="fileinput fileinput-new col-md-5 col-sm-5" data-provides="fileinput">
                <span class="btn btn-primary btn-file m-r-10">
                    <span class="fileinput-new">Select Image</span>
                    <span class="fileinput-exists">Change</span>
                    {!! Form::file('logo',array('id'=>'logo','class'=>'form_control')) !!}
                </span>
                <span class="fileinput-filename"></span>
                <a href="#" class="close fileinput-exists" data-dismiss="fileinput">&times;</a>
            </div>
          </div>-->
        
    
          <div class="form-group clearfix">
            @if(!empty($fm_data->labels['logo']))
                {!! Form::label('logo', $fm_data->labels['logo'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                <div class="col-md-6 col-sm-6 col-xs-12">
<!--               {!! Form::file('logo', null, array('id'=>'logo','class'=>'form-control')) !!}-->
                   @if(!empty($business_info->logo))
                        <?php $img = $business_info->logo_path.$business_info->logo;?>
                        <br/>
                        <img src='{!!asset($img)!!} ' class='' style="width:150px;">
                   @endif
                   <br/>
                   <small>{!!$fm_data->labels['logo_desc']!!}</small>
                </div>    
             @endif
          </div>
       
          <div class="form-group">
            @if (!empty($fm_data->labels['submit']))
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                    {!!HTML::linkRoute('business-info-index', $fm_data->labels['cancel'], array(), array('class'=>"btn btn-round btn-primary"))!!}
                    <button id="send" type="submit" class="btn btn-round btn-success">{!!$fm_data->labels['save']!!}</button>
                </div>
            @endif
          </div>
        @endif
      {!! Form::close() !!}
      </div>
   </div>
@endsection

@section('footer_add_js_files') 
        <script src="{{ asset('/m-admin-ui/vendors/fileinput/fileinput.min.js') }}"></script>
        <script src="{{ asset('/m-admin-ui/vendors/input-mask/input-mask.min.js') }}"></script>
        <script src="{{ asset('/js/jquery.tagsinput.js') }}"></script>
@endsection       
@section('footer_add_js_script')
<script type="text/javascript">
$(document).ready(function(){
//      document.getElementById("company_image").required = true;
//      document.getElementById("logo").required = true;
});
</script>
@endsection
