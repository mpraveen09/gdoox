@if($nav_menu->count())
    <div class="card">
        <div class="pm-body clearfix">
            <ul class="tab-navs tn-justified">
                @foreach($nav_menu as $menu)
                    @if($menu->route=='invite.ext.partner.create' || $menu->route=='invite.inter.partner.create' || $menu->route=='ecosys.site.indexall' || $menu->route=='invite.partner.show')
                        @if($route == $menu->route || $route == $menu->route_edit || $route == $menu->route_show || $route == $menu->route_add ||  in_array($route, $menu->child_routes))
                            <li class="active waves-effect"><a href="{!! route($menu->route)!!}">{!! $menu->name !!}</a></li>
                        @else
                            <li class="waves-effect"><a href="{!! route($menu->route)!!}">{!! $menu->name !!}</a></li>
                        @endif
                    @endif 
                @endforeach
            </ul>
        </div>
    </div>

    <div class="card">
        <div class="pm-body clearfix">
            <ul class="tab-navs tn-justified">
                @foreach($nav_menu as $menu)
                    @if($menu->route=='share.site.index' || $menu->route=='import-ecom-products.select_ecom' || $menu->route=='import-ecom-products.list_company' || $menu->route=='ecosys.product.index')
                        @if($route == $menu->route || $route == $menu->child_route || $route == $menu->route_edit || $route == $menu->route_show || in_array($route, $menu->child_routes))
                            <li class="active waves-effect"><a href="{!! route($menu->route)!!}">{!! $menu->name !!}</a></li>
                        @else
                            <li class="waves-effect"><a href="{!! route($menu->route)!!}">{!! $menu->name !!}</a></li>
                        @endif
                    @endif 
                @endforeach
            </ul>
        </div>
    </div>
@endif
 

