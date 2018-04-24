@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('header-logo-url')
    {{ URL::to('/site/') }}/{!!  $storename->slug !!}
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

<!-- @section('cart_link')
    @if (Session::has('cart_items'))
        @if( Session::get('cart_items') !== 0)
           <a class="tm-cart " href="{!! route('view_cart')  !!}">{!! Session::get('cart_items') !!}<i class="tmn-counts"></i></a>
        @endif  
    @endif
    @endsection
-->

@section('right_col')
    <!-- will be used to show any messages -->
    @if (Session::has('message'))
        <div class="alert alert-info">{!!  Session::get('message')  !!}</div>
    @endif
    
    <!-- <div class="cart-btn-cont">
        <a class="btn btn-blue btn-cart" href="">
        <span class="cart-icon">
            <i class="zmdi zmdi-widgets"></i>
        </span>
        <span class="cart-label">
        Cart
        </span>
            <span id="item_count_in_cart_top_displayed" class="fk-inline-block cart-count">
                @if(Session::has('cart_items'))
                    {!! Session::get('cart_items') !!}
                @endif
            </span>
        </a>
    </div> -->

@include('site.quick-menu')
     <div class="card" id="product-detail">
<!--        <div class="card-header bgm-blue">
          <h2> </h2>
        </div> .card-header -->
        <div class="card-body card-padding-sm">
            <div class="row">
                <div class="col-md-7 col-sm-7 col-xs-12">
                    <div class="product-image">
                    <?php
                      use Gdoox\Models\ProductPromotionalBanner;
                      $product_promo= ProductPromotionalBanner::where('product_id', $product->_id)->first();
                      $banner_html="";
                      if(!empty($product_promo)){
                            $banner_html .= '<div class="product-banner" style="background:'.$product_promo->banner_bg_color.'">';
                            $banner_html .= '<div class="product-banner-text" style="color:'.$product_promo->product_promo_text_color.';border-color:'.$product_promo->product_promo_text_color.';">';
                            $banner_html .= $product_promo->product_promo_text;
                            $banner_html .= '</div>';
                            $banner_html .= '</div>';

                            if(!empty($product_promo->status) &&  $product_promo->status!=="disabled"){
                                echo $banner_html;
                            } else {
                                if(!empty($selected) && $selected==="banner"){
                                    echo $banner_html;
                                }      
                            }
                      }
                    ?>
                        @if(!empty($product->product_images))
                            <ul class="bxslider">
                                @foreach(array_reverse($product->product_images) as $key=>$val)
                                    <li><img style="margin-left: 60px; height:auto; width:400px;" src="{!!  asset($val)  !!}" alt="prodcuct" /></li>
                                @endforeach
                                
                                <li><img style="margin-left: 60px; height:auto; width:400px;" src="{!!  asset($product->thumb_path.$product->thumb)  !!}" alt="prodcuct" /></li>
                                @if(isset($product->product_data[47]))
                                    @if(!empty($product->product_data[47]))
                                        <li><img style="margin-left: 60px; height:auto; width:400px;" src="{!!  asset($product->product_data[47]) !!}" alt="prodcuct" /></li>
                                    @endif
                                @endif
                            </ul>
                        @else
                        <img style="height: 500px;;" src="{!!  asset($product->thumb_path.$product->thumb)  !!}" alt="prodcuct" />
                        @endif
                    </div>
                </div>


                <div class="col-md-5 col-sm-5 col-xs-12" style="border:0px solid #e5e5e5;">
                    <div class="row">
                      <div class="col-md-6">
                        @if(Auth::user())
                        @if(!empty($product_promo) && $product_promo->user_id == Auth::user()->id)
                          <div class="">
                            <a href="{!!route('product_promo.edit', $product_promo->id)!!}" class="btn btn-warning  waves-effect">Go Back & Edit</a>
                          </div>
                        @endif
                        @endif

                      @if(!empty($avg_rating) )
                          <div class="g-stars-total g-stars" title="{!! round(($avg_rating), 1) !!} stars">
                            <span class="unfilled">
                              <i class="zmdi zmdi-star-outline zmdi-hc-fw"></i>
                              <i class="zmdi zmdi-star-outline zmdi-hc-fw"></i>
                              <i class="zmdi zmdi-star-outline zmdi-hc-fw"></i>
                              <i class="zmdi zmdi-star-outline zmdi-hc-fw"></i>
                              <i class="zmdi zmdi-star-outline zmdi-hc-fw"></i>                                      
                            </span>
                            <span class="rating filled" style="width:{!! round(($avg_rating/5 * 100), 2) !!}%;">
                              <i class="zmdi zmdi-star zmdi-hc-fw star-filled"></i>
                              <i class="zmdi zmdi-star zmdi-hc-fw star-filled"></i>
                              <i class="zmdi zmdi-star zmdi-hc-fw star-filled"></i>
                              <i class="zmdi zmdi-star zmdi-hc-fw star-filled"></i>
                              <i class="zmdi zmdi-star zmdi-hc-fw star-filled"></i>
                            </span>
                          </div>
                      @else
                    <i class="zmdi zmdi-star-outline zmdi-hc-fw"></i>
                        <i class="zmdi zmdi-star-outline zmdi-hc-fw"></i>
                        <i class="zmdi zmdi-star-outline zmdi-hc-fw"></i>
                        <i class="zmdi zmdi-star-outline zmdi-hc-fw"></i>
                        <i class="zmdi zmdi-star-outline zmdi-hc-fw"></i>
                      @endif

                      &nbsp; 
                      {!! $all_reviews->count() !!}  reviews

                      </div>
                      <div class="col-md-6">
                            @if(!empty($all_reviews))
                                <a href="#product-reviews" class="">View Reviews</a>  
                            @endif
                            @if(!empty($review))
                                / <a href="{!! route('userreview.show', $review->_id)  !!}" class="">My Product Review</a>
                            @else
                                / {!! HTML::linkRoute('write_review','Write Review',array('product_id'=>$product->_id, 'shopid'=>$product->shopid)) !!}
                            @endif                                  
                      </div> 
                    </div>

                    <h3 class="prod_title lead">{!!  $product->desc  !!}</h3>
                        @if(!empty($product->product_data[6] ))
                            <p>{!!  $product->product_data[6]  !!}</p>
                        @endif
                    <br>
                    
                    
                    <?php $qVars=""; ?>
                    
                    @if(!empty($productVariations))
                        @foreach($productVariations as $productvariations)
                            <div class="row">
                                <div class="col-md-12">
                                    @if(!empty($productvariations))
                                        @foreach($productvariations as $keys=>$variations)
                                        <div>{!! $variationids[$keys] !!}:</div>
                                            @foreach($variations as $key=>$values)
                                               @if(!is_object($values))
                                                    @if(preg_match('/^#[a-f0-9]{6}$/i', $values))
                                                        <a href="<?php echo URL('vsite/'.$product->shopid.'/vshow', $key)?>?{!! $qVars !!}qvAttr[{!! $keys !!}]={!! urlencode($values) !!}" class="prod_color <?php if(in_array($values, $selectedAttr)){?>color-active <?php } ?>" data-attrId="{!! $keys !!}" data-selectorvalue="{!! $values !!}">
                                                            <span class="cp-value" style="background-color: {!! $values !!}" data-image=""></span>
                                                        </a>
                                                   @else
                                                        <a href="<?php echo URL('vsite/'.$product->shopid.'/vshow', $key)?>?{!! $qVars !!}qvAttr[{!! $keys !!}]={!! urlencode($values) !!}" class="prod_color <?php if(in_array($values, $selectedAttr)){?>color-active <?php } ?>" data-attrId="{!! $keys !!}" data-selectorvalue="{!! $values !!}">
                                                            <span class="cp-value2" style="background-color: #e5e5e5">{!! $values !!}</span>
                                                        </a>                                                   
                                                   @endif                                                
                                               @else
                                                    @if(preg_match('/^#[a-f0-9]{6}$/i', $values->product_data[$keys]))
                                                        <a href="<?php echo URL('vsite/'.$product->shopid.'/vshow', $key)?>?{!! $qVars !!}qvAttr[{!! $keys !!}]={!! urlencode($values->product_data[$keys]) !!}" class="prod_color <?php if(in_array($values->product_data[$keys], $selectedAttr)){?>color-active <?php } ?>" data-attrId="{!! $keys !!}" data-selectorvalue="{!! $values->product_data[$keys] !!}">
                                                            <span class="cp-value" style="background-color: {!! $values->product_data[$keys] !!}" data-image=""></span>
                                                        </a>
                                                    @else                                               
                                                        <a href="<?php echo URL('vsite/'.$product->shopid.'/vshow', $key)?>?{!! $qVars !!}qvAttr[{!! $keys !!}]={!! urlencode($values->product_data[$keys]) !!}" class="prod_color <?php if(in_array($values->product_data[$keys], $selectedAttr)){?>color-active <?php } ?>" data-attrId="{!! $keys !!}" data-selectorvalue="{!! $values->product_data[$keys] !!}">
                                                            <span class="cp-value2" style="background-color: #e5e5e5">{!! $values->product_data[$keys] !!}</span>
                                                        </a>
                                                    @endif
                                               @endif
                                            @endforeach
                                            
                                            @if(!empty($selectedVarAttr[$keys]))
                                                <?php $qVars .= "qvAttr[". $keys . "]=". urlencode($selectedVarAttr[$keys]) . "&" ; ?>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif

                    <div class="">
                        <div class="product_price">
                            <h4 class="price">
                                  <!-- Div for the Reverse Auction Section.-->
                                  @if(isset($product->product_data[606]))
                                      @if($product->product_data[606]==='Reverse Auction')
                                          @if(!empty($prod_bid_data))
                                              <input type="hidden" name="hidden_bid_amt" value="{!! $prod_bid_data->lowest_bid_amt !!}" id="hidden_bid_amt"/>
                                              <div class="auction_amt">Price (Reverse Auction): {!! $prod_bid_data->lowest_bid_amt !!} {!!  substr($product->product_data[13], -3) !!}</div>
                                          @else
                                              @if(!empty($product->product_data[33]))
                                                  <input type="hidden" name="hidden_bid_amt" value="{!! $product->product_data[33] !!}" id="hidden_bid_amt"/>
                                                  <div class="auction_amt">Price (Reverse Auction): {!! $product->product_data[33]  !!} {!! substr($product->product_data[13], -3) !!} </div>
                                                <br/>
                                              @endif
                                          @endif
                                      @endif
                                  @endif

                                  <!-- Div for the Auction Section.-->
                                  @if(isset($product->product_data[14]))
                                     @if($product->product_data[14]==='Auction')
                                         @if(!empty($prod_bid_data))
                                             <input type="hidden" name="hidden_bid_amt" value="{!! $prod_bid_data->highest_bid_amt !!}" id="hidden_bid_amt"/>
                                             <div class="auction_amt">Price (Auction): {!! $prod_bid_data->highest_bid_amt !!} {!!  substr($product->product_data[13], -3) !!}</div>
                                         @else
                                             @if(!empty($product->product_data[20]))
                                                <input type="hidden" name="hidden_bid_amt" value="{!! $product->product_data[20] !!}" id="hidden_bid_amt"/>
                                                <div class="auction_amt">Base Price (Auction): {!! $product->product_data[20] !!} {!!  substr($product->product_data[13], -3) !!}</div>
                                                <br/>
                                             @endif
                                         @endif
                                     @endif
                                  @endif

                                  @if(!empty($product->product_data[16]))
                                    Price: B2C {!! $product->product_data[16]  !!} {!!  substr($product->product_data[13], -3) !!}
                                    <br/>
                                  @endif

                                  @if(!empty($product->product_data[15]))
                                    Price: B2B {!! $product->product_data[15]  !!} {!!  substr($product->product_data[13], -3) !!}
                                  @endif   
                            </h4>
                            <br>
                        </div>
                    </div>
                    
                    <!-- Section for the Add to Cart/Wishlist and Product Auction-->
                    @if(isset($product->product_data[14]))
                        @if($product->product_data[14]==='Price - To Sell' || $product->product_data[14]==='Price - To Buy')
                            <div class="">
                                <button type="button" class="btn btn-primary waves-effect add_to_cart" id="add_to_cart"><i class="zmdi zmdi-shopping-cart zmdi-hc-fw"></i>Add to Cart</button>
                                <br/><br/>
                                  @if(Auth::user())
                                      @if(isset($wishlist_item->product_id))
                                          {!! Form::model($product, [
                                              'method' => '',
                                              'route' => ['show-wishlist'],
                                              'class' => 'form-label-left',
                                              'novalidate'=>''
                                              ]) !!}                                          
                                            <button type="submit" class="btn btn-primary waves-effect" id="added_to_wishlist" style=""><i class="zmdi zmdi-favorite zmdi-hc-fw"></i>Added to Wishlist</button>
                                        {!! Form::close()!!}

                                       @else

                                          {!! Form::model($product, [
                                              'method' => '',
                                              'route' => ['show-wishlist'],
                                              'class' => 'form-label-left',
                                              'novalidate'=>''
                                              ]) !!}
                                            <button type="submit" class="btn btn-primary waves-effect" id="wishlist_item" style="display: none;"><i class="zmdi zmdi-favorite zmdi-hc-fw"></i>Added to Wishlist</button>
                                        {!! Form::close()!!}

                                          <button type="button" class="btn btn-primary waves-effect" id="add_to_wishlist" style=""><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i>Add to Wishlist</button>
                                      @endif  
                                @else
                                      <button type="button" class="btn btn-primary waves-effect" id="login_to_addwishlist" style=""><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i>Add to Wishlist</button>
                                @endif
                                <br /><br />
                                Sold By <b>{!! $product->shopid !!}</b>
                                <button class="btn bgm-green waves-effect btn-xs waves-effect">{!! round($seller_avg_rating, 1) !!} / 5</button>
                                <br/>
                                <a href="<?php echo URL('site/'.$product->shopid.'/reviews')?>">Seller Reviews</a> 
                                  @if(!empty($seller_reviews))
                                  / <a href="{!! route('sellerreview.show', $seller_reviews->_id)  !!}" class="">My Seller Review</a> 
                                  @else 
                                  / {!! HTML::linkRoute('seller_review','Write Seller Review',array('product_id'=>$product->_id,'shopid'=>$product->shopid)) !!}
                                  @endif  
                            </div>
                        @endif
                        
                        @if($product->product_data[14]==='Auction')
                            <div class="row">
                                @if(date('Y-m-d') <= $product->product_data[25])
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">Enter BID Amount:</label>
                                        <div class="col-sm-5">
                                            <div class="fg-line">
                                               {!! Form::text('bid_amount', null, array('id'=>'bid_amount')) !!}
                                            </div>
                                        </div>
                                        <div>
                                            <button type="button" data-val="Auction" class="btn btn-primary waves-effect" id="bid" style="">Bid</button>
                                        </div>
                                    </div>
                                @else
                                    <div class="form-group"><div class="col-sm-10"><b>The Auction is over.</b></div></div>
                                @endif
                            </div>
                            @if(!empty($prod_bid_data))
                                <div class="row">
                                    <div class="form-group">
                                        <a data-toggle="modal" href="#noAnimation" onclick="getBidData('{!! $product->id !!}'); return false;">View BIDS</a>
                                    </div>
                                </div>  
                            @endif
                         @endif
                     @endif
                     
                     <!-- Section for the Product Reverse Auction -->
                     @if(isset($product->product_data[606]))
                        @if($product->product_data[606]==='Reverse Auction')
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-5 control-label">Enter BID Amount:</label>
                                    <div class="col-sm-5">
                                        <div class="fg-line">
                                           {!! Form::text('bid_amount', null, array('id'=>'bid_amount')) !!}
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" data-val="Reverse Auction" class="btn btn-primary waves-effect" id="bid" style="">Bid</button>
                                    </div>
                                </div>
                            </div>
                            @if(!empty($prod_bid_data))
                                <div class="row">
                                    <div class="form-group">
                                        <a data-toggle="modal" href="#noAnimation" onclick="getBidData('{!! $product->id !!}'); return false;">View BIDS</a>
                                    </div>
                                </div>  
                            @endif
                         @endif
                     @endif
                     
                    @if(!empty($prod_bid_data))
                        <div class="modal" id="noAnimation" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Product Bids</h4>
                                    </div>
                                    <div class="modal-body" style="overflow-y: scroll; height:auto;"></div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                     
                    <div class="btn-demo"></div>

                    <div class="product_social">
                        <p class="lead">Share this:</p>
                        <div class="addthis_sharing_toolbox"></div>
                    </div>

                <?php $subuserid=isset($subuser->sub_user_id)?$subuser->sub_user_id :"";?>
                @if(Auth::user())
                  @if(Auth::user()->id === $storename->user_id || (Auth::user()->id === $subuserid 
                      && in_array($shopid, $site) ) )
  <!--                 <div class="">
                        <br/>
                        <a href="{!!route('products/edit',$product->_id)!!}" class="btn btn-warning ">
                          Edit this product
                        </a>
                      </div>-->
                  @endif
                @endif

                </div>
            </div>
        </div>
    </div>

