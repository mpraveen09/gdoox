@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>  {!!$fm_data->labels['form_title']!!}</h2>-->
@endsection

@section('right_col_title_right')
 @endsection



@section('header_add_js_script')        
<!--<script type="text/javascript">
$(document).ready(function(){
    $("input[type=radio]:last").bind('click',function(){
          var text_box=$('{!!Form::text('posiiton', null,array('placeholder' =>'Other Position','class'=>'form-control'))!!}');
          $(this).after(text_box);
     });
});
</script>-->
@endsection

@section('right_col')

    @if (Session::has('message'))
        <div class="alert alert-info">{!!  Session::get('message')  !!}</div>
    @endif
    
    @include('navigation_tabs.personal_profile_tabs')
    
   <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>Add Social Link</h2>
        </div><!-- .card-header -->
        <div class="card-body card-padding">    
            @if($errors->any())
              <ul class="parsley-errors-list filled text-center">
                    {!! implode('', $errors->all('<li class="parsley-required">:message</li>'))!!}
              </ul>
            @endif
            
            {!! Form::open(array('route' => 'social-info-update','method'=>'PUT', 'class'=>'form-horizontal form-label-left')) !!}
              {!!Form::hidden('user_id', Auth::user()->id)!!}
              
              @if (!empty($fm_data->labels))
                 <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['facebook']))
                           {!! Form::label('facebook', $fm_data->labels['facebook'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                      @endif

                      @if (!empty($fm_data->labels['facebook']))
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::text('facebook', $social_info->facebook, array('placeholder' =>$fm_data->labels['facebook'],'class'=>'form-control')) !!}
                          </div>    
                      @endif
                  </div>

                 <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['linkedin']))
                           {!! Form::label('linkedin', $fm_data->labels['linkedin'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                      @endif

                      @if (!empty($fm_data->labels['linkedin']))
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::text('linkedin', $social_info->linkedin, array('placeholder' =>$fm_data->labels['linkedin'],'class'=>'form-control')) !!}
                          </div>    
                      @endif
                  </div>

                 <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['twitter']))
                           {!! Form::label('twitter', $fm_data->labels['twitter'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                      @endif

                      @if (!empty($fm_data->labels['twitter']))
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::text('twitter', $social_info->twitter, array('placeholder' =>$fm_data->labels['twitter'],'class'=>'form-control')) !!}
                          </div>    
                      @endif
                  </div>

                 <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['pinterest']))
                           {!! Form::label('twitter', $fm_data->labels['pinterest'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                      @endif

                      @if (!empty($fm_data->labels['pinterest']))
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::text('pinterest', $social_info->pinterest, array('placeholder' =>$fm_data->labels['pinterest'],'class'=>'form-control')) !!}
                          </div>    
                      @endif
                  </div>

                 <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['google']))
                           {!! Form::label('google', $fm_data->labels['google'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                      @endif

                      @if (!empty($fm_data->labels['google']))
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::text('google', $social_info->google, array('placeholder' =>$fm_data->labels['google'],'class'=>'form-control')) !!}
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
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
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