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

    
    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>Accounts</h2>
            <a href="{!! route('crm_accounts.create')  !!}" class="btn  btn-default">Create New</a>
            <a href="{!! route('crm_accounts.edit',$userdata->_id)  !!}" class="btn  btn-default">Edit</a>
            <a href="{!! route('crm_accounts.index')  !!}" class="btn  btn-default">View All</a>
        </div><!-- .card-header -->
        <div class="card-body card-padding">    
              <table class="table">
                  <tbody>
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['name']['label']))
                                  {!! $form_fields['form_fields']['name']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->name !!} </td>
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
                                @if(!empty($form_fields['form_fields']['website']['label']))
                                  {!! $form_fields['form_fields']['website']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->website !!} </td>
                        </tr>
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['fax']['label']))
                                  {!! $form_fields['form_fields']['fax']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->fax !!} </td>
                        </tr>
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['billing_street']['label']))
                                  {!! $form_fields['form_fields']['billing_street']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->billing_street !!} </td>
                        </tr>
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['billing_city']['label']))
                                  {!! $form_fields['form_fields']['billing_city']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->billing_city !!} </td>
                        </tr>
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['billing_state']['label']))
                                  {!! $form_fields['form_fields']['billing_state']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->billing_state !!} </td>
                        </tr>
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['billing_postalcode']['label']))
                                  {!! $form_fields['form_fields']['billing_postalcode']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->billing_postalcode !!} </td>
                        </tr>
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['billing_country']['label']))
                                  {!! $form_fields['form_fields']['billing_country']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->billing_country !!} </td>
                        </tr>
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['shipping_street']['label']))
                                  {!! $form_fields['form_fields']['shipping_street']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->shipping_street !!} </td>
                        </tr>
                         
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['shipping_city']['label']))
                                  {!! $form_fields['form_fields']['shipping_city']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->shipping_city !!} </td>
                        </tr>
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['shipping_state']['label']))
                                  {!! $form_fields['form_fields']['shipping_state']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->shipping_state !!} </td>
                        </tr>
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['shipping_postalcode']['label']))
                                  {!! $form_fields['form_fields']['shipping_postalcode']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->shipping_postalcode !!} </td>
                        </tr>
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['shipping_country']['label']))
                                  {!! $form_fields['form_fields']['shipping_country']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->shipping_country !!} </td>
                        </tr>
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['type']['label']))
                                  {!! $form_fields['form_fields']['type']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->type !!} </td>
                        </tr>
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['industry']['label']))
                                  {!! $form_fields['form_fields']['industry']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->industry !!} </td>
                        </tr>
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['annual_revenue']['label']))
                                  {!! $form_fields['form_fields']['annual_revenue']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->annual_revenue !!} </td>
                        </tr>
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['employees']['label']))
                                  {!! $form_fields['form_fields']['employees']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->employees !!} </td>
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


