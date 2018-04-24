@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <!--<h2>Business Ecosystem</h2>-->
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
    
    <div class="row">
        <div class="col-md-12">
          <div class="card">
              <div class="card-header card-padding-sm bgm-blue head-title">
                  <h2><i class="zmdi zmdi-account m-r-5"></i> Import Products from Partners Site</h2>
                  <button onclick="goBack()" class="btn btn-primary waves-effect">Back</button>
              </div>
              
              <div id="error_div"></div>
              
              <div class="card-body card-padding">
                    <div class="row">
                        <div class="text-right col-md-12">
                            {!! $list_products->appends(['slug'=>$ecosystemsite,'site'=>$site])->render() !!}
                        </div>
                    </div>
                    <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                        @if(!$list_products->count())
                            <div class="card-body card-padding">
                                <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                                     There are no Products in this store to Share.
                                </div>
                             </div> 
                        @else
                            <table class="table table-striped responsive-utilities jambo_table ">
                                <thead>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </thead>

                                 <tbody>
                                    @foreach($list_products as $products)
                                    <tr data_id="{!! $products->_id !!}">
                                        <td><img width=40px" height="40px" alt="Product" src="{!! asset($products->thumb_path.$products->thumb) !!}"/></td>
                                        <td>{!! $products->desc !!}</td>
                                        <td>{!! $products->created_at !!}</td>
                                        <td>
                                            {!! Form::open(['route'=>'import.shared.product']) !!}
                                                <input type="hidden" id="productid" name="productid" value="{!! $products->_id !!}">
                                                <input type="hidden" id="ecosystemsite" name="ecosystemsite" value="{!! $ecosystemsite !!}">
                                                <input type="hidden" id="site" name="site" value="{!! $site !!}">
                                                <button type="submit" id="import_product" class="btn btn-primary waves-effect importproduct">Import</button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                    @endforeach
                                  </tbody>
                             </table>
                         @endif
                    </div>
                    <div class="row">
                        <div class="text-right col-md-12">
                            {!! $list_products->appends(['slug'=>$ecosystemsite,'site'=>$site])->render() !!}
                        </div>
                    </div>
              </div>    
          </div>               
        </div>      
      </div>
    
@endsection
@section('footer_add_js_script')

<script type="text/javascript">
    function goBack() {
        window.history.back();
    }
</script>
@endsection

