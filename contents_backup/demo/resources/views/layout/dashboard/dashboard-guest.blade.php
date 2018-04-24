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


        <div class="col-md-6 col-sm-12">
            <div class="card pt-inner">
                <div class="bgm-amber">
                    <h4>{!! $nav_menu[44]->name !!}</h4>
                    <table class="table dtable table-striped responsive-utilities jambo_table">
                        @foreach($nav_menu as $menu)
                            @if($menu->group==='create_ecommerce_site') 
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



        <div class="col-md-6 col-sm-12">
            <div class="card pt-inner">
                <div class="bgm-amber">
                    <h4>{!! $nav_menu[35]->name !!}</h4>
                    <table class="table dtable table-striped responsive-utilities jambo_table">
                        @foreach($nav_menu as $menu)
                            @if($menu->group==='business_ecosystem')
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

        <div class="col-md-6 col-sm-12">
            <div class="card pt-inner">
                <div class="bgm-amber">
                    <h4>{!! $nav_menu[6]->name !!}</h4>
                    <table class="table dtable table-striped responsive-utilities jambo_table">
                        @foreach($nav_menu as $menu)
                            @if($menu->group==='company_network')
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
        <div class="col-md-6 col-sm-12">
            <div class="card pt-inner">
                <div class="bgm-amber">
                    <h4>{!! $nav_menu[19]->name !!}</h4>
                    <table class="table dtable table-striped responsive-utilities jambo_table">
                        @foreach($nav_menu as $menu)
                            @if($menu->group==='managing_account')
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


        <div class="col-md-6 col-sm-12">
            <div class="card pt-inner">
                <div class="bgm-amber">
                    <h4>{!! $nav_menu[0]->name !!}</h4>
                    <table class="table dtable table-striped responsive-utilities jambo_table">
                        @foreach($nav_menu as $menu)
                            @if($menu->group==='users')
                                @if($menu->route!= '')
                                    @if($menu->slug=='all_users')
                                        <tr>
                                            <td class="text-left"><a href="{!! route($menu->route) !!}">{!! $menu->name !!}</a> (Total Users: {!! $user_count !!})</td>
                                            <td><a class="btn btn-xs btn-success waves-effect" href="{!! route($menu->route) !!}">View</a></td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="text-left"><a href="{!! route($menu->route) !!}">{!! $menu->name !!}</a></td>
                                            <td><a class="btn btn-xs btn-success waves-effect" href="{!! route($menu->route) !!}">View</a></td>
                                        </tr>
                                    @endif
                                @endif
                            @endif
                        @endforeach
                    </table>
                </div>
                <div class="pti-body"></div>
            </div>
        </div>

        <div class="col-md-6 col-sm-12">
            <div class="card pt-inner">
                <div class="bgm-amber">
                    <h4>{!! $nav_menu[60]->name !!}</h4>
                    <table class="table dtable table-striped responsive-utilities jambo_table">
                        @foreach($nav_menu as $menu)
                            @if($menu->group==='product_management')
                                @if($menu->route!= '')
                                    @if($menu->slug=='view_products_services')
                                        <tr>
                                            <td class="text-left"><a href="{!! route($menu->route) !!}">{!! $menu->name !!} </a>(Total Products: {!! $product_count !!})</td>
                                            <td><a class="btn btn-xs btn-success waves-effect" href="{!! route($menu->route) !!}">View</a></td>
                                        </tr>
                                    @elseif($menu->slug=='abandoned_cart')
                                        <tr>
                                            <td class="text-left"><a href="{!! route($menu->route) !!}">{!! $menu->name !!} </a>(Cart Products: {!! $ab_cart_count !!})</td>
                                            <td><a class="btn btn-xs btn-success waves-effect" href="{!! route($menu->route) !!}">View</a></td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="text-left"><a href="{!! route($menu->route) !!}">{!! $menu->name !!}</a></td>
                                            <td><a class="btn btn-xs btn-success waves-effect" href="{!! route($menu->route) !!}">View</a></td>
                                        </tr>
                                    @endif
                                @endif
                            @endif
                        @endforeach
                    </table>
                </div>
                <div class="pti-body"></div>
            </div>
        </div>

        <div class="col-md-6 col-sm-12">
            <div class="card pt-inner">
                <div class="bgm-amber">
                    <h4>{!! $nav_menu[22]->name !!}</h4>
                    <table class="table dtable table-striped responsive-utilities jambo_table">
                        @foreach($nav_menu as $menu)
                            @if($menu->group==='category_management')
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

        <div class="col-md-6 col-sm-12">
            <div class="card pt-inner">
                <div class="bgm-amber">
                    <h4>{!! $nav_menu[23]->name !!}</h4>
                    <table class="table dtable table-striped responsive-utilities jambo_table">
                        @foreach($nav_menu as $menu)
                            @if($menu->group==='attribute_management')
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