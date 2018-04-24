@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <h2></h2>
@endsection

@section('right_col_title_right')
@endsection

@section('right_col')
    @if (Session::has('message'))
        <div class="alert alert-info alert-dismissible" role="alert">
            {!!  Session::get('message')  !!}
        </div>
    @endif
 
    <div class="card">
        <div class="card-header bgm-blue"><h2>CRM</h2></div>               
        <div class="card-body card-padding">
            <p class="f-500 c-black m-b-20">The CRM Beta Version is Under Testing. Will be upgraded very soon.</p>
            <br>
            <br>
        </div>
    </div>
@endsection
 
@section('footer_add_js_script')
    <script type="text/javascript"></script>
@endsection