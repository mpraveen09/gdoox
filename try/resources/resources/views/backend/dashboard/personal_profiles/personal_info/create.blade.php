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

    @include('navigation_tabs.general_tabs')

    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>{!!$fm_data->labels['create']!!}</h2>
        </div><!-- .card-header -->
        <div class="card-body card-padding">    
        {!! Form::model($fm_data, [
                  'method' => 'POST',
                  'route' => ['personal-info-store'],
                  'class' => 'form-horizontal form-label-left',
                  'id'=>'personal-info',
                 'files'=>true
              ]) !!}
  
            {!!Form::hidden('user_id', Auth::user()->id)!!}
              
              
              @if (!empty($fm_data->labels))
              <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['first_name']))
                    {!! Form::label('first_name', $fm_data->labels['first_name'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('first_name','', array('required','placeholder' =>$fm_data->labels['first_name'],'class'=>'form-control')) !!}
                    </div>
                  @endif
              </div>

              <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['second_name']))
                       {!! Form::label('second_name', $fm_data->labels['second_name'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('second_name','',array('placeholder' =>$fm_data->labels['second_name'],'class'=>'form-control')) !!}
                      </div>    
                  @endif
              </div>

               <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['surname']))
                       {!! Form::label('surname', $fm_data->labels['surname'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('surname','',array('placeholder' =>$fm_data->labels['surname'],'class'=>'form-control')) !!}
                        </div>    
                  @endif
              </div>

              <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['initials']))
                       {!! Form::label('initials', $fm_data->labels['initials'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      {!! Form::text('initials','',array('placeholder' =>$fm_data->labels['initials'],'class'=>'form-control')) !!}
                      </div>    
                  @endif
              </div>

              <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['dob']))
                       {!! Form::label('dob', $fm_data->labels['dob'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                      <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('dob','', array('placeholder' =>$fm_data->labels['dob'],'class'=>'form-control')) !!}
                      </div>
                       
                  @endif
              </div>

              <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['street_add']))
                        {!! Form::label('street_add', $fm_data->labels['street_add'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                              {!! Form::text('street_add','', array('required', 'placeholder' =>$fm_data->labels['street_add'],'class'=>'form-control')) !!}
                        </div>
                        
                        @if(!Auth::user()->hasRole('team-member'))
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                 {!! Form::checkbox('street_add_status', 'show'); !!} {!! Form::label('show', $fm_data->labels['show']) !!}
                            </div>
                        @endif
                  @endif
              </div>

              <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['city']))
                       {!! Form::label('city', $fm_data->labels['city'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      {!! Form::text('city','', array('required','placeholder' =>$fm_data->labels['city'],'class'=>'form-control')) !!}
                      </div>    
                  @endif
              </div>

              <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['country']))
                       {!! Form::label('country', $fm_data->labels['country'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                      <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::select('country', $country,'', array('required', 'class'=>'form-control')) !!}
                      </div>    
                  @endif
              </div>

              <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['zip']))
                       {!! Form::label('zip', $fm_data->labels['zip'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                              {!! Form::text('zip','',array('required','placeholder' =>$fm_data->labels['zip'],'class'=>'form-control')) !!}
                        </div>
                        @if(!Auth::user()->hasRole('team-member'))
                             <div class="col-md-3 col-sm-3 col-xs-12">
                                   {!! Form::checkbox('zip_status', 'show'); !!} {!! Form::label('show', $fm_data->labels['show']) !!}
                             </div>
                        @endif
                  @endif
              </div>

              <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['private_ph_no1']))
                        {!! Form::label('private_ph_no1', $fm_data->labels['private_ph_no1'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('private_ph_no1','',array('required','placeholder'=>$fm_data->labels['private_ph_no1'],'class'=>'form-control')) !!}
                        </div>
                  @endif
              </div>

              <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['private_mob_no1']))
                       {!! Form::label('private_mob_no1', $fm_data->labels['private_mob_no1'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      {!! Form::text('private_mob_no1','',array('required','placeholder'=>$fm_data->labels['private_mob_no1'],'class'=>'form-control')) !!}
                      </div>    
                  @endif
              </div>

              <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['business_phone_no1']))
                        {!! Form::label('business_phone_no1', $fm_data->labels['business_phone_no1'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::text('business_phone_no1','',array('required','placeholder'=>$fm_data->labels['business_phone_no1'],'class'=>'form-control')) !!}
                        </div>
                        @if(!Auth::user()->hasRole('team-member'))
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                  {!! Form::checkbox('business_phone_no1_status', 'show'); !!} {!! Form::label('show', $fm_data->labels['show']) !!}
                            </div>
                        @endif
                  @endif
              </div>


             <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['business_mob_no1']))
                      {!! Form::label('business_mob_no1', $fm_data->labels['business_mob_no1'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('business_mob_no1','',array('required','placeholder'=>$fm_data->labels['business_mob_no1'],'class'=>'form-control')) !!}
                      </div>
                       @if(!Auth::user()->hasRole('team-member'))
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                   {!! Form::checkbox('business_mob_no1_status', 'show'); !!} {!! Form::label('show', $fm_data->labels['show']) !!}
                            </div>
                       @endif
                  @endif
              </div>

            <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['skype']))
                       {!! Form::label('skype', $fm_data->labels['skype'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                       <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('skype', '',array('required','placeholder'=>$fm_data->labels['skype'],'class'=>'form-control')) !!}
                       </div>
                       @if(!Auth::user()->hasRole('team-member'))
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                {!! Form::checkbox('skype_status', 'show'); !!} {!! Form::label('show', $fm_data->labels['show']) !!}
                            </div>
                       @endif
                  @endif
              </div>

              <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['msm']))
                       {!! Form::label('msm', $fm_data->labels['msm'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('msm', '', array('placeholder' =>$fm_data->labels['msm'],'class'=>'form-control')) !!}
                        </div>
                       @if(!Auth::user()->hasRole('team-member'))
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                 {!! Form::checkbox('msm_status', 'show'); !!} {!! Form::label('show', $fm_data->labels['show']) !!}
                            </div>
                       @endif
                  @endif
              </div>

             <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['blackberry']))
                       {!! Form::label('blackberry', $fm_data->labels['blackberry'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                      <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('blackberry', '', array('placeholder' =>$fm_data->labels['blackberry'],'class'=>'form-control')) !!}
                      </div>
                       @if(!Auth::user()->hasRole('team-member'))
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                 {!! Form::checkbox('blackberry_status', 'show'); !!} {!! Form::label('show', $fm_data->labels['show']) !!}
                            </div>
                       @endif
                  @endif
              </div>

              <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['personal_email_address']))
                        {!! Form::label('personal_email_address', $fm_data->labels['personal_email_address'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('personal_email','', array('placeholder' =>$fm_data->labels['personal_email_address'],'class'=>'form-control')) !!}
                        </div>    
                  @endif
              </div>
              
              <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['business_email_address']))
                       {!! Form::label('business_email_address', $fm_data->labels['business_email_address'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                      <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('business_email','', array('placeholder' =>$fm_data->labels['business_email_address'],'class'=>'form-control')) !!}
                      </div>
                       @if(!Auth::user()->hasRole('team-member'))
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                 {!! Form::checkbox('business_email_status', 'show'); !!} {!! Form::label('show', $fm_data->labels['show']) !!}
                            </div>
                       @endif
                  @endif
              </div>
              
              <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['job_description']))
                       {!! Form::label('job_description', $fm_data->labels['job_description'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                      <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('job_description','', array('maxlength'=>'400','placeholder' =>$fm_data->labels['job_description'],'class'=>'form-control')) !!}
                      </div>
                  @endif
              </div>


             <br /><br />
             

              <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['working_field']))
                    {!! Form::label('working_field', $fm_data->labels['working_field'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <table>
                            @for($i = 0; $i < round(count($workingfield)/2); $i++)
                                <tr>
                                    <td>{!! $workingfield[$i] !!}</td>
                                    <td>{!! Form::checkbox('working_field[]', $workingfield[$i]) !!}</td>
                                </tr>
                            @endfor
                          </table>
                        </div>
                    
                        <div class="col-md-5 col-sm-5 col-xs-12">
                          <table>
                            @for($i = round(count($workingfield)/2)+1; $i < count($workingfield); $i++)
                                <tr>
                                    <td>{!! $workingfield[$i] !!}</td>
                                    <td>{!! Form::checkbox('working_field[]', $workingfield[$i]) !!}</td>
                                </tr>
                            @endfor
                          </table>
                        </div> 
                  @endif
              </div>
   
              <div class="form-group clearfix">
                    @if(!empty($tc))
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            {!! Form::checkbox('t_n_c', null, null, array('required','class'=>'field')) !!}
                            {!! $tc->desc!!} 
                            @if(!empty($tc->doc_title))
                                {!! HTML::link($tc->doc_link, $tc->doc_title)!!}
                            @endif
                        </div>    
                    @endif
              </div>
              
              <div class="form-group">
                  @if (!empty($fm_data->labels['submit']))
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                            {!!HTML::linkRoute('dashboard-index', $fm_data->labels['cancel'], array(), array('class'=>"btn btn-round btn-primary"))!!}
                            <button id="send" type="submit" class="btn btn-round btn-success">Save & Next</button>
                      </div>
                  @endif
              </div>
             @endif
        {!! Form::close() !!}
        </div>
   </div>   
@endsection