@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <!--<h2>{!!$fm_data->labels['form_title']!!}</h2>-->
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
    
<div class="card">
    <div class="card-header bgm-blue head-title">
            <h2>View</h2>
        <a href="{!! route('ecomm-create') !!}" class="btn btn-round btn-default">Create New</a>
        <a href="{!! route('ecomm-edit', $ecompany->id)  !!}"class="btn btn-round btn-default">Edit</a>
        <a href="{!! route('ecomm-index')  !!}" class="btn btn-round btn-default">View All</a>
    </div><!-- .card-header -->
    <!-- will be used to show any messages -->

<div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
        
    <table class="table table-striped responsive-utilities jambo_table ">
        <tbody>
            <tr>
                <td >{!!$fm_data->labels['ecomm_company_name']!!}</td>
                <td>{!! $ecompany->ecomm_company_name !!}</td>
            </tr>
            <tr>
                <td >{!!$fm_data->labels['slug']!!}</td>
                <td>{!! $ecompany->slug !!}</td>
            </tr>
            <tr>
                <td >{!!$fm_data->labels['email']!!}</td>
                <td>{!! $ecompany->email !!}</td>
            </tr>
            <tr>
                <td >{!!$fm_data->labels['company']!!}</td>
                <td>{!! $ecompany->company !!}</td>
            </tr>
            @if(!empty($ecompany->business_desc_tags))
            <tr>
                <td >Business Description Tags</td>
                <td>{!! $ecompany->business_desc_tags !!}</td>
            </tr>
            @endif
            @if(!empty($ecompany->brands))
            <tr>
                <td >Brands You Deal</td>
                <td>{!! $ecompany->brands !!}</td>
            </tr>
            @endif
            @if(!empty($ecompany->policy_doc))
            <tr>
                <td >Return Policy Document</td>
                <td><a href ="{!!$ecompany->doc_path.$ecompany->policy_doc!!}">{!! $ecompany->policy_doc !!}</a></td>
            </tr>
            @endif
            @if(!empty($ecompany->market))
            <tr>
                <td >Your Market</td>
                <td>{!! implode(', ', $ecompany->market) !!}</td>
            </tr>
            @endif
        </tbody>
    </table>
</div><!-- .card -->
        
@endsection


