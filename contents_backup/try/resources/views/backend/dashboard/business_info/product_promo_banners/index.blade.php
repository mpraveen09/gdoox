@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>Products</h2>-->
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

    @include('navigation_tabs.product_mgmt_tabs')
    
    <div class="card">
	<div class="card-header bgm-blue head-title">
            <h2>Product Promotional Banner/Stickers</h2>
            <a href="{!! route('product_promo.select_product')  !!}" class="btn btn-default">Create New</a>
	</div><!-- .card-header -->
	<div class="card-body">
            @if(!$product_promos->count())
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    You have not created promotional banner
                </div>    
            @else
                <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                    <table class="table table-striped responsive-utilities jambo_table ">
                        <thead>
                            <tr>
                                <th>Site Name</th>
                                <th>Product Name</th>
                                <th>Product Promo Text</th>
                                <th>Background Color</th>
                                <th>Text Color</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>    
                        @foreach( $product_promos as $product_promo )
                            <tr>
                                <td>{!! $product_promo->site_slug !!}</td>
                                <td>{!! $product_promo->product_name !!}</td>
                                <td>{!! $product_promo->product_promo_text !!}</td>
                                <td>
                                    <div class="product_promo_banner_color" style="background-color: {!!$product_promo->banner_bg_color!!};"></div>
                                </td>
                                <td>
                                    <div class="product_promo_banner_color" style="background:{!!$product_promo->product_promo_text_color!!}"> </div>
                                </td>
                                <td>
                                    <a href="{!! route('{shopid}/show/', [$product_promo->site_slug, $product_promo->product_id, 'preview'=>'banner'])  !!}" data-toggle="tooltip" data-placement="bottom" title="view"><i class='zmdi zmdi-eye zmdi-hc-fw'></i></a> &nbsp; 
                                    <a href="{!! route('product_promo.edit', $product_promo->_id)  !!}"data-toggle="tooltip" data-placement="bottom" title="Edit"><i class='zmdi zmdi-edit zmdi-hc-fw'></i>Edit</a>
                                    @if($product_promo->status == "disabled")
                                        <a href="{!!route('product_promo.toggle', [$product_promo->id, 'enabled'])!!}" >Show On Site</a>  
                                    @else
                                        <a href="{!!route('product_promo.toggle', [$product_promo->id, 'disabled'])!!}" >Hide From Site</a>  
                                    @endif
                                </td>
                            </tr>  
                        @endforeach

                            <tr>
                              <td><br/><br/><br/></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                        </tbody>
                    </table>

                    </div>
                <div class="row">
                    <div class="text-right col-md-12">
                        {!! $product_promos->render() !!}
                    </div>
                </div>    
            @endif
        </div><!-- .card-body -->
    </div><!-- .card -->
@endsection