@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<h2>Business Sectors</h2>
<div class="page-top-links">
</div>
@endsection

@section('right_col_title_right')

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
        <div class="card-header bgm-blue">
            <h2>BUSINESS SECTORS I’M INTERESTED IN</h2>
        </div><!-- .card-header -->
        
        <div class="card-body card-padding">
           @if (empty($site_info))
                <div class="alert alert-warning">You have no Business Sectors</div>
                <a href="{!! route('business-sectors-create')  !!}" class="btn btn-default">Add Business Sectors</a>   
            @else
           
                
            {!! Form::model($site_info, [
                  'method' => 'PUT',
                  'route' => ['business-sectors-update', $site_info->id],
                  'class' => 'form-horizontal form-label-left',
                  'id'=>'business_sector'
                ]) !!}

              @if (!empty($fm_data->labels))
                  @if(!empty($fm_data->labels['category_name']))
                  
                    @foreach ($selected_cat as $k1=>$top)
                       {!! Form::hidden('cat_names[]',$top,array('id'=>$k1)) !!}
                    @endforeach
                  
                  
                  <div class="form-group clearfix">
                        {!! Form::label('category_name', $fm_data->labels['category_name'].$required, array('class'=>'control-label')) !!} 
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <ul id="ul_data" name='ul_data ' class="sidebar_cats">
                                @foreach ($selected_cat as $k1=>$top)
                                    <li data-cat_id="{!! $k1 !!}" id="{!! $k1 !!}" name='li_sub_data' class="">
                                        <i class="input-helper"></i>
                                         {!! Form::checkbox('category_id[]', $k1, true) !!}                                       
                                         {!! $top !!}
                                    </li>
                                @endforeach
                            </ul>
                            <a href="{!! route('business-sectors-create')  !!}" class="btn btn-default">Add Business Sectors</a>
                        </div>    
                   </div>
                  @endif

                  @if (!empty($fm_data->labels['submit']))
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                             <button id="send" type="submit" class="btn btn-round btn-success">{!!$fm_data->labels['save']!!}</button>
                        </div>
                    </div>
                  @endif
             @endif
            {!! Form::close() !!}
            @endif
        </div>
    </div>   
@endsection
@section('footer_add_js_script')
@endsection

