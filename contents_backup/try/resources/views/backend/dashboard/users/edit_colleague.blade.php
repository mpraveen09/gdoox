@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>Users</h2>-->
<!--<div class="page-top-links">-->
<!--</div>-->
@endsection

@section('right_col_title_right')
@endsection


@section('right_col')
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

<div class="card">
      <div class="card-header bgm-blue head-title">
            <h2>{!!$fm_data->labels['edit']!!}</h2>
            <a href="<?php echo route('invite.colleague');  ?>" class="btn btn-default">{!!$fm_data->labels['create']!!}</a>
            <a href="<?php echo route('colleague.all'); ?>" class="btn btn-default">{!!$fm_data->labels['view_all']!!}</a>
      </div><!-- .card-header -->
      
      <div class="card-body card-padding"> 
            {!!Form::open(array('route'=>['update.colleague','id'=>$user->id],'method'=>'PUT', 'class' => 'form-horizontal form-label-left')) !!}

            {!! Form::hidden('id', $user->id) !!}
            {!! Form::hidden('pwd',$user->password) !!}
          
            @if(!empty($fm_data->labels['email']))
                <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['email']))
                        {!! Form::label('email', $fm_data->labels['email'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12'))!!} 
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          {!!  Form::email('email', $user->email,array("required",'placeholder' => 'Email address','class'=>'form-control'))!!}
                      </div>
                  @endif
                </div>
            @endif

            @if(!empty($fm_data->labels['username']))
                <div class="form-group clearfix">
                @if(!empty($fm_data->labels['username']))
                      {!! Form::label('username', $fm_data->labels['username'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12'))!!}
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        {!!  Form::text('name', $user->username, array("readonly"=>"readonly",'placeholder' => $fm_data->labels['username'],'class'=>'form-control'))!!}
                      </div>  
                @endif
                </div>
            @endif

            @if($userrole=='multi-site-user')
                  <div class="form-group clearfix">
                      {!! Form::label('role', 'User Role', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                       <div class="col-md-6 col-sm-6 col-xs-12">
                           {!!Form::text('role', $userRole,  array("readonly",'class'=>'form-control')) !!}
                       </div>
                  </div> 
            @else
                <div class="form-group clearfix">
                    {!! Form::label('role', 'User Role', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::select('role', [null => 'Select Role']+ $rolename, $userRole, array("required", 'class'=>'form-control'))!!}
                     </div>
                </div>
            @endif
            
            @if(!empty($fm_data->labels['password']))
                <div class="form-group clearfix">
                    @if(!empty($fm_data->labels['password']))
                        {!! Form::label('password', $fm_data->labels['password'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::input('password', 'password', $user->password,  array('class'=>'form-control'))!!}
                        </div>
                    @endif   
                </div>
            @endif
            
            @if(!empty($fm_data->labels['password']))
                <div class="form-group clearfix">
                    @if(!empty($fm_data->labels['password']))
                        {!! Form::label('password', $fm_data->labels['password'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::input('password', 'password_confirmation', $user->password,  array('class'=>'form-control'))!!}
                        </div>
                    @endif   
                </div>
            @endif
            
<!--        @if(!empty($fm_data->labels['password']))
                <div class="form-group clearfix">
                    @if(!empty($fm_data->labels['password']))
                          {!! Form::label('password', $fm_data->labels['password'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                          <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::password('password',array("required",'placeholder' =>$fm_data->labels['password'],'class'=>'form-control')) !!}
                          </div>
                    @endif 
                </div>
            @endif  -->

<!--            @if(!empty($fm_data->labels['confirm']))
              <div class="form-group clearfix">
                  @if(!empty($fm_data->labels['confirm']))
                        {!! Form::label('password', $fm_data->labels['confirm'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::password('password_confirmation',array("required",'placeholder' =>$fm_data->labels['confirm'], 'class'=>'form-control')) !!}
                        </div>
                   @endif 
              </div>
            @endif-->
          
          
<!--        @if(!empty($fm_data->labels['password']))
            <div class="form-group clearfix">
            @if(!empty($fm_data->labels['password']))
                {!! Form::label('password', $fm_data->labels['password'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::input('password', 'password', $user->password,  array("readonly"=>"readonly",'class'=>'form-control'))!!}
                </div>
            @endif   
            </div>
       @endif-->

            @if(!empty($fm_data->labels['save']))
                <div class="form-group clearfix">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                      @if(!empty($colleague))
                      <button id="send" type="submit" class="btn btn-round btn-success" name="colleague" value="colleague">{!!$fm_data->labels['save']!!}</button>
                      @else
                      <button id="send" type="submit" class="btn btn-round btn-success" >{!!$fm_data->labels['save']!!}</button>
                      @endif
                      <a href="{!! route('users')  !!}" type="submit" class="btn btn-round btn-primary">{!!$fm_data->labels['cancel']!!}</a>
                    </div>
                </div> 
           @endif
        {!! Form::close()!!}
      </div>
</div>
@endsection