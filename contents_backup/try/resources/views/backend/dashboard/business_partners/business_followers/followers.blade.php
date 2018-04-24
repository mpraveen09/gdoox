
@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2> Business Follow</h2>-->
@endsection

@section('right_col_title_right')
 @endsection

@section('right_col')

@if (Session::has('message'))
    <div class="alert alert-info">{!!  Session::get('message')  !!}</div>
@endif

@if (HTML::ul($errors->all()))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        {!! HTML::ul($errors->all()) !!}
    </div>
@endif

    @include('navigation_tabs.general_tabs')

 <div class="card">
	<div class="card-header bgm-blue head-title">
            <h2>Followers </h2>
	</div><!-- .card-header -->
	<div class="card-body">
            @if(!$followers->count())
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    You don't have any followers.
                </div>    
            @else
                <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                  <table class="table table-striped responsive-utilities jambo_table ">
                      <thead>
                          <tr>
                              <th>Follower Company</th>
                              <th>Follower Name</th>
                              <th>Follower Email</th>
                              <th>Interested Site</th>
                          </tr>
                      </thead>
                      <tbody>  
                       @foreach($followers as $follower)
                        <tr>
                              <td>
                                  @if($follower->follower_site!== NULL)
                                    <a target="_blank" href="{{ URL::to('/site/') }}/{!! $follower->follower_site !!}">{!! $follower->follower_company !!}</a>
                                  @else 
                                      {!! $follower->follower_company !!}
                                  @endif
                              </td>
                              <td>{!! $follower->follower_name !!}</td>
                              <td>{!! $follower->follower_email !!}</td>
                              <td><a target="_blank" href="{{ URL::to('/site/') }}/{!! $follower->site_slug!!}">{!!$follower->site_slug!!}</a></td>
                        </tr> 
                       @endforeach  
                      </tbody>
                  </table>
                </div>
            @endif
        </div><!-- .card-body -->
</div><!-- .card -->
@endsection    
 