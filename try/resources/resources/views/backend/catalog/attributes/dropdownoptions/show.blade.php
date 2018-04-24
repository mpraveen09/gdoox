@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <!--<h2>Main Attributes Association/Classification</h2>--> 
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
            <h2>Show </h2>
            <a href="{!! route('dropdownoptions.create')  !!}" class="btn btn-round btn-default">Create New</a>
            <a href="{!! route('dropdownoptions.edit', $dropdownoptions->_id)  !!}"class="btn btn-round btn-primary">Edit</a>
            <a href="{!! route('dropdownoptions.index')  !!}" class="btn btn-round btn-default">View All</a>
        </div><!-- .card-header -->
        
        <div class="card-body card-padding">    
            <table class="table">
                <tbody>
                    <tr>
                        <td >Name</td>
                        <td>{!! $dropdownoptions->name !!}</td>
                    </tr>
                    <tr>
                        <td>Options</td>
                        <td>{!! implode("<br/>", $dropdownoptions->options) !!}</td>
                    </tr>            
                </tbody>
            </table>
        </div>
    </div>    
  @endsection


