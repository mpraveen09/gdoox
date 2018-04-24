@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>{!!$fm_data['labels']['form_title']!!}</h2>-->
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
              <h2>{!!$fm_data['labels']['heading']!!}</h2>
              <a href="{!! route('dashboard-index')  !!}" type="submit" class="btn btn-default"><i class='zmdi zmdi-home'></i>Home</a>
              <button onclick="goBack()" class="btn btn-default waves-effect">Back</button>
          </div>
        <div class="card-body card-padding">

            <div class="form-group clearfix">
                @if(!empty($fm_data['labels']['work_with_us']))
                <h4>{!! $fm_data['labels']['work_with_us'] !!}</h4>
                @endif
            </div>

            <div class="form-group clearfix">
                    <div>
                    <p>Hello</p> 
                    <p>WE need your support!</p> 
                        We are a young and very dynamic company and we are sure we can work together. Our Distribution Network grows every day in any country. We search SALES DIGITAL CONSULTANTS that support our marketing actions. Can you support our marketing actions by selling our services? Do you have expertise in selling services to companies and companies associations? Great! Please apply on our form below. We will contact you shortly!
                    </div>

            </div>

            <div class="form-group clearfix">
                @if(!empty($fm_data['labels']['how_to_work']))
                <h4>{!! $fm_data['labels']['how_to_work'] !!}</h4>
                @endif
            </div>

            <div role="tabpanel">
                <ul class="tab-nav" role="tablist"> 
                    @foreach($types as $key=>$options)
                        {!! $options !!}
                    @endforeach
                </ul>

                <div class="tab-content">

                    <div role="tabpanel" class="tab-pane active" id="sales">

                        {!! Form::open(array('route' => 'distributionnetwork.store','method'=>'POST', 'class'=>'form-horizontal form-label-left')) !!} 

                        {!! Form::hidden('type_id', 'individual_sales_representative', array('id'=>'individual_sales_representative')) !!}
                        {!! Form::hidden('type', 'Individual Sales Representative') !!}

                        @if (!empty($fm_data->labels))
                              <div class="form-group clearfix">
                                  @if(!empty($fm_data->labels['first_name']))
                                       {!! Form::label('first_name', $fm_data->labels['first_name'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                  @endif

                                  @if (!empty($fm_data->labels['first_name']))
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                      {!! Form::text('first_name', '', array('required','placeholder' =>$fm_data->labels['first_name'],'class'=>'form-control')) !!}
                                      </div>    
                                  @endif
                              </div>

                              <div class="form-group clearfix">
                                  @if(!empty($fm_data->labels['last_name']))
                                       {!! Form::label('last_name', $fm_data->labels['last_name'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                  @endif

                                  @if (!empty($fm_data->labels['last_name']))
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                      {!! Form::text('last_name', '',array('required','placeholder' =>$fm_data->labels['last_name'],'class'=>'form-control')) !!}
                                      </div>    
                                  @endif
                              </div>

                              <div class="form-group clearfix">
                                    <div class="radio">
                                      {!! Form::label('gender','Gender',array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12"))!!}
                                          <div class="thumb col-md-5 col-sm-5">
                                              <label>
                                                  {!! Form::radio('gender', 'male', true)!!}
                                                   <i class="input-helper"></i>
                                                   Male
                                              </label>
                                              <label>
                                                  {!! Form::radio('gender', 'female',false)!!}
                                                   <i class="input-helper"></i>
                                                   Female
                                               </label>
                                          </div> 
                                     </div>
                                </div>

                              <div class="form-group clearfix">
                                    @if(!empty($fm_data->labels['country_of_work']))
                                         {!! Form::label('country_of_work', $fm_data->labels['country_of_work'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                    @endif
                                    @if (!empty($fm_data->labels['country_of_work']))
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        {!! Form::select('country_of_work', $country, null, array('required', 'class'=>'form-control')) !!}
                                        </div>    
                                    @endif
                               </div>

                              <div class="form-group clearfix">
                                  @if(!empty($fm_data->labels['country_of_living']))
                                       {!! Form::label('country_of_living', $fm_data->labels['country_of_living'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                  @endif

                                  @if (!empty($fm_data->labels['country_of_living']))
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                      {!! Form::select('country_of_living', $country, null, array('required', 'class'=>'form-control')) !!}
                                      </div>    
                                  @endif
                              </div>

                              <div class="form-group clearfix">
                                  @if(!empty($fm_data->labels['region']))
                                       {!! Form::label('region', $fm_data->labels['region'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                  @endif

                                  @if (!empty($fm_data->labels['region']))
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                      {!! Form::text('region','',array('required','placeholder' =>$fm_data->labels['region'],'class'=>'form-control')) !!}
                                      </div>    
                                  @endif
                              </div>

                              <div class="form-group clearfix">
                                  @if(!empty($fm_data->labels['business_email']))
                                       {!! Form::label('business_email', $fm_data->labels['business_email'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                  @endif

                                  @if (!empty($fm_data->labels['business_email']))
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                      {!! Form::email('business_email','',array('required','placeholder' =>$fm_data->labels['business_email'],'class'=>'form-control')) !!}
                                      </div>    
                                  @endif
                              </div>

                              <div class="form-group clearfix">
                                  @if(!empty($fm_data->labels['business_phone']))
                                       {!! Form::label('business_phone', $fm_data->labels['business_phone'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                  @endif

                                  @if (!empty($fm_data->labels['business_phone']))
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                      {!! Form::text('business_phone','',array('required','placeholder' =>$fm_data->labels['business_phone'],'class'=>'form-control')) !!}
                                      </div>    
                                  @endif
                              </div>

                              <div class="form-group clearfix">
                                  @if(!empty($fm_data->labels['business_mob']))
                                       {!! Form::label('business_mob', $fm_data->labels['business_mob'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                  @endif

                                  @if (!empty($fm_data->labels['business_mob']))
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                      {!! Form::text('business_mob','',array('placeholder' =>$fm_data->labels['business_mob'],'class'=>'form-control')) !!}
                                      </div>    
                                  @endif
                              </div>

                              <div class="form-group clearfix">
                                  @if(!empty($fm_data->labels['skype_account']))
                                       {!! Form::label('skype_account', $fm_data->labels['skype_account'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                  @endif

                                  @if (!empty($fm_data->labels['skype_account']))
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                      {!! Form::text('skype_account','',array('required','placeholder' =>$fm_data->labels['skype_account'],'class'=>'form-control')) !!}
                                      </div>    
                                  @endif
                              </div>

                              <div class="form-group clearfix">
                                  @if(!empty($fm_data->labels['age']))
                                       {!! Form::label('age', $fm_data->labels['age'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                  @endif

                                  @if (!empty($fm_data->labels['age']))
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                      {!! Form::text('age','',array('placeholder' =>$fm_data->labels['age'],'class'=>'form-control')) !!}
                                      </div>    
                                  @endif
                              </div>

                              <div class="form-group clearfix">
                               @if(!empty($fm_data->labels['vat']))
                               {!! Form::label('vat', $fm_data->labels['vat'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                   {!! Form::text('vat','',array('placeholder' =>$fm_data->labels['vat'],'class'=>'form-control')) !!}
                                   </div>    
                               @endif
                            </div>

                             <div class="form-group clearfix">
                               {!! Form::label('market_area', 'Your market area', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                   {!! Form::text('market_area','',array('placeholder' =>'Your market area', 'id' => "tags_1", 'class'=>'form-control')) !!}
                                   </div>    
                            </div>
                             <div class="form-group clearfix">
                               {!! Form::label('business_area', 'Your market area', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                   {!! Form::select('business_area', ['Local', 'Regional', 'National', 'International'], '', array('placeholder' =>'-select-', 'class'=>'form-control')) !!}
                                   </div>    
                            </div>
                             <div class="form-group clearfix">
                               {!! Form::label('your_business', 'Please describe your business', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                   {!! Form::textarea('your_business', '', array('placeholder' =>'Please describe your business(200 characters)', 'class'=>'form-control')) !!}
                                   </div>    
                            </div>
                             <div class="form-group clearfix">
                               {!! Form::label('discover_platform', 'How did you discover Gdoox platform', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                   {!! Form::select('discover_platform', ['Invitation', 'Internet Engine', 'Linkedin', 'Facebook', 'Pinterest', 'Other Social Media'], '', array('placeholder' =>'-select-', 'class'=>'form-control')) !!}
                                   </div>    
                            </div>
                            <div class="form-group clearfix">
                                    @if(!empty($tc))
                                         <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        {!! Form::checkbox('t_n_c_1', null, null, array('class'=>'field')) !!}
                                         {!! $tc->desc!!}  
                                        </div>    
                                    @endif
                             </div>

                              <div class="form-group clearfix">
                                    @if(!empty($tc))
                                         <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        {!! Form::checkbox('t_n_c_2', null, null, array('class'=>'field')) !!}
                                         {!! $tc->terms_2 !!}  
                                        </div>    
                                    @endif
                             </div>

                              <div class="form-group clearfix">
                                    @if(!empty($tc))
                                         <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        {!! Form::checkbox('t_n_c_3', null, null, array('class'=>'field')) !!}
                                         {!! $tc->terms_3 !!}  
                                        </div>    
                                    @endif
                             </div>

                              <div class="form-group">
                                  @if (!empty($fm_data->labels['submit']))
                                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">                        
                                            <button id="send" type="submit" class="btn btn-round btn-success">{!!$fm_data->labels['submit']!!}</button>
                                      </div>
                                  @endif
                              </div>

                             @endif
                        {!! Form::close() !!}
                    </div>

                    <div role="tabpanel" class="tab-pane" id="network"> 

                            {!! Form::open(array('route' => 'distributionnetwork.store','method'=>'POST', 'class'=>'form-horizontal form-label-left')) !!} 

                            {!! Form::hidden('type_id', 'seller_network', array('id'=>'seller_network')) !!}
                            {!! Form::hidden('type', 'Seller Network (Registered Company)') !!}

                            @if (!empty($fm_data->labels))

                                <div class="form-group clearfix">
                                      @if(!empty($fm_data->labels['company_name']))
                                           {!! Form::label('company_name', $fm_data->labels['company_name'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                      @endif

                                      @if (!empty($fm_data->labels['company_name']))
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                          {!! Form::text('company_name', '', array('required','placeholder' =>$fm_data->labels['company_name'],'class'=>'form-control')) !!}
                                          </div>    
                                      @endif
                                </div>

                              <div class="form-group clearfix">
                                    @if(!empty($fm_data->labels['first_name']))
                                         {!! Form::label('first_name', $fm_data->labels['first_name'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                    @endif

                                    @if (!empty($fm_data->labels['first_name']))
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        {!! Form::text('first_name', '', array('required','placeholder' =>$fm_data->labels['first_name'],'class'=>'form-control')) !!}
                                        </div>    
                                    @endif
                              </div>

                              <div class="form-group clearfix">
                                  @if(!empty($fm_data->labels['last_name']))
                                       {!! Form::label('last_name', $fm_data->labels['last_name'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                  @endif

                                  @if (!empty($fm_data->labels['last_name']))
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                      {!! Form::text('last_name', '',array('required','placeholder' =>$fm_data->labels['last_name'],'class'=>'form-control')) !!}
                                      </div>    
                                  @endif
                              </div>

                              <div class="form-group clearfix">
                                    @if(!empty($fm_data->labels['country_of_work']))
                                         {!! Form::label('country_of_work', $fm_data->labels['country_of_work'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                    @endif
                                    @if (!empty($fm_data->labels['country_of_work']))
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        {!! Form::select('country_of_work', $country, null, array('required', 'class'=>'form-control')) !!}
                                        </div>    
                                    @endif
                               </div>


                              <div class="form-group clearfix">
                                  @if(!empty($fm_data->labels['region']))
                                       {!! Form::label('region', $fm_data->labels['region'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                  @endif

                                  @if (!empty($fm_data->labels['region']))
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                      {!! Form::text('region','',array('required','placeholder' =>$fm_data->labels['region'],'class'=>'form-control')) !!}
                                      </div>    
                                  @endif
                              </div>

                              <div class="form-group clearfix">
                                  @if(!empty($fm_data->labels['business_email']))
                                       {!! Form::label('business_email', $fm_data->labels['business_email'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                  @endif

                                  @if (!empty($fm_data->labels['business_email']))
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                      {!! Form::email('business_email','',array('required','placeholder' =>$fm_data->labels['business_email'],'class'=>'form-control')) !!}
                                      </div>    
                                  @endif
                              </div>

                              <div class="form-group clearfix">
                                  @if(!empty($fm_data->labels['business_phone']))
                                       {!! Form::label('business_phone', $fm_data->labels['business_phone'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                  @endif

                                  @if (!empty($fm_data->labels['business_phone']))
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                      {!! Form::text('business_phone','',array('required','placeholder' =>$fm_data->labels['business_phone'],'class'=>'form-control')) !!}
                                      </div>    
                                  @endif
                              </div>

                              <div class="form-group clearfix">
                                  @if(!empty($fm_data->labels['business_mob']))
                                       {!! Form::label('business_mob', $fm_data->labels['business_mob'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                  @endif

                                  @if (!empty($fm_data->labels['business_mob']))
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                      {!! Form::text('business_mob','',array('placeholder' =>$fm_data->labels['business_mob'],'class'=>'form-control')) !!}
                                      </div>    
                                  @endif
                              </div>

                              <div class="form-group clearfix">
                                  @if(!empty($fm_data->labels['skype_account']))
                                       {!! Form::label('skype_account', $fm_data->labels['skype_account'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                      {!! Form::text('skype_account','',array('required','placeholder' =>$fm_data->labels['skype_account'],'class'=>'form-control')) !!}
                                      </div>    
                                  @endif
                              </div>
                             <div class="form-group clearfix">
                               {!! Form::label('position', 'Your Position In The Organization', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                   {!! Form::select('position', ['Skype account', 'Director', 'Partner', 'Business Opportunity Valuation', 'Marketing', 'H.R', 'Trainer'], '', array('placeholder' =>'-select-', 'class'=>'form-control')) !!}
                                   </div>    
                            </div>
                            
                             <div class="form-group clearfix">
                               {!! Form::label('your_organization', 'Please Describe Your Organization', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                   {!! Form::textarea('your_organization', '', array('placeholder' =>'Please Describe Your Organization(200 characters)', 'class'=>'form-control')) !!}
                                   </div>    
                            </div>
                              <div class="form-group clearfix">
                                    {!! Form::label('agents', 'Number Of Agent Or Sales Representative', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                   {!! Form::text('agents','',array('required', 'placeholder' =>'Number of agent or sales representative', 'class'=>'form-control')) !!}
                                   </div>    
                              </div>
                             <div class="form-group clearfix">
                               {!! Form::label('market_area', 'Your market area', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                   {!! Form::text('market_area','',array('placeholder' =>'Your market area', 'id' => "tags_2", 'class'=>'form-control')) !!}
                                   </div>    
                            </div>
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
                                            <button id="send" type="submit" class="btn btn-round btn-success">{!!$fm_data->labels['submit']!!}</button>
                                      </div>
                                  @endif
                              </div>

                             @endif
                        {!! Form::close() !!}
                    </div>

                    <div role="tabpanel" class="tab-pane" id="association">
                            {!! Form::open(array('route' => 'distributionnetwork.store','method'=>'POST', 'class'=>'form-horizontal form-label-left')) !!} 

                            {!! Form::hidden('type_id', 'trade_association', array('id'=>'trade_association')) !!}
                            {!! Form::hidden('type', 'Trade Association') !!}

                            @if (!empty($fm_data->labels))

                                <div class="form-group clearfix">
                                      @if(!empty($fm_data->labels['company_name']))
                                           {!! Form::label('company_name', $fm_data->labels['company_name'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                      @endif

                                      @if (!empty($fm_data->labels['company_name']))
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                          {!! Form::text('company_name', '', array('required','placeholder' =>$fm_data->labels['company_name'],'class'=>'form-control')) !!}
                                          </div>    
                                      @endif
                                </div>

                              <div class="form-group clearfix">
                                    @if(!empty($fm_data->labels['first_name']))
                                         {!! Form::label('first_name', $fm_data->labels['first_name'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                    @endif

                                    @if (!empty($fm_data->labels['first_name']))
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        {!! Form::text('first_name', '', array('required','placeholder' =>$fm_data->labels['first_name'],'class'=>'form-control')) !!}
                                        </div>    
                                    @endif
                              </div>

                              <div class="form-group clearfix">
                                  @if(!empty($fm_data->labels['last_name']))
                                       {!! Form::label('last_name', $fm_data->labels['last_name'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                  @endif

                                  @if (!empty($fm_data->labels['last_name']))
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                      {!! Form::text('last_name', '',array('required','placeholder' =>$fm_data->labels['last_name'],'class'=>'form-control')) !!}
                                      </div>    
                                  @endif
                              </div>

                              <div class="form-group clearfix">
                                    @if(!empty($fm_data->labels['country_of_work']))
                                         {!! Form::label('country_of_work', $fm_data->labels['country_of_work'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                    @endif
                                    @if (!empty($fm_data->labels['country_of_work']))
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        {!! Form::select('country_of_work', $country, null, array('required', 'class'=>'form-control')) !!}
                                        </div>    
                                    @endif
                               </div>


                              <div class="form-group clearfix">
                                  @if(!empty($fm_data->labels['region']))
                                       {!! Form::label('region', $fm_data->labels['region'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                  @endif

                                  @if (!empty($fm_data->labels['region']))
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                      {!! Form::text('region','',array('required','placeholder' =>$fm_data->labels['region'],'class'=>'form-control')) !!}
                                      </div>    
                                  @endif
                              </div>

                              <div class="form-group clearfix">
                                  @if(!empty($fm_data->labels['business_email']))
                                       {!! Form::label('business_email', $fm_data->labels['business_email'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                  @endif

                                  @if (!empty($fm_data->labels['business_email']))
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                      {!! Form::email('business_email','',array('required','placeholder' =>$fm_data->labels['business_email'],'class'=>'form-control')) !!}
                                      </div>    
                                  @endif
                              </div>

                              <div class="form-group clearfix">
                                  @if(!empty($fm_data->labels['business_phone']))
                                       {!! Form::label('business_phone', $fm_data->labels['business_phone'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                  @endif

                                  @if (!empty($fm_data->labels['business_phone']))
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                      {!! Form::text('business_phone','',array('required','placeholder' =>$fm_data->labels['business_phone'],'class'=>'form-control')) !!}
                                      </div>    
                                  @endif
                              </div>

                              <div class="form-group clearfix">
                                  @if(!empty($fm_data->labels['business_mob']))
                                       {!! Form::label('business_mob', $fm_data->labels['business_mob'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                  @endif

                                  @if (!empty($fm_data->labels['business_mob']))
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                      {!! Form::text('business_mob','',array('placeholder' =>$fm_data->labels['business_mob'],'class'=>'form-control')) !!}
                                      </div>    
                                  @endif
                              </div>

                              <div class="form-group clearfix">
                                  @if(!empty($fm_data->labels['skype_account']))
                                       {!! Form::label('skype_account', $fm_data->labels['skype_account'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                      {!! Form::text('skype_account','',array('required','placeholder' =>$fm_data->labels['skype_account'],'class'=>'form-control')) !!}
                                      </div>    
                                  @endif
                              </div>
                             <div class="form-group clearfix">
                               {!! Form::label('position', 'Your Position In The Organization', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                   {!! Form::select('position', ['Skype account', 'Director', 'Partner', 'Business Opportunity Valuation', 'Marketing', 'H.R', 'Trainer'], '', array('placeholder' =>'-select-', 'class'=>'form-control')) !!}
                                   </div>    
                            </div>
                            
                             <div class="form-group clearfix">
                               {!! Form::label('your_organization', 'Please Describe Your Organization', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                   {!! Form::textarea('your_organization', '', array('placeholder' =>'Please Describe Your Organization(200 characters)', 'class'=>'form-control')) !!}
                                   </div>    
                            </div>
                              <div class="form-group clearfix">
                                    {!! Form::label('agents', 'Number Of Agent Or Sales Representative', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                   {!! Form::text('agents','',array('required', 'placeholder' =>'Number of agent or sales representative', 'class'=>'form-control')) !!}
                                   </div>    
                              </div>
                             <div class="form-group clearfix">
                               {!! Form::label('market_area', 'Your market area', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                   {!! Form::text('market_area','',array('placeholder' =>'Your market area', 'id' => "tags_2", 'class'=>'form-control')) !!}
                                   </div>    
                            </div>
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
                                            <button id="send" type="submit" class="btn btn-round btn-success">{!!$fm_data->labels['submit']!!}</button>
                                      </div>
                                  @endif
                              </div>

                             @endif
                        {!! Form::close() !!}
                    </div>
                    <div role="tabpanel" class="tab-pane" id="organization"> 
                        {!! Form::open(array('route' => 'distributionnetwork.store','method'=>'POST', 'class'=>'form-horizontal form-label-left')) !!} 

                        {!! Form::hidden('type_id', 'advertising_organization', array('id'=>'advertising_organization')) !!}
                        {!! Form::hidden('type', 'Advertising Organization') !!}

                            @if (!empty($fm_data->labels))

                                <div class="form-group clearfix">
                                      @if(!empty($fm_data->labels['company_name']))
                                           {!! Form::label('company_name', $fm_data->labels['company_name'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                      @endif

                                      @if (!empty($fm_data->labels['company_name']))
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                          {!! Form::text('company_name', '', array('required','placeholder' =>$fm_data->labels['company_name'],'class'=>'form-control')) !!}
                                          </div>    
                                      @endif
                                </div>

                                <div class="form-group clearfix">
                                      @if(!empty($fm_data->labels['first_name']))
                                           {!! Form::label('first_name', $fm_data->labels['first_name'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                      @endif

                                      @if (!empty($fm_data->labels['first_name']))
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                            {!! Form::text('first_name', '', array('required','placeholder' =>$fm_data->labels['first_name'],'class'=>'form-control')) !!}
                                          </div>    
                                      @endif
                                </div>

                                <div class="form-group clearfix">
                                    @if(!empty($fm_data->labels['last_name']))
                                         {!! Form::label('last_name', $fm_data->labels['last_name'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                    @endif

                                    @if (!empty($fm_data->labels['last_name']))
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        {!! Form::text('last_name', '',array('required','placeholder' =>$fm_data->labels['last_name'],'class'=>'form-control')) !!}
                                        </div>    
                                    @endif
                                </div>

                                <div class="form-group clearfix">
                                      @if(!empty($fm_data->labels['country_of_work']))
                                           {!! Form::label('country_of_work', $fm_data->labels['country_of_work'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                      @endif
                                      @if (!empty($fm_data->labels['country_of_work']))
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                          {!! Form::select('country_of_work', $country, null, array('required', 'class'=>'form-control')) !!}
                                          </div>    
                                      @endif
                                 </div>                           

                                <div class="form-group clearfix">
                                    @if(!empty($fm_data->labels['region']))
                                         {!! Form::label('region', $fm_data->labels['region'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                    @endif

                                    @if (!empty($fm_data->labels['region']))
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        {!! Form::text('region','',array('required','placeholder' =>$fm_data->labels['region'],'class'=>'form-control')) !!}
                                        </div>    
                                    @endif
                                </div>

                                <div class="form-group clearfix">
                                    @if(!empty($fm_data->labels['business_email']))
                                         {!! Form::label('business_email', $fm_data->labels['business_email'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                    @endif

                                    @if (!empty($fm_data->labels['business_email']))
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        {!! Form::email('business_email','',array('required','placeholder' =>$fm_data->labels['business_email'],'class'=>'form-control')) !!}
                                        </div>    
                                    @endif
                                </div>

                                <div class="form-group clearfix">
                                    @if(!empty($fm_data->labels['business_phone']))
                                         {!! Form::label('business_phone', $fm_data->labels['business_phone'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                    @endif

                                    @if (!empty($fm_data->labels['business_phone']))
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        {!! Form::text('business_phone','',array('required','placeholder' =>$fm_data->labels['business_phone'],'class'=>'form-control')) !!}
                                        </div>    
                                    @endif
                                </div>

                                <div class="form-group clearfix">
                                    @if(!empty($fm_data->labels['business_mob']))
                                         {!! Form::label('business_mob', $fm_data->labels['business_mob'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                    @endif

                                    @if (!empty($fm_data->labels['business_mob']))
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        {!! Form::text('business_mob','',array('placeholder' =>$fm_data->labels['business_mob'],'class'=>'form-control')) !!}
                                        </div>    
                                    @endif
                                </div>

                                <div class="form-group clearfix">
                                    @if(!empty($fm_data->labels['skype_account']))
                                         {!! Form::label('skype_account', $fm_data->labels['skype_account'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                    @endif

                                    @if (!empty($fm_data->labels['skype_account']))
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        {!! Form::text('skype_account','',array('required','placeholder' =>$fm_data->labels['skype_account'],'class'=>'form-control')) !!}
                                        </div>    
                                    @endif
                                </div>

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
                                              <button id="send" type="submit" class="btn btn-round btn-success">{!!$fm_data->labels['submit']!!}</button>
                                        </div>
                                    @endif
                                </div>

                            @endif
                        {!! Form::close() !!}
                </div>
                    </div>

            </div> 
        </div>
</div>       
@endsection
@section('footer_add_js_files') 
<!--        <script src="{{ asset('/m-admin-ui/vendors/fileinput/fileinput.min.js') }}"></script>
        <script src="{{ asset('/m-admin-ui/vendors/input-mask/input-mask.min.js') }}"></script>-->
        <script src="{{ asset('/js/jquery.tagsinput.js') }}"></script>
@endsection       

@section('footer_add_js_script')

<script type="text/javascript">
function goBack() {
    window.history.back();
}
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
							$(this).css('background-color', 'grey');
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



