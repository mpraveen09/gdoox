@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <!--<h2>Main Attributes Type</h2>--> 
    <!--<div class="page-top-links">-->
<!--    </div>-->
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
            <h2> Attributes</h2>
            <a href="{!! route('attributestype.create')  !!}" class="btn btn-round btn-default">Create New</a>
            <a href="{!! route('attributestype.index')  !!}" class="btn btn-round btn-default">View All</a>
        </div><!-- .card-header -->
        <div class="card-body ">    
            @if ( !$attributes->count())
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    You have no Attributes Type Defined
                </div>                 
            @else
                <table class="table table-striped responsive-utilities jambo_table ">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Meaning</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach( $attributes as $attribute )
                        <tr>
                            <td>{!!  $attribute->id  !!}</td>
                            <td>{!! $attribute->label !!}</td>
                            <td><a href="{!! route('attributestype.edit', $attribute->_id)  !!}"><i class='zmdi zmdi-edit zmdi-hc-fw'></i></a></td>
                        </tr>                
                    @endforeach

                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection