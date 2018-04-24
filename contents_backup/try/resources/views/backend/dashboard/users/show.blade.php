@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <!--<h2>{!!$fm_data->labels['form_title']!!}</h2>-->
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
    
<div class="card">
    <div class="card-header bgm-blue head-title">
            <h2>{!!$fm_data->labels['view']!!}</h2>
            <a href="<?php if(!empty($colleague)){echo route('invite.colleague');} else{echo route('user-create');}  ?>" class="btn btn-default">{!!$fm_data->labels['create']!!}</a>
            <a href="<?php if(!empty($colleague)){echo route('user-edit', [$user->_id,  'colleague' => 'colleague' ]); }else{echo route('user-edit', [$user->_id]);} ?>"class="btn btn-round btn-default">{!!$fm_data->labels['edit']!!}</a>
            <a href="<?php if(!empty($colleague)){ echo route('colleague.all');}else{echo route('users');}?>" class="btn btn-default">{!!$fm_data->labels['view_all']!!}</a>
    </div><!-- .card-header -->
    <!-- will be used to show any messages -->

    <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
        
    <table class="table table-striped responsive-utilities jambo_table ">
        <tbody>
           <tr>
                <td >{!!$fm_data->labels['username']!!}</td>
                <td>{!! $user->username !!}</td>
            </tr>
           <tr>
                <td >{!!$fm_data->labels['email']!!}</td>
                <td>{!! $user->email !!}</td>
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
                <td>{!! $user->active !!}</td>
            </tr>
            </tbody>
    </table>
</div><!-- .card -->
        
@endsection


