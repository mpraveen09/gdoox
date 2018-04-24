@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<h2>{!!$fm_data->labels['form_title']!!}</h2>
<!--<div class="page-top-links">-->
    <a href="{!! route('dashboard-user-create')  !!}" class="btn btn-default">{!!$fm_data->labels['create']!!}</a>
    <a href="{!! route('dashboard-users')  !!}" class="btn btn-default">{!!$fm_data->labels['view_all']!!}</a>
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
	<div class="card-header bgm-blue">
		<h2>{!!$fm_data->labels['view_all']!!}</h2>
	</div><!-- .card-header -->
	<div class="card-body card-padding">
    @if ( !$roles->count() )
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            No any Role defined
        </div>    
    @else
     
    </div><!-- .card-body -->
    <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
        <table class="table table-striped responsive-utilities jambo_table ">
            <thead>
                <tr>
                    <th>{!! $fm_data->labels['label1']!!}</th>
                    <th>{!! $fm_data->labels['label2']!!}</th>
                     <th>{!! $fm_data->labels['action']!!}</th>
                </tr>
            </thead>
            <tbody>    
            @foreach( $roles as $role )
                <tr>
                    <td>{!! $role->name!!}</td>
                    <td>{!! $role->level!!}</td>
                      <td>
                        <a href="{!! route('role-show', $role->_id)  !!}"><i class='zmdi zmdi-eye zmdi-hc-fw'></i></a> &nbsp; 
                        <a href="{!! route('role-edit', $role->_id)  !!}"><i class='zmdi zmdi-edit zmdi-hc-fw'></i></a>
                    </td>
                </tr>  
            @endforeach
    
            </tbody>
        </table>
        
        </div>
    
        <div class="row">
            <div class="text-right col-md-12">
            </div>
        </div>    
    @endif

    

</div><!-- .card -->
@endsection