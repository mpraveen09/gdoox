@include('site.social_links')
@if(Auth::guest() || Auth::user() && Auth::user()->id !== $storename->user_id)
<div class="card">
    <div class="card-header card-padding-sm bgm-orange">
        <h2>I am interested in:</h2>
    </div>
    <div class="card-body card-padding">
        <div class="row">
            <div class="col-md-4">
                  <a href="{!!route('follower.index', [$shopid]) !!}" class="btn btn-default">I WANT TO BECOME YOUR FOLLOWER</a>
            </div>
            @if(Auth::user())
                <?php $subID = isset($subid)?$subid:array(); ?>
                @if( ($storename->type === "business_ecosystem" &&  Auth::user()->id !== $storename->user_id) && !in_array(Auth::user()->id, $subID) && !in_array($shopid, $site) && Auth::user()->hasRole('mono-admin') || Auth::user()->hasRole('multi-user-admin') )
                    <div class="col-md-4">
                        <a href="{!!route('join.request',[$shopid]) !!}" class="btn btn-default">ADD ME TO THIS BUSINESS ECOSYSTEM</a>
                    </div>
                @endif
                @if(Auth::user()->hasRole('mono-admin') || Auth::user()->hasRole('multi-user-admin') || Auth::user()->hasRole('multi-site-admin'))
                    <div class="col-md-4">
                        <a href="{!!route('partner.request', $shopid) !!}" class="btn btn-default">I WANT TO BECOME YOUR PARTNER</a>
                    </div>
                @endif
           @endif  
        </div>
  </div>
</div>
@endif

@if(Auth::user())
    <?php $subID = isset($subid)?$subid:array();?>
    @if(Auth::user()->id === $storename->user_id || ( in_array(Auth::user()->id, $subID) && in_array($shopid, $site) ) )
        <div class="go-social">
          <div class="clearfix">
            <p class="lead">                
                Site URL : {{ URL::to('/site/')  }}/{!! $shopid !!}
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Owner/Admin:{!! Auth::user()->username !!}
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Company Name: {!! $storename->company !!}
                
                 <div class="panel-collapse">
                    <div class="panel-heading" role="tab">
                        <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionBlack" href="#accordionBlack-two" aria-expanded="false">
                                SITES FROM THIS COMPANY
                            </a>
                        </h4>
                    </div>
                    <div id="accordionBlack-two" class="collapse" role="tabpanel">
                        <div>
                                E-COMMERCE SITES
                                <ul>
                                    @if($ecommerce_sites->count())
                                        @foreach($ecommerce_sites as $site)
<!--                                        @if($site->slug!= $shopid)-->
                                                <li><a href="{!! URL::to('/site/') !!}/{!! $site->slug !!}">{!! $site->slug !!}</a></li>
<!--                                         @endif-->
                                        @endforeach
                                    @else
                                         <li>No other E-Commerce Site</li>
                                    @endif
                                </ul>
                                COMPANY NETWORK SITE
                                <ul>
                                    @if($network_site->count())  
                                        @foreach($network_site as $net)
                                            <li><a href="{!! URL::to('/site/') !!}/{!! $net->network_site!!}">{!! $net->network_site !!}</a></li>
                                        @endforeach
                                    @else
                                           <li>No Network Sites</li>
                                    @endif
                                </ul>
                                BUSINESS ECOSYSTEM SITES
                                <ul>
                                    @if($eco_system_sites->count())
                                        @foreach($eco_system_sites as $s)
                                            <li><a href="{!! URL::to('/site/') !!}/{!! $s->slug!!}">{!! $s->slug !!}</a></li>
                                        @endforeach
                                    @else
                                           <li>No Ecosystem Sites</li>
                                    @endif
                                </ul>
                        </div>
                    </div>
                </div>
            </p>
          </div>
        </div>                          
    @endif
    
    <div class="row">
        <div class="col-sm-8 col-xs-12 col-md-12" style="margin-bottom: 10px;">
            <div class="color-block bgm-red" style="color: white; height: 20px;">I am Interested in becoming Your: </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-8 col-xs-12 col-md-12" style="margin-bottom: 10px;">
<!--        <a class="btn bgm-gray waves-effect" href="#">Follower</a>-->
            <a class="btn bgm-gray waves-effect" href="{!! route('company.network.invite.create')!!}">Company Network Partner</a>
            <a class="btn bgm-gray waves-effect" href="{!! route('invite.inter.partner.create')!!}">Business Ecosystem Partner</a>
        </div>
    </div>
@endif

