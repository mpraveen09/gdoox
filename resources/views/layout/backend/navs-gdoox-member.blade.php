<!--<li><a href="{!! route('dash-board')!!}"><i class="zmdi zmdi-home"></i> Dashboard</a></li>-->
<!--------------------------------------------Attribute Management Only for Super-Admin-------------------------------------->
<li class="sub-menu">
  <a href=""><i class="zmdi zmdi-view-list"></i> Attribute Management </a>
  <ul>
    <li><a href="{!!route('attributes.index')!!}">Attribute List</a></li>
    <li><a href="{!!route('attributesassoc.index')!!}">Attribute Association</a></li>
    <li><a href="{!!route('attributestype.index')!!}">Attribute Data Type</a></li>
    <li><a href="{!!route('dropdownoptions.index')!!}">Dropdown Option List</a></li>
  </ul>           
</li>
<!-------------------------------------------End Attribute Management Only for Super-Admin--------------------------------->
<!-------------------------------------------Category Management Only for Super-Admin--------------------------------------->
<li class="sub-menu">
  <a href=""><i class="zmdi zmdi-view-list"></i> Category Management </a>
    <ul>
        <li><a href="{!!route('categories.index')!!}">Categories</a></li>
        <li><a href="{!! route('category-upload-create')!!}">Categories Import</a></li>
    </ul>           
</li> 
<!--------------------------------------------End Category Management------------------------------------------------------------->

<!-------------------------------------------View All Company Profiles Only for Super-Admin----------------------------------->
<li>
    <a href="{!! route('business-details-index')!!}"><i class="zmdi zmdi-book zmdi-hc-fw"></i>View All Business Info</a>
</li>
<!-------------------------------------------End  view all Company profiles----------------------------------------------------------->
<!-----------------------------------------------------Create Tasks------------------------------------------------------------------------>

<!--------------------------------------------------------End Create Tasks------------------------------------------------------------->
<!-------------------------------------------Search Business Companies----------------------------------------------------------->
  <li class="sub-menu">
      <a href=""><i class="zmdi zmdi-view-list"></i> Search Companies/Sites</a>
      <ul>
            <li><a href="{!! route('search-business')!!}">Search</a></li>
      </ul>
  </li>
<!-------------------------------------------End Search Business Companies----------------------------------------------------->

<!-------------------------------------------Search Business Companies----------------------------------------------------------->
  <li class="sub-menu">
      <a href=""><i class="zmdi zmdi-view-list"></i> Chat</a>
      <ul>
            <li><a href="{!! route('chat.create')!!}">Start Chatting</a></li>
      </ul>
  </li>
<!-------------------------------------------End Search Business Companies----------------------------------------------------->


<!-------------------------------------------Search Business Companies----------------------------------------------------------->
  <li class="sub-menu">
      <a href=""><i class="zmdi zmdi-view-list"></i> Exceptions</a>
      <ul>
            <li><a href="{!! route('exceptions.index')!!}">View</a></li>
      </ul>
  </li>
<!-------------------------------------------End Search Business Companies----------------------------------------------------->

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

<li class="sub-menu">
    <a href=""><i class="zmdi zmdi-view-list"></i> CRM</a>
    <ul>
        <li><a href="{!! route('under-testing.index')!!}">Crm</a></li>
    </ul>
</li>