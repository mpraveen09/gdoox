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
            <div class="card-header bgm-cyan ">
                <h2>Payment  Status</h2>
            </div>

            <div class="card-body card-padding">
				<h4>Sorry! There is an issue processing your payment. Please try again. <a href="{!! route('account-payment.create') !!}">Make Payment Again</a></h4>>
            </div>
        </div>
@endsection
 
@section('footer_add_js_script')
    <script type="text/javascript"></script>
@endsection