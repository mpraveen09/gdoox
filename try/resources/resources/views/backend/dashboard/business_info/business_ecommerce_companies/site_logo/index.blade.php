@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>E-commerce Site</h2>-->
<!--<div class="page-top-links">-->
<!--</div>-->
@endsection

@section('right_col_title_right')
@endsection

@section('right_col')
    @if (Session::has('message'))
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!!  Session::get('message')  !!}
        </div>
    @endif
    @if (HTML::ul($errors->all()))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!! HTML::ul($errors->all()) !!}
        </div>
    @endif
    
    <div class="card">
	<div class="card-header bgm-blue head-title">
      <h2>Select E-store</h2>
      <button id="cancel_btn" onclick="goBack()" type="button" class="btn btn-round btn-default">Back</button>
	</div><!-- .card-header -->
	<div class="card-body card-padding">
    @if(count($estores)<1)
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        You have no business listed
    </div>    
    @else
 
   <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
        <table class="table table-striped responsive-utilities jambo_table ">
            <thead>
                <tr>
                    <th>{!! "Sitename"!!}</th>
                    <th>{!! "Slug"!!}</th>
                    <th>{!! $fm_data->labels['action']!!}</th>
                </tr>
            </thead>
            <tbody>    
            @for($i=0;$i<count($estores['site_name']);$i++ )
                <tr>
                    <td>{!!  $estores['site_name'][$i]!!}</td>
                    <td>{!! $estores['slug'][$i]!!}</td>
                    <td>
                      <a href="{!!route('site.logo.create',$estores['slug'][$i]) !!}" data-toggle="tooltip" data-placement="bottom" title="Select"><i class="zmdi zmdi-upload zmdi-hc-fw"></i></a> &nbsp;
                    </td>
                </tr>  
            @endfor
    
            </tbody>
        </table>
        
        </div>
        <div class="row">
            <div class="text-right col-md-12">
            </div>
        </div>    
        </div><!-- .card-body -->
</div><!-- .card -->
@endif
@endsection

section('footer_add_js_script')
    <script>
    function goBack() {
        window.history.back();
    }
    </script>
@endsection