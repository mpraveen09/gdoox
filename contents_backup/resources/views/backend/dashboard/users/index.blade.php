@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <!--<h2>Welcome to Gdoox Dashboard, Real-time Reports/Charts/Widgets will be added here soon.</h2>-->
@endsection


@section('right_col_title_right')
@endsection

@section('right_col')
<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{!!  Session::get('message')  !!}</div>
@endif

<?php if (!empty($f_m_data[0]['title'])) { ?>
    <h3 class="page-header"><?php echo $f_m_data[0]['title']['label']; ?></h3>
<?php } ?>
  

  <?php
    use Gdoox\Models\BusinessEcommerceCompany;
    use Gdoox\Models\PersonalSiteDetail;
    
    if(Auth::user()){
        if(Auth::user()->hasRole('user')){
            $site_info = PersonalSiteDetail::where('user_id', Auth::user()->id)->project('slug')->first();
          ?>
          <div class="card">
            <div class="card-header bgm-orange">
              <h2>Start by creating/editing your site. Follow these steps:</h2>
            </div>
            <div class="card-body card-padding">
              <ul>
                <li>
                   To Start
                   <ul>
                        <li>
                          Add Your Personal Profile
                          <ul>
                              <li><a href="{!! route('profile-index')!!}">Your Account</a></li>
                              <!--<li><a href="{!! route('personal-info-create')!!}">Personal Info</a></li>-->
                              <li><a href="{!! route('social-info-create')!!}">Social Info</a></li>
                              <li><a href="{!! route('relation-info-create')!!}">Relation with Gdoox</a></li>
                              <li><a href="{!! route('interest-info-create')!!}">Interests</a></li>
                            </ul>
                        </li>
                        <li>
                           Create Your personal site
                           <ul>
                              <li><a href="{!! route('personal-about-us-create')!!}">About Us</a></li>
                              <li><a href="{!! route('general-info-create')!!}">General Information</a></li>
                              <li><a href="{!! route('professional-skills-create')!!}">Professional Skills</a></li>
                              <li><a href="{!! route('other-info-create')!!}">Other Information</a></li>
                              <li><a href="{!! route('jobdetail.create')!!}">Job Details</a></li>
                              <li><a href="{!! route('competencies-create')!!}">Competencies</a></li>
                              <li><a href="{!! route('references-create')!!}">References</a></li>
                              <li><a href="{!! route('business-sectors-index')!!}">Business Sectors I'am Interested In</a></li>
                              <li><a href="{!! route('site.header.images.index')!!}">Add Site Images</a></li>
                              <li><a href="{!! route('create-personal-site-create')!!}">Create Your Personal Site</a></li>
                           </ul>           
                        </li> 	
                  </ul>           
                </li> 	
              </ul>            

            </div>
          </div>  
          <?php          
        }
        else
        {
             $site_info =  BusinessEcommerceCompany::where('type', '=', 'business')->where('user_id',Auth::user()->id)->project('slug')->first(); 
                ?>
                <div class="card">
                    <div class="card-header bgm-orange">
                        <h2>Start by creating/editing your e-Commerce site. Follow these steps:</h2>
                    </div>
                <div class="card-body card-padding">        
                  <ul>
                  <li>
                     To Start
                    <ul>
                      <li class="">
                       Add/Edit Personal Profile
                         <ul>
                          <li><a href="{!! route('profile-index')!!}">Your Account</a></li>
                          <!--<li><a href="{!! route('personal-info-edit')!!}">Personal Info</a></li>-->
                          <li><a href="{!! route('social-info-edit')!!}">Social Info</a></li>
                          <li><a href="{!! route('relation-info-edit')!!}">Relation with Gdoox</a></li>
                          <li><a href="{!! route('interest-info-edit')!!}">Interests</a></li>
                        </ul>
                      </li>               
                     </ul>
                    <ul>
                      <li>
                       Create E-commerce Site
                        <ul>
                        <li>
                          Company Profile
                          <ul>
                              <li><a href="{!! route('business-info-index')!!}">Create Your Company Profile</a></li>
                              <li><a href="{!! route('business-info-verify')!!}">Verify Your Company Profile</a></li>
                          </ul>
                        </li>
                        <li>
                          Accept Payment Methods
                          <ul>
                            <li><a href="{!! route('payment-method-index')!!}">Payment Method</a></li>
                          </ul>
                        </li>
                          <li>
                           Business Sectors
                           <ul>
                              <li><a href="{!! route('business-sectors-index')!!}">Business Sectors I'am Interested In</a></li>
                           </ul>           
                          </li> 	
                        <li>
                          Manage E-commerce Site
                          <ul>
                            <li><a href="{!! route('ecomm-index')!!}">Create Your e-Commerce Site</a></li>
                            <li><a href="{!! route('site.logo.index')!!}">Add Site Logo</a></li>
                            <li><a href="{!! route('site.header.images.index')!!}">Add Site Images</a></li>
                            <li><a href="{!!route('cms.create')!!}">Add Page</a></li>
                            <li><a href="{!!route('cms.index')!!}">Show Pages</a></li>
                            <li><a href="{!!route('productcatalog')!!}">Add Catalog</a></li>
                            <li><a href="{!!route('certificationlogos')!!}">Add Certification Logos</a></li>
                          </ul>
                        </li>
                        </ul>           
                      </li>  
                     </ul>
                    <ul>
                      <li>
                      Product Management
                      <ul>
                        <li><a href="{!!route('select_cat_to_sell.index')!!}">ADD PRODUCTS/SERVICES</a></li>
                        <li><a href="{!!route('select_cat_to_buy.index')!!}">Product/Service Procurement</a></li>
                        <li><a href="{!!route('products/list')!!}">View Products</a></li>
                    <li class="">
                       <a href="">Create Multi-Item Products</a>
                       <ul>
                            <li><a href="{!! route('multi_item.create')!!}">Add Multi-Item Product</a></li>
                            <li><a href="{!! route('multi_item.index')!!}">Multi-Item Product List</a></li>
                       </ul>           
                    </li> 	
                    <li class="">
                       <a href="">Cross-Selling Products</a>
                       <ul>
                            <li><a href="{!! route('cross_selling.create')!!}">Add Cross-Selling Product</a></li>
                            <li><a href="{!! route('cross_selling.index')!!}">Cross Selling-Product List</a></li>
                       </ul>           
                    </li> 	
                    <li class="">
                       <a href="">Up-Selling Products</a>
                       <ul>
                            <li><a href="{!! route('up_selling.create')!!}">Add Up-Selling Product</a></li>
                            <li><a href="{!! route('up_selling.index')!!}">Up-Selling Product List</a></li>
                       </ul>           
                    </li> 
                    <li class="">
                       <a href="">Bundle/Combo Products</a>
                       <ul>
                            <li><a href="{!! route('bundle/combo.create')!!}">Add Bundle/Combo Product</a></li>
                            <li><a href="{!! route('bundle/combo.index')!!}">Bundle/Combo Product List</a></li>
                       </ul>           
                    </li> 	
                        <li><a href="{!!route('abandoned_cart')!!}">Abandoned Cart</a></li>

                        <li>
                          Reviews
                          <ul>
                          <li><a href="{!!route('userreview.index')!!}">View Product Reviews</a></li>
                          <li><a href="{!!route('sellerreview.index')!!}">View Seller Reviews</a></li>
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
                            <li><a href="{!! route('invite.colleague')!!}">Invite Your Colleague</a></li>
                            <li><a href="{!! route('colleague.all')!!}">View Users And Define Role</a></li>
                      </ul>           
                      </li>               
                    </ul>
                    @endif
                    <ul>
                      <li>
                        Business Ecosystem
                        @if(Auth::user()->hasRole('multi-user-admin') || Auth::user()->hasRole('mono-admin') || Auth::user()->hasRole('team-member'))
                            <ul>
                                  <li><a href="{!! route('invite.partner.show')!!}"">Accept/Deny Invitation</a></li>
                                  <li><a href="{!! route('invite.partner.status')!!}">Invitation Status</a></li>
                                  <li><a href="{!! route('share.site.index')!!}">Share Sites</a></li>
                                  <li><a href="{!! route('invited-business-partners.select_partner')!!}">Share Products</a></li>
                            </ul>

                        @else 

                            <ul>
                              <li><a href="{!! route('invite.ext.partner.create')!!}">Invite Company (not yet a GDOOX Member)</a></li>
                              <li><a href="{!! route('invite.inter.partner.create')!!}">Invite Company (already a GDOOX Member)</a></li>
                              <li><a href="{!! route('invite.partner.show')!!}"">Accept/Deny Invitation</a></li>
                              <li><a href="{!! route('invite.partner.status')!!}">Invitation Status</a></li>
                              <li><a href="{!! route('share.site.index')!!}">Share Sites</a></li>
                              <li><a href="{!! route('invited-business-partners.select_partner')!!}">Share Products</a></li>
                              <li><a href="{!! route('import-ecom-products.select_ecom')!!}">Import Partner's Products</a></li>
                              <li><a href="{!! route('import-ecom-products.list_company')!!}">Import Products to Ecosystem</a></li>
                              <li><a href="{!! route('ecosys.site.indexall')!!}">Create A New Business Ecosystem</a></li>
                            </ul>

                        @endif                 
                      </li>
                    </ul>
                    </li>               
                  </ul>
                </div>
            </div>  
      <?php 
        }        
    }
  ?>   
 
    <?php
     //  echo "<pre>";
     //  print_r($nav_menu);
     //  exit;
    ?>
    
