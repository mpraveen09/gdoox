<li><a href="{!! route('dash-board')!!}"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
<!--------------------------------------------------------Personal Profile------------------------------------------------------------------>
<li class="sub-menu">
  <a href=""><i class="zmdi zmdi-view-list"></i>PERSONAL PROFILE</a>
    <ul>
        <li><a href="{!! route('profile-index')!!}">Your Account</a></li>
        <li><a href="{!! route('personal-info-create')!!}">Personal Info</a></li>
        <li><a href="{!! route('relation-info-create')!!}">Relationship with Gdoox</a></li>
        <li><a href="{!! route('interest-info-create')!!}">Interests</a></li>
        <li><a href="{!! route('business-sectors-index')!!}">Business Sectors I’m Interested In</a></li>
    </ul>
</li>
<!--------------------------------------------------------End Personal Profile------------------------------------------------------------>
<!-----------------------------------------------Create Personal Site--------------------------------------------------------------->
<li class="sub-menu">
   <a href=""><i class="zmdi zmdi-view-list"></i>CREATE PERSONAL SITE</a>
   <ul>
        <li><a href="{!! route('create-personal-site-create')!!}">Create Your Personal Site</a></li>
        <li><a href="{!! route('personal-about-us-create')!!}">Summary</a></li>
        <li><a href="{!! route('general-info-create')!!}">General Information</a></li>
        <li><a href="{!! route('professional-skills-create')!!}">Professional Skills</a></li>
        <li><a href="{!! route('other-info-create')!!}">Other Information</a></li>
        <li><a href="{!! route('jobdetail.create')!!}">Job Details</a></li>
        <li><a href="{!! route('competencies-create')!!}">Competencies</a></li>
        <li><a href="{!! route('references-create')!!}">References</a></li>
        <li><a href="{!! route('sponsors-create')!!}">Sponsors</a></li>
        <li><a href="{!! route('site.header.images.index')!!}">Site Images</a></li>
   </ul>           
</li> 
<!--------------------------------------------------------End Personal Site------------------------------------------------------------>


<!-----------------------------------------------Create E-commerce Site--------------------------------------------------------------->
<li class="sub-menu">
    <a href=""><i class="zmdi zmdi-view-list"></i>COMPANY PROFILE </a>
    <ul>
      <li class="sub-menu">
          <a href="">Business Info</a>
          <ul>
                <li><a href="{!! route('permisson.denied')!!}">Add and Verify your Business Info</a></li>
          </ul>
      </li>
      <li class="sub-menu">
          <a href="">Accept Payment Methods</a>
          <ul>
              <li><a href="{!! route('permisson.denied')!!}">Payment Method</a></li>
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
              <li><a href="{!! route('permisson.denied')!!}">Configure Your E-Commerce Site/s</a></li>
              <li><a href="{!!route('permisson.denied')!!}">Product Catalogs</a></li>
              <li><a href="{!!route('permisson.denied')!!}">Certification Logos</a></li>
              <!--<li><a href="{!! route('permisson.denied')!!}">Add Site Logo</a></li>-->              
              <li><a href="{!! route('permisson.denied')!!}">Site Images</a></li>
              <li><a href="{!!route('permisson.denied')!!}">Site Pages</a></li>
              <li><a href="{!!route('permisson.denied')!!}">Followers</a></li>
              <li><a href="{!!route('permisson.denied')!!}">Social Links</a></li>
          </ul>
      </li>
    </ul>           
</li>

<!-----------------------------------------------------End E-commerce site----------------------------------------------------------->
<!-----------------------------------------------------Product Management----------------------------------------------------------->
<li class="sub-menu">
  <a href=""><i class="zmdi zmdi-view-list"></i> PRODUCT MANAGEMENT </a>
  <ul>
        <li><a href="{!! route('permisson.denied') !!}">Add products/services</a></li>
        <li><a href="{!! route('permisson.denied') !!}">Product/Service Procurement</a></li>
        <li><a href="{!! route('permisson.denied') !!}">View products/services</a></li>
        <li><a href="{!! route('permisson.denied')!!}">Import Products</a></li>
  </ul>
