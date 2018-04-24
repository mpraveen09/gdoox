@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
   <h2>Exceptions</h2>
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
    
    @if (Session::has('message'))
        <div class="alert alert-info">{!!  Session::get('message')  !!}</div>
    @endif
    
    <?php 
        $action = app('request')->route()->getAction();
        $controller = class_basename($action['controller']);
    ?>
    
    
    <div class="card">
         <div class="card-header bgm-blue">
             <h2><i class="zmdi zmdi-account m-r-5"></i>Exceptions</h2>
         </div><!-- .card-header -->
         <div class="card-body card-padding">    
             {!! Form::open([
                   'method' => 'POST',
                   'route' => 'exceptions.store',
                   'class' => 'form-horizontal form-label-left',
               ]) !!}
                
               {!! Form::hidden('controller', $controller) !!}
               
                <div class="form-group clearfix">
                   {!! Form::label('subject','Subject', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                   <div class="col-md-6 col-sm-6 col-xs-12">
                       {!! Form::text('subject', '', array('placeholder'=>'Subject','class'=>'form-control')) !!}
                  </div>    
                </div>

                <div class="form-group clearfix">
                   {!! Form::label('description', 'Description', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                   <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::textarea('description', '', array('placeholder'=>'Description','class'=>'form-control')) !!}
                  </div>    
                </div>
               
               <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
    <!--                <a href="{!! route('crm_groups.index')  !!}" type="submit" class="btn btn-round btn-primary">Cancel</a>-->
                        <button id="send" type="submit" class="btn btn-round btn-success">Report Error</button>
                    </div>
               </div>  
             {!! Form::close() !!}
         </div>
     </div>    
@endsection

@section('footer_add_js_script')
<script type="text/javascript">
    $(document).ready(function(){
        
    });
</script>
<script>
function goBack() {
    window.history.back();
}
</script>
@endsection


