@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('header_custom_css')
    <link href="{{ asset('/m-admin-ui/vendors/bower_components/summernote/dist/summernote.css') }}" rel="stylesheet">
@endsection

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>

@section('right_col_title_right')
@endsection
@section('right_col')
   


<div class="container">
    <div class="block-header">
        <h2>Messages</h2>
    </div>
    
    <div id="dialog"></div>
         
    <div class="card m-b-0" id="messages-main">
        <div class="ms-menu">
            <div class="listview lv-user m-t-20">
                @foreach($chat_contacts as $contacts)
                <div class="lv-item media start_chat" data-div-id="{!! $contacts->user_contact_id !!}">
                    <input type="hidden" name="chatting_to_id" id="chatting_to_id" value="{!! $contacts->user_contact_id !!}"/>
                    <div class="pull-left p-relative">
                        @if($contacts->status == 1)
                            <div class="lv-avatar bgm-green pull-left">{!! substr($contacts->user_contact_name, 0, 1); !!}</div>
                        @else 
                            <div class="lv-avatar bgm-red pull-left">{!! substr($contacts->user_contact_name, 0, 1); !!}</div>
                        @endif
                    </div>
                    
                    <div class="media-body">
                        <div class="lv-title">{!! $contacts->user_contact_name !!}</div>
                        <small class="lv-small">@if($contacts->status == 1)Available @else Offline @endif</small>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        
 
        
        <div class="ms-body">
            <div class="listview lv-message">
                <div class="lv-header-alt clearfix">
                    <div id="ms-menu-trigger">
                        <div class="line-wrap">
                            <div class="line top"></div>
                            <div class="line center"></div>
                            <div class="line bottom"></div>
                        </div>
                    </div>
                </div>
                <div class="messages"></div>
                
                
                <div class="lv-footer ms-reply">
<!--                {!! Form::open(array('route' => 'chat.store','method'=>'POST ', 'class'=>'form-horizontal form-label-left', 'files'=>true)) !!}-->
                    
                    <textarea name="message" id="message" style="background-color: rgba(204, 204, 204, 0.71)" placeholder="Write Your message Here"></textarea>
                    <button name="reply" class="reply"><i class="zmdi zmdi-mail-send"></i></button>
<!--                {!! Form::close() !!}-->
                </div>
            </div>
        </div>
        
    </div>
</div>
      
@endsection



@section('footer_add_js_files')
    
@endsection

@section('footer_add_js_script')
<script>  
    $(function() {
        $( "#dialog" ).dialog({
            autoOpen: false,
            width : 300,
            height: 400,
            open: function (event, ui) {
                $('#dialog').css('overflow', 'hidden'); //this line does the actual hiding
                $('.ui-widget-content').css('overflow-x','hidden');
                $('.ui-widget-content').css('overflow-y','hidden');
                // $(".ui-widget-content").width('');
            }
        });
 
        $( ".start_chat" ).click(function() {
            $( "#dialog" ).dialog("open");
        });
    });
  
    $(document).ready(function() {
        var chat_to_id = $('#chatting_to_id').val();
        if(chat_to_id===''){
            $('.ms-body').hide();
        }
        $(".start_chat" ).click(function() {
           $('#chatting_to_id').val($(this).attr('data-div-id'));
           var data = [$(this).attr('data-div-id'), '{!! Auth::user()->id !!}']
           $.ajax({
                url: "{!! URL::route('startchat') !!}",
                data: {
                    data: data,
                },
                success: function(data) {
                   //  $('.ms-body').show();
                    $('.dialog').append(data);
                   // $('#chatting_to_id').val(chatting_to_id);
                }
            });
        });
        
        
        $( ".reply" ).click(function() {
           var sent_msg = $('#message').val();
           var chatting_to_id = $('#chatting_to_id').val();
           var ids = [chatting_to_id, '{!! Auth::user()->id !!}'];
           alert(sent_msg);
           alert(chatting_to_id);
           alert(ids);
           $.ajax({
                url: "{!! URL::route('storechat') !!}",
                data: {
                    sent_msg : sent_msg,
                    ids : ids,
                    chatting_to_id : chatting_to_id
                },
                success: function(data) {
                    alert(data);
                    $('.messages').html("");
                    $('.messages').append(data);
                    $('#chatting_to_id').val(chatting_to_id);
                }
            });
        }); 
        
    });
</script>
@endsection
