@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2></h2>-->
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
 
<div class="card">
	<div class="card-header bgm-blue head-title">
            <h2>Chat Invitations</h2>
	</div><!-- .card-header -->
	<div class="card-body">
            @if(!$chat_invitations->count())
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    You have no Chat Invitations
                </div>    
            @else
   
                <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                    <table class="table table-striped responsive-utilities jambo_table ">
                        <thead>
                            <tr>
                                <th>Inviter</th>
                                <th>Accept</th>
                                <th>Deny</th>
                            </tr>
                        </thead>
                        <tbody>    
                         @foreach($chat_invitations as $invitations)
                            <tr>
                                <td>{!! $invitations->contact_name !!}</td>
                                <td>
                                    <a href="{!! route('chat.update', [$invitations->chat_id]) !!}"><i class="zmdi zmdi-check zmdi-hc-fw"></i>Accept</a>
                                </td>
                                <td>
                                    <a href="{!! route('chat.update', [$invitations->chat_id]) !!}"><i class="zmdi zmdi-block-alt zmdi-hc-fw"></i>Deny</a>
                                </td>
                            </tr>  
                         @endforeach   
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
                            {!! $chat_invitations->render() !!}
                        </div>
                    </div>    
    @endif
</div><!-- .card-body -->

</div><!-- .card -->
@endsection