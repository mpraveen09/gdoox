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

    <!-- will be used to show any messages -->
    @if (Session::has('message'))
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!!  Session::get('message')  !!}
        </div>
    @endif

    @include('navigation_tabs.crm_tabs')
    
    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>Task</h2>
            <a href="{!! route('tasks.create')  !!}" class="btn  btn-default">Create New</a>
            <a href="{!! route('tasks.edit',$userdata->_id)  !!}" class="btn  btn-default">Edit</a>
            <a href="{!! route('tasks.index')  !!}" class="btn  btn-default">View All</a>
        </div><!-- .card-header -->
        <div class="card-body card-padding">    
              <table class="table">
                  <tbody>
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['subject']['label']))
                                  {!! $form_fields['form_fields']['subject']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->subject !!} </td>
                        </tr>
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['start_date']['label']))
                                  {!! $form_fields['form_fields']['start_date']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->start_date !!} </td>
                        </tr>
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['due_date']['label']))
                                  {!! $form_fields['form_fields']['due_date']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->due_date !!} </td>
                        </tr>
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['priority']['label']))
                                  {!! $form_fields['form_fields']['priority']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->priority !!} </td>
                        </tr>
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['status']['label']))
                                  {!! $form_fields['form_fields']['status']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->status !!} </td>
                        </tr>
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['related_to']['label']))
                                  {!! $form_fields['form_fields']['related_to']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->related_to !!} </td>
                        </tr>
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['assigned_to']['label']))
                                  {!! $form_fields['form_fields']['assigned_to']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->assigned_to_name !!} </td>
                        </tr>
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['description']['label']))
                                  {!! $form_fields['form_fields']['description']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->description !!} </td>
                        </tr>
                  </tbody>
              </table>
        </div>
    </div>
@endsection

@section('footer_add_js_script')
<script>
function goBack() {
    window.history.back();
}
</script>
@endsection


