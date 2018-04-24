<!-------------------GDOOX PLATFORM MANAGEMENT TEAM-------------------------------------->
<li><a href="{!! route('dash-board')!!}"><i class="zmdi zmdi-home"></i> Dashboard</a></li>

<li class="sub-menu">
    <a href=""><i class="zmdi zmdi-view-list"></i> GDOOX PLATFORM MANAGEMENT TEAM</a>
    <ul>
        <li><a href="{!!route('attributes.index')!!}">Attribute List</a></li>
        <li><a href="{!!route('attributesassoc.index')!!}">Attribute Association</a></li>
        <li><a href="{!!route('attributestype.index')!!}">Attribute Data Type</a></li>
        <li><a href="{!!route('dropdownoptions.index')!!}">Dropdown Option List</a></li>
        <li><a href="{!!route('categories.index')!!}">Categories</a></li>
        <li><a href="{!! route('category-upload-create')!!}">Categories Import</a></li>
        <li><a href="{!! route('business-details-index')!!}">View All Business Info</a></li>
        
        <li class="sub-menu">
            <a href=""><i class="zmdi zmdi-view-list"></i> USER MANAGEMENT</a>
            <ul>
                <li><a href="{!! route('gdoox_member.view_all')!!}">Gdoox Member</a></li>
                <li><a href="{!! route('user-create')!!}">Add User</a></li>
                <li><a href="{!! route('users')!!}">All Users</a></li>
                <li><a href="{!! route('invite-user-create')!!}">Invite User</a></li>
                <li><a href="{!! route('invite-multi-user-create')!!}">Invite Multi Users</a></li>
				<li><a href="{!! route('show-invited-users')!!}">View Invitations Sent</a></li>
				
            </ul>           
        </li>
        <!--li><a href="{!! route('country-subscription.index')!!}">Charges by Countries</a></li>
        <li><a href="{!! route('gdoox-subscription.index')!!}">Subsciption Discounts</a></li>
        <li><a href="{!! route('subscription-charges.index')!!}">Subsciption Charges</a></li-->
		<li><a href="{!! route('gdoox-paypal.index')!!}">Subscription Payment Info</a></li>
        <li class="sub-menu">
            <a href=""><i class="zmdi zmdi-view-list"></i> COMMERCIAL PLANS</a>
            <ul>
                <li><a href="{!! route('plan_configuration.index')!!}">View Default Plans</a></li>
                <li><a href="{!! route('plan_configuration.create')!!}?id=personal-user">Update ProficientUP Plan</a></li>
                <li><a href="{!! route('plan_configuration.create')!!}?id=mono-user">Update E-COM Plan</a></li>
                <li><a href="{!! route('plan_configuration.create')!!}?id=multi-user">Update E-COM Plus Plan</a></li>
                <li><a href="{!! route('plan_configuration.create')!!}?id=company-network-user">Update Company Network Plan</a></li>
                <li><a href="{!! route('plan_configuration.create')!!}?id=ecosystem-user">Update Business Ecosystem Plan</a></li>
                <li><a href="{!! route('plan_configuration_country.index')!!}">View Plans by Country</a></li>
                <li><a href="{!! route('plan_configuration_country.create')!!}">Create Plans by Country</a></li>
                <!--<li><a href="{!! route('plan_configuration_country.create')!!}">Create Country Wise Plans</a></li>-->
            </ul>           
        </li>
        
    </ul>           
</li> 
<!--------------------------------------------END GDOOX PLATFORM MANAGEMENT TEAM-------------------------------------->
<!--------------------------------------------------------Personal Profile------------------------------------------------------------------>
<li class="sub-menu">
  <a href=""><i class="zmdi zmdi-view-list"></i>PERSONAL PROFILE</a>
  <ul>
      <li><a href="{!! route('profile-index')!!}">Your Account</a></li>
      <li><a href="{!! route('personal-info-create')!!}">Personal Info</a></li>
      <li><a href="{!! route('relation-info-create')!!}">Relationship with Gdoox</a></li>
      <li><a href="{!! route('interest-info-create')!!}">Interests</a></li>
      <li><a href="{!! route('business-sectors-index')!!}">Business Sectors I'm Interested In</a></li>
    </ul>
