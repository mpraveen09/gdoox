@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <!--<h2>CRM</h2>-->
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

     <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>Search Accounts</h2>
        </div><!-- .card-header -->
        
        {!! Form::open([
            'method' => 'GET',
            'route' => 'crm_accounts.index',
            'class' => 'form-horizontal form-label-left'
        ]) !!}
            

            <div class="card-body card-padding">
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Search By Name:</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('name',$name_val,['placeholder'=>'Name','id'=>'name','class' => 'form-control']) !!}
                    </div>
                </div>
                
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Search By Type:</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::select('type',$type,$type_val,['placeholder'=>'Select Type','id'=>'type','class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Search By Industry Status:</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::select('industry',$industry,$industry_val,['placeholder'=>'Select Industry Type','id'=>'status','class' => 'form-control']) !!}
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
        <div class="card-header bgm-blue"><h2>Accounts</h2>
            <a href="{!! route('crm_accounts.create')  !!}" class="btn  btn-default">Create New</a>
            <a href="{!! route('crm_accounts.index')  !!}" class="btn  btn-default">View All</a>
        </div>
        @if(!$accounts->count())
            <div class="card">
                <div class="card-body">
                    <div class="alert alert-warning alert-dismissible" role="alert">
                         No Record Found
                    </div>  
                </div>
            </div>              
        @else
        <div class="row">
            <div class="text-right col-md-12">
                 {!! $accounts->render() !!}   
            </div>
        </div> 
        <div class="card-body card-padding">  
            <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                <table class="table table-striped responsive-utilities jambo_table ">
                    <thead>
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Type</th>
                          <th>Industry</th>
                          <th>Annual Revenue</th>
                          <th>Employees</th>
                          <th>Action</th>          
                     </thead>

                     <tbody>
                         @foreach($accounts as $account)
                          <tr>
                              <td>{!! $account->name !!}</td>
                              <td>{!! $account->phone !!}</td>
                              <td>{!! $account->type !!}</td>
                              <td>{!! $account->industry !!}</td>
                              <td>{!! $account->annual_revenue !!}</td>
                              <td>{!! $account->employees !!}</td>

                              <td>
                                  <a href="{!! route('crm_accounts.show', $account->_id)  !!}">
                                      <i class='zmdi zmdi-eye zmdi-hc-fw'></i>
                                  </a> &nbsp; 
                                  <a href="{!! route('crm_accounts.edit', $account->_id)  !!}">
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
                 {!! $accounts->render() !!}
            </div>
        </div> 
    </div>                        
    @endif   
@endsection
 
@section('footer_add_js_script')
    <script type="text/javascript">


    </script>
@endsection