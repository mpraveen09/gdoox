@extends('layout.backend.masterchatbase')
@section('maincontent')

<div class="card">
        <div class="block-header">
            <h2>Messages</h2><h2 style="float: right;"><a href="" id="load_prevoius_msg" name="load_previous_msg">Load Previous Messages</a></h2>
        </div>
   
        <div class="card m-b-0" id="messages-main">
            <div class="ms-body" style="overflow: scroll; height: 400px;width: 100%;">
                <div class="listview lv-message">
                    <div class="lv-body" id="message-body">
                        @if($prev_chats->count())
                        @foreach ($prev_chats as $value)
                        @if($data->type==='singlechat')
                            @if($value->from_id == Auth::user()->id)
                                <div class="lv-item media">
                                     Me:
                                    <div class="media-body">
                                        <div class="ms-item">{!! $value->message !!}</div>
                                        <small class="ms-date" data-msg_time="{!! $value->date !!}"><i class="zmdi zmdi-time"></i> {!! $value->date !!}</small>
                                    </div>
                                </div>
                            @else
                                <div class="lv-item media right">
                                    {!! $value->from_name !!}:
                                    <div class="media-body">
                                        <div class="ms-item" style="background: #A2DEA4;">{!! $value->message !!}</div>
                                        <small class="ms-date" data-msg_time="{!! $value->date !!}"><i class="zmdi zmdi-time"></i> {!! $value->date !!}</small>
                                    </div>
                                </div>
                            @endif
                        @else
                            @if($value->from_id == Auth::user()->id)
                                <div class="lv-item media">
                                    {!! $value->from_name !!}
                                    <div class="media-body">
                                        <div class="ms-item">{!! $value->message !!}</div>
                                        <small class="ms-date" data-msg_time="{!! $value->date !!}"><i class="zmdi zmdi-time"></i> {!! $value->date !!}</small>
                                    </div>
                                </div>
                            @else
                                <div class="lv-item media right">
                                    {!! $value->from_name !!}
                                    <div class="media-body">
                                        <div class="ms-item" style="background: #A2DEA4;">{!! $value->message !!}</div>
                                        <small class="ms-date" data-msg_time="{!! $value->date !!}"><i class="zmdi zmdi-time"></i> {!! $value->date !!}</small>
                                    </div>
                                </div>
                            @endif
                        @endif
                        @endforeach
                        @endif
                    </div>
                    <div class="div_sent_msg" style="display: none;">
                        <small>Me:</small><br/>
                        <div class="div_ms_items ms-items" style="background:#9EE2A1; padding:4px 9px 2px!important; border-radius:0px;"></div>
                    </div>
                </div>
            </div>
        </div>
   
    
        <div class="message_area" style="width: 100%; padding-left: 20px; padding-right: 20px; padding-bottom: 20px; position: fixed; bottom: 0;">
            <div style="display: none" id="error_message" class="alert alert-danger fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                <strong>The message could not be sent. Please try again.</strong>
            </div>
                <textarea name="message" id="message" style="width: 100%; margin: 0px; height: 111px;" class=""></textarea>
            <input type="hidden" name="chat_id" id="chat_id" value="{!! $chat_id !!}"/>
            <input type="button" id="message" style="float: right;" name="message" class="btn_save_msg" value="Send" />
        </div>       
</div>

@endsection

@section('footer_add_js_script')
<style>
    html, body {
        max-width: 100%;
        overflow-x: hidden;
    }
</style>

<script type="text/javascript">
    $(function() {
//        ajaxFecthMsgs();
//        function ajaxFecthMsgs(){
//            var last_div_ref = $('#message-body');
//            var chat_id = $('#chat_id').val();
//            var date = $('#message-body div:last-child').children('div').children('.ms-date').attr("data-msg_time");
//            console.log(date);
//                $.ajax({
//                    url: "{!! URL::route('fetchchat') !!}",
//                    data: {
//                        chat_id : chat_id,
//                        date : date
//                    },
//                    success: function(data) {
//                            console.log(data);
//                            last_div_ref.append(data);
//                           // $('#message-body').html('');
//                           // $('#message-body').html(data);
//                            return false;
//                        }
//                });  
//            setTimeout(ajaxFecthMsgs, 5000);    
//        }
//       var waitForFinalEvent = (function () {
//            var timers = {};
//            return function (callback, ms, uniqueId) {
//              if (!uniqueId) {
//                uniqueId = "Don't call this twice without a uniqueId";
//              }
//              if (timers[uniqueId]) {
//                clearTimeout (timers[uniqueId]);
//              }
//              timers[uniqueId] = setTimeout(callback, ms);
//            };
//          })();
//       
//        $(window).resize(function () {
//            waitForFinalEvent(function(){
//  
//            }, 500, "some unique string");
//        });

        $('.btn_save_msg').click(function() {
            var last_div_ref = $('#message-body');
            var chat_id = $('#chat_id').val();
            var message = $('#message').val();
            var date = $('#message-body div:last-child').children('div').children('.ms-date').attr("data-msg_time");
            if(message!==''){
                $('#div_ms_items').append('<p id="msg_paragraph" style="font-size:12px">'+message+'</p>');
                $('#div_sent_msg').show();
                $.ajax({
                    url: "{!! URL::route('storechat') !!}",
                    data: {
                        date : date,
                        message : message,
                        chat_id : chat_id,                   
                    },
                    success: function(data) {
                        if(data !== 'error'){
                            last_div_ref.append(data);
                            // $('#message-body').html(data);
                            $('#error_message').hide();
                            $('#div_sent_msg').hide();
                            $('#message').val('');
                        }
                        else {
                            $('#error_message').show();
                        }
                    }
                });
            }
            else {

            }
          return false;            
        }); 
        
        
        
        $('#load_prevoius_msg').click(function(event) {
            event.preventDefault();
            var last_div_ref = $('#message-body');
            var chat_id = $('#chat_id').val();
            var date = $('#message-body div:first-child').children('div').children('.ms-date').attr("data-msg_time");
            $.ajax({
                url: "{!! URL::route('loadpreviousmessages') !!}",
                data: {
                    date : date,
                    chat_id : chat_id                
                },
                success: function(data) {
                    console.log(data);
                    if(data !== 'error') {
                        last_div_ref.prepend(data);
                    }
                    else {
                        $('#error_message').show();
                    }
                }
            });  
        }); 
        
    });
</script>
@endsection
