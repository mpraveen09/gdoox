@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>  {!!$fm_data->labels['form_title']!!}</h2>-->
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
        <h2> Invitation List </h2>
    </div><!-- .card-header -->
    <div class="card-body card-padding"> 
		<table class="table table-striped responsive-utilities jambo_table ">		
		@if(!empty($users))
			<tr>
			<th>Invitee Name</th><th>Invitee Email</th><th>Invitation Date</th>
			</tr>
			@foreach($users as $user)
				<tr>
					<td>
						@if(!empty($user->username))
							{!! $user->username !!}
						@endif
						@if(!empty($user->name))
							{!! $user->name !!}
						@endif
					</td>
					<td>
						{!! $user->email !!} 
					</td>
					<td>
						{!! $user->created_at !!} 
					</td>					
				</tr>
			@endforeach

	   	@else
			<tr>
				<td>			
				There are no recent invitation records in the database.
				</td>					
			</tr>		
		@endif
		</table>	
		<br/>
		<br/>
		
              <div class="form-group">
				<div class="col-md-6 col-sm-6 col-xs-12">
					{!!HTML::linkRoute('invite-multi-user-create', 'Send New Invitations', array(), array('class'=>"btn btn-round btn-primary"))!!}
				</div>
            </div>
		<br/>
		
    </div>
</div>
@endsection