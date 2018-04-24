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
            <h2>Accept/Deny Invitation</h2>
	</div><!-- .card-header -->
        
	<div class="card-body">
            @if(!$businessinvitation->count())
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    You have no invitations
                </div>    
            @else
   
            <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                <table class="table table-striped responsive-utilities jambo_table ">
                    <thead>
                        <tr>
                            <th>Company Name</th>
                            <th>Inviter</th>
                            <th>Accept/Deny</th>
                        </tr>
                    </thead>
                    <tbody>    
                     @for($i=0;$i<count($invitedata['inviter']);$i++)
                        <tr>
                          <td>{!!$invitedata['company'][$i]!!}</td>
                          <td>{!!$invitedata['inviter'][$i]!!}</td>
                          <td>
                          @if($invitedata['status'][$i]=='Accept')
                          Accepted
                          @elseif($invitedata['status'][$i]=='Deny')
                          Denied
                          @else
                            <a href="{!!route('invite.company.update', [$invitedata['company_id'][$i], $invitedata['inviter_id'][$i]])!!}"><i class="zmdi zmdi-check zmdi-hc-fw"></i>Accept</a>
                            <a href="{!!route('invite.company.destroy', [$invitedata['company_id'][$i], $invitedata['inviter_id'][$i]])!!}"><i class="zmdi zmdi-block-alt zmdi-hc-fw"></i>Deny</a>
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
                    {!! $businessinvitation->render() !!}
                </div>
            </div>    
            @endif
        </div><!-- .card-body -->

</div><!-- .card -->
@endsection