@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>Business Ecosystem</h2>
<div class="page-top-links">
</div>-->
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

    @include('navigation_tabs.business_ecosystem_tabs') 

    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>Business Ecosystem Edit</h2>
            <a href="{!! route('ecosys.site.index')  !!}" class="btn btn-default">{!!$fm_data->labels['create']!!}</a>
            <a href="{!! route('ecosys.site.indexall')  !!}" class="btn btn-default">{!!$fm_data->labels['view_all']!!}</a>
        </div><!-- .card-header -->
        <div class="card-body card-padding">
            {!! Form::model($business_ecosystem, [
                'method'=>'PUT', 
                'route' =>['ecosys.site.update', $business_ecosystem->id], 
                'class'=>'form-horizontal form-label-left',
                'files'=>true]) 
                !!}
                <div class="form-group clearfix">
                    {!! Form::label('partner sites', 'Partner Sites', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <ul>
                            @for($i=0; $i < count($business_ecosystem->partner_sites); $i++)
                                <li>{!!$business_ecosystem->partner_sites[$i]!!}({!!$partner_company[$i]!!}:-{!!$partner_user[$i]!!})</li>
                            @endfor
                      </ul>
                    </div>    
                </div>
              
                @if (!empty($fm_data->labels))
                    <div class="form-group clearfix">
                        @if(!empty($fm_data->labels['ecomm_company_name']))
                             {!! Form::label('ecomm_company_name', $fm_data->labels['ecomm_company_name'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                            <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('ecomm_company_name', $business_ecosystem->ecomm_company_name, array('required','placeholder' =>$fm_data->labels['ecomm_company_name'],'class'=>'form-control','id'=>'estore_title')) !!}
                            </div>    
                        @endif
                    </div>

                    <div class="form-group clearfix">
                        @if(!empty($fm_data->labels['slug']))
                             {!! Form::label('slug', $fm_data->labels['slug'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                            <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('slug', $business_ecosystem->slug, array('readonly','disabled','placeholder' =>$fm_data->labels['slug'],'class'=>'form-control', 'id'=>'estore_slug')) !!}
                            </div>    
                        @endif
                    </div>

                    <div class="form-group clearfix">
                            @if(!empty($fm_data->labels['email']))
                                 {!! Form::label('email', $fm_data->labels['email'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::email('email', $business_ecosystem->email, array('required','placeholder' =>$fm_data->labels['email'],'class'=>'form-control')) !!}
                                </div>    
                            @endif
                    </div>

                    <div class="form-group clearfix">
                        @if(!empty($fm_data->labels['company']))
                             {!! Form::label('company', $fm_data->labels['company'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                              <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::select('company',$ecom, $business_ecosystem->company, array('required','placeholder' =>'---', 'class'=>'form-control')) !!}
                            </div>    
                        @endif
                    </div>

                    <div class="form-group">
                    @if (!empty($fm_data->labels['submit']))
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                            <!--{!! Form::submit($fm_data->labels['save'], array('class'=>'btn btn-primary btn-success','id'=>"send")) !!}-->
                            {!!HTML::linkRoute('ecomm-index', $fm_data->labels['cancel'], array(), array('class'=>"btn btn-round btn-primary"))!!}
                             <button id="send" type="submit" class="btn btn-round btn-success">{!!$fm_data->labels['save']!!}</button>
                        </div>
                    @endif
                </div>
                @endif
            {!! Form::close() !!}
        </div>
    </div>    
@endsection
@section('footer_add_js_script')
<script type="text/javascript">
$(document).ready(function(){
  @if(empty($business_ecosystem->slug))
    $("#estore_title").keyup(function(){
            var Text = $(this).val();
            Text = Text.toLowerCase();
            Text = Text.replace(/\s/g, '');
              $("#estore_slug").val(Text);
      });  
    @endif
   });
</script>
@endsection
