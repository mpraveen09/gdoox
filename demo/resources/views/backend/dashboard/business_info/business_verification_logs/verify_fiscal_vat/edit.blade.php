@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>{!!$fm_data->labels['form_title']!!}</h2>-->
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

    <div class="card">
        <div class="card-header bgm-blue head-title">
          <h2>{!!$fm_data->labels['heading']!!}</h2>
          <button class="btn btn-default" onclick="goBack()">Go Back</button>
        </div><!-- .card-header -->
        <div class="card-body card-padding">    
          {!! Form::model($company, [
                  'method' => 'PUT',
                  'route' => ['verify-fiscalvat-update', $company->id],
                  'class' => 'form-horizontal form-label-left',
                 'files'=>true
              ]) !!}
          {!!Form::hidden('user_id', Auth::user()->id)!!}
          {!!Form::hidden('company_id', $company->_id)!!}

          @if (!empty($fm_data->labels))
                <div class="form-group clearfix">
                    @if(!empty($fm_data->labels['label1']))
                         {!! Form::label('company_name', $fm_data->labels['label1'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
 
                         <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('company_name', $company->company_name, array('required', 'class'=>'form-control')) !!}
                        </div>    
                    @endif
                </div>
               
              <div class="form-group clearfix">
                    @if(!empty($fm_data->labels['label2']))
                         {!! Form::label('vat_fisca_idl', $fm_data->labels['label2'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
  
                         <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('vat_fiscal_id', null, array('required','placeholder' =>$fm_data->labels['label2'],'class'=>'form-control')) !!}
                        </div>    
                    @endif
                </div>

                <div class="form-group">
                      @if (!empty($fm_data->labels['submit']))
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                              {!!HTML::linkRoute('business-info-index', $fm_data->labels['cancel'], array(), array('class'=>"btn btn-round btn-primary"))!!}
                               <button id="send" type="submit" class="btn btn-round btn-success" name="verify_vat_fiscal">{!!$fm_data->labels['submit']!!}</button>
                          </div>
                      @endif
                  </div>
                 @endif
            {!! Form::close() !!}
        </div>
    </div>    
@endsection

@section('footer_add_js_script')
    <script>
        $(document).ready(function(){
            $('#company_name').on('change', function() {
                  var company_name=$("#company_name ").val();   
                 // alert(company);
                  var $post={};
                  $post.company_name=company_name;
                  $.ajax({
                    type:'POST',
                    url: "{!! URL::route('fetchcountry')  !!}",
                    data: $post,
                    cache: false,
                    success: function(data){
                         // alert(data.data);
                         var $country=data.data;
                          $('#country').html( '{!! Form::label("country", $fm_data->labels["label4"], array("class"=>"control-label col-md-3 col-sm-3 col-xs-12")) !!} '+
                                                                 '<div class="col-md-6 col-sm-6 col-xs-12">'+
                                                                '<input type="text" name="country" value="'+$country+'" class="form-control")) !!}'+
                                                                '</div>')
                    },
                    error:function(data){
                       //console.log(data.data);
                       alert('There is an error: '+data.data);
                    }

                  });
             });
          });
    </script>
    <script>
      function goBack() {
          window.history.back();
      }
    </script>
@endsection
