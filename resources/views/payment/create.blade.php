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
    
    @if (Session::has('error'))
        <div class="alert alert-danger">{!!  Session::get('error')  !!}</div>
    @endif
 
    <div class="card">
        <div class="card-header bgm-cyan ">
            <h2>Subscription Plan Selection</h2>
        </div>

        <div class="card-body card-padding">
            {!! Form::open([
                'method' => 'POST',
                'route' => 'plan-configure',
                'class' => 'form-horizontal form-label-left'
            ]) !!}

            <p>You can select your country and a plan from below. You can then proceed to pay or explore the features for 14 days free trial</p>
            <div class="item form-group">
                {!! Form::label('email','E-Mail:', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('email', $user->email, ['readonly','class' => 'form-control col-md-7 col-xs-12']) !!}
                </div>
            </div>

            
            <div class="form-group">
                {!! Form::label('country','Country', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::select('country', $country, null, array('required', 'placeholder' =>'--Select--', 'class'=>'form-control')) !!}
                </div>    
            </div>
            
<!--            <div class="item form-group">
                {!! Form::label('payment','Payment', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select required="required" name="payment" id="send_to" class="form-control col-md-7 col-xs-12">
                        <option value="">Select</option>
                        <option value="Yearly">Yearly</option>
                    </select>
                </div>
            </div>-->
            {!! Form::hidden('payment', 'Yearly', array('required', 'placeholder' =>'', 'class'=>'form-control')) !!}
            {!! Form::hidden('userid', $user->_id, array('required', 'placeholder' =>'', 'class'=>'form-control')) !!}

            <div class="form-group">
                {!! Form::label('plan','Select A Plan', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::select('plan', $rolesdd, $userrole['rank'], array('required', 'placeholder' =>'--Select--', 'class'=>'form-control')) !!}
                </div>    
            </div>            
        
            
            
            
            <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                    <button id="send" type="submit" class="btn btn-round btn-success">NEXT</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
 
@section('footer_add_js_script')
    <script type="text/javascript"></script>
@endsection