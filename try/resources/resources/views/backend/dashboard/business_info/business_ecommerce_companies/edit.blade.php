@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>  {!!$fm_data->labels['form_title']!!}</h2>-->
<!--<div class="page-top-links">-->
<!--</div>-->
@endsection

@section('right_col_title_right')
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
   
    <div class="card">
        <div class="card-header bgm-blue head-title">
          <h2>{!!$fm_data->labels['heading']." ".$fm_data->labels['create']!!}</h2>
          <a href="{!! route('ecomm-create') !!}" class="btn btn-round btn-default">Create New</a>
          <a href="{!! route('ecomm-index')  !!}" class="btn btn-round btn-default">View All</a>
        </div><!-- .card-header -->
        <div class="card-body card-padding">    
          {!! Form::model($ecompany, [
          'method'=>'PUT', 
          'route' =>['ecomm-update', $ecompany->id], 
          'class'=>'form-horizontal form-label-left',
          'files'=>true]) !!}

              {!!Form::hidden('user_id', Auth::user()->id)!!}

              @if (!empty($fm_data->labels))

                  <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['ecomm_company_name']))
                           {!! Form::label('ecomm_company_name', $fm_data->labels['ecomm_company_name'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::text('ecomm_company_name', $ecompany->ecomm_company_name, array('required','placeholder' =>$fm_data->labels['ecomm_company_name'],'class'=>'form-control','id'=>'estore_title')) !!}
                          </div>    
                      @endif
                  </div>

                  <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['slug']))
                           {!! Form::label('slug', $fm_data->labels['slug'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::text('slug', $ecompany->slug, array('readonly','disabled','placeholder' =>$fm_data->labels['slug'],'class'=>'form-control', 'id'=>'estore_slug')) !!}
                          </div>    
                      @endif
                  </div>
                 
              <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['email']))
                           {!! Form::label('email', $fm_data->labels['email'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::email('email', $ecompany->email, array('required','placeholder' =>$fm_data->labels['email'],'class'=>'form-control')) !!}
                          </div>    
                      @endif
              </div>
              
              <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['company']))
                           {!! Form::label('company', $fm_data->labels['company'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                            <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::select('company',$ecom, $ecompany->company, array('required','placeholder' =>'---', 'class'=>'form-control')) !!}
                          </div>    
                      @endif
                  </div>
              
              
              <div class="form-group clearfix">
                    {!! Form::label('business_desc_tags', "Business Description Tags".$required, array('id' => '', 'class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                     <div class="col-md-6 col-sm-6 col-xs-12">
                      {!! Form::text('business_desc_tags', $ecompany->business_desc_tags, array('required', 'id' => "tags_1", 'class'=>'form-control tags')) !!}
                   </div>    
               </div>
             
              <div class="form-group clearfix">
                    {!! Form::label('brands', "Brands You Deal".$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                     <div class="col-md-6 col-sm-6 col-xs-12">
                      {!! Form::text('brands', $ecompany->brands, array('required', 'id' => "tags_2", 'class'=>'form-control tags')) !!}
                   </div>    
               </div>
    
                <div class="row">
                    <div class="col-sm-12">
                        {!! Form::label('policy_doc','Return Policy Document',array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12"))!!}
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <span class="btn btn-primary btn-file m-r-10">
                                <span class="fileinput-new">Select file</span>
                                <span class="fileinput-exists">Change</span>
                                {!! Form::file('policy_doc') !!}
                            </span>
                            <span class="fileinput-filename"></span>
                            <a href="#" class="close fileinput-exists" data-dismiss="fileinput">&times;</a>
                            @if(!empty($ecompany->policy_doc))
                                  <?php $img = $ecompany->doc_path.$ecompany->policy_doc;?>
                                  <br/>
                                  <a href="{!!$img!!}">{!!$ecompany->policy_doc!!}</a>
                             @elseif(!empty($ecompany->policy_doc_data)) 
                                <br/>
                                <br/>
                                <h5>Or</h5>
                                {!! Form::textarea('policy_doc_data', null, array('placeholder' =>'Your return policy, maximum 1000 characters', 'class'=>'form-control')) !!}
                             @endif
                        </div>
                    </div>
                </div>
              <div class="form-group clearfix">
                    {!! Form::label('market', "Your Market", array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                     <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::select('market[]', $market, $ecompany->market, array( 'multiple', 'class'=>'form-control selectpicker')) !!}
                   </div>    
               </div>
              
                  <div class="form-group">
                      @if (!empty($fm_data->labels['submit']))
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                              {!!HTML::linkRoute('ecomm-index', $fm_data->labels['cancel'], array(), array('class'=>"btn btn-round btn-primary"))!!}
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
  @if(empty($ecompany->slug))
    $("#estore_title").keyup(function(){
            var Text = $(this).val();
            Text = Text.toLowerCase();
            Text = Text.replace(/\s/g, '');
              $("#estore_slug").val(Text);
      });  
    @endif
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
