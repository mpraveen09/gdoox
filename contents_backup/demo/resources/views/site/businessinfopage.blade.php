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
                  <h2>About Us</h2>
                  <!--$fm_data->labels['about_us']-->
              </div>
              
              <div class="card-body card-padding">
                <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                     <table class="table table-striped responsive-utilities jambo_table ">
                          <tbody>
                          @if($sitetype === 'personal')
                            @if($storename->site_name)
                             <tr>
                                 <td class="col-md-4">{!!$fm_data->labels['site_name']!!}</td>
                                 <td>{!!$storename->site_name!!}</td>
                             </tr>
                            @endif
                            @if($storename->category_name)
                             <tr>
                                 <td>{!!$fm_data->labels['category_name']!!}</td>
                                 @if(is_array($storename->category_name))
                                    <td>{!! implode(', <br/>', $storename->category_name) !!}</td>
                                 @else
                                    <td>{!! $storename->category_name !!}</td>
                                 @endif 
                             </tr>
                            @endif
                             @if($storename->desc)
                             <tr>
                                 <td>{!!$fm_data->labels['desc']!!}</td>
                                 <td>{!!$storename->desc!!}</td>
                             </tr>
                            @endif
                            @if($storename->tags)
                             <tr>
                                 <td>{!!$fm_data->labels['tags']!!}</td>
                                 <td>{!!$storename->tags!!}</td>
                             </tr>
                            @endif
                            @if($storename->org_type)
                             <tr>
                                 <td>{!!$fm_data->labels['org_type']!!}</td>
                                 <td>{!!$storename->org_type!!}</td>
                             </tr>
                            @endif
                            @if($storename->activity_type)
                             <tr>
                                 <td>{!!$fm_data->labels['activity_type']!!}</td>
                                 <td>{!!$storename->activity_type!!}</td>
                             </tr>
                            @endif 
                            @if($storename->operation)
                             <tr>
                                 <td>{!!$fm_data->labels['operation']!!}</td>
                                 <td>{!!$storename->operation!!}</td>
                             </tr>
                            @endif
                            @if($storename->brands)
                             <tr>
                                 <td>{!!$fm_data->labels['brands']!!}</td>
                                 <td>{!!$storename->brands!!}</td>
                             </tr>
                            @endif
                            @if($storename->market)
                             <tr>
                                 <td>{!!$fm_data->labels['market']!!}</td>
                                 <td>{!!$storename->market!!}</td>
                             </tr>
                            @endif 
                        @endif

                       
                        
                        @if($sitetype==='business') 
                           @if($business->company_name)
                             <tr>
                                 <td class="col-md-4">{!!$fm_data->labels['company_name']!!}</td>
                                 <td>{!!$business->company_name!!}</td>
                             </tr>
                           @endif
                           @if($storename->ecomm_company_name)
                             <tr>
                                 <td>{!!"Company Storename"!!}</td>
                                 <td>{!!$storename->ecomm_company_name!!}</td>
                             </tr>
                           @endif
                           
                           @if($business->desc)
                             <tr>
                                 <td>{!!$fm_data->labels['desc']!!}</td>
                                 <td>{!!$business->desc!!}</td>
                             </tr>
                           @endif
                           @if($business->tags)
                             <tr>
                                 <td>{!!$fm_data->labels['tags']!!}</td>
                                 <td>{!!$business->tags!!}</td>
                             </tr>
                           @endif
                           @if($business->org_type)
                             <tr>
                                 <td>{!!$fm_data->labels['org_type']!!}</td>
                                 @if(is_array($business->org_type))
                                    <td>{!! implode(', ', $business->org_type) !!}</td>
                                 @else
                                    <td>{!! $business->org_type !!}</td>
                                 @endif
                             </tr>
                           @endif
                            
                           @if($business->position)
                             <tr>
                                 <td>{!!$fm_data->labels['position']!!}</td>
                                 @if(is_array($business->position))
                                    <td>{!! implode(', ', $business->position) !!}</td>
                                 @else
                                    <td>{!! $business->position !!}</td>
                                 @endif
                             </tr>
                           @endif
                           @if($business->dimensions)
                             <tr>
                                 <td>{!!$fm_data->labels['dimensions']!!}</td>
                                 <td>{!!$business->dimensions!!}</td>
                             </tr>
                            @endif
                           @if($business->actvity_type)
                             <tr>
                                 <td>{!!$fm_data->labels['actvity_type']!!}</td>
                                 <td>{!!$business->actvity_type!!}</td>
                             </tr>
                            @endif
                           @if($business->operation)
                             <tr>
                                 <td>{!!$fm_data->labels['operation']!!}</td>
                                 <td>{!!$business->operation!!}</td>
                             </tr>
                           @endif
                           @if($business->brands)
                           <?php // echo "hello <pre>";print_r($business->brands); die;?>
                             <tr>
                                 <td>{!!$fm_data->labels['brands']!!}</td>
                                 <td>{!!$business->brands!!}</td>
                             </tr>
                           @endif
                           @if($business->payment_form)
                             <tr>
                                 <td>{!!$fm_data->labels['payment_form']!!}</td>
                                 @if(is_array($business->payment_form))
                                    <td>{!! implode(",", $business->payment_form) !!}</td>
                                 @else
                                    <td>{!! $business->payment_form !!}</td>
                                 @endif
                                 
                             </tr>
                            @endif
                           @if($business->credit_card)
                             <tr>
                                 <td>{!!$fm_data->labels['credit_card']!!}</td>
                                 @if(is_array($business->credit_card))
                                    <td>{!! implode(",", $business->credit_card) !!}</td>
                                 @else
                                    <td>{!! $business->credit_card !!}</td>
                                 @endif  
                             </tr>
                            @endif
                            @if($business->paypal)
                             <tr>
                                 <td>{!!$fm_data->labels['paypal']!!}</td>
                                 @if(is_array($business->paypal))
                                    <td>{!! implode(",", $business->paypal) !!}</td>
                                 @else
                                    <td>{!! $business->paypal !!}</td>
                                 @endif
                             </tr>
                           @endif
                           @if($business->return_policy)
                             <tr>
                                 <td>{!!$fm_data->labels['return_policy']!!}</td>
                                 <td>{!!$business->return_policy!!}</td>
                             </tr>
                            @endif
                           @if($business->market)
                             <tr>
                                 <td>{!!$fm_data->labels['market']!!}</td>
                                 <td>{!!$business->market!!}</td>
                             </tr>
                            @endif
                         @endif
                         </tbody>
                     </table>
                     </div>
                
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

