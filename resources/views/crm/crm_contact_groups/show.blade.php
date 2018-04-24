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
        <div class="card-header bgm-blue">
                <h2>Contact Group</h2>
                <a href="{!! route('crm_contactsgroup.create')  !!}" class="btn  btn-default">Create New</a>
                <a href="{!! route('crm_contactsgroup.edit',$userdata->_id)  !!}" class="btn  btn-default">Edit</a>
                <a href="{!! route('crm_contactsgroup.index')  !!}" class="btn  btn-default">View All</a>
        </div><!-- .card-header -->
        <div class="card-body card-padding">    
              <table class="table">
                  <tbody>
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['group_name']['label']))
                                  {!! $form_fields['form_fields']['group_name']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->group_name !!} </td>
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


