@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>  {!!$fm_data->labels['form_title']!!}</h2>-->
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

    @if (HTML::ul($errors->all()))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!! HTML::ul($errors->all()) !!}
        </div>
    @endif
   
    @include('navigation_tabs.general_tabs')
    
    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>Create</h2>
            <a href="{!! route('payment-method-create')  !!}" class="btn btn-default">{!!$fm_data->labels['create']!!}</a>
            <a href="{!! route('payment-method-index')  !!}" class="btn btn-default">{!!$fm_data->labels['view_all']!!}</a>
        </div><!-- .card-header -->
        <div class="card-body card-padding">    
          {!! Form::open(array('route' => 'payment-method-store','method'=>'POST ', 'class'=>'form-horizontal form-label-left', 'files'=>true)) !!}
              {!!Form::hidden('user_id', Auth::user()->id)!!}

              @if (!empty($fm_data->labels))

                  <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['label1']))
                           {!! Form::label('name', $fm_data->labels['label1'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 

                           <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::text('name', null, array('required','placeholder' =>$fm_data->labels['label1'],'class'=>'form-control')) !!}
                          </div>    
                      @endif
                  </div>

                  <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['label2']))
                           {!! Form::label('method_name', $fm_data->labels['label2'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 

                           <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::select('method_name', $payment_method, null, array('required','placeholder' =>'--Select Method--','class'=>'form-control')) !!}
                          </div>    
                      @endif
                  </div>

                  <div class="form-group">
                      @if (!empty($fm_data->labels['submit']))
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                              {!!HTML::linkRoute('payment-method-index', $fm_data->labels['cancel'], array(), array('class'=>"btn btn-round btn-primary"))!!}
                               <button id="send" type="submit" class="btn btn-round btn-success">{!!$fm_data->labels['submit']!!}</button>
                          </div>
                      @endif
                  </div>
                 @endif
            {!! Form::close() !!}
        </div>
    </div>    
@endsection