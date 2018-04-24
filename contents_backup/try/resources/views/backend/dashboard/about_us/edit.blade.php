@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('header_custom_css')        
    <!--header_custom_css-->
    <link href="{{ asset('/m-admin-ui/vendors/bower_components/summernote/dist/summernote.css') }}" rel="stylesheet">
@endsection

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
          <h2>Summary</h2>
        </div><!-- .card-header -->
        <div class="card-body card-padding">    
            {!! Form::model($fm_data, [
                  'method' => 'PUT',
                  'route' => array('personal-about-us-update',$userid),
                  'class' => 'form-horizontal form-label-left',
                  'id'=>'about-us',
                 'files'=>true
              ]) !!}
                    
                  @if(!empty($fm_data->labels['about_us']))
                    <div class="form-group clearfix">
                       {!! Form::label('about_us', $fm_data->labels['about_us'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                       <div class="col-md-9 col-sm-9 col-xs-12">
                        {!! Form::hidden('about_us', $info->about_us, array('placeholder' =>'','class'=>'form-control','id'=>'about_us')) !!}
                            <div class="html-editor"></div> 
                    </div>
                    </div>
                  @endif
                  
                  @if (!empty($fm_data->labels['submit']))
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                             <button id="send" onclick="setContent();" type="submit" class="btn btn-round btn-success">{!!$fm_data->labels['save']!!}</button>
                        </div>
                    </div>
                  @endif
                  
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('footer_add_js_files') 
    <script src="{{ asset('/m-admin-ui/vendors/bower_components/summernote/dist/summernote.min.js') }}"></script>
@endsection

@section('footer_add_js_script')
<script>
        function setContent() {
            var sHTML = $('.html-editor').code();
            $('#about_us').val(sHTML);  
        }
        
        $(document).ready(function() {
            var editor_data=  $('#about_us').val()
            $('.html-editor').code(editor_data);
        });
        
    </script>
@endsection

