@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>E-commerce Site</h2>-->
<!--<div class="page-top-links">-->
<!--</div>-->
@endsection

@section('right_col_title_right')
@endsection

@section('right_col')
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
        <h2>Header Images</h2>
        <button id="cancel_btn" onclick="goBack()" type="button" class="btn btn-round btn-default">Back</button>
    </div><!-- .card-header -->
    <div class="card-body card-padding">
        @if(count($estores)<1)
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                You have no business listed
            </div>    
        @else
            <div class=" card-body table-responsive" >
                 <table class="table ">
                     <thead>
                         <tr>
                             <th>E-Commerce Site Name</th>
                             <th>E-Commerce Site Slug</th>
                             <th>{!! $fm_data->labels['action']!!}</th>
                             <th>Site Header Images</th>
                         </tr>
                     </thead>
                     <tbody>    
                     @for($i=0;$i<count($estores['site_name']);$i++ )
                         <tr>
                             <td>{!!  $estores['site_name'][$i]!!}</td>
                             <td>{!! $estores['slug'][$i]!!}</td>
                             <td>
                               <a href="{!!route('site.header.images.index', ['site_slug' => $estores['slug'][$i]]) !!}" data-toggle="tooltip" data-placement="bottom" title="Add" class="btn btn-default">Add</a> 
                             </td>
                             <td colspan="4">
                             @if($esites->count())
                               <table class="table">
                                 <thead><tr><th>Image</th><th>Status</th><th>URL</th><th>Action</th></tr></thead>
                               @foreach($esites as $esite)
                               @if($esite->site_slug == $estores['slug'][$i])
                                 <tr>
                                 <td>
                                   <a href="#" target="_blank"><img src='{!!asset($esite->site_images_path.$esite->site_images)!!}' alt="" style="width:120px;"/> 
                                 </td>
                                 <td>
                                   {!!$esite->status!!}
                                 </td>
                                 <td>
                                   <a href="{!!$esite->url!!}" target="_blank"> {!!wordwrap($esite->url, 10, '<br>-', TRUE)!!}</a>
                                 </td>
                                 <td>
                                   <a href="{!!route('site.header.images.index', ['id' => $esite->id]) !!}" data-toggle="tooltip" data-placement="bottom" title="Edit" class="">Edit</a> 
                                   &nbsp;&nbsp;
                                   <a href="{!!route('site', [$esite->site_slug, 'id' => $esite->id, 'preview' => 'preview']) !!}" data-toggle="tooltip" data-placement="bottom" title="Edit" class="">Preview</a> 
                                 </td> 
                                 </tr>
                               @endif
                               @endforeach
                              </table>
                             @endif
                             </td>
                             </tr>
                       @endfor
                     </tbody>
                  </table>
                 </div>
        @endif
    </div><!-- .card-body -->
</div><!-- .card -->
@if($term == 1)
    <div class="card">
        <div class="card-header bgm-blue">
            <h2>Add Header Images</h2>
        </div><!-- .card-header -->
        <div class="card-header bgm-amber">
            <h2> {!!  $site_name !!}</h2>
        </div>           

      <div class="card-body card-padding">
            <div class="progress progress-striped active" style="display:none;">
                  <div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
            </div>
            <br/>
            <br/>
                {!! Form::open(['route'=>'site.header.images.store', 'method'=>'POST', 'files' => true])!!}
                    {!!Form::hidden('site_slug', $site_slug)!!}
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
                            {!! Form::label('file','Browse Image',array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12"))!!}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                                    <div>
                                        <span class="btn btn-info btn-file">
                                            <span class="fileinput-new">Select File</span>
                                            <span class="fileinput-exists">Change</span>
                                            {!! Form::file('site_images') !!}
                                        </span>
                                        <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                </div>    
                            </div>
                         </div>

    <!--                <div class="row">
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
                    </div>-->

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
@elseif($term == 2)
    <div class="card">
      <div class="card-header bgm-blue">
            <h2>Edit Site Header Image</h2>
      </div><!-- .card-header -->
      <div class="card-body card-padding">  
        <div class="progress progress-striped active" style="display:none;">
            <div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
            </div>
        </div>
            <br/>
             <br/>
             {!! Form::model($imagedata, [
                  'method'=>'PUT', 
                  'route' =>['site.header.images.update', $imagedata->id],
                  'class'=>'form-horizontal form-label-left',
                  'files'=>true]) !!}

              {!! Form::hidden('site_slug', $imagedata->site_slug , array('id'=>'shopid')) !!}
               <div class="row">
                    <div class="form-group clearfix">
                          {!! Form::label('url', 'Certifiacate URL', array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12")) !!} 
                          <div class="col-md-5 col-sm-5">
                            {!! Form::text('url',$imagedata->url ,array('class'=>'form-control')) !!}
                          </div>
                    </div>
                </div>

              <div class="row">
                    <div class="form-group clearfix">
                        {!! Form::label('site_images', 'Uploaded Image', array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12")) !!} 
                          <div class="thumb col-md-5 col-sm-5">
                              @if(!empty($imagedata->site_images))
                                 <img src='{!!asset($imagedata->site_images_path.$imagedata->site_images)!!}'alt="Certification Logo" style="width:220px;"/>
                              @endif
                          </div> 
                    </div>
                </div>

                  <div class="row">
                      {!! Form::label('file','Browse Image',array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12"))!!}
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="fileinput fileinput-new" data-provides="fileinput">
                              <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                              <div>
                                  <span class="btn btn-info btn-file">
                                      <span class="fileinput-new">Select File</span>
                                      <span class="fileinput-exists">Change</span>
                                      {!! Form::file('site_images') !!}
                                  </span>
                                  <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                              </div>
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



<!--                    <div class="row">
                      <div class="form-group clearfix">
                          {!! Form::label('file','Browse Image',array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12"))!!}
                          <div class="fileinput fileinput-new col-md-5 col-sm-5" data-provides="fileinput">
                              <span class="btn btn-primary btn-file m-r-10">
                                  <span class="fileinput-new">Select Image</span>
                                  <span class="fileinput-exists">Change</span>
                                  {!! Form::file('site_images') !!}
                              </span>
                              <span class="fileinput-filename"></span>
                              <a href="#" class="close fileinput-exists" data-dismiss="fileinput">&times;</a>
                          </div>
                      </div>
                  </div>-->

                  <div class="row">
                       <div class="form-group clearfix">
                         <div class="col-md-6 col-md-offset-3">
                             <button id="send" type="submit" class="btn btn-round btn-success process">Update</button>
                             <button id="cancel_btn" onclick="goBack()" type="button" class="btn btn-round btn-primary">Cancel</button>
                         </div>
                       </div>
                  </div>
             {!! Form::close() !!}
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
    function goBack() {
        window.history.back();
    }
    </script>
@endsection