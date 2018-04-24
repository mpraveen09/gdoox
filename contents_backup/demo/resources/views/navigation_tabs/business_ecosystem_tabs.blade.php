<?php $count1 = 0; ?>
<?php $count2 = 0; ?>
@if(isset($nav_menu))
@if($nav_menu->count())
    <div class="card">
        <div class="pm-body clearfix">
            <ul class="tab-navs navs-menu tn-justified">
                @foreach($nav_menu as $menu)
                    @if($count1 < 6)
                        @if($route == $menu->route || in_array($route, $menu->child_routes))
                            <li class="active waves-effect"><a href="{!! route($menu->route)!!}">{!! $menu->name !!}</a></li>
                        @else
                            <li class="waves-effect"><a href="{!! route($menu->route)!!}">{!! $menu->name !!}</a></li>
                        @endif
                    @endif
                    <?php $count1++; ?>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="card">
        <div class="pm-body clearfix">
            <ul class="tab-navs navs-menu tn-justified">
                @foreach($nav_menu as $menu)
                    @if($count2 >= 6)
                        @if($route == $menu->route || in_array($route, $menu->child_routes))
                            <li class="active waves-effect"><a href="{!! route($menu->route)!!}">{!! $menu->name !!}</a></li>
                        @else
                            <li class="waves-effect"><a href="{!! route($menu->route)!!}">{!! $menu->name !!}</a></li>
                        @endif
                    @endif
                    <?php $count2++; ?>
                @endforeach
            </ul>
        </div>
    </div>
@endif
@endif
 

