@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <h2>{!!$fm_data['labels']['form_title']!!}</h2>
@endsection

@section('right_col_title_right')
<br>
<br>
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
          <h2>Seller Reviews and Rating</h2>
        </div>
        
          <div class="card-body card-padding">        
            <div class="row">
                <div class="col-md-2">
                  <div class="totalstars">                    
                    {!! round($seller_avg_rating, 1) !!}
                  </div>         
                  Average Rating<br/>
                  Based on {!! $seller_all_reviews->count() !!}  reviews                    
                </div>
                <div class="col-md-3">
                    <div class="g-stars">
                        <i class="zmdi zmdi-star zmdi-hc-fw star-result"></i> 
                        <i class="zmdi zmdi-star zmdi-hc-fw star-result"></i> 
                        <i class="zmdi zmdi-star zmdi-hc-fw star-result"></i> 
                        <i class="zmdi zmdi-star zmdi-hc-fw star-result"></i> 
                        <i class="zmdi zmdi-star zmdi-hc-fw star-result"></i> 
                        ({!! $seller_rating_5 !!})
                        <div class="progress">
                            @if($seller_rating_5==0)
                              {!!  $s_val_5 = 0 !!}
                            @else
                                {!! $s_val_5 = ($seller_rating_5/ $seller_all_reviews->count() )*100 !!}
                            @endif
                            
                            <div class="progress-bar" style="width: {!! $s_val_5 !!}%;">
                              <span class="sr-only"></span>
                            </div>
                        </div>                    
                    </div>
                    <div class="g-stars">
                        <i class="zmdi zmdi-star zmdi-hc-fw star-result"></i> 
                        <i class="zmdi zmdi-star zmdi-hc-fw star-result"></i> 
                        <i class="zmdi zmdi-star zmdi-hc-fw star-result"></i> 
                        <i class="zmdi zmdi-star zmdi-hc-fw star-result"></i> 
                        ({!! $seller_rating_4 !!})
                        <div class="progress">
                            @if($seller_rating_4==0)
                               {!! $s_val_4= 0 !!}
                            @else
                                {!! $s_val_4 = ($seller_rating_4/ $seller_all_reviews->count())*100 !!}
                            @endif
                           <div class="progress-bar" style="width: {!! $s_val_4 !!}%;">
                              <span class="sr-only"></span>
                            </div>
                        </div>                    
                    </div>
                    <div class="g-stars">
                        <i class="zmdi zmdi-star zmdi-hc-fw star-result"></i> 
                        <i class="zmdi zmdi-star zmdi-hc-fw star-result"></i> 
                        <i class="zmdi zmdi-star zmdi-hc-fw star-result"></i> 
                        ({!! $seller_rating_3 !!})
                        <div class="progress">
                            @if($seller_rating_3==0)
                              {!!  $s_val_3 = 0 !!}
                            @else
                               {!! $s_val_3 = ($seller_rating_3/ $seller_all_reviews->count())*100 !!}
                            @endif
                            <div class="progress-bar" style="width: {!! $s_val_3 !!}%;">
                              <span class="sr-only"></span>
                            </div>
                        </div>                    
                    </div>
                    <div class="g-stars">
                        <i class="zmdi zmdi-star zmdi-hc-fw star-result"></i> 
                        <i class="zmdi zmdi-star zmdi-hc-fw star-result"></i> 
                        ({!! $seller_rating_2 !!})
                        <div class="progress">
                            @if($seller_rating_2==0)
                                {!! $s_val_2 = 0 !!}
                            @else
                                {!! $s_val_2 = ($seller_rating_2/ $seller_all_reviews->count())*100 !!}
                            @endif
                            <div class="progress-bar" style="width: {!! $s_val_2 !!}%;">
                              <span class="sr-only"></span>
                            </div>
                        </div>                    
                    </div>
                    <div class="g-stars">
                        <i class="zmdi zmdi-star zmdi-hc-fw star-result"></i> 
                        ({!! $seller_rating_1 !!})
                        <div class="progress">
                            @if($seller_rating_1==0)
                               {!! $s_val_1 = 0 !!}
                            @else
                                {!! $s_val_1= ($seller_rating_1/ $seller_all_reviews->count())*100 !!}
                            @endif
                            <div class="progress-bar" style="width: {!! $s_val_1 !!}%;">
                              <span class="sr-only"></span>
                            </div>
                        </div>                    
                    </div>
                </div>
            </div>  
       </div>
        
        
        @if ( !$get_reviews->count())
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"></span></button>
                There are no Reviews for this Seller
            </div>                 
        @else
        <div class="text-right col-md-12">
            {!! $get_reviews->render() !!}             
        </div>
        <div class="card-body card-padding">
            @foreach($get_reviews as $reviews)
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
                      <span class="rating filled" style="width:
                            {!! round(($reviews->rating/5 * 100), 2) !!}%;">
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
                
            </div>
            <br/>
            @endforeach
            <div class="text-right col-md-12">
                {!! $get_reviews->render() !!}             
            </div>
        </div>
    @endif
    </div>
@endsection


@section('footer_add_js_script')
<script>
function goBack() {
    window.history.back();
}
</script>
@endsection