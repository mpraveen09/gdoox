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
                <h2>{!! $form_fields->labels['edit_template'] !!}</h2>
                <a href="{!! route('crm_templates.create')  !!}" class="btn  btn-default">Create New</a>
                <a href="{!! route('crm_templates.index')  !!}" class="btn  btn-default">View All</a>
         </div>
      <!-- .card-header -->
         <div class="card-body card-padding"> 
            {!! Form::open([
                    'method' => 'PUT',
                    'route' => ['crm_templates.update',$id],
                    'class' => 'form-horizontal form-label-left'
                ]) !!}
                    
                    <div class="item form-group">
                         {!! Form::label('template_name', $form_fields->labels['template_name'], ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('template_name', $templates->template_name, ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>
            
                    <div class='item form-group'>
                        {!! Form::label('type',$form_fields->labels['type'], ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                            {!! Form::select('type', $type, $templates->type, ['class' => 'form-control col-md-7 col-xs-12'], 'required') !!}
                        </div>
                    </div>
            
                    <div class='item form-group'>
                        {!! Form::label('assigned_to',$form_fields->labels['assigned_to'], ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                            {!! Form::select('assigned_to', $assignedto, $templates->assigned_to, ['class' => 'form-control col-md-7 col-xs-12'], 'required') !!}
                        </div>
                    </div>
            
                    <div class="item form-group">
                         {!! Form::label('description', $form_fields->labels['description'], ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('description', $templates->description, ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>
            
                    <div class="item form-group">
                        {!! Form::label('subject', $form_fields->labels['subject'], ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('subject', $templates->subject, ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>
            
                    <div class="item form-group">
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
                    </div>
            
                    <div class="form-group clearfix">
                        {!! Form::label('body', $form_fields->labels['body'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            {!! Form::hidden('body', $templates->body, array('placeholder' =>'','class'=>'form-control','id'=>'body')) !!}
                            <div class="html-editor"></div>
                        </div>    
                    </div>

                    <div class="ln_solid"></div>
                    
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-5">
                            <!--<a href="{!! route('crm_templates.index')  !!}" type="submit" class="btn btn-round btn-primary">{!! $form_fields->labels['cancel'] !!}</a>-->
                            <button id="send" type="submit" onclick="sendEmail()" class="btn btn-round btn-success">{!! $form_fields->labels['save'] !!}</button>
                        </div>
                    </div>
                    
                    
                    <div class="ln_solid"></div>
                    
         {!! Form::close() !!}
         </div>
    </div>

@endsection

@section('footer_add_js_files') 
    <script src="{{ asset('/m-admin-ui/vendors/bower_components/summernote/dist/summernote.min.js') }}"></script>
@endsection

@section('footer_add_js_script')
<script>
    function goBack() {
        window.history.back();
        }
    
    function sendEmail(){
        var sHTML = $('.html-editor').code();
        $('.content').val(sHTML);
        $('.status').val('send');
       }
   
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


