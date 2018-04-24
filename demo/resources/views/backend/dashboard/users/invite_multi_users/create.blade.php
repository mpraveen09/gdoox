@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>  {!!$fm_data->labels['form_title']!!}</h2>-->
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
@endif

    @include('navigation_tabs.general_tabs')

    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>  {!!$fm_data->labels['heading']!!}</h2>
        </div><!-- .card-header -->
        <div class="card-body card-padding">    
            {!! Form::open(array(
                'route' => 'invite-multi-user-store',
                'method'=>'POST', 
                'class'=>'form-horizontal form-label-left',
                'name'=>'invite_users',
                'enctype'=>'multipart/form-data',
                'files'=>true)) 
            !!}
                @if (!empty($fm_data->labels))
                    <div class="row">
                        <div class="col-sm-12">
                            {!! Form::label('file',$fm_data->labels['browse'], array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12"))!!}
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <span class="btn btn-primary btn-file m-r-10">
                                    <span class="fileinput-new">{!!$fm_data->labels['browse']!!}</span>
                                    <span class="fileinput-exists">{!!$fm_data->labels['change']!!}</span>
                                    {!! Form::file('excelfile') !!}
                                </span>
                                <span class="fileinput-filename"></span>
                                <a href="#" class="close fileinput-exists" data-dismiss="fileinput">&times;</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                         <div class="radio col-sm-12">
                           {!! Form::label('confirm',$fm_data->labels['check_code'], array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12"))!!}
                             <label>
                                {!! Form::radio('confirm', 1, true)!!}
                                 <i class="input-helper"></i>
                                 Yes
                             </label>
                            <label>
                                {!! Form::radio('confirm', 0, true)!!}
                                 <i class="input-helper"></i>
                                 No
                             </label>
                          </div>
                        <br />
                    </div>
                <div class="row" id="promo_code_div" style="display: none;">
                        <div class="col-sm-12 col-md-12">
                            {!! Form::label('',$fm_data->labels['discount'], array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12"))!!}
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                {!! Form::label('mono_ac_percentage','Monosite Mono Account', array("style"=>"text-align:left","class"=>"control-label col-md-4 col-sm-4 col-xs-12"))!!}
                                <div class="col-md-5 col-sm-5 col-xs-12">
                                        {!! Form::text('mono_ac_percentage', null ,array('placeholder'=>'Discount %','class'=>'form-control')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            {!! Form::label('',"", array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12"))!!}
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                {!! Form::label('multi_ac_percentage','Monosite Multi Account', array("style"=>"text-align:left","class"=>"control-label col-md-4 col-sm-4 col-xs-12"))!!}
                                <div class="col-md-5 col-sm-5 col-xs-12">
                                        {!! Form::text('multi_ac_percentage', null ,array('placeholder'=>'Discount %','class'=>'form-control')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            {!! Form::label('',"", array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12"))!!}
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                {!! Form::label('com_net_percentage','Company Network', array("style"=>"text-align:left","class"=>"control-label col-md-4 col-sm-4 col-xs-12"))!!}
                                <div class="col-md-5 col-sm-5 col-xs-12">
                                        {!! Form::text('com_net_percentage', null ,array('placeholder'=>'Discount %','class'=>'form-control')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            {!! Form::label('',"", array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12"))!!}
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                {!! Form::label('business_eco_pecentage','Business Ecosystem', array("style"=>"text-align:left","class"=>"control-label col-md-4 col-sm-4 col-xs-12"))!!}
                                <div class="col-md-5 col-sm-5 col-xs-12">
                                        {!! Form::text('business_eco_pecentage', null ,array('placeholder'=>'Discount %','class'=>'form-control')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="form-group">
                        @if (!empty($fm_data->labels['submit']))
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                {!!HTML::linkRoute('dashboard-index', $fm_data->labels['cancel'], array(), array('class'=>"btn btn-round btn-primary"))!!}
                                  <button id="send" type="submit" class="btn btn-round btn-success">{!!$fm_data->labels['button']!!}</button>
                            </div>
                        @endif
                    </div>
                @endif
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('footer_add_js_files') 
        <script src="{{ asset('/m-admin-ui/vendors/fileinput/fileinput.min.js') }}"></script>
        <script src="{{ asset('/m-admin-ui/vendors/input-mask/input-mask.min.js') }}"></script>
@endsection

@section('footer_add_js_script')
<script type="text/javascript">
    $('input[type="radio"]').on('click change', function(e) {
        var flag = $(this).val();
        if(flag === '1'){
            $('#promo_code_div').show();
        } 
        else {
            $('#promo_code_div').hide();
        }
    });
</script>
@endsection