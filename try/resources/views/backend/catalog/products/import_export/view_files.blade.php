  @extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2> Import Products</h2>
<div class="page-top-links">
<a href="{!!route('import_product.import')!!}" class="btn btn-default">Import</a>
<a href="{!!route('import_product.list_product')!!}" class="btn btn-default">List Product</a>-->
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
    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>View Files</h2>
            <a href="{!!route('import_product.import')!!}" class="btn btn-default">Import</a>
            <a href="{!!route('import_product.list_product')!!}" class="btn btn-default">List Product</a> 
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

@endsection    
@section('footer_add_js_files') 
<script type="text/javascript">
  function goBack() {
        window.history.back();
  }
</script>
@endsection