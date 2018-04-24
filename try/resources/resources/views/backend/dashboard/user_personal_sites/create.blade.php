@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
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
   
    @include('navigation_tabs.personal-site-tabs')
    <div class="card">
        <div class="card-header bgm-blue head-title">
          <h2>{!!$fm_data->labels['create']!!}</h2>
        </div><!-- .card-header -->
        <div class="card-body card-padding">    
          {!! Form::model($fm_data, [
                  'method' => 'POST',
                  'route' => ['create-personal-site-store'],
                  'class' => 'form-horizontal form-label-left',
                  'id'=>'personal_site',
                 'files'=>true
              ]) !!}
              
              {!! Form::hidden('slug','' , array('class'=>'form-control')) !!}
              
              @if (!empty($fm_data->labels))
                  @if(!empty($fm_data->labels['site_name']))
                    <div class="form-group clearfix">
                        {!! Form::label('site_name', $fm_data->labels['site_name'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('site_name','', array('required','placeholder' =>$fm_data->labels['site_name'],'class'=>'form-control', 'id'=>'site_title')) !!}
                       </div>    
                    </div>
                  @endif
                  
                  @if(!empty($fm_data->labels['slug']))
                    <div class="form-group clearfix">
                      {!! Form::label('slug', $fm_data->labels['slug'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('slug','', array('placeholder' =>'','class'=>'form-control', 'id'=>'site_slug')) !!}
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
        </div>
    </div>    
@endsection
@section('footer_add_js_script')

<script type="text/javascript">
    $(document).ready(function(){
      $("#site_title").keyup(function(){
              var Text = $(this).val();
              Text = Text.toLowerCase();
              Text = Text.replace(/\s/g, '');
              $("#site_slug").val(Text);
              $("#slug").val(Text);
        });
   });
</script>
@endsection

