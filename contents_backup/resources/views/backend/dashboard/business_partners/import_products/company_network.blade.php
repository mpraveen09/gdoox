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

   @include('navigation_tabs.network_tabs')

    <div class="row">
        <div class="col-md-12">
          <div class="card">
              <div class="card-header card-padding-sm bgm-blue head-title">
                  <h2><i class="zmdi zmdi-account m-r-5"></i> Select Company</h2>
                  <button onclick="goBack()" style="float: right;" class="btn waves-effect">Back</button>
              </div>
              @if(!empty($assignednetsite))
                    @if(count($networks) > 1)
                      <div class="card-body card-padding">
                          {!! Form::model($fm_data, [
                              'method' => 'GET',
                              'route' => ['import-net-products.view_products'],
                              'class' => 'form-horizontal form-label-left',
                              ]) !!}

                              <div class="row">
                                  <div class="col-sm-5">
                                      <p class="c-black f-500 m-b-20">Import Products From</p>

                                      <div class="form-group">
                                          <div class="fg-line">
                                                  {!! Form::radio('from_network', $assignednetsite->network_site,'true') !!} {!! $assignednetsite->network_site !!}
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-sm-1"></div>
                                  <div class="col-sm-5">
                                      <p class="c-black f-500 m-b-20">Import Products To</p>

                                      <div class="form-group">
                                          <div class="fg-line">
                                              <div class="select">
                                                  {!! Form::select('to_network', $networks,'', array('id'=>'to_network','required','class'=>'form-control','placeholder'=>'Select')) !!}
                                              </div>
                                          </div>
                                      </div>
                                  </div>
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
                               You have only one Site. Please create a site and then try to import Products to Network Site.
                          </div>
                      </div> 
                    @endif
              @else
                <div class="card-body card-padding">
                      <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                          You have not assigned a Company Network Site. <a href="{!! route('company.network.assign.site')!!}">Please assign a Company Network Site.</a>
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

    $(function(){
        $("#from_network").change(function(){
             $("#to_network option").prop('disabled',false);
             $('#to_network').prop('selectedIndex',0);
             $("#to_network option[value*='"+$(this).val()+"']").prop('disabled',true);
        });
    });

</script>
@endsection

