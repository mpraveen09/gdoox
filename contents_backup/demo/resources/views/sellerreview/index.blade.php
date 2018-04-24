@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <h2>Seller Review</h2>
@endsection

@section('right_col_title_right')
    <a href="{!! route('sellerreview.index')  !!}" class="btn btn-round btn-default">View All</a>
    <button onclick="goBack()" class="btn btn-primary waves-effect">Back</button>
@endsection

@section('right_col')
    <!-- will be used to show any messages -->
    @if (Session::has('message'))
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!!  Session::get('message')  !!}
        </div>           
    @endif
    
    @include('navigation_tabs.marketing_tabs')
    <div class="card">
        <div class="card-header bgm-blue">
          <h2>Seller Review</h2>
        </div>
        @if ( !$all_seller_reviews->count())
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"></span></button>
                There are no Reviews for this Seller
            </div>                 
        @else
        <div class="text-right col-md-12">
            {!! $all_seller_reviews->render() !!}             
        </div>
        <div class="card-body card-padding">
            @foreach($all_seller_reviews as $reviews)
            <div class="row">
                <div class="col-md-2">
                  @if(!empty($reviews->name))
                  {!! $reviews->name !!}
<!--                    {!! HTML::linkRoute('seller_review_details',$reviews->name,array('userid'=>$reviews->userid,'shopid'=>$reviews->shopid,'prod_id'=>$reviews->product_id)) !!}-->
                  @endif
                  <div class="g-stars">
                    <div class="g-stars-total g-stars" title="{!! $reviews->rating !!} stars">
                      <span class="unfilled">
                        <i class="zmdi zmdi-star-outline zmdi-hc-fw"></i>
                        <i class="zmdi zmdi-star-outline zmdi-hc-fw"></i>
                        <i class="zmdi zmdi-star-outline zmdi-hc-fw"></i>
                        <i class="zmdi zmdi-star-outline zmdi-hc-fw"></i>
                        <i class="zmdi zmdi-star-outline zmdi-hc-fw"></i>                                      
                      </span>
                      <span class="rating filled" style="width:{!! round(($reviews->rating/5 * 100), 2) !!}%;">
                        <i class="zmdi zmdi-star zmdi-hc-fw star-filled"></i>
                        <i class="zmdi zmdi-star zmdi-hc-fw star-filled"></i>
                        <i class="zmdi zmdi-star zmdi-hc-fw star-filled"></i>
                        <i class="zmdi zmdi-star zmdi-hc-fw star-filled"></i>
                        <i class="zmdi zmdi-star zmdi-hc-fw star-filled"></i>
                      </span>
                        <div  class="filled">
                            {!! $reviews->created_at->format('d-m-Y') !!}
                        </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-10">
                  @if(!empty($reviews->review_title))
                  <strong>{!! $reviews->review_title !!} </strong>
                  <br/>
                  @endif
                  @if(!empty($reviews->review))
                    {!! $reviews->review !!} 
                  @endif
                </div>
                <div class="col-md-12"><a href="{!! route('sellerreview.edit', $reviews->_id)  !!}"class="">Edit</a></div>
                
            </div>
            <br/>
            @endforeach
            <div class="text-right col-md-12">
                {!! $all_seller_reviews->render() !!}             
            </div>
        </div>
    @endif
    </div>
    
    
<!--    <div class="card">
        <div class="card-header bgm-blue">
          <h2>Seller Review</h2>
        </div> .card-header 
        
            @if ( !$all_seller_reviews->count())
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    You have no Reviews
                </div>                 
            @else
             <div class="card-body card-padding"> 
               @foreach($all_seller_reviews as $reviews)
                    <h6>@if(!empty($reviews->review_title)){!! $reviews->review_title !!} @endif</h6>
                    <h5>@if(!empty($reviews->name)){!! $reviews->name !!} @endif</h5>
                    <div>@if(!empty($reviews->review)){!! $reviews->review !!} @endif</div>
                    <div><a href="{!! route('sellerreview.edit', $reviews->_id)  !!}"class="">Edit</a></div>
                    <hr/>
                @endforeach
            </div>
            @endif
    </div>-->
@endsection

@section('footer_add_js_script')
<script>
function goBack() {
    window.history.back();
}
</script>
@endsection