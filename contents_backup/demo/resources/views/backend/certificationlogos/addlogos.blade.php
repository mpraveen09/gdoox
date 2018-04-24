@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <!--<h2>Certification Logo</h2>-->
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
        <div class="card-header bgm-blue head-title">
          <h2>Certification Logo</h2>
       <button id="cancel_btn" onclick="goBack()" type="button" class="btn btn-round btn-default">Back</button>
        </div><!-- .card-header -->
        <div class="card-body card-padding">  
          <div class="progress progress-striped active" style="display:none;">
                  <div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                  </div>
              </div>
              <br/>
               <br/>
               {!! Form::open(['route'=>'certificationlogos.store', 'method'=>'POST', 'files' => true])!!}
               {!! Form::hidden('shopid', $shopid, array('id'=>'shopid')) !!}
               
                 <div class="row">
                      <div class="form-group clearfix">
                              {!! Form::label('name', 'Certification Name', array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12")) !!} 
                              <div class="col-md-5 col-sm-5">
                                {!! Form::text('name','' ,array('class'=>'form-control')) !!}
                              </div>
                      </div>
                  </div>
               
                  <div class="row">
                      <div class="form-group clearfix">
                              {!! Form::label('url', 'Certification URL', array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12")) !!} 
                              <div class="col-md-5 col-sm-5">
                                {!! Form::text('url','' ,array('class'=>'form-control','placeholder'=>'')) !!}
                              </div>
                      </div>
                  </div>
               
                  <div class="row">
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
               
                  <div class="row">
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
                  </div>
               <br>
                <div class="row">
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
    
    @if ( !$get_logos->count())
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"></span></button>
                There are no Certificate Logos
            </div>                 
    @else
        <div class="card">
            <div class="card-header bgm-blue">
                  <h2>Certificate Logos</h2>
            </div><!-- .card-header -->
            <div class="card-body card-padding">
                  <table class="table">
                        <thead>
                              <th>Certificate Logo</th>
                              <th>Name</th>
                              <th>URL</th>
                              <th>Action</th>
                        </thead>
                        
                        <tbody>
                             @foreach($get_logos as $logos)
                              <tr>
                                  <td>
                                      <div class="thumb">
                                        @if(!empty($logos->logo))
                                        <a href="{!! route('certificationlogos.show', $logos->_id)  !!}" target="_blank"><img src="{{asset($logos->logo_path.$logos->logo)}}"alt="Certification Logo" style="width:120px;"/></a>
                                        @endif
                                      </div> 
                                  </td>
                                  <td>
                                     @if(!empty($logos->name))
                                          {!! $logos->name !!}
                                     @endif
                                  </td>
                                  <td>
                                      @if(!empty($logos->url))
                                      {!! HTML::link('http://'.$logos->url, 'View', array('target' => '_blank'))!!}({!! $logos->url !!})
                                      @endif
                                  </td>
                                  <td><a href="{!! route('certificationlogos.edit', $logos->_id)  !!}"class=""><i class="zmdi zmdi-edit zmdi-hc-fw"></i></a></td>
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
