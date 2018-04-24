    @extends('layout.backend.master')
    @extends('layout.backend.userinfo')
    
    @section('right_col_title_left')
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
                 <h2>Edit Group</h2>
                 <a href="{!! route('crm_groups.create')  !!}" class="btn  btn-default">Create New</a>
                 <a href="{!! route('crm_groups.index')  !!}" class="btn  btn-default">View All</a>
             </div><!-- .card-header -->
              {!! Form::open([
                     'method' => 'PUT',
                     'route' => ['crm_groups.update',$id],
                     'class' => 'form-horizontal form-label-left'
                 ]) !!}
                 
                     {!! Form::hidden('group_admin_name') !!}
                     
                     <div class="card-body card-padding">
                             @foreach($createForm as $form)
                                 {!! $form !!}
                             @endforeach

                             <div class="ln_solid"></div>
                             <div class="form-group">
                                 <div class="col-md-6 col-md-offset-5">
                                     <a href="{!! route('crm_groups.index')  !!}" type="submit" class="btn btn-round btn-primary">Cancel</a>
                                     <button id="send" type="submit" class="btn btn-round btn-success">Update</button>
                                 </div>
                             </div> 
                             <div class="ln_solid"></div>
                     </div>

             {!! Form::close() !!}

        </div>

    @endsection

@section('footer_add_js_script')
<script>
    function goBack() {
        window.history.back();
    }

    $( document ).ready(function() {
        $("#group_admin").change(function(){
            var group_admin_name= $(this).find('option:selected').text();
            $('#group_admin_name').val(group_admin_name);
        });
    });
</script>
@endsection