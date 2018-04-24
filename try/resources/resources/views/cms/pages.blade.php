@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <!--<h2>Site Pages</h2>-->
    <!--<div class="page-top-links">-->
    <!--</div>-->
@endsection

@section('right_col_title_right')
@endsection

@section('right_col')
      <!-- will be used to show any messages -->
    @if (Session::has('message'))
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!!  Session::get('message')  !!}
        </div>
    @endif
    
    @include('navigation_tabs.general_tabs')
    <div class="card">
        <div class="card-header bgm-blue head-title">
          <h2>CMS Pages</h2>
          <a href="{!! route('cms.create')  !!}" class="btn btn-default">Create New</a>
          <a href="{!! route('cms.index')  !!}" class="btn btn-default">View All</a>
        </div><!-- .card-header -->
        
            @if (!$sitepages->count())
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    You have no Pages
                </div>                 
            @else
            <div class="card-body card-padding">    
                
            <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                <table class="table table-striped responsive-utilities jambo_table ">
                    <thead>
                        <tr>
                            <th>Page Title</th>
                            <th>Site Name</th>
                            <th>Sort Order</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>    
                    @foreach( $sitepages as $page )
                        <tr>
                            <td>
                              <a href="{!! route('cms.page', [$page->slug, preg_replace('/[^a-zA-Z]+/', '', $page->page_title), $page->id ]) !!}" target="_blank">
                                {!! $page->page_title !!}
                              </a>
                            </td>
                            <td>
                              <a href="{!! route('site', $page->slug)  !!}" target="_blank">{!! $page->slug !!}</a> 
                            </td>
                            <td>{!! $page->sort_order !!}</td>
                            <td>                               
                                <a href="{!! route('cms.edit', $page->_id)  !!}">
                                    <i class='zmdi zmdi-edit zmdi-hc-fw'></i> Edit</a>  &nbsp;&nbsp;&nbsp;&nbsp;                               
                                <a href="{!! route('cms.page', [$page->slug, preg_replace('/[^a-zA-Z]+/', '', $page->page_title), $page->id ]) !!}">
                                    <i class='zmdi zmdi-eye zmdi-hc-fw'></i> View</a>                                
                            </td>
                        </tr> 
                    @endforeach
                    </tbody>
                </table>
            </div>    
            @endif
            <div class="row">
                <div class="text-right col-md-12">
                    {!!$sitepages->render() !!}
                </div>
            </div>    
    </div>
</div>
@endsection

@section('footer_add_js_script')
<script>
function goBack() {
    window.history.back();
}
</script>
@endsection
