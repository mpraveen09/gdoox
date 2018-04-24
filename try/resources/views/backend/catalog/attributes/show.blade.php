@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <!--<h2>Main Attributes List</h2>-->
    <!--<div class="page-top-links">-->
    <!--</div>-->
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
    
    @include('navigation_tabs.general_tabs')
    
    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>Attribute - {!! $attributes->label !!}</h2>
            <a href="{!! route('attributes.create')  !!}" class="btn btn-round btn-default">Create New</a>
            <a href="{!! route('attributes.edit', $attributes->attr_id)  !!}"class="btn btn-round btn-default">Edit</a>
            <a href="{!! route('attributes.assign', $attributes->attr_id)  !!}" class="btn btn-default">Assign this to Categories</a>
            <a href="{!! route('attributes.index')  !!}" class="btn btn-round btn-default">View All</a>
        </div><!-- .card-header -->
        <!-- will be used to show any messages -->

        <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
            <table class="table table-striped responsive-utilities jambo_table ">
                <tbody>
                    <tr>
                        <td >Attribute ID</td>
                        <td>{!! $attributes->attr_id !!}</td>
                    </tr>
                    <tr>
                        <td>Label / Brief Description</td>
                        <td>{!! $attributes->label !!}</td>
                    </tr>            
                    <tr><td>Tool Tip</td><td>{!! $attributes->desc !!}</td></tr>            
                    <tr><td>Type</td><td>{!! $attributes->field_type !!}</td></tr>            
                    <tr><td>Length</td><td>{!! $attributes->len !!}</td></tr>            
                    <tr><td>Association / Classification</td><td>{!! $attributes->class !!}</td></tr>            
                    <tr><td>Required</td><td>{!! $attributes->req !!}</td></tr>            

                    @if ($attributes->field_type==="TD" || $attributes->field_type === "TM")
                        <tr><td>Drop-down Options List</td><td>{!! $attributes->dropdown_list !!}</td></tr>    
                    @endif
                </tbody>
            </table>
        </div><!-- .card -->
    </div>        
@endsection


