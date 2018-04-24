@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>  {!!$fm_data->labels['form_title']!!}</h2>-->
@endsection

@section('right_col_title_right')
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
        <h2>  {!!$fm_data->labels['heading']!!}</h2>
    </div><!-- .card-header -->
    <div class="card-body card-padding">    
      {!! Form::open(array('route' => 'invite-user-store','method'=>'POST', 'class'=>'form-horizontal form-label-left')) !!}

            @if (!empty($fm_data->labels))
            <div class="form-group clearfix">
                @if(!empty($fm_data->labels['name']))
                     {!! Form::label('name', $fm_data->labels['name'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                @endif

                @if (!empty($fm_data->labels['name']))
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('name', null,array('placeholder' =>$fm_data->labels['name'],'class'=>'form-control')) !!}
                    </div>    
                @endif
                </div>

            <div class="form-group clearfix">
                @if(!empty($fm_data->labels['email']))
                     {!! Form::label('email', $fm_data->labels['email'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                @endif

                @if (!empty($fm_data->labels['email']))
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::email('email', null,array("required",'placeholder' =>$fm_data->labels['email'],'class'=>'form-control')) !!}
                    </div>    
                @endif
                </div>
             <div class="row">
                  <div class="radio col-sm-12">
                    {!! Form::label('confirm',$fm_data->labels['check_code'], array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12"))!!}
                      <label>
                         {!! Form::radio('confirm', 1, true)!!}
                          <i class="input-helper"></i>
                          Yes
                      </label>
                     <label>
                         {!! Form::radio('confirm', 0, true)!!}
                          <i class="input-helper"></i>
                          No
                      </label>
                   </div>
              </div>
              <div class="form-group">
                @if (!empty($fm_data->labels['submit']))
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        {!!HTML::linkRoute('dashboard-index', $fm_data->labels['cancel'], array(), array('class'=>"btn btn-round btn-primary"))!!}
                          <button id="send" type="submit" class="btn btn-round btn-success">{!!$fm_data->labels['submit']!!}</button>
                    </div>
                @endif
            </div>
           @endif
      {!! Form::close() !!}
    </div>
</div>
@endsection