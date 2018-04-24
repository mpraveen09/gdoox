@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <!--<h2>Stores</h2>-->
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
        <h2>Certification Logos</h2>
        <button id="cancel_btn" onclick="goBack()" type="button" class="btn btn-round btn-default">Back</button>
	</div><!-- .card-header -->
	<div class="card-body card-padding">
    @if(!$estores->count())
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        You have no business listed
    </div>    
    @else
 
   <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
        <table class="table table-striped responsive-utilities jambo_table ">
            <thead>
                <tr>
                    <th>{!! $fm_data->labels['label1']!!}</th>
                    <th>{!! $fm_data->labels['label2']!!}</th>
                    <th>{!! $fm_data->labels['action']!!}</th>
                    <th>Certification Logos</th>
                </tr>
            </thead>
            <tbody>    
            @foreach( $estores as $estore )
                <tr>
                    <td>{!! $estore->ecomm_company_name!!}</td>
                    <td>{!! $estore->company!!}</td>
                    <td>
                        <a href="{!!route('certificationlogos', ['site_slug' => $estore->slug]) !!}" class="btn btn-default">Add</a> &nbsp;
                    </td>
                    <td colspan="4">
                    @if($logos->count())
                      <table class="table">
                        <thead><tr><th>Logo</th><th>Status</th><th>Action</th></tr></thead>
                      @foreach($logos as $logo)
                      @if($logo->site_slug == $estore->slug)
                        <tr>
                        <td>
                            <embed src="{{asset($logo->logo_path.$logo->logo)}}" style="width:120px;">
                        </td>
                        <td>
                          {!!$logo->status!!}
                        </td>
                        <td>
                          <a href="{!!route('certificationlogos', ['id' => $logo->id]) !!}" data-toggle="tooltip" data-placement="bottom" title="Edit" class="">Edit</a> 
                        </td> 
                        </tr>
                      @endif
                      @endforeach
                     </table>
                    @endif
                    </td>
                </tr> 
            @endforeach
            </tbody>
        </table>
        
        </div>
        <div class="row">
            <div class="text-right col-md-12">
                {!! $estores->render() !!}
            </div>
        </div>    
        </div><!-- .card-body -->
