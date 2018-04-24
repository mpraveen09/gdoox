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
          <h2>{!! $fm_data->labels['professional_skills'] !!}</h2>
        </div><!-- .card-header -->
        <div class="card-body card-padding">   
            {!! Form::model($fm_data, [
                  'method' => 'PUT',
                  'route' => ['professional-skills-update',$id],
                  'class' => 'form-label-left',
                  'id'=>'personal_site',
                 'files'=>true
              ]) !!}
                  
                    @if(!empty($fm_data->labels['professional_skills']))
                      <div class="form-group clearfix">
                         {!! Form::label('professional_skills', $fm_data->labels['professional_skills'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                         <div class="col-md-6 col-sm-6 col-xs-12">
                         {!! Form::text('skills',$info->professional_skills['skills'], array('required','placeholder'=>$fm_data->labels['professional_skills'],'class'=>'form-control')) !!}
                        </div>    
                      </div>
                    @endif

                    @if(!empty($fm_data->labels['skill_tags']))
                      <div class="form-group clearfix">
                         {!! Form::label('skill_tags', $fm_data->labels['skill_tags'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                         <div class="col-md-6 col-sm-6 col-xs-12">
                              {!! Form::text('skill_tags',$info->professional_skills['skills_tags'], array('required','placeholder'=>$fm_data->labels['skill_tags'],'class'=>'form-control')) !!}
                        </div>    
                      </div>
                    @endif
                  
                  
                    @if(!empty($fm_data->labels['mother_tongue']))
                      <div class="form-group clearfix">
                         {!! Form::label('mother_tongue', $fm_data->labels['mother_tongue'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                         <div class="col-md-6 col-sm-6 col-xs-12">
                              {!! Form::text('mother_tongue', $info->professional_skills['mother_tongue'], array('required','placeholder'=>$fm_data->labels['mother_tongue'],'class'=>'form-control')) !!}
                        </div>    
                      </div>
                    @endif
                    
                    
                    @if(!empty($fm_data->labels['language']))
                        <div id="LanguageGroup" class="form-group">
                             <div class="form-group clearfix">
                                    {!! Form::label('language', $fm_data->labels['language'], array('style'=>'margin-top:10px','class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        @if($info->professional_skills['languages'])
                                            @foreach($info->professional_skills['languages'] as $value)
                                                <div class="langs_fields lang_div">
                                                    <div class="col-md-3 col-sm-3 col-xs-6">
                                                        {!! Form::label('language','Select Language', array('style'=>'margin-top:10px','class'=>'control-label')) !!}
                                                        {!! Form::select('language[]', $lang, $value['language'], array('placeholder'=>'-- Select --','required', 'class'=>'form-control')) !!}
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 col-xs-6">
                                                        {!! Form::label('select_understanding', $fm_data->labels['select_understanding'], array('style'=>'margin-top:10px','class'=>'control-label')) !!}
                                                        {!! Form::select('understanding[]',$prof , $value['understanding'], array('placeholder'=>'', 'class'=>'form-control')) !!}
                                                    </div>
                                                    <div class="col-md-2 col-sm-2 col-xs-6">
                                                        {!! Form::label('reading', $fm_data->labels['reading'], array('style'=>'margin-top:10px','class'=>'control-label')) !!}
                                                        {!! Form::select('speaking[]', $prof, $value['speaking'], array('placeholder'=>'','required', 'class'=>'form-control')) !!}
                                                    </div>
                                                    <div class="col-md-2 col-sm-2 col-xs-6">
                                                        {!! Form::label('writing', $fm_data->labels['writing'], array('style'=>'margin-top:10px','class'=>'control-label')) !!}
                                                        {!! Form::select('writing[]', $prof, $value['writing'], array('placeholder'=>'','required', 'class'=>'form-control')) !!}
                                                    </div>
                                                    <div style="padding-top:10px;" class="col-md-2 col-sm-2 col-xs-6"><a href="" class="remove_language"><i class="zmdi zmdi-delete zmdi-hc-fw"></i></a></div>
                                                </div>
                                            @endforeach
                                            @else 
                                                <div class="langs_fields lang_div">
                                                    <div class="col-md-3 col-sm-3 col-xs-6">
                                                        {!! Form::label('language','Select Language', array('style'=>'margin-top:10px','class'=>'control-label')) !!}
                                                        {!! Form::select('language[]', $lang, '', array('placeholder'=>'','required', 'class'=>'form-control')) !!}
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 col-xs-6">
                                                        {!! Form::label('select_understanding', $fm_data->labels['select_understanding'], array('style'=>'margin-top:10px','class'=>'control-label')) !!}
                                                        {!! Form::select('understanding[]', $prof, '', array('placeholder'=>'', 'class'=>'form-control')) !!}
                                                    </div>
                                                    <div class="col-md-2 col-sm-2 col-xs-6">
                                                        {!! Form::label('reading', $fm_data->labels['reading'], array('style'=>'margin-top:10px','class'=>'control-label')) !!}
                                                        {!! Form::select('speaking[]', $prof, '', array('placeholder'=>'','required', 'class'=>'form-control')) !!}
                                                    </div>
                                                    <div class="col-md-2 col-sm-2 col-xs-6">
                                                        {!! Form::label('writing', $fm_data->labels['writing'], array('style'=>'margin-top:10px','class'=>'control-label')) !!}
                                                        {!! Form::select('writing[]', $prof, '', array('placeholder'=>'','required', 'class'=>'form-control')) !!}
                                                    </div>
                                                    <div style="padding-top:10px;" class="col-md-2 col-sm-2 col-xs-6"><a href="" class="remove_language"><i class="zmdi zmdi-delete zmdi-hc-fw"></i></a></div>
                                                </div>
                                        @endif
                                        <div class="more_langs"></div>

                                        <div class="col-md-12">
                                            <br/>
                                            <button type="button" class="btn btn-round btn-primary add_langs">{!!$fm_data->labels['add']!!}</button>
                                        </div>
                                    </div> 
                             </div>    
                        </div>
                    @endif
                    
                    


                    
                    @if(!empty($fm_data->labels['school']))
                        <div id="LanguageGroup" class="form-group">
                             <div class="form-group clearfix">
                                {!! Form::label('education', $fm_data->labels['education'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    @if($info->professional_skills['schools'])
                                        @foreach($info->professional_skills['schools'] as $value)
                                        <div class="add_schools_fields school_div">
                                            <div class="col-md-3 col-sm-3 col-xs-6">
                                                {!! Form::label('school', $fm_data->labels['school'], array('style'=>'margin-top:10px','class'=>'control-label')) !!}
                                                {!! Form::text('school[]', $value['school'], array('placeholder'=>$fm_data->labels['school'],'class'=>'form-control')) !!}
                                            </div>
                                            <div class="col-md-2 col-sm-2 col-xs-6">
                                                {!! Form::label('from_year', $fm_data->labels['from_year'], array('style'=>'margin-top:10px','class'=>'control-label')) !!}
                                                {!! Form::text('school_from_year[]', $value['from_year'], array('placeholder'=>$fm_data->labels['from_year'],'class'=>'form-control')) !!}
                                            </div>
                                            <div class="col-md-2 col-sm-2 col-xs-6">
                                                {!! Form::label('to_year', $fm_data->labels['to_year'], array('style'=>'margin-top:10px','class'=>'control-label')) !!}
                                                {!! Form::text('school_to_year[]', $value['to_year'], array('placeholder'=>$fm_data->labels['to_year'],'class'=>'form-control')) !!}
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-6">
                                                 {!! Form::label('title_achieved', $fm_data->labels['title_achieved'], array('style'=>'margin-top:10px','class'=>'control-label')) !!}
                                                {!! Form::text('title[]', $value['title'], array('placeholder'=>$fm_data->labels['title_achieved'],'class'=>'form-control')) !!}
                                            </div>
                                            <div style="padding-top:10px;" class="col-md-2 col-sm-2 col-xs-6"><a href="" class="remove_school"><i class="zmdi zmdi-delete zmdi-hc-fw"></i></a></div>
                                        </div>
                                        @endforeach
                                    @else
                                        <div class="add_schools_fields school_div">
                                            <div class="col-md-3 col-sm-3 col-xs-6">
                                                {!! Form::label('school', $fm_data->labels['school'], array('style'=>'margin-top:10px','class'=>'control-label')) !!}
                                                {!! Form::text('school[]', '', array('class'=>'form-control')) !!}
                                            </div>
                                            <div class="col-md-2 col-sm-2 col-xs-6">
                                                {!! Form::label('from_year', $fm_data->labels['from_year'], array('style'=>'margin-top:10px','class'=>'control-label')) !!}
                                                {!! Form::text('school_from_year[]', '', array('class'=>'form-control')) !!}
                                            </div>
                                            <div class="col-md-2 col-sm-2 col-xs-6">
                                                {!! Form::label('to_year', $fm_data->labels['to_year'], array('style'=>'margin-top:10px','class'=>'control-label')) !!}
                                                {!! Form::text('school_to_year[]', '', array('class'=>'form-control')) !!}
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-6">
                                                {!! Form::label('title_achieved', $fm_data->labels['title_achieved'], array('style'=>'margin-top:10px','class'=>'control-label')) !!}
                                                {!! Form::text('title[]', '', array('class'=>'form-control')) !!}
                                            </div>
                                            <div style="padding-top:10px;" class="col-md-2 col-sm-2 col-xs-6"><a href="" class="remove_school"><i class="zmdi zmdi-delete zmdi-hc-fw"></i></a></div>
                                        </div>
                                    @endif
                                    <div class="more_school"></div>
                                    
                                    <div class="col-md-12">
                                        <br/>
                                        <button type="button" class="btn btn-round btn-primary add_more_schools">{!!$fm_data->labels['add']!!}</button>
                                    </div>
                                </div> 
                             </div>
                        </div>
                    @endif
                    
                    @if(!empty($fm_data->labels['other_certifications']))
                        <div id="LanguageGroup" class="form-group">
                             <div class="form-group clearfix">
                                {!! Form::label('other_certifications', $fm_data->labels['other_certifications'], array('style'=>'margin-top:10px','class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    @if($info->professional_skills['certifications'])
                                        @foreach($info->professional_skills['certifications'] as $value)
                                        <div class="add_other_certifications certifications_div">
                                            <div class="col-md-4 col-sm-4 col-xs-6">
                                                {!! Form::text('certifications[]', $value['certification'], array('placeholder'=>$fm_data->labels['other_certifications'],'class'=>'form-control')) !!}
                                            </div>
                                             <div class="col-md-3 col-sm-3 col-xs-6">
                                                    {!! Form::text('name_of_institute[]', $value['name_of_institute'], array('placeholder'=>$fm_data->labels['name_of_institute'],'class'=>'form-control')) !!}
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-6">
                                                {!! Form::text('date[]', $value['date'], array('placeholder'=>$fm_data->labels['date'],'class'=>'form-control')) !!}
                                            </div>
                                            <div style="padding-top:10px;" class="col-md-2 col-sm-2 col-xs-6"><a href="" class="remove_certification"><i class="zmdi zmdi-delete zmdi-hc-fw"></i></a></div>
                                        </div>
                                        @endforeach
                                    @else
                                        <div class="add_other_certifications">
                                            <div class="col-md-4 col-sm-4 col-xs-6">
                                                {!! Form::text('certifications[]', '', array('placeholder'=>$fm_data->labels['certificate_name'],'class'=>'form-control')) !!}
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-6">
                                                {!! Form::text('name_of_institute[]','', array('placeholder'=>$fm_data->labels['name_of_institute'],'class'=>'form-control')) !!}
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-6">
                                               {!! Form::text('date[]', '', array('placeholder'=>$fm_data->labels['date'],'class'=>'form-control')) !!}
                                            </div>
                                            <div style="padding-top:10px;" class="col-md-2 col-sm-2 col-xs-6"><a href="" class="remove_certification"><i class="zmdi zmdi-delete zmdi-hc-fw"></i></a></div>
                                        </div>   
                                    @endif
                                    <div class="more_other_certifications"></div>
                                    
                                    <div class="col-md-12">
                                        <br/>
                                        <button type="button" class="btn btn-round btn-primary add_more_certifications">{!!$fm_data->labels['add']!!}</button>
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
                    <br/><br/><br/>
                    @endif
            {!! Form::close() !!}
        </div>
    </div>    
@endsection
@section('footer_add_js_script')

<script>    
    $( document ).ready(function() {
        $('div').on( "click", '.add_langs', function(e){
            e.preventDefault();
            var newTextBoxDiv = $(document.createElement('div')).attr("class","langs_fields_copy lang_div");
            newTextBoxDiv.html( $(".langs_fields").html() );
            newTextBoxDiv.append('<div style="padding-top:10px;" class="col-md-2 col-sm-2 col-xs-6"><a href="" class="remove_lang"></a></div>');
            newTextBoxDiv.appendTo(".more_langs");
            return false;
        });
        
        $('div').on( "click", '.remove_lang', function(e){
            e.preventDefault();
            $(this).closest('.langs_fields_copy').remove();
            return false;

        });
        
            $('div').on( "click", '.add_more_certifications', function(e){
                e.preventDefault();
                var newTextBoxDiv = $(document.createElement('div')).attr("class","more_certification_copy");
                newTextBoxDiv.html( $(".add_other_certifications").html());
                newTextBoxDiv.append('<div style="padding-top:10px;" class="col-md-2 col-sm-2 col-xs-6"><a href="" class="remove_more_certification"></a></div>');
                newTextBoxDiv.appendTo(".more_other_certifications");
                return false;
            });

            $('div').on( "click", '.remove_more_certification', function(e){
                e.preventDefault();
                $(this).closest('.more_certification_copy').remove();
                return false;
            });
            
            $('div').on( "click", '.add_more_schools', function(e){
                e.preventDefault();
                var newTextBoxDiv = $(document.createElement('div')).attr("class","more_schools_copy school_div");
                newTextBoxDiv.html( $(".add_schools_fields").html() );
                newTextBoxDiv.append('<div style="padding-top:10px;" class="col-md-2 col-sm-2 col-xs-6"><a href="" class="remove_more_schools"></i></a></div>');
                newTextBoxDiv.appendTo(".more_school");
                return false;
            });
        
            $('div').on( "click", '.remove_more_schools', function(e){
                e.preventDefault();
                $(this).closest('.more_schools_copy').remove();
                return false;
            });
            
            $('div').on( "click", '.add_more_title', function(e){
                e.preventDefault();
                var newTextBoxDiv = $(document.createElement('div')).attr("class","more_title_copy title_div");
                newTextBoxDiv.html( $(".add_title_fields").html() );
                newTextBoxDiv.append('<div style="padding-top:10px;" class="col-md-2 col-sm-2 col-xs-6"><a href="" class="remove_more_title"></a></div>');
                newTextBoxDiv.appendTo(".more_title");
                return false;
            });
        
            $('div').on( "click", '.remove_more_title', function(e){
                e.preventDefault();
                $(this).closest('.more_title_copy').remove();
                return false;
            });
            
            
            $('div').on( "click", '.remove_language', function(e){
                e.preventDefault(); 
                var div_lang= $('.lang_div').length;
                if(div_lang===1){
                   swal("You can not delete this language!");
                }
                else{
                    $(this).parent().parent().remove();
                }
                return false;
            });
            
            $('div').on( "click", '.remove_other_language', function(e){
                e.preventDefault();
                var more_lang_div= $('.more_lang_div').length;
                if(more_lang_div===1){
                   swal("You can not delete this language!");
                }
                else{
                    $(this).parent().parent().remove();
                }   
                return false;
            });
            
            $('div').on( "click", '.remove_school', function(e){
                e.preventDefault();
                var school_div= $('.school_div').length;
                if(school_div===1){
                   swal("You can not delete this School!");
                }
                else{
                    $(this).parent().parent().remove();
                }   
                return false; 
            });
            
            $('div').on( "click", '.remove_title', function(e){
                e.preventDefault();
                var title_div= $('.title_div').length;
                if(title_div===1){
                   swal("You can not delete this title!");
                }
                else{
                    $(this).parent().parent().remove();
                }  
            });
            
            $('div').on( "click", '.remove_certification', function(e){
                e.preventDefault(); 
                var div_lang= $('.certifications_div').length;
                if(div_lang===1){
                   swal("You can not remove this Field!. If you want to remove this certification, remove the certification from field.");
                }
                else{
                    $(this).parent().parent().remove();
                }
                return false;
            });
    });    
    
</script>
@endsection
