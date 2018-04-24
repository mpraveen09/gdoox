@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
@endsection

@section('right_col_title_right')
@endsection

@section('header_add_js_script')        
@endsection

@section('right_col')

@if (Session::has('message'))
    <div class="alert alert-info">{!!  Session::get('message')  !!}</div>
@endif

@if (HTML::ul($errors->all()))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        {!! HTML::ul($errors->all()) !!}
    </div>
@endif

    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>Gdoox Commercial Plan Management - Plans by Country</h2>
            <button onclick="goBack()" class="btn btn-default waves-effect">Back</button>
        </div>
        <div class="card-body card-padding">    


            <table class="table">
                <tr>
                    <th>Subscription Plan Type</th>
                    <td>&nbsp;</td>
                    <td>{!! $Subscription_Types->label !!}</td>
                </tr>
                
                    @foreach( $SubscriptionPlanNames as $SubscriptionPlanName )                
                <tr>
                    <th>{!! $SubscriptionPlanName->label !!}</th>
                    <td>&nbsp;</td>
                    <td>
                        @if(isset($GdooxSubscriptionPlans[$SubscriptionPlanName->plan_id]))
                        {!! $GdooxSubscriptionPlans[$SubscriptionPlanName->plan_id] !!}
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>

            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button onclick="goBack()" class="btn btn-round btn-danger">Go Back</button>
                    
                    <a class="btn btn-round btn-primary" href="{!! route('plan_configuration_country.create', '_id='.$GdooxSubscriptionPlans->_id)!!}" >Edit</a>
                </div>
            </div>
            <br/>

            
         </div>
    </div>       
@endsection

@section('footer_add_js_files') 
@endsection       

@section('footer_add_js_script')

<script type="text/javascript">
function goBack() {
    window.history.back();
}
</script>

@endsection



