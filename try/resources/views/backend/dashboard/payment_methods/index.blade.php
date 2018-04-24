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

    @include('navigation_tabs.general_tabs')
    
<div class="card">
    <div class="card-header bgm-blue head-title">
        <h2>{!!$fm_data->labels['heading']!!}</h2>
        <a href="{!! route('payment-method-create')  !!}" class="btn btn-default">{!!$fm_data->labels['create']!!}</a>
        <a href="{!! route('payment-method-index')  !!}" class="btn btn-default">{!!$fm_data->labels['view_all']!!}</a>
    </div><!-- .card-header -->
    <div class="card-body card-padding">
        @if (!$payment_method_data->count())
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                You have no Payment method
            </div>    
        @else
            <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                <table class="table table-striped responsive-utilities jambo_table ">
                     <tbody>    
                        @foreach( $payment_method_data as $data )
                            <tr>
                              <td>{!!$data->name!!}</td>
                              <td>{!!$data->method_name!!}</td>
                              <td>
                                    <a href="{!! route('payment-method-show', $data->_id)  !!}"><i class='zmdi zmdi-eye zmdi-hc-fw'></i></a> &nbsp; 
                                    <a href="{!! route('payment-method-edit', $data->_id)  !!}"><i class='zmdi zmdi-edit zmdi-hc-fw'></i></a>
                                </td>
                            </tr>  
                        @endforeach
                    </tbody>
                </table>
            </div>
   
            <div class="row">
                <div class="text-right col-md-12">
                    {!! $payment_method_data->render() !!}
                </div>
            </div>       
        @endif
    </div><!-- .card-body -->
</div><!-- .card -->
@endsection