@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
   <!--<h2>CRM</h2>-->
    <!--<div class="page-top-links">-->
    <!--</div>-->
@endsection

@section('right_col_title_right')
@endsection

@if (Session::has('message'))
<div class="alert alert-info">{!!  Session::get('message')  !!}</div>
@endif

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
           <h2>Create Contact</h2>
          <a href="{!! route('crm_contacts.create')  !!}" class="btn  btn-default">Create New</a>
          <a href="{!! route('crm_contacts.index')  !!}" class="btn  btn-default">View All</a>
        </div><!-- .card-header -->
        {!! Form::open([
             'method' => 'POST',
             'route' => 'crm_contacts.create_excel',
             'class' => 'form-horizontal form-label-left'
         ]) !!}

             <div class="card-body card-padding">
                <div class="card-body card-padding">
                    {!! Form::checkbox('select_all','select_all',null,['class' => 'select_all']) !!} Select All
                    <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                        <table class="table table-striped responsive-utilities jambo_table ">
                            <thead>
                                <th>Select</th>
                                <th>Column Name</th>
                            </thead>
                            <tbody>
                                @foreach($formfields->form_fields as $fields)
                                   <tr>
                                      <td>{!! Form::checkbox($fields['name'],$fields['label'],null,['class' => 'fields']) !!}</td>
                                      <td>{!! $fields['label'] !!}</td>
                                   </tr>
                                @endforeach
                                @if(!empty($custom_fields))
                                    @foreach($custom_fields->form_fields as $custom)
                                        <tr>
                                          <td>{!! Form::checkbox($custom['name'],$custom['label'],null,['class' => 'fields']) !!}</td>
                                          <td>{!! $custom['label'] !!}</td>
                                       </tr>
                                    @endforeach
                                @endif
                            </tbody>
                         </table>
                    </div>
                </div>
                 
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-5">
                        <a href="{!! route('crm_contacts.index') !!}" type="submit" class="btn btn-round btn-primary">Cancel</a>
                        <button id="send" type="submit" class="btn btn-round btn-success">Create</button>
                    </div>
                </div> 
                <div class="ln_solid"></div>
             </div>
         {!! Form::close() !!}
    </div>
    
    
    
    
       <div class="card">
        <div class="card-header bgm-blue">
            <h2>Add Custom Fields</h2>
        </div><!-- .card-header -->
         
            {!! Form::open([
                 'method' => 'POST',
                 'route' => 'crm_contacts.save_custom_fields',
                 'class' => 'form-label-left',
                 'id' => 'add_field_form'
             ]) !!}
            
            {!! Form::hidden('field_label','', array('id'=>'field_label')) !!}
            
            <div class="card-body card-padding">
                <div class="form-group text-left">
                     <div class="form-group clearfix row">
                            <div class="col-md-4 col-sm-4">
                                {!! Form::label('field_name','Field Name', array('class'=>'control-label')) !!} 
                                {!! Form::text('field_name','',array('required', 'class'=>'form-control')) !!}
                            </div>

                            <div class="col-md-4 col-sm-4">
                                {!! Form::label('required','Required', array('class'=>'control-label')) !!} 
                                {!! Form::text('required','', array('placeholder'=>'Ex: required','class'=>'form-control')) !!}
                            </div>

                            <div class=" col-md-4 col-sm-4">
                                {!! Form::label('maxlength', 'Max Length', array('class'=>'control-label')) !!}
                                {!! Form::text('maxlength','', array('placeholder'=>'Ex:6','class'=>'form-control')) !!}
                            </div>
                     </div>    
                </div>
                
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-5">
                        <a href="{!! route('crm_contacts.columns') !!}" type="submit" class="btn btn-round btn-primary">Cancel</a>
                        <button id="add_field" type="submit" class="btn btn-round btn-success">Add</button>
                    </div>
                </div>
                <br/>
                <br/>
            </div>        
            {!! Form::close() !!}
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
        
        $("#add_field").click(function(event) {
            event.preventDefault();
            var Text = $('#field_name').val();
            if(Text!=='')
            {
                swal({
                    title: "Are you sure you want to add this field?",
                    text: "",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, Add Field!",
                    cancelButtonText: "Cancel",
                    closeOnConfirm: true,
                    closeOnCancel: true
                  },
                  function(isConfirm) {
                    if (isConfirm) {
                        Text = Text.toLowerCase();
                        Text = Text.replace(/\s/g, '_');
                        $("#field_label").val(Text);
                        $("#add_field_form").submit();
                    } 
                    else {
                      return false;
                    }
                  });
            }
        });
    });
</script>

@endsection


