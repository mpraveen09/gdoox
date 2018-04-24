@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <!--<h3> {!!  $product->desc   !!}</h3>-->
    <!--<div class="page-top-links">-->
    <!--</div>-->
@endsection

@section('right_col_title_right')
@endsection

@section('right_col')

    <!-- will be used to show any messages -->
    @if (Session::has('message'))
        <div class="alert alert-info">{!!  Session::get('message')  !!}</div>
    @endif

    <div class="card">
        <div class="card-header bgm-blue head-title">
          <h2>View</h2>
          <a href="{!! route('products/list')  !!}" class="btn btn-round btn-default">View All</a>
        </div><!-- .card-header -->
        <div class="card-body card-padding">    
              <div class="row">
                  <div class="col-md-12 ">
                      @foreach( $productTabs as $productTab )
                              {!!  $productTab   !!}
                      @endforeach 
                  </div>
              </div>
        </div>
    </div>
@endsection


