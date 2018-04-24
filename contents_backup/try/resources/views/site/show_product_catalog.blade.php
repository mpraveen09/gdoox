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
                            <h2>{!! $fm_data->labels['uploaded_product_catalog'] !!}</h2>
                      </div><!-- .card-header -->
                      <!-- will be used to show any messages -->
                      <div class="card-body card-padding">  
                          <div class="row">
                              <div class="form-group clearfix">
                                    <div class="thumb col-xs-12">
                                        @if(!empty($get_catalog->product_catalog))
                                          <embed src="{{asset($get_catalog->product_catalog)}}" width="800" height="800">
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
              
              
            @if(Auth::user())
            <?php $subuserid=isset($subuser->sub_user_id)?$subuser->sub_user_id :"";?>
            @if(Auth::user()->id === $storename->user_id || (Auth::user()->id === $subuserid 
                            && in_array($shopid, $site) ) )
                  <div class="card-body card-padding">
                      <a href="{!!route('addcatalog/{store}',$shopid)!!}" type="submit" class="btn btn-default">
                        Edit
                      </a>
                  </div>
             @endif
             @endif
             </div><!-- .card -->    
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