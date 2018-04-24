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
        {!! Form::open(array('route' => 'personal-info-update','method'=>'PUT', 'class'=>'form-horizontal form-label-left', $personal_info->user_id)) !!}
              {!!Form::hidden('user_id', $personal_info->user_id)!!}
              
              
              @if (!empty($fm_data->labels))
              <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['first_name']))
                    {!! Form::label('first_name', $fm_data->labels['first_name'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('first_name', $personal_info->first_name, array('required','placeholder' =>$fm_data->labels['first_name'],'class'=>'form-control')) !!}
                    </div>
                  @endif
              </div>

              <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['second_name']))
                       {!! Form::label('second_name', $fm_data->labels['second_name'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('second_name', $personal_info->second_name,array('placeholder' =>$fm_data->labels['second_name'],'class'=>'form-control')) !!}
                      </div>    
                  @endif
              </div>

               <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['surname']))
                       {!! Form::label('surname', $fm_data->labels['surname'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('surname', $personal_info->surname, array('placeholder' =>$fm_data->labels['surname'],'class'=>'form-control')) !!}
                        </div>    
                  @endif
               </div>

              <!-- <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['email']))
                       {!! Form::label('email', $fm_data->labels['email'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      {!! Form::email('email', $personal_info->email, array('placeholder' =>$fm_data->labels['s_name'],'class'=>'form-control')) !!}
                      </div>    
                  @endif
              </div> -->

              <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['initials']))
                       {!! Form::label('initials', $fm_data->labels['initials'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      {!! Form::text('initials', $personal_info->initials,array('placeholder' =>$fm_data->labels['initials'],'class'=>'form-control')) !!}
                      </div>    
                  @endif
              </div>

              <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['dob']))
                       {!! Form::label('dob', $fm_data->labels['dob'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                      <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('dob', $personal_info->dob, array('placeholder' =>$fm_data->labels['dob'],'class'=>'form-control')) !!}
                      </div>
                       @if(!Auth::user()->hasRole('team-member'))
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                @if($personal_info->dob_status=='show')
                                     {!! Form::checkbox('dob_status', 'show', true); !!} {!! Form::label('show', $fm_data->labels['show']) !!}
                                @else
                                     {!! Form::checkbox('dob_status', 'show'); !!} {!! Form::label('show', $fm_data->labels['show']) !!}
                                @endif 
                            </div>     
                       @endif
                  @endif
              </div>

              <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['street_add']))
                        {!! Form::label('street_add', $fm_data->labels['street_add'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                              {!! Form::text('street_add', $personal_info->street_add, array('required', 'placeholder' =>$fm_data->labels['street_add'],'class'=>'form-control')) !!}
                        </div>
                        @if(!Auth::user()->hasRole('team-member'))
                            <div class="col-md-3 col-sm-3 col-xs-12">
                               @if($personal_info->street_add_status=='show')
                                    {!! Form::checkbox('street_add_status', 'show', true); !!} {!! Form::label('show', $fm_data->labels['show']) !!}
                               @else
                                    {!! Form::checkbox('street_add_status', 'show'); !!} {!! Form::label('show', $fm_data->labels['show']) !!}
                               @endif  
                            </div>
                        @endif
                  @endif
              </div>

              <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['city']))
                       {!! Form::label('city', $fm_data->labels['city'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                      <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('city', $personal_info->city, array('required','placeholder' =>$fm_data->labels['city'],'class'=>'form-control')) !!}
                      </div>    
                  @endif
              </div>

              <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['country']))
                       {!! Form::label('country', $fm_data->labels['country'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::select('country', $country, $personal_info->country, array('required', 'class'=>'form-control')) !!}
                      </div>    
                  @endif
              </div>

              <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['zip']))
                       {!! Form::label('zip', $fm_data->labels['zip'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                              {!! Form::text('zip', $personal_info->zip,array('required','placeholder' =>$fm_data->labels['zip'],'class'=>'form-control')) !!}
                        </div>
                        @if(!Auth::user()->hasRole('team-member'))
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                @if($personal_info->street_add_status=='show')
                                     {!! Form::checkbox('street_add_status', 'show', true); !!} {!! Form::label('show', $fm_data->labels['show']) !!}
                                @else
                                     {!! Form::checkbox('street_add_status', 'show'); !!} {!! Form::label('show', $fm_data->labels['show']) !!}
                                @endif   
                            </div>
                        @endif
                  @endif
              </div>

              <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['private_ph_no1']))
                        {!! Form::label('private_ph_no1', $fm_data->labels['private_ph_no1'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('private_ph_no1', $personal_info->private_ph_no1,array('required','placeholder'=>$fm_data->labels['private_ph_no1'],'class'=>'form-control')) !!}
                        </div>    
                  @endif
              </div>

              <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['private_mob_no1']))
                       {!! Form::label('private_mob_no1', $fm_data->labels['private_mob_no1'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      {!! Form::text('private_mob_no1', $personal_info->private_mob_no1,array('required','placeholder'=>$fm_data->labels['private_mob_no1'],'class'=>'form-control')) !!}
                      </div>    
                  @endif
              </div>

              <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['business_phone_no1']))
                        {!! Form::label('business_phone_no1', $fm_data->labels['business_phone_no1'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::text('business_phone_no1', $personal_info->business_phone_no1,array('required','placeholder'=>$fm_data->labels['business_phone_no1'],'class'=>'form-control')) !!}
                        </div>
                        @if(!Auth::user()->hasRole('team-member'))
                            <div class="col-md-3 col-sm-3 col-xs-12">
                               @if($personal_info->business_phone_no1_status=='show')
                                    {!! Form::checkbox('business_phone_no1_status', 'show', true); !!} {!! Form::label('show', $fm_data->labels['show']) !!}
                               @else
                                    {!! Form::checkbox('business_phone_no1_status', 'show'); !!} {!! Form::label('show', $fm_data->labels['show']) !!}
                               @endif 
                            </div>
                        @endif
                  @endif
              </div>


             <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['business_mob_no1']))
                       {!! Form::label('business_mob_no1', $fm_data->labels['business_mob_no1'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                              {!! Form::text('business_mob_no1', $personal_info->business_mob_no1,array('required','placeholder'=>$fm_data->labels['business_mob_no1'],'class'=>'form-control')) !!}
                        </div>
                        @if(!Auth::user()->hasRole('team-member'))
                             <div class="col-md-3 col-sm-3 col-xs-12">
                                 @if($personal_info->business_mob_no1_status=='show')
                                      {!! Form::checkbox('business_mob_no1_status', 'show'); !!} {!! Form::label('show', $fm_data->labels['show']) !!}
                                 @else
                                      {!! Form::checkbox('business_mob_no1_status'); !!} {!! Form::label('show', $fm_data->labels['show']) !!}
                                 @endif  
                             </div>
                        @endif
                  @endif
              </div>

            <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['skype']))
                       {!! Form::label('skype', $fm_data->labels['skype'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                              {!! Form::text('skype', $personal_info->skype,array('required','placeholder'=>$fm_data->labels['skype'],'class'=>'form-control')) !!}
                        </div>
                        @if(!Auth::user()->hasRole('team-member'))
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                @if($personal_info->skype_status=='show')
                                     {!! Form::checkbox('skype_status', 'show', true); !!} {!! Form::label('show', $fm_data->labels['show']) !!}
                                @else
                                     {!! Form::checkbox('skype_status', 'show'); !!} {!! Form::label('show', $fm_data->labels['show']) !!}
                                @endif  
                            </div>
                        @endif
                  @endif
              </div>

              <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['msm']))
                       {!! Form::label('msm', $fm_data->labels['msm'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('msm', $personal_info->msm, array('placeholder' =>$fm_data->labels['msm'],'class'=>'form-control')) !!}
                        </div>
                        @if(!Auth::user()->hasRole('team-member'))
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                @if($personal_info->msm_status=='show')
                                     {!! Form::checkbox('msm_status', 'show', true); !!} {!! Form::label('show', $fm_data->labels['show']) !!}
                                @else
                                     {!! Form::checkbox('msm_status', 'show'); !!} {!! Form::label('show', $fm_data->labels['show']) !!}
                                @endif  
                             </div>
                        @endif
                  @endif
              </div>

             <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['blackberry']))
                       {!! Form::label('blackberry', $fm_data->labels['blackberry'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                      <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('blackberry', $personal_info->blackberry, array('placeholder' =>$fm_data->labels['blackberry'],'class'=>'form-control')) !!}
                      </div>
                       @if(!Auth::user()->hasRole('team-member'))
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                 @if($personal_info->blackberry_status=='show')
                                     {!! Form::checkbox('blackberry_status', 'show', true); !!} {!! Form::label('show', $fm_data->labels['show']) !!}
                                @else
                                    {!! Form::checkbox('blackberry_status', 'show'); !!} {!! Form::label('show', $fm_data->labels['show']) !!}
                                @endif
                            </div>
                       @endif
                  @endif
              </div>

              <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['personal_email_address']))
                    {!! Form::label('personal_email_address', $fm_data->labels['personal_email_address'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      {!! Form::text('personal_email', $personal_info->personal_email, array('placeholder' =>$fm_data->labels['personal_email_address'],'class'=>'form-control')) !!}
                    </div>    
                  @endif
              </div>
              
              <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['business_email_address']))
                        {!! Form::label('business_email_address', $fm_data->labels['business_email_address'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                              {!! Form::text('business_email_address', $personal_info->business_email, array('placeholder' =>$fm_data->labels['business_email_address'],'class'=>'form-control')) !!}
                        </div>
                        @if(!Auth::user()->hasRole('team-member'))
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                @if($personal_info->business_email_status=='show')
                                     {!! Form::checkbox('business_email_status', 'show',true); !!} {!! Form::label('show', $fm_data->labels['show']) !!}
                                @else
                                    {!! Form::checkbox('business_email_status', 'show'); !!} {!! Form::label('show', $fm_data->labels['show']) !!}
                                @endif   
                            </div>
                        @endif
                  @endif
              </div>
              
              <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['job_description']))
                        {!! Form::label('job_description', $fm_data->labels['job_description'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                              {!! Form::textarea('job_description',$personal_info->job_description, array('maxlength'=>'400','placeholder'=>$fm_data->labels['job_description'],'class'=>'form-control')) !!}
                        </div>
                  @endif
              </div>

<!--          <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['phone_no2']))
                       {!! Form::label('phone_no2', $fm_data->labels['phone_no2'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      {!! Form::text('phone_no2', $personal_info->phone_no2, array('placeholder' =>$fm_data->labels['phone_no2'],'class'=>'form-control')) !!}
                      </div>    
                  @endif
              </div>-->

<!--             <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['fax_no']))
                       {!! Form::label('fax_no', $fm_data->labels['phone_no2'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      {!! Form::text('fax_no', $personal_info->fax_no, array('placeholder' =>$fm_data->labels['fax_no'],'class'=>'form-control')) !!}
                      </div>    
                  @endif
              </div>-->

<!--             <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['mobile']))
                       {!! Form::label('mobile', $fm_data->labels['mobile'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      {!! Form::text('mobile', $personal_info->mobile, array('placeholder' =>$fm_data->labels['mobile'],'class'=>'form-control')) !!}
                      </div>    
                  @endif
              </div>-->
            

<!--             <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['business_email']))
                       {!! Form::label('business_email', $fm_data->labels['business_email'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::email('business_email', $personal_info->business_email, array('required', 'placeholder' =>$fm_data->labels['business_email'],'class'=>'form-control')) !!}
                      </div>   
                  @endif
              </div>-->

<!--              <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['working_field']))
                    {!! Form::label('working_field', $fm_data->labels['working_field'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="chosen" multiple data-placeholder="Select...">
                            @foreach($workingfield as $field)
                                <option value="{!! $field !!}">{!! $field !!}</option>
                            @endforeach
                        </select>
                      </div>   
                  @endif
              </div>-->
             <br /><br />
              <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['working_field']))
                    {!! Form::label('working_field', $fm_data->labels['working_field'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <table>
                            @for($i = 0; $i < round(count($workingfield)/2); $i++)
                                <tr>
                                    <td>{!! $workingfield[$i] !!}</td>
                                    @if(in_array($workingfield[$i],$selectedfield))
                                        <td>{!! Form::checkbox('working_field[]', $workingfield[$i], array('checked')) !!}</td>
                                    @else
                                        <td>{!! Form::checkbox('working_field[]', $workingfield[$i]) !!}</td>
                                    @endif
                                </tr>
                            @endfor
                          </table>
                        </div>
                    
                        <div class="col-md-5 col-sm-5 col-xs-12">
                          <table>
                            @for($i = round(count($workingfield)/2)+1; $i < count($workingfield); $i++)
                                <tr>
                                    <td>{!! $workingfield[$i] !!}</td>
                                    @if(in_array($workingfield[$i],$selectedfield))
                                        <td>{!! Form::checkbox('working_field[]', $workingfield[$i], array('checked')) !!}</td>
                                    @else
                                        <td>{!! Form::checkbox('working_field[]', $workingfield[$i]) !!}</td>
                                    @endif
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

@section('footer_add_js_files')
<!--    <link rel="stylesheet" href="/public/m-admin-ui/vendors/bower_components/chosen/chosen.min.css">
    <script src="{{ asset('/m-admin-ui/vendors/bower_components/chosen/chosen.jquery.min.js') }}"></script>-->
@endsection  
