@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>Managing account</h2>-->
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
                  @if($term == "team-member")
                        <h2>INVITE YOUR COLLEAGUES</h2>
                        <a href="{!! route('invite.colleague')  !!}" class="btn btn-default">{!!$fm_data->labels['create']!!}</a>
                        <a href="{!! route('colleague.all')  !!}" class="btn btn-default">{!!$fm_data->labels['view_all']!!}</a>
                  @elseif($term == "gdoox-member")
                        <h2>Create Gdoox Member</h2>
                        <a href="{!! route('gdoox_member.create')  !!}" class="btn btn-default">{!!$fm_data->labels['create']!!}</a>
                        <a href="{!! route('gdoox_member.view_all')  !!}" class="btn btn-default">{!!$fm_data->labels['view_all']!!}</a>
                  @endif
              </div><!-- .card-header -->
              <div class="card-body card-padding">    
                <!-- resources/views/auth/register.blade.php -->
                @if($term == "gdoox-member")
                    {!! Form::open(array('route'=>['gdoox_member.store'], 'method'=>'POST', 'class' => 'form-horizontal form-label-left')) !!}
                @else
                    {!! Form::open(array('route'=>['invite.store_colleague'], 'method'=>'POST', 'class' => 'form-horizontal form-label-left')) !!}
                @endif
                
                    {!! Form::hidden('term', $term) !!}
                
<!--              <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['name']))
                            {!!Form::label('name',$fm_data->labels['name'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!!Form::text('name',null, array("required",'placeholder' => $fm_data->labels['name'],'class'=>'form-control'))!!}
                            </div>
                      @endif 
                  </div>
                  
                  <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['surname']))
                            {!!Form::label('surname',$fm_data->labels['surname'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!!Form::text('surname',null, array("required",'placeholder' => $fm_data->labels['surname'],'class'=>'form-control'))!!}
                            </div>
                      @endif 
                  </div>-->
                
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
                                  {!!Form::text('role', $rolename,  array("readonly",'class'=>'form-control')) !!}
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
                            <button id="send" type="submit" class="btn btn-round btn-success">Invite</button>
                          </div>
                      @endif
                  </div>
               {!! Form::close()!!}
             @endif  
         </div>
    </div>
@endsection