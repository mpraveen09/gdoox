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
    {{ URL::to('marketplace') }}
    @endsection
    
    @section('right_col_title_left')
        <h2>Gdoox Marketplace</h2>
    @endsection


    @section('right_col_title_right')
<!--    <br>
    <br>-->
    <button onclick="goBack()" class="btn btn-primary waves-effect">Back</button>
    @endsection
    
    @section('right_col')
      {!! Form::model('$products_list', [
          'method' => 'GET',
          //'route' => ['filter-categories/{filter}'],
          'class' => 'form-label-left',
          'novalidate'=>''
      ]) !!}  

    <div class="card site-banners">
        <div class="card-body">
          <ul class="bannerslider">
            <li><img src="{{ asset('images/marketplace.png') }}" alt="" ></li>
            <li><img src="{{ asset('images/Marketplace.jpg') }}" alt=""></li>
          </ul>
        </div>
    </div>

       @if (HTML::ul($errors->all()))
           <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                {!! HTML::ul($errors->all()) !!}
            </div>
       @endif
        
      <!-- will be used to show any messages -->
      @if (Session::has('message'))
          <div class="alert alert-info">{!!  Session::get('message')  !!}</div>
      @endif

    <div class="row">
      <div class="tabs sale_type_tab">
        <ul>
            <li data-sale_type="Price - Sell"><a class="btn btn-primary waves-effect"  href="{!!route('marketplace', ['sale_type' => 'Price - To Sell'])!!}">Sell</a></li>
            <li data-sale_type="Price - Buy"><a class="btn btn-primary waves-effect" href="{!!route('marketplace', ['sale_type' => 'Price - For Buy'])!!}">Buy</a></li>
            <li data-sale_type="Auction"><a class="btn btn-primary waves-effect" href="{!!route('marketplace', ['sale_type' => 'Auction'])!!}">Auction</a></li>
            <li data-sale_type="Reverse Auction"><a class="btn btn-primary waves-effect" href="{!!route('marketplace', ['sale_type' => 'Reverse Auction'])!!}">Reverse Auction</a></li>
        </ul>
      </div>
    </div>
      
      @if (!$products->count())
          <div class="alert alert-warning">You have no Products matching the Search Criteria</div>
      @else

      <?php $sale_type = !empty($_GET['sale_type']) ? $_GET['sale_type'] : "";?>
    {!!Form::hidden('sale_type', $sale_type, array('id' => 'sale_type'))!!}
      <div class="row">
        <!--filter sidebar-->
        <div class="col-md-3 col-sm-4">
          <div class="card">
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
                      <p class="f-500 c-black m-b-15">Search By Company</p>
                      @if(!empty($company_name))
                        {!! Form::select('company_name[]', $com, $company_name,array('multiple data-max-options'=>"3",'id'=>'company_name', 'class'=>'selectpicker', 'data-live-search'=>'true')) !!}
                      @else
                        {!! Form::select('company_name[]', $com, '',array('multiple data-max-options'=>"3",'id'=>'company_name', 'class'=>'selectpicker', 'data-live-search'=>'true')) !!}
                      @endif
                    </div>
                </div>
                
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
                        {!! Form::select('currency_name', $currency, $currency_name, array('multiple data-max-options'=>"1",'id'=>'currency_name', 'class'=>'selectpicker', 'data-live-search'=>'true')) !!}
                      @else
                        {!! Form::select('currency_name', $currency, '', array('multiple data-max-options'=>"1",'id'=>'currency_name', 'class'=>'selectpicker', 'data-live-search'=>'true')) !!}
                      @endif                            
                        
                    </div>
                </div>
                
                <!-- <div class="row m-t-20">
                    <div class="col-sm-12 m-b-25">
                        <p class="f-500 c-black m-b-15">Search By Price</p>
                    </div>
                </div>-->
                
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

              <!--<hr/>-->
              
              <!--products-->
              
               <?php $i = 0;?>
               @foreach( $products as $product)
                @if ($i === 0 || $i%4 === 0)
                  <div class="row">
                @endif
                 <div class="col-md-3 col-sm-6 col-xs-6">
                   <div class="card">
                     <div class="card-body">
                       <a href="<?php echo URL('site/'.$product->shopid.'/show', $product->id)?>" class="prod_thumb">
                            @if(!empty($product->product_images))
                                <?php $count = count($product->product_images); ?>
                                <img src="{!! asset($product->product_images[$count-1]) !!}" alt="prodcuct" width="100px;" height="100px;"/>
                            @else
                               @if ($product->thumb!== "")
                                   <img src="{!!  asset($product->thumb_path . $product->thumb)  !!}" alt="Product" /> 
                               @else
                                   <img src="{{ asset('images/product_img.png') }}" alt="Product" />
                               @endif
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
                            @if(Auth::user())
                                @if(in_array($product->shopid, $store_approvals) || in_array($product->_id, $product_approvals))
                                    @if(!empty($product->product_data[15]))
                                        {!! $attributes[1]->label !!}: {!! $product->product_data[15]  !!} {!!  substr($product->product_data[13], -3) !!}
                                        <br/>
                                    @endif
                                @else
                                    @if(!empty($product->product_data[15]))
                                        {!! $attributes[1]->label !!}: <a target="_blank" href="{!! route('price-request.create',['shopid'=>$product->shopid, 'product_id'=>$product->_id]) !!}">Request</a>
                                        <br/>
                                    @endif
                                @endif
                            @else
                                @if(!empty($product->product_data[15]))
                                    {!! $attributes[1]->label !!}: <a target="_blank" href="{!! route('price-request.create',['shopid'=>$product->shopid, 'product_id'=>$product->_id]) !!}">Request</a>
                                    <br/>
                                @endif
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
                        
                        
                        <br/>
                        <a href="<?php echo URL('site/'.$product->shopid.'/show', $product->id)?>" class="btn btn-info">
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
              {!! $products->appends(array(['cat_id'=>$filtered_cat]))->render() !!}
            </div>              
          </div>
        </div>
      </div>
    
    {!! Form::close() !!}



<style>
    .state-icon {
        left: -5px;
    }
    .list-group-item-primary {
        color: rgb(255, 255, 255);
        background-color: rgb(66, 139, 202);
    }

/* DEMO ONLY - REMOVES UNWANTED MARGIN */
    .well .list-group {
        margin-bottom: 0px;
    }
</style>

@endif

@endsection

@section('footer_add_js_script')
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
    function goBack() {
        window.history.back();
    }
    
    jQuery(function($) {
        $(".company_name").autocomplete({
            source: function( request, response ) {  
                $.ajax({
                    url: "{!! URL::route('auto_search_shop_all_categ')  !!}",
                    dataType: "json",
                    data: {
                            term: request.term,
                    },
                    success: function(json) {
                        response( $.map( json, function( item ) {
                            return {
                                value: item.name
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

