@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>Product Catalog</h2>-->
    <!--<div class="page-top-links">-->
    <!--</div>-->
@endsection

@section('right_col_title_right')
@endsection

@section('right_col')

@if (Session::has('message'))
<div class="alert alert-info">{!! Session::get('message')  !!}</div>
@endif

@if (HTML::ul($errors->all()))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        {!! HTML::ul($errors->all()) !!}
    </div>
@endif
   
      <div class="card">
        <div class="card-header bgm-blue head-title">
          <h2>Update Product Catalog</h2>
          <button id="cancel_btn" onclick="goBack()" type="button" class="btn btn-round btn-default">Back</button>
        </div><!-- .card-header -->
        <div class="card-body card-padding">  
          <div class="progress progress-striped active" style="display:none;">
                  <div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                  </div>
              </div>
              <br/>
               <br/>
               {!! Form::model($get_catalog, [
                    'method'=>'PUT', 
                    'route' =>['productcatalog.update', $get_catalog->_id],
                    'class'=>'form-horizontal form-label-left',
                    'files'=>true]) !!}
               
                {!! Form::hidden('shopid', $get_catalog->shopid , array('id'=>'shopid')) !!} 
               
 
                    <div class="row">
                      <div class="form-group clearfix">
                          {!! Form::label('logo', 'Uploaded Catalog', array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12")) !!} 
                            <div class="thumb col-md-5 col-sm-5">
                                @if(!empty($get_catalog->product_catalog))
<!--                                <img src="{{asset($get_catalog->product_catalog)}}"alt="Product Catalog" style="width:220px;"/>-->
                                    <embed src="{{asset($get_catalog->product_catalog_path.$get_catalog->product_catalog)}}" style="width:120px;">
                                @endif
                            </div>
                      </div>
                   </div>
<!--                @if(!empty($get_catalog->product_catalog))
                    <div class="row">
                        <div class="form-group clearfix">
                              {!! Form::label('view', 'View Product Catalog', array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12")) !!} 
                                <div class="thumb col-md-5 col-sm-5">
                                    <a href="{!! route('productcatalog.show', $get_catalog->_id)  !!}" target="_blank">View Catalog</a></div>
                                </div>
                          </div>
                        <div>
                    </div>
                  @endif-->
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
                            {!! HTML:: link('/productcatalog/addcatalog/'.$get_catalog->shopid,'Cancel',array('class'=>'btn btn-round btn-primary'))!!}
                       </div>
                     </div>
                </div>
               {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('footer_add_js_script') 
<script>
function goBack() {
    window.history.back();
}
</script>
@endsection