@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<h2>{!!$fm_data->labels['form_title']!!}</h2>
<!--<div class="page-top-links">-->
    <a href="{!! route('dashboard-user-create')  !!}" class="btn btn-default">{!!$fm_data->labels['create']!!}</a>
    <a href="{!! route('dashboard-users')  !!}" class="btn btn-default">{!!$fm_data->labels['view_all']!!}</a>
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
         <div class="card">
              <div class="card-header bgm-blue">
                  <h2>{!!$fm_data->labels['create']!!}</h2>
              </div><!-- .card-header -->
              <div class="card-body card-padding">    
                <!-- resources/views/auth/register.blade.php -->
                  {!! Form::open(array('route' => 'role-store', 'method'=>'POST', 'class' => 'form-horizontal form-label-left')) !!}

                  <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['label1']))
                          {!!Form::label('name',$fm_data->labels['label1'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12'))!!}
                       <div class="col-md-6 col-sm-6 col-xs-12">
                           {!! Form::text('name', null, array("required", 'placeholder' => $fm_data->labels['label1'],'class'=>'form-control'))!!}
                       </div>
                      @endif 
                  </div>

                  <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['label2']))
                            {!!Form::label('level',$fm_data->labels['label2'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {!!Form::text('level',null, array("required",'placeholder' => $fm_data->labels['label2'],'class'=>'form-control'))!!}
                          </div>
                      @endif 
                  </div>

                  <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['label3']))
                            {!!Form::label('permission',$fm_data->labels['label3'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {!!Form::select('permission', [null],null,  array('placeholder' => '-Select Permission-','class'=>'form-control'))!!}
                          </div>
                      @endif 
                  </div>

                  <div class="form-group clearfix">
                      @if (!empty($fm_data->labels['submit']))
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                              {!!HTML::linkRoute('role-index', $fm_data->labels['cancel'], array(), array('class'=>"btn btn-round btn-primary"))!!}
                              <button id="send" type="submit" class="btn btn-round btn-success">{!!$fm_data->labels['submit']!!}</button>
                          </div>
                      @endif
                  </div>
               {!! Form::close()!!}
             @endif  
         </div>
    </div>
@endsection