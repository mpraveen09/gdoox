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
    
    <div class="card m-b-0" id="messages-main">
        <div class="ms-menu" style="height:500px; width:1000px">
            <div class="listview lv-user m-t-20">
                @foreach($chat_contacts as $contacts)
                <ul id="start_chat">
                    <li>
                        <input type="hidden" name="chatting_to_id" id="chatting_to_id" value="{!! $contacts->user_contact_id !!}"/>
                        <input type="hidden" name="chatting_to_name" id="chatting_to_name" value="{!! $contacts->user_contact_name !!}"/>
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
                    </li>
                </ul>
                @endforeach
            </div>
        </div>
        
        
 
        
        <div class="ms-body">
            <div class="listview lv-message">
                <div class="">
                    <div id="ms-menu-trigger">
                        <div class="line-wrap">
                            <div class="line top"></div>
                            <div class="line center"></div>
                            <div class="line bottom"></div>
                        </div>
                    </div>
                </div>
                <div class="messages"></div>
                
                
<!--                <div class="lv-footer ms-reply">
                    {!! Form::open(array('route' => 'chat.store','method'=>'POST ', 'class'=>'form-horizontal form-label-left', 'files'=>true)) !!}

                        <textarea name="message" id="message" style="background-color: rgba(204, 204, 204, 0.71)" placeholder="Write Your message Here"></textarea>
                        <button name="reply" class="reply"><i class="zmdi zmdi-mail-send"></i></button>
                    {!! Form::close() !!}
                </div>-->
            </div>
        </div>
    </div>
</div>
      
@endsection



@section('footer_add_js_files')
    
@endsection



@section('footer_add_js_script')
<style>
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
        $('#start_chat li').click(function() {
            alert();
            var title = $(this).children('#chatting_to_name').val();
            var chatting_to_id = $(this).children('#chatting_to_id').val(); 
            var data = [chatting_to_id, '{!! Auth::user()->id !!}'];
            var pageurl = "{!! URL::route('startchat') !!}";
            window.open(pageurl,'popUpWindow','height=300,width=400,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes');
        });     
    });
</script>

<!--<script type="text/javascript">
    $(function() {
        $('#start_chat li').click(function() {
            var title = $(this).children('#chatting_to_name').val();
            var chatting_to_id = $(this).children('#chatting_to_id').val(); 
            var data = [chatting_to_id, '{!! Auth::user()->id !!}'];
            
            $.ajax({
                url: "{!! URL::route('startchat') !!}",
                data: {
                    chatting_to_id : chatting_to_id,
                    data : data,
                },
                type: "POST",
                datatype: "html",
                success: function (data) {
                    if(!$(this).data('dialog')) {
                        var dialog = $('<div class="dialog">').html(data).dialog({ 
                            autoOpen:false,
                            width : 300,
                            height: 400,
                            title: title,
                            open: function (event, ui) {
                                $('.ui-dialog').css('overflow-x','hidden');
                                $('.ui-dialog').css('overflow-y','hidden');
                                $('.dialog').css('overflow-y','auto');
                            },
                            buttons: {
                                "Send": function() {
                                    $(this).addClass('datadiv');
                                    var chat_id = $(this).children('div').children("input[name=chat_id]").val();
                                    var message = $(this).children('div').children("input[name=message]").val();
                                    var chatting_to_id = $(this).children('div').children("input[name=chatting_to_id]").val();
                                    if(message!==''){                       
                                        $.ajax({
                                            url: "{!! URL::route('storechat') !!}",
                                            data: {
                                                message : message,
                                                chat_id : chat_id,
                                                chatting_to_id : chatting_to_id
                                            },
                                            success: function(data) {
                                                $('.datadiv').html('');
                                                $('.datadiv').html(data);
                                            }
                                        });
                                    }
                                    else {
                                        
                                    }
                                },
                            }
                        });
                        $(this).data('dialog', dialog);
                    }
                    $(this).data('dialog').dialog('open');  
                },
                error: function (req, status, error) {
                    alert("There is some Error!");
                }
            });
        });
    });
</script>-->

<script>
//    $(function() {
//        $('#start_chat li').click( function() {
//            
//            var title = $(this).children('#chatting_to_name').val();
//            var htm = $('.dialog').html();
//            $('#chatting_to_id').val($(this).attr('data-div-id'));
//            var data = [$(this).attr('data-div-id'), '{!! Auth::user()->id !!}']
//            
//            if(!$(this).data('dialog')) {
//                var dialog = $('<div>').html(htm).dialog({ 
//                    autoOpen:false,
//                    width : 300,
//                    height: 400,
//                    title: title,
//                    open: function (event, ui) {
//                        $('#dialog').css('overflow', 'hidden'); //this line does the actual hiding
//                        $('.ui-widget-content').css('overflow-x','hidden');
//                        $('.ui-widget-content').css('overflow-y','hidden');
//                    },
//                    buttons:{
//                        "Send": function() {
//                            alert('Send the Message')
//                        },
//                    }
//                });
//                $(this).data('dialog', dialog);
//            }
//            $(this).data('dialog').dialog('open');
//        });
        
//        $( "#dialog" ).dialog({
//            autoOpen: false,
//            width : 300,
//            height: 400,
//            open: function (event, ui) {
//                $('#dialog').css('overflow', 'hidden'); //this line does the actual hiding
//                $('.ui-widget-content').css('overflow-x','hidden');
//                $('.ui-widget-content').css('overflow-y','hidden');
//                // $(".ui-widget-content").width('');
//            }
//        });
 
//        $( ".start_chat" ).click(function() {
//            $( "#dialog" ).dialog("open");
//        });


//    });
  
//    $(document).ready(function() {
//        var chat_to_id = $('#chatting_to_id').val();
//        if(chat_to_id===''){
//            $('.ms-body').hide();
//        }
//    });
</script>
@endsection
