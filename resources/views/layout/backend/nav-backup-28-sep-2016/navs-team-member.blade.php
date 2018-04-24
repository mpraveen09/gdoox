<li><a href="{!! route('dash-board')!!}"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
<!--------------------------------------------------------Personal Profile------------------------------------------------------------------>
  <li class="sub-menu">
    <a href=""><i class="zmdi zmdi-view-list"></i>Personal Profile</a>
    <ul>
        <li><a href="{!! route('profile-index')!!}">Your Account</a></li>
        <li><a href="{!! route('personal-info-create')!!}">Personal Info</a></li>
        <li><a href="{!! route('relation-info-create')!!}">RELATIONSHIP WITH GDOOX</a></li>
        <li><a href="{!! route('interest-info-create')!!}">Interests</a></li>
        <li><a href="{!! route('social-info-create')!!}">Social Info</a></li>
        <li><a href="{!! route('business-sectors-index')!!}">Business Sectors I'am Interested In</a></li>
    </ul>
  </li>
<!--------------------------------------------------------End Personal Profile------------------------------------------------------------>

<li class="sub-menu">
 <a href=""><i class="zmdi zmdi-view-list"></i>Create E-commerce Site </a>
    <ul>
      <li class="sub-menu">
          <a href="">E-commerce Site Configuration</a>
          <ul>
              <li><a href="{!! route('ecomm-index')!!}">Create Your e-Commerce Site</a></li>
              <li><a href="{!!route('productcatalog')!!}">Product Catalogs</a></li>
              <li><a href="{!!route('certificationlogos')!!}">Certification Logos</a></li>
              <!--<li><a href="{!! route('site.logo.index')!!}">Add Site Logo</a></li>-->
              <li><a href="{!! route('site.header.images.index')!!}">Site Images</a></li>
              <!--<li><a href="{!!route('cms.create')!!}">Add Page</a></li>-->
              <li><a href="{!!route('cms.index')!!}">Site Pages</a></li>
              <li><a href="{!!route('follower.all')!!}">Followers</a></li>
              <li><a href="{!!route('sociallink.index')!!}">Social Links</a></li>
          </ul>
      </li>
</ul>           
</li> 
<!-------------------------------------------End E-commerce site----------------------------------------------------------->
<!-------------------------------------------Product Management----------------------------------------------------------->
<li class="sub-menu">
  <a href=""><i class="zmdi zmdi-view-list"></i> Product Management </a>
  <ul>
    <li><a href="{!!route('select_cat_to_sell.index')!!}">ADD PRODUCTS/SERVICES</a></li>
    <li><a href="{!!route('select_cat_to_buy.index')!!}">Product/Service Procurement</a></li>
    <li><a href="{!!route('products/list')!!}">View Products</a></li>
    <li><a href="{!!route('product_promo.index')!!}">Product Promotional Banner/Sticker</a></li>
    <li><a href="{!!route('abandoned_cart')!!}">Abandoned Cart</a></li>
    <li><a href="{!! route('multi_item.index')!!}">Create Multi-Item Products</a></li>
    <li><a href="{!! route('cross_selling.index')!!}">Add Cross-Selling Product</a></li>
    <li><a href="{!! route('up_selling.index')!!}">Add Up-Selling Product</a></li>
    <li><a href="{!! route('bundle/combo.index')!!}">Add Bundle/Combo Product</a></li>
    <li><a href="{!! route('opportunities.index')!!}">Create Opportunities</a></li>
    <li><a href="{!! route('import_product.list_product')!!}">Import Products</a></li>
      <li class="sub-menu">
        <a href="">Reviews</a>
        <ul>
          <li><a href="{!!route('userreview.index')!!}">View Product Reviews</a></li>
          <li><a href="{!!route('sellerreview.index')!!}">View Seller Reviews</a></li>
        </ul>
      </li>
  </ul>           
</li> 
<!-------------------------------------------End Product Management----------------------------------------------------------->

<!-------------------------------------------Search Business Companies----------------------------------------------------------->
  <li class="sub-menu">
      <a href=""><i class="zmdi zmdi-view-list"></i> Search Companies/Sites</a>
      <ul>
            <li><a href="{!! route('search-business')!!}">Search</a></li>
      </ul>
  </li>
<!-------------------------------------------End Search Business Companies----------------------------------------------------------->
