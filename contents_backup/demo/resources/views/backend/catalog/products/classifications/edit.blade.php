  @extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>Product Management</h2>-->
@endsection

@section('right_col_title_right')
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
    
    @include('navigation_tabs.general_tabs')
    
    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>Custom Product Classifications/Labels</h2>
        </div><!-- .card-header -->
          {!! Form::open(array('route' => ['classifications_labels.update', $ProductClassifications->_id], 'method'=>'PUT', 'class'=>'form-horizontal form-label-left')) !!}
            <div class="card-body card-padding">
                
                <div class="form-group clearfix">
                    {!! Form::label('cust_label','Product Classification/Label', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('cust_label', $ProductClassifications->name, array('required','placeholder' => $ProductClassifications->name, 'class'=>'form-control')) !!}
                    </div>    
                </div>
                
                <div class="form-group clearfix">     
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <a href="{!! route('classifications_labels.index')  !!}" class="btn btn-round btn-danger">Cancel</a>
                        <button type="submit" class="btn btn-primary waves-effect">Create</button>
                    </div>
                </div>
            </div> 
          {!! Form::close() !!}
    </div>

        </div><!-- .card-body -->
    </div>

@endsection   
