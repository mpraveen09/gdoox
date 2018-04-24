@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    
@endsection

@section('right_col_title_right')
@endsection

@section('right_col')
    @if (Session::has('message'))
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"></span></button>
            {!!  Session::get('message')  !!}
        </div>
    @endif
    
    @if(HTML::ul($errors->all()))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"></span></button>
            {!! HTML::ul($errors->all()) !!}
        </div>
    @endif
    
    @include('navigation_tabs.network_tabs')
    
    <div class="card">
        <div class="card-header bgm-blue">
            <h2>Invite Partner</h2>
        </div><!-- .card-header -->
        {!! Form::open(array('route' => 'company.network.invite.create','method'=>'GET', 'class'=>'form-horizontal form-label-left')) !!}
            {!! Form::hidden('term','search') !!}
            <div class="card-body card-padding">
                <div class="row">           
                    <div class="col-sm-6">
                        <p class="c-black f-500 m-b-20">Enter Search Term</p>
                        <div class="form-group">
                            {!! Form::text('keyword','',array('placeholder'=>'Search Keyword','id'=>'keyword',"required",'class'=>'form-control')) !!}
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <p class="c-black f-500 m-b-20">Filter Your Search</p>
                        <div class="form-group">
                            <div class="fg-line">
                                <div class="select">
                                    {!! Form::select('filter', $category, 'all', ['required','class' => 'form-control','id'=>'filter']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group clearfix">      
                    <button class="btn btn-primary waves-effect">Search</button>
                </div>
            </div>
        {!! Form::close()!!}
</div>
    
    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>Accept/Deny Invitation</h2>
        </div><!-- .card-header -->
        
        <div class="card-body">
            @if(!$networkinvitation->count())
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"></span></button>
                    You don't have Network Invitations.
                </div>    
            @else
                <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                    <table class="table table-striped responsive-utilities jambo_table ">
                        <thead>
                            <tr>
                                <th>Inviter</th> 
                                <th>Inviter's Company</th>
                                <th>Inviter's Email</th>
                                <th>Invitation Date</th>
                                <th>Invited Site</th>
                                <th>Message</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>    
                         @for($i=0;$i<count($invitedata['inviter']);$i++)
                            <tr>
                              <td>{!! $invitedata['inviter'][$i] !!}</td>
                              <td>{!! $invitedata['inviter_company'][$i] !!}</td>
                              <td>{!! $invitedata['inviter_email'][$i] !!}</td>
                              <td>{!! $invitedata['invitation_date'][$i] !!}</td>
                              <td>{!! $invitedata['company_site_slug'][$i] !!}</td>
                              <td>{!! $invitedata['message'][$i] !!}</td>
                              <td>
                                    @if($invitedata['status'][$i]=='Accepted')
                                        Accepted
                                    @elseif($invitedata['status'][$i]=='Denied')
                                        Denied
                                    @else
                                      <a href="{!!route('company.network.update', [$invitedata['company_site_slug'][$i], $invitedata['inviter_id'][$i]])!!}"><i class="zmdi zmdi-check zmdi-hc-fw"></i>Accept</a>/
                                      <a href="{!!route('company.network.destroy', [$invitedata['company_site_slug'][$i], $invitedata['inviter_id'][$i]])!!}"><i class="zmdi zmdi-block-alt zmdi-hc-fw"></i>Deny</a>
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

                <div class="row">
                    <div class="text-right col-md-12">
                        {!! $networkinvitation->render() !!}
                    </div>
                </div>    
            @endif
        </div><!-- .card-body -->
    </div>

  
    <h4>Requests Sent</h4>
    <div class="card">
          <div class="card-header bgm-blue head-title">
              <h2>Invitation Status</h2>
          </div>
          <div class="card-body">
              @if(!$invitationstatus->count())
                  <div class="alert alert-warning alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"></span></button>
                      You have not send any invitation.
                  </div>    
              @else
                  <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                      <table class="table table-striped responsive-utilities jambo_table ">
                          <thead>
                              <tr>
                                  <th>Invitee</th>
                                  <th>Invitee Email</th>
                                  <th>Invitee Site</th>
                                  <th>Type</th>
                                  <th>Message</th>
                                  <th>Status/Action</th>
                                  <th>Invitation Date</th>
                              </tr>
                          </thead>
                          <tbody> 
                           @for($i= 0;$i<count($invitedata['invitee']);$i++)
                            <?php // print_r($invitedata); die;?>
                              <tr>
                                <td>{!!$invitedata['invitee'][$i]!!}</td>
                                <td>{!!$invitedata['invitee_email'][$i]!!}</td>
                                <td>{!!$invitedata['company_site_slug'][$i]!!}</td>
                                <td>{!!$invitedata['type'][$i]!!}</td>
                                <td>{!!$invitedata['message'][$i]!!}</td>
                                <td>
                                    {!!$invitedata['status'][$i]!!}
                                    @if($invitedata['status'][$i] != "Expired" && $invitedata['status'][$i] != "Accepted")
                                    /<a href="{!!route('company.network.resend', $invitedata['id'][$i])!!}" class="">Resend</a>
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
    
@endsection