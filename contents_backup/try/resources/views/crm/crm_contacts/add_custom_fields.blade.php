@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
   <!--<h2>CRM</h2>-->
   <!--<div class="page-top-links">-->
   <!--</div>-->
@endsection

@section('right_col_title_right')
@endsection

@section('right_col')
    <!-- if there are creation errors, they will show here -->
    @if (HTML::ul($errors->all()))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!! HTML::ul($errors->all()) !!}
        </div>
    @endif
    
    @include('navigation_tabs.crm_tabs')
    
    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>Add Custom Fields</h2>
            <button class="btn btn-default waves-effect" onclick="goBack()">Go Back</button>
        </div><!-- .card-header -->
        <div class="card-body card-padding">  
            {!! Form::open([
                 'method' => 'POST',
                 'route' => 'crm_contacts.save_custom_fields',
                 'class' => 'form-label-left'
             ]) !!}
            
            
                <div id="CompetenciesGroup" class="form-group text-left">
                     <div class="form-group clearfix">
                        <div class="">
                            <div class="contacts_fields comp_div row">    
                                <div class="col-md-4 col-sm-4">
                                    {!! Form::label('field_label','Field Name', array('class'=>'control-label')) !!} 
                                    {!! Form::text('field_label[]','',array('required', 'class'=>'form-control')) !!}
                                </div>
                                
                                <div class="col-md-4 col-sm-4">
                                    {!! Form::label('required','Required', array('class'=>'control-label')) !!} 
                                    {!! Form::text('required[]','', array('placeholder'=>'Ex: required','class'=>'form-control')) !!}
                                </div>
                                
                                <div class=" col-md-4 col-sm-4">
                                    {!! Form::label('maxlength', 'Max Length', array('class'=>'control-label')) !!} 
                                    {!! Form::text('text[]','', array('placeholder'=>'Ex:6','class'=>'form-control')) !!}
                                </div>
                            </div>

                            <div class="more_fields row"></div>

                            <div class="col-md-12">
                                <br/>
                                <button type="button" class="btn btn-round btn-primary add_fields">Add</button>
                            </div>
                        </div>  
                     </div>    
                </div>

                <div class="ln_solid"></div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-5">
                        <a href="{!! route('crm_contacts.columns') !!}" type="submit" class="btn btn-round btn-primary">Cancel</a>
                        <button id="send" type="submit" class="btn btn-round btn-success">Create</button>
                    </div>
                </div>
                <div class="ln_solid"></div>
            {!! Form::close() !!}
          </div>
    </div>

@endsection

@section('footer_add_js_script')
<script type="text/javascript">
    function goBack() {
        window.history.back();
    }
    
    $(document).ready(function() {
        $('.select_all').click(function() {
            if(this.checked) {
                $('.fields').each(function() {
                    this.checked = true;               
                });
            }
            else
            {
                $('.fields').each(function() {
                    this.checked = false;                       
                });         
            }
        });
    });
</script>

<script>    
    $( document ).ready(function() {
        $('div').on( "click", '.add_fields', function(e){
            e.preventDefault();
            var newTextBoxDiv = $(document.createElement('div')).attr("class","contacts_fields_copy");
            newTextBoxDiv.html( $(".contacts_fields").html() );
            newTextBoxDiv.append('<div class="col-md-12 "><a href="" class="remove_field"><i class="zmdi zmdi-delete zmdi-hc-fw"></i></a><br/><hr/><br/></div>');
            newTextBoxDiv.appendTo(".more_fields");
            return false;
        });
        
        $('div').on( "click", '.remove_field', function(e){
            e.preventDefault();
            $(this).closest('.contacts_fields_copy').remove();
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


