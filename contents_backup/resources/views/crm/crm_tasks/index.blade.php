@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--    <h2>CRM</h2>-->
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
            <h2>Search Tasks</h2>
        </div><!-- .card-header -->
        
        {!! Form::open([
            'method' => 'POST',
            'route' => 'tasks.search_task',
            'class' => 'form-horizontal form-label-left'
        ]) !!}

            <div class="card-body card-padding">
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Search By Subject</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('subject',$subject_val,['placeholder'=>'Subject','id'=>'subject','class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Search By User</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::select('assigned',$assigned, $assigned_val, ['placeholder'=>'Assigned To','id'=>'template','class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Search By Date:</label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        {!! Form::date('from_date',$frm_date_val,['placeholder'=>'From Date','class' => 'form-control']) !!}
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        {!! Form::date('to_date',$to_date_val, ['placeholder'=>'To Date','class' => 'form-control']) !!}
                    </div>
                </div>


                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Search By Priority:</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::select('priority',$priority, $priority_val, ['placeholder'=>'Select Priority','id'=>'priority','class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Search By Status:</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::select('status',$status,$status_val, ['placeholder'=>'Select Status','id'=>'priority','class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-5">
                        <a href="{!! route('tasks.index')  !!}" type="submit" class="btn btn-round btn-primary">Cancel</a>
                        <button id="send" type="submit" class="btn btn-round btn-success">Search</button>
                    </div>
                </div> 
                <div class="ln_solid"></div>
            </div>
        {!! Form::close() !!}
    </div>


    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>Tasks</h2>
            <a href="{!! route('tasks.create')  !!}" class="btn  btn-default">Create New</a>
        </div>
        @if(!$tasks->count())
            <div class="card">
                <div class="card-body">
                    <div class="alert alert-warning alert-dismissible" role="alert">
                         There Are No Tasks
                    </div>
                </div>
            </div>              
        @else
            <div class="row">
                <div class="text-right col-md-12">
                     {!! $tasks->render() !!}
                </div>
            </div>
            <div class="card-body card-padding">
                <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                    <table class="table table-striped responsive-utilities jambo_table ">
                        <thead>
                            <th>
                                @if(!empty($form_fields['form_fields']['subject']['label']))
                                    {!! $form_fields['form_fields']['subject']['label'] !!}
                                @endif
                            </th>
                            <th>
                                @if(!empty($form_fields['form_fields']['start_date']['label']))
                                  {!! $form_fields['form_fields']['start_date']['label'] !!}
                                @endif
                            </th>
                            <th>
                                @if(!empty($form_fields['form_fields']['due_date']['label']))
                                  {!! $form_fields['form_fields']['due_date']['label'] !!}
                                @endif
                            </th>
                            <th>
                                @if(!empty($form_fields['form_fields']['related_to']['label']))
                                  {!! $form_fields['form_fields']['related_to']['label'] !!}
                                @endif
                            </th>
                            <th>
                                @if(!empty($form_fields['form_fields']['priority']['label']))
                                  {!! $form_fields['form_fields']['priority']['label'] !!}
                                @endif
                            </th>
                            <th>
                                @if(!empty($form_fields['form_fields']['status']['label']))
                                  {!! $form_fields['form_fields']['status']['label'] !!}
                                @endif
                            </th>
                            <th>
                                @if(!empty($form_fields['form_fields']['assigned_to']['label']))
                                  {!! $form_fields['form_fields']['assigned_to']['label'] !!}
                                @endif   
                            </th>
                            <th>
                                Action
                            </th>
                         </thead>
                         <tbody>
                            @foreach($tasks as $task)
                               <tr>
                                    <td>{!! $task->subject !!}</td>
                                    <td>{!! $task->start_date !!}</td>
                                    <td>{!! $task->due_date !!}</td>
                                    <td>{!! $task->action !!}</td>
                                    <td>{!! $task->priority !!}</td>
                                    <td>{!! $task->status !!}</td>
                                    <td>{!! $task->assigned_to_name !!}</td>
                                    <td>
                                        <a href="{!! route('tasks.show', $task->_id)  !!}"><i class='zmdi zmdi-eye zmdi-hc-fw'></i></a> &nbsp; 
                                        <a href="{!! route('tasks.edit', $task->_id)  !!}"><i class='zmdi zmdi-edit zmdi-hc-fw'></i></a>
                                    </td>
                                </tr>
                             @endforeach
                         </tbody>  
                     </table>
              </div>
           </div>
            <div class="row">
                <div class="text-right col-md-12">
                     {!! $tasks->render() !!}
                </div>
            </div>
        @endif   
    </div>
@endsection
 
@section('footer_add_js_script')
<script>
    function goBack() {
        window.history.back();
    }
</script>
@endsection