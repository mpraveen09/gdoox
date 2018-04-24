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

@include('navigation_tabs.crm_tabs')

<div class="card">
    <div class="card-header bgm-blue head-title">
        <h2>Search Contact</h2>
    </div><!-- .card-header -->
    
    {!! Form::open([
        'method' => 'GET',
        'route' => 'crm_contacts.index',
        'class' => 'form-horizontal form-label-left'
    ]) !!}


        <div class="card-body card-padding">
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Search By Name:</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('name',$name_val, ['placeholder'=>'Name','id'=>'name','class' => 'form-control']) !!}
                </div>
            </div>

            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Search By Department:</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::select('department',$department,'$department_val', ['placeholder'=>'Department','id'=>'department','class' => 'form-control']) !!}
                </div>
            </div>

            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Search By Group:</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::select('group', $contact_group, $group_val, ['placeholder'=>'Select Group','id'=>'group','class' => 'form-control']) !!}
                </div>
            </div>

            <div class="ln_solid"></div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-5">
                    <a href="{!! route('crm_contacts.index')  !!}" type="submit" class="btn btn-round btn-primary">Cancel</a>
                    <button id="send" type="submit" class="btn btn-round btn-success">Search</button>
                </div>
            </div> 
            <div class="ln_solid"></div>
        </div>
    {!! Form::close() !!}
</div>
<div class="card">
    <div class="card-header bgm-blue head-title">
          <h2>Contacts</h2>
          <a href="{!! route('crm_contacts.create')  !!}" class="btn  btn-default">Create New</a>
          <a href="{!! route('crm_contacts.index')  !!}" class="btn  btn-default">View All</a>
    </div>
    @if(!$contacts->count()) 
    <div class="card">
        <div class="card-body">
            <div class="alert alert-warning alert-dismissible" role="alert">
                 You have no Contacts
            </div>  
        </div>
    </div>               
    @else
    <div class="row">
        <div class="text-right col-md-12">
             {!! $contacts->render() !!}
        </div>
    </div> 
    <div class="card-body card-padding">
        {!! Form::open(['method' => 'POST','route' => 'contacts.delete']) !!}
        <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
            <table class="table table-striped responsive-utilities jambo_table">
              <thead>
                    <th></th>
                    <th>Name</th>
                    <th>Company</th>
                    <th>Office Phone</th>
                    <th>Country</th>
                    <th>Email Address</th>
                    <th>Mobile Phone</th>
                    <th>Contact Group</th>
                    <th>Action</th>
               </thead>

              <tbody>
                   @foreach($contacts as $contact)
                    <tr>
                         <td>{!! Form::checkbox('contact_id[]', $contact->_id) !!}</td>
                         <td>{!! $contact->first_name !!} {!! $contact->last_name !!}</td>
                         <td>{!! $contact->company_name !!}</td>
                         <td>{!! $contact->primary_add_country !!}</td>
                         <td>{!! $contact->email_address !!}</td>
                         
                         <td>{!! $contact->office_phone !!}</td>
                         <td>{!! $contact->mobile !!}</td>
                         
                         <td>
                            @if(!empty($contact->contact_group_name))
                               @if(is_array($contact->contact_group_name))
                                   {!! $str = implode (",", $contact->contact_group_name);  !!}
                               @else
                                   {!! $contact->contact_group_name !!}
                               @endif
                            @else
                               N/A
                            @endif
                         </td>
                         <td>
                             <a href="{!! route('crm_contacts.show', $contact->_id)  !!}">
                                 <i class='zmdi zmdi-eye zmdi-hc-fw'></i>
                             </a> &nbsp;
                             <a href="{!! route('crm_contacts.edit', $contact->_id)  !!}">
                                 <i class='zmdi zmdi-edit zmdi-hc-fw'></i>
                             </a>
                         </td>
                     </tr>
                   @endforeach
              </tbody>
             </table>
            <table>
                <tr>
                    <td>
                        <button class="btn btn-success btn-xs waves-effect">Delete</button>
                    </td>
                </tr>
            </table>
        </div>
        {!! Form::close() !!}
   </div>
    <div class="row">
        <div class="text-right col-md-12">
             {!! $contacts->render() !!}
        </div>
    </div>
    @endif
</div>                         
@endsection

@section('footer_add_js_script')
    <script type="text/javascript">    
      $('#isSelected').click(function() {
            console.log("Hello");
        });
    </script>
@endsection