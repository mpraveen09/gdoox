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
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!!  Session::get('message')  !!}
        </div>
    @endif
    
    <div class="card">
            <div class="card-header bgm-blue head-title">
                    <h2>Product Catalog</h2>
                    <button id="cancel_btn" onclick="goBack()" type="button" class="btn btn-round btn-default">Back</button>
            </div><!-- .card-header -->
            <!-- will be used to show any messages -->
            <div class="card-body card-padding">  
                <div class="row">
                    <div class="form-group clearfix">
                          <div class="thumb col-xs-12">
                              @if(!empty($get_catalog->product_catalog))
                                <embed src="{{asset($get_catalog->product_catalog_path.$get_catalog->product_catalog)}}" width="800" height="800">
                              @else
                              <div class="alert alert-info alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                No Preview Available 
                            </div>
                              @endif
                          </div> 
                    </div>
                </div>
            </div>
    </div><!-- .card -->        
@endsection

@section('footer_add_js_script') 
<script>
function goBack() {
    window.history.back();
}
</script>
@endsection


