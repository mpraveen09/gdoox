@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>Distribution Network</h2>-->
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
            <h2>{!! $networks->type !!}</h2>
            <a href="{!! route('dashboard-index')  !!}" type="submit" class="btn btn-default"><i class='zmdi zmdi-home'></i>Home</a>
            <button onclick="goBack()" class="btn btn-default waves-effect">Back</button>
        </div><!-- .card-header -->
        

        <div class="card-body card-padding">    
            <div role="tabpanel" class="tab-pane active" id="sales">

                      {!! Form::model($networks, [
                          'method' => 'PUT',
                          'route' => ['distributionnetwork.update', $networks->_id],
                          'class' => 'form-horizontal form-label-left',
                          'novalidate'=>''
                      ]) !!}

                      {!! Form::hidden('type',$networks->type , array('id'=>$networks->type)) !!}

                      @if (!empty($fm_data->labels))
                            
                             @if($networks->type_id==='seller_network')
                                <div class="form-group clearfix">
                                    @if(!empty($fm_data->labels['company_name']))
                                         {!! Form::label('company_name', $fm_data->labels['company_name'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        {!! Form::text('company_name',$networks->company_name, array('required','placeholder' =>$fm_data->labels['company_name'],'class'=>'form-control')) !!}
                                        </div>    
                                    @endif
                                </div>
                             @endif
                      
                            <div class="form-group clearfix">
                                @if(!empty($fm_data->labels['first_name']))
                                     {!! Form::label('first_name', $fm_data->labels['first_name'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('first_name', $networks->first_name, array('required','placeholder' =>$fm_data->labels['first_name'],'class'=>'form-control')) !!}
                                    </div>    
                                @endif
                            </div>

                            <div class="form-group clearfix">
                                @if(!empty($fm_data->labels['last_name']))
                                     {!! Form::label('last_name', $fm_data->labels['last_name'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                @endif

                                @if (!empty($fm_data->labels['last_name']))
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('last_name',$networks->last_name,array('required','placeholder' =>$fm_data->labels['last_name'],'class'=>'form-control')) !!}
                                    </div>    
                                @endif
                            </div>
                            
                            @if($networks->type_id==='individual_sales_representative')
                            <div class="form-group clearfix">
                                  <div class="radio">
                                    {!! Form::label('gender','Gender',array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12"))!!}
                                        <div class="thumb col-md-5 col-sm-5">
                                            <label>
                                                @if($networks->gender==='male')
                                                    {!! Form::radio('gender', 'male', true)!!}
                                                    <i class="input-helper"></i>
                                                    Male
                                                @else
                                                {!! Form::radio('gender', 'male', false)!!}
                                                    <i class="input-helper"></i>
                                                    Male
                                                @endif
                                            </label>
                                            <label>
                                                @if($networks->gender==='female')
                                                    {!! Form::radio('female', 'female', true)!!}
                                                    <i class="input-helper"></i>
                                                    Female
                                                @else
                                                {!! Form::radio('gender', 'female', false)!!}
                                                    <i class="input-helper"></i>
                                                    Female
                                                @endif
                                             </label>
                                        </div> 
                                   </div>
                              </div>
                            @endif

                            <div class="form-group clearfix">
                                  @if(!empty($fm_data->labels['country_of_work']))
                                       {!! Form::label('country_of_work', $fm_data->labels['country_of_work'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                  @endif
                                  @if (!empty($fm_data->labels['country_of_work']))
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                      {!! Form::select('country_of_work', $country, $networks->country_of_work, array('required', 'class'=>'form-control')) !!}
                                      </div>    
                                  @endif
                             </div>

                            <div class="form-group clearfix">
                                @if(!empty($fm_data->labels['country_of_living']))
                                     {!! Form::label('country_of_living', $fm_data->labels['country_of_living'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                @endif

                                @if (!empty($fm_data->labels['country_of_living']))
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::select('country_of_living', $country, $networks->country_of_living, array('required', 'class'=>'form-control')) !!}
                                    </div>    
                                @endif
                            </div>

                            <div class="form-group clearfix">
                                @if(!empty($fm_data->labels['region']))
                                     {!! Form::label('region', $fm_data->labels['region'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                @endif

                                @if (!empty($fm_data->labels['region']))
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('region',$networks->region,array('required','placeholder' =>$fm_data->labels['region'],'class'=>'form-control')) !!}
                                    </div>    
                                @endif
                            </div>

                            <div class="form-group clearfix">
                                @if(!empty($fm_data->labels['business_email']))
                                     {!! Form::label('business_email', $fm_data->labels['business_email'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                @endif

                                @if (!empty($fm_data->labels['business_email']))
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::email('business_email',$networks->business_email,array('required','placeholder' =>$fm_data->labels['business_email'],'class'=>'form-control')) !!}
                                    </div>    
                                @endif
                            </div>

                            <div class="form-group clearfix">
                                @if(!empty($fm_data->labels['business_phone']))
                                     {!! Form::label('business_phone', $fm_data->labels['business_phone'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                @endif

                                @if (!empty($fm_data->labels['business_phone']))
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('business_phone',$networks->business_phone,array('required','placeholder' =>$fm_data->labels['business_phone'],'class'=>'form-control')) !!}
                                    </div>    
                                @endif
                            </div>

                            <div class="form-group clearfix">
                                @if(!empty($fm_data->labels['business_mob']))
                                     {!! Form::label('business_mob', $fm_data->labels['business_mob'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                @endif

                                @if (!empty($fm_data->labels['business_mob']))
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('business_mob',$networks->business_mob,array('placeholder' =>$fm_data->labels['business_mob'],'class'=>'form-control')) !!}
                                    </div>    
                                @endif
                            </div>

                            <div class="form-group clearfix">
                                @if(!empty($fm_data->labels['skype_account']))
                                     {!! Form::label('skype_account', $fm_data->labels['skype_account'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                @endif

                                @if (!empty($fm_data->labels['skype_account']))
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('skype_account',$networks->skype_account,array('required','placeholder' =>$fm_data->labels['skype_account'],'class'=>'form-control')) !!}
                                    </div>    
                                @endif
                            </div>
                            
                            @if($networks->type_id==='individual_sales_representative')
                            <div class="form-group clearfix">
                                @if(!empty($fm_data->labels['age']))
                                     {!! Form::label('age', $fm_data->labels['age'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                @endif

                                @if (!empty($fm_data->labels['age']))
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('age',$networks->age,array('placeholder' =>$fm_data->labels['age'],'class'=>'form-control')) !!}
                                    </div>    
                                @endif
                            </div>
                            @endif
                            
                            @if($networks->type_id==='individual_sales_representative')
                                <div class="form-group clearfix">
                                 @if(!empty($fm_data->labels['vat']))
                                 {!! Form::label('vat', $fm_data->labels['vat'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                                 @endif

                                 @if (!empty($fm_data->labels['vat']))
                                     <div class="col-md-6 col-sm-6 col-xs-12">
                                     {!! Form::text('vat',$networks->vat,array('placeholder' =>$fm_data->labels['vat'],'class'=>'form-control')) !!}
                                     </div>    
                                 @endif
                                </div>
                            @endif
                            @if(!empty($networks->market_area))
                             <div class="form-group clearfix">
                               {!! Form::label('market_area', 'Your market area', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                   {!! Form::text('market_area', $networks->market_area, array('placeholder' =>'Your market area', 'id' => "tags_1", 'class'=>'form-control')) !!}
                                   </div>    
                            </div>
                            @endif
                            @if(!empty($networks->business_area))
                             <div class="form-group clearfix">
                               {!! Form::label('business_area', 'Your market area', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                   {!! Form::select('business_area', ['Local', 'Regional', 'National', 'International'], $networks->business_area, array('placeholder' =>'-select-', 'class'=>'form-control')) !!}
                                   </div>    
                            </div>
                            @endif
                            @if(!empty($networks->your_business))
                             <div class="form-group clearfix">
                               {!! Form::label('your_business', 'Please describe your business', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                   {!! Form::textarea('your_business', $networks->your_business, array('placeholder' =>'Please describe your business(200 characters)', 'class'=>'form-control')) !!}
                                   </div>    
                            </div>
                            @endif
                            @if(!empty($networks->discover_platform))
                             <div class="form-group clearfix">
                               {!! Form::label('discover_platform', 'How did you discover Gdoox platform', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                   {!! Form::select('discover_platform', ['Invitation', 'Internet Engine', 'Linkedin', 'Facebook', 'Pinterest', 'Other Social Media'], $networks->discover_platform, array('placeholder' =>'-select-', 'class'=>'form-control')) !!}
                                   </div>    
                            </div>
                            @endif
                            <div class="form-group clearfix">
                                  @if(!empty($tc))
                                       <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                      {!! Form::checkbox('t_n_c_1', null, null, array('required','class'=>'field')) !!}
                                       {!! $tc->desc!!}
                                      </div>    
                                  @endif
                           </div>

                            <div class="form-group clearfix">
                                  @if(!empty($tc))
                                       <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                      {!! Form::checkbox('t_n_c_2', null, null, array('required','class'=>'field')) !!}
                                       {!! $tc->terms_2 !!}  
                                      </div>    
                                  @endif
                           </div>

                            <div class="form-group clearfix">
                                  @if(!empty($tc))
                                       <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                      {!! Form::checkbox('t_n_c_3', null, null, array('required','class'=>'field')) !!}
                                       {!! $tc->terms_3 !!}  
                                      </div>    
                                  @endif
                           </div>

                            <div class="form-group">
                                @if (!empty($fm_data->labels['submit']))
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                                        {!!HTML::linkRoute('dashboard-index', $fm_data->labels['cancel'], array(), array('class'=>"btn btn-round btn-primary"))!!}
                                          <button id="send" type="submit" class="btn btn-round btn-success">{!!$fm_data->labels['save']!!}</button>
                                    </div>
                                @endif
                            </div>

                           @endif
                      {!! Form::close() !!}
                  </div>
        </div>

   </div>

@endsection

@section('footer_add_js_script')
<script>
function goBack() {
    window.history.back();
}
</script>
@endsection



