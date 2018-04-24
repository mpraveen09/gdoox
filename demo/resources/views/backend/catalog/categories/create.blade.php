@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
   <!--<h3>Categories List</h3>-->
    <!--<div class="page-top-links">-->
    <!--</div>-->
@endsection

@section('right_col_title_right')
@endsection

@section('right_col')

   @include('navigation_tabs.category_mgmt_tabs')
    
   <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2> Create New Category</h2>
            <a href="{!! route('categories.create')  !!}" class="btn btn-round btn-default">Create New</a>
            <a href="{!! route('categories.index')  !!}" class="btn btn-round btn-default">View All</a>
        </div><!-- .card-header -->
        
        <div class="card-body card-padding">    
              <!-- if there are creation errors, they will show here -->
            @if (HTML::ul($errors->all()))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    {!! HTML::ul($errors->all()) !!}
                </div>
            @endif

              {!! Form::open([
                  'method' => 'POST',
                  'route' => 'categories.store',
                  'class' => 'form-horizontal form-label-left',
                  'novalidate'=>''
              ]) !!}
                  <div class="item form-group">
                      {!! Form::label('cat_id', 'Category ID', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::text('cat_id', '', ['class' => 'form-control col-md-7 col-xs-12', 'required']) !!}
                      </div>
                  </div>

                  <div class="item form-group">
                      {!! Form::label('name', 'Name', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::text('name', '', ['class' => 'form-control col-md-7 col-xs-12', 'required']) !!}
                      </div>
                  </div>

                  <div class="item form-group">
                      {!! Form::label('slug', 'Category Slug', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::text('slug', '', ['class' => 'form-control col-md-7 col-xs-12', 'required']) !!}
                      </div>
                  </div>

                  <div class="item form-group">
                      {!! Form::label('parent', 'Parent Category', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::select('parent', $categorieslist, null, ['class' => 'form-control col-md-7 col-xs-12', 'placeholder' => 'Select a parent category']) !!}
                      </div>
                  </div>

                  <div class="item form-group">
                      {!! Form::label('leaf', 'Is This A Leaf Category', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::select('leaf', ['1'=>'Yes','0'=>'No'], '0', ['class' => 'form-control col-md-7 col-xs-12', 'required']) !!}
                      </div>
                  </div>

                  <div class="item form-group">
                      {!! Form::label('isroot', 'Is Root Category?', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                      <div class="col-md-6 col-sm-6 col-xs-12">
                              {!! Form::select('isroot', ['1'=>'Yes','0'=>'No'],'0', ['class' => 'form-control col-md-7 col-xs-12', 'required']) !!}


                      </div>
                  </div>

                  <div class="ln_solid"></div>
                  <div class="form-group">
                          <div class="col-md-6 col-md-offset-3">
                                  <a href="{!! route('categories.index')  !!}" class="btn btn-round btn-primary">Cancel</a>
                                  <button id="send" type="submit" class="btn btn-round btn-success">Save</button>
                          </div>
                  </div>
              {!! Form::close() !!}
        </div>      
   </div>     
@endsection


