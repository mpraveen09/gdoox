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

@if (Session::has('message'))
    <div class="alert alert-info alert-dismissible" role="alert">
        {!!  Session::get('message')  !!}
    </div>
@endif

@include('navigation_tabs.crm_tabs')

<div class="card">
  <div class="card-header bgm-blue head-title">
    <h2>{!! $form_fields->labels['emails'] !!}</h2>
      <a href="{!! route('crm_emails.create')  !!}" class="btn  btn-default">Send New Email</a>
      <a href="{!! route('crm_emails.index')  !!}" class="btn  btn-default">View All</a>
  </div>
    @if(!$sent_emails->count())
        <div class="card">
            <div class="card-body">
                <div class="alert alert-warning alert-dismissible" role="alert">
                    You have sent no Emails.
                </div>  
            </div>
        </div>     
    @else
        <div class="row">
            <div class="text-right col-md-12">{!! $sent_emails->render() !!}</div>
        </div>
        <div class="card-body card-padding">  
            <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                <table class="table table-striped responsive-utilities jambo_table ">
                    <thead>
                         <th>{!! $form_fields->labels['email_id'] !!}/ {!! $form_fields->labels['group'] !!}</th>
                         <th>{!! $form_fields->labels['cc'] !!}</th>
                         <th>{!! $form_fields->labels['bcc'] !!}</th>
                         <th>{!! $form_fields->labels['date'] !!} </th>
                         <th>{!! $form_fields->labels['action'] !!}</th>
                    </thead>

                    <tbody>
                        @foreach($sent_emails as $email)
                         <tr>
                              <td>
                                  @if(!empty($email->group))
                                        <a href="{!! route('group_contacts',['group'=>$email->group]) !!}">{!! $email->group !!}</a>  
                                  @else
                                        @foreach($email->to_email as $val)
                                            {!! $val !!} <br>
                                        @endforeach
                                  @endif
                              </td>
                              <td>
                                  @if(!empty($email->cc))
                                    @foreach($email->cc as $cc)
                                      {!! $val !!} <br>
                                    @endforeach
                                  @else
                                    ---
                                  @endif
                              </td>
                              <td>
                                  @if(!empty($email->bcc))
                                    @foreach($email->bcc as $bcc)
                                      {!! $val !!} <br>
                                    @endforeach
                                    @else
                                    ---
                                  @endif
                              </td>
                              <td>{!! $email->created_at !!}</td>
                              <td>
                                  <a href="{!! route('crm_emails.show', $email->_id)  !!}">
                                     <i class='zmdi zmdi-eye zmdi-hc-fw'></i>
                                  </a> &nbsp;
                              </td>
                          </tr>
                         @endforeach
                    </tbody>  
                </table>
          </div>
       </div>
        <div class="row">
          <div class="text-right col-md-12">
               {!! $sent_emails->render() !!}
          </div>
        </div>
    @endif   
</div>                       
@endsection
 
@section('footer_add_js_script')
<script type="text/javascript">
    function goBack() {
        window.history.back();
    }
</script>
@endsection