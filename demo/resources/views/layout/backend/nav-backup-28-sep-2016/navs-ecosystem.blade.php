<li><a href="{!! route('dash-board')!!}"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
<!--------------------------------------------------------Personal Profile------------------------------------------------------------------>
  <li class="sub-menu">
    <a href=""><i class="zmdi zmdi-view-list"></i>Personal Profile</a>
    <ul>
        <li><a href="{!! route('profile-index')!!}">Your Account</a></li>
        <li><a href="{!! route('personal-info-create')!!}">Personal Info</a></li>
        <li><a href="{!! route('social-info-create')!!}">Social Info</a></li>
        <li><a href="{!! route('relation-info-create')!!}">Relation with Gdoox</a></li>
        <li><a href="{!! route('interest-info-create')!!}">Interests</a></li>
<!--        <li class="sub-menu">
           <a href="">Business Sectors</a>
           <ul>-->
                <li><a href="{!! route('business-sectors-index')!!}">Business Sectors I'am Interested In</a></li>
<!--       </ul>           
        </li> 	-->
      </ul>
  </li>
<!--------------------------------------------------------End Personal Profile------------------------------------------------------------>


<!-----------------------------------------------Create E-commerce Site-------------------------------------------------------------->
<li class="sub-menu">
 <a href=""><i class="zmdi zmdi-view-list"></i>Create E-commerce Site </a>
    <ul>
      <li class="sub-menu">
          <a href="">Business Info</a>
          <ul>
                <li><a href="{!! route('business-info-index')!!}">Add Your Business Info</a></li>
                <li><a href="{!! route('business-info-verify')!!}">Verify Your Business Info</a></li>
          </ul>
      </li>
      <li class="sub-menu">
          <a href="">Accept Payment Methods</a>
          <ul>
              <li><a href="{!! route('payment-method-index')!!}">Payment Method</a></li>
          </ul>
      </li>
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
<!------------------------------------------------------Manage Users----------------------------------------------------------->
<li class="sub-menu">
  <a href=""><i class="zmdi zmdi-view-list"></i>Managing Account</a>
  <ul>
      <!--<li class="sub-menu">-->
        <!--<a href="">User Management & Roles</a>-->
        <!--<ul>-->
            <li><a href="{!! route('invite.colleague')!!}">Invite Your Colleague</a></li>
            <li><a href="{!! route('colleague.all')!!}">View Users And Define Role</a></li>
        <!--</ul>-->
      <!--</li>-->
  </ul>           
</li> 
<li>
    <a href="{!! route('colleague.all')!!}"><i class="zmdi zmdi-book zmdi-hc-fw"></i>Permissions</a>
</li>
<!-------------------------------------------End Manage Users----------------------------------------------------------->
<!-------------------------------------------Search Business Partners------------------------------------------------>
<li class="sub-menu">
    <a href=""><i class="zmdi zmdi-view-list"></i> Search Business Partners  </a>
    <ul>
        <li class="sub-menu">
          <a href="">Search Companies In Gdoox</a>
          <ul>
                <li><a href="{!! route('invite.company.index')!!}">Invite Partner</a></li>
                <li><a href="{!! route('invite.company.show')!!}"">Accept/Deny Invitation</a></li>
<!--                <li><a href="{!! route('invite.company.status')!!}">Invitation Status</a></li>-->
          </ul>
        </li>
    </ul>
</li><!-------------------------------------------End Search Business Partners ----------------------------------------------------------->

<!-------------------------------------------Invite Business Partners ----------------------------------------------------------->
<li class="sub-menu">
  <a href=""><i class="zmdi zmdi-view-list"></i>Business Ecosystem</a>
  <ul>
        <li><a href="{!! route('ecosys.site.indexall')!!}">Create A New Business Ecosystem</a></li>
        <li><a href="{!! route('invite.ext.partner.create')!!}">Invite Company (not yet a GDOOX Member)</a></li>
        <li><a href="{!! route('invite.inter.partner.create')!!}">Invite Company (already a GDOOX Member)</a></li>
        <li><a href="{!! route('invite.partner.show')!!}">Accept/Deny Invitation</a></li>
        <li><a href="{!! route('invite.partner.status')!!}">Invitation Status</a></li>
        <li><a href="{!! route('share.site.index')!!}">Share Sites & Products</a></li>
        <li><a href="{!! route('import-ecom-products.select_ecom')!!}">Import Partner's Products</a></li>
        <li><a href="{!! route('import-ecom-products.list_company')!!}">Import Products to Ecosystem</a></li>
        <li><a href="{!! route('ecosys.product.index')!!}">Manage Products On Business Ecosystem</a></li>
  </ul>
</li>
<!-------------------------------------------End Invite Business Partners ----------------------------------------------------------->

<!-------------------------------------------Invite Business Partners ----------------------------------------------------------->
<li class="sub-menu">
    <a href=""><i class="zmdi zmdi-view-list"></i>Company Networks</a>
    <ul>
        <li><a href="{!! route('company.network.assign.site')!!}">Assign Company Network Functions to a Site.</a></li>
        <li><a href="{!! route('company.network.invite.create')!!}">Invite Company</a></li>
        <li><a href="{!! route('company.network.show')!!}">Accept/Deny Invitation</a></li>
        <li><a href="{!! route('network.share.site.index')!!}">Share Sites & Products</a></li>
        <li><a href="{!! route('import-network-products.select_network')!!}">Import Partner's Products</a></li> 
        <li><a href="{!! route('comnetwork.product.index')!!}">Manage Products On Company Network</a></li>
        <li><a href="{!! route('import-net-products.list_company')!!}">Import Products to Network</a></li>
    </ul>
