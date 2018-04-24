@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<h2>Company Network</h2>
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
    
    <div class="card">
        <div class="card-body card-padding">
            <a href="#companies" class="btn btn-primary waves-effect">Invite to Another Company Network.</a>
        </div>
    </div>
@endif

@include('navigation_tabs.network_tabs')

<div class="card">
    <div class="card-header bgm-blue">
        <h2>Invite Partner</h2>
    </div><!-- .card-header -->
      {!! Form::open(array('route' => 'company.network.invite.create','method'=>'GET', 'class'=>'form-horizontal form-label-left')) !!}
        {!! Form::hidden('term','search') !!}
        <div class="card-body card-padding">
            <div class="row">           
                <div class="col-sm-6">
                    <p class="c-black f-500 m-b-20">Enter Search Term</p>
                    <div class="form-group">
                        {!! Form::text('keyword', $search_val ,array('placeholder'=>'Search Keyword','id'=>'keyword',"required",'class'=>'form-control')) !!}
                    </div>
                </div>

                <div class="col-sm-6">
                    <p class="c-black f-500 m-b-20">Filter Your Search</p>
                    <div class="form-group">
                        <div class="fg-line">
                            <div class="select">
                                {!! Form::select('filter', $category, 'all', ['required','class' => 'form-control','id'=>'filter']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group clearfix">      
                <button class="btn btn-primary waves-effect">Search</button>
            </div>
        </div>
        {!! Form::close()!!}
</div>


<?php $i = 1; ?>
@if($term =='search')
<div class="card" id="companies">
        <div class="card-header bgm-blue">
            <h2></h2>
        </div><!-- .card-header -->
        
        <div class="card-body">
            @if ( !$business_info->count() )
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                No business found matching the Search Criteria.
            </div>
            @else
            <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                <table class="table table-striped responsive-utilities jambo_table ">
                    <thead>
                        <tr>
                            <th>Company Name</th>
                            <th>Company Site(s)</th>
                            <th>Country</th>
                            <th>Type</th>
                            <th>Request</th>
                        </tr>
                    </thead>
                    <tbody>    
                    @foreach( $business_info as $business )
                        <tr <?php if($i%2==0){?> style="background-color:#E6E6E6" <?php } else { } ?>>
                            <td>{!!$business->company_name!!} </td>
                            <td id="ecom_slug">
                                <table>
                                    @if($business['relations']['searchstore'])
                                        @foreach($business['relations']['searchstore'] as $val)
                                        <tr <?php if($i%2==0){?> style="background-color:#E6E6E6" <?php } else { } ?>>
                                            <td>
                                                <div class="radio m-b-15">
                                                    <label>
                                                        <input type="radio" name="sample" class="comp_site_slug" required value="{!! $val->slug !!}">
                                                        <i class="input-helper"></i>
                                                        {!! $val->slug !!}
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                        Not Available
                                    @endif
                                </table>
                            </td>
                            <td>{!! $business->country!!}</td>
                            <td>{!! $business->actvity_type!!}</td>
                            <td>
                                {!! Form::open(array('route' => 'company.network.invite.create','method'=>'GET', 'class'=>'form_invite form-horizontal form-label-left')) !!}
                                    {!! Form::hidden('user_id',$business->user_id) !!}
                                    {!! Form::hidden('company_name',$business->company_name) !!}
                                    {!! Form::hidden('keyword',$search_val) !!}
                                    {!! Form::hidden('term','invite') !!}
                                    {!! Form::hidden('com_site_slug', '', array('class' => 'com_site_slug')) !!}
                                    @if(count($business['relations']['searchstore'])!==0)
                                        <button type="submit" id="btn_invite" class="btn bgm-green btn-round btn-default waves-effect">Invite</button>
                                    @else
                                        <button type="submit" disabled class="btn btn-round btn-default waves-effect">Invite</button>
                                    @endif
                                {!! Form::close()!!}
                            </td>
                        </tr>
                        <?php $i++; ?>
                    @endforeach
                        <tr>
                          <td><br/><br/><br/></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                    </tbody>
                </table>

                </div>

            <div class="row">
                <div class="text-right col-md-12">
                    {!! $business_info->render() !!}
                </div>
            </div>    
            @endif
        </div><!-- .card-body -->
    </div>
    @elseif($term=='invite')
        <div class="card">
            <div class="card-header bgm-blue">
                <h2>Invite</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                    {!! Form::open([
                        'method' => 'GET',
                        'route' => 'company.network.store',
                        'class' => 'form-horizontal form-label-left'
                    ]) !!}
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::hidden('user_id',$user_id) !!}
                                {!! Form::hidden('company_site_slug',$company_site_slug) !!}
                            </div>
                        </div>
                        <div class="item form-group">
                            {!! Form::label('company_name','Company Name', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                               {!! Form::text('company_name',$company_name, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                        </div>
                    
                        <div class="item form-group">
                            {!! Form::label('message','Message(Reason to Work Together)', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                               {!! Form::text('message', '', ['class' => 'form-control', 'required']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                             <div class="col-md-6 col-md-offset-5">
                                <button id="invite" type="submit" class="btn btn-round btn-success">Invite</button>
                             </div>
                        </div>
                    {!! Form::close()!!}
                </div> 
            </div>
        </div>
    @endif
@endsection

@section('footer_add_js_script')

<script type="text/javascript">
    $(function() {
        $('.view_cat').click(function() {
            var ref = $(this);
            var comp_slug = $(this).attr('data-com_name');
            $.ajax({
                url: "{!! URL::route('fetch_comsite_cat') !!}",
                data: {
                    comp_slug : comp_slug
                },
                success: function(data) {
                        ref.parent().parent('tr').children('#ecom_name').children('#ecom_cat').html("");
                        ref.parent().parent('tr').children('#ecom_name').children('#ecom_cat').append(data);
                    }
                });
            });
            
            $('.comp_site_slug').click(function() {
                var site = $(this).val();
                $(".com_site_slug").val(site);
            });
            
            $(".form_invite").submit(function( event ) {
                var com_site_slug = $(this).children('.com_site_slug').val();
                if(com_site_slug===''){
                    swal('Please Select the Company Site to send the Invitation');
                    return false; 
                }
                else {
                    return true;
                }
            });
            
            $('#ecosystem_slug').change(function() {
                var slug = $('option:selected',this).text(); 
                $("#ecosystem_name").val(slug);
            });

    });
</script>
@endsection
 