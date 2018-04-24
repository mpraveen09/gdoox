@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>  {!!$fm_data->labels['form_title']!!}</h2>-->
@endsection

@section('right_col_title_right')

@section('header_add_js_script')        
<!--<script type="text/javascript">
$(document).ready(function(){
    $("input[type=radio]:last").bind('click',function(){
          var text_box=$('{!!Form::text('posiiton', null,array('placeholder' =>'Other Position','class'=>'form-control'))!!}');
          $(this).after(text_box);
     });
});
</script>-->
@endsection

@section('right_col')

    @if (Session::has('message'))
        <div class="alert alert-info">{!!  Session::get('message')  !!}</div>
    @endif
    
    @include('navigation_tabs.personal_profile_tabs')
    
   <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>{!!$fm_data->labels['create']!!}</h2>
            <a href="{!! route('dashboard-index')  !!}" type="submit" class="btn btn-default"><i class='zmdi zmdi-home'></i></a>
        </div><!-- .card-header -->
        <div class="card-body card-padding">    
            @if($errors->any())
              <ul class="parsley-errors-list filled text-center">
                    {!! implode('', $errors->all('<li class="parsley-required">:message</li>'))!!}
              </ul>
            @endif
            
            {!! Form::open(
                array('route' => 'relation-info-update',
                'method'=>'PUT', 
                'class'=>'form-horizontal form-label-left',
                'id'=>'relation'
                )) 
            !!}
            
              {!!Form::hidden('user_id', Auth::user()->id)!!}

              @if (!empty($fm_data->labels))

                <div class="form-group clearfix">
                    @if(!empty($fm_data->labels['relation']))
                         {!! Form::label('relation', $fm_data->labels['relation'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
 
                         <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::select('relation[]', $relation, $relation_info->relation, array('required','multiple','id'=>'relation', 'class'=>'form-control')) !!}
                        </div>    
                    @endif
                </div>

                <div class="form-group clearfix">
                    @if(!empty($fm_data->labels['relation_code']))
                         {!! Form::label('relation_code', $fm_data->labels['relation_code'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
  
                         <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('relation_code', $relation_info->relation_code, array('id'=>'relation_code','required','placeholder' =>$fm_data->labels['relation_code'],'class'=>'form-control')) !!}
                        </div>    
                    @endif
                </div>
                 
              <div class="form-group clearfix">
                      @if(!empty($tc))
                           <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          {!! Form::checkbox('t_n_c', null, null, array('required','class'=>'field')) !!}
                           {!! $tc->desc!!} 
                           @if(!empty($tc->doc_title))
                           {!! HTML::link($tc->doc_link, $tc->doc_title)!!}
                           @endif
                          </div>    
                      @endif
               </div>
                
              <div class="form-group">
                  @if (!empty($fm_data->labels['submit']))
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          {!!HTML::linkRoute('dashboard-index', $fm_data->labels['cancel'], array(), array('class'=>"btn btn-round btn-primary"))!!}
                          <button id="send" type="submit" class="btn btn-round btn-success">Save & Next</button>
                      </div>
                  @endif
              </div>
             @endif
        {!! Form::close() !!}
     </div>
   </div>      
@endsection

@section("footer_add_js_script")
<script type="text/javascript">
    $( "#relation" ).submit(function( event ) {
        var foo = []; 
        $('#relation :selected').each(function(i, selected){ 
            foo[i] = $(selected).val(); 
        });
        
        if(foo.length== 1){
            if(foo[0]=='No Relation'){
                $('#relation_code').removeAttr('required');
                $('#relation_code').removeClass('error');
                $('#relation_code-error').remove();
            }
        }
        else {
            $('#relation_code').attr('required', 'required');
        }
    });
</script>
@endsection