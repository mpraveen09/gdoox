@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2> Business Follow</h2>-->
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
                <h2>Follow Request</h2>
            </div><!-- .card-header -->
            <div class="card-body card-padding">
              <p>Thank you for showing interest in Gdoox Business App.</p>
            </div>
        </div>
    @endsection    
 