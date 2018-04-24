@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2> Business Ecosystem</h2>-->
@endsection

@section('right_col_title_right')
    <!--<a href="{!! route('ecomm-index')  !!}" class="btn btn-default">{!!$fm_data->labels['view_all']!!}</a>-->
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

    <div class="card">
        <div class="card-header bgm-blue head-title">
          <h2>Business Ecosystem</h2>
        </div><!-- .card-header -->
        <div class="card-body card-padding">    
          {!! Form::open(array('route' => 'ecosys.site.store','method'=>'POST ', 'class'=>'form-horizontal form-label-left', 'files'=>true)) !!}

              {!!Form::hidden('user_id', Auth::user()->id)!!}
                {!!Form::hidden('type', 'business_ecosystem')!!}
                @if(!empty($sitedata))
                      @foreach($sitedata['site_slug'] as $data)
                          {!! Form::hidden('partner_sites[]', $data)!!}
                      @endforeach
                @endif
              @if (!empty($fm_data->labels))
                  <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['ecomm_company_name']))
                           {!! Form::label('ecomm_company_name', $fm_data->labels['ecomm_company_name'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::text('ecomm_company_name', null, array('required','placeholder' =>$fm_data->labels['ecomm_company_name'],'class'=>'form-control','id'=>'estore_title')) !!}
                          </div>    
                      @endif
                  </div>

                  <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['slug']))
                           {!! Form::label('slug', $fm_data->labels['slug'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::text('slug', null, array('required','placeholder' =>$fm_data->labels['slug'],'class'=>'form-control', 'id'=>'estore_slug')) !!}
                          </div>    
                      @endif
                  </div>
                 
              <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['email']))
                           {!! Form::label('email', $fm_data->labels['email'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::email('email', null, array('required','placeholder' =>$fm_data->labels['email'],'class'=>'form-control')) !!}
                          </div>    
                      @endif
              </div>
                 <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['company']))
                           {!! Form::label('company', $fm_data->labels['company'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                            <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::select('company',$ecom, null, array('required','placeholder' =>'---', 'class'=>'form-control')) !!}
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
    $("#estore_title").keyup(function(){
            var Text = $(this).val();
            Text = Text.toLowerCase();
            Text = Text.replace(/\s/g, '');
              $("#estore_slug").val(Text);
      });  
   });
</script>
@endsection