<!--    @if(Auth::user())
          @if(Auth::user()->hasRole('superadmin'))
                @include('layout.dashboard.dashboard-superadmin')        
          @endif
          @if(Auth::user()->hasRole('multi-site-user'))
                @include('layout.dashboard.dashboard-multisite')        
          @endif
          @if(Auth::user()->hasRole('multi-user'))
                @include('layout.dashboard.dashboard-multiuser')        
          @endif
          @if(Auth::user()->hasRole('mono-user'))
                @include('layout.dashboard.dashboard-monouser')        
          @endif
          @if(Auth::user()->hasRole('personal-user'))
                @include('layout.dashboard.dashboard-personaluser')        
          @endif
          @if(Auth::user()->hasRole('team-member'))
                @include('layout.dashboard.dashboard-team-member')        
          @endif
          @if(Auth::user()->hasRole('gdoox-member'))
                @include('layout.dashboard.dashboard-gdoox-member')        
          @endif
          @if(Auth::user()->hasRole('user'))
                @include('layout.dashboard.dashboard-user')        
          @endif
          @if(Auth::user()->hasRole('company-network-user'))
                @include('layout.dashboard.dashboard-company_network')        
          @endif
      @endif    -->
    
<!--div class="card">
    <div class="card-header">
        <h2>Sales Statistics <small>Vestibulum purus quam scelerisque, mollis nonummy metus</small></h2>

        <ul class="actions">
            <li>
                <a href="">
                    <i class="zmdi zmdi-refresh-alt"></i>
                </a>
            </li>
        </ul>
    </div>

    <div class="card-body">
        <div class="chart-edge">
            <div id="curved-line-chart" class="flot-chart " style="padding: 0px; position: relative;"><canvas class="flot-base" width="1056" height="200" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 1056px; height: 200px;"></canvas><canvas class="flot-overlay" width="1056" height="200" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 1056px; height: 200px;"></canvas></div>
        </div>
    </div>
