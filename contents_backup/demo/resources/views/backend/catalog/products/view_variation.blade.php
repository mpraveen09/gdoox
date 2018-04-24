@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')

<!--<div class="page-top-links">-->
    
<!--</div>-->
@endsection

@section('right_col_title_right')
@endsection

@section('header_add_js_script')        
@endsection

@section('right_col')

@if (Session::has('message'))
    <div class="alert alert-info">{!!  Session::get('message')  !!}</div>
@endif

    @if (HTML::ul($errors->all()))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!! HTML::ul($errors->all()) !!}
        </div>
    @endif
    
    <div class="card">
	<div class="card-header bgm-blue head-title">
            <h2>Product Variation</h2>
	</div><!-- .card-header -->
        
	<div class="card-body">
            <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                <table class="table table-striped responsive-utilities jambo_table ">
                    <thead>
                        <tr>
                            <th>Field Name</th>
                            <th>Product</th>
                            <th>Variation Product</th>
                        </tr>
                    </thead>
                    <tbody>   
                      
                    @foreach($mainproduct->product_data as $key=>$product)
                        <tr @if(!is_array($product) && !is_array($varproduct->product_data[$key])) @if($product!=$varproduct->product_data[$key]) style="background-color: #ffcce0!important; border-bottom:1px solid #737373;" @endif @endif>
                                <td>{!! $fields[$key] !!}</td>
                                <td>
                                    @if(is_array($product))
                                        {!! implode (", ", $product); !!}
                                    @else
                                        @if($key===73)
                                            <a href="" class="prod_color">
                                                <span class="cp-value2" style="width: 20px; height: 20px; background-color: {!! $product !!}"></span>
                                            </a>
                                        @elseif($key=== 47 || $key=== 48 || $key=== 49)
                                            @if($product!= null || $product!="")
                                                <img src="{!! asset($product)   !!}" alt="Smiley face" width="50" height="42">
                                            @else
                                                N/A
                                            @endif
                                        @else
                                            {!! $product !!}
                                        @endif
                                    @endif
                                </td>                                                                                                                                                                                                                                                                                                                 
                                <td>
                                    @if(is_array($varproduct->product_data[$key]))
                                        {!! implode(", ", $varproduct->product_data[$key]) !!}
                                    @else
                                        @if($key===73)
                                            <a href="" class="prod_color">
                                                <span class="cp-value2" style="width: 20px; height: 20px; background-color: {!! $varproduct->product_data[$key] !!}"></span>
                                            </a>
                                        @elseif($key=== 47 || $key=== 48 || $key=== 49)
                                            @if($varproduct->product_data[$key]!= null || $varproduct->product_data[$key]!="")
                                                <img src="{!! asset($varproduct->product_data[$key]) !!}" alt="Product Image" width="50" height="42">
                                            @else
                                                N/A
                                            @endif
                                        @else
                                            {!! $varproduct->product_data[$key] !!}
                                        @endif
                                    @endif
                                </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td>SEO Title</td>
                        <td>{!! $mainproduct->seo_title !!}</td>
                        <td>{!! $varproduct->seo_title !!}</td>
                    </tr>
                    <tr>
                        <td>SEO Description</td>
                        <td>{!! $mainproduct->seo_description !!}</td>
                        <td>{!! $varproduct->seo_description !!}</td>
                    </tr>
                    <tr>
                        <td>SEO Keywords</td>
                        <td>{!! $mainproduct->seo_keywords !!}</td>
                        <td>{!! $varproduct->seo_keywords !!}</td>
                    </tr>
                    
                    </tbody>
                </table>
                <div class="col-md-12 text-center">
                    <a href="{!! route('update-product-variation', $varproduct->id) !!}" class="btn btn-round btn-success">Create Product Variation</a>
                    <a href="{!! route('product.edit', $varproduct->id) !!}" class="btn btn-primary waves-effect">Edit Product</a><br/>
                    <br/><br/>
                </div>
                </div>  
        </div><!-- .card-body -->
    </div><!-- .card -->
    

@endsection

@section('footer_add_js_script')
   
@endsection
