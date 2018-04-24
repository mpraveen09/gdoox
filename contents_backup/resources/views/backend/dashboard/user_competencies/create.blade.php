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
   @include('navigation_tabs.personal-site-tabs')
    <div class="card">
        @if(isset($competencies->competencies))
        
            <div class="card-header bgm-blue head-title">
                <h2>{!! $fm_data->labels['competencies'] !!}</h2>
            </div><!-- .card-header -->

            <div class="card-body card-padding">  
                <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                    <table class="table table-striped responsive-utilities jambo_table ">
                        <thead>
                              <th>Competencies</th>
                              <th>Description</th>
                              <th>Extensive Description</th>
                              <th>Tags</th>
                              <th>Action</th>
                         </thead>

                         <tbody>
                            @foreach($competencies->competencies as $key=>$value)
                                <tr>
                                    <td>{!! implode(",<br />" , $value['competencies']) !!}</td>
                                    <td>{!! $value['short_description'] !!}</td>
                                    <td>{!! $value['extensive_description'] !!}</td>
                                    <td>{!! $value['competencies_tags'] !!}</td>
                                    <td>
                                        <a href="{!! route('competencies-edit', $key)  !!}">
                                            <i class='zmdi zmdi-edit zmdi-hc-fw'></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                         </tbody>  
                     </table>
                </div>
            </div>
        @endif
        
        
        <div class="card-header bgm-blue head-title">
            <h2>Add Competencies</h2>
        </div><!-- .card-header -->
        
        <div class="card-body card-padding">   
            {!! Form::model($fm_data, [
                  'method' => 'POST',
                  'route' => ['competencies-store'],
                  'class' => 'form-label-left',
                  'id'=>'competencies',
              ]) !!}
                    
              
                    @if(!empty($fm_data->labels))
                        <div id="CompetenciesGroup" class="form-group text-left">
                             <div class="form-group clearfix">
                                <div class=""> 
                                    <div class="competencies_fields comp_div row">    
                                            <div class="col-md-3 col-sm-6">
                                                {!! Form::label('competencies', $fm_data->labels['competencies'], array('class'=>'control-label')) !!} 
                                                {!! Form::select('competencies[]', $competency,'', array('multiple', 'required', 'class'=>'selectpicker form-control')) !!}
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                {!! Form::label('short_description', $fm_data->labels['short_description'], array('class'=>'control-label')) !!} 
                                                {!! Form::text('short_description','', array('placeholder'=>$fm_data->labels['short_description'],'class'=>'form-control')) !!}
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                {!! Form::label('competencies_tags', $fm_data->labels['competencies_tags'], array('class'=>'control-label')) !!} 
                                                {!! Form::text('competencies_tags','', array('placeholder'=>$fm_data->labels['competencies_tags'],'class'=>'form-control')) !!}
                                            </div>
                                            <div class=" col-md-3  col-sm-12">
                                                {!! Form::label('extensive_description', $fm_data->labels['extensive_description'], array('class'=>'control-label')) !!} 
                                                {!! Form::textarea('extensive_description','', array('placeholder'=>$fm_data->labels['extensive_description'],'class'=>'form-control')) !!}
                                            </div>
                                    </div>
                                   
<!--                                    <div class="more_competencies col-md-12"></div>-->
                                    
                                    <div class="col-md-12">
                                        <br/>
                                        <button id="send" type="submit" class="btn btn-round btn-success">{!!$fm_data->labels['save']!!}</button>
<!--                                    <button type="button" class="btn btn-round btn-primary add_competency">{!!$fm_data->labels['add']!!}</button>-->
                                    </div>
                                </div>  
                             </div>    
                        </div>
                    @endif 

<!--                 @if (!empty($fm_data->labels['submit']))
                      <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                               <button id="send" type="submit" class="btn btn-round btn-success">{!!$fm_data->labels['save']!!}</button>
                          </div>
                      </div>
                    @endif-->
            {!! Form::close() !!}
        </div>
    </div>    
@endsection
@section('footer_add_js_script')

<script>    
    $( document ).ready(function() {
        $('div').on( "click", '.add_competency', function(e){
            e.preventDefault();
            var newTextBoxDiv = $(document.createElement('div')).attr("class","comptencies_fields_copy");
            newTextBoxDiv.html( $(".competencies_fields").html() );
            newTextBoxDiv.append('<div class="col-md-12 "><a href="" class="remove_comp"><i class="zmdi zmdi-delete zmdi-hc-fw"></i></a><br/><hr/><br/></div>');
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
