@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <!--<h2>Dropdown Options List</h2>-->  
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
            <h2>Dropdown Options</h2>
            <a href="{!! route('dropdownoptions.create')  !!}" class="btn btn-round btn-default">Create New</a>
            <a href="{!! route('dropdownoptions.index')  !!}" class="btn btn-round btn-default">View All</a>
        </div><!-- .card-header -->
        <div class="card-body ">    
            @if ( !$dropdownoptions->count() )
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    You have no Dropdown options
                </div>                   
            @else
            <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                <table class="table table-striped responsive-utilities jambo_table ">
                    <thead>
                        <tr>
                            <th>Attribute ID</th>
                            <th>Dorpdown List Name</th>
                            <th>Options</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach( $dropdownoptions as $dropdownoption )
                        <tr>
                            <td>{!! $dropdownoption->attr_id !!}</td>
                            <td>{!! $dropdownoption->name  !!}</td>
                            <td>{!! implode("<br/>", $dropdownoption->options) !!}</td>
                            <td><a href="{!! route('dropdownoptions.edit', $dropdownoption->_id)  !!}"><i class='zmdi zmdi-edit zmdi-hc-fw'></i></a></td>
                        </tr>                
                    @endforeach

                    </tbody>
                </table>
            </div>
            @endif
      </div>
    </div>       
@endsection