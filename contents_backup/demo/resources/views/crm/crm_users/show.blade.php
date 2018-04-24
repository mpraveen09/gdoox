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
        <div class="card-header bgm-blue head-title head-title">
            <h2>
                User Information
            </h2>
          <a href="{!! route('crm_users.create')  !!}" class="btn  btn-default">Create New</a>
          <a href="{!! route('crm_users.edit',$userdata->_id)  !!}" class="btn  btn-default">Edit</a>
          <a href="{!! route('crm_users.index')  !!}" class="btn  btn-default">View All</a>
        </div><!-- .card-header -->
        <div class="card-body card-padding">    
              <table class="table">
                  <tbody>
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['first_name']['label']))
                                  {!! $form_fields['form_fields']['first_name']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->first_name !!} </td>
                        </tr>
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['last_name']['label']))
                                  {!! $form_fields['form_fields']['last_name']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->last_name !!} </td>
                        </tr>
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['user_name']['label']))
                                  {!! $form_fields['form_fields']['user_name']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->user_name !!} </td>
                        </tr>
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['company_name']['label']))
                                  {!! $form_fields['form_fields']['company_name']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->company_name !!} </td>
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
                                @if(!empty($form_fields['form_fields']['is_admin']['label']))
                                  {!! $form_fields['form_fields']['is_admin']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->is_admin !!} </td>
                        </tr>
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['title']['label']))
                                  {!! $form_fields['form_fields']['title']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->title !!} </td>
                        </tr>
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['user_group']['label']))
                                  {!! $form_fields['form_fields']['user_group']['label'] !!}
                                @endif
                            </td>
                            <td> 
                                @foreach($userdata->user_group as $key=>$val)
                                    {!! $val  !!}
                                    <br> 
                                @endforeach
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['department']['label']))
                                  {!! $form_fields['form_fields']['department']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->department !!} </td>
                        </tr>
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['phone']['label']))
                                  {!! $form_fields['form_fields']['phone']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->phone !!} </td>
                        </tr>
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['address']['label']))
                                  {!! $form_fields['form_fields']['address']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->address !!} </td>
                        </tr>
                         
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['email_address']['label']))
                                  {!! $form_fields['form_fields']['email_address']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->email_address !!} </td>
                        </tr>
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['city']['label']))
                                  {!! $form_fields['form_fields']['city']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->city !!} </td>
                        </tr>
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['state']['label']))
                                  {!! $form_fields['form_fields']['state']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->state !!} </td>
                        </tr>
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['postal_code']['label']))
                                  {!! $form_fields['form_fields']['postal_code']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->postal_code !!} </td>
                        </tr>
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['country']['label']))
                                  {!! $form_fields['form_fields']['country']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->country !!} </td>
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


