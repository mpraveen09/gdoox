@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2> Business Ecosystem</h2>-->
<!--<div class="page-top-links">-->
<!--</div>-->
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
    
    @include('navigation_tabs.business_ecosystem_tabs')   
    
        <div class="card">
            <div class="card-header bgm-blue head-title">
                    <h2>Business Ecosystem</h2>
                    <a href="{!! route('ecosys.site.index')  !!}" class="btn btn-default">Create New</a>
                    <a href="{!! route('ecosys.site.indexall')  !!}" class="btn btn-default">View All</a>
            </div><!-- .card-header -->
            <div class="card-body card-padding">
                @if(!$business_ecosystem->count())
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        You don't have any business ecosystem 
                    </div>    
                @else

                <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                    <table class="table table-striped responsive-utilities jambo_table ">
                         <thead>
                             <tr>
                                 <th>Business Ecosystem</th>
                                 <th>Business Company</th>
                                 <th>Ecosystem Email</th>
                                 <th>Ecosystem Partners/Members</th>
                                 <th>Action</th>
                             </tr>
                         </thead>
                         <tbody>
                            @foreach($business_ecosystem as $ecosystem )
                               <tr>
                                      <td><a href="{{ URL::to('/site/') }}/{!! $ecosystem->slug!!}">{!! $ecosystem->ecomm_company_name!!}</a> </td>
                                      <td>{!! $ecosystem->company!!}</td>
                                      <td>{!! $ecosystem->email!!}</td>
                                      <td><a href="{!! route('ecomm-index')!!}">View Partners</a></td>
                                      <td>
                                          <a href="{!!route('ecosys.site.show', $ecosystem->id)!!}" data-toggle="tooltip" data-placement="bottom" title="View" ><i class='zmdi zmdi-eye zmdi-hc-fw'></i></a> &nbsp; 
                                          <a href="{!!route('ecosys.site.edit', $ecosystem->id)!!}" data-toggle="tooltip" data-placement="bottom" title="Edit" ><i class='zmdi zmdi-edit zmdi-hc-fw'></i></a>
                                          <a href="{!!route('ecosys.site.add', $ecosystem->id)!!}" data-toggle="tooltip" data-placement="bottom" title="Add Site" ><i class='zmdi zmdi-upload zmdi-hc-fw'></i></a>                        
                                      </td>
                               </tr>  
                            @endforeach
                         </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="text-right col-md-12">
                        {!! $business_ecosystem->render() !!}
                    </div>
                </div>    
            </div><!-- .card-body -->
        </div><!-- .card -->
    @endif
@endsection