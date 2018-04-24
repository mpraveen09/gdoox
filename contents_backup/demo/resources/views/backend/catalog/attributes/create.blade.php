@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
   <!--<h2>Main Attributes List</h2>-->
<!--    <div class="page-top-links">-->
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

    @include('navigation_tabs.general_tabs')
    
    <div class="card">
	<div class="card-header bgm-blue head-title">
            <h2>Create New Attribute</h2>
            <a href="{!! route('attributes.create')  !!}" class="btn btn-round btn-default">Create New</a>
            <a href="{!! route('attributes.index')  !!}" class="btn btn-round btn-default">View All</a>
	</div><!-- .card-header -->
	<div class="card-body card-padding">
            {!! Form::open([
                'method' => 'POST',
                'route' => 'attributes.store',
                'class' => 'form-horizontal form-label-left'
            ]) !!}

            <div class="item form-group">
                {!! Form::label('attr_id', 'Attribute ID', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('attr_id', '', ['class' => 'form-control col-md-7 col-xs-12', 'required']) !!}
                </div>
            </div>

            <div class="item form-group">
                {!! Form::label('label', 'Label / Brief Description', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('label', '', ['class' => 'form-control col-md-7 col-xs-12', 'required']) !!}
                </div>
            </div>

            <div class="item form-group">
                {!! Form::label('desc', 'Tool Tip', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('desc', '', ['class' => 'form-control col-md-7 col-xs-12', 'required']) !!}
                </div>
            </div>

            <div class="item form-group">
                {!! Form::label('field_type', 'Type', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::select('field_type', $a_types_, null, ['class' => 'form-control col-md-7 col-xs-12', 'required', 'placeholder' => 'Select a type']) !!}
                </div>
            </div>

            <div class="item form-group">
                {!! Form::label('len', 'Length', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::number('len', '', ['class' => 'form-control col-md-7 col-xs-12']) !!}
                </div>
            </div>

            <div class="item form-group">
                {!! Form::label('class', 'Association / Classification', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::select('class', $a_assocs_, null, ['class' => 'form-control col-md-7 col-xs-12', 'required', 'placeholder' => 'Select a Association / Classification']) !!}
                </div>
            </div>

            <div class="item form-group">
                {!! Form::label('req', 'Required', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::select('req', ['M'=>'M','L'=>'L'],'L', ['class' => 'form-control col-md-7 col-xs-12', 'required']) !!}
                </div>
            </div>

            <div class="item form-group">
                {!! Form::label('drop_options', 'Drop-down Options List', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::select('drop_options', $dd_opts_, null, ['class' => 'form-control col-md-7 col-xs-12', 'placeholder' => '---']) !!}
                </div>
            </div>

            <div class="ln_solid"></div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                    <a href="{!! route('attributes.index')  !!}" type="submit" class="btn btn-round btn-primary">Cancel</a>
                    <button id="send" type="submit" class="btn btn-round btn-success">Save</button>
                </div>
            </div>
            {!! Form::close() !!}
	</div><!-- .card-body -->
    </div><!-- .card -->
@endsection


