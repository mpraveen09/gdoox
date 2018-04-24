@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <h2>Product Reviews</h2>
@endsection

@section('right_col_title_right')
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
    <div class="card">
        <div class="card-header bgm-blue">
          <h2>Your Review</h2>
        </div><!-- .card-header -->
        
            @if ( !$all_user_reviews->count() )
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    You have no Reviews
                </div>                 
            @else
            
            <div class="card-body card-padding">
                @foreach($all_user_reviews as $reviews)
                <div class="row">
                    
                        <div class="col-md-2">
                          <div>                    
                             <img src="{!!  $reviews->thumb  !!}" alt="Product" />
                          </div>         
                          <br/>                  
                        </div>
                        <div class="col-md-10">
<!--                        <h5>@if(!empty($reviews->name)) {!! $reviews->name !!} @endif</h5>-->
                        <h6>@if(!empty($reviews->review_title)){!! $reviews->review_title !!} @endif</h6>
                        <div>
                            @if(!empty($reviews->rating) && isset($reviews->rating))
                                    @if($reviews->rating=='1')
                                        <div class="rating-select">
                                            <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw btn-warning selected" data_id="1"></i>
                                            <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw" data_id="2"></i>
                                            <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw" data_id="3"></i>
                                            <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw" data_id="4"></i>
                                            <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw" data_id="5"></i>
                                        </div>
                                      @elseif($reviews->rating=='2')
                                        <div class="rating-select">
                                            <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw btn-warning selected" data_id="1"></i>
                                            <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw btn-warning selected" data_id="2"></i>
                                            <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw" data_id="3"></i>
                                            <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw" data_id="4"></i>
                                            <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw" data_id="5"></i>
                                        </div>
                                      @elseif($reviews->rating=='3')
                                        <div class="rating-select">
                                            <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw btn-warning selected" data_id="1"></i>
                                            <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw btn-warning selected" data_id="2"></i>
                                            <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw btn-warning selected" data_id="3"></i>
                                            <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw" data_id="4"></i>
                                            <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw" data_id="5"></i>
                                        </div>
                                      @elseif($reviews->rating=='4')
                                        <div class="rating-select">
                                            <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw btn-warning selected" data_id="1"></i>
                                            <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw btn-warning selected" data_id="2"></i>
                                            <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw btn-warning selected" data_id="3"></i>
                                            <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw btn-warning selected" data_id="4"></i>
                                            <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw" data_id="5"></i>
                                        </div>
                                      @elseif($reviews->rating=='5')
                                        <div class="rating-select">
                                            <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw btn-warning selected" data_id="1"></i>
                                            <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw btn-warning selected" data_id="2"></i>
                                            <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw btn-warning selected" data_id="3"></i>
                                            <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw btn-warning selected" data_id="4"></i>
                                            <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw btn-warning selected" data_id="5"></i>
                                        </div>
                                      @else
                                        <div class="rating-select">
                                            <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw" data_id="1"></i>
                                            <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw" data_id="2"></i>
                                            <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw" data_id="3"></i>
                                            <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw" data_id="4"></i>
                                            <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw" data_id="5"></i>
                                        </div>
                                      @endif     
                            @endif
                        </div>
                        <div>@if(!empty($reviews->review)){!! $reviews->review !!} @endif</div>
                        <div><a href="{!! route('userreview.edit', $reviews->_id)  !!}"class="">Edit</a></div>
                    <hr/>          
                </div>
            </div> 
            @endforeach 
        </div>
        @endif 
            
            
        <div class="text-right col-md-12">
            {!! $all_user_reviews->render() !!}             
        </div>

        <div class="text-right col-md-12">
            {!! $all_user_reviews->render() !!}             
        </div>
@endsection

@section('footer_add_js_script')
<script>
function goBack() {
    window.history.back();
}
</script>
@endsection