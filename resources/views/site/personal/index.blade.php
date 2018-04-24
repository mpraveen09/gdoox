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
    @if(isset($sitelogo->general_info['site_logo']))
        @if(!empty( $sitelogo->general_info['site_logo']))
            {{ asset($sitelogo->general_info['site_logo']) }}
        @else
            {{ asset('images/profile-placeholder.gif') }}
        @endif
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
      <div class="alert alert-info">{!! Session::get('message')  !!}</div>
  @endif      

  <div class="card site-banners">
      <div class="card-body">
        <ul class="bannerslider">      
            @if(count($siteimages))
                @foreach($siteimages as $siteimage)
                    <li>
                      @if(!empty($siteimage->url))
                        <a href="{{ $siteimage->url }}">
                          <img src="{{ asset($siteimage->site_images_path) }}/{{ $siteimage->site_images }}" alt="" >
                        </a>
                      @else
                        <img src="{{ asset($siteimage->site_images_path) }}/{{ $siteimage->site_images }}" alt="" >                
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
                    <h2><i class="zmdi zmdi-account m-r-5"></i> Summary</h2>
                </div>
              <div class="card-body card-padding">
                  @if( $sitetype === 'personal' )
                        @if($storename->about_us) 
                               {!! $storename->about_us !!}
                        @else
                        <div class="pmbb-view">There are no other Information</div>
                       @endif
                  @endif  
                  @if(Auth::user())
                  @if(Auth::user()->id === $personalsitedetails->user_id)
                    <div class="card-body card-padding">
                        <a href="{!!route('personal-about-us-edit', $personalsitedetails->user_id)!!}" type="submit" class="btn btn-default">Edit</a>
                    </div>
                  @endif
                  @endif
              </div>
          </div>
        </div>
      </div>  

@include('site.personal.bottom_contactform')  

@endsection


@section('footer_add_js_script')
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