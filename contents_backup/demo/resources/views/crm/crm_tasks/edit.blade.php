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
              <h2>Create Task</h2>
              <a href="{!! route('tasks.create')  !!}" class="btn  btn-default">Create New</a>
              <a href="{!! route('tasks.index')  !!}" class="btn  btn-default">View All</a>
            </div><!-- .card-header -->
             {!! Form::open([
                    'method' => 'PUT',
                    'route' => ['tasks.update',$id],
                    'class' => 'form-horizontal form-label-left'
                ]) !!}

                    <div class="card-body card-padding">
                            @foreach($createForm as $form)
                                {!! $form !!}
                            @endforeach
                            
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-5">
                                    <a href="{!! route('tasks.index')  !!}" type="submit" class="btn btn-round btn-primary">Cancel</a>
                                    <button id="send" type="submit" class="btn btn-round btn-success">Update</button>
                                </div>
                            </div> 
                            <div class="ln_solid"></div>
                    </div>
            {!! Form::close() !!}     
       </div>
@endsection

@section('footer_add_js_script')
<script type="text/javascript">
    $(document).ready(function(){
        $("#assigned_to").change(function(){
            var assigned_to_name= $(this).find('option:selected').text();
            $('#assigned_to_name').val(assigned_to_name);
        });
    });
</script>
<script>
function goBack() {
    window.history.back();
}
</script>
@endsection