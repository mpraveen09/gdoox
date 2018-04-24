@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <!--<h2>{!! $fm_data->labels['title'] !!}</h2>-->
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
        <div class="card-header bgm-blue head-title">
          <h2><i class="zmdi zmdi-account m-r-5"></i> {!! $fm_data->labels['form_other_info'] !!}</h2>
        </div><!-- .card-header -->
        <div class="card-body card-padding">    
            {!! Form::model($fm_data, [
                  'method' => 'POST',
                  'route' => ['other-info-store'],
                  'class' => 'form-horizontal form-label-left',
                  'id'=>'other-info',
                 'files'=>true
              ]) !!}
                    
                  @if(!empty($fm_data->labels['computer_skills']))
                    <div class="form-group clearfix">
                       {!! Form::label('computer_skills', $fm_data->labels['computer_skills'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                       <div class="col-md-6 col-sm-6 col-xs-12">
                      {!! Form::textarea('computer_skills', '', array('placeholder'=>$fm_data->labels['computer_skills'],'class'=>'form-control')) !!}
                      </div>    
                    </div>
                  @endif
                  
                  @if(!empty($fm_data->labels['other_skills']))
                    <div class="form-group clearfix">
                       {!! Form::label('other_skills', $fm_data->labels['other_skills'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                       <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::textarea('other_skills', '', array('placeholder'=>$fm_data->labels['other_skills'],'class'=>'form-control')) !!}
                      </div>    
                    </div>
                  @endif
                  
                  @if(!empty($fm_data->labels['publications']))
                    <div class="form-group clearfix">
                       {!! Form::label('publications', $fm_data->labels['publications'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                       <div class="col-md-6 col-sm-6 col-xs-12">
                      {!! Form::textarea('publications', '', array('placeholder'=>$fm_data->labels['publications'],'class'=>'form-control')) !!}
                      </div>    
                    </div>
                  @endif
                  
                  @if(!empty($fm_data->labels['presentations']))
                    <div class="form-group clearfix">
                       {!! Form::label('presentations', $fm_data->labels['presentations'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                       <div class="col-md-6 col-sm-6 col-xs-12">
                      {!! Form::textarea('presentations', '', array('placeholder'=>$fm_data->labels['presentations'],'class'=>'form-control')) !!}
                      </div>    
                    </div>
                  @endif
                  
                  @if(!empty($fm_data->labels['projects']))
                    <div class="form-group clearfix">
                       {!! Form::label('projects', $fm_data->labels['projects'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                       <div class="col-md-6 col-sm-6 col-xs-12">
                      {!! Form::textarea('projects', '', array('placeholder'=>$fm_data->labels['projects'],'class'=>'form-control')) !!}
                      </div>    
                    </div>
                  @endif
                  
                  @if(!empty($fm_data->labels['conferences']))
                    <div class="form-group clearfix">
                       {!! Form::label('conferences', $fm_data->labels['conferences'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                       <div class="col-md-6 col-sm-6 col-xs-12">
                       {!! Form::textarea('conferences','', array('placeholder'=>$fm_data->labels['conferences'],'class'=>'form-control')) !!}
                      </div>    
                    </div>
                  @endif
                  
                   @if(!empty($fm_data->labels['seminars']))
                    <div class="form-group clearfix">
                       {!! Form::label('seminars', $fm_data->labels['seminars'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                       <div class="col-md-6 col-sm-6 col-xs-12">
                       {!! Form::textarea('seminars','', array('placeholder'=>$fm_data->labels['seminars'],'class'=>'form-control')) !!}
                       </div>    
                    </div>
                  @endif
                  
                  @if(!empty($fm_data->labels['awards']))
                    <div class="form-group clearfix">
                       {!! Form::label('awards', $fm_data->labels['awards'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                       <div class="col-md-6 col-sm-6 col-xs-12">
                       {!! Form::textarea('awards','', array('placeholder'=>$fm_data->labels['awards'],'class'=>'form-control')) !!}
                       </div>    
                    </div>
                  @endif
                  
                  @if(!empty($fm_data->labels['membership']))
                    <div class="form-group clearfix">
                       {!! Form::label('membership', $fm_data->labels['membership'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                       <div class="col-md-6 col-sm-6 col-xs-12">
                       {!! Form::textarea('membership','', array('placeholder'=>$fm_data->labels['membership'],'class'=>'form-control')) !!}
                       </div>    
                    </div>
                  @endif

                  @if (!empty($fm_data->labels['submit']))
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                             <button id="send" type="submit" class="btn btn-round btn-success">{!!$fm_data->labels['save']!!}</button>
                        </div>
                    </div>
                  @endif
            {!! Form::close() !!}
        </div>
    </div>    
    
@endsection
@section('footer_add_js_script')

<script type="text/javascript">
$(document).ready(function(){
    });
</script>
@endsection

