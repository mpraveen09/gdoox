@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('header_custom_css') 
@endsection

@section('header_add_js_files')
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
@endsection

@section('right_col_title_right')
@endsection


@section('right_col')

<!--@if (Session::has('error'))
    <div class="alert alert-danger">{!!  Session::get('error')  !!}</div>
@endif

@if (Session::has('message'))
    <div class="alert alert-info">{!!  Session::get('message')  !!}</div>
@endif-->
<div class="block-header">
    <h2>Messages</h2>
</div>
<div class="card m-b-1">
   <div class="card-header">
        <div id="show_group_form"><a href="#">Create Group</a></div>
   </div>
   <div class="card-body">
        <div class="group_chat" style="display: none;">
       {!! Form::open([
            'method' => 'POST',
            'route' => 'chat.store',
            'class' => 'form-horizontal'
            ]) !!}
           
            <div class="card-header">
               <h2>Create Chat Group</h2>
            </div>
            
           <div class="card-body card-padding">
               @if($contacts->count())
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Group Name: </label>
                        <div class="col-sm-10">
                            <div class="fg-line">
                                <input type="text" class="form-control input-sm" name="groupname" id="groupname" placeholder="Group Name">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Description: </label>
                        <div class="col-sm-10">
                            <div class="fg-line">
                                <textarea class="form-control input-sm" name="description" id="description" placeholder="Description"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Contacts:</label>
                        <div class="col-sm-10">
                            <div class="table-responsive">
                                <table id="data-table-attr" class="table table-striped">
                                    <tbody>
                                        @foreach($contacts as $contact)
                                            <tr>
                                                <td>{!! Form::checkbox('users[]',$contact->contact_id, '' ,array('id' => 'contact_ids')) !!}</td>
                                                <td>{!! $contact->contact_name !!}</td>   
                                            </tr>
                                         @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="type" value="groupchat"/>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary btn-sm">Create</button>
                        </div>
                    </div>
                @else 
                    <div class="form-group">
                        <div class="col-sm-10">
                            <div class="fg-line">
                                You don't have any Contacts. Please Invite Users, wait for the Approval and then try to create Group
                            </div>
                        </div>
                    </div>
                @endif 
           </div>
        {!! Form::close() !!}
   </div>
   </div>
</div>


<div class="card m-b-0" id="messages-main" style="height: 500px;">
    <div class="ms-menu">
        <div class="listview lv-user m-t-20">
            <div class="lv-item media active" style="overflow: scroll; height: 480px;">
                @if($chat_contacts->count())
                    <div>
                        <div class="btn btn-primary btn-block">Contacts</div>
                    </div>
                    <hr>
                    @foreach($chat_contacts as $contacts)
                        <div class="contact_div" style="cursor: pointer;" data-chat_type="singlechat" data-chat_id="{!! $contacts->chat_id !!}">
                            <div class="lv-avatar pull-left">
                                @if($contacts->request == 'Accepted')
                                    <div class="lv-avatar bgm-green pull-left">{!! substr($contacts->contact_name, 0, 1); !!}</div>
                                @else
                                    <div class="lv-avatar bgm-red pull-left">{!! substr($contacts->contact_name, 0, 1); !!}</div>
                                @endif
                            </div>
                        
                            <div class="media-body">
                                <div class="lv-title">{!! $contacts->contact_name !!}</div>
                                <div class="lv-small">
                                    @if($contacts->request == 'Accepted')Available
                                    @elseif($contacts->request == 'Pending' && $contacts->request_by == Auth::user()->id) Request Pending
                                    @elseif($contacts->request == 'Pending' && $contacts->request_by !== Auth::user()->id) New Chat Request                                    
                                    @else Offline
                                    @endif
                                </div> 
                            </div>
                        </div>
                        <hr>
                    @endforeach
                @else
                    <div>
                        <div class="btn btn-primary btn-block">Contacts</div>
                    </div>
                    <div>No Contacts</div>
                @endif

                @if($chat_groups->count())
                    <div>
                        <div class="btn btn-primary btn-block">Chat Groups</div>
                    </div>
                    <hr>
                    @foreach($chat_groups as $groups)
                        <div class="contact_div" style="cursor: pointer;" data-chat_type="groupchat" data-chat_id="{!! $groups->chat_id !!}">
                            <div class="lv-avatar pull-left">
                                <div class="lv-avatar bgm-green pull-left">{!! substr($contacts->contact_name, 0, 1); !!}</div>
                            </div>
                            <div class="media-body">
                                <div class="lv-title">{!! $groups->group_name !!}</div>
                                <div class="lv-small">Group</div> 
                            </div>
                        </div>
                        <hr>
                    @endforeach
                @else
                    <div>
                        <div class="btn btn-primary btn-block">Chat Groups</div>
                    </div>
                    <div>No Chat Groups</div>
                @endif

                @if($new_chat_req->count())
                    <div>
                        <div class="btn btn-primary btn-block">Pending Requests</div>
                    </div>
                    <hr>
                    @foreach($new_chat_req as $requests)
                        <div class="contact_div" style="cursor: pointer;" data-chat_type="singlechat" data-chat_id="{!! $requests->chat_id !!}">
                            <div class="lv-avatar pull-left">
                               <div class="lv-avatar bgm-red pull-left">{!! substr($requests->contact_name, 0, 1); !!}</div> 
                            </div>
                            <div class="media-body">
                                <div class="lv-title">{!! $requests->contact_name !!}</div>
                                <div class="lv-small">Pending Request</div> 
                            </div>
                        </div>
                        <hr>
                    @endforeach
                @endif 
            </div>
        </div>  
    </div>

    <div class="ms-body">
        <div class="listview lv-message">
            <div class="lv-body">
                <div class="lv-item media">
                    <div class="media-body">
                        <div class="contact_info"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--<div class="row">
    <div class="card">
        <div class="card-header">
             <h2>Messages</h2>
        </div>
        <div class="card-body card-padding">
            <div class="container">
                <div class="ms-menu">
                 <div class="listview">
                    @if($chat_contacts->count())
                        @foreach($chat_contacts as $contacts)
                        <ul id="view_user" data-chat_id="{!! $contacts->chat_id !!}">
                            <li data-chat_type="singlechat" data-chat_id="{!! $contacts->chat_id !!}">
                                <div class="pull-left p-relative">
                                    @if($contacts->request == 'Accepted')
                                        <div class="lv-avatar bgm-green pull-left">{!! substr($contacts->contact_name, 0, 1); !!}</div>
                                    @else
                                        <div class="lv-avatar bgm-red pull-left">{!! substr($contacts->contact_name, 0, 1); !!}</div>
                                    @endif
                                </div>

                                <div class="media-body">
                                    <div class="lv-title">{!! $contacts->contact_name !!}</div>
                                    <small class="lv-small">
                                        @if($contacts->request == 'Accepted')Available
                                        @elseif($contacts->request == 'Pending' && $contacts->request_by == Auth::user()->id) Request Pending
                                        @elseif($contacts->request == 'Pending' && $contacts->request_by !== Auth::user()->id) New Chat Request                                    
                                        @else Offline
                                        @endif
                                    </small>
                                </div>
                            </li>
                        </ul>
                        @endforeach
                        
                        @foreach($chat_groups as $groups)
                        <ul id="view_user" data-chat_id="{!! $groups->chat_id !!}">
                            <li data-chat_type="groupchat" data-chat_id="{!! $groups->chat_id !!}">
                                <div class="pull-left p-relative">
                                   <div class="lv-avatar bgm-green pull-left">{!! substr($groups->group_name, 0, 1); !!}</div> 
                                </div>

                                <div class="media-body">
                                    <div class="lv-title">{!! $groups->group_name !!}</div>
                                    <small class="lv-small">Group</small>
                                </div>
                            </li>
                        </ul>
                        @endforeach
                    @else
                    <ul>No Contacts</ul>
                    @endif
                </div>
                </div>
                <div class="ms-body">
                    <div class="listview lv-message">
                         <div class="contact_info"></div>
                    </div>
                </div>    
            </div> 
        </div>
    </div>
