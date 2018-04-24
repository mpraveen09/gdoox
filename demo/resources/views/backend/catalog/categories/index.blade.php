@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <!--<h2>Categories List</h2>-->
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
    
   @include('navigation_tabs.category_mgmt_tabs');
    
    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>Categories</h2>
            <a href="{!! route('categories.create')  !!}" class="btn btn-round btn-default">Create New</a>
            <a href="{!! route('categories.index')  !!}" class="btn btn-round btn-default">View All</a>
        </div><!-- .card-header -->
        
            @if ( !$categories->count() )
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    You have no Categories
                </div>                 
            @else
            <div class="card-body card-padding">    
                <div class="row">
                    {!! Form::model($categories, [
                        'method' => 'POST',
                        'route' => ['cat_search'],
                        'class' => 'form-horizontal form-label-left',
                        'novalidate'=>''
                    ]) !!}
                    <div class="col-md-4 col-sm-4 col-xs-10  form-group top_search" style="padding: 20px 0; margin-left: 0px;">
                        <div class="input-group">
                            {!! Form::text('term',$term, array('required','placeholder'=>'Search Categories...','class'=>'searchcategories form-control'))!!}
<!--                            <input type="text" name="term" id="term" class="form-control" placeholder="Search categories...">-->
                            <span class="input-group-btn">
                                <button class="btn btn-default btn-icon-text waves-effect"><i class="zmdi zmdi-search"></i></button>
<!--                                <button class="btn btn-default" type="submit"/>Go!</button>-->
                            </span>                          
                        </div>
                    </div>
                    {!! Form::close() !!}
                    <div class="text-right col-md-8">
<!--                        {!! $categories->render() !!}-->
                            {!! $categories->appends(['term' => $term])->render() !!}
                    </div>
                </div><!-- .card-body -->
            <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                <table class="table table-striped responsive-utilities jambo_table ">
                    <thead>
                        <tr>
                            <th>Cat ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Parent</th>
                            <th>Is Leaf?</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>    
                    @foreach( $categories as $category )
                        <tr>
                            <td>{!!  $category->cat_id  !!}</td>
                            <td>{!! $category->name !!}</td>
                            <td>
                                @if(isset($category->slug))
                                    {!! $category->slug !!}
                                @endif
                            </td>
                            <td>{!! $category->parent !!}</td>
                            <td>
                                @if(isset($category->leaf))
                                    @if($category->leaf !== '1' && $category->leaf !== 1 )
                                        No
                                    @else
                                        Yes
                                    @endif  
                                @else
                                    No
                                @endif                        
                            </td>

                            <td>
                                <a href="{!! route('categories.show', $category->_id)  !!}"><i class='zmdi zmdi-eye zmdi-hc-fw'></i></a> &nbsp; 
                                <a href="{!! route('categories.edit', $category->_id)  !!}"><i class='zmdi zmdi-edit zmdi-hc-fw'></i></a>
                            </td>
                        </tr>                
                    @endforeach

                    </tbody>
                </table>
            </div>
                <div class="row">
                    <div class="text-right col-md-12">
                        {!! $categories->render() !!}
                    </div>
                </div>
            @endif
    </div>
@endsection

@section('footer_add_js_script')
<style>
    .ui-menu-item{
        width: 300px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;        
        font-size: 11px;
    }   
    .ui-widget-content{
        max-height: 400px;
        overflow: scroll;
    }
</style>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
    jQuery(function($) {
        $(".searchcategories").autocomplete({
            source: function( request, response ) {   
                $.ajax({
                    url: "{!! URL::route('auto_search_cat')  !!}",
                    dataType: "json",
                    data: {
                            term: request.term,
                    },
                    success: function(json) {
                        response( $.map( json, function( item ) {
                            return {
                                value: item.name
                            }
                        }));
                    }
                });
            },
            autoFocus: true,
            minLength: 3,
            });
        });
</script>

@endsection