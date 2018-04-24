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
    <div class="alert alert-info">{!!  Session::get('message')  !!}</div>
@endif

@if (HTML::ul($errors->all()))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        {!! HTML::ul($errors->all()) !!}
    </div>
@endif
    
     @include('navigation_tabs.business_ecosystem_tabs')
    <div class="row">
        <div class="col-md-12">
          <div class="card">
              <div class="card-header card-padding-sm bgm-blue head-title">
                  <h2><i class="zmdi zmdi-account m-r-5"></i> Select Company Network</h2>
                  <button style="float: right;" onclick="goBack()" class="btn btn-default">Back</button>
              </div>
              @if($ecom_company->count())
                <div class="card-body card-padding">
                    {!! Form::model($fm_data, [
                          'method' => 'GET',
                          'route' => ['import-ecom-products.select_shared_site'],
                          'class' => 'form-horizontal form-label-left',
                          'id'=>'product-list'
                      ]) !!}
                        <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                            <table class="table table-striped responsive-utilities jambo_table ">
                                 <tbody>
                                    @foreach($ecom_company as $company)
                                        <tr>
                                            <td>{!! Form::radio('ecosystem_slug', $company->slug ) !!} {!! $company->ecomm_company_name !!}</td>
                                        </tr>
                                    @endforeach
                                  </tbody>
                             </table>             
                        </div>

                        @if (!empty($fm_data->labels['submit']))
                          <div class="form-group">
                              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                                   <button id="send" type="submit" class="btn btn-round btn-success">{!!$fm_data->labels['next']!!}</button>
                              </div>
                          </div>
                        @endif
                      {!! Form::close() !!}
                </div>
              @else 
                    <div class="card-body card-padding">
                        <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                             You don't have any Site. Please create your site and try again.
                        </div>
                    </div> 
              @endif
          </div>               
        </div>      
      </div>
    
@endsection

@section('footer_add_js_script')
<script type="text/javascript">
        function goBack() {
            window.history.back();
        }
</script>
@endsection
