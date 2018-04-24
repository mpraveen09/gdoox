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
		<h2>Product Catalogs</h2>
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
                    <th>Product Catalogs</th>
                </tr>
            </thead>
            <tbody>    
            @foreach( $estores as $estore )
                <tr>
                    <td>{!! $estore->ecomm_company_name!!}</td>
                    <td>{!! $estore->company!!}</td>
                    <td>
                      <a href="{!!route('productcatalog', ['site_slug' => $estore->slug]) !!}" class="btn btn-default">Add</a> &nbsp;
                    </td>
                    <td colspan="4">
                    @if($catalogs->count())
                      <table class="table">
                        <thead><tr><th>Catalog</th><th>Status</th><th>Action</th></tr></thead>
                      @foreach($catalogs as $prod_catalog)
                      @if($prod_catalog->site_slug == $estore->slug)
                        <tr>
                        <td>
                            <embed src="{{asset($prod_catalog->product_catalog_path.$prod_catalog->product_catalog)}}" style="width:120px;"><br>
                            <a href="{!! URL::route('productcatalog.show',$prod_catalog->_id) !!}" target="_blank">View</a>
                        </td>
                        <td>
                          {!!$prod_catalog->status!!}
                        </td>
                        <td>
                          <a href="{!!route('productcatalog', ['id' => $prod_catalog->id]) !!}" data-toggle="tooltip" data-placement="bottom" title="Edit" class="">Edit</a> 
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
          <h2>Add Catalog</h2>
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
            
            {!! Form::open(['route'=>'productcatalog.store', 'method'=>'POST', 'files' => true])!!}
            {!! Form::hidden('site_slug', $site_slug, array('id'=>'shopid')) !!}
               
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
                        {!! Form::label('file','Browse Catalog',array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12"))!!}
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <span class="btn btn-primary btn-file m-r-10">
                                <span class="fileinput-new">Select file</span>
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
          <h2>Update Product Catalog</h2>
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
               {!! Form::model($catalog, [
                    'method'=>'PUT', 
                    'route' =>['productcatalog.update', $catalog->_id],
                    'class'=>'form-horizontal form-label-left',
                    'files'=>true]) !!}
               
                {!! Form::hidden('site_slug', $catalog->site_slug , array('id'=>'shopid')) !!} 
               
 
                    <div class="row">
                      <div class="form-group clearfix">
                          {!! Form::label('logo', 'Uploaded Catalog', array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12")) !!} 
                            <div class="thumb col-md-5 col-sm-5">
                                @if(!empty($catalog->product_catalog))
                                <embed src="{{asset($catalog->product_catalog_path.$catalog->product_catalog)}}" style="width:120px;"><br/>
                                {!!$catalog->product_catalog!!}
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
                  <div class="row">
                      <div class="form-group clearfix">
                          {!! Form::label('file','Browse Product Catalog',array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12"))!!}
                          <div class="fileinput fileinput-new col-md-5 col-sm-5" data-provides="fileinput">
                              <span class="btn btn-primary btn-file m-r-10">
                                  <span class="fileinput-new">Select Catalog</span>
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
                       <div class="col-md-6 col-md-offset-3">
                           <button id="send" type="submit" class="btn btn-round btn-success process">Update</button>
                            {!! HTML:: link('/productcatalog/addcatalog/'.$catalog->shopid,'Cancel',array('class'=>'btn btn-round btn-primary'))!!}
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