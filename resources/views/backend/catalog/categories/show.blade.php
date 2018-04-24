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
    
    <div class="card">
        <div class="pm-body clearfix">
            <ul class="tab-navs tn-justified">
                <li class="active waves-effect"><a href="{!!route('categories.index')!!}">Categories</a></a></li>
                <li class="waves-effect"><a href="{!! route('category-upload-create')!!}">Categories Import</a></li>
            </ul>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header bgm-blue head-title">
          <h2>{!! $categories->name !!}</h2>
          <a href="{!! route('categories.create')  !!}" class="btn btn-round btn-default">Create New</a>
          <a href="{!! route('categories.edit', $categories->_id)  !!}"class="btn btn-round btn-default">Edit</a>
          <a href="{!! route('categories.assign', $categories->cat_id)  !!}" class="btn btn-default">Assign Attributes</a>
          <a href="{!! route('categories.index')  !!}" class="btn btn-round btn-default">View All</a>
        </div><!-- .card-header -->
        <div class="card-body card-padding">    
              <table class="table">
                  <tbody>
                      <tr>
                          <td >Cat ID</td>
                          <td>{!! $categories->cat_id !!}</td>
                      </tr>
                      <tr>
                          <td>Name</td>
                          <td>{!! $categories->name !!}</td>
                      </tr>            
                      <tr><td>Category Slug</td><td>{!! $categories->slug !!}</td></tr>            
                      <tr><td>Parent Category</td><td>{!! $categories->parent !!}</td></tr>            
                      <tr><td>Is This A Leaf Category?</td>
                          <td>
                              @if(isset($categories->leaf))
                                  @if($categories->leaf !== '1' && $categories->leaf !== 1 )
                                      No
                                  @else
                                      Yes
                                  @endif  
                              @else
                                  No
                              @endif                      
                          </td>
                      </tr>            
                  </tbody>
              </table>
        </div>
    </div>
@endsection


