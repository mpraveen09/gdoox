@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>Business Ecosystem </h2>-->
@endsection

@section('right_col_title_right')
@endsection

@section('right_col')

    @if (Session::has('message'))
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!!  Session::get('message')  !!}
        </div>
    @endif
    
    @if (HTML::ul($errors->all()))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!! HTML::ul($errors->all()) !!}
        </div>
    @endif
    
    @include('navigation_tabs.business_ecosystem_tabs')
    <div class="card">
            <div class="card-header bgm-blue head-title">
                <h2>Invitation Status</h2>
            </div>
            <div class="card-body">
                @if(!$invitationstatus->count())
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        You have not send any invitation.
                    </div>    
                @else
                    <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                        <table class="table table-striped responsive-utilities jambo_table ">
                            <thead>
                                <tr>
                                    <th>Invitee</th>
                                    <th>Invitee Email</th>
                                    <th>Type</th>
                                    <th>Status/Action</th>
                                    <th>Invitation Date</th>
                                </tr>
                            </thead>
                            <tbody>  
                             @for($i=0;$i<count($invitedata['invitee']);$i++)
                              <?php // print_r($invitedata); die;?>
                                <tr>
                                  <td>{!!$invitedata['invitee'][$i]!!}</td>
                                  <td>{!!$invitedata['invitee_email'][$i]!!}</td>
                                  <td>{!!$invitedata['type'][$i]!!}</td>
                                  <td>
                                      {!!$invitedata['status'][$i]!!}
                                      @if($invitedata['status'][$i] != "Expired" && $invitedata['status'][$i] != "Accepted")
                                      /<a href="{!!route('invite.partner.resend', $invitedata['id'][$i])!!}" class="">Resend</a>
                                      @endif
                                  </td>
                                  <td>{!!$invitedata['invitation_date'][$i]!!}</td>
                                </tr>  
                             @endfor   
                            </tbody>
                        </table>
                    </div>
                @endif
        </div>
    </div>
    
    <div class="card">
	<div class="card-header bgm-blue">
            <h2>Join Request Status</h2>
	</div>
	<div class="card-body">
            @if(!$joinstatus->count())
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    You have no not send any join request.
                </div>    
            @else
                <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                  <table class="table table-striped responsive-utilities jambo_table ">
                      <thead>
                          <tr>
                              <th>Invitee</th>
                              <th>Invitee Email</th>
                              <th>For Site</th>
                              <th>Type</th>
                              <th>Status/Action</th>
                              <th>Invitation Date</th>
                          </tr>
                      </thead>
                      <tbody>  
                       @for($i=0;$i<count($joindata['invitee']);$i++)
                          <tr>
                            <td>{!!$joindata['invitee'][$i]!!}</td>
                            <td>{!!$joindata['invitee_email'][$i]!!}</td>
                            <td><a href="{{ URL::to('/site/') }}/{!! $joindata['for_site'][$i]!!}">{!!$joindata['for_site'][$i]!!}</a></td>
                            <td>{!!$joindata['type'][$i]!!}</td>
                            <td>{!!$joindata['status'][$i]!!}</td>
                            <td>{!!$joindata['invitation_date'][$i]!!}</td>
                          </tr>  
                       @endfor   
                      </tbody>
                  </table>
                </div>
            @endif
        </div>
    </div>
@endsection