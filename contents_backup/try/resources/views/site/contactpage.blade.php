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

              <div class="card-header card-padding-sm">
                  <h2>Contact Us</h2>
                  <!--$fm_data->labels['contact_info']-->
              </div>

              <div class="card-body card-padding">
                <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                     <table class="table table-striped responsive-utilities jambo_table ">
                          <tbody>
                          @if($sitetype==='personal')
                            @if($storename->street_add)
                             <tr>
                                 <td class="col-md-4">{!!$fm_data->labels['street_add']!!}</td>
                                 <td>{!!$storename->street_add!!}</td>
                             </tr>
                            @endif
                            @if($storename->city)
                             <tr>
                                 <td class="col-md-4">{!!$fm_data->labels['city']!!}</td>
                                 <td>{!!$storename->city!!}</td>
                             </tr>
                            @endif
                            @if($storename->country)
                             <tr>
                                 <td>{!!$fm_data->labels['country']!!}</td>
                                 <td>{!!$storename->country!!}</td>
                             </tr>
                            @endif
                            @if($storename->zip)
                             <tr>
                                 <td>{!!$fm_data->labels['zip']!!}</td>
                                 <td>{!!$storename->zip!!}</td>
                             </tr>
                            @endif
                            @if($storename->phone_no1)
                             <tr>
                                 <td>{!!$fm_data->labels['phone_no1']!!}</td>
                                 <td>{!!$storename->phone_no1!!}</td>
                             </tr>
                            @endif
                            @if($storename->fax_no)
                             <tr>
                                 <td>{!!$fm_data->labels['phone_no2']!!}</td>
                                 <td>{!!$storename->phone_no2!!}</td>
                             </tr>
                            @endif
                            @if($storename->city)
                             <tr>
                                 <td>{!!$fm_data->labels['fax_no']!!}</td>
                                 <td>{!!$storename->fax_no!!}</td>
                             </tr>
                            @endif
                            @if($storename->mobile)
                             <tr>
                                 <td>{!!$fm_data->labels['mobile']!!}</td>
                                 <td>{!!$storename->mobile!!}</td>
                             </tr>
                            @endif
                            @if($storename->skype)
                             <tr>
                                 <td>{!!$fm_data->labels['skype']!!}</td>
                                 <td>{!!$storename->skype!!}</td>
                             </tr>
                            @endif
                            @if($storename->business_email1)
                             <tr>
                                 <td>{!!$fm_data->labels['business_email1']!!}</td>
                                 <td>{!!$storename->business_email1!!}</td>
                             </tr>
                            @endif
                            @if($storename->business_email2)
                             <tr>
                                 <td>{!!$fm_data->labels['business_email2']!!}</td>
                                 <td>{!!$storename->business_email2!!}</td>
                             </tr>
                            @endif
                          @endif
                          
                          @if($sitetype==='business')
                            @if($business->street_add)
                             <tr>
                                 <td class="col-md-4">{!!$fm_data->labels['street_add']!!}</td>
                                 <td>{!!$business->street_add!!}</td>
                             </tr>
                            @endif
                           @if($business->city)
                             <tr>
                                 <td>{!!$fm_data->labels['city']!!}</td>
                                 <td>{!!$business->city!!}</td>
                             </tr>
                            @endif
                           @if($business->country)
                             <tr>
                                 <td>{!!$fm_data->labels['country']!!}</td>
                                 <td>{!!$business->country!!}</td>
                             </tr>
                            @endif
                           @if($business->zip)
                             <tr>
                                 <td>{!!$fm_data->labels['zip']!!}</td>
                                 <td>{!!$business->zip!!}</td>
                             </tr>
                            @endif
                           @if($business->phone_no1)
                             <tr>
                                 <td>{!!$fm_data->labels['phone_no1']!!}</td>
                                 <td>{!!$business->phone_no1!!}</td>
                             </tr>
                            @endif
                           @if($business->phone_no2)
                             <tr>
                                 <td>{!!$fm_data->labels['phone_no2']!!}</td>
                                 <td>{!!$business->phone_no2!!}</td>
                             </tr>
                            @endif
                            @if($business->fax_no)
                             <tr>
                                 <td>{!!$fm_data->labels['fax_no']!!}</td>
                                 <td>{!!$business->fax_no!!}</td>
                             </tr>
                            @endif
                           @if($business->mobile)
                             <tr>
                                 <td>{!!$fm_data->labels['mobile']!!}</td>
                                 <td>{!!$business->mobile!!}</td>
                             </tr>
                            @endif
                           @if($business->skype)
                             <tr>
                                 <td>{!!$fm_data->labels['skype']!!}</td>
                                 <td>{!!$business->skype!!}</td>
                             </tr>
                            @endif
                           @if($business->business_email1)
                             <tr>
                                 <td>{!!$fm_data->labels['business_email1']!!}</td>
                                 <td>{!!$business->business_email1!!}</td>
                             </tr>
                            @endif
                           @if($business->business_email2)
                             <tr>
                                 <td>{!!$fm_data->labels['business_email2']!!}</td>
                                 <td>{!!$business->business_email2!!}</td>
                             </tr>
                            @endif
                          @endif
                           </tbody>
                     </table>
                     </div>
            @if(Auth::user())
          <?php $subID=isset($subid)?$subid:array();?>
            @if(Auth::user()->id === $storename->user_id || ( in_array(Auth::user()->id, $subID) && in_array($shopid, $site) ) )
                  <div class="card-body card-padding">
                      <a href="{!!route('business-info-edit',$business->id)!!}" type="submit" class="btn btn-default">
                        Edit
                      </a>
                  </div>
             @endif
             @endif
              
          </div>      
        </div> 
           
           @include('site.bottom_contactform') 
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

