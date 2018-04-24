@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>{!!$fm_data->labels['form_title']!!}</h2>-->
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
   
    <div class="card">
        <div class="card-header bgm-blue head-title">
          <h2>{!!$fm_data->labels['create']!!}</h2>
        </div><!-- .card-header -->
        <div class="card-body card-padding">    
          {!! Form::open(array('action' => 'backend\dashboard\account_profile\AccountProfilesController@update',  'method' => 'GET', 'class'=>'form-horizontal form-label-left')) !!}

              @if (!empty($fm_data->labels))
                   @if(!empty($fm_data->labels['street_add']))
                    <div class="form-group clearfix">
                       {!! Form::label('street_add', $fm_data->labels['street_add'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                       <div class="col-md-6 col-sm-6 col-xs-12">
                      {!! Form::text('street_add', '', array('required','placeholder' =>$fm_data->labels['street_add'],'class'=>'form-control')) !!}
                      </div>    
                    </div>
                  @endif

                  @if(!empty($fm_data->labels['city']))
                      <div class="form-group clearfix">
                          {!! Form::label('city', $fm_data->labels['city'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::text('city','', array('required','placeholder' =>$fm_data->labels['city'],'class'=>'form-control')) !!}
                          </div>    
                      </div>
                  @endif

                  @if(!empty($fm_data->labels['country']))
                        <div class="form-group clearfix">
                           {!! Form::label('country', $fm_data->labels['country'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                            <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::select('country', $country, null, array('required', 'class'=>'form-control')) !!}
                            </div>   
                        </div>
                  @endif

                  @if(!empty($fm_data->labels['zip']))
                      <div class="form-group clearfix">
                           {!! Form::label('zip', $fm_data->labels['zip'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                            <div class="col-md-6 col-sm-6 col-xs-12">
                           {!! Form::text('zip', '', array('required','placeholder' =>$fm_data->labels['zip'],'class'=>'form-control')) !!}
                      </div>   
                    </div>
                  @endif

                  @if(!empty($fm_data->labels['phone_no1']))
                      <div class="form-group clearfix">
                        {!! Form::label('phone_no1', $fm_data->labels['phone_no1'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('phone_no1', '', array('required','placeholder' =>$fm_data->labels['phone_no1'],'class'=>'form-control')) !!}
                        </div> 
                     </div>
                  @endif

                  @if(!empty($fm_data->labels['phone_no2']))
                      <div class="form-group clearfix">
                          {!! Form::label('phone_no2', $fm_data->labels['phone_no2'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                          <div class="col-md-6 col-sm-6 col-xs-12">
                         {!! Form::text('phone_no2', '', array('placeholder' =>$fm_data->labels['phone_no2'],'class'=>'form-control')) !!}
                         </div>   
                      </div>
                  @endif

                  @if(!empty($fm_data->labels['fax_no']))
                    <div class="form-group clearfix">
                       {!! Form::label('fax_no', $fm_data->labels['phone_no2'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                       <div class="col-md-6 col-sm-6 col-xs-12">
                      {!! Form::text('fax_no', '', array('placeholder' =>$fm_data->labels['fax_no'],'class'=>'form-control')) !!}
                      </div>  
                   </div>
                  @endif

                  @if(!empty($fm_data->labels['mobile']))
                    <div class="form-group clearfix">
                        {!! Form::label('mobile', $fm_data->labels['mobile'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                       <div class="col-md-6 col-sm-6 col-xs-12">
                       {!! Form::text('mobile', '', array('placeholder' =>$fm_data->labels['mobile'],'class'=>'form-control')) !!}
                       </div>    
                     </div>
                  @endif

                  @if(!empty($fm_data->labels['skype']))
                      <div class="form-group clearfix">
                        {!! Form::label('skype', $fm_data->labels['skype'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('skype', '', array('placeholder' =>$fm_data->labels['skype'],'class'=>'form-control')) !!}
                        </div>   
                    </div>
                  @endif

                  @if(!empty($fm_data->labels['business_email1']))
                      <div class="form-group clearfix">
                          {!! Form::label('business_email1', $fm_data->labels['business_email1'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                          <div class="col-md-6 col-sm-6 col-xs-12">
                         {!! Form::email('business_email1', '', array('required', 'placeholder' =>$fm_data->labels['business_email1'],'class'=>'form-control')) !!}
                          </div>    
                    </div>
                  @endif

                  @if(!empty($fm_data->labels['business_email2']))
                    <div class="form-group clearfix">
                       {!! Form::label('business_email2', $fm_data->labels['business_email2'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                       <div class="col-md-6 col-sm-6 col-xs-12">
                       {!! Form::email('business_email2', '', array( 'placeholder' =>$fm_data->labels['business_email1'],'class'=>'form-control')) !!}
                       </div>    
                   </div>
                  @endif
                  @if(!empty($fm_data->labels['position']))
                   <div class="form-group clearfix">
                           {!! Form::label('position', $fm_data->labels['position'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          @foreach($position as $pos)
                              {!! Form::checkbox('position[]', $pos, null,['class' => 'position'])!!}
                              {!! Form::label($pos, $pos)!!}<br/>
                          @endforeach
                          <input id='other-text' name="position[]" placeholder='please enter other position' type='text'/>                        
                        </div>   
                     </div>
                  @endif
                  
                  @if(!empty($fm_data->labels['language']))
                       <div class="form-group clearfix">
                           {!! Form::label('language', $fm_data->labels['language'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                            <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::select('language', $language, null, array('required', 'class'=>'form-control')) !!}
                            </div>   
                        </div>
                  @endif
               
                  @if (!empty($fm_data->labels['submit']))
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                             <button id="send" type="submit" class="btn btn-round btn-success">{!!$fm_data->labels['save']!!}</button>
                        </div>
                    </div>
                  @endif
             @endif
            {!! Form::close() !!}
        </div>
    </div>    
@endsection
@section('footer_add_js_script')
<script>
        $("#other-text").hide();
$(".position").change(function () {
    //check if its checked. If checked move inside and check for others value
//    alert(this.checked && this.value);
    if (this.checked && this.value === "Other Position") {
        //show a text box
        $("#other-text").show();
    } 
    else if (!this.checked && this.value === "Other Position"){
        //hide the text box
        $("#other-text").hide();
    }
});
</script>
@endsection

