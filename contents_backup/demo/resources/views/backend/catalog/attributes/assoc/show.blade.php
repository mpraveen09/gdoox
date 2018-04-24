@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <!--<h3>Main Attributes Association/Classification</h3>--> 
    <!--<div class="page-top-links">-->
    <!--</div>-->
@endsection

@section('right_col_title_right')
@endsection

@section('right_col')

    <!-- will be used to show any messages -->
    @if (Session::has('message'))
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!!  Session::get('message')  !!}
        </div>
    @endif
    
    @include('navigation_tabs.general_tabs')
    
    <div class="card">
	<div class="card-header bgm-blue head-title">
            <h2>View {!!  $attributes->label  !!}</h2>
            <a href="{!! route('attributesassoc.create')  !!}" class="btn btn-round btn-default">Create New</a>
            <a href="{!! route('attributesassoc.index')  !!}" class="btn btn-round btn-default">View All</a>
        </div><!-- .card-header -->
	<div class="card-body card-padding">
            <table class="table">
                <tbody>
                    <tr>
                        <td >ID</td>
                        <td>{!! $attributes->id !!}</td>
                    </tr>
                    <tr>
                        <td>Label</td>
                        <td>{!! $attributes->label !!}</td>
                    </tr>            
                </tbody>
            </table>
        </div>
    </div>
@endsection


