@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
   <h2>CRM</h2>
    <!--<div class="page-top-links">-->
    <!--</div>-->
@endsection

@section('right_col_title_right')
@endsection

@section('right_col')
    <!-- if there are creation errors, they will show here -->
    @if (HTML::ul($errors->all()))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!! HTML::ul($errors->all()) !!}
        </div>
    @endif
    
    @if (Session::has('message'))
        <div class="alert alert-info alert-dismissible" role="alert">
            {!!  Session::get('message')  !!}
        </div>
    @endif
    
    @include('navigation_tabs.crm_tabs')
    
    <div class="card">
         <div class="card-header bgm-blue head-title">
            <h2>{!! $form_fields->labels['select_group'] !!}</h2>
            <a href="{!! route('crm_contacts.index')  !!}" class="btn  btn-default">View All</a>
            <button class="btn btn-default" onclick="goBack()">Go Back</button>
        </div>
        
        <div class="card-body card-padding">
                {!! Form::open([
                    'method' => 'GET',
                    'route' => 'crm_select_contact',
                    'class' => 'form-horizontal form-label-left'
                ]) !!}

                <div class='item form-group'>
                    {!! Form::label('group',$form_fields->labels['select_group'], ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                    <div class='col-md-6 col-sm-6 col-xs-12'>
                        {!! Form::select('group', $groups, '', ['class' => 'form-control col-md-7 col-xs-12']) !!}
                    </div>
                </div>

                <div class="ln_solid"></div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
<!--                   <a href="{!! route('crm_emails.create')  !!}" type="submit" class="btn btn-round btn-primary">{!! $form_fields->labels['cancel'] !!}</a>-->
                       <button id="send" type="submit" class="btn btn-round btn-success">{!! $form_fields->labels['next'] !!}</button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>  
    </div>
@endsection


@section('footer_add_js_script')

@endsection



