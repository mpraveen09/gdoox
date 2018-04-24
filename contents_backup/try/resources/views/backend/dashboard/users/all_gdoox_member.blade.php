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
    
    <div class="card">
        <div class="pm-body clearfix">
            <ul class="tab-nav tn-justified">
                @foreach($nav_menu as $menu)
                    @if($menu->route == $route)
                        <li class="active waves-effect"><a href="{!! route($menu->route_name)!!}">{!! $menu->name !!}</a></li>
                    @else
                        <li class="waves-effect"><a href="{!! route($menu->route_name)!!}">{!! $menu->name !!}</a></li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
    
    <div class="card">
	<div class="card-header bgm-blue head-title">
            <h2>All Member</h2>
            <a href="{!! route('gdoox_member.create')  !!}" class="btn btn-default">{!!$fm_data->labels['create']!!}</a>
            <a href="{!! route('gdoox_member.view_all')  !!}" class="btn btn-default">{!!$fm_data->labels['view_all']!!}</a>
	</div><!-- .card-header -->
        
        <div class="card-body card-padding">
          <?php // print_r(count($users)); die;?>
            @if(count($users)<1)
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    No any Gdoox member
                </div>    
            @else
            <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                  <table class="table table-striped responsive-utilities jambo_table ">
                      <thead>
                          <tr>
                              <th>{!! $fm_data->labels['username']!!}</th>
                              <th>Role</th>
                              <th>{!! $created="Created By"!!}</th>
                              <th>{!! $fm_data->labels['active']!!}</th>
                              <th>{!! $fm_data->labels['action']!!}</th>
                              <th>Activate / Deactivate</th>
                              <th>Manage Permission</th>
                          </tr>
                      </thead>
                      <tbody> 
                        <?php $i=0; ?>
                      @foreach( $users as $user )
                          <tr>
                              <td>{!! $user->username!!}</td>
                              <td>{!! $roles[$i]!!}</td>
                              <th>{!! $createdby[$i]!!}</th>
                              <td>{!! $user->active!!}</td>
                              <td>
                                   <a href="#" data-toggle="tooltip" data-placement="bottom" title="View"><i class='zmdi zmdi-eye zmdi-hc-fw'></i></a> &nbsp; 
                                   <a href="#" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class='zmdi zmdi-edit zmdi-hc-fw'></i></a>
                               </td>
                               <td>
                                   @if($user->active == 1)
          <!--                              <a href="{!! route('user-deactive', $user->id) !!}" class="zmdi zmdi-minus zmdi-hc-fw"  alt="Deactivate" onclick='return confirm("Are you sure you want to deactivate the user?")'>Deactivate
                                        </a>-->
                                        <a href="{!! route('user-deactive', $user->id) !!}" data-toggle="tooltip" data-placement="bottom" title="Deactivate"  alt="Deactivate" onclick='return confirm("Are you sure you want to deactivate the user?")'>Deactivate
                                        </a>                              <!--{!! Form::close()!!}-->
                                    @else
                                    <a href="{!! URL::route('reactivate', $user->id) !!}" data-toggle="tooltip" data-placement="bottom" title="Activate" alt ="Activate">Activate</a>
                                    @endif
                               </td>
                               <td><a href="{!! route('gdoox_member.manage_permission', $user->_id)  !!}"  alt="Allow" >Manage Permission</a></td>
                          </tr>  
                          <?php $i++;?>
                      @endforeach
                      </tbody>
                  </table>
            </div>
        @endif
      </div><!-- .card-body -->

        <div class="row">
            <div class="text-right col-md-12">
            </div>
        </div>    
</div><!-- .card -->
@endsection