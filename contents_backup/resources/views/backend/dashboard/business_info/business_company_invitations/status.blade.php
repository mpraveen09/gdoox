@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>  </h2>-->
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
 
    @include('navigation_tabs.general_tabs')

<div class="card">
    <div class="card-header bgm-blue head-title">
        <h2>Invitation Status</h2>
    </div>
    @if($invitationstatus->count())
    <div class="card-body">
        <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
            <table class="table table-striped responsive-utilities jambo_table ">
                <thead>
                    <tr>
                        <th>Company Name</th>
                        <th>Invitee</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>  
                 @for($i=0;$i<count($invitedata['invitee']);$i++)
                    <tr>
                      <td>{!!$invitedata['company'][$i]!!}</td>
                      <td>{!!$invitedata['invitee'][$i]!!}</td>
                      <td>
                      @if($invitedata['status'][$i]=='Accept')
                        Accepted
                      @elseif($invitedata['status'][$i]=='Deny')
                        Denied
                      @else
                        Pending
                      @endif
                      </td>
                    </tr>  
                 @endfor   
                    <tr>
                      <td><br/><br/><br/></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @else
    <div class="card-body">
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"></span></button>
            You don't have Company Invitations.
        </div>
    </div>
    @endif
</div>
@endsection