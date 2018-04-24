@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <!--<h2>Business Ecosystem</h2>-->
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
    
@include('navigation_tabs.business_ecosystem_tabs')  
    
<div class="card">
    <div class="card-header bgm-blue head-title">
        <h2>View</h2>
        <a href="{!! route('ecosys.site.index') !!}" class="btn btn-round btn-default">Create New</a>
        <a href="{!! route('ecosys.site.edit', $business_ecosystem->id)  !!}"class="btn btn-round btn-default">Edit</a>
        <a href="{!! route('ecosys.site.indexall')  !!}" class="btn btn-round btn-default">View All</a>
    </div><!-- .card-header -->
    <!-- will be used to show any messages -->

    <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
        <table class="table table-striped responsive-utilities jambo_table ">
            <tbody>
                <tr>
                    <td >{!!$fm_data->labels['ecomm_company_name']!!}</td>
                    <td>{!! $business_ecosystem->ecomm_company_name !!}</td>
                </tr>
                <tr>
                    <td >{!!$fm_data->labels['slug']!!}</td>
                    <td>{!! $business_ecosystem->slug !!}</td>
                </tr>
                <tr>
                    <td >{!!$fm_data->labels['email']!!}</td>
                    <td>{!! $business_ecosystem->email !!}</td>
                </tr>
                <tr>
                    <td >{!!$fm_data->labels['company']!!}</td>
                    <td>{!! $business_ecosystem->company !!}</td>
                </tr>
                <tr>
                    <td>Patner Sites</td>
                    <td>               
                     @for($i=0; $i < count($business_ecosystem->partner_sites); $i++)
                     {!!$business_ecosystem->partner_sites[$i]!!}({!!$partner_company[$i]!!}:-{!!$partner_user[$i]!!})<br>
                     @endfor    
                    </td>
                </tr>
            </tbody>
        </table>
    </div><!-- .card -->
</div>  
@endsection


