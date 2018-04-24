@extends('layout.backend.master')
@extends('layout.backend.userinfo')

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
    
@include('navigation_tabs.general_tabs')
    
<div class="card">
    <div class="card-header bgm-blue head-title">
        <h2>Invite Partner</h2>    
    </div>
    {!! Form::model($fm_data, [
            'method' => 'POST',
            'route' => ['invite.company.index'],
            'class' => 'form-label-left',
            'novalidate'=>''
        ]) !!}
        <div class="card-body card-padding">
            <div class="row">           
                <div class="col-sm-6">
                    <p class="c-black f-500 m-b-20">Enter Search Term</p>
                    <div class="form-group">
                            {!! Form::text('keyword', $search_val ,array('placeholder'=>'Search Keyword','id'=>'keyword',"required",'class'=>'form-control')) !!}
                    </div>
                </div>

                <div class="col-sm-6">
                    <p class="c-black f-500 m-b-20">Filter Your Search</p>
                    <div class="form-group">
                        <div class="fg-line">
                            <div class="select">
                                {!! Form::select('filter', $category, 'all', ['required','class' => 'form-control','id'=>'filter']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group clearfix">      
                <button class="btn btn-primary waves-effect">Search</button>
            </div>
        </div>
        {!! Form::close()!!}
</div>

@if($term['term']=='1')
    <div class="card">
        <div class="card-header bgm-blue">
            <h2></h2>
        </div><!-- .card-header -->
        <div class="card-body">
            @if ( !$business_info->count() )
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                No business found matching the Search Criteria.
            </div>
            @else
            <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                <table class="table table-striped responsive-utilities jambo_table ">
                    <thead>
                        <tr>
                            <th>Company Name</th>
                            <th>Country</th>
                            <th>Type</th>
                            <th>Request</th>
                        </tr>
                    </thead>
                    <tbody>    
                        @foreach( $business_info as $business )
                            <tr>
                                <td>{!!$business->company_name!!} </td>
                                <td>{!! $business->country!!}</td>
                                <td>{!! $business->actvity_type!!}</td>
                                <td>
                                    <a href="{!! route('invite.company.store', $business->_id )  !!}" type="submit" class="btn btn-default">Invite</a>
                                </td>
                                <td>
                                    <a href="{!! route('inviteforchat', $business->_id )  !!}" type="submit" class="btn btn-default">Invite For Chat</a>
                                </td> 
                            </tr>  
                        @endforeach
                        <tr>
                          <td><br/><br/><br/></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                    </tbody>
                </table>

                </div>

            <div class="row">
                <div class="text-right col-md-12">
                    {!! $business_info->render() !!}
                </div>
            </div>    
            @endif
        </div><!-- .card-body -->
    </div>
@else
@endif
@endsection