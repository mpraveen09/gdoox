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
        @if(!empty( $sitelogo->site_logo ))
            {{ asset('uploads/site_logo') }}/{!!  $sitelogo->site_logo !!}
        @elseif(!empty($business->logo) )
            {{ asset($business->logo_path.$business->logo) }}
        @else
            {{ asset('images/gdoox.png') }}
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
     
@include('site.quick-menu')
      
      <div class="row">
        <div class="col-md-12">
            <div class="card">
             <div class="card-header bgm-blue">
                   <h2>{!! $fm_data->labels['product_catalog'] !!}</h2>
             </div><!-- .card-header -->
             <div class="card-body card-padding-sm">
                <div class="row">
                  @foreach($productcatalog as $catalog)
                  <div class="col-md-3">
                      <div class="thumb">
                          <embed src="{{asset($catalog->product_catalog_path.$catalog->product_catalog)}}" style="width:120px;">
                      </div>
                    <a href="{!! route('productcatalog.show', [$catalog->_id])  !!}" target="_blank">Preview</a>
                  </div>
                  @endforeach
                </div>
              </div>
            @if(Auth::user())
          <?php $subID=isset($subid)?$subid:array();?>
            @if(Auth::user()->id === $storename->user_id || ( in_array(Auth::user()->id, $subID) && in_array($shopid, $site) ) )
                  <div class="card-body card-padding">
                      <a href="{!!route('productcatalog')!!}" class="btn btn-default">Edit</a>
                  </div>
             @endif
             @endif
             </div>
            @include('site.bottom_contactform')
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