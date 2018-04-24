@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2> Import Contacts</h2>-->
    <!--<div class="page-top-links">-->
    <!--</div>-->
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

    @include('navigation_tabs.crm_tabs')

     <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>Match Headers</h2>
            <button class="btn btn-default waves-effect" onclick="goBack()">Back</button>
        </div><!-- .card-header -->
        
        {!! Form::open(['route'=>'crm_contacts.save_excel_data', 'method'=>'POST', 'files' => true]) !!}
        
        <input type="hidden" name="filename" id="filename" value="{!! $filename !!}"/>
        
        <div class="card-body card-padding">
            <div class="row">
                @foreach($dbfields as $key=>$fields)
                    @if($key!=='same_as_primary')
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <div class="fg-line">
                                    {!! $fields !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                @if(in_array($fields, $excelheader))
                                    <div class="fg-line">

                                        {!! Form::select("matched_fields[]", $excelheader, $key, array('class'=>'form-control')) !!} 
                                    </div>
                                @else
                                    <div class="fg-line">
                                        {!! Form::select("matched_fields[]", $excelheader, null, array('style'=>'background-color: #82caff','class'=>'form-control','placeholder'=>'Select Field')) !!} 
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="row">
                 <div class="form-group clearfix">
                   <div class="col-md-6 col-md-offset-3">
                       <button id="send" type="submit" class="btn btn-round btn-success process">Save</button>
                       <a href="{!!route('crm_contacts.upload_excel')!!}" class="btn btn-round btn-default process">Cancel</a>
                   </div>
                 </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>    
@endsection

@section('footer_add_js_files') 
      
@endsection       
