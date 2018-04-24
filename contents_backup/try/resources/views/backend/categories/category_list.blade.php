
@extends('layout.backend.master')
@extends('layout.backend.userinfo')
@section('header_custom_css')        
    <!--header_custom_css-->
    <link href="{{ asset('/css/docs.css') }}" rel="stylesheet">
@endsection
@section('header_add_js_script')        
<script type="text/javascript">
        $(document).ready(function(){
             $( ".bs-docs-sidenav li").click(function(){
                  $('.bs-docs-sidenav li').removeClass('active');
                  $(this).addClass( "active" );
             });
        });
</script>
@endsection
@section('right_col_title_left')
    <!--<h3>Category List | Select Category of Item</h3>--> 
@endsection
    <div class="card">
        <div class="card-header bgm-blue head-title">
          <h2> Category List </h2>
        </div><!-- .card-header -->
        <div class="card-body card-padding">    
              @section('right_col')
              <div class="span3 bs-docs-sidebar">
               <?php echo $cat; ?>
              </div>
        </div>
    </div>   
@endsection