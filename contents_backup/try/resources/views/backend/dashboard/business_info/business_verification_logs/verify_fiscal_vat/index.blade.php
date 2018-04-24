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

<div class="card">
	<div class="card-header bgm-blue head-title">
        <h2>{!!$fm_data->labels['view']!!}</h2>
        <a href="{!! route('verify-fiscalvat-create')  !!}" class="btn btn-default">{!!$fm_data->labels['create']!!}</a>
        <a href="{!! route('verify-fiscalvat-index')  !!}" class="btn btn-default">{!!$fm_data->labels['view_all']!!}</a>
	</div><!-- .card-header -->
	<div class="card-body card-padding">
    @if ( !$verified_company->count() )
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            No any company verified
        </div>    
    @else
     
    </div><!-- .card-body -->
    <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
        <table class="table table-striped responsive-utilities jambo_table ">
             <tbody>    
            @foreach( $verified_company as $company )
                <tr>
                    <td>{!! $company->company_name!!}</td>
                    <td>{!! $company->vat_fiscal_id!!}</td>
                    <td>{!! $company->country!!}</td>
                 </tr>  
            @endforeach
    
            </tbody>
        </table>
        
        </div>
    
        <div class="row">
            <div class="text-right col-md-12">
            </div>
        </div>    
    @endif

    

</div><!-- .card -->
@endsection