@if(Auth::user())             
<?php $subID = isset($subid)?$subid:array();?>
   @if(Auth::user()->id === $storename->user_id || ( in_array(Auth::user()->id, $subID) && in_array($shopid, $site) ) )
    <div class="card panel-collapse">
      <div class="card-header card-padding-sm bgm-bluegray" role="tab" id="quickmenu-heading">
        <h2 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse-quickmenu" aria-expanded="true" aria-controls="collapse-quickmenu">
              Quick Menu - Site Management<small>This menu is only for you</small>
          </a>
        </h2>
      </div>
      <div class="card-body card-padding collapse" id="collapse-quickmenu"  role="tabpanel" aria-labelledby="quickmenu-heading">
        <div  class="row panel-body">
            <div class="col-md-4 col-sm-4">
              <ul>
                  <li class="">
                     Add/Edit Personal Profile
                       <ul>
                          <li><a href="{!! route('profile-index') !!}">Your Account</a></li>
                          <!--<li><a href="{!! route('personal-info-edit') !!}">Personal Info</a></li>-->
                          <li><a href="{!! route('social-info-create') !!}">Social Info</a></li>
                          <li><a href="{!! route('relation-info-create') !!}">Relation with Gdoox</a></li>
                          <li><a href="{!! route('interest-info-create') !!}">Interests</a></li>
                          <li>
                             Business Sectors
                             <ul>
                                  <li><a href="{!! route('business-sectors-index') !!}">Business Sectors I'am Interested In</a></li>
                             </ul>           
                          </li> 	
                        </ul>
                  </li>               
               </ul>
            </div>
            <div class="col-md-4 col-sm-4">
                <ul>
                  <li>
                   Create E-commerce Site
                      <ul>
                        <li>
                            Business Info
                            <ul>
                                  <li><a href="{!! route('business-info-index') !!}">Add Your Business Info</a></li>
                                  <li><a href="{!! route('business-info-verify') !!}">Verify Your Business Info</a></li>
                            </ul>
                        </li>
                        <li>
                            Accept Payment Methods
                            <ul>
                                <li><a href="{!! route('payment-method-index') !!}">Payment Method</a></li>
                            </ul>
                        </li>
                        <li>
                            Manage E-commerce Site
                            <ul>
                                <li><a href="{!! route('ecomm-index') !!}">Create Your e-Commerce Site</a></li>
                                <li><a href="{!! route('site.logo.index') !!}">Add Site Logo</a></li>
                                <li><a href="{!! route('site.header.images.index') !!}">Add Site Images</a></li>
                                <li><a href="{!! route('cms.create') !!}">Add Page</a></li>
                                <li><a href="{!! route('cms.index') !!}">Show Pages</a></li>
                                <li><a href="{!! route('productcatalog') !!}">Add Catalog</a></li>
                                <li><a href="{!! route('certificationlogos') !!}">Add Certification Logos</a></li>
                            </ul>
                        </li>
                      </ul>           
                  </li>  
                 </ul>
              </div>
          <div class="col-md-4">
            <ul>
              <li>
                Product Management
                <ul>
                    <li><a href="{!!route('select_cat_to_sell.index')!!}">ADD PRODUCTS</a></li>
                    <li><a href="{!!route('select_cat_to_buy.index')!!}">Add Service Procurement</a></li>  
                    <li><a href="{!! route('products/list') !!}">View Products</a></li>
                    <li><a href="{!! route('abandoned_cart') !!}">Abandoned Cart</a></li>
                  
                    <li>
                      Reviews
                      <ul>
                        <li><a href="{!! route('userreview.index') !!}">View Product Reviews</a></li>
                        <li><a href="{!! route('sellerreview.index') !!}">View Seller Reviews</a></li>
                      </ul>
                    </li>
                </ul>           
              </li>
            </ul>
              
        @if(!Auth::user()->hasRole('mono-admin') && !Auth::user()->hasRole('team-member'))
        <ul>
          <li>
          Managing Account
          <ul>
            <li><a href="{!! route('invite.colleague') !!}">Invite Your Colleague</a></li>
            <li><a href="{!! route('colleague.all') !!}">View Users And Define Role</a></li>
          </ul>           
          </li>               
        </ul>
        @endif
        <ul>
          <li>
            Business Ecosystem
            @if(Auth::user()->hasRole('multi-user-admin') || Auth::user()->hasRole('mono-admin') || Auth::user()->hasRole('team-member'))
            <ul>
              <li><a href="{!! route('invite.partner.show') !!}"">Accept/Deny Invitation</a></li>
              <li><a href="{!! route('invite.partner.status') !!}">Invitation Status</a></li>
              <li><a href="{!! route('share.site.index') !!}">Share Sites</a></li>
              <li><a href="{!! route('invited-business-partners.select_partner') !!}">Share Products</a></li>
            </ul>

            @else 

            <ul>
              <li><a href="{!! route('invite.ext.partner.create') !!}">Invite Company (not yet a GDOOX Member)</a></li>
              <li><a href="{!! route('invite.inter.partner.create') !!}">Invite Company (already a GDOOX Member)</a></li>
              <li><a href="{!! route('invite.partner.show') !!}"">Accept/Deny Invitation</a></li>
              <li><a href="{!! route('invite.partner.status') !!}">Invitation Status</a></li>
              <li><a href="{!! route('share.site.index') !!}">Share Sites</a></li>
              <li><a href="{!! route('invited-business-partners.select_partner') !!}">Share Products</a></li>
              <li><a href="{!! route('import-ecom-products.select_ecom') !!}">Import Partner's Products</a></li>
              <li><a href="{!! route('import-ecom-products.list_company') !!}">Import Products to Ecosystem</a></li>
              <li><a href="{!! route('ecosys.site.indexall') !!}">Create A New Business Ecosystem</a></li>
            </ul>

            @endif                 
          </li>
        </ul>              

            <ul>

            <li>Advanced  Product management
            <ul>
            <li class="">
               Create Multi-Item Products
               <ul>
                    <li><a href="{!! route('multi_item.create') !!}">Add Multi-Item Product</a></li>
                    <li><a href="{!! route('multi_item.index') !!}">Multi-Item Product List</a></li>
               </ul>           
            </li> 	
            <li class="">
               Cross-Selling Products
               <ul>
                    <li><a href="{!! route('cross_selling.create') !!}">Add Cross-Selling Product</a></li>
                    <li><a href="{!! route('cross_selling.index') !!}">Cross Selling-Product List</a></li>
               </ul>           
            </li> 	
            <li class="">
               Up-Selling Products
               <ul>
                    <li><a href="{!! route('up_selling.create') !!}">Add Up-Selling Product</a></li>
                    <li><a href="{!! route('up_selling.index') !!}">Up-Selling Product List</a></li>
               </ul>           
            </li> 
            <li class="">
               Bundle/Combo Products
               <ul>
                    <li><a href="{!! route('bundle/combo.create') !!}">Add Bundle/Combo Product</a></li>
                    <li><a href="{!! route('bundle/combo.index') !!}">Bundle/Combo Product List</a></li>
               </ul>           
            </li> 	
