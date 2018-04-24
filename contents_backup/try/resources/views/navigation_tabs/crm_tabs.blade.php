@if(!empty($nav_menus))
    <div class="card">
        <div class="pm-body clearfix">
            <ul class="tab-navs tn-justified">
                @foreach($nav_menus as $key=>$menu)
                    @if($route == $key || in_array($route, $sub_nav_menu[$key]))
                        <li class="active waves-effect"><a href="{!! route($key)!!}">{!! $menu !!}</a></li>
                    @else
                        <li class="waves-effect"><a href="{!! route($key)!!}">{!! $menu !!}</a></li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
@endif
 

