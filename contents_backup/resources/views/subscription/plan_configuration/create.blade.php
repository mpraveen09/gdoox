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
            <h2>Gdoox Commercial Plan Management - Default Plans</h2>
            <button onclick="goBack()" class="btn btn-default waves-effect">Back</button>
        </div>
        <div class="card-body card-padding">    


            {!! Form::open([
                'method' => 'POST',
                'route' => 'plan_configuration.store',
                'class' => 'form-horizontal form-label-left'
            ]) !!}

        <div class="form-group clearfix">
            {!! Form::label('plan_fields[subscriptiontype]','Subscription Plan Type', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
            <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::select('plan_fields[subscriptiontype]', $SubscriptionTypes, $GdooxSubscriptionPlans->subscriptiontype, array('required', 'placeholder' => $GdooxSubscriptionPlans->subscriptiontype, 'class'=>'form-control')) !!}
            </div>    
        </div>
            
        @foreach( $SubscriptionPlanNames as $SubscriptionPlanName )
            <div class="form-group clearfix">
                {!! Form::label('plan_fields['. $SubscriptionPlanName->plan_id .']', $SubscriptionPlanName->label, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                <div class="col-md-6 col-sm-6 col-xs-12">
            @if($SubscriptionPlanName->type === 'bool')
                {!! Form::select('plan_fields['. $SubscriptionPlanName->plan_id .']', ['Yes'=>'Yes','No'=>'No'], $GdooxSubscriptionPlans[$SubscriptionPlanName->plan_id], array('required', 'placeholder' => $GdooxSubscriptionPlans[$SubscriptionPlanName->plan_id], 'class'=>'form-control')) !!}
            @elseif($SubscriptionPlanName->type === 'select' && $SubscriptionPlanName->plan_id === 'country')
                {!! Form::select('plan_fields['. $SubscriptionPlanName->plan_id .']', $countries, $GdooxSubscriptionPlans[$SubscriptionPlanName->plan_id], array('required', 'placeholder' => $GdooxSubscriptionPlans[$SubscriptionPlanName->plan_id], 'class'=>'form-control')) !!}
            @elseif($SubscriptionPlanName->type === 'select' && $SubscriptionPlanName->plan_id === 'currency')
                {!! Form::select('plan_fields['. $SubscriptionPlanName->plan_id .']', $currencies, $GdooxSubscriptionPlans[$SubscriptionPlanName->plan_id], array('required', 'placeholder' => $GdooxSubscriptionPlans[$SubscriptionPlanName->plan_id], 'class'=>'form-control')) !!}
            @elseif($SubscriptionPlanName->type === 'head')
                {!! Form::hidden('plan_fields['. $SubscriptionPlanName->plan_id .']', $GdooxSubscriptionPlans[$SubscriptionPlanName->plan_id], array('required', 'placeholder' =>'', 'class'=>'form-control')) !!}
            @else
                {!! Form::number('plan_fields['. $SubscriptionPlanName->plan_id .']', $GdooxSubscriptionPlans[$SubscriptionPlanName->plan_id], array('required', 'placeholder' => $GdooxSubscriptionPlans[$SubscriptionPlanName->plan_id], 'class'=>'form-control', 'min'=>0)) !!}
            @endif
                
                </div>    
            </div>
        @endforeach
            


            
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <a href="{!! route('plan_configuration.index')!!}" class="btn btn-round btn-danger">Cancel</a> <button id="send" type="submit" class="btn btn-round btn-success">Create</button>
                </div>
            </div>
            {!! Form::close() !!}

            
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



