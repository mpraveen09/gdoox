  @extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>Import Products</h2>-->
<!--<div class="page-top-links">-->

<!--<a href="" class="btn btn-default">List Product</a>-->
<!--</div>-->
@endsection

@section('right_col_title_right')
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

    @include('navigation_tabs.product_mgmt_tabs')
    
    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>Select Products</h2>
            <!--<a href="{!!route('import_product.import')!!}" class="btn btn-default">Import</a>-->
        </div><!-- .card-header -->
@if(!$products->count())
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        You have not listed any product or no product remaining for create opportunity
    </div>    
@else
    <div class="card-body card-padding-sm">
        <div class="row">
            @foreach( $products as $product )
                <div class="col-md-12 ">
                  <div class="col-md-3">
                        @if(!empty($product->shopid))
                          <h5>Site Slug </h5>
                          {!! $product->shopid  !!}
                        @endif
                   </div>
                  <div class="col-md-2">
                      <h5>Product Thumbnail</h5>
                      <a href="{!! route('products/show', $product->id)  !!}" class="prod_thumb">
                        @if (!empty($product->thumb)) 

                          <img src="{!!  asset($product->thumb_path.$product->thumb)  !!}" alt="prodcuct" width="100px;" height="100px;"/>
                        @else
                          <img src="{{ asset('images/product_img.png') }}" alt="prodcuct" width="100px;" height="100px;"/>
                        @endif
                      </a>
                  </div>
                    <div class="col-md-2">
                     @if(!empty($product->desc))
                        <h5>Post Date: </h5>
                        {!! $product->desc  !!}
                      @endif
                     </div>
                    <div class="col-md-2">
                     @if(!empty($product->postdate))
                        <h5>Post Date: </h5>
                        {!!  $product->postdate  !!}
                      @endif
                     </div>
                      <div class="col-md-3">
                        <h5>Action</h5>
                        <a href="{!!route('import_product.list_product', array('product_id' => $product->id))  !!}" class="btn btn-default">Show Details</a>
                     </div>
                </div>
                <div class="col-md-12 ">                                    
                    <hr/>
                </div>
              @endforeach
        </div>
        <div class="row">
            <div class="text-right col-md-12">
              {!!$products->render()!!}
            </div>
        </div>    
    </div><!-- .card-body -->
@endif
    </div>
  @if($term == 1)
  <div class="card">
    <div class="card-header bgm-blue head-title">
        <h2>{!!$product->desc!!} Detail</h2>
