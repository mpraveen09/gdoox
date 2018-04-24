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
            <h2>Opportunities</h2>
            <a href="{!! route('crm_opportunities.create')  !!}" class="btn  btn-default">Create New</a>
            <a href="{!! route('crm_opportunities.edit',$userdata->_id)  !!}" class="btn  btn-default">Edit</a>
            <a href="{!! route('crm_opportunities.index')  !!}" class="btn  btn-default">View All</a>
        </div><!-- .card-header -->
        <div class="card-body card-padding">    
              <table class="table">
                  <tbody>
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['opportunity_name']['label']))
                                  {!! $form_fields['form_fields']['opportunity_name']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->opportunity_name !!} </td>
                        </tr>
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['account_name']['label']))
                                  {!! $form_fields['form_fields']['account_name']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->account_name !!} </td>
                        </tr>
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['currency']['label']))
                                  {!! $form_fields['form_fields']['currency']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->currency !!} </td>
                        </tr>
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['excected_closing_date']['label']))
                                  {!! $form_fields['form_fields']['excected_closing_date']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->excected_closing_date !!} </td>
                        </tr>
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['opportunity_amt']['label']))
                                  {!! $form_fields['form_fields']['opportunity_amt']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->opportunity_amt !!} </td>
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
                                @if(!empty($form_fields['form_fields']['sales_stage']['label']))
                                  {!! $form_fields['form_fields']['sales_stage']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->sales_stage !!} </td>
                        </tr>
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['lead_source']['label']))
                                  {!! $form_fields['form_fields']['lead_source']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->lead_source !!} </td>
                        </tr>
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['probability']['label']))
                                  {!! $form_fields['form_fields']['probability']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->probability !!} </td>
                        </tr>
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['campaign']['label']))
                                  {!! $form_fields['form_fields']['campaign']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->campaign !!} </td>
                        </tr>
                         
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['next_step']['label']))
                                  {!! $form_fields['form_fields']['next_step']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->next_step !!} </td>
                        </tr>
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields['form_fields']['discussion']['label']))
                                  {!! $form_fields['form_fields']['discussion']['label'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->discussion !!} </td>
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


