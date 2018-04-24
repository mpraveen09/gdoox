@section('profile_pic')
    {{ asset('/admin-ui/images/img.jpg')}}
@endsection

@section('profile_name')
<?php if(Auth::user()){ echo strtoupper(Auth::user()->name);}?>
@endsection

@section('alert_count')
2
@endsection

@section('alert_content')
                         <li>
                                        <a>
                                            <span class="image">
                                        <img src="{{ asset('/admin-ui/images/img.jpg')}}" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="{{ asset('/admin-ui/images/img.jpg')}}" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="text-center">
                                            <a>
                                                <strong><a href="#">See All Alerts</strong>
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </li>
@endsection


