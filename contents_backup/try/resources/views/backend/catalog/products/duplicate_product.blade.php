@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')

<!--<div class="page-top-links">-->
    
<!--</div>-->
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
            <h2>Crete Duplicate Product</h2>
        </div><!-- .card-header -->
    
        <div class="row">
            <div class="col-md-12">
                    {!! Form::open([
                        'method' => 'POST',
                        'route' => ['duplicate_this_product.save', $product_id],
                        'class' => 'form-horizontal form-label-left',
                        'novalidate'=>'',
                        'files' => true
                    ]) !!}
                    
                    <div class="item form-group attr_MP">
                        <label for="attr_id[3]" class="control-label col-md-3 col-sm-3 col-xs-12" title="Message about the product">Message Subject</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" placeholder="Message Subject" required="required" maxlength="60" name="attr_id[3]" type="text" value="" id="attr_id[3]" aria-required="true">
                        </div>
                    </div>
                    
                    <div class="item form-group attr_PR">
                        <label for="attr_id[4]" class="control-label col-md-3 col-sm-3 col-xs-12">Part Number</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" placeholder="Part Number" required="required" maxlength="20" name="attr_id[4]" type="text" value="" id="attr_id[4]" aria-required="true">
                        </div>
                    </div>
                
                    <div class="col-md-12 text-center">
                        <button id="send_prod_cat" type="submit" class="btn btn-round btn-success">Create Product</button>    
                        <br/><br/>
                    </div>
                {!! Form::close() !!}
                <br/>
            </div>
        </div> 
    </div>
@endsection


@section('footer_add_js_script')

@endsection
