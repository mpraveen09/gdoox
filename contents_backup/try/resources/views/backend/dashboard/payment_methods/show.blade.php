@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <!--<h2>{!!$fm_data->labels['form_title']!!}</h2>-->
    <!--<div class="page-top-links">-->
    <!--</div>-->
@endsection
@section('right_col_title_right')
@endsection
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
              <h2>{!!$fm_data->labels['view']!!}</h2>
              <a href="{!! route('payment-method-create')  !!}" class="btn btn-default">{!!$fm_data->labels['create']!!}</a>
              <a href="{!! route('payment-method-edit' , $payment_method->_id)  !!}" class="btn btn-default">{!!$fm_data->labels['edit']!!}</a>
              <a href="{!! route('payment-method-index')  !!}" class="btn btn-default">{!!$fm_data->labels['view_all']!!}</a>
        </div><!-- .card-header -->
        <!-- will be used to show any messages -->

        <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
            <table class="table table-striped responsive-utilities jambo_table ">
                <tbody>
                   <tr>
                        <td >{!!$fm_data->labels['label1']!!}</td>
                        <td>{!! $payment_method->name !!}</td>
                    </tr>
                   <tr>
                        <td >{!!$fm_data->labels['label2']!!}</td>
                        <td>{!! $payment_method->method_name !!}</td>
                    </tr>
                    </tr>
                </tbody>
            </table>
        </div><!--table table-stripped -->
    </div><!-- .card -->  
@endsection


