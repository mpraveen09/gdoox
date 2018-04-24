  @extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2> Import Products</h2>-->
<!--<div class="page-top-links">-->

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
            <h2>Import Information</h2>
            <a href="{!!route('import_product.import')!!}" class="btn btn-default">Import</a>
            <a href="{!!route('import_product.list_product')!!}" class="btn btn-default">List Product</a>
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
                          <td><a href="{!!route('import_product.new_list', $info->id)!!}"><i class="zmdi zmdi-eye zmdi-hc-fw"></i> View Details</a></td>
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