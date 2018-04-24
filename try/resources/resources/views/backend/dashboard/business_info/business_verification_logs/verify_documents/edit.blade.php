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
   
    <div class="card">
        <div class="card-header bgm-blue upload-doc head-title">
          <h2>{!!$fm_data->labels['heading2']!!}</h2>
            <a href="{!! route('dashboard-index')  !!}" type="submit" class="btn btn-default"><i class='zmdi zmdi-home'></i>Home</a>
            <a href="{!! route('business-info-index')  !!}" class="btn btn-default">{!!$fm_data->labels['cancel']!!}</a>
        </div><!-- .card-header -->
        <div class="card-body card-padding">    
          {!! Form::model($company, [
                  'method' => 'PUT',
                  'route' => ['verify-documents-update', $company->_id],
                  'class' => 'form-horizontal form-label-left',
                 'files'=>true
              ]) !!}
          {!!Form::hidden('user_id', Auth::user()->id)!!}
          {!!Form::hidden('company_id', $company->_id)!!}

          @if (!empty($fm_data->labels))

                <div class="form-group clearfix">
                    @if(!empty($fm_data->labels['label1']))
                         {!! Form::label('company_name', $fm_data->labels['label1'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
 
                         <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('company_name', $company->company_name, array('required', 'class'=>'form-control')) !!}
                        </div>    
                    @endif
                </div>
              
              <div class="form-group clearfix">
                    @if(!empty($fm_data->labels['label2']))
                         {!! Form::label('vat_fiscal', $fm_data->labels['label2'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
  
                         <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('vat_fiscal_id', null, array('required','placeholder' =>$fm_data->labels['label2'],'class'=>'form-control')) !!}
                        </div>    
                    @endif
                </div>


              <div class="form-group clearfix">
                    @if(!empty($fm_data->labels['label3']))
                         {!! Form::label('documents', $fm_data->labels['label3'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
  
                         <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::file('docs[]', array('class'=>'col-md-6')) !!}
                          {!! Form::text('doc_name[0]', null, array('class'=>'form-group')) !!}
                          {!! Form::file('docs[]', array('class'=>'col-md-6')) !!}
                          {!! Form::text('doc_name[1]', null, array('class'=>'form-group')) !!}
                          {!! Form::file('docs[]',  array('class'=>'col-md-6')) !!}
                          {!! Form::text('doc_name[2]', null, array('class'=>'form-group')) !!}
                          {!! Form::file('docs[]',  array('class'=>'col-md-6')) !!}
                          {!! Form::text('doc_name[3]', null, array('class'=>'form-group')) !!}
                          {!! Form::file('docs[]',  array('class'=>'col-md-6')) !!}
                          {!! Form::text('doc_name[4]', null, array('class'=>'form-group')) !!}
                          
                        </div>    
                    @endif
                </div>

                <div class="form-group">
                      @if (!empty($fm_data->labels['submit']))
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                              {!!HTML::linkRoute('business-info-index', $fm_data->labels['cancel'], array(), array('class'=>"btn btn-round btn-primary"))!!}
                               <button id="send" type="submit" class="btn btn-round btn-success" >{!!$fm_data->labels['submit']!!}</button>
                          </div>
                      @endif
                  </div>
                 @endif
            {!! Form::close() !!}
        </div>
    </div>    
@endsection