<!-------------------------------------------Search Business Companies----------------------------------------------------------->
<li class="sub-menu">
    <a href=""><i class="zmdi zmdi-view-list"></i>Search Companies/Sites</a>
    <ul>
          <li><a href="{!! route('search-business')!!}">Search</a></li>
    </ul>
</li>
<!-------------------------------------------End Search Business Companies----------------------------------------------------------->
<li>
    <a href="{!! URL::to('auth/login')!!}"><i class="zmdi zmdi-sign-in zmdi-hc-fw"></i> Sign In</a>
</li>
<li>
    <a href="{!! URL::to('auth/register') !!}"><i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Register</a>
</li> 

<li>
    <a href="{!! URL::to('platform/info')!!}"><i class="zmdi zmdi-widgets zmdi-hc-fw"></i> Platform Info</a>
</li>

<li>
    <a href="{!! route('account.plans')!!}"><i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Payment</a>
</li>
