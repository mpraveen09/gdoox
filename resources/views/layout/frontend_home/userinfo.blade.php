@section('profile_pic')
    {{ asset('/admin-ui/images/img.jpg')}}
@endsection

@section('profile_name')
<?php if(Auth::user()){ echo strtoupper(Auth::user()->name);}?>
@endsection

@section('msg_count')
2
@endsection

@section('msg_content')
    <div class="lv-header">
        Messages
    </div>
    <div class="lv-body">
        <a class="lv-item" href="">
            <div class="media">
                <div class="pull-left">
                    <img class="lv-img-sm" src="{{ asset('/m-admin-ui/img/profile-pics/1.jpg')}}" alt="">
                </div>
                <div class="media-body">
                    <div class="lv-title">David Belle</div>
                    <small class="lv-small">Cum sociis natoque penatibus et magnis dis parturient montes</small>
                </div>
            </div>
        </a>
        <a class="lv-item" href="">
            <div class="media">
                <div class="pull-left">
                    <img class="lv-img-sm" src="{{ asset('/m-admin-ui/img/profile-pics/2.jpg')}}" alt="">
                </div>
                <div class="media-body">
                    <div class="lv-title">Jonathan Morris</div>
                    <small class="lv-small">Nunc quis diam diamurabitur at dolor elementum, dictum turpis vel</small>
                </div>
            </div>
        </a>

    </div>
    <a class="lv-footer" href="">View All</a>
@endsection


@section('alert_count')
1
@endsection

@section('alert_content')
    <div class="lv-header">
        Notification

        <ul class="actions">
            <li class="dropdown">
                <a href="" data-clear="notification">
                    <i class="zmdi zmdi-check-all"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="lv-body">
        <a class="lv-item" href="">
            <div class="media">
                <div class="pull-left">
                    <img class="lv-img-sm" src="{{ asset('/m-admin-ui/img/profile-pics/1.jpg')}}" alt="">
                </div>
                <div class="media-body">
                    <div class="lv-title">David Belle</div>
                    <small class="lv-small">Cum sociis natoque penatibus et magnis dis parturient montes</small>
                </div>
            </div>
        </a>
    </div>

    <a class="lv-footer" href="">View Previous</a>
@endsection

@section('task_count')
2
@endsection

@section('task_content')
    <div class="lv-header">
        Tasks
    </div>
    <div class="lv-body">
        <div class="lv-item">
            <div class="lv-title m-b-5">HTML5 Validation Report</div>

            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%">
                    <span class="sr-only">95% Complete (success)</span>
                </div>
            </div>
        </div>
        <div class="lv-item">
            <div class="lv-title m-b-5">Google Chrome Extension</div>

            <div class="progress">
                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                    <span class="sr-only">80% Complete (success)</span>
                </div>
            </div>
        </div>

    </div>

    <a class="lv-footer" href="">View All</a>
@endsection

@section('page_settings')
    <ul class="dropdown-menu dm-icon pull-right">

        <li class="hidden-xs">
            <a data-action="fullscreen" href=""><i class="zmdi zmdi-fullscreen"></i> Toggle Fullscreen</a>
        </li>
        <li>
            <a data-action="clear-localstorage" href=""><i class="zmdi zmdi-delete"></i> Clear Local Storage</a>
        </li>
        <li>
            <a href=""><i class="zmdi zmdi-face"></i> Privacy Settings</a>
        </li>
        <li>
            <a href=""><i class="zmdi zmdi-settings"></i> Other Settings</a>
        </li>
    </ul>

@endsection
