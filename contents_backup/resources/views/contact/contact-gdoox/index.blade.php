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

@include('navigation_tabs.general_tabs')

<div class="card">
  <div class="card-header bgm-blue head-title">
    <h2>Messages to Gdoox</h2>
  </div>
    @if(!$messages->count())
        <div class="card">
            <div class="card-body">
                <div class="alert alert-warning alert-dismissible" role="alert">
                    There are no Messages
                </div>  
            </div>
        </div>     
    @else
        <div class="row">
            <div class="text-right col-md-12">
                 {!! $messages->render() !!}
            </div>
        </div>
    
        <div class="card-body card-padding">  
            <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                <table class="table table-striped responsive-utilities jambo_table ">
                    <thead>
                         <th>Username</th>
                         <th>Subject</th>
                         <th>Date</th>
                         <th>Action</th>
                    </thead>

                    <tbody>
                        @foreach($messages as $message)
                             <tr>
                                <td>{!! $message->user_name !!}</td>
                                <td>{!! $message->subject !!}</td>
                                <td>{!! $message->created_at !!}</td>
                                <th>
                                    <a href="{!! route('contact-gdoox-show', $message->_id)  !!}">View</a> &nbsp;
                                </th>
                             </tr>
                         @endforeach
                    </tbody>  
                </table>
          </div>
       </div>
        <div class="row">
            <div class="text-right col-md-12">
                 {!! $messages->render() !!}
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