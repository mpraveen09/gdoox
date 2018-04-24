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

    <div class="card">
        <div class="card-header card-padding-sm bgm-blue head-title">
            <h2><i class="zmdi zmdi-account m-r-5"></i> Select Business Ecommerce Sites</h2>
            <button onclick="goBack()" class="btn btn-default waves-effect">Back</button>
        </div>


        @if($personal_sites->count())
            <div class="card-body card-padding">
                {!! Form::model($fm_data, [
                      'method' => 'GET',
                      'route' => ['ecom.view_my_products'],
                      'class' => 'form-horizontal form-label-left',
                      'id'=>'import-products'
                  ]) !!}

                  {!! Form::hidden('ecom_slug',$ecom_slug) !!}

                  <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                      <table class="table table-striped responsive-utilities jambo_table ">
                           <tbody>
                              @foreach($personal_sites as $sites)
                                  <tr>
                                      <td>{!! Form::radio('site', $sites->slug, true ) !!} {!! $sites->slug !!}</td>
                                  </tr>
                              @endforeach
                            </tbody>
                       </table>             
                  </div>

                  @if (!empty($fm_data->labels['submit']))
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                             <button id="send" type="submit" class="btn btn-round btn-success">{!!$fm_data->labels['import']!!}</button>
                        </div>
                    </div>
                  @endif

                  {!! Form::close() !!}
            </div>
        @else
            <div class="card-body card-padding">
                <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                     You don't have Business Sites.
                </div>
             </div> 
        @endif
    </div>               
        
    
@endsection
@section('footer_add_js_script')
<script type="text/javascript">
        function goBack() {
            window.history.back();
        }
</script>
@endsection
