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
    <div class="card clearfix">
        <div class="card-header card-padding-sm">
            <h2>{!! $cmspage_selected->page_title !!}</h2>
        </div>

        <div class="card-body card-padding">
            {!! stripslashes($cmspage_selected->description) !!}
      @if(Auth::user())
            <div class="card-body card-padding">
              <a href="{!!route('cms.index', ['id' => $cmspage_selected->id])!!}" class="btn btn-default">
                  Edit
                </a>
            </div>
       @endif
        </div>
       @if($cmspage_selected->type)
          <div class="form-group clearfix">
             <div class="col-md-6 col-md-offset-3">
               <a id="send" type="submit" class="btn btn-round btn-success" href="{!!route('cms.storetemp', [$cmspage_selected->slug, preg_replace('/[^a-zA-Z]+/', '', $cmspage_selected->page_title), $cmspage_selected->id])!!}" >Save</a>
               <a id="send" type="submit" class="btn btn-round btn-primary" href="{!!route('cms.index', ['id' => $cmspage_selected->id])!!}">Edit</a>
             </div>
         </div>
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