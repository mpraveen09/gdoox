@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2> Business Ecosystem</h2>-->
@endsection

@section('right_col_title_right')
@endsection

@section('right_col')
    @if (Session::has('message'))
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!!  Session::get('message')  !!}
        </div>
    @endif
    
    @if (HTML::ul($errors->all()))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!! HTML::ul($errors->all()) !!}
        </div>
    @endif
    
    @include('navigation_tabs.business_ecosystem_tabs')
    
    <div class="card">
	<div class="card-header bgm-blue head-title">
            <h2>Business Ecosystem</h2>
	</div><!-- .card-header -->
	<div class="card-body card-padding">
            @if(!$sharedSites->count())
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    You don't have any shared site.
                </div>    
            @else
                {!!Form::open(['route'=>'ecosys.site.storesite','method'=>'GET'])!!}
                    {!!Form::hidden('site_id', $id)!!}
                    <div class="form-group clearfix">
                        {!! Form::label('shared_sites', 'Shared Sites'.$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          @foreach($sharedSites as $site)
                                {!! Form::checkbox('partner_sites[]', $site->siteslug, null, array('required')) !!}{!!Form::label('site_name', $site->site_name)!!}<br/>
                          @endforeach
                        </div>    
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                            <button id="send" type="submit" class="btn btn-round btn-success">Save</button>
                        </div>
                    </div>
                {!!Form::close()!!}      
            @endif
        </div><!-- .card-body -->
    </div><!-- .card -->
@endsection