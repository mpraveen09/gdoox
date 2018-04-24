@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>{!!$fm_data->labels['user_title']!!}</h2>-->
<!--<div class="page-top-links">-->
<!--</div>-->
@endsection

@section('right_col_title_right')
@endsection

@section('right_col')           

    @if(!empty($fm_data->labels))

        @if (Session::has('message'))
            <div class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                {!!  Session::get('message')  !!}
            </div>
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
                  <a href="{!! route('user-create')  !!}" class="btn btn-default">{!!$fm_data->labels['create']!!}</a>
                  <a href="{!! route('users')  !!}" class="btn btn-default">{!!$fm_data->labels['view_all']!!}</a>
              </div><!-- .card-header -->
              <div class="card-body card-padding">    
                  {!! Form::open(array('action'=>['backend\dashboard\UsersController@store'], 'method'=>'POST', 'class' => 'form-horizontal form-label-left')) !!}

                        <div class="form-group clearfix">
                            @if(!empty($fm_data->labels['email']))
                                  {!!Form::label('email',$fm_data->labels['email'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12'))!!}
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                      {!! Form::email('email', null, array("required", 'placeholder' => $fm_data->labels['email'],'class'=>'form-control'))!!}
                                  </div>
                            @endif 
                        </div>

                        <div class="form-group clearfix">
                            @if(!empty($fm_data->labels['username']))
                                  {!!Form::label('username',$fm_data->labels['username'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!!Form::text('username',null, array("required",'placeholder' => $fm_data->labels['username'],'class'=>'form-control'))!!}
                                  </div>
                            @endif 
                        </div>

                        <div class="form-group clearfix">
                            @if(!empty($fm_data->labels['role']))
                                  {!!Form::label('role',$fm_data->labels['role'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!!Form::select('role', $rolename,null,  array("required",'placeholder' => '-Select Role-','class'=>'form-control'))!!}
                                  </div>
                            @endif 
                        </div>

                        <div class="form-group clearfix">
                            @if(!empty($fm_data->labels['password']))
                                  {!! Form::label('password', $fm_data->labels['password'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::password('password',array("required",'placeholder' =>$fm_data->labels['password'],'class'=>'form-control')) !!}
                                  </div>
                            @endif 
                        </div>

                        <div class="form-group clearfix">
                            @if(!empty($fm_data->labels['confirm']))
                                  {!! Form::label('password', $fm_data->labels['confirm'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                      {!! Form::password('password_confirmation',array("required",'placeholder' =>$fm_data->labels['confirm'], 'class'=>'form-control')) !!}
                                  </div>
                             @endif 
                        </div>

                        <div class="form-group clearfix">
                            @if(!empty($fm_data->labels['submit']))
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                                  <button id="send" type="submit" class="btn btn-round btn-success">{!!$fm_data->labels['submit']!!}</button>
                                </div>
                            @endif
                        </div>
                {!! Form::close()!!}
             @endif  
         </div>
    </div>
@endsection