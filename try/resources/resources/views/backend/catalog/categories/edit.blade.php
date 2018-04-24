@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--    <h2>Categories List</h2>-->
    <!--<div class="page-top-links">-->
    <!--</div>-->
@endsection

@section('right_col_title_right')
@endsection

@section('right_col')
    
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
            <h2>Edit {!!  $categories->label  !!}</h2>
            <a href="{!! route('categories.create')  !!}" class="btn btn-round btn-default">Create New</a>
            <a href="{!! route('categories.assign', $categories->cat_id)  !!}" class="btn btn-default">Assign Attributes</a>
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

            {!! Form::model($categories, [
                'method' => 'PUT',
                'route' => ['categories.update', $categories->cat_id],
                'class' => 'form-horizontal form-label-left',
                'novalidate'=>''
            ]) !!}



                <div class="item form-group">
                    {!! Form::label('cat_id', 'Category ID', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('cat_id', $categories->cat_id, ['class' => 'form-control col-md-7 col-xs-12', 'readonly']) !!}
                    </div>
                </div>

                <div class="item form-group">
                    {!! Form::label('name', 'Name', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('name', $categories->name, ['class' => 'form-control col-md-7 col-xs-12', 'required']) !!}
                    </div>
                </div>

                <div class="item form-group">
                    {!! Form::label('slug', 'Category Slug', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('slug', $categories->slug, ['class' => 'form-control col-md-7 col-xs-12', 'required']) !!}
                    </div>
                </div>

                <div class="item form-group">
                    {!! Form::label('parent', 'Parent Category', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::select('parent', $categorieslist, $categories->parent, ['class' => 'form-control col-md-7 col-xs-12', 'required']) !!}
                    </div>
                </div>

                <div class="item form-group">
                    {!! Form::label('leaf', 'Is This A Leaf Category', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::select('leaf', ['1'=>'Yes','0'=>'No'], $categories->leaf, ['class' => 'form-control col-md-7 col-xs-12', 'required']) !!}
                    </div>
                </div>

                <div class="item form-group">
                    {!! Form::label('isroot', 'Is Root Category?', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        @if(isset($categories->parent) && $categories->parent !== '0' && $categories->parent !== 0)
                            {!! Form::select('isroot', ['1'=>'Yes','0'=>'No'],'0', ['class' => 'form-control col-md-7 col-xs-12', 'required']) !!}
                        @else
                            {!! Form::select('isroot', ['1'=>'Yes','0'=>'No'],'1', ['class' => 'form-control col-md-7 col-xs-12', 'required']) !!}
                        @endif

                    </div>
                </div>


                <div class="ln_solid"></div>
                <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                                <a href="{!! route('categories.index')  !!}" type="submit" class="btn btn-round btn-primary">Cancel</a>
                                <button id="send" type="submit" class="btn btn-round btn-success">Save</button>
                        </div>
                </div>
            {!! Form::close() !!}

        </div>
    </div>
 @endsection


