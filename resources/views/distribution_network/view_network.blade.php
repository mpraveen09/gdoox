@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--    <h2>Distribution Network</h2>
    <div class="page-top-links">
    </div>-->
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
            <h2>
                   {!! $type !!}
            </h2>
            <button onclick="goBack()" class="btn btn-default waves-effect">Back</button>
        </div><!-- .card-header -->
        
            @if ( !$networks->count())
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    You have no Network
                </div>                 
            @else
            
                <div class="card-body card-padding">
                    <div class="row">
                        {!! Form::model($networks, [
                            'method' => 'GET',
                            'route' => ['search_network'],
                            'class' => 'form-horizontal form-label-left',
                            'novalidate'=>''
                        ]) !!}
                            
                            {!! Form::hidden('type',$type,array('id'=>'type')) !!}
                            
                            <div class="col-md-4 col-sm-4 col-xs-10  form-group top_search" style="padding: 20px 0; margin-left: 0px;">
                                <div class="input-group">
                                    {!! Form::text('term',$term, array('required','placeholder'=>'Search...','class'=>'searchnetwork form-control'))!!}
                                    <span class="input-group-btn">
                                        <button class="btn btn-default btn-icon-text waves-effect"><i class="zmdi zmdi-search"></i></button>
                                    </span>                          
                                </div>
                            </div>
                            
                        {!! Form::close() !!}
                        
                        <div class="text-right col-md-8">
                                {!! $networks->appends(['term' => $term])->render() !!}
                        </div>
                    </div>
                    
                      <table class="table">
                            <thead>
                                  <th>Name</th>
                                  <th>Work Location</th>
                                  <th>Region</th>
                                  <th>Email</th>
                                  <th>Phone</th>
                                  <th>Action</th>
                            </thead>

                            <tbody>
                                 @foreach($networks as $network)
                                  <tr>
                                      <td>
                                         @if(!empty($network->first_name))
                                              {!! $network->first_name !!} {!! $network->last_name !!}
                                         @else
                                              {!! $network->company_name !!} {!! $network->company_name !!}
                                         @endif
                                      </td>
                                      <td>
                                         @if(!empty($network->country_of_work))
                                              {!! $network->country_of_work !!}
                                         @endif
                                      </td>
                                      <td>
                                         @if(!empty($network->region))
                                              {!! $network->region !!}
                                         @endif
                                      </td>
                                      <td>
                                         @if(!empty($network->business_email))
                                              {!! $network->business_email !!}
                                         @endif
                                      </td>
                                      <td>
                                         @if(!empty($network->business_phone))
                                              {!! $network->business_phone !!}
                                         @endif
                                      </td>
                                      <td>
                                          <a href="{!! route('distributionnetwork.edit', $network->_id)  !!}"><i class='zmdi zmdi-eye zmdi-hc-fw'></i></a> &nbsp; 
                                          <a href="{!! route('distributionnetwork.show', $network->_id)  !!}"><i class='zmdi zmdi-edit zmdi-hc-fw'></i></a>
                                      </td>
                                  </tr>
                                @endforeach
                            </tbody>
                          </table>
                    </div>
            
                    <div class="text-right col-md-12">
                        {!! $networks->appends(['term' => $term])->render() !!}             
                    </div>
        </div>
        @endif 
   
@endsection

@section('footer_add_js_script')
<style>
    .ui-menu-item{
        width: 300px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;        
        font-size: 11px;
    }   
    .ui-widget-content{
        max-height: 400px;
        overflow: scroll;
    }
</style>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script type='text/javascript'>
function goBack() {
    window.history.back();
}

jQuery(function($) {
        $(".searchnetwork").autocomplete({
            source: function( request, response ) {   
                $.ajax({
                    url: "{!! URL::route('auto_search_network')  !!}",
                    dataType: "json",
                    data: {
                            term: request.term,
                    },
                    success: function(json) {
                        response( $.map( json, function( item ) {
                            return {
                                value: item.name
                            }
                        }));
                    }
                });
            },
            autoFocus: true,
            minLength: 3,
            });
        });
</script>
@endsection