</li>
<!-------------------------------------------End Product Management--------------------------------------------------------------->

<!-----------------------------------------------------Marketing----------------------------------------------------------->
<li class="sub-menu">
  <a href=""><i class="zmdi zmdi-view-list"></i> MARKETING </a>
  <ul>
        <li><a href="{!! route('permisson.denied') !!}">Auction Bids </a></li>
        <li><a href="{!! route('permisson.denied') !!}">Reverse Auction Bids </a></li>
        <li><a href="{!! route('permisson.denied') !!}">Your Auction Bids </a></li>
        <li><a href="{!! route('permisson.denied') !!}">Your Reverse Auction Bids </a></li>
        <li><a href="{!! route('permisson.denied') !!}">Product Promotional Banner/Sticker</a></li>
        <li><a href="{!! route('permisson.denied') !!}">Abandoned Cart</a></li>
        <li><a href="{!! route('permisson.denied') !!}">Configure multi-item product</a></li>
        <li><a href="{!! route('permisson.denied') !!}">Add cross selling products</a></li>
        <li><a href="{!! route('permisson.denied') !!}">Add up-selling products</a></li>
        <li><a href="{!! route('permisson.denied') !!}">Add bundle/combo products</a></li>
        <li><a href="{!! route('permisson.denied') !!}">Create opportunities </a></li>
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
        <!--<li><a href="{!! route('permisson.denied')!!}">Add Campaigns</a></li>-->
        <li><a href="{!! route('campaigns.request')!!}">Add Campaign Request</a></li>
  </ul>           
</li>
<!-------------------------------------------End Campaigns------------------------------------------------------------------------->


<!------------------------------------------------------Manage Users-------------------------------------------------------------------->
<li class="sub-menu">
  <a href=""><i class="zmdi zmdi-view-list"></i>MANAGING ACCOUNT</a>
  <ul>
    <li><a href="{!! route('permisson.denied')!!}">Invite your colleagues</a></li>
    <li><a href="{!! route('permisson.denied')!!}">View Users And Define Role</a></li>
    <li><a href="{!! route('permisson.denied')!!}">Permissions</a></li>
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
                <li><a href="{!! route('permisson.denied')!!}">Invite Partner</a></li>
                <li><a href="{!! route('permisson.denied')!!}"">Accept/Deny Invitation</a></li>
                <li><a href="{!! route('permisson.denied')!!}">Invitation Status</a></li>
          </ul>
        </li>
    </ul>
</li>
<!-------------------------------------------End Search Business Partners -------------------------------------------------------->

<!-------------------------------------------Invite Business Partners ----------------------------------------------------------------->
<li class="sub-menu">
  <a href=""><i class="zmdi zmdi-view-list"></i>BUSINESS ECOSYSTEM</a>
  <ul>
        <li><a href="{!! route('permisson.denied')!!}">Create A New Business Ecosystem</a></li>
        <li><a href="{!! route('permisson.denied')!!}">Invite Company (not yet a GDOOX Member)</a></li>
        <li><a href="{!! route('permisson.denied')!!}">Invite Company (already a GDOOX Member)</a></li>
        <li><a href="{!! route('permisson.denied')!!}">Accept/Deny Invitation</a></li>
<!--    <li><a href="{!! route('permisson.denied')!!}">Invitation Status</a></li>-->
        <li><a href="{!! route('permisson.denied')!!}">Share Sites & Products</a></li>
        <li><a href="{!! route('permisson.denied')!!}">Import Partner's Products</a></li>
        <li><a href="{!! route('permisson.denied')!!}">Import Products to Ecosystem</a></li>
        <li><a href="{!! route('permisson.denied')!!}">Manage Products On Business Ecosystem</a></li>
  </ul>
</li>
<!-------------------------------------------End Invite Business Partners ----------------------------------------------------------->


