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
        <div class="card-header bgm-blue head-title">
          <h2>{!! $fm_data->labels['references'] !!}</h2>
        </div><!-- .card-header -->
        <div class="card-body card-padding">   
            {!! Form::model($fm_data, [
                  'method' => 'PUT',
                  'route' => array('references-update',$userid),
                  'class' => 'form-label-left',
                  'id'=>'references',
              ]) !!}
               
                @foreach($info as $value)
                    @foreach($value->references as $val)
                        {!! Form::hidden('prev_ref_name[]', $val['name']) !!}
                        {!! Form::hidden('prev_ref_surname[]', $val['surname']) !!} 
                        {!! Form::hidden('prev_ref_email_address[]',$val['email_address']) !!}        
                    @endforeach
                 @endforeach
              
                @if(!empty($fm_data->labels))
                    <div id="ReferencesGroup" class="form-group text-left">
                         <div class="form-group clearfix">
                            <div class=""> 
                                        <div class="references_fields ref_div row">    
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
                                <div class="more_references"></div>

                                <div class="col-md-12">
                                    <br/>
                                    <button type="button" class="btn btn-round btn-primary add_references">{!!$fm_data->labels['add']!!}</button>
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
            <br>
            <br>
            <hr>
             <div class="row">
                    <div class="col-md-12">
                      <div class="card">
                          <div class="card-header card-padding-sm bgm-blue">
                              <h2>{!! $fm_data->labels['added_references'] !!}</h2>
                          </div>

                          <div class="card-body card-padding">
                                <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                                        <table class="table table-striped responsive-utilities jambo_table ">
                                            <thead>
                                                <th>{!! $fm_data->labels['name'] !!}</th>
                                                <th>{!! $fm_data->labels['surname'] !!}</th>
                                                <th>{!! $fm_data->labels['email_address'] !!}</th>
                                            </thead>
                                             <tbody>
                                                @foreach($info as $value)
                                                    @foreach($value->references as $val)
                                                        <tr>
                                                            <td>{!! $val['name'] !!}</td>
                                                            <td>{!! $val['surname'] !!}</td>
                                                            <td>{!! $val['email_address'] !!}</td>
                                                        </tr>
                                                    @endforeach
                                                 @endforeach
                                              </tbody>
                                         </table>
                                </div>
                          </div>    
                      </div>              
                    </div>      
                </div> 
        </div>
    </div>    
@endsection
@section('footer_add_js_script')

<script>    
    $( document ).ready(function() {
        $('div').on( "click", '.add_references', function(e){
            e.preventDefault();
            var newTextBoxDiv = $(document.createElement('div')).attr("class","references_fields_copy row");
            newTextBoxDiv.html( $(".references_fields").html() );
            newTextBoxDiv.append('<div class="col-md-12 "><a href="" class="remove_ref"><i class="zmdi zmdi-delete zmdi-hc-fw"></i></a><br/><hr/><br/></div>');
            newTextBoxDiv.appendTo(".more_references");
            return false;
        });
        
        $('div').on( "click", '.remove_ref', function(e){
            e.preventDefault();
            $(this).closest('.references_fields_copy').remove();
            return false;

        });
        
        $('div').on( "click", '.remove_references', function(e){
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
