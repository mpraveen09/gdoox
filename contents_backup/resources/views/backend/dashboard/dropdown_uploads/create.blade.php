@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>Category Upload</h2>-->
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
   <div class="card-header bgm-blue head-title">
       <h2>Import Dropdown Options</h2>
   </div><!-- .card-header -->
   <div class="card-body card-padding">  
    <br/>
    {!! Form::open(['route'=>'upload.dropdown.options', 'method'=>'POST', 'files' => true, 'name' => 'dropdown_upload', 'class' => 'dropdown_upload'])!!}
        <div class="row">
            <div class="col-sm-12">
                {!! Form::label('file','Browse File',array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12"))!!}
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <span class="btn btn-primary btn-file m-r-10">
                        <span class="fileinput-new">Select file</span>
                        <span class="fileinput-exists">Change</span>
                        {!! Form::file('file') !!}
                    </span>
                    (Please select excel format only)
                    <span class="fileinput-filename"></span>
                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput">&times;</a>
                </div>
            </div>
            <br /><br /><br /><br />
            <div class="row">
                <div class="form-group clearfix">
                    <div class="col-md-6">
                       <button type="submit" style="float: right;" class="btn btn-primary">Import</button>
                   </div>
                </div>
           </div>
        </div>
    {!! Form::close() !!}
   </div>
</div>
@endsection
