@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
@endsection

@section('header_add_js_script')        
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

    @include('navigation_tabs.general_tabs')
    <div class="card">
        <div class="card-header bgm-blue head-title">
          <h2><i class="zmdi zmdi-account m-r-5"></i> {!! $fm_data->labels['create_campaign'] !!}</h2>
        </div><!-- .card-header -->
        <div class="card-body card-padding">  
            
            {!! Form::open([
                  'method' => 'POST',
                  'route' => 'store.campaigns.request',
                  'class' => 'form-label-left',
                  'id'=>'campaigns-create',
                 'files'=>true
              ]) !!}
                    
                    
                    @if(!empty($fm_data->labels['campaign_name']))
                      <div class="form-group clearfix">
                         {!! Form::label('campaign_name', $fm_data->labels['campaign_name'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                         <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('campaign_name','', array('required','placeholder'=>$fm_data->labels['campaign_name'],'class'=>'form-control')) !!}
                         </div>    
                      </div>
                    @endif
                  
                    @if(!empty($fm_data->labels['time_period']))
                      <div class="form-group clearfix">
                          {!! Form::label('time_period', $fm_data->labels['time_period'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                          <div class="col-md-3 col-sm-3 col-xs-12">
                              {!! Form::date('start_date','', array('placeholder'=>$fm_data->labels['start_date'],'class'=>'form-control')) !!}
                          </div> 
                          <div class="col-md-3 col-sm-3 col-xs-12">
                              {!! Form::date('end_date','', array('placeholder'=>$fm_data->labels['end_date'],'class'=>'form-control')) !!}
                          </div>
                      </div>
                    @endif
                  

                    @if(!empty($fm_data->labels['type']))
                      <div class="form-group clearfix">
                         {!! Form::label('campaign_type', $fm_data->labels['type'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                         <div class="col-md-6 col-sm-6 col-xs-12">
                              {!! Form::select('campaign_type', $campaigntype,'', array('placeholder'=>$fm_data->labels['type'],'required', 'class'=>'form-control')) !!}
                         </div>    
                      </div>
                    @endif

                    @if(!empty($fm_data->labels['campaign_image']))
                      <div class="form-group clearfix">
                          <div class="col-md-3 col-sm-3 col-xs-12">
                              {!! Form::label('campaign_image', $fm_data->labels['campaign_image'], array('class'=>'control-label')) !!} <br /> 
                          </div>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <div class="fileinput fileinput-new" data-provides="fileinput">
                                  <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                                  <div>
                                      <span class="btn btn-info btn-file waves-effect">
                                          <span class="fileinput-new">Select image</span>
                                          <span class="fileinput-exists">Change</span>
                                          {!! Form::file('campaign_image','', array('required','placeholder'=>$fm_data->labels['campaign_image'],'class'=>'form-control')) !!}
                                      </span>
                                      <a href="#" class="btn btn-danger fileinput-exists waves-effect" data-dismiss="fileinput">Remove</a>
                                  </div>
                              </div>
                              <br>
                              <small><i>Image (upload from PC)</i></small>
                          </div>     
                      </div>
                    @endif
                  
                    @if(!empty($fm_data->labels['url']))
                      <div class="form-group clearfix">
                         {!! Form::label('url', $fm_data->labels['url'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                         <div class="col-md-6 col-sm-6 col-xs-12">
                              {!! Form::text('url','', array('required','placeholder'=>$fm_data->labels['url'],'class'=>'form-control')) !!}
                         </div>    
                      </div>
                    @endif

                    <br >
                    <br >
                    @if (!empty($fm_data->labels['submit']))
                      <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                               <button id="send" type="submit" class="btn btn-round btn-success">{!!$fm_data->labels['save']!!}</button>
                          </div>
                      </div>
                    @endif
            {!! Form::close() !!}
        </div>
    </div>    
    
     <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>Campaigns</h2>
            <a href="{!! route('campaigns.request')  !!}" class="btn  btn-default">Create New</a>
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
                                <th>@if(isset($fm_data->labels['url'])) {!! $fm_data->labels['url'] !!} @else URL @endif</th>
                                <th>@if(isset($fm_data->labels['status'])) {!! $fm_data->labels['status'] !!} @else Status @endif</th>
                                <th>@if(isset($fm_data->labels['action'])) {!! $fm_data->labels['action'] !!} @else Action @endif</th>
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
                                        @if($campaign->status === 'Pending')
                                            <div class="btn btn-primary bgm-red btn-xs waves-effect">{!! $campaign->status !!}</div>
                                        @else 
                                            <div class="btn btn-primary bgm-green btn-xs waves-effect">{!! $campaign->status !!}</div>
                                        @endif
                                    </td>
                                    <td><a href="{!! route('edit.campaigns.request', $campaign->_id)  !!}"><i class='zmdi zmdi-edit zmdi-hc-fw'></i></a></td>
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

<script type="text/javascript">
$(document).ready(function(){
    });
</script>
@endsection