</div><!-- .card -->
@endif
@if($term == 1)
     <div class="card">
        <div class="card-header bgm-blue">
          <h2>Certification Logo</h2>
        </div><!-- .card-header -->
        <div class="card-header bgm-amber">
            <h2> {!!  $site_name !!}</h2>
        </div>           
         <div class="card-body card-padding">  
          <div class="progress progress-striped active" style="display:none;">
                  <div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                  </div>
              </div>
              <br/>
               <br/>
               {!! Form::open(['route'=>'certificationlogos.store', 'method'=>'POST', 'files' => true])!!}
               {!! Form::hidden('site_slug', $site_slug, array('id'=>'shopid')) !!}
               
                 <div class="form-group">
                      <div class="form-group clearfix">
                              {!! Form::label('name', 'Certification Name', array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12")) !!} 
                              <div class="col-md-5 col-sm-5">
                                {!! Form::text('name','' ,array('class'=>'form-control')) !!}
                              </div>
                      </div>
                  </div>
               
                  <div class="form-group">
                      <div class="form-group clearfix">
                              {!! Form::label('url', 'Certification URL', array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12")) !!} 
                              <div class="col-md-5 col-sm-5">
                                {!! Form::text('url','' ,array('class'=>'form-control','placeholder'=>'')) !!}
                              </div>
                      </div>
                  </div>
               
                    <div class="form-group">
                        <div class="radio form-group clearfix">
                          {!! Form::label('status','Status',array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12"))!!}
                              <div class="col-md-5 col-sm-5">
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
                  
                    <div class="row form-group">
                         {!! Form::label('file','Browse Certificate',array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12"))!!} 
                         <div class="col-md-6 col-sm-6 col-xs-12">
                             <div class="fileinput fileinput-new" data-provides="fileinput">
                                 <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                                 <div>
                                     <span class="btn btn-info btn-file">
                                         <span class="fileinput-new">Select Certificate</span>
                                         <span class="fileinput-exists">Change</span>
                                         {!! Form::file('file') !!}
                                     </span>
                                     <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                                 </div>
                             </div>    
                         </div>
                     </div>
                  
<!--                  <div class="row">
                      <div class="col-sm-12">
                          {!! Form::label('file','Browse Certificate',array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12"))!!}
                          <div class="col-md-5 col-sm-5 fileinput fileinput-new" data-provides="fileinput">
                              <span class="btn btn-primary btn-file m-r-10">
                                  <span class="fileinput-new">Select Certificate</span>
                                  <span class="fileinput-exists">Change</span>
                                  {!! Form::file('file') !!}
                              </span>
                              <span class="fileinput-filename"></span>
                              <a href="#" class="close fileinput-exists" data-dismiss="fileinput">&times;</a>
                          </div>
                      </div>
                  </div>-->
               <br>
                <div class="form-group">
                     <div class="form-group clearfix">
                       <div class="col-md-5 col-sm-5 col-md-offset-3">
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
            <h2>Import Certification Logo</h2>
        </div><!-- .card-header -->
        <div class="card-body card-padding">  
            <div class="progress progress-striped active" style="display:none;">
                <div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
            </div>
                <br/>
                <br/>
               {!! Form::model($get_logos, [
                    'method'=>'PUT', 
                    'route' =>['certificationlogos.update', $get_logos->_id],
                    'class'=>'form-horizontal form-label-left',
                    'files'=>true]) !!}
               
                {!! Form::hidden('site_slug', $get_logos->site_slug , array('id'=>'shopid')) !!}
                 <div class="row">
                      <div class="form-group clearfix">
                              {!! Form::label('name', 'Certifiacate Name', array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12")) !!} 
                              <div class="col-md-5 col-sm-5">
                                {!! Form::text('name',$get_logos->name ,array('class'=>'form-control')) !!}
                              </div>
                      </div>
                  </div>
               
                 <div class="row">
                      <div class="form-group clearfix">
                              {!! Form::label('url', 'Certifiacate URL', array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12")) !!} 
                              <div class="col-md-5 col-sm-5">
                                {!! Form::text('url',$get_logos->url ,array('class'=>'form-control')) !!}
                              </div>
                      </div>
                  </div>
                    
                <div class="row">
                      <div class="form-group clearfix">
                          {!! Form::label('logo', 'Uploaded Certificate', array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12")) !!} 
                            <div class="thumb col-md-5 col-sm-5">
                                @if(!empty($get_logos->logo))
                                   <img src="{{asset($get_logos->logo_path.$get_logos->logo)}}"alt="Certification Logo" style="width:220px;"/>
                                @endif
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
                <br>
                <div class="row form-group">
                    {!! Form::label('file','Browse Certificate',array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12"))!!} 
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                            <div>
                                <span class="btn btn-info btn-file">
                                    <span class="fileinput-new">Select Certificate</span>
                                    <span class="fileinput-exists">Change</span>
                                    {!! Form::file('file') !!}
                                </span>
                                <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                            </div>
                        </div>    
                    </div>
                 </div>
<!--                 <div class="row">
                      <div class="form-group clearfix">
                          {!! Form::label('file','Browse Certificate',array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12"))!!}
                          <div class="fileinput fileinput-new col-md-5 col-sm-5" data-provides="fileinput">
                              <span class="btn btn-primary btn-file m-r-10">
                                  <span class="fileinput-new">Select Certificate</span>
                                  <span class="fileinput-exists">Change</span>
                                  {!! Form::file('file') !!}
                              </span>
                              <span class="fileinput-filename"></span>
                              <a href="#" class="close fileinput-exists" data-dismiss="fileinput">&times;</a>
                          </div>
                      </div>
                  </div>-->
                <br>
                <div class="row">
                     <div class="form-group clearfix">
                       <div class="col-md-6 col-md-offset-3">
                           <button id="send" type="submit" class="btn btn-round btn-success process">Update</button>
                            {!! HTML:: link('/certificationlogos/addlogos/'.$get_logos->shopid,'Cancel',array('class'=>'btn btn-round btn-primary'))!!}
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