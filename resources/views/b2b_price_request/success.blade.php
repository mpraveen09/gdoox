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
        <div class="alert alert-info">{!!  Session::get('message')  !!}</div>
    @endif
    <!-- if there are creation errors, they will show here -->
    @if (HTML::ul($errors->all()))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!! HTML::ul($errors->all()) !!}
        </div>
    @endif

    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>Success</h2>
            <a href="{!! route('dashboard-index') !!}" type="submit" class="btn btn-default"><i class='zmdi zmdi-home'></i></a>
        </div><!-- .card-header -->
        <div class="card-body card-padding">
            <div class="form-group clearfix">
                <div>Request Sent Successfully</div>
            </div>
        </div>
     </div>
@endsection

@section('footer_add_js_script')

<script>

</script>
@endsection


