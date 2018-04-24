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
      .bx-wrapper .bx-viewport li img {
        width: 100% !important;
      }
    </style>  

    <style>
        .ui-menu-item {
            width: 300px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;        
            font-size: 11px;
        }   
        .ui-widget-content {
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
    
      {!! Form::model('$products_list', [
          'method' => 'GET',
          //'route' => ['filter-categories/{filter}'],
          'class' => 'form-label-left',
          'novalidate'=>''
      ]) !!} 

    @if(!empty($banner->site_images))
      <div class="card site-banners">
          <div class="card-body">
                <img src="{!!asset($banner->site_images_path.$banner->site_images)!!}" class="bannerslider" height="300">
          </div>
      </div>
    @else
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
    @endif
  <!-- will be used to show any messages -->
  @if (Session::has('message'))
      <div class="alert alert-info">{!!  Session::get('message')  !!}</div>
  @endif
  
  @if (!$products->count())
        <div class="alert alert-warning">You have no Products matching the Search Criteria</div>
        @include('site.quick-menu')
  @else
        @include('site.quick-menu')

    <?php $sale_type = !empty($_GET['sale_type']) ? $_GET['sale_type'] : "";?>
    {!!Form::hidden('sale_type', $sale_type, array('id' => 'sale_type'))!!}
      <div class="row">
        <!--filter sidebar-->
        <div class="col-md-3 col-sm-4">
          <div class="card">
          @if(!empty($clbs))
            <div class="card-header ch-alt"><h2>Product Classifications</h2></div>
            <div class="card-body card-padding-sm">
                <ul class="sidebar_cats">
                @foreach($clbs as $clb)
                    <li><a href="{{ URL::to('/site/') }}/{!!  $shopid !!}/?clabel={!! $clb->_id !!}">{!! $clb->name !!}</a></li>
<!--<a href="{!! $clb->_id !!}" style="display:block">{!! $clb->name !!}</a>-->
                @endforeach
                </ul>
                 
            </div>
           @endif
           
           
            <div class="card-header ch-alt"><h2>Categories</h2></div>
            <div class="card-body card-padding-sm">
                <ul id="ul_data" name='ul_data ' class="sidebar_cats">
                    @foreach ($products_list as $k1=>$top)
                    <li data-cat_id="{!! $k1 !!}" id="{!! $k1 !!}" name='li_sub_data' class="">
                        <i class="input-helper"></i>
                        {!! $top['name'] !!}
                        <ul id="ul_sub_data" name='ul_sub_data' class="">
                            @foreach($top['values'] as $k2=>$child)
                                <li data-cat_id="{!! $k2 !!}" id="{!! $k2 !!}" name='li_sub_data' class="">
                                    <label class="checkbox checkbox-inline m-r-20">
                                      @if(in_array($k2,$filtered_cat))
                                      {!! Form::checkbox('cat_id[]', $k2, array('checked')) !!}
                                      @else
                                      {!! Form::checkbox('cat_id[]', $k2) !!}
                                      @endif
                                      <i class="input-helper"></i>    
                                      {!! $child !!} ({!! $products_counts[$k2] !!})
                                    </label> 
                                </li>
                            @endforeach
                        </ul>
                     </li>
                    @endforeach
                </ul>
                <hr/>
                <div class="m-t-20">
                    <p class="f-500 c-black m-b-15">Search By Date</p>
                      <div class="input-group form-group">
                            <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
                            <div class="dtp-container fg-line">
                                <input type='date' id="" max="<?php echo date("Y-m-d"); ?>" name="from_date" class="form-control " placeholder="Select From Date" value="<?php if(!empty($frm_date)){ echo $frm_date;} ?>">
                            </div>
                      </div>
                      <div class="input-group form-group">
                            <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
                            <div class="dtp-container fg-line"> 
                                <input type='date' id="" max="<?php echo date("Y-m-d"); ?>" name="to_date" class="form-control " placeholder="Select End Date" value="<?php if(!empty($t_date)){ echo $t_date;} ?>">
                            </div>
                      </div>
                  </div>
                <hr/>

                <div class="row m-t-20">
                    <div class="col-sm-12 m-b-25">
                        <p class="f-500 c-black m-b-15">Search By Country</p>
                        @if(!empty($country_name))
                          {!! Form::select('country_name[]', $country,$country_name, array('multiple data-max-options'=>"3",'id'=>'country_name', 'class'=>'selectpicker', 'data-live-search'=>'true')) !!}
                        @else
                          {!! Form::select('country_name[]', $country,'', array('multiple data-max-options'=>"3",'id'=>'country_name', 'class'=>'selectpicker', 'data-live-search'=>'true')) !!}
                        @endif
                    </div>
                </div>

                <div class="row m-t-20">
                    <div class="col-sm-12 m-b-25">
                        <p class="f-500 c-black m-b-15">Search By Currency</p>
                        @if(!empty($currency_name))
                              {!! Form::select('currency_name', $currency,$currency_name, array('multiple data-max-options'=>"1",'id'=>'currency_name', 'class'=>'selectpicker', 'data-live-search'=>'true')) !!}
                        @else
                              {!! Form::select('currency_name', $currency,'', array('multiple data-max-options'=>"1",'id'=>'currency_name', 'class'=>'selectpicker', 'data-live-search'=>'true')) !!}
                        @endif
                    </div>
                </div>

                <div class="">
                    <p class="f-500 c-black m-b-15">Search By Price</p>
                    <div class="input-slider-values m-b-15 col-md-12" id="price-range"></div>
                    <span class="pull-right text-muted" id="value-lower"></span>
                    <span class="pull-left text-muted" id="value-upper"></span>

                    <div>
                        {!! Form::text('min_price','', array('class' => 'col-md-5 col-sm-5 col-xs-5' ,'id'=>'min_price')) !!}
                        <div class="col-md-2 col-sm-2 col-xs-2"> - </div>
                        {!! Form::text('max_price','', array('class' => 'col-md-5 col-sm-5 col-xs-5' ,'id'=>'max_price')) !!}
                    </div>
                </div>

                <div class="form-group clearfix"> 
                    <br/>
                      <hr/>
                      <br/>
                    <button class="btn btn-primary waves-effect waves-effect">Filter</button>
                </div>                        
            </div>
          </div>            
        </div>
            
        <!--products, search, sort options-->
        <div class="col-md-9 col-sm-8">
          <div class="card">
            <div class="card-body card-padding-sm">
              <!--search row-->
<!--              <div class="row">
                <div class="col-md-6 col-sm-6 ">
                  sort options
                </div>
                <div class="col-md-6 col-sm-6 ">
                  <div class="input-group">
                    {!! Form::text('keyword',$keyword,array('','placeholder'=>'Search...',
                    'class'=>'form-control searchshopcategories'))!!}
                    <span class="input-group-btn">
                        <button class="btn "><i class="zmdi zmdi-search"></i></button>
                    </span>
                  </div>                        
                </div>
                  
              </div>-->
              <!--<hr/>-->
              
              <!--products-->
              <?php $i=0;?>
              @foreach($products as $product)
                @if ($i === 0 || $i%4===0)
                  <div class="row">
                @endif
                 <div class="col-md-3 col-sm-6 col-xs-6">
                   <div class="card">
                     <div class="card-body">
                       <a href="<?php echo URL('site/'.$storename->slug.'/show', $product->id)?>" class="prod_thumb">
                         @if ($product->thumb !== "") 
                             <img src="{!!  asset($product->thumb_path.$product->thumb)  !!}" alt="Product" />
                         @else
                             <img src="{{ asset('images/product_img.png') }}" alt="Product" />
                         @endif
                       </a>
                     </div>

                     <div class="card-body card-padding-sm">
                      @if(!empty($product->desc))
                            <h6 class="prod_desc_all">{!!  $product->desc  !!}</h6>
                      @endif
                      
                      @if(!empty($product->postdate))
                        <p>{!! $attributes[0]->label !!} : {!!  $product->postdate  !!}</p>
                      @endif
                    <h6> 
                        @if(!empty($product->product_data[15]))
                            {!! $attributes[1]->label !!}: {!! $product->product_data[15]  !!} {!!  substr($product->product_data[13], -3) !!}
<!--                        Price: B2B - <a target="_blank" href="{!! route('price-request.create',['shopid'=>$product->shopid]) !!}">Request</a>-->
                          <br/>
                        @endif
                        @if(!empty($product->product_data[16]))
                            {!! $attributes[2]->label !!}: {!! $product->product_data[16]  !!} {!!  substr($product->product_data[13], -3) !!}
                          <br/>
                        @endif
                        @if(!empty($product->product_data[20]))
                            Price: Auction {!! $product->product_data[20]  !!} {!!  substr($product->product_data[13], -3) !!}
                          <br/>
                        @endif
                        @if(!empty($product->product_data[33]))
                            Price: Reverse Auction {!! $product->product_data[33]  !!} {!! substr($product->product_data[13], -3) !!}
                          <br/>
                        @endif
                    </h6>
                       <a href="<?php echo URL('site/'.$storename->slug.'/show', $product->id)?>" class="btn btn-info">
                          View Detail
                       </a>
                     </div>
                   </div>
                 </div>
                  <?php $i++;?>
                  @if ($i%4===0)
                    </div><!-- .row -->
                  @endif                
               @endforeach
                  <!--if  row div not closed-->
                  @if ($i%4!=0)
                    </div><!-- .row -->
                  @endif             
            </div>
              
            <div class="card-body card-padding-sm text-center">
              {!! $products->appends(array(['shopid' => $shopid, 'cat_id'=>$filtered_cat]))->render() !!}
            </div>   
          </div>
      </div>
  {!! Form::close() !!}
@endif

<div class="row">
  <!--filter sidebar-->
    <div class="col-md-12 col-sm-12"> 
      @if(!empty($certificationlogo) && count($certificationlogo) )
      <div class="card">
         <div class="card-header bgm-blue">
            <h2>Certification Logos</h2>
         </div>
        <div class="card-body card-padding-sm">
          <div class="row">
            @foreach($certificationlogo as $logo)
            <div class="col-md-3">
              <img src="{!! asset($logo->logo_path.$logo->logo) !!}" style="width: auto; max-height: 150px;">
            </div>
            @endforeach
          </div>
        </div>
     </div>
      @endif    
    
    </div>
</div>

@endsection

@section('header_add_js_files')        
    <!-- Javascript Libraries -->
<!--<script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="vendors/bower_components/jquery.nicescroll/jquery.nicescroll.min.js"></script>
    <script src="vendors/bower_components/Waves/dist/waves.min.js"></script>
    <script src="vendors/bootstrap-growl/bootstrap-growl.min.js"></script>
    <script src="vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.min.js"></script>

     Placeholder for IE9 
    [if IE 9 ]>
        <script src="vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js"></script>
    <![endif]

    <script src="js/functions.js"></script>
    <script src="js/demo.js"></script>-->
@endsection

@section('footer_add_js_script')
<script type="text/javascript">
    $(document).ready(function(){
        $('body').on('click', '.animation-demo .btn', function(){
            var animation = $(this).text();
            var cardImg = $(this).closest('.card').find('img');
            if (animation === "hinge") {
                animationDuration = 2100;
            }
            else {
                animationDuration = 1200;
            }

            cardImg.removeAttr('class');
            cardImg.addClass('animated '+animation);

            setTimeout(function(){
                cardImg.removeClass(animation);
            }, animationDuration);
        });
    });
</script>

<script type="text/javascript">
  $(document).ready(function(){
      $('.tabs ul li').on('click', function(){
        $val = $(this).attr('data-sale_type');
        $('#sale_type').val($val);
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
            //Range slider with value
            $('#price-range').noUiSlider({
                start: [ <?php echo str_replace(",",".", $min_price); ?>, <?php echo str_replace(",",".", $max_price); ?> ],
                connect: true,
                direction: 'ltr',
                behaviour: 'tap-drag',
                range: {
                        'min': <?php echo str_replace(",",".", $minimum_product_price); ?>,
                        'max': <?php echo str_replace(",",".", $maximum_product_price); ?>
                }
            });
            $('.input-slider-values').Link('lower').to($('#min_price'));
            $('.input-slider-values').Link('upper').to($('#max_price'));
        });
</script>

@endsection