</li>
<!--------------------------------------------------------End Personal Profile------------------------------------------------------------>
<!-----------------------------------------------Create E-commerce Site--------------------------------------------------------------->
<li class="sub-menu">
    <a href=""><i class="zmdi zmdi-view-list"></i>COMPANY PROFILE </a>
    <ul>
      <li class="sub-menu">
          <a href="">Business Info</a>
          <ul>
                <li><a href="{!! route('business-info-index')!!}">Add and Verify your Business Info</a></li>
          </ul>
      </li>
      <li class="sub-menu">
          <a href="">Accept Payment Methods</a>
          <ul>
              <li><a href="{!! route('payment-method-index')!!}">Payment Method</a></li>
          </ul>
      </li>
    </ul>           
</li> 

<li class="sub-menu">
    <a href=""><i class="zmdi zmdi-view-list"></i>CREATE E-COMMERCE SITE (CMS/DAM)</a>
    <ul>
      <li class="sub-menu">
          <a href="">E-commerce Site Configuration</a>
          <ul>
              <li><a href="{!! route('ecomm-index')!!}">Configure your e-commerce site/s</a></li>
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

<!-----------------------------------------------------End E-commerce site----------------------------------------------------------->
<!-----------------------------------------------------Product Management----------------------------------------------------------->
<li class="sub-menu">
  <a href=""><i class="zmdi zmdi-view-list"></i> PRODUCT MANAGEMENT </a>
  <ul>
        <li><a href="{!! route('select_cat_to_sell.index') !!}">Add Products/Services</a></li>
        <li><a href="{!! route('select_cat_to_buy.index') !!}">Add Product/Service Procurement</a></li>
        <li><a href="{!! route('products/list') !!}">View Products/Services</a></li>
	  
		<li class="sub-menu">
		  <a href=""><i class="zmdi zmdi-view-list"></i> Products/Services Classification</a>
		  <ul>	  
			<li><a href="{!! route('classifications_labels.index') !!}">View Classification Labels</a></li>
			<li><a href="{!! route('classifications_labels.create') !!}">Create Classification Labels</a></li>
		  	<li><a href="{!! route('products/list') !!}">Assign Products/Services Classification</a></li>
		  </ul>
		</li>	  
	  
	  
        <li><a href="{!! route('products/procurements','buy') !!}">View Products/Service Procurement</a></li>
        <li><a href="{!! route('import_product.list_product')!!}">Import Products</a></li>
  </ul>
</li>
<!-------------------------------------------End Product Management--------------------------------------------------------------->

<!-----------------------------------------------------Marketing----------------------------------------------------------->
<li class="sub-menu">
  <a href=""><i class="zmdi zmdi-view-list"></i> MARKETING </a>
  <ul>
        <li><a href="{!! route('auction.index') !!}">Auction Bids </a></li>
        <li><a href="{!! route('reverse-auction.index') !!}">Reverse Auction Bids </a></li>
        <li><a href="{!! route('user-auction.index') !!}">Your Auction Bids </a></li>
        <li><a href="{!! route('user-reverse-auction.index') !!}">Your Reverse Auction Bids </a></li>
        <li><a href="{!! route('product_promo.index') !!}">Product Promotional Banner/Sticker</a></li>
        <li><a href="{!! route('abandoned_cart') !!}">Abandoned Cart</a></li>
        <li><a href="{!! route('multi_item.index') !!}">Configure Multi-Item Products</a></li>
        <li><a href="{!! route('cross_selling.index') !!}">Add Cross Selling Products</a></li>
        <li><a href="{!! route('up_selling.index') !!}">Add Up-Selling Products</a></li>
        <li><a href="{!! route('bundle/combo.index') !!}">Add Bundle/Combo Products</a></li>
        <li><a href="{!! route('opportunities.index') !!}">Create Opportunities </a></li>
        <li class="sub-menu">
            <a href="">Reviews</a>
            <ul>
                <li><a href="{!!route('userreview.index')!!}">View Product Reviews</a></li>
                <li><a href="{!!route('sellerreview.index')!!}">View Seller Reviews</a></li>
            </ul>
        </li>
  </ul>
</li>
<!-------------------------------------------End Marketing--------------------------------------------------------------->



<!------------------------------------------------------Campaigns-------------------------------------------------------------------->
<li class="sub-menu">
  <a href=""><i class="zmdi zmdi-view-list"></i>ADVERTISING</a>
  <ul>
    <li><a href="{!! route('campaigns.create')!!}">Add Campaigns</a></li>
    <li><a href="{!! route('campaigns.request')!!}">Add Campaign Request</a></li>
  </ul>           
</li>
<!-------------------------------------------End Campaigns------------------------------------------------------------------------->


