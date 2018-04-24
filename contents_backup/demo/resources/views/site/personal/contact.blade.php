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
                        <img src="{{ asset('uploads/site_images') }}/{{ $siteimage->site_images }}" alt="" >
                      </a>
                    @else
                      <img src="{{ asset('uploads/site_images') }}/{{ $siteimage->site_images }}" alt="" >                
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
                      <h2>Contact</h2>
              </div>
              <div class="card-body card-padding">
                <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                     <table class="table table-striped responsive-utilities jambo_table ">
                          <tbody>
                                    @if($personalsitedetails->general_info['first_name'])
                                     <tr>
                                         <td class="col-md-4">{!!$fm_data->labels['first_name']!!}</td>
                                         <td>{!!$personalsitedetails->general_info['first_name']!!}</td>
                                     </tr>
                                    @endif
                                    
                                    @if($personalsitedetails->general_info['second_name'])
                                     <tr>
                                         <td>{!!$fm_data->labels['second_name']!!}</td>
                                         <td>{!!$personalsitedetails->general_info['second_name']!!}</td>
                                     </tr>
                                    @endif
                                    
                                    @if($personalsitedetails->general_info['surname'])
                                     <tr>
                                         <td>{!!$fm_data->labels['surname']!!}</td>
                                         <td>{!!$personalsitedetails->general_info['surname']!!}</td>
                                     </tr>
                                    @endif
                                    
                                    @if($personalsitedetails->general_info['initials'])
                                     <tr>
                                         <td>{!!$fm_data->labels['initials']!!}</td>
                                         <td>{!!$personalsitedetails->general_info['initials']!!}</td>
                                     </tr>
                                    @endif
                                    
                                    @if($personalsitedetails->general_info['dob'])
                                     <tr>
                                         <td>{!!$fm_data->labels['dob']!!}</td>
                                         <td>{!!$personalsitedetails->general_info['dob']!!}</td>
                                     </tr>
                                    @endif
                                    
                                    @if($personalsitedetails->general_info['street_add'])
                                     <tr>
                                         <td>{!!$fm_data->labels['street_add']!!}</td>
                                         <td>{!!$personalsitedetails->general_info['street_add']!!}</td>
                                     </tr>
                                    @endif
                                    
                                    @if($personalsitedetails->general_info['city'])
                                     <tr>
                                         <td>{!!$fm_data->labels['city']!!}</td>
                                         <td>{!!$personalsitedetails->general_info['city']!!}</td>
                                     </tr>
                                    @endif
                                    
                                    @if($personalsitedetails->general_info['country'])
                                     <tr>
                                         <td>{!!$fm_data->labels['country']!!}</td>
                                         <td>{!!$personalsitedetails->general_info['country']!!}</td>
                                     </tr>
                                    @endif
                                    
                                    @if($personalsitedetails->general_info['country_area'])
                                     <tr>
                                         <td>{!!$fm_data->labels['country_area']!!}</td>
                                         <td>{!!$personalsitedetails->general_info['country_area']!!}</td>
                                     </tr>
                                    @endif
                                    
                                    @if($personalsitedetails->general_info['private_ph_no'])
                                     <tr>
                                         <td>{!!$fm_data->labels['private_ph_no']!!}</td>
                                         <td>{!!$personalsitedetails->general_info['private_ph_no']!!}</td>
                                     </tr>
                                    @endif
                                    
                                    @if($personalsitedetails->general_info['private_mob_no'])
                                     <tr>
                                         <td>{!!$fm_data->labels['private_mob_no']!!}</td>
                                         <td>{!!$personalsitedetails->general_info['private_mob_no']!!}</td>
                                     </tr>
                                    @endif
                                    
                                    @if($personalsitedetails->general_info['business_ph_no'])
                                        @if($personalsitedetails->general_info['status_business_ph']=='1')
                                            <tr>
                                                <td>{!!$fm_data->labels['business_ph_no']!!}</td>
                                                <td>{!!$personalsitedetails->general_info['business_ph_no']!!}</td>
                                            </tr>
                                        @endif
                                    @endif
                                    
                                    @if($personalsitedetails->general_info['business_mob_no'])
                                        @if($personalsitedetails->general_info['status_business_mob']=='1')
                                            <tr>
                                                <td>{!!$fm_data->labels['business_mob_no']!!}</td>
                                                <td>{!!$personalsitedetails->general_info['business_mob_no']!!}</td>
                                            </tr>
                                        @endif
                                    @endif
                                    
                                    @if($personalsitedetails->general_info['skype'])
                                        @if($personalsitedetails->general_info['status_skype']=='1')
                                            <tr>
                                                <td>{!!$fm_data->labels['skype']!!}</td>
                                                <td>{!!$personalsitedetails->general_info['skype']!!}</td>
                                            </tr>
                                        @endif
                                    @endif
                                    
                                    @if($personalsitedetails->general_info['msm'])
                                     <tr>
                                         <td>{!!$fm_data->labels['msm']!!}</td>
                                         <td>{!!$personalsitedetails->general_info['msm']!!}</td>
                                     </tr>
                                    @endif
                                    
                                    @if($personalsitedetails->general_info['blackberry'])
                                     <tr>
                                         <td>{!!$fm_data->labels['blackberry']!!}</td>
                                         <td>{!!$personalsitedetails->general_info['blackberry']!!}</td>
                                     </tr>
                                    @endif
                                    
                                    @if($personalsitedetails->general_info['personal_email'])
                                     <tr>
                                         <td>{!!$fm_data->labels['personal_email']!!}</td>
                                         <td>{!!$personalsitedetails->general_info['personal_email']!!}</td>
                                     </tr>
                                    @endif
                                    
                                    @if($personalsitedetails->general_info['business_email'])
                                     <tr>
                                         <td>{!!$fm_data->labels['business_email']!!}</td>
                                         <td>{!!$personalsitedetails->general_info['business_email']!!}</td>
                                     </tr>
                                    @endif
                            </tbody>
                     </table>
                </div>
                @if(Auth::user())
                @if(Auth::user()->id==$personalsitedetails->user_id)
                  <div class="card-body card-padding">
                      <a href="{!!route('professional-skills-edit',$personalsitedetails->user_id)!!}" type="submit" class="btn btn-default">
                        Edit
                      </a>
                  </div>
                @endif
                @endif
              </div>
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