@if(!empty($multi_items))
    <?php
            switch ($product->product_type) {
              case "multi_item":
                  $product_type['title']="Multi-Item";
                  break;
              case "cross_selling":
                  $product_type['title']="Cross-Selling";
                  break;
              case "up_selling":
                  $product_type['title']="Up-Selling";
                  break;
              case "bundle/combo":
                  $product_type['title']="Bundle/Combo";
                  break;
            } 
     ?>
 
    <div class="card">
        <div class="card-header bgm-blue" id="product-reviews">
            <h2>{!! $product_type['title'] !!} Products</h2>
        </div> 
        <div class="card-body card-padding">
          <div class="row">
          @foreach($multi_items as $multi_item )
          <div class="col-md-2">
            <a href="{!!route('{shopid}/show/', [$storename->slug, $multi_item->id])!!}" target="_blank "> 
              <img src="{!! asset($multi_item->thumb_path.$multi_item->thumb)   !!} " width="100px;" height="100px;">
            </a>
            <p>{!!  $multi_item->desc   !!}</p>
            </div>
          @endforeach  
          </div>
        </div>
    </div>
@endif
    
    
    @if(Auth::user() && $product->product_type !== "opportunity" && $product->product_type !=="multi_item" && $product->product_type !=="bundle/combo" && $product->product_type !=="cross_selling" && $product->product_type !=="up_selling")
        <div class="PM" id="PM" style="display: none;">
            <div role="tabpanel" class="tab-pane" id="content_PM" aria-labelledby="tab_PM">
                <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                    <table class="table table-striped responsive-utilities jambo_table">
                        <tbody>
                            <tr><td><a href="{!! route('multi_item.list', $product->id) !!}" class="">Add to multi-item</a><br/></td></tr>
                            <tr><td><a href="{!! route('cross_selling.list', $product->id) !!}" class="">Add to cross-selling</a></td></tr>
                            <tr><td><a href="{!! route('up_selling.list', $product->id) !!}" class="">Add to up-selling</a></td></tr>
                            <tr><td><a href="{!! route('bundle/combo.list', $product->id) !!}" class="">Add to bundle/combo</a></td></tr>
                            <tr><td><a href="{!! route('import_product.detail', $product->id) !!}" class="">Export this product</a></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    
        <div class="SPS" id="SPS" style="display: none;">
            <div role="tabpanel" class="tab-pane" id="content_SPS" aria-labelledby="tab_SPS">
                <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                    <table class="table table-striped responsive-utilities jambo_table">
                        
                        <tbody>
                            <!-- NOTE: IF THE PRODUCT IS SHARED THEN CHECKING IF THE PRODUCTS OLD SITE IS FROM LOGGED IN USERS SITE TO GIVE PERMISSIONS
                                ELSE  IF THE PRODUCT IS NOT SHARED THEN CHECKING IF THE PRODUCT IS FROM LOGGED IN USERS SITE. -->
                                    
                                    @if($product->product_type=="shared")
                                        @if(in_array($product->old_slug, $user_sites))
                                            <tr><td>
                                                <button id="prod_stat1" data-ProdAction="only_in_my_site" class="btn btn-primary btn-xs waves-effect prod_share_status">Only In My Site(s)</button>
                                            </td></tr>
                                        @else
                                            <tr><td>You don't have permission for these operations. Only the Owner of the Product can perform these operations.</td></tr>
                                        @endif
                                    @else 
                                        Product Not Shared.
                                    @endif
                                    <tr><td>
                                           @if($product->product_type=="shared")
                                                @if(in_array($product->old_slug, $user_sites))
                                                    <button id="prod_stat2" data-ProdAction="only_in_shared_site" class="test btn btn-primary btn-xs waves-effect prod_share_status">Only On shared Site</button>
                                                @endif
                                           @else
                                                @if(in_array($product->slug, $user_sites))
                                                    <button id="prod_stat2" data-ProdAction="share_product_in_shared_site" class="test btn btn-primary btn-xs waves-effect not_shared_prod_status">Share On Shared Site</button> 
                                               @endif
                                           @endif
                                           <div id="prod_stat2_div"></div>
                                    </td></tr>

                                    <tr><td>
                                        @if($product->product_type=="shared")
                                            @if(in_array($product->old_slug, $user_sites))
                                                <input type="hidden" id="only_in_this_site" value="only_in_this_site">
                                                <button id="prod_stat3" data-attrStatus="only_in_this_site" class="test btn btn-primary btn-xs waves-effect">Only On This Site</button>
                                            @endif
                                        @else
                                            @if(in_array($product->slug, $user_sites))
                                                <input type="hidden" id="share_product_in_these_sites" value="share_product_in_these_sites">
                                                <button id="prod_stat3" data-ProdAction="share_product_in_these_sites" class="test btn btn-primary btn-xs waves-effect">Only On These Sites</button>
                                            @endif
                                        @endif
                                    </td></tr>
                                
                                    <tr>
                                        <td>
                                            @if($product->product_type=="shared")
                                                <div id="store_list" style="display: none;">
                                                    <table> 
                                                        @if(!empty($prodstore))
                                                            <tr><td>Select Site to Share Product</td></tr>
                                                            @foreach($prodstore as $key=>$store)
                                                                <tr><td>{!! Form::checkbox('store_id[]', $key) !!}</td><td>{!! $store !!}</td></tr>
                                                            @endforeach
                                                            <tr>
                                                                <td>
                                                                    <button id="share_shared_product" class="btn btn-primary btn-xs waves-effect">Share</button>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                        <tr><td>No Shared sites Available for You.</td></tr>
                                                    </table>
                                                    <div id="prod_stat3_div"></div>
                                                </div>
                                            @else
                                                <div id="store_list" style="display: none;">
                                                    <table>  
                                                        @if(!empty($ecosites))
                                                            <tr><td>Select Site to Share Product</td></tr>
                                                            @foreach($ecosites as $skey=>$sites)
                                                                <tr><td>{!! Form::checkbox('store_id[]', $skey) !!}</td><td>{!! $sites !!}</td></tr>
                                                            @endforeach
                                                            <tr><td><button id="share_unshared_product" class="btn btn-primary btn-xs waves-effect">Share</button></td></tr>
                                                        @else
                                                            <tr><td>No User has shared sites with you. Invite users to share product to the sites.</td></tr>
                                                        @endif
                                                    </table>
                                                    <div id="prod_stat3_div"></div>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    
        <div class="STM" id="STM" style="display: none;">
            <div role="tabpanel" class="tab-pane" id="content_STM" aria-labelledby="tab_STM">
                <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                    <table class="table table-striped responsive-utilities jambo_table">
                        <tbody>
                            <tr>
                                <td>
                                    @if($product->status === "disabled")
                                        <a href="{!!route('product.toggle', [$product->id, 'status'=>'enabled','shopid'=>$product->shopid])  !!}" class="btn btn-primary btn-xs waves-effect">Show On Site</a><br/>
                                    @else
                                        <a href="{!!route('product.toggle', [$product->id, 'status'=>'disabled','shopid'=>$product->shopid])  !!}" class="btn btn-primary btn-xs waves-effect">Hide From Site</a><br/>
                                    @endif
                                </td>
                            </tr>  
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
    
    <div class="card">
        <div class="card-body">
          @foreach( $productTabs as $productTab)
                  {!!  $productTab   !!}
          @endforeach           
        </div>
    </div>


    <div class="card">
        <div class="card-header bgm-blue" id="product-reviews">
            <h2>User Reviews</h2>
        </div> 
        
       <div class="card-body card-padding">        
            <div class="row">
                <div class="col-md-2">
                  <div class="totalstars">                    
