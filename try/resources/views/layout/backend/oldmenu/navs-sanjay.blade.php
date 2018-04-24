  @if(Auth::user())  
    @if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('user')|| Auth::user()->hasRole('guest') || Auth::user()->hasRole('multi-user-admin') || Auth::user()->hasRole('mono-admin') || Auth::user()->hasRole('multi-site-admin')|| Auth::user()->hasRole('sub-admin-user'))
        <li class="sub-menu">
            <a href=""><i class="zmdi zmdi-view-list"></i> Personal Profile </a>
            <ul>
                <li><a href="{!! route('profile-index')!!}">Your Account</a></li>
                <li><a href="{!! route('personal-info-edit')!!}">Personal Info</a></li>
            @if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('user')|| Auth::user()->hasRole('multi-user-admin') || Auth::user()->hasRole('mono-admin') || Auth::user()->hasRole('multi-site-admin') || Auth::user()->hasRole('sub-admin-user'))
                <li><a href="{!! route('social-info-edit')!!}">Social Info</a></li>
                <li><a href="{!! route('relation-info-edit')!!}">Relation with Gdoox</a></li>
                <li><a href="{!! route('interest-info-edit')!!}">Interests</a></li>
                
            @endif    
            </ul>           
        </li> 
      @endif  
      
      
      @if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin')|| Auth::user()->hasRole('multi-user-admin') || Auth::user()->hasRole('mono-admin') || Auth::user()->hasRole('multi-site-admin') || Auth::user()->hasRole('sub-admin-user'))            
      <li class="sub-menu">
        <a href=""><i class="zmdi zmdi-view-list"></i> Business Info </a>
              <ul>
            <li><a href="{!! route('business-info-index')!!}">Company List</a></li>
            <li><a href="{!! route('verify-fiscalvat-index')!!}">Verify Company with Fiscal ID & Vat Number</a></li>
            <li><a href="{!! route('verify-documents-index')!!}">Verify Company with Company Documents</a></li>
            <li><a href="{!! route('ecomm-index')!!}">E-Commerce Store List</a></li>
              </ul>           
          </li> 	

          
          @if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin') )
             <li class="sub-menu">
                <a href=""><i class="zmdi zmdi-view-list"></i>Accepting Payment Methods </a>
                <ul>
                    <li><a href="{!! route('payment-method-index')!!}">Payment Method</a></li>
                </ul>           
            </li> 	
          @endif
        @endif
        
        
          @if(Auth::user())
           <li class="sub-menu">
              <a href=""><i class="zmdi zmdi-view-list"></i>Create Your Sites </a>
              <ul>
                  <li><a href="{!! route('personal-select_cat-index')!!}">Create Your Personal Site</a></li>
                  
                  @if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin')|| Auth::user()->hasRole('multi-user-admin') || Auth::user()->hasRole('mono-admin') || Auth::user()->hasRole('multi-site-admin') || Auth::user()->hasRole('sub-admin-user'))
                  <li><a href="{!! route('ecomm-index')!!}">Create Your e-Commerce Site</a></li>
                  <li><a href="{!! route('site.logo.index')!!}">Add Site Logo</a></li>
                  <li><a href="{!! route('site.header.images.index')!!}">Add Site Images</a></li>
                  <li><?php echo HTML::link(route('productcatalog'),'Add Catalog');?></li>
                  <li><?php echo HTML::link(route('certificationlogos'),'Add Certification Logos');?></li>
                  @endif
                  
              </ul>           
          </li> 	
          @endif
          
        @if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin')|| Auth::user()->hasRole('multi-user-admin')|| Auth::user()->hasRole('multi-site-admin'))
          <li class="sub-menu">
            <a href=""><i class="zmdi zmdi-view-list"></i> User Management </a>
            <ul>
                <li><a href="{!! route('user-create')!!}">Add User</a></li>
                <li><a href="{!! route('users')!!}">All Users</a></li>
              @if(Auth::user()->hasRole('superadmin'))
                <li><a href="{!! route('invite-user-create')!!}">Invite User</a></li>
                <li><a href="{!! route('invite-multi-user-create')!!}">Invite Multi Users</a></li>
             @endif
            </ul>           
        </li> 		
    @endif
@endif
