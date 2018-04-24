@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>Business Ecommerce Site</h2>-->
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

@include('navigation_tabs.general_tabs')

    <div class="card">
	<div class="card-header bgm-blue head-title">
		<h2>Social Links</h2>
	</div><!-- .card-header -->
	<div class="card-body">
            @if(!$sites->count())
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    You have no site listed
                </div>    
            @else
                <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                     <table class="table table-striped responsive-utilities jambo_table ">
                         <thead>
                             <tr>
                                 <th>Site Name</th>
                                 <th>Site Slug</th>
                                 <th>Action</th>
                                 <th>Social Links</th>
                             </tr>
                         </thead>
                         <tbody>    
                         @foreach($sites as $site)
                             <tr>
                                 <td>{!!  $site->ecomm_company_name!!}</td>
                                 <td>{!! $site->slug!!}</td>
                                 <td>
                                   <a href="{!!route('sociallink.index',[ 'site_slug' => $site->slug]) !!}" data-toggle="tooltip" data-placement="bottom" title="select" class="btn btn-default">Add/Edit</a> &nbsp;
                                 </td>
                                 <td>
                                  @foreach($social_links as $social_link)
                                   @if(!empty($social_link->sociallinks))
                                   @if($social_link->slug == $site->slug)
                                     <div class="social-link-wrapper text-justify">
                                         @if($social_link->sociallinks['facebook'])
                                         <a href="{!!$social_link->sociallinks['facebook']!!}" target="_blank" data-toggle="tooltip" data-placement="bottom" title="{!!$social_link->sociallinks['facebook']!!}" ><i class="zmdi zmdi-facebook-box zmdi-hc-fw"></i></a>
                                         @endif
                                         @if($social_link->sociallinks['twitter'])
                                         <a href="{!!$social_link->sociallinks['twitter']!!}" target="_blank" data-toggle="tooltip" data-placement="bottom" title="{!!$social_link->sociallinks['twitter']!!}" ><i class="zmdi zmdi-twitter-box zmdi-hc-fw"></i></a>
                                         @endif
                                         @if($social_link->sociallinks['google_plus'])
                                         <a href="{!!$social_link->sociallinks['google_plus']!!}" target="_blank" data-toggle="tooltip" data-placement="bottom" title="{!!$social_link->sociallinks['google_plus']!!}" ><i class="zmdi zmdi-google-plus-box zmdi-hc-fw"></i></a>
                                         @endif
                                         @if($social_link->sociallinks['linkedin'])
                                         <a href="{!!$social_link->sociallinks['linkedin']!!}" target="_blank" data-toggle="tooltip" data-placement="bottom" title="{!!$social_link->sociallinks['linkedin']!!}" ><i class="zmdi zmdi-linkedin-box zmdi-hc-fw"></i></a>
                                         @endif
                                         @if($social_link->sociallinks['pinterest'])
                                         <a href="{!!$social_link->sociallinks['pinterest']!!}" target="_blank" data-toggle="tooltip" data-placement="bottom" title="{!!$social_link->sociallinks['pinterest']!!}" ><i class="zmdi zmdi-pinterest-box zmdi-hc-fw"></i></a>
                                         @endif
                                     </div>
                                   @endif
                                   @endif
                                   @endforeach
                                 </td>
                             </tr>  
                         @endforeach

                         </tbody>
                     </table>
                </div>
            @endif
    </div><!-- .card-body -->
    </div><!-- .card -->
    @if($term == 1)
       <div class="card">
            <div class="card-header bgm-blue">
              <h2>Add Social Links</h2>
            </div><!-- .card-header -->
            <div class="card-header bgm-amber">
                <h2> {!!  $site_name !!}</h2>
            </div>           
            <div class="card-body card-padding">    
            {!! Form::open(array('route' => 'sociallink.store','method'=>'POST', 'class'=>'form-horizontal form-label-left')) !!}
                @if (!empty($fm_data->labels))
                     <div class="form-group clearfix">
                          @if(!empty($fm_data->labels['facebook']))
                               {!! Form::label('facebook', $fm_data->labels['facebook'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}                        
                               <div class="col-md-6 col-sm-6 col-xs-12">
                              {!! Form::text('facebook', $social->sociallinks['facebook'], array('placeholder' =>$fm_data->labels['facebook'],'class'=>'form-control')) !!}
                              </div>    
                          @endif
                      </div>
                      {!!Form::hidden('site_slug', $site_slug)!!}
                     <div class="form-group clearfix">
                          @if(!empty($fm_data->labels['linkedin']))
                               {!! Form::label('linkedin', $fm_data->labels['linkedin'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                               <div class="col-md-6 col-sm-6 col-xs-12">
                              {!! Form::text('linkedin', $social->sociallinks['linkedin'], array('placeholder' =>$fm_data->labels['linkedin'],'class'=>'form-control')) !!}
                              </div>    
                          @endif
                      </div>

                     <div class="form-group clearfix">
                          @if(!empty($fm_data->labels['twitter']))
                               {!! Form::label('twitter', $fm_data->labels['twitter'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 

                               <div class="col-md-6 col-sm-6 col-xs-12">
                              {!! Form::text('twitter', $social->sociallinks['twitter'], array('placeholder' =>$fm_data->labels['twitter'],'class'=>'form-control')) !!}
                              </div>    
                          @endif
                      </div>

                     <div class="form-group clearfix">
                          @if(!empty($fm_data->labels['pinterest']))
                               {!! Form::label('pinterest', $fm_data->labels['pinterest'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 

                               <div class="col-md-6 col-sm-6 col-xs-12">
                              {!! Form::text('pinterest', $social->sociallinks['pinterest'], array('placeholder' =>$fm_data->labels['pinterest'],'class'=>'form-control')) !!}
                              </div>    
                          @endif
                      </div>

                     <div class="form-group clearfix">
                          @if(!empty($fm_data->labels['google']))
                               {!! Form::label('google', $fm_data->labels['google'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 

                               <div class="col-md-6 col-sm-6 col-xs-12">
                              {!! Form::text('google_plus', $social->sociallinks['google_plus'], array('placeholder' =>$fm_data->labels['google'],'class'=>'form-control')) !!}
                              </div>    
                          @endif
                      </div>


                  <div class="form-group">
                      @if (!empty($fm_data->labels['submit']))
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                              {!!HTML::linkRoute('sociallink.index', $fm_data->labels['cancel'], array(), array('class'=>"btn btn-round btn-primary"))!!}
                              <button id="send" type="submit" class="btn btn-round btn-success">{!!$fm_data->labels['save']!!}</button>
                          </div>
                      @endif
                  </div>
                 @endif
            {!! Form::close() !!}
          </div>
       </div> 
    @endif
@endsection