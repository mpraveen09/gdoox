@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>{!! $fm_data->labels['title'] !!}</h2>-->
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
          <h2>{!! $fm_data->labels['sponsors'] !!}</h2>
        </div><!-- .card-header -->
        <div class="card-body card-padding">   
            {!! Form::model($fm_data, [
                  'method' => 'POST',
                  'route' => ['sponsors-store'],
                  'class' => 'form-label-left',
                  'id'=>'sponsors',
              ]) !!}
                    
              
                    @if(!empty($fm_data->labels))
                        <div id="ReferencesGroup" class="form-group text-left">
                             <div class="form-group clearfix">
                                <div class=""> 
                                    <div class="sponsors_fields ref_div row">    
                                        <div class="col-md-4 col-sm-6">
                                            {!! Form::label('name', $fm_data->labels['name'], array('class'=>'control-label')) !!} 
                                            {!! Form::text('name[]','', array('required','placeholder'=>$fm_data->labels['name'],'class'=>'form-control')) !!} 
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            {!! Form::label('surname', $fm_data->labels['surname'], array('class'=>'control-label')) !!} 
                                            {!! Form::text('surname[]','', array('required','placeholder'=>$fm_data->labels['surname'],'class'=>'form-control')) !!}
                                        </div>
                                        <div class=" col-md-4  col-sm-6">
                                            {!! Form::label('email_address', $fm_data->labels['email_address'], array('class'=>'control-label')) !!} 
                                            {!! Form::text('email_address[]','', array('required','placeholder'=>$fm_data->labels['email_address'],'class'=>'form-control')) !!}
                                        </div>
                                    </div>
                                   
                                    <div class="more_sponsors"></div>
                                    
                                    <div class="col-md-12">
                                        <br/>
                                        <button type="button" class="btn btn-round btn-primary add_sponsors">{!!$fm_data->labels['add']!!}</button>
                                    </div>
                                </div>  
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
            {!! Form::close() !!}
        </div>
    </div>    
@endsection
@section('footer_add_js_script')

<script>    
    $( document ).ready(function() {
        $('div').on( "click", '.add_sponsors', function(e){
            e.preventDefault();

            var newTextBoxDiv = $(document.createElement('div')).attr("class","sponsors_fields_copy row");
            newTextBoxDiv.html( $(".sponsors_fields").html() );
            newTextBoxDiv.append('<div class="col-md-12 "><a href="" class="remove_sponsors"><i class="zmdi zmdi-delete zmdi-hc-fw"></i></a><br/><hr/><br/></div>');
            newTextBoxDiv.appendTo(".more_sponsors");
            return false;
        });
        
        $('div').on( "click", '.remove_sponsors', function(e){
            e.preventDefault();
            $(this).closest('.sponsors_fields_copy').remove();
            return false;

        });
        
        $('div').on( "click", '.remove_sponsors', function(e){
                e.preventDefault(); 
                var div_lang= $('.ref_div').length;
                if(div_lang===1){
                   swal("You can not delete this Referene!");
                }
                else{
                    $(this).parent().parent().remove();
                }
                return false;
        });
        
    });    
</script>
@endsection
