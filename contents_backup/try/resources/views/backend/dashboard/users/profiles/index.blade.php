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

    @if($errors->any())
      <ul class="parsley-errors-list filled text-center">
            {!! implode('', $errors->all('<li class="parsley-required">:message</li>'))!!}
      </ul>
    @endif  
    
    @include('navigation_tabs.personal_profile_tabs')

   <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>{!!$fm_data->labels['view']!!}</h2>
            <a href="{!! URL::route('profile-edit',$profile->id)  !!}" type="submit" class="btn btn-default"><i class='zmdi zmdi-edit zmdi-hc-fw'></i>Edit</a>
            <a href="{!! route('dashboard-index')  !!}" type="submit" class="btn btn-default"><i class='zmdi zmdi-home'></i>Home</a>
        </div><!-- .card-header -->
        <div class="card-body card-padding">  
      {!! Form::open()!!}

          @if(!empty($fm_data->labels['profile_image']))
            <div class="form-group clearfix">
                {!! Form::label('profile_image', $fm_data->labels['profile_image'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                <div class="col-md-6 col-sm-6 col-xs-12"> 
                    @if(!empty($profile->profile_image))
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
                 {!! Form::email('email', $profile->email,array("disabled"=>"disabled", 'required', 'class'=>'form-control'))!!}
                  </div>
             </div>   
          @endif

           @if(!empty($fm_data->labels['username']))
               <div class="form-group clearfix">
                {!!Form::label('username', $fm_data->labels['username'], ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-7">
                     {!!Form::text('username',$profile->username, array("disabled"=>"disabled", 'required','class'=>'form-control'))!!}
                </div>
             </div>
           @endif

            @if(!empty($fm_data->labels['role']))
              <div class="form-group clearfix">
                {!! Form::label('role', $fm_data->labels['role'], ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                  <div class="col-md-7">
                    {!! Form::text('role', $role, array("disabled"=>"disabled", 'class'=>'form-control'))!!}
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
              <div class="form-group clearfix">
                  <div class="col-md-3  col-md-offset-5">
                    <a href="{!!route('personal-info-create')!!}" class="btn btn-primary">Next</a>
                  </div>
              </div>

          {!!Form::close() !!}
        </div>
   </div>    
 @endsection