</div>-->

<div class="container">
    <div class="card">
        

        
        
         
    </div>
</div>    
@endsection



@section('footer_add_js_files')
    
@endsection



@section('footer_add_js_script')
<style>
    hr {
        margin-top: 3px;
        margin-bottom: 3px;
        border: 0;
    }
    .ms-items {
        background:#A2DEA4;
        padding: 4px 9px 2px;
        display: inline-block;
      }

    @media (min-width: 768px) {
      .ms-items {
        max-width: 100%;
      }
    }
</style>

<script type="text/javascript">
    $(function() {
        $('#show_group_form').click(function() {
            if($('.group_chat').is(':hidden')) {
                $('.group_chat').show();
            }
            else {
                $('.group_chat').hide();
            } 
        });
        
        
        $('.contact_div').click(function() {
            var chat_id = $(this).attr('data-chat_id');
            var chat_type = $(this).attr('data-chat_type');
            
            $.ajax({
                url: "{!! URL::route('fetchinfo') !!}",
                data: {
                    chat_id : chat_id,
                    chat_type : chat_type
                },
                success: function(data) {
                        $('.contact_info').html('');
                        $('.contact_info').html(data);
                    }
            });
        });
        
        $(document).on("click","#add_contact",function(e) {
            var chat_id = $(this).attr('data-chat_id');
            $.ajax({
                url: "{!! URL::route('addcontacts') !!}",
                data: {
                    chat_id : chat_id
                },
                success: function(data) {
                        $('.jambo_table').append(data);
                    }
            }); 
        });
        
        
        $(document).on("click","#save_contact",function(e) {
           var chat_id = $('#start_chat').attr('data-chat_id');
           var contact_ids = $("input[name=contact_ids]:checked").map(function () {
               return this.value;}).get().join(",");
               if(contact_ids !== '') {
                   $.ajax({
                        url: "{!! URL::route('savecontacts') !!}",
                        data: {
                            chat_id : chat_id,
                            contact_ids : contact_ids
                        },
                        success: function(data) {
                            // alert(data);
                            $('.jambo_table').data("");
                            $('.jambo_table').data(data);
                        }
                    });
               }
               else {
                   swal("Please select atleast one contact");
                   return false;
               }
           return false;
        });
        
        
        $(document).on("click","#start_chat",function(e) {
            var chat_id = $(this).attr('data-chat_id');
            var urls = "{!! URL::route('startchat') !!},"+chat_id;
            popupWindow = window.open(
		urls,'_blank','height=600,width=400,left=10,top=10,resizable=no,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes');
        });
        
        $(document).on("click","#chat_archive",function(e) {
            var chat_id = $(this).attr('data-chat_id');
            var urls = "{!! URL::route('chatarchive') !!},"+chat_id;
            popupWindow = window.open(
		urls,'_blank','height=600,width=400,left=10,top=10,resizable=no,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes');
        });
    });
</script>
@endsection
