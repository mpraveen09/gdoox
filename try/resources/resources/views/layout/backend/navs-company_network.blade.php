<li><a href="{!! route('dash-board')!!}"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
<!--------------------------------------------------------Personal Profile------------------------------------------------------------------>
<li class="sub-menu">
  <a href=""><i class="zmdi zmdi-view-list"></i>PERSONAL PROFILE</a>
  <ul>
      <li><a href="{!! route('profile-index')!!}">Your Account</a></li>
      <li><a href="{!! route('personal-info-create')!!}">Personal Info</a></li>
      <!--<li><a href="{!! route('social-info-create')!!}">Social Info</a></li>-->      
      <li><a href="{!! route('relation-info-create')!!}">Relationship With Gdoox</a></li>
      <li><a href="{!! route('interest-info-create')!!}">Interests</a></li>
      <li><a href="{!! route('business-sectors-index')!!}">Business Sectors I’m Interested In</a></li>
    </ul>
</li>
<!--------------------------------------------------------End Personal Profile------------------------------------------------------------>

<li class="sub-menu">
    <a href=""><i class="zmdi zmdi-view-list"></i>COMPANY PROFILE </a>
    <ul>
      <li class="sub-menu">
          <a href="">Business Info</a>
          <ul>
                <li><a href="{!! route('business-info-index')!!}">Add and Verify your Business Info</a></li>
                <!--<li><a href="{!! route('business-info-verify')!!}">Verify Your Business Info</a></li>-->     
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
<!-----------------------------------------------Create E-commerce Site-------------------------------------------------------------->
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
        <li><a href="{!! route('select_cat_to_buy.index') !!}">Add Product/Service Procurement</a></li>
        <li><a href="{!! route('products/list') !!}">View Products/Services</a></li>
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
        <li><a href="{!! route('multi_item.index') !!}">Configure Multi-Item Product</a></li>
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
        <!--<li><a href="{!! route('campaigns.create')!!}">Add Campaigns</a></li>-->
        <li><a href="{!! route('campaigns.request')!!}">Add Campaign Request</a></li>
  </ul>           
</li>
<!-------------------------------------------End Campaigns------------------------------------------------------------------------->


<!------------------------------------------------------Manage Users-------------------------------------------------------------------->
<li class="sub-menu">
  <a href=""><i class="zmdi zmdi-view-list"></i>MANAGING ACCOUNT</a>
  <ul>
    <li><a href="{!! route('invite.colleague')!!}">Invite Your Colleagues</a></li>
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
                <li><a href="{!! route('invite.company.show')!!}"">Accept/Deny Invitation</a></li>
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

<!-------------------------------------------Invite Business Partners ----------------------------------------------------------->
<li class="sub-menu">
    <a href=""><i class="zmdi zmdi-view-list"></i>BUSINESS ECOSYSTEM</a>
    <ul>
          <li><a href="{!! route('invite.partner.show')!!}">Accept/Deny Invitation</a></li>
          <li><a href="{!! route('share.site.index')!!}">Share Sites & Products</a></li>
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

<li class="sub-menu">
    <a href=""><i class="zmdi zmdi-view-list"></i> CRM</a>
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

!-------------------------------------------Search Business Companies----------------------------------------------------------->
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
<!--            <li><a href="{!! route('chat.index')!!}">Chat Invitations</a></li>-->
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
          <!--<li><a href="{!! route('contact-gdoox-index') !!}">View Complaints to Gdoox</a></li>-->
      </ul>
  </li>
<!-------------------------------------------End Messaging System ----------------------------------------------------->
