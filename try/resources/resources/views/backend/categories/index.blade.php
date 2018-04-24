@extends('layout.backend.master')
@extends('layout.backend.userinfo')
@section('right_col_title_left')
    <!--<h3>Select main Category</h3>--> 
@endsection
@section('right_col')
    <div class="card">
        <div class="card-header bgm-blue head-title">
          <h2>Select main Category</h2>
        </div><!-- .card-header -->
        <div class="card-body card-padding">    
        <?php 
            echo Form::open(array('action'=>'backend\CategoriesController@subCategories'));
            echo Form::select('category',$parent_cat);
            echo Form::submit('Ok');
            echo Form::close();?>
        </div>
    </div>    
@endsection