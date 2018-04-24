@if($nav_menu->count())
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="card pt-inner">
                <div class="bgm-amber">
                    <h4>{!! $nav_menu[12]->name !!}</h4>
                    <table class="table dtable table-striped responsive-utilities jambo_table">
                        @foreach($nav_menu as $menu)
                            @if($menu->group==='personal_profile')
                                @if($menu->route!= '')
                                    <tr>
                                        <td class="text-left"><a href="{!! route($menu->route) !!}">{!! $menu->name !!}</a></td>
                                        <td><a class="btn btn-xs btn-success waves-effect" href="{!! route($menu->route) !!}">View</a></td>
                                    </tr>
                                @endif
                            @endif
                        @endforeach
                    </table>
                </div>
                <div class="pti-body"></div>
            </div>
        </div>
    </div>
@endif