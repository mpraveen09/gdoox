  @extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
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
        <h2>{!!$product->desc!!} Detail</h2>
        <a href="{!!route('import_product.import')!!}" class="btn btn-default">Import</a>
        <a href="{!!route('import_product.list_product')!!}" class="btn btn-default">List Product</a>
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
@endsection    
@section('footer_add_js_files') 
<script type="text/javascript">
  function goBack() {
         window.history.back();
  }
</script>
 <script type="text/javascript">
    function redirect()
    {
    var url = "{!!route('import_product.export', $product->id)!!}";
    window.location.href=url;
    }
 </script>
 @endsection