<!------------------------------------------------------Manage Users-------------------------------------------------------------------->
<li class="sub-menu">
  <a href=""><i class="zmdi zmdi-view-list"></i>MANAGING ACCOUNT</a>
  <ul>
    <li><a href="{!! route('invite.colleague')!!}">Invite your Colleagues</a></li>
    <li><a href="{!! route('colleague.all')!!}">View Users And Define Role</a></li>
    <li><a href="{!! route('colleague.all')!!}">Permissions</a></li>
  </ul>           
</li>
<!-------------------------------------------End Manage Users------------------------------------------------------------------------->

<!-------------------------------------------Search Business Partners---------------------------------------------------------------->

<li class="sub-menu">
    <a href=""><i class="zmdi zmdi-view-list"></i> MANAGE YOUR ALLIANCES</a>
    <ul>
        <li class="sub-menu">
          <a href="">Search Companies In Gdoox</a>
          <ul>
            <li><a href="{!! route('invite.company.index')!!}">Invite Partner</a></li>
            <li><a href="{!! route('invite.company.show')!!}">Accept/Deny Invitation</a></li>
            <li><a href="{!! route('invite.company.status')!!}">Invitation Status</a></li>
          </ul>
        </li>
    </ul>
</li>
<!-------------------------------------------End Search Business Partners -------------------------------------------------------->

<!-------------------------------------------Invite Business Partners ----------------------------------------------------------------->
<li class="sub-menu">
  <a href=""><i class="zmdi zmdi-view-list"></i>COMPANY NETWORK</a>
  <ul> 
        <li><a href="{!! route('company.network.assign.site')!!}">Assign Company Network Functions to a Site.</a></li>
        <li><a href="{!! route('company.network.invite.create')!!}">Invite Company</a></li>
        <li><a href="{!! route('company.network.show')!!}">Accept/Deny Invitation</a></li>
        <li><a href="{!! route('network.share.site.index')!!}">Share Sites & Products</a></li>
        <li><a href="{!! route('import-network-products.select_network')!!}">Import Partner's Products</a></li>
        <li><a href="{!! route('import-net-products.list_company')!!}">Import Products to Network</a></li>
        <li><a href="{!! route('comnetwork.product.index')!!}">Manage Products On Company Network</a></li>
  </ul>
</li>
<!-------------------------------------------End Invite Business Partners ----------------------------------------------------------->

<!-------------------------------------------Invite Business Partners ----------------------------------------------------------------->
<li class="sub-menu">
  <a href=""><i class="zmdi zmdi-view-list"></i>BUSINESS ECOSYSTEM</a>
  <ul>
        <li><a href="{!! route('ecosys.site.indexall')!!}">Create A New Business Ecosystem</a></li>
        <li><a href="{!! route('invite.ext.partner.create')!!}">Invite Company (not yet a GDOOX Member)</a></li>
        <li><a href="{!! route('invite.inter.partner.create')!!}">Invite Company (already a GDOOX Member)</a></li>
        <li><a href="{!! route('invite.partner.show')!!}">Accept/Deny Invitation</a></li>
<!--    <li><a href="{!! route('invite.partner.status')!!}">Invitation Status</a></li>-->
        <li><a href="{!! route('share.site.index')!!}">Share Sites & Products</a></li>
        <li><a href="{!! route('import-ecom-products.select_ecom')!!}">Import Partner's Products</a></li>
        <li><a href="{!! route('import-ecom-products.list_company')!!}">Import Products to Ecosystem</a></li>
        <li><a href="{!! route('ecosys.product.index')!!}">Manage Products On Business Ecosystem</a></li>
  </ul>
</li>
<!-------------------------------------------End Invite Business Partners ----------------------------------------------------------->


<!------------------------------------------------Distribution Network -------- --------------------------------------------------------->
<!--<li class="sub-menu">
  <a href=""><i class="zmdi zmdi-view-list"></i>DISTRIBUTION NETWORK</a>
  <ul>
        <li><a href="{!!route('distributionnetwork.create')!!}">Distribution Network</a></li>
  </ul>
</li>-->
<!-------------------------------------------End Distribution Network ----------------------------------------------------------------->
<!-----------------------------------------------------User Management---------------------------------------------------------------->
<!--<li class="sub-menu">
  <a href=""><i class="zmdi zmdi-view-list"></i> USER MANAGEMENT</a>
  <ul>
      <li><a href="{!! route('gdoox_member.view_all')!!}">Gdoox Member</a></li>
      <li><a href="{!! route('user-create')!!}">Add User</a></li>
      <li><a href="{!! route('users')!!}">All Users</a></li>
      <li><a href="{!! route('invite-user-create')!!}">Invite User</a></li>
      <li><a href="{!! route('invite-multi-user-create')!!}">Invite Multi Users</a></li>
  </ul>           
