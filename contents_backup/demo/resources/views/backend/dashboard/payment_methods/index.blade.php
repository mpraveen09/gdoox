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
        
        
    </div><!-- .card-header -->
    <div class="card-body card-padding">
        @if (empty($payment_method_data))
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                You have no Payment method <a href="{!! route('payment-method-create')  !!}" class="btn btn-default">{!!$fm_data->labels['create']!!}</a>
            </div>    
        @else
            <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                <table class="table table-striped responsive-utilities jambo_table ">
                     <tbody>    
                        
                            <tr>
                              <td>PayPal Name: {!!$payment_method_data->paypal_name !!}</td>
                              <td>PayPal ID/Email: {!!$payment_method_data->paypal_id !!}</td>
                              <td>
                                    <a href="{!! route('payment-method-edit', $payment_method_data->_id)  !!}"><i class='zmdi zmdi-edit zmdi-hc-fw'></i></a>
                                </td>
                            </tr>  
                        
                    </tbody>
                </table>
            </div>
   
      
        @endif
    </div><!-- .card-body -->
</div><!-- .card -->
@endsection