@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>{!!$fm_data->labels['form_title']!!}</h2>-->
<!--<div class="page-top-links">
</div>-->
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
          <a href="{!! route('dashboard-index')  !!}" type="submit" class="btn btn-default"><i class='zmdi zmdi-home'></i>Home</a>
          <a href="{!! route('profile-index')  !!}" type="submit" class="btn btn-default">{!!$fm_data->labels['cancel']!!}</a>
        </div><!-- .card-header -->
        <div class="card-body card-padding">
       {!! Form::open(array('route' => 'profile-update','method'=>'PUT', 'class'=>'form-horizontal form-label-left', $profile->id, 'files'=>true))!!}

          {!!Form::hidden('id', $profile->id)!!}
          
          
            <div class="form-group clearfix">
                {!! Form::label('profile_image', $fm_data->labels['profile_image'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                                <div>
                                    <span class="btn btn-info btn-file">
                                        <span class="fileinput-new">Select image</span>
                                        <span class="fileinput-exists">Change</span>
                                        {!! Form::file('profile_image', null, array('class'=>'form-control')) !!}
                                    </span>
                                    <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                                </div>
                        </div>    
                </div>
            </div>
            @if(!empty($fm_data->labels['profile_image']))
                <div class="form-group clearfix">
                    {!! Form::label('existing_image','Current Profile Picture', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        @if(!empty($profile->profile_image))
                              <?php $img=$profile->profile_image?>
                              <img src='{!!asset($profile->profile_image_path.$profile->profile_image)!!} 'class='' style="width:150px;">
                         @else
                              <img src='{!!asset("uploads/profile_pics/profile.png")!!} 'class='' style="width:150px;">
                         @endif
                    </div> 
                </div>
            @endif

           @if(!empty($fm_data->labels['email']))
              <div class="form-group clearfix">
                {!!Form::label('email',$fm_data->labels['email'], ['class'=>'control-label col-md-3 col-sm-3 col-xs-12'])!!}
                  <div class="col-md-7">
                 {!! Form::email('email', $profile->email,array( 'required', 'class'=>'form-control'))!!}
                  </div>
             </div>   
          @endif

           @if(!empty($fm_data->labels['username']))
               <div class="form-group clearfix">
                {!!Form::label('username', $fm_data->labels['username'], ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-7">
                     {!!Form::text('username',$profile->username, array("readonly"=>"readonly", 'required','class'=>'form-control'))!!}
                </div>
             </div>
           @endif

            @if(!empty($fm_data->labels['role']))
              <div class="form-group clearfix">
                {!! Form::label('role', $fm_data->labels['role'], ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                  <div class="col-md-7">
                    {!! Form::text('role', $role, array("readonly"=>"readonly", 'class'=>'form-control'))!!}
                  </div>  
               </div>
            @endif

            @if(!empty($fm_data->labels['password']))
              <div class="form-group clearfix">
                {!! Form::label('password', $fm_data->labels['password'], ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                  <div class="col-md-7">
                      {!! Form::input('password','password', $profile->password,  array("readonly"=>"readonly", 'placeholder'=>$fm_data->labels['password'],'class'=>'form-control')) !!}
                  </div>
              </div>
            @endif

            @if(!empty($fm_data->labels['new_password']))
              <div class="form-group clearfix">
                {!! Form::label('new_password', $fm_data->labels['new_password'], ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                  <div class="col-md-7">
                      {!! Form::input('password','new_password', null,  array('placeholder'=>$fm_data->labels['new_password'],'class'=>'form-control')) !!}
                  </div>
              </div>
            @endif

            @if(!empty($fm_data->labels['new_password_confirmation']))
              <div class="form-group clearfix">
                {!! Form::label('password', $fm_data->labels['new_password_confirmation'], ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                  <div class="col-md-7">
                      {!! Form::input('password','new_password_confirmation', null,  array('placeholder'=>$fm_data->labels['new_password_confirmation'],'class'=>'form-control')) !!}
                  </div>
              </div>
            @endif
            
            <div class="form-group">
                @if (!empty($fm_data->labels['submit']))
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                        {!!HTML::linkRoute('profile-index', $fm_data->labels['cancel'], array(), array('class'=>"btn btn-round btn-primary"))!!}
                          <button id="send" type="submit" class="btn btn-round btn-success">{!!$fm_data->labels['save']!!}</button>
                    </div>
                @endif
            </div>
          {!!Form::close() !!}
        </div>
   </div>    
 @endsection