</li>-->
<!--------------------------------------------------------End User Management------------------------------------------------------->

<!-----------------------------------------------------Create Tasks------------------------------------------------------------------------>

<li class="sub-menu">
    <a href=""><i class="zmdi zmdi-view-list"></i> CONTACT MANAGER</a>
    <ul>
        <li><a href="{!! route('tasks.index')!!}">Tasks</a></li>
        <li class="sub-menu">
            <a href="">Users</a>
            <ul>
                <li><a href="{!! route('crm_users.index')!!}">Users</a></li>
                <li><a href="{!! route('select_group')!!}">Add Users to Groups</a></li>
            </ul>          
        </li>
        <li><a href="{!! route('crm_accounts.index')!!}">Accounts</a></li>
        <li class="sub-menu">
            <a href="">Opportunities</a>
            <ul>
               <li><a href="{!! route('crm_opportunities.index')!!}">CRM Opportunities</a></li>
               <li><a href="{!! route('ab_cart_opportunities.index')!!}">Abandoned Cart Opportunities</a></li>
            </ul>           
        </li>
        <li><a href="{!! route('crm_groups.index')!!}">Groups</a></li>
        <li class="sub-menu">
            <a href="">Contacts</a>
            <ul>
                <li><a href="{!! route('crm_contacts.columns')!!}">Export Contacts Excel Format</a></li>
                <li><a href="{!! route('crm_contacts.index')!!}">View Contacts</a></li>
                <li><a href="{!! route('crm_contacts.upload_excel')!!}">Import Contacts</a></li>
                <li><a href="{!! route('crm_contacts.export_excel')!!}">Export Contacts</a></li>
                <li><a href="{!! route('crm_contactsgroup.index')!!}">Contact Groups</a></li>
                <li><a href="{!! route('select_contact_group')!!}">Add Users to Contact Groups</a></li>
            </ul>          
        </li>
        <li class="sub-menu">
            <a href="">Emails</a>
            <ul>
                <li><a href="{!! route('crm_emails.index')!!}">Email's</a></li>
                <li><a href="{!! route('crm_emails.drafts')!!}">View Drafts</a></li>
            </ul>           
        </li>
        <li><a href="{!! route('crm_templates.index')!!}">Templates</a></li>
    </ul>
</li>
<!--------------------------------------------------------End Create Tasks------------------------------------------------------------->
<li class="sub-menu">
    <a href=""><i class="zmdi zmdi-view-list"></i> CRM</a>
	<ul>
		<li class="sub-menu">
			<a href="">Contact</a>
			<ul>
				<li><a href="{!! route('under-testing.index')!!}">Create Contact</a></li>
				<li><a href="{!! route('under-testing.index')!!}">Create Contact From vCard</a></li>
				<li><a href="{!! route('under-testing.index')!!}">View Contacts</a></li>
				<li><a href="{!! route('under-testing.index')!!}">Import Contacts</a></li>
				<li><a href="{!! route('under-testing.index')!!}">Abandoned car contact</a></li>
				<li><a href="{!! route('under-testing.index')!!}">Leads</a></li>
			</ul>           
		</li>

		<li class="sub-menu">
			<a href="">Sales</a>
			<ul>
				<li><a href="{!! route('under-testing.index')!!}">Home</a></li>
				<li><a href="{!! route('under-testing.index')!!}">Accounts</a></li>
				<li><a href="{!! route('under-testing.index')!!}">Contacts</a></li>
				<li><a href="{!! route('under-testing.index')!!}">Opportunities</a></li>
				<li><a href="{!! route('under-testing.index')!!}">Leads</a></li>
			</ul>           
		</li>

		<li class="sub-menu">
			<a href="">Products</a>
			<ul>
				<li><a href="{!! route('under-testing.index')!!}">Product list</a></li>
				<li><a href="{!! route('under-testing.index')!!}">Opportunities</a></li>
			</ul>           
		</li>
		<li class="sub-menu">
			<a href="">Marketing</a>
			<ul>
				<li><a href="{!! route('under-testing.index')!!}">Home</a></li>
				<li><a href="{!! route('under-testing.index')!!}">Accounts</a></li>
				<li><a href="{!! route('under-testing.index')!!}">Contacts</a></li>
				<li><a href="{!! route('under-testing.index')!!}">Leads</a></li>
				<li><a href="{!! route('under-testing.index')!!}">Campaigns</a></li>
				<li><a href="{!! route('under-testing.index')!!}">Targets</a></li>
				<li><a href="{!! route('under-testing.index')!!}">Target Lists</a></li>
			</ul>           
		</li>

		<li class="sub-menu">
			<a href="">Activities</a>
			<ul>
				<li><a href="{!! route('under-testing.index')!!}">Home</a></li>
				<li><a href="{!! route('under-testing.index')!!}">Calendar</a></li>
				<li><a href="{!! route('under-testing.index')!!}">Calls</a></li>
				<li><a href="{!! route('under-testing.index')!!}">Meetings</a></li>
				<li><a href="{!! route('under-testing.index')!!}">Emails</a></li>
				<li><a href="{!! route('under-testing.index')!!}">Tasks</a></li>
				<li><a href="{!! route('under-testing.index')!!}">Notes</a></li>
				<li><a href="{!! route('under-testing.index')!!}">Contacts</a></li>
			</ul>           
		</li>

		<li class="sub-menu">
			<a href="">Collaboration</a>
			<ul>
				<li><a href="{!! route('under-testing.index')!!}">Home</a></li>
				<li><a href="{!! route('under-testing.index')!!}">Emails</a></li>
				<li><a href="{!! route('under-testing.index')!!}">Documents</a></li>
				<li><a href="{!! route('under-testing.index')!!}">Projects</a></li>
				<li><a href="{!! route('under-testing.index')!!}">Contacts</a></li>
				<li><a href="{!! route('under-testing.index')!!}">Group</a></li>
			</ul>           
		</li>
	
	</ul>
