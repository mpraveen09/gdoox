    @extends('layout.backend.master')
    @extends('layout.backend.userinfo')

    @section('right_col_title_left')
    @endsection

    @section('right_col_title_right')
    @endsection

    @section('right_col')
        @if (Session::has('message'))
            <div class="alert alert-info alert-dismissible" role="alert">
                {!!  Session::get('message')  !!}
            </div>
        @endif
        
        @include('navigation_tabs.crm_tabs')
        
        <div class="card">
            <div class="card-header bgm-blue head-title">
              <h2>Groups</h2>
              <a href="{!! route('crm_groups.create')  !!}" class="btn  btn-default">Create New</a>
              <a href="{!! route('crm_groups.index')  !!}" class="btn  btn-default">View All</a>
            </div>
            @if(!$groups->count())
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            You have no Groups
                        </div>  
                    </div>
                </div>    
            @else
            <div class="row">
                <div class="text-right col-md-12">
                    {!! $groups->render() !!}
                </div>
            </div>
            <div class="card-body card-padding">  
                <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                    <table class="table table-striped responsive-utilities jambo_table ">
                        <thead>
                              <th>Group Name</th>
                              <th>Group Admin</th>
                              <th>Description</th>
                              <th>Action</th>
                         </thead>

                         <tbody>
                             @foreach($groups as $group)
                              <tr>
                                   <td>{!! $group->group_name !!}</td>
                                   <td>{!! $group->group_admin_name !!}</td>
                                   <td>{!! $group->description !!}</td>
                                   <td>
                                       <a href="{!! route('crm_groups.show', $group->_id)  !!}">
                                           <i class='zmdi zmdi-eye zmdi-hc-fw'></i>
                                       </a> &nbsp; 
                                       <a href="{!! route('crm_groups.edit', $group->_id)  !!}">
                                           <i class='zmdi zmdi-edit zmdi-hc-fw'></i>
                                       </a>
                                   </td>
                               </tr>
                              @endforeach
                         </tbody>  
                     </table>
                </div>
           </div>
            <div class="row">
                <div class="text-right col-md-12">
                    {!! $groups->render() !!}
                </div>
            </div>
            @endif
        </div>                        
    @endsection
 
@section('footer_add_js_script')
    <script type="text/javascript">


    </script>
@endsection