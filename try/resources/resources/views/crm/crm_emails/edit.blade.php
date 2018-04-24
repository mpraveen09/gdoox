@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('header_custom_css')
    <link href="{{ asset('/m-admin-ui/vendors/bower_components/summernote/dist/summernote.css') }}" rel="stylesheet">
@endsection

@section('right_col_title_left')
   <!--<h2>CRM</h2>-->
    <!--<div class="page-top-links">-->
   <!--</div>-->
@endsection

@section('right_col_title_right')
@endsection

@section('right_col')
    <!-- if there are creation errors, they will show here -->
    @if (HTML::ul($errors->all()))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!! HTML::ul($errors->all()) !!}
        </div>
    @endif
    
    @include('navigation_tabs.crm_tabs')
    
    <div class="card">
      <div class="card-header bgm-blue head-title">
          <h2>Draft</h2>
          <a href="{!! route('crm_emails.create')  !!}" class="btn  btn-default">Send New Email</a>
          <a href="{!! route('crm_emails.index')  !!}" class="btn  btn-default">View All</a>
       </div>
      <div class="card-body card-padding">

            {!! Form::open([
                'method' => 'PUT',
                'route' => ['crm_emails.update', $userdata->_id],
                'class' => 'form-horizontal form-label-left'
            ]) !!}

            {!! Form::hidden('status','',['class'=>'status']) !!}

            <div class="item form-group">
                  {!! Form::label('from', $form_fields->labels['from'], ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('from', $userdata->from, ['class' => 'form-control col-md-7 col-xs-12', 'readonly']) !!}
                </div>
            </div>


            <div class="item form-group">
                {!! Form::label('to', $form_fields->labels['to'], ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                 {!! Form::text('to', $userdata->to_email, ['class' => 'autocomplete_email form-control col-md-7 col-xs-12', 'required']) !!}
                </div>
            </div>
            
            <div class="item form-group">
                {!! Form::label('select','Select To', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select name="send_to" id="send_to" class="form-control col-md-7 col-xs-12">
                        <option value="">Select</option>
                        <option value="contacts">Contact(s)</option>
                        <option value="group">Group</option>
                    </select>
                </div>
            </div>
            
           
            <div class="item form-group" id="mail_text_box" style="display: none;">
                {!! Form::label('to', $form_fields->labels['to'], ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('to', '', ['class' => 'autocomplete_email form-control col-md-7 col-xs-12', 'required']) !!}
                </div>
            </div>

            
            <div class="item form-group" id="mail_groups" style="display: none;">
                {!! Form::label('to_group','Select Group', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                     {!! Form::select('to', $groups, '', ['id'=>'to','class' => 'form-control col-md-7 col-xs-12','placeholder'=>'Select Group']) !!}
                </div>
            </div>
            

            @if(!empty($userdata->cc))
                <div id="cc_div" class="item form-group">
                    {!! Form::label('add_cc', $form_fields->labels['cc'], ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('add_cc', $userdata->cc, ['class' => 'autocomplete_cc form-control col-md-7 col-xs-12', 'required']) !!}
                    </div>
                </div>
            @else
                <div id="cc_div" style="display: none;" class="item form-group">
                    {!! Form::label('add_cc', $form_fields->labels['cc'], ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('add_cc', $userdata->cc, ['class' => 'autocomplete_cc form-control col-md-7 col-xs-12', 'required']) !!}
                    </div>
                </div>
            @endif

            @if(!empty($userdata->bcc))
                <div id="bcc_div" class="item form-group">
                    {!! Form::label('add_bcc', $form_fields->labels['bcc'], ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('add_bcc', $userdata->bcc, ['class' => 'autocomplete_bcc form-control col-md-7 col-xs-12', 'required']) !!}
                    </div>
                </div>
            @else
                <div id="bcc_div" style="display: none;" class="item form-group">
                    {!! Form::label('add_bcc', $form_fields->labels['bcc'], ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('add_bcc', $userdata->bcc, ['class' => 'autocomplete_bcc form-control col-md-7 col-xs-12', 'required']) !!}
                    </div>
                </div>
            @endif


            @if(empty($userdata->cc))
                <div class="item form-group">
                    <div class="control-label col-md-3 col-sm-3 col-xs-12"></div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <a href="" value="cc" id="cc" onclick="addCC(); return false;">Add CC</a> &nbsp;&nbsp;
                    </div>
                </div>
            @endif

            @if(empty($userdata->bcc))
                <div class="item form-group">
                    <div class="control-label col-md-3 col-sm-3 col-xs-12"></div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <a href="" value="bcc" id="bcc" onclick="addBCC(); return false;">Add BCC</a> &nbsp;&nbsp;
                    </div>
                </div>
            @endif


            <div class='item form-group'>
                {!! Form::label('select_template',$form_fields->labels['select_template'], ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class='col-md-6 col-sm-6 col-xs-12'>
                    {!! Form::select('template', $template, $userdata->template, ['id'=>'template','class' => 'form-control col-md-7 col-xs-12']) !!}
                </div>
            </div>

<!--            <div class="item form-group">
                    {!! Form::label('variablecat', $form_fields->labels['insert_variable'], ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        {!! Form::select('variablecat', $variablecat, '', ['placeholder'=>$form_fields->labels['select'],'class' => 'form-control col-md-7 col-xs-12']) !!}
                    </div>

                    <div class="col-md-3 col-sm-3 col-xs-12">
                        {!! Form::select('variablename', $variablename, '', ['id'=>'variablename','class' => 'form-control col-md-7 col-xs-12']) !!}
                    </div>

                    <div class="col-md-3 col-sm-3 col-xs-12">
                        {!! Form::text('variablevalue','', ['id'=>'variablevalue','class' => 'form-control', 'required']) !!} 
                    </div>

                    <div class="col-md-1 col-sm-1 col-xs-12">
                        <button id="insert" type="button" onclick="insertVariable();" class="btn btn-primary btn-sm waves-effect">{!! $form_fields->labels['insert'] !!}</button>
                    </div>
             </div>-->

            <div class="form-group clearfix">
                {!! Form::label('content', $form_fields->labels['content'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                <div class="col-md-9 col-sm-9 col-xs-12">
                    {!! Form::hidden('content',$userdata->content, array('placeholder' =>'','class'=>'content form-control','id'=>'content')) !!}
                    <div class="html-editor"></div>
                </div>    
            </div>

            <div class="ln_solid"></div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                   <a href="{!! route('crm_emails.create')  !!}" type="submit" class="btn btn-round btn-primary">{!! $form_fields->labels['cancel'] !!}</a>
                   <button id="send" type="submit" onclick="sendEmail()" class="btn btn-round btn-success">{!! $form_fields->labels['send'] !!}</button>
                   <button id="send" type="submit" onclick="saveAsDraft()" class="btn btn-round btn-success">{!! $form_fields->labels['save_as_draft'] !!}</button>
                </div>
            </div>
        {!! Form::close() !!}
    </div>   
  </div>
@endsection

@section('footer_add_js_files') 
    <script src="{{ asset('/m-admin-ui/vendors/bower_components/summernote/dist/summernote.min.js') }}"></script>
@endsection

@section('footer_add_js_script')

<style>
    .ui-menu-item{
        width: 300px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;        
        font-size: 11px;
    }   
    .ui-widget-content{
        max-height: 400px;
        overflow: scroll;
    }
</style>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>


<script>
    $(document).ready(function(){        
        function splitValue( val ) {
            return val.split( /,\s*/ );
          }
          
        function extractLastValue( term ) {
            return splitValue(term).pop();
        }
        
        jQuery(function($) { 
            $(".autocomplete_email").autocomplete({
                source: function( request, response ) {  
                        $.ajax({
                            url: "{!! URL::route('search_email_id')  !!}",
                            dataType: "json",
                            data: {
                                    term: extractLastValue( request.term ),
                            },
                            success: function(json) {                     
                                response( $.map( json, function( item ) {
                                    return {
                                        label: item.name,
                                        value: item.email
                                    }
                                }));
                            }
                        });
                    },
                    autoFocus: true,
                    minLength: 3,
                    select: function( event, ui ) {
                        var terms = splitValue( this.value );
                        terms.pop();
                        terms.push( ui.item.value );
                        terms.push( "" );
                        this.value = terms.join( ", " );
                        return false;
                  } 
                });

            $(".autocomplete_cc").autocomplete({
            source: function( request, response ) {  
                    $.ajax({
                        url: "{!! URL::route('search_email_id')  !!}",
                        dataType: "json",
                        data: {
                                term: extractLastValue( request.term ),
                        },
                        success: function(json) {                     
                            response( $.map( json, function( item ) {
                                return {
                                    label: item.name,
                                    value: item.email
                                }
                            }));
                        }
                    });
                },
                autoFocus: true,
                minLength: 3,
                select: function( event, ui ) {
                    var terms = splitValue( this.value );
                    terms.pop();
                    terms.push( ui.item.value );
                    terms.push( "" );
                    this.value = terms.join( ", " );
                    return false;
              } 
            });

            $(".autocomplete_bcc").autocomplete({
            source: function( request, response ) {  
                    $.ajax({
                        url: "{!! URL::route('search_email_id')  !!}",
                        dataType: "json",
                        data: {
                                term: extractLastValue( request.term ),
                        },
                        success: function(json) {                     
                            response( $.map( json, function( item ) {
                                return {
                                    label: item.name,
                                    value: item.email
                                }
                            }));
                        }
                    });
                },
                autoFocus: true,
                minLength: 3,
                select: function( event, ui ) {
                    var terms = splitValue( this.value );
                    terms.pop();
                    terms.push( ui.item.value );
                    terms.push( "" );
                    this.value = terms.join( ", " );
                    return false;
              } 
            });
        });
        

        
        $("#template").change(function () {
            var template = $('#template option:selected').val();
            if(template==='')
            {
                $('.html-editor').code('');
            }
            else
            {
                $.ajax({
                    url: "{!! URL::route('select_template')  !!}",
                    data: {
                            template: template,
                    },
                    success: function(data) {
                        $('.html-editor').code(data);
                        $('.content').code(data);
                    }
                });
            }          
        });
    });
</script>    


<script>
function goBack() {
    window.history.back();
}

function addCC()
{
    $('#cc_div').show();
    $('#cc').hide();
}
function addBCC()
{
    $('#bcc_div').show();
    $('#bcc').hide();
}

function openPopUp()
{
    $('#divId').css('display','block');
    $('#divId').dialog();
}
function saveAsDraft(){
    var sHTML = $('.html-editor').code();
    $('.content').val(sHTML);
    $('.status').val('draft');
}
function sendEmail(){
    var sHTML = $('.html-editor').code();
    $('.content').val(sHTML);
    $('.status').val('send');
}

$(document).ready(function() {
    var editor_data= '<?php echo $userdata->content; ?>';
    $('.html-editor').code(editor_data);
});

</script>
<script>
    function insertVariable(){
    var value = $('#variablevalue').val();
    var editor_val= $('.html-editor').code();
    var data= editor_val+' '+value;
    $('.html-editor').code(data);
    return false;
 }
        
    $(document).ready(function() {
        $('.html-editor').code($('#body').val());

        $("#variablecat").change(function () {
            var variable_cat = $('#variablecat option:selected').val();
        
            if(variable_cat==='')
            {
                $('#variablename').html("");
                $('#variablevalue').html("");
            }
            else
            {
            $.ajax({
                url: "{!! URL::route('get_variable_values')  !!}",
                dataType: "json",
                data: {
                        variable_cat: variable_cat,
                },
                success: function(json) {
                 // alert(JSON.stringify(json));
                    var options = [];
                    
                    $('#variablename').html("");
                    $('#variablevalue').html("");
                    
                    options.push('<option>Select</option>')
                        $.each(json, function(i, item) {
                        options.push($('<option/>', 
                            {
                                value: item.key, text: item.value 
                            }));
                        });
                    $('#variablename').append(options);
                }
            });
        }          
    });
    
        $('#variablename').change(function(){
        var value = $('#variablename option:selected').val();
        var variable= ' [$'+value+']';
        $('#variablevalue').val(variable);
    });
});
</script>
@endsection



