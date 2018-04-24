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
            <h2>Email</h2>
            <a href="{!! route('crm_emails.create')  !!}" class="btn  btn-default">Send New Email</a>
            <a href="{!! route('crm_emails.index')  !!}" class="btn  btn-default">View All</a>
        </div><!-- .card-header -->
        <div class="card-body card-padding">    
              <table class="table">
                  <tbody>
                        <tr>
                            <td>
                                @if(!empty($form_fields->labels['email_id']))
                                  {!! $form_fields->labels['email_id'] !!}
                                @endif
                            </td>
                            <td>
                                @if(is_array($userdata->to_email))
                                    @foreach($userdata->to_email as $value)
                                        {!! $value !!} <br />
                                    @endforeach
                                @else
                                    {!! $userdata->to_email !!} 
                                @endif
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields->labels['date']))
                                  {!! $form_fields->labels['date'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->created_at !!} </td>
                        </tr>
                        
                        <tr>
                            <td>
                                @if(!empty($form_fields->labels['content']))
                                  {!! $form_fields->labels['content'] !!}
                                @endif
                            </td>
                            <td> {!! $userdata->content !!} </td>
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


