<li><a href="{!! route('dash-board')!!}"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
<!--------------------------------------------------------Personal Profile------------------------------------------------------------------>
  <li class="sub-menu">
    <a href=""><i class="zmdi zmdi-view-list"></i>PERSONAL PROFILE</a>
    <ul>
        <li><a href="{!! route('profile-index')!!}">Your Account</a></li>
        <li><a href="{!! route('personal-info-create')!!}">Personal Info</a></li>
        <li><a href="{!! route('relation-info-create')!!}">Relationship With Gdoox</a></li>
        <li><a href="{!! route('interest-info-create')!!}">Interests</a></li>
<!--    <li><a href="{!! route('social-info-create')!!}">Social Info</a></li>-->
        <li><a href="{!! route('business-sectors-index')!!}">Business Sectors I'am Interested In</a></li>
    </ul>
  </li>
<!--------------------------------------------------------End Personal Profile------------------------------------------------------------>

<li class="sub-menu">
    <a href=""><i class="zmdi zmdi-view-list"></i>CREATE E-COMMERCE SITE (CMS/DAM)</a>
    <ul>
      <li class="sub-menu">
          <a href="">E-commerce Site Configuration</a>
          <ul>
              <li><a href="{!! route('ecomm-index')!!}">Configure Your E-Commerce Site/s</a></li>
              <li><a href="{!!route('productcatalog')!!}">Product Catalogs</a></li>
              <li><a href="{!!route('certificationlogos')!!}">Certification Logos</a></li>
              <!--<li><a href="{!! route('site.logo.index')!!}">Add Site Logo</a></li>-->              
              <li><a href="{!! route('site.header.images.index')!!}">Site Images</a></li>
              <li><a href="{!!route('cms.index')!!}">Site Pages</a></li>
              <li><a href="{!!route('follower.all')!!}">Followers</a></li>
              <li><a href="{!!route('sociallink.index')!!}">Social Links</a></li>
          </ul>
      </li>
    </ul>           
</li> 

<!-------------------------------------------End E-commerce site----------------------------------------------------------->
<!-----------------------------------------------------Product Management----------------------------------------------------------->
<li class="sub-menu">
  <a href=""><i class="zmdi zmdi-view-list"></i> PRODUCT MANAGEMENT </a>
  <ul>
        <li><a href="{!! route('select_cat_to_sell.index') !!}">Add Products/Services</a></li>
        <li><a href="{!! route('select_cat_to_buy.index') !!}">Product/Service Procurement</a></li>
        <li><a href="{!! route('products/list') !!}">View Products/Services</a></li>
	  
		<li class="sub-menu">
		  <a href=""><i class="zmdi zmdi-view-list"></i> Products/Services Classification</a>
		  <ul>	  
			<li><a href="{!! route('classifications_labels.index') !!}">View Classification Labels</a></li>
			<li><a href="{!! route('classifications_labels.create') !!}">Create Classification Labels</a></li>
		  	<li><a href="{!! route('products/list') !!}">Assign Products/Services Classification</a></li>
		  </ul>
		</li>		  
  </ul>
</li>
<!-------------------------------------------End Product Management--------------------------------------------------------------->

<!-------------------------------------------Search Business Companies----------------------------------------------------------->
<li class="sub-menu">
    <a href=""><i class="zmdi zmdi-view-list"></i> SEARCH COMPANIES/SITES</a>
    <ul>
          <li><a href="{!! route('search-business')!!}">Search</a></li>
    </ul>
</li>
<!-------------------------------------------End Search Business Companies----------------------------------------------------->
