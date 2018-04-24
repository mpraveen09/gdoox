@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>  {!!$fm_data->labels['form_title']!!}</h2>-->
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
    
    @if (HTML::ul($errors->all()))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!! HTML::ul($errors->all()) !!}
        </div>
    @endif
 
    @include('navigation_tabs.general_tabs')
    
    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>{!!$fm_data->labels['heading']!!}</h2>
            <a href="{!! route('business-info-create')  !!}" class="btn btn-default">Create New</a>
            <a href="{!! route('business-info-index')  !!}" class="btn btn-default">View All</a>
        </div><!-- .card-header -->
        <div class="card-body">
            @if(!$business_info->count())
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    You have no business listed
                </div>    
            @else

                <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                    <table class="table table-striped responsive-utilities jambo_table ">
                        <thead>
                            <tr>
                                <th>{!! $fm_data->labels['company_name']!!}</th>
                                <th>{!! $fm_data->labels['country']!!}</th>
                                <th>{!! $fm_data->labels['actvity_type']!!}</th>
                                <th>{!! $fm_data->labels['status']!!}</th>
                                <th>{!! $fm_data->labels['action']!!}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>    
                        @foreach( $business_info as $business )
                            <tr>
                                <td>{!! $business->company_name!!}</td>
                                <td>{!! $business->country!!}</td>
                                <td>{!! $business->actvity_type!!}</td>
                                <td>{!! ($business->status)!!}</td>
                                <td>
                                  <a href="{!! route('business-info-show', $business->_id)  !!}" data-toggle="tooltip" data-placement="bottom" title="view"><i class='zmdi zmdi-eye zmdi-hc-fw'></i></a> &nbsp; 
                                  <a href="{!! route('business-info-edit', $business->_id)  !!}"data-toggle="tooltip" data-placement="bottom" title="Edit"><i class='zmdi zmdi-edit zmdi-hc-fw'></i></a>
                                </td>
                                <td class="verify_busi">
                                    <!--<div>-->
                                        {!! ($business->verify)!!}
                                        @if($business->verify!='Verified')
                                        <ul class="actions btn-default">
                                            <li class="dropdown">
                                                <a data-toggle="dropdown" href="" aria-expanded="false">
                                                    <i class="zmdi zmdi-more-vert"></i>
                                                </a>

                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li>
                                                        <a href="{!! route('verify-fiscalvat-edit',$business->_id)  !!}">Verify with Fiscal ID & Vat Number</a>
                                                    </li>
                                                    <li>
                                                        <a href="{!! route('verify-documents-edit',$business->_id)  !!}">Verify with Company Documents</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>                        
                                        @endif
                                    <!--</div>-->
                                </td>
                            </tr>  
                        @endforeach

                            <tr>
                              <td><br/><br/><br/></td>
                              <td></td>
                              <td></td>
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
    </div><!-- .card -->
@endsection