<li><a href="{!! route('dash-board')!!}"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
<!--------------------------------------------------------Personal Profile------------------------------------------------------------------>
  <li class="sub-menu">
    <a href=""><i class="zmdi zmdi-view-list"></i>Personal Profile</a>
    <ul>
        <li><a href="{!! route('profile-index')!!}">Your Account</a></li>
        <li><a href="{!! route('personal-info-create')!!}">Personal Info</a></li>
        <li><a href="{!! route('social-info-create')!!}">Social Info</a></li>
<!--        <li class="sub-menu">
           <a href="">Business Sectors</a>
           <ul>-->
                <li><a href="{!! route('business-sectors-index')!!}">Business Sectors I'am Interested In</a></li>
<!--           </ul>           
        </li> 	-->
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
    <li><a href="{!!route('select_cat.index')!!}">Add Product</a></li>
    <li><a href="{!!route('products/list')!!}">View Products</a></li>
    <li><a href="{!!route('product_promo.index')!!}">Product Promotional Banner/Sticker</a></li>
    <li><a href="{!!route('abandoned_cart')!!}">Abandoned Cart</a></li>
    <li><a href="{!! route('multi_item.index')!!}">Create Multi-Item Products</a></li>
    <li><a href="{!! route('cross_selling.index')!!}">Add Cross-Selling Product</a></li>
    <li><a href="{!! route('up_selling.index')!!}">Add Up-Selling Product</a></li>
    <li><a href="{!! route('bundle/combo.index')!!}">Add Bundle/Combo Product</a></li>
    <li><a href="{!! route('opportunities.index')!!}">Create Opportunities</a></li>
<!--    <li class="sub-menu">
          <a href="">Import Products</a>
          <ul>-->
              <li><a href="{!! route('import_product.list_product')!!}">Import Products</a></li>
<!--              <li><a href="{!! route('import_product.view_files')!!}">Download Product Attribute File</a></li>
              <li><a href="{!! route('import_product.import')!!}">Import Products</a></li>
              <li><a href="{!! route('import_product.info')!!}">Import Info</a></li>-->
<!--          </ul>
      </li>-->
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
<!-------------------------------------------Search Business Partners------------------------------------------------>
<li class="sub-menu">
    <a href=""><i class="zmdi zmdi-view-list"></i> Search Business Partners  </a>
    <ul>
        <li class="sub-menu">
          <a href="">Search Companies In Gdoox</a>
          <ul>
                <li><a href="{!! route('invite.company.index')!!}">Invite Partner</a></li>
                <li><a href="{!! route('invite.company.show')!!}"">Accept/Deny Invitation</a></li>
                <li><a href="{!! route('invite.company.status')!!}">Invitation Status</a></li>
          </ul>
        </li>
    </ul>
</li>
<!-------------------------------------------End Search Business Partners ----------------------------------------------------------->
<!-------------------------------------------Invite Business Partners ----------------------------------------------------------->
<li class="sub-menu">
  <a href=""><i class="zmdi zmdi-view-list"></i>Business Ecosystem</a>
  <ul>
        <li><a href="{!! route('invite.ext.partner.create')!!}">Invite Company (not yet a GDOOX Member)</a></li>
        <li><a href="{!! route('invite.inter.partner.create')!!}">Invite Company (already a GDOOX Member)</a></li>
        <li><a href="{!! route('invite.partner.show')!!}"">Accept/Deny Invitation</a></li>
<!--    <li><a href="{!! route('invite.partner.status')!!}">Invitation Status</a></li>-->
        <li><a href="{!! route('share.site.index')!!}">Share Sites & Products</a></li>
   </ul>
</li>
<!-------------------------------------------End Invite Business Partners ----------------------------------------------------------->
<!-------------------------------------------End Search Business Partners ----------------------------------------------------------->
<!------------------------------------------------Distribution Network -------- ----------------------------------------------------------->
<li class="sub-menu">
  <a href=""><i class="zmdi zmdi-view-list"></i>Distribution Network</a>
  <ul>
    <li><a href="{!!route('distributionnetwork.create')!!}">Distribution Network</a></li>
    <!--<li><a href="{!!route('distributionnetwork.index')!!}">View Network</a></li>-->
  </ul>
</li>
<!-------------------------------------------End Distribution Network ----------------------------------------------------------->



