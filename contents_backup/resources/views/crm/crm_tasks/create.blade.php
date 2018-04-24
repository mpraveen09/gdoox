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
                <h2>Create Task</h2>
                <a href="{!! route('tasks.index')  !!}" class="btn  btn-default">View All</a>
            </div><!-- .card-header -->
                {!! Form::open([
                    'method' => 'POST',
                    'route' => 'tasks.store',
                    'class' => 'form-horizontal form-label-left'
                ]) !!}
                
                    <div class="card-body card-padding">
                         <div class="item form-group">
                             {!! Form::hidden('assigned_to_name',null,array('id'=>'assigned_to_name')) !!}
                         </div>  
                        
                        <div class="item form-group">
                            <label for="Subject" class="control-label col-md-3 col-sm-3 col-xs-12">Subject</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::text('subject',null,array('id'=>'subject','required','class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Subject','aria-required','true')) !!}
                            </div>
                        </div>
                        
                        <div class="item form-group">
                            <label for="Start Date" class="control-label col-md-3 col-sm-3 col-xs-12">Start Date</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::date('start_date', null, ['class' => 'form-control col-md-7 col-xs-12', 'placeholder' => 'Start Date']); !!}
                            </div>
                        </div>
                        
                        <div class="item form-group">
                            <label for="Due Date" class="control-label col-md-3 col-sm-3 col-xs-12">Due Date</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::date('due_date', null, ['class' => 'form-control col-md-7 col-xs-12', 'placeholder' => 'Due Date']); !!}
                            </div>
                        </div>
                        
                        <div class="item form-group">
                            <label for="Priority" class="control-label col-md-3 col-sm-3 col-xs-12">Priority</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::select('priority', $priority, null, ['required','class' => 'form-control col-md-7 col-xs-12', 'placeholder' => 'Select Priority']) !!}
                            </div>
                        </div>
                        
                        <div class="item form-group">
                            <label for="Status" class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::select('status', $status, null, ['required','class' => 'form-control col-md-7 col-xs-12', 'placeholder' => 'Select Status']) !!}
                            </div>
                        </div>
                        
                        <div class="item form-group">
                            <label for="Action" class="control-label col-md-3 col-sm-3 col-xs-12">Action</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::select('action', $action, null, ['required','class' => 'form-control col-md-7 col-xs-12', 'placeholder' => 'Select Action']) !!}
                            </div>
                        </div>
                        
                        <div class="item form-group">
                            <label for="Assigned To" class="control-label col-md-3 col-sm-3 col-xs-12">Assigned To</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::select('assigned_to', $assigned, null, ['id'=>'assigned_to','required','class' => 'form-control col-md-7 col-xs-12', 'placeholder' => 'Assigned To']) !!}
                            </div>
                        </div>
                        
                        <div class="item form-group">
                            <label for="Description" class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::textarea('description',null, array('cols'=>'50','rows'=>'10','id'=>'description','class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Description')) !!}
                            </div>
                        </div>
                        
                        <div class="ln_solid"></div>  
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-5">
                                <a href="{!! route('tasks.index')  !!}" type="submit" class="btn btn-round btn-primary">Cancel</a>
                                <button id="send" type="submit" class="btn btn-round btn-success">Save</button>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                    </div>
                </div>
            {!! Form::close() !!}
       </div>
@endsection

@section('footer_add_js_script')
<script type="text/javascript">
    $(document).ready(function(){
        $("#assigned_to").change(function(){
            var assigned_to_name= $(this).find('option:selected').text();
            $('#assigned_to_name').val(assigned_to_name);
        });
    });
</script>
<script>
    function goBack() {
        window.history.back();
    }
</script>
@endsection