</div>

<div class="mini-charts">
    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="mini-charts-item bgm-cyan">
                <div class="clearfix">
                    <div class="chart stats-bar"><canvas width="83" height="45" style="display: inline-block; width: 83px; height: 45px; vertical-align: top;"></canvas></div>
                    <div class="count">
                        <small>Website Traffics</small>
                        <h2>987,459</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="mini-charts-item bgm-lightgreen">
                <div class="clearfix">
                    <div class="chart stats-bar-2"><canvas width="83" height="45" style="display: inline-block; width: 83px; height: 45px; vertical-align: top;"></canvas></div>
                    <div class="count">
                        <small>Website Impressions</small>
                        <h2>356,785K</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="mini-charts-item bgm-orange">
                <div class="clearfix">
                    <div class="chart stats-line"><canvas width="85" height="45" style="display: inline-block; width: 85px; height: 45px; vertical-align: top;"></canvas></div>
                    <div class="count">
                        <small>Total Sales</small>
                        <h2>$ 458,778</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="mini-charts-item bgm-bluegray">
                <div class="clearfix">
                    <div class="chart stats-line-2"><canvas width="85" height="45" style="display: inline-block; width: 85px; height: 45px; vertical-align: top;"></canvas></div>
                    <div class="count">
                        <small>Support Tickets</small>
                        <h2>23,856</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
