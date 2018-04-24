@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <!--<h2>Category Attributes Relation</h2>-->
    <!--<div class="page-top-links">-->
    <!--</div>-->
@endsection

@section('right_col_title_right')
  
@endsection

@section('right_col')

@if (Session::has('message'))
<div class="alert alert-info">{!!  Session::get('message')  !!}</div>
@endif
@if (Session::has('error'))
<div class="alert alert-danger">{!!  Session::get('error')  !!}</div>
@endif
    <!-- if there are creation errors, they will show here -->
    @if (HTML::ul($errors->all()))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!! HTML::ul($errors->all()) !!}
        </div>
    @endif
    
    <div class="card">
	<div class="card-header bgm-blue head-title">
            <h2>Assign Attribute to Top level categories</h2>
            <a href="{!! route('attributes.create')  !!}" class="btn btn-round btn-default">Create New</a>
            <a href="{!! route('attributes.index')  !!}" class="btn btn-round btn-default">View All</a>
	</div><!-- .card-header -->   

        <div class="card-body card-padding"> 
            {!! Form::model($categories, [
                'method' => 'POST',
                'route' => ['attributes.assign', $id],
                'class' => 'form-horizontal form-label-left',
                'novalidate'=>''
            ]) !!}
             
            @foreach($categories as $category)
                {!! Form::hidden('top_cat[]', $category->cat_id) !!}
            @endforeach
            
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <ul id="ul_data" name='ul_data ' class="sidebar_cats">                               
                        @foreach($categories as $category)
                            @if(in_array($category->cat_id, $cat))
                                <li data-cat_id="" id="" name='li_sub_data' class=""><i class="input-helper"></i>
                                   {!! Form::checkbox('category[]',$category->cat_id, true ,array('id' => 'top_level_category')) !!} {!! $category->name !!} ({!! $category->slug !!})
                                </li>
                            @else
                                <li data-cat_id="" id="" name='li_sub_data' class=""><i class="input-helper"></i>
                                   {!! Form::checkbox('category[]', $category->cat_id, false ,array('id' => 'top_level_category')) !!} {!! $category->name !!} ({!! $category->slug !!})
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
             </div>
        
 
            <div class="ln_solid"></div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                    <a href="{!! route('attributes.index')  !!}" type="submit" class="btn btn-round btn-primary">Cancel</a>
                    <button id="send" type="submit" class="btn btn-round btn-success">Save</button>
                </div>
            </div>
        {!! Form::close() !!}
	</div><!-- .card-body -->
    </div><!-- .card -->    
    
@endsection


