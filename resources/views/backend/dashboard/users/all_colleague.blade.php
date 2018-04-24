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
            <h2>View Colleagues</h2>
            <a href="{!! route('invite.colleague') !!}" class="btn btn-round btn-default">{!!$fm_data->labels['create']!!}</a>
            <a href="{!! route('colleague.all')  !!}" class="btn btn-round btn-default">{!!$fm_data->labels['view_all']!!}</a>
	</div><!-- .card-header -->
        
        <div class="card-body card-padding">
          <?php // print_r(count($users)); die;?>
            @if(count($users)<1)
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    You have no team members in your Company. Please add some team members.
                </div>    
            @else
<!--        <div class="row">
            {!! Form::model($fm_data, [
                'method' => 'POST',
                'route' => ['user_search'],
                'class' => 'form-horizontal form-label-left',
                'novalidate'=>''
            ]) !!}
            <div class="col-md-4  form-group top_search" style="padding: 20px 0; margin-left: 0px;">
                <div class="input-group">
                    {!! Form::text('term',$term, array('id'=>'term','required','placeholder'=>'Search Attributes...','class'=>'form-control searchattribute'))!!}
                    <span class="input-group-btn">
                        <button class="btn btn-default btn-icon-text waves-effect"><i class="zmdi zmdi-search"></i></button>
                    </span>
                    
                </div>
            </div>
            {!! Form::close() !!}
            
            <div class="text-right col-md-8">
                
            </div>
        </div>-->

  <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
        <table class="table table-striped responsive-utilities jambo_table ">
            <thead>
                <tr>
                    <th>{!! $fm_data->labels['username']!!}</th>
                    <th>{!! $fm_data->labels['name']!!}</th>
                    <th>{!! $fm_data->labels['surname']!!}</th>
                    <th>{!! $created="Created By"!!}</th>
                    <th>{!! $fm_data->labels['active']!!}</th>
                    <th>{!! $fm_data->labels['action']!!}</th>
                    <th>Activate / Deactivate</th>
                    <th>{!! $allow="Allow my site / Disallow"!!}</th>
                </tr>
            </thead>
            <tbody> 
              <?php $i=0; ?>
                @foreach($users as $user)
                    @if(!empty($user))
                        <tr>
                            <td>{!! $user->username !!}</td>
                            <td>
                                @if(!empty($name))
                                    {!! $name[$i] !!} 
                                @endif
                            </td>
                            <td>
                                @if(!empty($surname))
                                    {!! $surname[$i] !!}
                                @endif
                            </td>
                            <th>{!! $createdby[$i]!!}</th>
                            <td>{!! $user->active!!}</td>
                            <td>
                                 <a href="{!! route('user-show', $user->_id)  !!}" data-toggle="tooltip" data-placement="bottom" title="View"><i class='zmdi zmdi-eye zmdi-hc-fw'></i></a> &nbsp; 
                                 <a href="{!! route('edit.colleague', ['id'=>$user->_id])  !!}" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class='zmdi zmdi-edit zmdi-hc-fw'></i></a>
                            </td>
                            <td>
                                @if($user->active == 1)
       <!--                         <a href="{!! route('user-deactive', $user->id) !!}" class="zmdi zmdi-minus zmdi-hc-fw"  alt="Deactivate" onclick='return confirm("Are you sure you want to deactivate the user?")'>Deactivate</a>-->
                                    <a href="{!! route('user-deactive', $user->id) !!}" data-toggle="tooltip" data-placement="bottom" title="Deactivate"  alt="Deactivate" onclick='return confirm("Are you sure you want to deactivate the user?")'>Deactivate</a>                              <!--{!! Form::close()!!}-->
                                 @else
                                    <a href="{!! URL::route('reactivate', $user->id) !!}" data-toggle="tooltip" data-placement="bottom" title="Activate" alt ="Activate">Activate</a>
                                 @endif
                            </td>
                            <td>
                                @if($createdby[$i] == Auth::user()->username)
                                      <a href="{!! route('user-allow', $user->_id)  !!}"  alt="Allow" >Manage Permission</a>
                                @else
                                      <p>--</p>
                                @endif
                            </td>
                        </tr>  
                    @endif
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