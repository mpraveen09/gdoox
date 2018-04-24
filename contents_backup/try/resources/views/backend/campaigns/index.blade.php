@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
@endsection

@section('right_col_title_right')
@endsection

@section('right_col')

@if (Session::has('message'))
    <div class="alert alert-info alert-dismissible" role="alert">
        {!!  Session::get('message')  !!}
    </div>
@endif

    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>Campaigns</h2>
            <a href="{!! route('campaigns.create')  !!}" class="btn  btn-default">Create New</a>
        </div>
        @if(!$campaigns->count())
            <div class="card">
                <div class="card-body">
                    <div class="alert alert-warning alert-dismissible" role="alert">
                         There Are No Campaigns
                    </div>
                </div>
            </div>              
        @else
            <div class="row">
                <div class="text-right col-md-12">
                    {!! $campaigns->render() !!}
                </div>
            </div>
            <div class="card-body card-padding">
                <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                    <table class="table table-striped responsive-utilities jambo_table ">
                        <thead>
                                <th>@if(isset($fm_data->labels['campaign_name'])) {!! $fm_data->labels['campaign_name'] !!} @else Campaign Name @endif</th>
                                <th>@if(isset($fm_data->labels['start_date'])) {!! $fm_data->labels['start_date'] !!} @else Start Date @endif</th>
                                <th>@if(isset($fm_data->labels['end_date'])) {!! $fm_data->labels['end_date'] !!} @else End Date @endif</th>
                                <th>@if(isset($fm_data->labels['type'])) {!! $fm_data->labels['type'] !!} @else Type @endif</th>
                                <th>@if(isset($fm_data->labels['campaign_image'])) {!! $fm_data->labels['campaign_image'] !!} @else Campaign Image @endif</th>
                                <th>@if(isset($fm_data->labels['url'])) {!! $fm_data->labels['url'] !!} @else Advertisement URL @endif</th>
                                <th>@if(isset($fm_data->labels['action'])) {!! $fm_data->labels['action'] !!} @else Advertisement Action @endif</th>
                         </thead>
                         <tbody>
                            @foreach($campaigns as $campaign)
                               <tr>
                                    <td>{!! $campaign->campaign_name !!}</td>
                                    <td>{!! $campaign->start_date !!}</td>
                                    <td>{!! $campaign->end_date !!}</td>
                                    <td>{!! $campaign->campaign_type !!}</td>
                                    <td><img src="{!! asset($campaign->campaign_image) !!}" style="width: 60px; height: 60px;"/></td> 
                                    <td>{!! $campaign->url !!}</td>
                                    <td>
                                        <a href="{!! route('campaigns.edit', $campaign->_id)  !!}"><i class='zmdi zmdi-edit zmdi-hc-fw'></i></a>
                                    </td>
                                </tr>
                             @endforeach
                         </tbody>
                     </table>
              </div>
           </div>
            <div class="row">
                <div class="text-right col-md-12">
                     {!! $campaigns->render() !!}
                </div>
            </div>
        @endif   
    </div>
@endsection
 
@section('footer_add_js_script')
<script>
    function goBack() {
        window.history.back();
    }
</script>
@endsection