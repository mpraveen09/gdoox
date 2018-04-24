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
                <h2><i class="zmdi zmdi-account m-r-5"></i> Select Partner's Site</h2>
                <button onclick="goBack()" class="btn btn-primary waves-effect">Back</button>
            </div>


            @if($personal_sites->count())
            <div class="card-body card-padding">
                {!! Form::model($fm_data, [
                        'method' => 'GET',
                        'route' => ['import-ecom-products.view_products'],
                        'class' => 'form-horizontal form-label-left',
                        'id'=>'import-products'
                  ]) !!}
                  
                  {!!Form::hidden('slug', $data['ecosystem_slug'])!!}
                  <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                      <table class="table table-striped responsive-utilities jambo_table "> 
                           <tbody>
                              @foreach($personal_sites as $sites)
                                @if(!empty($sites->siteslug ))
                                    <tr>
                                        <td>
<!--                                        {!! Form::checkbox('sites[]', $sites->invited_comp_site_slug ) !!} {!! $sites->invited_comp_site_slug !!}-->
                                            {!! Form::radio('site', $sites->invited_comp_site_slug) !!} {!! $sites->invited_comp_site_slug !!} <br/>
                                        </td>
                                    </tr>
                                @endif    
                              @endforeach
                            </tbody>
                       </table>             
                  </div>

                  @if(!empty($fm_data->labels['submit']))
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
                           There are no Business E-commerce Sites.
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

