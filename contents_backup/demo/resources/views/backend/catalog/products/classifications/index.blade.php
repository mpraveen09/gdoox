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
            <h2>Custom Product Classifications/Labels <a href="{!! route('classifications_labels.create')!!}" class="btn btn-default">Create New</a></h2>
        </div><!-- .card-header -->
        @if(empty($ProductClassifications))
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                You have no labels created. Create from <a href="{!! route('classifications_labels.create')!!}">here</a>
            </div>    
        @else
        
            <div class="card-body card-padding">
                <table class="table">
                @foreach($ProductClassifications as $ProductClassification)
                <tr>
                    <td>
                        <strong>{!! $ProductClassification->name !!}</strong>
                    </td>
                    <td><a href="{!! route('classifications_labels.edit', $ProductClassification->_id )!!}">Edit</a></td>
                    <td><a href="{!! route('products/classifications/productsinlabel', ['clid' => $ProductClassification->_id]) !!}" target='_blank'>View Assigned Products/Services</a></td>
                    <td><a href="{!! route('products/list') !!}" >Assign To Products/Services</a></td>
                </tr>
                    
                @endforeach
                </table>
            </div>
        
        

        @endif  
    </div>
    

@endsection   