<!--                @if($avg_rating < 1) 
                      0
                    @else
                      {!! round($avg_rating, 1) !!}
                    @endif-->
                    {!! round($avg_rating, 1) !!}
                  </div>         
                  Average Rating<br/>
                  Based on {!! $all_reviews->count() !!}  reviews                    
                </div>
                <div class="col-md-3">
                    @if( !empty( $all_reviews->count() ) )
                    
                    <div class="g-stars">
                        <i class="zmdi zmdi-star zmdi-hc-fw star-result"></i> 
                        <i class="zmdi zmdi-star zmdi-hc-fw star-result"></i> 
                        <i class="zmdi zmdi-star zmdi-hc-fw star-result"></i> 
                        <i class="zmdi zmdi-star zmdi-hc-fw star-result"></i> 
                        <i class="zmdi zmdi-star zmdi-hc-fw star-result"></i> 
                        ({!! $rating_5 !!})
                        <div class="progress">
                            @if($rating_5==0)
                              {!!  $val_5 = 0 !!}
                            @else
                                {!! $val_5 = ($rating_5/ $all_reviews->count() )*100 !!}
                            @endif
                            
                            <div class="progress-bar" style="width: {!! $val_5 !!}%;">
                              <span class="sr-only"></span>
                            </div>
                        </div>                    
                    </div>
                    <div class="g-stars">
                        <i class="zmdi zmdi-star zmdi-hc-fw star-result"></i> 
                        <i class="zmdi zmdi-star zmdi-hc-fw star-result"></i> 
                        <i class="zmdi zmdi-star zmdi-hc-fw star-result"></i> 
                        <i class="zmdi zmdi-star zmdi-hc-fw star-result"></i> 
                        ({!! $rating_4 !!})
                        <div class="progress">
                            @if($rating_4==0)
                               {!! $val_4= 0 !!}
                            @else
                                {!! $val_4 = ($rating_4/ $all_reviews->count())*100 !!}
                            @endif
                           <div class="progress-bar" style="width: {!! $val_4 !!}%;">
                              <span class="sr-only"></span>
                            </div>
                        </div>                    
                    </div>
                    <div class="g-stars">
                        <i class="zmdi zmdi-star zmdi-hc-fw star-result"></i> 
                        <i class="zmdi zmdi-star zmdi-hc-fw star-result"></i> 
                        <i class="zmdi zmdi-star zmdi-hc-fw star-result"></i> 
                        ({!! $rating_3 !!})
                        <div class="progress">
                            @if($rating_3==0)
                              {!!  $val_3 = 0 !!}
                            @else
                               {!! $val_3 = ($rating_3/ $all_reviews->count())*100 !!}
                            @endif
                            <div class="progress-bar" style="width: {!! $val_3 !!}%;">
                              <span class="sr-only"></span>
                            </div>
                        </div>                    
                    </div>
                    <div class="g-stars">
                        <i class="zmdi zmdi-star zmdi-hc-fw star-result"></i> 
                        <i class="zmdi zmdi-star zmdi-hc-fw star-result"></i> 
                        ({!! $rating_2 !!})
                        <div class="progress">
                            @if($rating_2==0)
                                {!! $val_2 = 0 !!}
                            @else
                                {!! $val_2 = ($rating_2/ $all_reviews->count())*100 !!}
                            @endif
                            <div class="progress-bar" style="width: {!! $val_2 !!}%;">
                              <span class="sr-only"></span>
                            </div>
                        </div>                    
                    </div>
                    <div class="g-stars">
                        <i class="zmdi zmdi-star zmdi-hc-fw star-result"></i> 
                        ({!! $rating_1 !!})
                        <div class="progress">
                            @if($rating_1==0)
                               {!! $val_1 = 0 !!}
                            @else
                                {!! $val_1= ($rating_1/ $all_reviews->count())*100 !!}
                            @endif
                            <div class="progress-bar" style="width: {!! $val_1 !!}%;">
                              <span class="sr-only"></span>
                            </div>
                        </div>                    
                    </div>
                  @endif
                </div>
            </div>  
       </div>
        
        
        @if ( !$all_reviews->count())
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"></span></button>
                    There are no Reviews for this Product
                </div>                 
        @else
        
        <div class="text-right col-md-12">
            {!! $all_reviews->render() !!}             
        </div>
        
        <div class="card-body card-padding">
            @foreach($all_reviews as $reviews)
            <div class="row">
                <div class="col-md-2">
                  @if(!empty($reviews->name)) {!! $reviews->name !!} @endif
                  <div class="g-stars ">
                    <div class="g-stars-total g-stars" title="{!! $reviews->rating !!} stars">
                      <span class="unfilled">
                        <i class="zmdi zmdi-star-outline zmdi-hc-fw"></i>
                        <i class="zmdi zmdi-star-outline zmdi-hc-fw"></i>
                        <i class="zmdi zmdi-star-outline zmdi-hc-fw"></i>
                        <i class="zmdi zmdi-star-outline zmdi-hc-fw"></i>
                        <i class="zmdi zmdi-star-outline zmdi-hc-fw"></i>                                      
                      </span>
                      <span class="rating filled" style="width:
                            {!! round(($reviews->rating/5 * 100), 2) !!}%;">
                        <i class="zmdi zmdi-star zmdi-hc-fw star-filled"></i>
                        <i class="zmdi zmdi-star zmdi-hc-fw star-filled"></i>
                        <i class="zmdi zmdi-star zmdi-hc-fw star-filled"></i>
                        <i class="zmdi zmdi-star zmdi-hc-fw star-filled"></i>
                        <i class="zmdi zmdi-star zmdi-hc-fw star-filled"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-md-10">
                  @if(!empty($reviews->review_title))
                  <strong>{!! $reviews->review_title !!} </strong>
                  <br/>
                  @endif
                  @if(!empty($reviews->review))
                    {!! $reviews->review !!} 
                  @endif
                </div>
            </div>
            <br/>
            @endforeach
        </div>
        <div class="text-right col-md-12">
            {!! $all_reviews->render() !!}             
        </div>
        @endif
    </div>

    @include('site.bottom_contactform')

