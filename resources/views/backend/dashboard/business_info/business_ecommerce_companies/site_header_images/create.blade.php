@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>E-commerce Site</h2>-->
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
          <h2>Add header images</h2>
        </div><!-- .card-header -->
        <div class="card-body card-padding">  
          <div class="progress progress-striped active" style="display:none;">
                  <div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                  </div>
          </div>
              <br/>
               <br/>
                {!! Form::open(['route'=>'site.header.images.store', 'method'=>'POST', 'files' => true])!!}
                {!!Form::hidden('shop_id',$id)!!}
                  <div class="row">
                      <div class="form-group clearfix">
                              {!! Form::label('url', 'URL', array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12")) !!} 
                              <div class="col-md-5 col-sm-5">
                                {!! Form::text('url','' ,array('class'=>'form-control','placeholder'=>'')) !!}
                              </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="form-group radio clearfix">
                        {!! Form::label('status','Status',array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12"))!!}
                            <div class="thumb col-md-5 col-sm-5">
                                <label>
                                    {!! Form::radio('status', 1, true)!!}
                                     <i class="input-helper"></i>
                                     Show
                                </label>
                                <label>
                                    {!! Form::radio('status', 0,false)!!}
                                     <i class="input-helper"></i>
                                     Hide
                                 </label>
                            </div> 
                       </div>
                  </div>
                
                <div class="row">
                    <div class="col-sm-12">
                        {!! Form::label('file','Browse Image',array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12"))!!}
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <span class="btn btn-primary btn-file m-r-10">
                                <span class="fileinput-new">Select file</span>
                                <span class="fileinput-exists">Change</span>
                                {!! Form::file('site_images') !!}
                            </span>
                            <span class="fileinput-filename"></span>
                            <a href="#" class="close fileinput-exists" data-dismiss="fileinput">&times;</a>
                        </div>
                    </div>
                </div>
               <br>
                <div class="row">
                     <div class="form-group clearfix">
                       <div class="col-md-6 col-md-offset-3">
                           <button id="send" type="submit" class="btn btn-round btn-success process">Upload</button>
                           <button id="cancel_btn" onclick="goBack()" type="button" class="btn btn-round btn-primary">Cancel</button>
                       </div>
                     </div>
                </div>
               {!! Form::close() !!}
        </div>
    </div>
@if (!$esites->count())
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"></span></button>
                There are no site header images
            </div>                 
    @else
        <div class="card">
            <div class="card-header bgm-blue">
                  <h2>Header Images</h2>
            </div><!-- .card-header -->
            <div class="card-body card-padding">
                  <table class="table">
                        <thead>
                              <th>Site Header Image</th>
                              <th>Status</th>
                              <th>URL</th>
                              <th>Action</th>
                        </thead>
                        
                        <tbody>
                             @foreach($esites as $esite)
                              <tr>
                                  <td>
                                      <div class="thumb">
                                        <a href="#" target="_blank"><img src='{!!asset($esite->site_images_path.$esite->site_images)!!}' alt="Certification Logo" style="width:120px;"/></a>
                                      </div> 
                                  </td>
                                  <td>
                                    {!!$esite->status!!}
                                  </td>
                                  <td>
                                    <a href="{!!$esite->url !!}" target="_blank">{!! $esite->url !!}</a>
                                  </td>
                                  <td><a href="{!!route('site.header.images.edit',$esite->id)!!}"class=""><i class="zmdi zmdi-edit zmdi-hc-fw"></i></a></td>
                              </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
        </div>
    @endif

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
 
<script>
function goBack() {
    window.history.back();
}
</script>
@endsection
