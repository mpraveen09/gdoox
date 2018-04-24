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
                <div class="item form-group">
                    {!! Form::label('email','Status:', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        "Congratulations! Your Payment is successful."
                    </div>
                </div>
            </div>
        </div>
@endsection
 
@section('footer_add_js_script')
    <script type="text/javascript"></script>
@endsection