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
          <h2>{!! $fm_data->labels['competencies'] !!}</h2>
        </div><!-- .card-header -->
        
        
        
        <div class="card-body card-padding">   
            {!! Form::model($fm_data, [
                'method' => 'PUT',
                'route' => ['competencies-update',$id],
                'class' => 'form-label-left',
                'id'=>'competencies',
              ]) !!}
                    
            <div id="CompetenciesGroup" class="form-group text-left">
                 <div class="form-group clearfix">
                    <div class="">
                            <div class="competencies_fields comp_div row">
                                <div class="col-md-3 col-sm-6">
                                    {!! Form::label('competencies', $fm_data->labels['competencies'], array('class'=>'control-label')) !!} 
                                    {!! Form::select('competencies[]', $competency,$values['competencies'], array('multiple', 'required', 'class'=>'selectpicker form-control')) !!}
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    {!! Form::label('short_description', $fm_data->labels['short_description'], array('class'=>'control-label')) !!} 
                                    {!! Form::text('short_description',$values['short_description'], array('placeholder'=>$fm_data->labels['short_description'],'class'=>'form-control')) !!}
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    {!! Form::label('competencies_tags', $fm_data->labels['competencies_tags'], array('class'=>'control-label')) !!} 
                                    {!! Form::text('competencies_tags',$values['competencies_tags'], array('placeholder'=>$fm_data->labels['competencies_tags'],'class'=>'form-control')) !!}
                                </div>
                                <div class=" col-md-3  col-sm-12">
                                    {!! Form::label('extensive_description', $fm_data->labels['extensive_description'], array('class'=>'control-label')) !!} 
                                    {!! Form::textarea('extensive_description',$values['extensive_description'], array('placeholder'=>$fm_data->labels['extensive_description'],'class'=>'form-control')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                                     <button id="send" type="submit" class="btn btn-round btn-success">{!!$fm_data->labels['update']!!}</button>
                                </div>
                            </div>
                    </div>  
                 </div>    
            </div>
   
            {!! Form::close() !!}
        </div>
    </div>    
@endsection
@section('footer_add_js_script')

<script>    
    
//    $(document).bind('DOMNodeInserted', function(e) {
//        console.log("Hello");
//        var element = e.target;
//        element.find('.selectpicker').each(function(){  
//            var $selectpicker = $(this);
//            Plugin.call($selectpicker, $selectpicker.data());
//        });
//    });
    
    $( document ).ready(function() {
        $('div').on( "click", '.add_competency', function(e){
            e.preventDefault();
            var newTextBoxDiv = $(document.createElement('div')).attr("class","comptencies_fields_copy comp_div");
            newTextBoxDiv.html( $(".competencies_fields").html() );
            newTextBoxDiv.append('<div class="col-md-2 col-sm-2 col-xs-6"><a href="" class="remove_comp"></a></div>');
            
//            newTextBoxDiv.find('.selectpicker').each(function(){  
//                var $selectpicker = $(this);
//                Plugin.call($selectpicker, $selectpicker.data());
//            });
            
            newTextBoxDiv.appendTo(".more_competencies");
                return false;
            });
        
        $('div').on( "click", '.remove_comp', function(e){
            e.preventDefault();
            $(this).closest('.comptencies_fields_copy').remove();
            return false;

        });
        
        $('div').on( "click", '.remove_competency', function(e){
                e.preventDefault(); 
                var div_lang= $('.comp_div').length;
                if(div_lang===1){
                   swal("You can not delete this Competency!");
                }
                else{
                    $(this).parent().parent().remove();
                }
                return false;
            });
        
    });    
</script>
@endsection
