@extends('layout.backend.masterchatbase')
@section('maincontent')

    <div class="card">
        <div class="block-header">
            <h2>Chat Archive</h2>
        </div>
        
        <div class="card m-b-0" id="messages-main">
            <div class="ms-body" style="overflow: scroll; height: 400px;width: 100%;">
                <div class="form-group clearfix">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">From Date:</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="date" class="form-control" required="required" name="from_date" id="from_date"/>
                    </div>    
                </div>

                <div class="form-group clearfix">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">From Date:</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="date" class="form-control" required="required" name="to_date" id="to_date"/>
                    </div>    
                </div>

                <div class="form-group clearfix">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="button" class="" id="search_chat_archive" name="search_chat_archive" value="Search"/>
                    </div>    
                </div>
                <div class="listview lv-message">
                    <div class="lv-body" id="message-body"></div>
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
        
        $('#search_chat_archive').click(function() {
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            var chat_id = $('#chat_id').val();
            
            $.ajax({
                url: "{!! URL::route('searchchatarchive') !!}",
                data: {
                    from_date : from_date,
                    to_date : to_date,
                    chat_id : chat_id                 
                },
                success: function(data) {
                    if(data !== 'error'){
                        $('#message-body').html('');
                        $('#message-body').html(data);
                    }
                    else {
                        $('#error_message').show();
                    }
                }
            });
          return false;            
        });  
    });
</script>
@endsection
