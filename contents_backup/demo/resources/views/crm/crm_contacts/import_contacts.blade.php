@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2> Import Contacts</h2>-->
    <!--<div class="page-top-links">-->
    <!--</div>-->
@endsection

@section('right_col_title_right')
@endsection

@section('header_add_js_script')        
@endsection

@section('right_col')
    @include('navigation_tabs.crm_tabs')

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
            <h2>Import Contacts</h2>
            <a href="{!! route('crm_contacts.index')  !!}" class="btn  btn-default">View All</a>
            <button class="btn btn-default waves-effect" onclick="goBack()">Back</button>
        </div><!-- .card-header -->
        <div class="card-body card-padding">  
        <div class="progress progress-striped active" style="display:none;">
          <div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
        </div>
        <br/>
        <br/>
        {!! Form::open(['route'=>'crm_contacts.import_excel', 'method'=>'POST', 'files' => true])!!}
           <div class="row">
               <div class="col-sm-12">
                   {!! Form::label('file','Browse File',array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12"))!!}
                   <div class="fileinput fileinput-new" data-provides="fileinput">
                       <span class="btn btn-primary btn-file m-r-10">
                           <span class="fileinput-new">Select file</span>
                           <span class="fileinput-exists">Change</span>
                           <input type="file" name="import_file" id="file">
                       </span>
                       <span class="fileinput-filename"></span>
                       <a href="#" class="close fileinput-exists" data-dismiss="fileinput">&times;</a>
                   </div>
               </div>
           </div>
        <div class="row">
             <div class="form-group clearfix">
               <div class="col-md-6 col-md-offset-3">
                   <button id="send" type="submit" class="btn btn-round btn-success process">Import</button>
                   <a href="{!!route('crm_contacts.upload_excel')!!}" class="btn btn-round btn-default process">Cancel</a>
               </div>
             </div>
        </div>
        {!! Form::close() !!}
    </div>
    </div>    
@endsection
@section('footer_add_js_files') 
      <script src="{{ asset('/m-admin-ui/vendors/fileinput/fileinput.min.js') }}"></script>
      <script src="{{ asset('/m-admin-ui/vendors/input-mask/input-mask.min.js') }}"></script>
@endsection       
@section('footer_add_js_script')
<script>
$('.process').click(function(){
  $('.progress').css('display','block');
});
</script>
@endsection
