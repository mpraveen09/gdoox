@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <h2>CRM</h2>
    <!--<div class="page-top-links">-->
   
    <!--</div>-->
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
 
    @if(!$users->count())
        <div class="card">
            <div class="card-body">
                <div class="alert alert-warning alert-dismissible" role="alert">
                     There Are No Users
                </div>  
            </div>
        </div>               
    @else
     
     <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>Search User</h2>
            <a href="{!! route('crm_users.create')  !!}" class="btn  btn-default">Create New</a>
        </div><!-- .card-header -->
        
        {!! Form::open([
            'method' => 'GET',
            'route' => 'crm_users.index',
            'class' => 'form-horizontal form-label-left'
        ]) !!}
            

            <div class="card-body card-padding">
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Search By First Name:</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('first_name',$fname, ['placeholder'=>'First Name','id'=>'first_name','class' => 'form-control']) !!}
                    </div>
                </div>
                
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Search By Last Name:</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('last_name',$lname, ['placeholder'=>'Last Name','id'=>'last_name','class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Search By Department:</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::select('department',$department,$department_val, ['placeholder'=>'Select Department','id'=>'department','class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Search By User Status:</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::select('status',$status,$status_val, ['placeholder'=>'Select User Status','id'=>'status','class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-5">
                        <a href="{!! route('crm_users.index')  !!}" type="submit" class="btn btn-round btn-primary">Cancel</a>
                        <button id="send" type="submit" class="btn btn-round btn-success">Search</button>
                    </div>
                </div> 
                <div class="ln_solid"></div>
            </div>
        {!! Form::close() !!}
    </div>

              
    <div class="card">
        <div class="card-header bgm-blue"><h2>Users</h2></div>
        <div class="row">
            <div class="text-right col-md-12">
                 {!! $users->render() !!}
            </div>
        </div>
        <div class="card-body card-padding">  
            <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                <table class="table table-striped responsive-utilities jambo_table ">
                    <thead>
                      <th>
                          @if(!empty($form_fields['form_fields']['first_name']['label']))
                              {!! $form_fields['form_fields']['first_name']['label'] !!}
                          @endif
                      </th>
                      <th>
                          @if(!empty($form_fields['form_fields']['last_name']['label']))
                            {!! $form_fields['form_fields']['last_name']['label'] !!}
                          @endif
                      </th>
                      <th>
                          @if(!empty($form_fields['form_fields']['status']['label']))
                            {!! $form_fields['form_fields']['status']['label'] !!}
                          @endif
                      </th>
                      <th>
                          @if(!empty($form_fields['form_fields']['department']['label']))
                            {!! $form_fields['form_fields']['department']['label'] !!}
                          @endif
                      </th>
                      <th>
                          @if(!empty($form_fields['form_fields']['phone']['label']))
                            {!! $form_fields['form_fields']['phone']['label'] !!}
                          @endif
                      </th>

                      <th>
                          Action
                      </th>
                     </thead>
                     <tbody>
                         @foreach($users as $user)
                          <tr>
                               <td>{!! $user->first_name !!}</td>
                               <td>{!! $user->last_name !!}</td>
                               <td>{!! $user->status !!}</td>
                               <td>{!! $user->department !!}</td>
                               <td>{!! $user->phone !!}</td>
                               <td>
                                   <a href="{!! route('crm_users.show', $user->_id)  !!}"><i class='zmdi zmdi-eye zmdi-hc-fw'></i></a> &nbsp; 
                                   <a href="{!! route('crm_users.edit', $user->_id)  !!}"><i class='zmdi zmdi-edit zmdi-hc-fw'></i></a>
                               </td>
                           </tr>
                          @endforeach
                     </tbody>
                 </table>
          </div>
       </div>
        <div class="row">
            <div class="text-right col-md-12">
                 {!! $users->render() !!}
            </div>
        </div>
    </div>                        
    @endif   
@endsection
 
@section('footer_add_js_script')
    <script type="text/javascript">


    </script>
@endsection