<!-------------------------------------------Invite Business Partners ----------------------------------------------------------------->
<li class="sub-menu">
  <a href=""><i class="zmdi zmdi-view-list"></i>COMPANY NETWORK</a>
  <ul> 
        <li><a href="{!! route('permisson.denied')!!}">Assign Company Network Functions to a Site.</a></li>
        <li><a href="{!! route('permisson.denied')!!}">Invite Company</a></li>
        <li><a href="{!! route('permisson.denied')!!}">Accept/Deny Invitation</a></li>
        <li><a href="{!! route('permisson.denied')!!}">Share Sites & Products</a></li>
        <li><a href="{!! route('permisson.denied')!!}">Import Partner's Products</a></li>
        <li><a href="{!! route('permisson.denied')!!}">Import Products to Network</a></li>
        <li><a href="{!! route('permisson.denied')!!}">Manage Products On Company Network</a></li>
  </ul>
</li>
<!-------------------------------------------End Invite Business Partners ----------------------------------------------------------->


<!------------------------------------------------Distribution Network -------- --------------------------------------------------------->
<li class="sub-menu">
  <a href=""><i class="zmdi zmdi-view-list"></i>DISTRIBUTION NETWORK</a>
  <ul>
    <li><a href="{!!route('distributionnetwork.create')!!}">Distribution Network</a></li>
  </ul>
</li>
<!-------------------------------------------End Distribution Network ----------------------------------------------------------------->


<!-----------------------------------------------------Create Tasks------------------------------------------------------------------------>

<li class="sub-menu">
    <a href=""><i class="zmdi zmdi-view-list"></i> CRM</a>
    <ul>
        <li><a href="{!! route('permisson.denied')!!}">Tasks</a></li>
        <li class="sub-menu">
            <a href="">Users</a>
            <ul>
                <li><a href="{!! route('permisson.denied')!!}">Users</a></li>
                <li><a href="{!! route('permisson.denied')!!}">Add Users to Groups</a></li>
            </ul>          
        </li>
        <li><a href="{!! route('permisson.denied')!!}">Accounts</a></li>
        <li class="sub-menu">
            <a href="">Opportunities</a>
            <ul>
               <li><a href="{!! route('permisson.denied')!!}">CRM Opportunities</a></li>
               <li><a href="{!! route('permisson.denied')!!}">Abandoned Cart Opportunities</a></li>
            </ul>           
        </li>
        <li><a href="{!! route('permisson.denied')!!}">Groups</a></li>
        <li class="sub-menu">
            <a href="">Contacts</a>
            <ul>
                <li><a href="{!! route('permisson.denied')!!}">Export Contacts Excel Format</a></li>
                <li><a href="{!! route('permisson.denied')!!}">View Contacts</a></li>
                <li><a href="{!! route('permisson.denied')!!}">Import Contacts</a></li>
                <li><a href="{!! route('permisson.denied')!!}">Export Contacts</a></li>
                <li><a href="{!! route('permisson.denied')!!}">Contact Groups</a></li>
                <li><a href="{!! route('permisson.denied')!!}">Add Users to Contact Groups</a></li>
            </ul>          
        </li>
        <li class="sub-menu">
            <a href="">Emails</a>
            <ul>
                <li><a href="{!! route('permisson.denied')!!}">Email's</a></li>
                <li><a href="{!! route('permisson.denied')!!}">View Drafts</a></li>
            </ul>           
        </li>
        <li><a href="{!! route('permisson.denied')!!}">Templates</a></li>
    </ul>
</li>
<!--------------------------------------------------------End Create Tasks------------------------------------------------------------->
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
          <li><a href="{!! route('product-return-request')!!}">Product Return Requests</a></li>
          <li><a href="{!! route('contact-buyer-index')!!}">Buyer Complaints</a></li>
          <li><a href="{!! route('contact-gdoox-create') !!}">Contact Gdoox</a></li>
      </ul>
  </li>
<!-------------------------------------------End Messaging System ----------------------------------------------------->

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
