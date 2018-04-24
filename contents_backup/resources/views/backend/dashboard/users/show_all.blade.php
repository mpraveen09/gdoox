@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>  {!! $fm_data->labels['user_title'] !!}</h2>-->
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
    
    @include('navigation_tabs.general_tabs')

    <div class="card">
	<div class="card-header bgm-blue head-title">
            <h2>{!!$fm_data->labels['view_all']!!}</h2>
            <a href="{!! route('user-create')  !!}" class="btn btn-default">{!!$fm_data->labels['create']!!}</a>
            <a href="{!! route('users')  !!}" class="btn btn-default">{!!$fm_data->labels['view_all']!!}</a>
	</div><!-- .card-header -->
        
        <div class="card-body card-padding">
            @if(count($users)<1)
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    No any user below your level
                </div>    
            @else
            <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                  <table class="table table-striped responsive-utilities jambo_table ">
                      <thead>
                          <tr>
                              <th>{!! $fm_data->labels['username']!!}</th>
                              <th>{!! $fm_data->labels['email']!!}</th>
                              <th>{!! $fm_data->labels['role']!!}</th>
                              <th>{!! $created="Created By"!!}</th>
                              <th>Company</th>
                              <th>{!! $fm_data->labels['active']!!}</th>
                              <th>{!! $fm_data->labels['action']!!}</th>
                              <th>Activate/ <br />Deactivate</th>
                              <!--<th>{!! $allow="Allow my site/Disallow"!!}</th>-->
                          </tr>
                      </thead>
                      <tbody> 
                        <?php $i=0; ?>
                      @foreach( $users as $user )
                          <tr>
                              <td>{!! $user->username!!}</td>
                              <td>{!! $user->email!!}</td>
                              <td>{!! $roles[$i]!!}</td>
                              <td>{!! $createdby[$i]!!}</td>
                              <td>
                                  @if(!empty($comp))
                                      @if(array_key_exists($user->_id, $comp))
                                          {!! $comp[$user->_id] !!}
                                      @else 
                                          N/A
                                      @endif
                                  @endif
                              </td>
                              <td>{!! $user->active!!}</td>
                              <td>
                                   <a href="{!! route('user-show', $user->_id)  !!}" data-toggle="tooltip" data-placement="bottom" title="View"><i class='zmdi zmdi-eye zmdi-hc-fw'></i></a> &nbsp; 
                                   <a href="{!! route('user-edit', $user->_id)  !!}" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class='zmdi zmdi-edit zmdi-hc-fw'></i></a>
                              </td>
                               <td>
                                    @if($user->active == 1)
                                        <a href="{!! route('user-deactive', $user->id) !!}" class=""  alt="Deactivate" data-toggle="tooltip" data-placement="bottom" title="Deactive" onclick='return confirm("Are you sure you want to deactivate the user?")'>Deactivate</a>                              <!--{!! Form::close()!!}-->
                                    @else
                                        <a href="{!! URL::route('reactivate', $user->id) !!}" alt ="Activate" data-toggle="tooltip" data-placement="bottom" title="Activate">Activate</a>
                                    @endif
                               </td>
          <!--                  <td>
                                @if($createdby[$i]==Auth::user()->username)
                                  <a href="{!! route('user-allow', $user->_id)  !!}"  alt="Allow" >Allow</a>
                                @else
                                <p>--</p>
                                @endif
                               </td>-->
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