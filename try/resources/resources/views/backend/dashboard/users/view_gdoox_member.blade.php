@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>Managing account</h2>-->
<!--<div class="page-top-links">-->
<!--</div>-->
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
            <h2>Member</h2>
            <a href="{!! route('gdoox_member.create')  !!}" class="btn btn-default">{!!$fm_data->labels['create']!!}</a>
            <a href="{!! route('gdoox_member.view_all')!!}" class="btn btn-default">{!!$fm_data->labels['view_all']!!}</a>
	</div><!-- .card-header -->
        
        <div class="card-body card-padding">
            <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                <table class="table table-striped responsive-utilities jambo_table ">
                    <tbody>
                        <tr>
                            <td >{!!$fm_data->labels['username']!!}</td>
                            <td>{!! $member->username !!}</td>
                        </tr>
                        <tr>
                            <td >{!!$fm_data->labels['email']!!}</td>
                            <td>{!! $member->email !!}</td>
                        </tr>
                        <tr>
                            <td >{!!$fm_data->labels['role']!!}</td>
                            <td>{!! $role !!}</td>
                        </tr>
                        <tr>
                            <td >{!!$fm_data->labels['level']!!}</td>
                            <td>{!! $level !!}</td>
                        </tr>
                        <tr>
                            <td >{!!$fm_data->labels['active']!!}</td>
                            <td>{!! $member->active !!}</td>
                        </tr>
                    </tbody>
                </table>
            </div><!-- .card -->
        </div><!-- .card-body --> 
</div><!-- .card -->
@endsection