<!-----------------------------------------------Create E-commerce Site-------------------------------------------------------------->
<!--<li class="sub-menu">
 <a href=""><i class="zmdi zmdi-view-list"></i>Create E-commerce Site </a>
    <ul>
      <li class="sub-menu">
          <a href="">Company Profile</a>
          <ul>
                <li><a href="{!! route('permisson.denied')!!}">Create Your Company Profile</a></li>
          </ul>
      </li>
      <li class="sub-menu">
          <a href="">Accept Payment Methods</a>
          <ul>
              <li><a href="{!! route('permisson.denied')!!}">Payment Method</a></li>
          </ul>
      </li>
        <li class="sub-menu">
           <a href="">Business Sectors</a>
           <ul>
                <li><a href="{!! route('permisson.denied')!!}">Business Sectors I'am Interested In</a></li>
           </ul>           
        </li> 	
      <li class="sub-menu">
          <a href="">Manage E-commerce Site</a>
          <ul>
              <li><a href="{!! route('permisson.denied')!!}">Create Your e-Commerce Site</a></li>
              <li><a href="{!!route('permisson.denied')!!}">Add Catalog</a></li>
              <li><a href="{!!route('permisson.denied')!!}">Add Certification Logos</a></li>
              <li><a href="{!! route('permisson.denied')!!}">Add Site Logo</a></li>
              <li><a href="{!! route('permisson.denied')!!}">Add Site Images</a></li>
              <li><a href="{!!route('permisson.denied')!!}">Add Page</a></li>
              <li><a href="{!!route('permisson.denied')!!}">Show Pages</a></li>
          </ul>
      </li>
    </ul>           
</li> 
-----------------------------------------End E-commerce site---------------------------------------------------------
-----------------------------------------Product Management---------------------------------------------------------
<li class="sub-menu">
  <a href=""><i class="zmdi zmdi-view-list"></i> Product Management </a>
  <ul>
    <li><a href="{!!route('permisson.denied')!!}">Add Product</a></li>
    <li><a href="{!!route('permisson.denied')!!}">View Products</a></li>
      <li class="sub-menu">
        <a href="">Reviews</a>
        <ul>
          <li><a href="{!!route('permisson.denied')!!}">View Product Reviews</a></li>
          <li><a href="{!!route('permisson.denied')!!}">View Seller Reviews</a></li>
        </ul>
      </li>
  </ul>           
</li> 
-----------------------------------------End Product Management---------------------------------------------------------
----------------------------------------------------Manage Users---------------------------------------------------------
<li class="sub-menu">
  <a href=""><i class="zmdi zmdi-view-list"></i>Manage Company Accounts </a>
  <ul>
      <li class="sub-menu">
        <a href="">User Management & Roles</a>
        <ul>
            <li><a href="{!! route('permisson.denied')!!}">Add User</a></li>
            <li><a href="{!! route('permisson.denied')!!}">All Users</a></li>
        </ul>
      </li>
  </ul>           
</li> 
-----------------------------------------End Manage Users---------------------------------------------------------
-----------------------------------------Search Business Partners----------------------------------------------
<li class="sub-menu">
    <a href=""><i class="zmdi zmdi-view-list"></i> Search Business Partners </a>
    <ul>
        <li class="sub-menu">
          <a href="">Search Companies In Gdoox</a>
          <ul>
                <li><a href="{!! route('search-business')!!}">Search</a></li>
                <li><a href="{!! route('invite.business.company.index')!!}">Invite Partner</a></li>
                <li><a href="{!! route('invite.business.company.show')!!}"">Accept/Deny Invitation</a></li>
                <li><a href="{!! route('invite.business.company.status')!!}">Invitation Status</a></li>
          </ul>
        </li>
    </ul>           
</li>
-----------------------------------------End Search Business Partners ---------------------------------------------------------
----------------------------------------------Distribution Network -------- ---------------------------------------------------------
<li class="sub-menu">
  <a href=""><i class="zmdi zmdi-view-list"></i>Distribution Network</a>
  <ul>
    <li><a href="{!!route('distributionnetwork.create')!!}">Distribution Network</a></li>
    <li><a href="{!!route('distributionnetwork.index')!!}">View Network</a></li>
  </ul>
</li>
-----------------------------------------End Distribution Network ----------------------------------------------------------->
<!-------------------------------------------Search Business Companies----------------------------------------------------------->
  <li class="sub-menu">
      <a href=""><i class="zmdi zmdi-view-list"></i> Search Companies/Sites</a>
      <ul>
            <li><a href="{!! route('search-business')!!}">Search</a></li>
      </ul>
  </li>
<!-------------------------------------------End Search Business Companies----------------------------------------------------------->