<div class="dash-widgets">
    <div class="row">
        <div class="col-md-3 col-sm-6">
            <div id="site-visits" class="dash-widget-item bgm-teal">
                <div class="dash-widget-header">
                    <div class="p-20">
                        <div class="dash-widget-visits"><canvas width="196" height="95" style="display: inline-block; width: 196px; height: 95px; vertical-align: top;"></canvas></div>
                    </div>

                    <div class="dash-widget-title">For the past 30 days</div>

                    <ul class="actions actions-alt">
                        <li class="dropdown">
                            <a href="" data-toggle="dropdown">
                                <i class="zmdi zmdi-more-vert"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <a href="">Refresh</a>
                                </li>
                                <li>
                                    <a href="">Manage Widgets</a>
                                </li>
                                <li>
                                    <a href="">Widgets Settings</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="p-20">

                    <small>Page Views</small>
                    <h3 class="m-0 f-400">47,896,536</h3>

                    <br>

                    <small>Site Visitors</small>
                    <h3 class="m-0 f-400">24,456,799</h3>

                    <br>

                    <small>Total Clicks</small>
                    <h3 class="m-0 f-400">13,965</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div id="pie-charts" class="dash-widget-item">
                <div class="bgm-pink">
                    <div class="dash-widget-header">
                        <div class="dash-widget-title">Email Statistics</div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="text-center p-20 m-t-25">
                        <div class="easy-pie main-pie" data-percent="75">
                            <div class="percent">45</div>
                            <div class="pie-title">Total Emails Sent</div>
                        <canvas height="148" width="148"></canvas></div>
                    </div>
                </div>

                <div class="p-t-20 p-b-20 text-center">
                    <div class="easy-pie sub-pie-1" data-percent="56">
                        <div class="percent">56</div>
                        <div class="pie-title">Bounce Rate</div>
                    <canvas height="95" width="95"></canvas></div>
                    <div class="easy-pie sub-pie-2" data-percent="84">
                        <div class="percent">84</div>
                        <div class="pie-title">Total Opened</div>
                    <canvas height="95" width="95"></canvas></div>
                </div>

            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="dash-widget-item bgm-lime">
                <div id="weather-widget"><div class="weather-status">74°F</div><ul class="weather-info"><li>Austin, TX</li><li class="currently">Fair</li></ul><div class="weather-icon wi-34"></div><div class="dash-widget-footer"><div class="weather-list tomorrow"><span class="weather-list-icon wi-32"></span><span>86/56</span><span>Sunny</span></div><div class="weather-list after-tomorrow"><span class="weather-list-icon wi-32"></span><span>86/59</span><span>Sunny</span></div></div></div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div id="best-selling" class="dash-widget-item">
                <div class="dash-widget-header">
                    <div class="dash-widget-title">Best Sellings</div>
                    <img src="{{ asset('/m-admin-ui/img/widgets/alpha.jpg') }}" alt="">
                    <div class="main-item">
                        <small>Samsung Galaxy Alpha</small>
                        <h2>$799.99</h2>
                    </div>
                </div>

                <div class="listview p-t-5">
                    <a class="lv-item" href="">
                        <div class="media">
                            <div class="pull-left">
                                <img class="lv-img-sm" src="{{ asset('/m-admin-ui/img/widgets/note4.jpg') }}" alt="">
                            </div>
                            <div class="media-body">
                                <div class="lv-title">Samsung Galaxy Note 4</div>
                                <small class="lv-small">$850.00 - $1199.99</small>
                            </div>
                        </div>
                    </a>
                    <a class="lv-item" href="">
                        <div class="media">
                            <div class="pull-left">
                                <img class="lv-img-sm" src="{{ asset('/m-admin-ui/img/widgets/mate7.jpg') }}" alt="">
                            </div>
                            <div class="media-body">
                                <div class="lv-title">Huawei Ascend Mate</div>
                                <small class="lv-small">$649.59 - $749.99</small>
                            </div>
                        </div>
                    </a>
                    <a class="lv-item" href="">
                        <div class="media">
                            <div class="pull-left">
                                <img class="lv-img-sm" src="{{ asset('/m-admin-ui/img/widgets/535.jpg') }}" alt="">
                            </div>
                            <div class="media-body">
                                <div class="lv-title">Nokia Lumia 535</div>
                                <small class="lv-small">$189.99 - $250.00</small>
                            </div>
                        </div>
                    </a>

                    <a class="lv-footer" href="">
                        View All
                    </a>
                </div>
            </div>
        </div>
    </div>
</div-->  

@endsection