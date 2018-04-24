    @extends('layout.backend.master')
    @extends('layout.backend.userinfo')


@section('header_custom_css')        
<!--header_custom_css-->
<link href="{{ asset('/js/bxslider/bxslider.css') }}" rel="stylesheet">
<style>
  .bx-wrapper .bx-viewport {
    border: 0px solid #fff !important;
    left: 0 !important;
  }
  .bx-wrapper .bx-viewport li {
    left: 0 !important;
  }
  .bx-wrapper .bx-viewport li img{
    width: 100% !important;
  }
</style>  

<style>
    .ui-menu-item{
        width: 300px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;        
        font-size: 11px;
    }   
    .ui-widget-content{
        max-height: 400px;
        overflow: scroll;
    }
</style>    
@endsection

    @section('header-logo-url')
      {{ URL::to('/site/') }}/{!!  $shopid !!}
    @endsection
    @section('header-logo')
     @if(!empty( $sitelogo->profile_image ))
            {{ asset('uploads/profile_pics') }}/{!!$sitelogo->profile_image !!}
      @else
          {{ asset('images/profile-placeholder.gif') }}
      @endif
    @endsection

    @section('right_col_title')
        @include('site.sitemenu')
    @endsection


    @section('right_col')
      <!-- will be used to show any messages -->
      @if (Session::has('message'))
          <div class="alert alert-info">{!!  Session::get('message')  !!}</div>
      @endif

      
  <div class="card site-banners">
      <div class="card-body">
        <ul class="bannerslider">      
          @if(count($siteimages))
            @foreach($siteimages as $siteimage)
              <li>
                @if(!empty($siteimage->url))
                  <a href="{{ $siteimage->url }}">
                    <img src="{{ asset( $siteimage->site_images_path.$siteimage->site_images) }}" alt="" >
                  </a>
                @else
                  <img src="{{ asset($siteimage->site_images_path.$siteimage->site_images) }}" alt="" >                
                @endif
              </li>
            @endforeach
          @else
          <li><img src="{{ asset('images/marketplace.png') }}" alt="" style="width: 100%"></li>
          @endif
        </ul>
      </div>
  </div>

@include('site.personal.quick-menu')

      <div class="row">
        <div class="col-md-12">
          <div class="card">
              <div class="card-header card-padding-sm bgm-blue">
                  <h2>{!! $fm_data->labels['computer_skills'] !!}</h2>
              </div>
              
              @if($storename->other_info['computer_skills'])
              <div class="card-body card-padding">
                <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                     <table class="table table-striped responsive-utilities jambo_table ">
                          <tbody>
                            @if($sitetype==='personal')
                                @if($storename->other_info['computer_skills'])
                                 <tr>
                                     <td class="col-md-4">{!!$fm_data->labels['computer_skills']!!}</td>
                                     <td>{!! $storename->other_info['computer_skills'] !!}</td>
                                 </tr>
                                @endif
                            @endif
                           </tbody>
                     </table>
                     </div>
              </div> 
              @else 
              <div class="card-body card-padding">
                <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                     There are no Computer Skills.
                </div>
              </div> 
              @endif
              @if(Auth::user())
              @if(Auth::user()->id==$personalsitedetails->user_id)
                <div class="card-body card-padding">
                    <a href="{!!route('other-info-edit',$personalsitedetails->user_id)!!}" type="submit" class="btn btn-default">Edit</a>
                </div>
              @endif
              @endif
        </div>  
        @include('site.personal.bottom_contactform')                  
        </div>      
      </div>              
 @endsection

@section('footer_add_js_script')
<link rel="stylesheet" href="{{asset('/css/jquery-ui.css')}}">
<script src="{{asset('/js/jquery-ui.js')}}"></script>
<script type="text/javascript">
    jQuery(function($) {
        var shopid = '{!! $shopid !!}';
        $(".searchshopcategories").autocomplete({
            source: function( request, response ) {   
                $.ajax({
                    url: "{!! URL::route('auto_search_shop_categ')  !!}",
                    dataType: "json",
                    data: {
                            term: request.term,
                            shopid: shopid
                    },
                    success: function(json) {
                        response( $.map( json, function( item ) {
                            return {
                                value: item.attribute
                            }
                        }));
                    }
                });
            },
            autoFocus: true,
            minLength: 3,
            });
        });
</script>
<script src="{{ asset('/js/bxslider/bxslider.min.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function(){  
    $('.bannerslider').bxSlider({
      auto: true,
      adaptiveHeight: true,
      mode: 'horizontal'
    });
  });
</script> 
@endsection