</li>
<!-------------------------------------------End Invite Business Partners ----------------------------------------------------------->


<!------------------------------------------------Distribution Network -------- ----------------------------------------------------------->
<li class="sub-menu">
  <a href=""><i class="zmdi zmdi-view-list"></i>Distribution Network</a>
  <ul>
    <li><a href="{!!route('distributionnetwork.create')!!}">Distribution Network</a></li>
    <!--<li><a href="{!!route('distributionnetwork.index')!!}">View Network</a></li>-->
  </ul>
</li>
<!-------------------------------------------End Distribution Network ----------------------------------------------------------->

<!------------------------------------------- Messaging System ----------------------------------------------------------->
  <li class="sub-menu">
      <a href=""><i class="zmdi zmdi-view-list"></i> Chat</a>
      <ul>
            <li><a href="{!! route('chat.create')!!}">Internal Messaging</a></li>
<!--        <li><a href="{!! route('chat.index')!!}">Chat Invitations</a></li>-->
      </ul>
  </li>
<!-------------------------------------------End Messaging System ----------------------------------------------------->


<!------------------------------------------- Messaging System ----------------------------------------------------------->
  <li class="sub-menu">
      <a href=""><i class="zmdi zmdi-view-list"></i> Orders</a>
      <ul>
          <li><a href="{!! route('userorders.index')!!}">My Orders</a></li>
          <li><a href="{!! route('orders.index')!!}">Orders</a></li>
          <li><a href="{!! route('product-return-request')!!}">Product Return Requests</a></li>
          <li><a href="{!! route('contact-buyer-index')!!}">Buyer Complaints</a></li>
          <li><a href="{!! route('contact-gdoox-create') !!}">Contact Gdoox</a></li>
          <li><a href="{!! route('contact-gdoox-index') !!}">View Complaints to Gdoox</a></li>
      </ul>
  </li>
<!-------------------------------------------End Messaging System ----------------------------------------------------->

<!-------------------------------------------Search Business Companies----------------------------------------------------------->
  <li class="sub-menu">
      <a href=""><i class="zmdi zmdi-view-list"></i>Search Companies/Sites</a>
      <ul>
            <li><a href="{!! route('search-business')!!}">Search</a></li>
      </ul>
  </li>
<!-------------------------------------------End Search Business Companies----------------------------------------------------------->
<!-----------------------------------------------------Create Tasks------------------------------------------------------------------------>

<li class="sub-menu">
    <a href=""><i class="zmdi zmdi-view-list"></i>CRM</a>
    <ul>
 <!--        <li class="sub-menu">
            <a href="">Tasks</a>
            <ul>-->
                <!--<li><a href="{!! route('tasks.create')!!}">Create Task</a></li>-->
        <li><a href="{!! route('tasks.index')!!}">Tasks</a></li>
<!--            </ul>           
        </li>-->
        
        <li class="sub-menu">
            <a href="">Users</a>
            <ul>
                <!--<li><a href="{!! route('crm_users.create')!!}">Add Users</a></li>-->
                <li><a href="{!! route('crm_users.index')!!}">Users</a></li>
                <li><a href="{!! route('select_group')!!}">Add Users to Groups</a></li>
            </ul>          
        </li>
        
<!--        <li class="sub-menu">
            <a href="">Accounts</a>
            <ul>-->
                <!--<li><a href="{!! route('crm_accounts.create')!!}">Create Account</a></li>-->
                <li><a href="{!! route('crm_accounts.index')!!}">Accounts</a></li>
<!--            </ul>           
        </li>-->
        
        <li class="sub-menu">
            <a href="">Opportunities</a>
            <ul>
               <li><a href="{!! route('crm_opportunities.index')!!}">CRM Opportunities</a></li>
               <li><a href="{!! route('ab_cart_opportunities.index')!!}">Abandoned Cart Opportunities</a></li>
            </ul>           
        </li>
        
<!--        <li class="sub-menu">
            <a href="">Groups</a>
            <ul>-->
                <!--<li><a href="{!! route('crm_groups.create')!!}">Create Group</a></li>-->
                <li><a href="{!! route('crm_groups.index')!!}">Groups</a></li>
<!--            </ul>           
        </li>-->
        
<!--        <li class="sub-menu">
            <a href="">Contacts</a>
            <ul>
               <li><a href="{!! route('crm_contacts.create')!!}">Create Contact</a></li>-->
               
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
               
<!--               <li><a href="{!! route('crm_contacts.index')!!}">Contacts</a></li>-->
               <!--<li><a href="{!! route('crm_contactsgroup.create')!!}">Create Contact Group</a></li>-->
               
<!--           </ul>         
        </li>-->
        
        <li class="sub-menu">
            <a href="">Emails</a>
            <ul>
<!--                <li><a href="{!! route('crm_emails.create')!!}">Create Email</a></li>-->
                <li><a href="{!! route('crm_emails.index')!!}">Email's</a></li>
                <li><a href="{!! route('crm_emails.drafts')!!}">View Drafts</a></li>
            </ul>           
        </li>
        
<!--        <li class="sub-menu">
            <a href="">Templates</a>
            <ul>-->
                <!--<li><a href="{!! route('crm_templates.create')!!}">Create Template</a></li>-->
                <li><a href="{!! route('crm_templates.index')!!}">Templates</a></li>
        <!-- </ul>
        </li>-->
    </ul>
</li>
<!--------------------------------------------------------End Create Tasks------------------------------------------------------------->