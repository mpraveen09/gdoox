@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<h2>{!!$product_type['title']!!} Products</h2>
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
    
    @include('navigation_tabs.marketing_tabs')
    
    <div class="card">
	<div class="card-header bgm-blue head-title">
            <h2>Select Multi-Item Product</h2>
            <a href="{!! route($product_type["type"].'.create')  !!}" class="btn btn-default">Create New</a>
            <a href="{!! route($product_type["type"].'.index')  !!}" class="btn btn-default">View All</a>
	</div><!-- .card-header -->
	<div class="card-body">
            @if(!$MultiItemProducts->count())
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    You have no {!!$product_type['title']!!} Product Listed
                </div>    
            @else
                <div class="card-body card-padding">
                  {!!Form::open(['route'=>'multi_item.store_item'])!!}
                    {!!Form::hidden('product_id', $id)!!}
                    <div class="radio m-b-15">
                        @foreach( $MultiItemProducts as $product )
                        <label>
                            {!!Form::radio('multi_item_id', $product->id)!!}
                            <i class="input-helper"></i>
                            {!!$product->desc!!}
                        </label>
                        @endforeach
                    </div>
                    <button class="btn btn-success" type="submit">Add</button>
                  {!!Form::close()!!}
                </div>
            @endif
        </div><!-- .card-body -->

</div><!-- .card -->
@endsection