</li>
<!-------------------------------------------Search Business Companies----------------------------------------------------------->
<li class="sub-menu">
    <a href=""><i class="zmdi zmdi-view-list"></i> SEARCH COMPANIES/SITES</a>
    <ul>
          <li><a href="{!! route('search-business')!!}">Search</a></li>
    </ul>
</li>
<!-------------------------------------------End Search Business Companies----------------------------------------------------->

<!------------------------------------------- Messaging System ----------------------------------------------------------->
<li class="sub-menu">
    <a href=""><i class="zmdi zmdi-view-list"></i> CHAT</a>
    <ul>
      <li><a href="{!! route('chat.create')!!}">Internal Messaging</a></li>
<!--    <li><a href="{!! route('chat.index')!!}">Chat Invitations</a></li>-->
    </ul>
</li>


<!-------------------------------------------End Messaging System ----------------------------------------------------->

<!------------------------------------------- Messaging System ----------------------------------------------------------->
<li class="sub-menu">
    <a href=""><i class="zmdi zmdi-view-list"></i> ORDERS (OMS)</a>
    <ul>
        <li><a href="{!! route('userorders.index')!!}">My Orders</a></li>
        <li><a href="{!! route('show-wishlist')!!}">My Wishlist</a></li>
        <li><a href="{!! route('orders.index')!!}">Orders</a></li>
        <li><a href="{!! route('product-return-request')!!}">Product Return Requests</a></li>
        <li><a href="{!! route('contact-buyer-index')!!}">Buyer Complaints</a></li>
        <li><a href="{!! route('contact-gdoox-create') !!}">Contact Gdoox</a></li>
        <li><a href="{!! route('contact-gdoox-index') !!}">View Complaints to Gdoox</a></li>
        <li><a href="{!! route('price-request.index') !!}">View B2B Price Requests</a></li>
    </ul>
</li>
<!-------------------------------------------End Messaging System ----------------------------------------------------->
<!-------------------------------------------Importing Dropdown Options ----------------------------------------------------->
<!--<li class="sub-menu">
    <a href=""><i class="zmdi zmdi-view-list"></i> DROPDOWN OPTIONS</a>
    <ul>
        <li><a href="{!! route('import.dropdown.options')!!}">Import Dropdown Options</a></li>
    </ul>
</li>-->
<!-------------------------------------------End Importing Dropdown Options ----------------------------------------------------->


<!------------------------------------------- Messages ----------------------------------------------------------->
<!--  <li class="sub-menu">
      <a href=""><i class="zmdi zmdi-view-list"></i> Messages</a>
      <ul>
          <li><a href="{!! route('viewmessages.index')!!}">View Messages</a></li>
      </ul>
  </li>-->
<!-------------------------------------------Messages----------------------------------------------------->

<!-------------------------------------------Search Business Companies----------------------------------------------------------->
<!--  <li class="sub-menu">
      <a href=""><i class="zmdi zmdi-view-list"></i> Exceptions</a>
      <ul>
            <li><a href="{!! route('exceptions.index') !!}">View</a></li>
      </ul>
  </li>-->
<!-------------------------------------------End Search Business Companies----------------------------------------------------->
