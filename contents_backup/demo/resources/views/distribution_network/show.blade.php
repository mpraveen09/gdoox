@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <!--<h2>{!!$fm_data['labels']['form_title']!!}</h2>-->
    <!--<div class="page-top-links">-->
    <!--</div>-->
@endsection

@section('right_col_title_right')
@endsection

@section('right_col')
    <!-- will be used to show any messages -->
    @if (Session::has('message'))
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!!  Session::get('message')  !!}
        </div>
    @endif
    
    @include('navigation_tabs.general_tabs')
    
    <div class="card">
      <div class="card-header bgm-blue head-title">
        <h2>{!! $network->type !!}</h2>
        <a href="{!! route('distributionnetwork.edit', $network->_id)  !!}"class="btn btn-round btn-default">Edit</a>
        <a href="{!! route('distributionnetwork.index')  !!}"class="btn btn-round btn-default">View Network</a>
      </div><!-- .card-header -->
      <div class="card-body card-padding">    
            <table class="table">
                <tbody>

                    @if(isset($network->company_name))
                      <tr>
                          <td>
                              @if(!empty($fm_data['labels']['company_name']))
                                {!! $fm_data['labels']['company_name'] !!}
                              @endif
                          </td>
                          <td>{!! $network->company_name !!}</td>
                      </tr>
                    @endif

                    <tr>
                        <td>
                            @if(!empty($fm_data['labels']['first_name']))
                              {!! $fm_data['labels']['first_name'] !!}
                            @endif
                        </td>
                        <td>{!! $network->first_name !!}</td>
                    </tr>

                    <tr>
                        <td>
                            @if(!empty($fm_data['labels']['last_name']))
                              {!! $fm_data['labels']['last_name'] !!}
                           @endif
                        </td>
                        <td>{!! $network->last_name !!}</td>
                    </tr>

                    @if(isset($network->gender))
                    <tr>
                        <td>
                            @if(!empty($fm_data['labels']['gender']))
                              {!! $fm_data['labels']['gender'] !!}
                           @endif
                        </td>
                        <td>
                            @if($network->gender==='male')
                              Male
                            @else
                              Female
                            @endif
                        </td>
                    </tr>
                    @endif

                    @if(isset($network->age))
                    <tr>
                        <td>
                            @if(!empty($fm_data['labels']['age']))
                              {!! $fm_data['labels']['age'] !!}
                           @endif
                        </td>
                        <td>{!! $network->age !!}</td>
                    </tr>
                    @endif

                    <tr>
                        <td>
                            @if(!empty($fm_data['labels']['country_of_work']))
                              {!! $fm_data['labels']['country_of_work'] !!}
                           @endif
                        </td>
                        <td>{!! $network->country_of_work !!}</td>
                    </tr>

                    @if(isset($network->country_of_living))
                    <tr>
                        <td>
                            @if(!empty($fm_data['labels']['country_of_living']))
                              {!! $fm_data['labels']['country_of_living'] !!}
                           @endif
                        </td>
                        <td>{!! $network->country_of_living !!}</td>
                    </tr>
                    @endif

                    <tr>
                        <td>
                            @if(!empty($fm_data['labels']['region']))
                              {!! $fm_data['labels']['region'] !!}
                           @endif
                        </td>
                        <td>{!! $network->region !!}</td>
                    </tr>

                    <tr>
                        <td>
                            @if(!empty($fm_data['labels']['business_email']))
                              {!! $fm_data['labels']['business_email'] !!}
                           @endif
                        </td>
                        <td>{!! $network->business_email !!}</td>
                    </tr>

                    <tr>
                        <td>
                            @if(!empty($fm_data['labels']['business_phone']))
                              {!! $fm_data['labels']['business_phone'] !!}
                           @endif
                        </td>
                        <td>{!! $network->business_phone !!}</td>
                    </tr>

                    <tr>
                        <td>
                            @if(!empty($fm_data['labels']['business_mob']))
                              {!! $fm_data['labels']['business_mob'] !!}
                           @endif
                        </td>
                        <td>{!! $network->business_mob !!}</td>
                    </tr>

                    <tr>
                        <td>
                            @if(!empty($fm_data['labels']['skype_account']))
                              {!! $fm_data['labels']['skype_account'] !!}
                           @endif
                        </td>
                        <td>{!! $network->skype_account !!}</td>
                    </tr>
                    @if(isset($network->vat))
                    <tr>
                        <td>
                            @if(!empty($fm_data['labels']['vat']))
                              {!! $fm_data['labels']['vat'] !!}
                           @endif
                        </td>
                        <td>{!! $network->vat !!}</td>
                    </tr>

                    @endif
                </tbody>
            </table>
      </div>
    </div>
@endsection

@section('footer_add_js_script')
<script>
function goBack() {
    window.history.back();
}
</script>
@endsection


