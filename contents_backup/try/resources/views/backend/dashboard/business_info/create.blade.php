@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>{!!$fm_data->labels['form_title']!!}</h2>-->
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
            <h2>{!!$fm_data->labels['create']!!}</h2>
            <a href="{!! route('business-info-create')  !!}" class="btn btn-default">Create New</a>
            <a href="{!! route('ecomm-index')  !!}" class="btn btn-default">View All</a>
        </div><!-- .card-header -->
        <div class="card-body card-padding">    
          {!! Form::open(array('route' => 'business-info-store','method'=>'POST ', 'class'=>'form-horizontal form-label-left', 'files'=>true)) !!}

              {!!Form::hidden('user_id', Auth::user()->id)!!}

              @if (!empty($fm_data->labels))
                  <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['company_name']))
                           {!! Form::label('company_name', $fm_data->labels['company_name'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::text('company_name', null, array('required','placeholder' =>$fm_data->labels['company_name'],'class'=>'form-control')) !!}
                          </div>    
                      @endif
                  </div>
                  <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['street_add']))
                           {!! Form::label('street_add', $fm_data->labels['street_add'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                           <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::text('street_add', null, array('placeholder' =>$fm_data->labels['street_add'],'class'=>'form-control')) !!}
                          </div>    
                      @endif
                  </div>

                  <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['city']))
                           {!! Form::label('city', $fm_data->labels['city'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::text('city', null, array('required','placeholder' =>$fm_data->labels['city'],'class'=>'form-control')) !!}
                          </div>    
                      @endif
                  </div>

                  <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['country']))
                           {!! Form::label('country', $fm_data->labels['country'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::select('country', $country, null, array('required', 'placeholder' =>'--Select--', 'class'=>'form-control')) !!}
                          </div>    
                      @endif
                  </div>
                  <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['zip']))
                           {!! Form::label('zip', $fm_data->labels['zip'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::text('zip', null, array('required','placeholder' =>$fm_data->labels['zip'],'class'=>'form-control')) !!}
                          </div>    
                      @endif
                  </div>
                  <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['phone_no1']))
                           {!! Form::label('phone_no1', $fm_data->labels['phone_no1'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::text('phone_no1', null, array('required','placeholder' =>$fm_data->labels['phone_no1'],'class'=>'form-control')) !!}
                          </div>    
                      @endif
                  </div>
                  <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['phone_no2']))
                           {!! Form::label('phone_no2', $fm_data->labels['phone_no2'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::text('phone_no2', null, array('placeholder' =>$fm_data->labels['phone_no2'],'class'=>'form-control')) !!}
                          </div>    
                      @endif
                  </div>
                 <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['fax_no']))
                           {!! Form::label('fax_no', $fm_data->labels['phone_no2'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::text('fax_no', null, array('placeholder' =>$fm_data->labels['fax_no'],'class'=>'form-control')) !!}
                          </div>    
                      @endif
                  </div>
                 <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['mobile']))
                           {!! Form::label('mobile', $fm_data->labels['mobile'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::text('mobile', null, array('placeholder' =>$fm_data->labels['mobile'],'class'=>'form-control')) !!}
                          </div>    
                      @endif
                  </div>
                 <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['skype']))
                           {!! Form::label('skype', $fm_data->labels['skype'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::text('skype', null, array('placeholder' =>$fm_data->labels['skype'],'class'=>'form-control')) !!}
                          </div>    
                      @endif
                  </div>
                 <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['business_email1']))
                           {!! Form::label('business_email1', $fm_data->labels['business_email1'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::email('business_email1', null, array('required', 'placeholder' =>$fm_data->labels['business_email1'],'class'=>'form-control')) !!}
                          </div>    
                      @endif
                  </div>
                  <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['business_email2']))
                           {!! Form::label('business_email2', $fm_data->labels['business_email2'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::email('business_email2', null, array( 'placeholder' =>$fm_data->labels['business_email1'],'class'=>'form-control')) !!}
                          </div>    
                      @endif
                  </div>
                 <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['desc']))
                           {!! Form::label('desc', $fm_data->labels['desc'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::textarea('desc', null, array('size' => '30x4  ', 'placeholder' =>$fm_data->labels['desc'],'class'=>'form-control')) !!}
                          </div>    
                      @endif
                 </div>
                <div class="form-group clearfix">
                      {!! Form::label('business_desc_tags', "Business Description Tags".$required, array('id' => '', 'class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                       <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('business_desc_tags', null, array('required', 'id' => "tags_1", 'class'=>'form-control tags')) !!}
                     </div>
                 </div>
              
                  <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['org_type']))
                           {!! Form::label('org_type', $fm_data->labels['org_type'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::select('org_type[]', $organization, null, array('required', 'multiple',  'placeholder' =>'--Select--', 'class'=>'form-control')) !!}
                          </div>    
                      @endif
                  </div>
                 <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['actvity_type']))
                           {!! Form::label('actvity_type', $fm_data->labels['actvity_type'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::select('actvity_type', $activity, null, array('required', 'placeholder' =>'--Select--', 'class'=>'form-control')) !!}
                          </div>    
                      @endif
                  </div>
                 <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['operation']))
                           {!! Form::label('operation', $fm_data->labels['operation'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::select('operation', $business_opt, null, array('required', 'placeholder' =>'--Select--','class'=>'form-control')) !!}
                          </div>    
                      @endif
                  </div>
              <div class="form-group clearfix">
                    {!! Form::label('brands', "Brands You Deal".$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                     <div class="col-md-6 col-sm-6 col-xs-12">
                      {!! Form::text('brands', null, array('required', 'id' => "tags_2", 'class'=>'form-control tags')) !!}
                   </div>    
               </div>
<!--              <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['payment_form']))
                           {!! Form::label('payment_form', $fm_data->labels['payment_form'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::select('payment_form[]', $accept_payment, null, array('required', 'multiple', 'placeholder' =>'--Select--', 'class'=>'form-control')) !!} 
                          </div>    
                      @endif
                  </div>-->

<!--                 <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['credit_card']))
                           {!! Form::label('credit_card', $fm_data->labels['credit_card'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                         <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::select('credit_card[]', $credit_card, null, array('placeholder' =>'--Select--', 'multiple', 'class'=>'form-control')) !!}
                            <br>
                           <small>(Please specify the types of credit card you accept for the payment from other users)</small> 
                         </div>
                      @endif
                  </div>-->

<!--                <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['paypal']))
                           {!! Form::label('paypal', $fm_data->labels['paypal'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::text('paypal', null, array('placeholder' =>$fm_data->labels['paypal'],'class'=>'form-control')) !!}
                          </div>    
                      @endif
                  </div>-->

                <div class="row">
                    <div class="col-sm-12">
                        {!! Form::label('policy_doc','Return Policy Document',array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12"))!!}
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <span class="btn btn-primary btn-file m-r-10">
                                <span class="fileinput-new">Select policy document</span>
                                <span class="fileinput-exists">Change</span>
                                {!! Form::file('policy_doc') !!}
                            </span>
                            <span class="fileinput-filename"></span>
                            <a href="#" class="close fileinput-exists" data-dismiss="fileinput">&times;</a>
                            <br/><br/>
                            <h5>Or</h5>
                          {!! Form::textarea('policy_doc_data', null, array('placeholder' =>'Your return policy, maximum 1000 characters', 'class'=>'form-control')) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['market']))
                           {!! Form::label('market', $fm_data->labels['market'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::select('market', $market, null, array('placeholder' =>'--Select--', 'class'=>'form-control')) !!}
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
              
                <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['logo']))
                           {!! Form::label('logo', $fm_data->labels['logo'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                          <div class="col-md-6 col-sm-6 col-xs-12">
<!--                          {!! Form::file('logo', null, array('id'=>'company_logo','class'=>'form-control')) !!}-->
                          <small>{!!$fm_data->labels['logo_desc']!!}</small>
                          </div>    
                      @endif
                 </div>
                  <div class="form-group">
                      @if (!empty($fm_data->labels['submit']))
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                              <!--{!! Form::submit($fm_data->labels['save'], array('class'=>'btn btn-primary btn-success','id'=>"send")) !!}-->
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
          document.getElementById("company_image").required = true;
          document.getElementById("company_logo").required = true;
    });
  </script>
  <script type="text/javascript">

		function onAddTag(tag) {
			alert("Added a tag: " + tag);
		}
		function onRemoveTag(tag) {
			alert("Removed a tag: " + tag);
		}

		function onChangeTag(input,tag) {
			alert("Changed a tag: " + tag);
		}
		$(function() {
			$('#tags_1').tagsInput({width:'auto'});
			$('#tags_2').tagsInput({
				width: 'auto',
				onChange: function(elem, elem_tags)
				{
					var languages = [];
					$('.tag', elem_tags).each(function()
					{
						if($(this).text().search(new RegExp('\\b(' + languages.join('|') + ')\\b')) >= 0)
							$(this).css('background-color', 'yellow');
					});
				}
			});
//			$('#tags_3').tagsInput({
//				width: 'auto',
//				//autocomplete_url:'test/fake_plaintext_endpoint.html' //jquery.autocomplete (not jquery ui)
//				autocomplete_url:'test/fake_json_endpoint.html' // jquery ui autocomplete requires a json endpoint
//			});
		});
	</script>

@endsection