<!--              <li>Create opportunities
                <ul>
                <li><a href="{!! route('underdev') !!}">Cross selling</a></li>
                <li><a href="{!! route('underdev') !!}">Upselling</a></li>
                <li><a href="{!! route('underdev') !!}">Bundle product</a></li>
                <li><a href="{!! route('underdev') !!}">Add minibanner for promotion</a></li>
                <li><a href="{!! route('underdev') !!}">Create Multi Item product</a></li>
                <li><a href="{!! route('underdev') !!}">Create a product list</a></li>
                <li><a href="{!! route('underdev') !!}">Load product list</a></li>
                </ul>
              </li>-->
            </ul>
            <li>
            Other features 
            <ul>
            <li><a href="{!! route('abandoned_cart') !!}">Abandoned Cart</a></li>
            <li><a href="{!! route('underdev') !!}">Vat Management</a></li>
            <li><a href="{!! route('underdev') !!}">Swap to bundle offer (need to talk about this features)</a></li>
            <li><a href="{!! route('underdev') !!}">Multi-currency cart</a></li>
            </ul>
            </li>
            @if(!empty($product->_id))
            <li>
            <a href="{!! route('share_this_product', ['shop_id'=> $product->shopid, 'product_id'=> $product->_id]) !!}">
              Share this Product           
            </a>

            </li>
            @endif

            </ul>              
          </div>
        </div>
      </div>
    </div>
  @endif
@endif


    <div class="row">
      <div class="tabs sale_type_tab">
        <ul>
          <li data-sale_type="Price - Sell"><a  class="btn btn-primary waves-effect" href="{!!route('site', [$shopid, 'sale_type' => 'Price - Sell'])!!}">Sell</a></li>
          <li data-sale_type="Price - Buy"><a  class="btn btn-primary waves-effect" href="{!!route('site', [$shopid, 'sale_type' => 'Price - Buy'])!!}">Buy</a></li>
          <li data-sale_type="Auction"><a  class="btn btn-primary waves-effect" href="{!!route('site', [$shopid, 'sale_type' => 'Auction'])!!}">Auction</a></li>
          <li data-sale_type="Reverse Auction"><a  class="btn btn-primary waves-effect" href="{!!route('site', [$shopid, 'sale_type' => 'Reverse Auction'])!!}">Reverse Auction</a></li>
        </ul>
      </div>
    </div>