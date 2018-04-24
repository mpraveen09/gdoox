@if(Auth::guest() || Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('user')|| Auth::user()->hasRole('guest') || Auth::user()->hasRole('multi-user-admin') || Auth::user()->hasRole('mono-admin') || Auth::user()->hasRole('multi-site-admin')|| Auth::user()->hasRole('sub-admin-user'))
      <li class="sub-menu">
          <a href=""><i class="zmdi zmdi-view-list"></i> Marketplace </a>
          <ul>
              <li><?php echo HTML::link(route('marketplace'),'View Marketplace');?></li>
              <!--<li><?php //echo HTML::link('shop/','View Store');?></li>-->
          </ul>           
      </li>
@endif 
@if(Auth::user())         
        @if(Auth::user()->hasRole('superadmin') )
            <li class="sub-menu">
                <a href=""><i class="zmdi zmdi-view-list"></i> Attribute Management </a>
                <ul>
                     <li><?php echo HTML::link(route('attributes.index'),'Attribute List');?></li>
                     <li><?php echo HTML::link(route('attributesassoc.index'),'Attribute Association');?></li>
                     <li><?php echo HTML::link(route('attributestype.index'),'Attribute Data Type');?></li>
                     <li><?php echo HTML::link(route('dropdownoptions.index'),'Dropdown Option List');?></li>

                </ul>           
            </li> 

            <li class="sub-menu">
                <a href=""><i class="zmdi zmdi-view-list"></i> Category Management </a>
                <ul>
                    <li><?php echo HTML::link(route('categories.index'),'Categories');?></li>
                 @if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin') )
                    <li><a href="{!! route('category-upload-create')!!}">Categories Import</a></li>
                 @endif   
                </ul>           
            </li> 
  @endif   
  @if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin')|| Auth::user()->hasRole('mono-admin')|| Auth::user()->hasRole('multi-user-admin')|| Auth::user()->hasRole('multi-site-admin')|| Auth::user()->hasRole('sub-admin-user'))
            <li class="sub-menu">
                <a href=""><i class="zmdi zmdi-view-list"></i> Product Management </a>
                <ul>

                </ul>           
            </li> 
  @endif
@endif