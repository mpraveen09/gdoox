@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <h2>{!!$fm_data['labels']['form_title']!!}</h2>
@endsection

@section('right_col_title_right')
<a href="{!! route('sellerreview.edit', $get_reviews->_id)  !!}"class="btn btn-round btn-primary">Edit</a>
<a href="{!! route('sellerreview.index')  !!}"class="btn btn-round btn-primary">View All</a>
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
          <h2>Your Review and Rating</h2>
        </div><!-- .card-header -->
        
        <div class="card-body card-padding">    
              <table class="table">
                  <tbody>
                      <tr>
                          <td>
                              @if(!empty($fm_data['labels']['review_title']))
                                {!! $fm_data['labels']['review_title'] !!}
                             @endif
                          </td>
                          <td>{!! $get_reviews->review_title !!}</td>
                      </tr>
                      
                      <tr>
                          <td>
                              @if(!empty($fm_data['labels']['your_rating']))
                                {!! $fm_data['labels']['your_rating'] !!}
                             @endif
                          </td>
                          <td>
                              @if($get_reviews->rating=='1')
                                <div class="rating-select">
                                    <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw btn-warning selected" data_id="1"></i>
                                    <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw" data_id="2"></i>
                                    <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw" data_id="3"></i>
                                    <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw" data_id="4"></i>
                                    <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw" data_id="5"></i>
                                </div>
                              @elseif($get_reviews->rating=='2')
                                <div class="rating-select">
                                    <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw btn-warning selected" data_id="1"></i>
                                    <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw btn-warning selected" data_id="2"></i>
                                    <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw" data_id="3"></i>
                                    <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw" data_id="4"></i>
                                    <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw" data_id="5"></i>
                                </div>
                              @elseif($get_reviews->rating=='3')
                                <div class="rating-select">
                                    <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw btn-warning selected" data_id="1"></i>
                                    <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw btn-warning selected" data_id="2"></i>
                                    <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw btn-warning selected" data_id="3"></i>
                                    <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw" data_id="4"></i>
                                    <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw" data_id="5"></i>
                                </div>
                              @elseif($get_reviews->rating=='4')
                                <div class="rating-select">
                                    <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw btn-warning selected" data_id="1"></i>
                                    <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw btn-warning selected" data_id="2"></i>
                                    <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw btn-warning selected" data_id="3"></i>
                                    <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw btn-warning selected" data_id="4"></i>
                                    <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw" data_id="5"></i>
                                </div>
                              @elseif($get_reviews->rating=='5')
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
                          </td>
                      </tr>

                      <tr>
                          <td>
                              @if(!empty($fm_data['labels']['your_review']))
                                {!! $fm_data['labels']['your_review'] !!}
                             @endif
                          </td>
                          <td>{!! $get_reviews->review !!}</td>
                      </tr>

                      <tr>
                          <td>
                              @if(!empty($fm_data['labels']['name']))
                                {!! $fm_data['labels']['name'] !!}
                             @endif
                          </td>
                          <td>{!! $get_reviews->name !!}</td>
                      </tr>
                  </tbody>
              </table>
        </div>
    </div>
@endsection

@section('footer_add_js_script')
<script>
function goBack() {
    window.history.back();
}
</script>
@endsection


