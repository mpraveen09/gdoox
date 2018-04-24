@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <!--<h2>{!! $fm_data->labels['title'] !!}</h2>-->
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
    @include('navigation_tabs.personal-site-tabs')
    <div class="card">
        <div class="card-header bgm-blue head-title">
          <h2><i class="zmdi zmdi-account m-r-5"></i> {!! $fm_data->labels['form_general_info'] !!}</h2>
        </div><!-- .card-header -->
        <div class="card-body card-padding">  
            
            {!! Form::open([
                  'method' => 'POST',
                  'route' => 'general-info-store',
                  'class' => 'form-label-left',
                  'id'=>'general-info',
                 'files'=>true
              ]) !!}
                    
                  @if(!empty($fm_data->labels['first_name']))
                    <div class="form-group clearfix">
                       {!! Form::label('first_name', $fm_data->labels['first_name'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                       <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('first_name','', array('required','placeholder'=>$fm_data->labels['first_name'],'class'=>'form-control')) !!}
                       </div>    
                    </div>
                  @endif
                  
                  @if(!empty($fm_data->labels['second_name']))
                    <div class="form-group clearfix">
                       {!! Form::label('second_name',$fm_data->labels['second_name'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                       <div class="col-md-6 col-sm-6 col-xs-12">
                      {!! Form::text('second_name','', array('placeholder'=>$fm_data->labels['second_name'],'class'=>'form-control')) !!}
                      </div>    
                    </div>
                  @endif
                  
                  @if(!empty($fm_data->labels['surname']))
                    <div class="form-group clearfix">
                       {!! Form::label('surname', $fm_data->labels['surname'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                       <div class="col-md-6 col-sm-6 col-xs-12">
                      {!! Form::text('surname','', array('placeholder'=>$fm_data->labels['surname'],'class'=>'form-control')) !!}
                      </div>    
                    </div>
                  @endif
                  
                  @if(!empty($fm_data->labels['initials']))
                    <div class="form-group clearfix">
                       {!! Form::label('initials', $fm_data->labels['initials'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                       <div class="col-md-6 col-sm-6 col-xs-12">
                      {!! Form::text('initials','', array('placeholder'=>$fm_data->labels['initials'],'class'=>'form-control')) !!}
                      </div>    
                    </div>
                  @endif
                  
                  @if(!empty($fm_data->labels['dob']))
                    <div class="form-group clearfix">
                       {!! Form::label('dob', $fm_data->labels['dob'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                       <div class="col-md-6 col-sm-6 col-xs-12">
                      {!! Form::date('dob','', array('placeholder'=>$fm_data->labels['dob'],'class'=>'form-control')) !!}
                      </div>    
                    </div>
                  @endif
                  
                  @if(!empty($fm_data->labels['gender']))
                    <div class="form-group clearfix">
                       {!! Form::label('gender', $fm_data->labels['gender'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                       <div class="radio col-md-6 col-sm-6 col-xs-12">
                            <label>
                                {!! Form::radio('gender', 1, false)!!}
                                 <i class="input-helper"></i>
                                 {!! $fm_data->labels['male'] !!}
                             </label>
                            <label>
                                {!! Form::radio('gender', 0, true)!!}
                                 <i class="input-helper"></i>
                                 {!! $fm_data->labels['female'] !!}
                            </label>
                      </div>    
                    </div>
                  @endif
                  
                  @if(!empty($fm_data->labels['street_add']))
                    <div class="form-group clearfix">
                       {!! Form::label('street_add', $fm_data->labels['street_add'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                       <div class="col-md-6 col-sm-6 col-xs-12">
                       {!! Form::text('street_add','', array('placeholder'=>$fm_data->labels['street_add'],'class'=>'form-control')) !!}
                      </div>    
                    </div>
                  @endif
                  
                   @if(!empty($fm_data->labels['city']))
                    <div class="form-group clearfix">
                       {!! Form::label('city', $fm_data->labels['city'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                       <div class="col-md-6 col-sm-6 col-xs-12">
                       {!! Form::text('city','', array('placeholder'=>$fm_data->labels['city'],'class'=>'form-control')) !!}
                      </div>    
                    </div>
                  @endif
                  
                  @if(!empty($fm_data->labels['country']))
                    <div class="form-group clearfix">
                       {!! Form::label('country', $fm_data->labels['country'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                       <div class="col-md-6 col-sm-6 col-xs-12">
                       {!! Form::select('country', $country,'', array('required', 'class'=>'form-control')) !!}
                       </div>    
                    </div>
                  @endif
                  
                  @if(!empty($fm_data->labels['country_area']))
                    <div class="form-group clearfix">
                       {!! Form::label('country_area', $fm_data->labels['country_area'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                       <div class="col-md-6 col-sm-6 col-xs-12">
                       {!! Form::text('country_area','', array('placeholder'=>$fm_data->labels['country_area'],'class'=>'form-control')) !!}
                      </div>    
                    </div>
                  @endif
                  
                  @if(!empty($fm_data->labels['private_ph_no']))
                    <div class="form-group clearfix">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            {!! Form::label('private_ph_no', $fm_data->labels['private_ph_no'].' *', array('class'=>'control-label')) !!} <br /> 
                            {!! $fm_data->labels['message'] !!}
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('private_ph_no','', array('required','placeholder'=>$fm_data->labels['private_ph_no'],'class'=>'form-control')) !!}
                        </div>
                    </div>
                  @endif
                  
                  @if(!empty($fm_data->labels['private_mob_no']))
                    <div class="form-group clearfix">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            {!! Form::label('private_mob_no', $fm_data->labels['private_mob_no'].' *', array('class'=>'control-label')) !!} <br />
                            {!! $fm_data->labels['message'] !!}
                        </div> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('private_mob_no','', array('required','placeholder'=>$fm_data->labels['private_mob_no'],'class'=>'form-control')) !!}
                        </div>    
                    </div>
                  @endif
                  
                  @if(!empty($fm_data->labels['business_ph_no']))
                    <div class="form-group clearfix">
                            {!! Form::label('business_ph_no', $fm_data->labels['business_ph_no'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                            <div class="col-md-6 col-sm-6">
                                {!! Form::text('business_ph_no','', array('placeholder'=>$fm_data->labels['business_ph_no'],'class'=>'form-control')) !!}
                            </div>
                            <div class="radio col-md-3 col-sm-3">
                                <label>
                                    {!! Form::radio('status_business_ph', 1, false)!!}
                                     <i class="input-helper"></i>
                                     Show
                                 </label>
                                <label>
                                    {!! Form::radio('status_business_ph', 0, true)!!}
                                     <i class="input-helper"></i>
                                     Hide
                                </label>
                            </div>
                    </div>
                  @endif
                  
                  @if(!empty($fm_data->labels['business_mob_no']))
                    <div class="form-group clearfix">
                       {!! Form::label('business_mob_no', $fm_data->labels['business_mob_no'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                       <div class="col-md-6 col-sm-6">
                       {!! Form::text('business_mob_no','', array('placeholder'=>$fm_data->labels['business_mob_no'],'class'=>'form-control')) !!}
                      </div>
                       <div class="radio col-md-3 col-sm-3">
                            <label>
                                {!! Form::radio('status_business_mob', 1, false)!!}
                                 <i class="input-helper"></i>
                                 Show
                            </label>
                            <label>
                                {!! Form::radio('status_business_mob', 0, true)!!}
                                 <i class="input-helper"></i>
                                 Hide
                            </label>
                        </div>
                    </div>
                  @endif

                  
                  @if(!empty($fm_data->labels['skype']))
                    <div class="form-group clearfix">
                       {!! Form::label('skype', $fm_data->labels['skype'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                       <div class="col-md-6 col-sm-6">
                            {!! Form::text('skype','', array('placeholder'=>$fm_data->labels['skype'],'class'=>'form-control')) !!}
                       </div>
                       <div class="radio col-md-3 col-sm-3">
                            <label>
                               {!! Form::radio('status_skype', 1, false)!!}
                                <i class="input-helper"></i>
                                Show
                            </label>
                            <label>
                                {!! Form::radio('status_skype', 0, true)!!}
                                 <i class="input-helper"></i>
                                 Hide
                            </label>
                        </div>
                    </div>
                  @endif
                  
                  @if(!empty($fm_data->labels['msm']))
                    <div class="form-group clearfix">
                       {!! Form::label('msm', $fm_data->labels['msm'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                       <div class="col-md-6 col-sm-6 col-xs-12">
                       {!! Form::text('msm','', array('placeholder'=>$fm_data->labels['msm'],'class'=>'form-control')) !!}
                      </div>    
                    </div>
                  @endif
                  
                  @if(!empty($fm_data->labels['blackberry']))
                    <div class="form-group clearfix">
                       {!! Form::label('blackberry', $fm_data->labels['blackberry'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                       <div class="col-md-6 col-sm-6 col-xs-12">
                       {!! Form::text('blackberry','', array('placeholder'=>$fm_data->labels['blackberry'],'class'=>'form-control')) !!}
                      </div>    
                    </div>
                  @endif
                  
                  @if(!empty($fm_data->labels['fiscal_id']))
                    <div class="form-group clearfix">
                       {!! Form::label('fiscal_id', $fm_data->labels['fiscal_id'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                       <div class="col-md-6 col-sm-6 col-xs-12">
                       {!! Form::text('fiscal_id','', array('placeholder'=>$fm_data->labels['fiscal_id'],'class'=>'form-control')) !!}
                      </div>    
                    </div>
                  @endif
                  
                  @if(!empty($fm_data->labels['personal_email']))
                    <div class="form-group clearfix">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            {!! Form::label('personal_email', $fm_data->labels['personal_email'], array('class'=>'control-label')) !!} <br /> 
                            {!! $fm_data->labels['message'] !!}
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('personal_email','', array('required','placeholder'=>$fm_data->labels['personal_email'],'class'=>'form-control')) !!}
                        </div>    
                    </div>
                  @endif
                  
                  @if(!empty($fm_data->labels['business_email']))
                    <div class="form-group clearfix">
                        {!! Form::label('business_email', $fm_data->labels['business_email'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('business_email','', array('placeholder'=>$fm_data->labels['business_email'],'class'=>'form-control')) !!}
                        </div>    
                    </div>
                  @endif
                  
                  @if(!empty($fm_data->labels['paypal_account']))
                    <div class="form-group clearfix">
                        {!! Form::label('paypal_account', $fm_data->labels['paypal_account'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('paypal_account','', array('placeholder'=>$fm_data->labels['paypal_account'],'class'=>'form-control')) !!}
                        </div>    
                    </div>
                  @endif
                  
                  @if(!empty($fm_data->labels['your_market']))
                    <div class="form-group clearfix">
                        {!! Form::label('your_market', $fm_data->labels['your_market'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::select('your_market', $market,'', array('placeholder'=>$fm_data->labels['your_market'],'required', 'class'=>'form-control')) !!}
                        </div>    
                    </div>
                  @endif
                  
                  
                  @if(!empty($fm_data->labels['site_logo']))
                    <div class="form-group clearfix">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            {!! Form::label('site_logo', $fm_data->labels['site_logo'], array('class'=>'control-label')) !!} <br /> 
                            {!! $fm_data->labels['logo_desc'] !!}
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                                <div>
                                    <span class="btn btn-info btn-file waves-effect">
                                        <span class="fileinput-new">Select image</span>
                                        <span class="fileinput-exists">Change</span>
                                        {!! Form::file('site_logo','', array('required','placeholder'=>$fm_data->labels['site_logo'],'class'=>'form-control')) !!}
                                    </span>
                                    <a href="#" class="btn btn-danger fileinput-exists waves-effect" data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                            <br>
                            <small><i>Image (uploaded from PC)</i></small>
                        </div>     
                    </div>
                  @endif

                  
                  <br >
                  <br >
                  @if (!empty($fm_data->labels['submit']))
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                             <button id="send" type="submit" class="btn btn-round btn-success">{!!$fm_data->labels['save']!!}</button>
                        </div>
                    </div>
                  @endif
            {!! Form::close() !!}
        </div>
    </div>    
    
@endsection
@section('footer_add_js_script')

<script type="text/javascript">
$(document).ready(function(){
    });
</script>
@endsection

