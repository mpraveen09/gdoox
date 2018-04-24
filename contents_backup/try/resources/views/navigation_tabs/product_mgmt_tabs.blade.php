@if($nav_menu->count())
    <div class="card">
        <div class="pm-body clearfix">
            <ul class="tab-navs tn-justified">
                @foreach($nav_menu as $menu)
                    @if($menu->route=='select_cat_to_sell.index' || $menu->route=='select_cat_to_buy.index' || $menu->route=='products/list' || $menu->route=='product_promo.index' || $menu->route=='abandoned_cart' || $menu->route=='multi_item.index')
                        @if($route == $menu->route || $route == $menu->child_route || $route == $menu->route_edit || $route == $menu->route_show || $route == $menu->route_add || $route == $menu->route_create)
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
                    @if($menu->route=='cross_selling.index' || $menu->route=='up_selling.index' || $menu->route=='bundle/combo.index' || $menu->route=='opportunities.index' || $menu->route=='import_product.list_product')
                        @if($route == $menu->route || $route == $menu->child_route || $route == $menu->route_edit || $route == $menu->route_show || $route == $menu->route_create)
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
 

