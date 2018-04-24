@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>{!!$product_type['title']!!} Products</h2>-->
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
            <h2>View All</h2>
            <a href="{!! route($product_type['type'].'.create')  !!}" class="btn btn-default">Create New</a>
	</div><!-- .card-header -->
	
        <div class="card-body">
        @if(!$MultiItemProducts->count())
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                You have no {!!$product_type['title']!!} Product Listed
            </div>    
        @else
            <div class="container">
                {!! Form::open(['route' => $product_type['type'].'.index', 'method' => 'POST', 'class' => 'form-horizontal form-label-left', 'novalidate'=>'' ]) !!}
                <div class="col-md-4 col-sm-4 col-xs-10  form-group top_search" style="padding: 20px 0; margin-left: 0px;">
                    <div class="input-group">
                        {!! Form::select('term', $sites, $term, array('required', 'placeholder'=>'-Filter product by site-', 'class'=>'searchproducts form-control'))!!}
                        <span class="input-group-btn">
                            <button class="btn btn-default btn-icon-text waves-effect"><i class="zmdi zmdi-search"></i></button>
                        </span>                          
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            <!--</div> .card-body -->
            <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                <table class="table table-striped responsive-utilities jambo_table ">
                    <thead>
                        <tr>
                            <th>Site Name</th>
                            <th>Product Name</th>
                            <th>Post Date</th>
                            <th>Action</th>
                            <th>View Item Configuration</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>    
                        @foreach( $MultiItemProducts as $product )
                            <tr>
                                <td>{!! $product->shopid!!}</td>
                                <td>{!! $product->desc!!}</td>
                                <td>{!! $product->postdate!!}</td>
                                <td>
            <!--                    <a href="{!!route($product_type["type"].'.add_multi_item_details', $product->id)!!}" data-toggle="tooltip" data-placement="bottom" title="Add Muli Item Details" ><i class='zmdi zmdi-eye zmdi-hc-fw'></i>Add Details</a>-->
                                    <a href="{!!route($product_type["type"].'.add_product', $product->id)!!}" data-toggle="tooltip" data-placement="bottom" title="Add/Remove Products" >Add/Remove Products</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{!!route($product_type["type"].'.edit', $product->id)!!}" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class='zmdi zmdi-edit zmdi-hc-fw'></i>Edit Details</a>
                                </td>
                                <td><a data-toggle="modal" href="#noAnimation" onclick="getData('{!! $product->id !!}'); return false;" class="btn btn-default">View</a></td>
                                <td>
                                    @if($product->status === "disabled")
                                        <a href="{!!route($product_type["type"].'.toggle', [$product->id, 'status'=>'enabled'])!!}"data-toggle="tooltip" data-placement="bottom" title="Enable" >Enable On Site</a>
                                    @else
                                        <a href="{!!route($product_type["type"].'.toggle', [$product->id, 'status'=>'disabled'])!!}" data-toggle="tooltip" data-placement="bottom" title="Disable" >Disable From Site</a>
                                    @endif
                                </td>
                            </tr>  
                        @endforeach
                    </tbody>
                </table>

                </div>
    
            <div class="row">
                <div class="text-right col-md-12">
                    {!! $MultiItemProducts->render() !!}
                </div>
            </div>  
            
            <div class="modal" id="noAnimation" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Added Products</h4>
                        </div>
                        <div class="modal-body" style="overflow-y: scroll; height:400px;"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            
        @endif
    </div><!-- .card-body -->
</div><!-- .card -->
@endsection

@section('footer_add_js_script')

<script>
function getData(productid){
    $.ajax({
        url: "{!! URL::route('view_item_configuration') !!}",
        data: {
            productid: productid,
        },
        success: function(html) {
            $('.modal-body').html('');
            $('.modal-body').html(html);
        }
    });
}
</script>

@endsection