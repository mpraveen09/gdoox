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
      <a href="{!! route('crm_emails.create')  !!}" class="btn  btn-default">Create Draft</a>
      <a href="{!! route('crm_emails.index')  !!}" class="btn  btn-default">View All</a>
      <button class="btn btn-info waves-effect" onclick="goBack()">Go Back</button>
    </div>
    @if(!$sent_emails->count())
    <div class="card">
        <div class="card-body">
            <div class="alert alert-warning alert-dismissible" role="alert">
                There are no Emails in Drafts.
            </div>  
        </div>
    </div>     
    @else
    <div class="row">
        <div class="text-right col-md-12">
             {!! $sent_emails->render() !!}
        </div>
    </div>
    <div class="card-body card-padding">
        <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
            <table class="table table-striped responsive-utilities jambo_table ">
                <thead>
                     <th>{!! $form_fields->labels['email_id'] !!}</th>
                     <th>{!! $form_fields->labels['cc'] !!}</th>
                     <th>{!! $form_fields->labels['bcc'] !!}</th>
                     <th>{!! $form_fields->labels['date'] !!} </th>
                     <th>{!! $form_fields->labels['action'] !!}</th>
                </thead>

                <tbody>
                    @foreach($sent_emails as $email)
                     <tr>
                            <td>
                                <?php
                                    if(!empty($email->to_email)){
                                      if(strpos($email->to_email, ',')){
                                            $to_email = explode(",",$email->to_email);
                                            $length_to= sizeof($to_email);
                                            for($i=0; $i < $length_to-1; $i++){
                                                echo $to_email[$i]; echo "<br>";
                                            }
                                      }
                                    }
                                    else{
                                        echo "---";
                                    }
                                ?>
                            </td>

                            <td>
                                <?php
                                    if(!empty($email->cc)){
                                      if(strpos($email->cc, ',')){
                                            $to_cc = explode(",",$email->cc);
                                            $length_to= sizeof($to_cc);
                                            for($i=0; $i < $length_to-1; $i++){
                                                echo $to_cc[$i]; echo "<br>";
                                            }
                                      }
                                    }
                                    else{
                                        echo "---";
                                    }
                                ?>
                            </td>

                            <td>
                                <?php
                                    if(!empty($email->bcc)){
                                      if(strpos($email->bcc, ',')){
                                            $to_bcc = explode(",",$email->bcc);
                                            $length_to= sizeof($to_bcc);
                                            for($i=0; $i < $length_to-1; $i++){
                                                echo $to_bcc[$i]; echo "<br>";
                                            }
                                      }
                                    }
                                    else{
                                        echo "---";
                                    }
                                ?>  
                            </td>



                          <td>{!! $email->created_at !!}</td>

                          <td>
                              <a href="{!! route('crm_emails.show', $email->_id)  !!}">
                                 <i class='zmdi zmdi-eye zmdi-hc-fw'></i>
                              </a>&nbsp;
                              <a href="{!! route('crm_emails.edit', $email->_id)  !!}">
                                 <i class='zmdi zmdi-edit zmdi-hc-fw'></i>
                              </a>
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