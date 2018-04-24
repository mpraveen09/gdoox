@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <!--<h2>Main Attributes Type</h2>--> 
    <!--<div class="page-top-links">-->
    <!--</div>-->
@endsection

@section('right_col_title_right')
@endsection

@section('right_col')
    
    @include('navigation_tabs.general_tabs')
    
    <div class="card">
        <div class="card-header bgm-blue head-title">
          <h2> Edit {!!  $attributes->label  !!}</h2>
          <a href="{!! route('attributestype.create')  !!}" class="btn btn-round btn-default">Create New</a>
          <a href="{!! route('attributestype.index')  !!}" class="btn btn-round btn-default">View All</a>
        </div><!-- .card-header -->
        <div class="card-body card-padding">    
    
            <!-- if there are creation errors, they will show here -->
            @if (HTML::ul($errors->all()))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    {!! HTML::ul($errors->all()) !!}
                </div>
            @endif

            {!! Form::model($attributes, [
                'method' => 'PUT',
                'route' => ['attributestype.update', $attributes->_id],
                'class' => 'form-horizontal form-label-left',
                'novalidate'=>''
            ]) !!}



                <div class="item form-group">
                    {!! Form::label('id', 'ID', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('id', $attributes->id, ['class' => 'form-control col-md-7 col-xs-12', 'readonly']) !!}
                    </div>
                </div>


                <div class="item form-group">
                    {!! Form::label('label', 'Label', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('label', $attributes->label, ['class' => 'form-control col-md-7 col-xs-12', 'required']) !!}
                    </div>

                </div>


                <div class="ln_solid"></div>
                <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                                <a href="{!! route('attributestype.index')  !!}" type="submit" class="btn btn-round btn-primary">Cancel</a>
                                <button id="send" type="submit" class="btn btn-round btn-success">Save</button>
                        </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection


