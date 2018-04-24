@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2> Business Ecosystem</h2>-->
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
    @if (HTML::ul($errors->all()))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!! HTML::ul($errors->all()) !!}
        </div>
    @endif
    
    @include('navigation_tabs.network_tabs')
    
    <div class="card">
	<div class="card-header bgm-blue head-title">
            <h2>Share Site <span>(Please select the inviter/partner from below select box to share your site.)</span></h2>
	</div><!-- .card-header -->
        
	<div class="card-body card-padding">
        @if(!$partnerusers->count())
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                You don't have any network invitation for sharing site or you have not accepted invitation or you have not any site.
            </div>    
        @else
              {!! Form::open(['route'=>'network.share.site.store']) !!}
                @if(isset($request_type))
                    {!! Form::hidden('request_type', $request_type) !!}
                @endif
                    {!! Form::hidden('inviter_id', $inviter_id) !!}
                    {!! Form::hidden('invitee_id', $invitee_id) !!}
                    <div class="form-group clearfix">
                        {!! Form::label('inviter_company', 'Select Partner Company'.$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::select('inviter_company', $inviter_companies, null, array('required','class'=>'form-control')) !!}
                        </div>    
                    </div>
                
<!--                <div class="form-group clearfix">
                        {!! Form::label('message', 'Message(Reason to Share Product)', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('message','', array('required','class'=>'form-control')) !!}
                        </div>    
                    </div>-->

                    <div class="form-group"><span>(Please choose any site from below options to share site with network inviter/partner)</span></div>
                    
                    <div class="form-group clearfix">
                        {!! Form::label('site_name', 'Choose Your Site For Sharing'.$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                       <div class="col-md-6 col-sm-6 col-xs-12">
                         @foreach($e_sites as $esite)
                            {!! Form::radio('siteslug', $esite['slug'], true) !!} {!! Form::label($esite['ecomm_company_name'],$esite['ecomm_company_name']) !!} <br/>
                         @endforeach   
                       </div>
                    </div>
                    
                    <div class="form-group clearfix">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                            <button id="send" type="submit" class="btn btn-round btn-success">Share</button>
                        </div>
                    </div>
              {!!Form::close()!!}      
        @endif
        </div><!-- .card-body -->
  </div><!-- .card -->
  <div class="card">
	<div class="card-header bgm-blue">
            <h2>Shared Sites <span>(You can un-share site or share products for shared site from listed below shared sites )</span></h2>
	</div><!-- .card-header -->
	<div class="card-body card-padding">
        @if( !$sharesites->count())
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                You have not shared any site or you don't have any request.
            </div>    
        @else
            <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
               <table class="table table-striped responsive-utilities jambo_table ">
                   <thead>
                       <tr>
                           <th>E-commerce Site Slug</th>
                           <th>Business Company Name</th>
                           <th>Shared With</th>
                           <th>Action</th>
                       </tr>
                   </thead>
                   <tbody>   
                        @foreach($sites as $site)
                          <tr>
                              <td><a href="">{!!$site->siteslug!!}</a></td>
                              <td>{!!$site->company_name !!}</td>
                              <td>{!! $site->share_with!!}</td>
                              <td>
                                  <a href="{!! route('network.share.site.update', $site->siteslug)  !!}" class="btn btn-default">UnShare</a> &nbsp; 
                                  <a href="{!! route('list_my_site_products', [$site->siteslug, $inviter_id])  !!}" class="btn btn-default">Share Products</a> &nbsp; 
                              </td>
                          </tr>
                        @endforeach
                    </tbody>
               </table>
             </div>
      @endif
    </div>
  </div>
@endsection