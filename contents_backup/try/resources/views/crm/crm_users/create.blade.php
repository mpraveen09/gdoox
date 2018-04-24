@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
   <h2>CRM</h2>
    <!--<div class="page-top-links">-->
      
    <!--</div>-->
@endsection

@section('header_custom_css')
    <link href="{{ asset('/m-admin-ui/css/app.css') }}" rel="stylesheet">
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
                <h2>Add User</h2>
                <a href="{!! route('crm_users.index')  !!}" class="btn  btn-default">View All</a>
            </div><!-- .card-header -->
                    
                {!! Form::open([
                    'method' => 'POST',
                    'route' => 'crm_users.store',
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
                                <button id="send" type="submit" class="btn btn-round btn-success">Save</button>
                            </div>
                        </div> 
                        <div class="ln_solid"></div>
                    </div>
                {!! Form::close() !!}        
       </div>
@endsection

@section('footer_add_js_script')
<script src="vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.js"></script>
<script>
function goBack() {
    window.history.back();
}
</script>
@endsection


