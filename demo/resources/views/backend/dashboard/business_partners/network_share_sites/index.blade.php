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
	<div class="card-header bgm-blue">
            <h2>Shared Sites <span>(You can un-share site or share products for shared site from listed below shared sites )</span></h2>
	</div><!-- .card-header -->
	<div class="card-body card-padding">
        @if( !$partnerusers->count())
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
                           <th>Email</th>
                           <th>Action</th>
                       </tr>
                   </thead> 
                   <tbody>   
                        @foreach($partnerusers as $site)
                          <tr>
                              <td>{!! $site->company_site_slug !!}</td>
                              <td>{!! $site->company_name !!}</td>
                              <td>
                                  @if(!empty($companies))
                                    @if(array_key_exists($site->inviter_id, $companies))
                                        {!! $companies[$site->inviter_id] !!}
                                    @else 
                                        N/A
                                    @endif
                                  @endif
                              </td>
                              <td>{!! $site->inviter_email!!}</td>
                              <td>
                                    <a href="{!! route('network.share.site.update', $site->company_site_slug)  !!}" class="btn btn-primary btn-xs waves-effect">UnShare</a> &nbsp;
                                    <a href="{!! route('list_my_site_products', [$site->company_site_slug, $site->inviter_id])  !!}" class="btn bgm-green btn-xs waves-effect">Share Products</a> &nbsp; 
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