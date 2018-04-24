@if($nav_menu->count())
    <div class="card">
        <div class="pm-body clearfix">
            <ul class="tab-navs tn-justified">
                @foreach($nav_menu as $menu)
                    @if($route == $menu->route || $route == $menu->child_route || $route == $menu->route_edit || $route == $menu->route_show)
                        <li class="active waves-effect"><a href="{!! route($menu->route)!!}">{!! $menu->name !!}</a></li>
                    @else
                        <li class="waves-effect"><a href="{!! route($menu->route)!!}">{!! $menu->name !!}</a></li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
@endif
 

