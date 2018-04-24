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
        <h2>Group Contacts</h2>
        <a href="{!! route('crm_contactsgroup.create')  !!}" class="btn  btn-default">Create New</a>
        <a href="{!! route('crm_contactsgroup.index')  !!}" class="btn  btn-default">View All</a>
    </div>
    @if(!$group_contacts->count()) 
        <div class="card">
            <div class="card-body">
                <div class="alert alert-warning alert-dismissible" role="alert">
                     There are No Contacts in this Group
                </div>  
            </div>
        </div>               
    @else
        <div class="card-body">  
            <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                <table class="table table-striped responsive-utilities jambo_table ">
                    <thead>
                              <th>Name</th>
                              <th>Office Phone</th>
                              <th>Mobile Phone</th>
                              <th>Department</th>
                              <th>Email Address</th>
                              <th>Action</th>
                     </thead>

                     <tbody>
                          @foreach($group_contacts as $contact)
                           <tr>
                                <td>{!! $contact->first_name !!} {!! $contact->last_name !!}</td>
                                <td>{!! $contact->office_phone !!}</td>
                                <td>{!! $contact->mobile !!}</td>
                                <td>{!! $contact->department !!}</td>
                                <td>{!! $contact->email_address !!}</td>   

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
            </div>
        </div>
    @endif  
</div>                        
 
@endsection

@section('footer_add_js_script')
    <script type="text/javascript">    
      $('#isSelected').click(function() {
            alert();
            console.log("Hello");
        });
    </script>
@endsection