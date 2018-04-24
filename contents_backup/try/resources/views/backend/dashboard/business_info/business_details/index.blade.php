@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>  {!!$fm_data->labels['form_title']!!}</h2>-->
@endsection

@section('right_col_title_right')
<!--    <a href="{!! route('business-info-index')  !!}" class="btn btn-default">View All</a>
    <a href="{!! route('business-info-create')  !!}" class="btn btn-default">Create New</a>-->
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
		<h2>{!!$fm_data->labels['heading']!!}</h2>
	</div><!-- .card-header -->
	<div class="card-body">
    @if ( !$business_info->count() )
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
                    <th>{!! $fm_data->labels['market']!!}</th>
                    <th>{!! $fm_data->labels['actvity_type']!!}</th>
                    <th>{!! $fm_data->labels['status']!!}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>    
            @foreach( $business_info as $business )
                <tr>
                    <td>{!! $business->company_name!!}</td>
                    <td>{!! $business->market!!}</td>
                    <td>{!! $business->actvity_type!!}</td>
                    <td>{!! ($business->status)!!}</td>
                   <td class="verify_busi">
                        <!--<div>-->
                        <a href="{!! route('business-details-show', $business->_id)  !!}" data-toggle="tooltip" data-placement="bottom" title="{!! ($business->verify)!!}">{!! ($business->verify)!!}</a>
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