@endsection

@section('footer_add_js_script')

<script type="text/javascript">
function getBidData(productid){
    $.ajax({
        url: "{!! URL::route('view_product_bids') !!}",
        data: {
            productid: productid,
        },
        success: function(html) {
            $('.modal-body').html('');
            $('.modal-body').html(html);
        }
    });
}
$(document).ready(function(){
    $('.bxslider').bxSlider({
//        adaptiveHeight:true
    });
});
</script>

<style>
    a.prod_variation:active {
        border: 3px solid #ffff00;
    }
</style>

<script type="text/javascript">
jQuery(function($) {
    var avg_rating = Math.round({!! $avg_rating !!})
    if(avg_rating===1){
        $("i[id$=1]").addClass('selected');
        $("i[id$=1]").addClass('btn-warning');
        $("i[id$=1]").removeClass('btn-default');
    }
    else if(avg_rating===2){
        $("i[id$=2]").addClass('selected');
        $("i[id$=1]").addClass('btn-warning');
        $("i[id$=1]").removeClass('btn-default');
        $("i[id$=2]").addClass('btn-warning');
        $("i[id$=2]").removeClass('btn-default');
    }
    else if(avg_rating===3){
        $("i[id$=3]").addClass('selected');
        $("i[id$=1]").addClass('btn-warning');
        $("i[id$=1]").removeClass('btn-default');
        $("i[id$=2]").addClass('btn-warning');
        $("i[id$=2]").removeClass('btn-default');
        $("i[id$=3]").addClass('btn-warning');
        $("i[id$=3]").removeClass('btn-default');
    }
    else if(avg_rating===4){
        $("i[id$=4]").addClass('selected');
        $("i[id$=1]").addClass('btn-warning');
        $("i[id$=1]").removeClass('btn-default');
        $("i[id$=2]").addClass('btn-warning');
        $("i[id$=2]").removeClass('btn-default');
        $("i[id$=3]").addClass('btn-warning');
        $("i[id$=3]").removeClass('btn-default');
        $("i[id$=4]").addClass('btn-warning');
        $("i[id$=4]").removeClass('btn-default');
    }
    else if(avg_rating===5){
        $("i[id$=5]").addClass('selected');
        $("i[id$=1]").addClass('btn-warning');
        $("i[id$=1]").removeClass('btn-default');
        $("i[id$=2]").addClass('btn-warning');
        $("i[id$=2]").removeClass('btn-default');
        $("i[id$=3]").addClass('btn-warning');
        $("i[id$=3]").removeClass('btn-default');
        $("i[id$=4]").addClass('btn-warning');
        $("i[id$=4]").removeClass('btn-default');
        $("i[id$=5]").addClass('btn-warning');
        $("i[id$=5]").removeClass('btn-default');
    }
    
    @if(Auth::user() && $product->product_type !== "opportunity" && $product->product_type !=="multi_item" && $product->product_type !=="bundle/combo" && $product->product_type !=="cross_selling" && $product->product_type !=="up_selling")
        $("#prodTab").append('<li role="presentation" class=""><a href="#tab_content_PM" id="tab_PM" role="tab" data-toggle="tab" aria-expanded="true">Manage This Product</a></li>');
//        $("#prodTab").append('<li role="presentation" class=""><a href="#tab_content_SPS" id="tab_SPS" role="tab" data-toggle="tab" aria-expanded="true">Sharing Product Status</a></li>');
//        $("#prodTab").append('<li role="presentation" class=""><a href="#tab_content_STM" id="tab_STM" role="tab" data-toggle="tab" aria-expanded="true">Status To Market</a></li>');
    @endif
    
    $("#tab_PM").click(function() {
        var pm = $('#PM').html();
        $('#PM').html('');
        $('#prodTabContent').find('.active').addClass('fade');
        $('#prodTabContent').find('.active').removeClass('active in');                           
        $('#prodTabContent').append(pm);
        $('#content_PM').removeClass('fade');
        $('#content_PM').addClass('active in');
    });
    
    $("#tab_STM").click(function() {
        var stm = $('#content_STM').html();
        $('#STM').html('');
        $('#prodTabContent').find('.active').removeClass('active in');                            
        $('#content_STM').addClass('active in');
        $('#tab_content_STM').html(stm);
    });
    
    $("#tab_SPS").click(function() {
        var sps = $('#content_SPS').html();
        $('#SPS').html('');
        $('#prodTabContent').find('.active').removeClass('active in');                       
        $('#content_SPS').addClass('active in');
        $('#tab_content_SPS').html(sps);
    });
   
    $("#add_to_cart").click(function() {
        var product_id = '{!! $product->id !!}';
        var shopid = '{!! $product->shopid !!}';
        $.ajax({
            url: "{!! URL::route('add_to_cart')  !!}",
            data: {
                    product_id: product_id,
                    shopid: shopid
            },
            success: function(data) {
               // $('#item_count_in_cart_top_displayed').html(data);
                $('.tmn-counts').html(data);
            }
        }); 
    });
    
    $("#bid").click(function() {
            var type = $(this).attr('data-val');
            var product_id = '{!! $product->id !!}';
            var hidden_bid_amt = $('#hidden_bid_amt').val();
            var shopid = '{!! $product->shopid !!}';
            var bid_amt = $('#bid_amount').val();
            var bid_currency = '{!! substr($product->product_data[13], -3) !!}';
            
            if(type==='Auction'){
                if(hidden_bid_amt != 'undefined'){
                    var min_amount = hidden_bid_amt * (5/100);
                    if(hidden_bid_amt > bid_amt){
                        swal("Your Bid Amount is Less than Highest Bid Amount. Please Enter a Greater Amount.");
                        return false;
                    }
                    else if(bid_amt < (hidden_bid_amt + min_amount)){
                        swal("Please Enter a BID Amount which is 5% greater than the Highest BID.");
                        return false;
                    }
                }
            }
            else {
                if(hidden_bid_amt != 'undefined'){
                    var min_amount = hidden_bid_amt * (5/100);
                    var amt = parseInt(hidden_bid_amt) - parseInt(min_amount);
                    if(parseInt(hidden_bid_amt) < parseInt(bid_amt)){
                        swal("Your Bid Amount is Greater than Minimum Bid Amount. Please Enter a Lower Amount.");
                        return false;
                    }
                    else if(parseInt(bid_amt) > amt){
                        swal("Please Enter a BID Amount which is 5% lesser than the Lowest BID.");
                        return false;
                    }
                }
            }

            $.ajax({
                url: "{!! URL::route('bid') !!}",
                data: {
                    product_id: product_id,
                    shopid: shopid,
                    bid_amt: bid_amt,
                    bid_currency: bid_currency,
                    type: type
                },
                success: function(data) {
                    var obj = jQuery.parseJSON(data);   
                    if(type==='Auction'){
                        $('.auction_amt').text("Price (Auction): "+ obj.bid_amt + " {!! substr($product->product_data[13], -3) !!}");
                    }
                    else {
                        $('.auction_amt').text("Price (Reverse Auction): "+ obj.bid_amt + " {!! substr($product->product_data[13], -3) !!}");
                    }
                    $('#hidden_bid_amt').val(obj.bid_amt);
                    $('#bid_amount').val('');
                }
            }); 
    });
        
    $("#add_to_wishlist").click(function() {
        var product_id = '{!! $product->id !!}';
        var shopid = '{!! $product->shopid !!}';
        $.ajax({
                url: "{!! URL::route('add_to_wishlist')  !!}",
                data: {
                        product_id: product_id,
                        shopid: shopid
                },
                success: function(data) {
                    $('#wishlist_item').show();
                    $('#add_to_wishlist').hide();
                }
            }); 
        });
        
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
        
    $('#login_to_addwishlist').click(function(){
        swal("Please Login to Add to Wishlist!");
    });    
});
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click', '.prod_share_status', function() {
            // var status = $(this).parent().find('.prod_status').val();
            var status = $(this).attr('data-ProdAction');
            var product_id = '{!! $product->original_id !!}';
            var shopid = '{!! $product->shopid !!}';
            var product_type = '{!! $product->product_type !!}';
            $.ajax({
                url: "{!! URL::route('product_shared_status') !!}",
                data: {
                    status: status,
                    product_id: product_id,
                    shopid: shopid,
                    product_type: product_type
                },
                success: function(data) {
                   dta = JSON.parse(data); 
                   if(dta.site=='only_in_my_site'){
                       if(dta.status==='true'){
                           swal("Product Shared in Your Site Only.");
                       }
                       else {
                           swal("Something went wrong. Product could not be Shared. Try Again!");
                       }
                   }
                   else if(dta.site=='only_in_shared_site') {
                       if(dta.status==='true'){
                           swal("Product Shared in Shared Shared Sites.");
                       }
                       else if(dta.status==='no_shared_site'){
                           swal("There are no Shared Sites available.");
                       }
                       else {
                           swal("Something went wrong. Product could not be Shared. Try Again!");
                       }
                   }
                }
            }); 
        });
        
        $(document).on('click', '#share_shared_product', function() {
            var allStores = [];
            $('#store_list :checked').each(function() {
                allStores.push($(this).val());
            });        
            var status = $('#only_in_this_site').val();
            var product_id = '{!! $product->original_id !!}';
            var shopid = '{!! $product->shopid !!}';
            var product_type = '{!! $product->product_type !!}';
            $.ajax({
                url: "{!! URL::route('product_shared_status') !!}",
                data: {
                    status: status,
                    product_id: product_id,
                    stores : allStores,
                    shopid : shopid,
                    product_type: product_type
                },
                success: function(data) {
                   dta = JSON.parse(data); 
                   if(dta.site=='only_in_this_site'){
                       if(dta.status==='true'){
                           $('#store_list').hide();
                           $('#prod_stat3_div').text('Product Shared to the Selected Sites.');
                       }
                       else {
                           $('#prod_stat3_div').text('Something went wrong. Product could not be Shared to selected Sites. Try Again!');
                       }
                   }
                   else if(dta.site=='no_shared_site_availale') {
                       $('#prod_stat3_div').text('There are no Shared Sites Available.');
                   }
                }
            }); 
        });

        $(document).on('click', '.not_shared_prod_status', function() {
            var status = $(this).attr('data-ProdAction');
            var product_id = '{!! $product->id !!}';
            var shopid = '{!! $product->shopid !!}';
            $.ajax({
                url: "{!! URL::route('share-unshared-product') !!}",
                data: {
                    status: status,
                    product_id: product_id,
                    shopid: shopid
                },
                success: function(data) {
                   dta = JSON.parse(data);
                   console.log(dta);
                   if(dta.site=='only_in_shared_site') {
                       if(dta.status==='true'){
                           // swal("Product Shared in Shared Shared Sites.");
                           $('#prod_stat2_div').text('Product Shared in Shared Shared Sites.');
                       }
                       else if(dta.status==='no_shared_site'){
                           $('#prod_stat2_div').text('There are no Shared Sites available.');
                           // swal("There are no Shared Sites available.");
                       }
                       else {
                           swal("Something went wrong. Product could not be Shared. Try Again!");
                       }
                   }
                }
            }); 
        });
        
        $(document).on('click', '#share_unshared_product', function() {
            var allStores = [];
            $('#store_list :checked').each(function() {
                allStores.push($(this).val());
            });
            
            var status = $('#share_product_in_these_sites').val();           
            var product_id = '{!! $product->id !!}';
            var shopid = '{!! $product->shopid !!}';
            
            $.ajax({
                url: "{!! URL::route('share-unshared-product') !!}",
                data: {
                    status: status,
                    product_id: product_id,
                    stores : allStores,
                    shopid : shopid
                },
                success: function(data) {
                   dta = JSON.parse(data);
                   if(dta.status==='true'){
                        $('#store_list').hide();
                        $('#prod_stat3_div').text('Product Shared to the Selected Sites.');
                        // swal("Product Shared to the Selected Sites.");
                    }
                    else {
                        $('#prod_stat3_div').text('Something went wrong. Product could not be Shared to selected Sites. Try Again!');
                        // swal("Something went wrong. Product could not be Shared to selected Sites. Try Again!");
                    }
                }
            }); 
        });
        
        
        $(document).on('click', '#prod_stat3', function() { 
            $('#store_list').show();
            return false;
        });
    });
</script>

@endsection



