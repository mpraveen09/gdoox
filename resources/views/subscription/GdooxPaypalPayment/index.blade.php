@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <!--<h2>Distribution Network</h2>-->
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
            <h2>Gdoox Subscription Payment - PayPal Info</h2>
            
            <button onclick="goBack()" class="btn btn-default waves-effect">Back</button>
        </div><!-- .card-header -->
        @if (!$paypalinfo->count())
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                There is no info found regarding PayPal, please contact Dev Team.
            </div>                 
        @else
            <div class="card">
                <div class="card-body card-padding">
                    <div class="text-right col-md-12">
                                 
                    </div>
                    <table class="table">
                        <thead>
                            <th>Fields</th>
                            <th>Info</th>
                        </thead>
                        <tr><td>Method</td><td>{!!  $paypalinfo->method !!}</td></tr>
                        <tr><td>Owner</td><td>{!!  $paypalinfo->owner !!}</td></tr>
                        <tr><td>PayPal Name</td><td>{!!  $paypalinfo->paypal_name !!}</td></tr>
                        <tr><td>PayPal ID/Email</td><td>{!!  $paypalinfo->paypal_id !!}</td></tr>                             
                        <tr>                                
                            <td></td><td><a class="btn btn-default" href="{!! route('gdoox-paypal.edit', $paypalinfo->_id)  !!}">Edit</a> &nbsp;</td>
                        </tr>  
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('footer_add_js_script')
<script>
function goBack() {
    window.history.back();
}
</script>
@endsection