<!--     <a href="{!!route('import_product.import')!!}" class="btn btn-default">Import</a>
         <a href="{!!route('import_product.list_product')!!}" class="btn btn-default">List Product</a>-->
    </div><!-- .card-header -->
    <div class="card-body card-padding">
      <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
        <table class="table table-striped responsive-utilities jambo_table ">
              <thead>
                <tr>
                  <th>Attribute Id</th><th>Attribute Name</th><th>Category Id</th><th>Category Name</th>
                </tr>
                <?php // print_r($attr); die;?>
                @for($i = 0; $i<count($attr['attr_id']); $i++)
                  <tr>
                      <td>{!!$attr['attr_id'][$i]!!}</td>
                      @if(!empty($attr['label'][$i]))
                      <td>{!!$attr['label'][$i]!!}</td>
                      @endif
                    @if(!empty($cat['cat_id'][$i]))
                      <td>{!!$cat['cat_id'][$i]!!}</td>
                      @if(!empty($cat['name'][$i]))
                      <td>{!!$cat['name'][$i]!!}</td>
                      @endif
                     @else
                     <td></td><td></td>
                    @endif
                  </tr>
                @endfor
              </thead>
        </table>
      </div>
      <div class="row">
        <div class="col-md-12 text-center">
          <a onClick="redirect();" class="btn btn-round btn-success">Export</a>    
         </div>
      </div>
    </div>
  </div>

  @endif
      <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>View Files</h2>
        </div><!-- .card-header -->
        @if(!$files->count())
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                You don't have any exported excel file.
            </div>    
        @else
        <div class="card-body card-padding">
          <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
            <table class="table table-striped responsive-utilities jambo_table ">
                  <thead>
                    <tr>
                      <th>S.No.</th><th>File Name</th><th>Attributes Of (Product Name)</th><th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $i = 0;?>
                  @foreach($files as $file)
                      <tr>
                          <td>{!!$i+1!!}</td>
                          <td>{!!$file->filename!!}</td>
                          <td>{!!$product_name[$i]!!}</td>
                          <td><a href="{!!route('import_product.download', $file->filename)!!}"><i class="zmdi zmdi-download zmdi-hc-fw"></i></a></td>
                      </tr>
                      <?php $i++;?>
                  @endforeach
                  </tbody>
            </table>
          </div>
        </div>
    </div>
  @endif
       <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>Import Products</h2>
        </div><!-- .card-header -->
        
        <div class="card-body card-padding">
            <div class="row">
                <div style="background-color: #70db70;" class="col-sm-12">
                    <b>If you don't have a the Excel file for Import Products, to export a Sample Excel File, Please Click on the "Show Details" Button from the Above Products and then Click on the "Export" Button. Fill the details Under the Product Values Column and then Import the File.</b>
                </div>
            </div>
            
            <div class="progress progress-striped active" style="display:none;">
                <div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
            </div>
            <br/>
            <br/>
               {!! Form::open(['route'=>'import_product.store', 'method'=>'POST', 'files' => true])!!}
                  <div class="row">
                      <div class="col-sm-12">
                          {!! Form::label('file','Browse File',array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12"))!!}
                          <div class="fileinput fileinput-new" data-provides="fileinput">
                              <span class="btn btn-primary btn-file m-r-10">
                                  <span class="fileinput-new">Select file</span>
                                  <span class="fileinput-exists">Change</span>
                                  <input type="file" name="import_file" id="file" >
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
                          <a href="{!!route('import_product.list_product')!!}" class="btn btn-round btn-default process">Cancel</a>
                      </div>
                    </div>
               </div>
               {!! Form::close() !!}
        </div>
    </div>    

      <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>Import Information</h2>
<!--            <a href="{!!route('import_product.import')!!}" class="btn btn-default">Import</a>
            <a href="{!!route('import_product.list_product')!!}" class="btn btn-default">List Product</a>-->
        </div><!-- .card-header -->
        @if(!$import_info->count())
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                You have not imported any excel file.
            </div>    
        @else
        <div class="card-body card-padding">
          <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
            <table class="table table-striped responsive-utilities jambo_table ">
                  <thead>
                    <tr>
                      <th>S.No.</th><th>Import Id</th><th>Import Time</th><th>No Of Products</th><th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $i = 0;?>
                  @foreach($import_info as $info)
                      <tr>
                          <td>{!!$i+1!!}</td>
                          <td>{!!$info->id!!}</td>
                          <td>{!!$info->import_time!!}</td>
                          <td>{!!$info->no_products!!}</td>
                          <td><a href="{!!route('import_product.list_product', ['info_id' => $info->id])!!}"><i class="zmdi zmdi-eye zmdi-hc-fw"></i> View Details</a></td>
                      </tr>
                      <?php $i++;?>
                  @endforeach
                  </tbody>
            </table>
          </div>
        </div>
    </div>
  @endif
  @if($term == 5)
      <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>Products List</h2>
<!--            <a href="{!!route('import_product.import')!!}" class="btn btn-default">Import</a>
            <a href="{!!route('import_product.list_product')!!}" class="btn btn-default">List Product</a>-->
        </div><!-- .card-header -->
        @if(!$product_details->count())
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                You have not any new product.
            </div>    
        @else
        <div class="card-body card-padding-sm">
            <div class="row">
                @foreach( $product_details as $product )
                    <div class="col-md-12 ">
                      @if(empty($product->thumb))
                      <div class="alert alert-warning alert-dismissible" role="alert">
                          You have not uploaded the product image please upload the product image <a href="{!!route('import_product.edit', $product->id)  !!}" class="btn btn-default">Upload</a>
                      </div>
                      @endif
                        <div class="col-md-3">
                            <a href="{!! route('products/show', $product->id)  !!}" class="prod_thumb">
                            @if (!empty($product->thumb)) 

                              <img src="{!! asset($product->thumb_path.$product->thumb) !!}" alt="prodcuct" width="100px;" height="100px;"/>
                            @else
                              <img src="{{ asset('images/product_img.png') }}" alt="prodcuct" width="100px;" height="100px;"/>
                            @endif
                            </a>
                        </div>
                        <div class="col-md-3">
                         @if(!empty($product->desc))
                            <p>Post Date: {!! $product->desc  !!}</p>
                          @endif
                         </div>
                        <div class="col-md-3">
                         @if(!empty($product->postdate))
                            <p>Post Date: {!!  $product->postdate  !!}</p>
                          @endif
                         </div>
                          <div class="col-md-3">
                            <a href="{!!route('import_product.edit', $product->id)  !!}" class="btn btn-default"><i class="zmdi zmdi-edit zmdi-hc-fw"></i>Edit</a>
                      @if($product->status === "disabled")
                      <a href="{!!route('import_product.toggle', [$product->id, 'status'=>'enabled'])!!}"data-toggle="tooltip" data-placement="bottom" title="Enable" class="btn btn-default">Enable On Site</a>
                      @else
                      <a href="{!!route('import_product.toggle', [$product->id, 'status'=>'disabled'])!!}" data-toggle="tooltip" data-placement="bottom" title="Disable" class="btn btn-default">Disable From Site</a>
                      @endif
                         </div>
                    </div>
                    <div class="col-md-12 ">                                    
                        <br/>
                        <hr/>
                    </div>
                  @endforeach
              </div>
        </div><!-- .card-body -->
    </div>
    @endif
  @endif
@endsection    
@section('footer_add_js_script')

<script type="text/javascript">
  function goBack() {
         window.history.back();
  }
</script>
 <script type="text/javascript">
    function redirect()
    {
    var url = "{!!route('import_product.list_product', ['export_id' => $product->id])!!}";
    window.location.href=url;
    }
 </script>

@endsection
