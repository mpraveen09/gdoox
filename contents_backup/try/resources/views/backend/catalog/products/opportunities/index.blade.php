@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')

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
            <h2>Opportunities</h2>
            <a href="{!! route('opportunities.product')  !!}" class="btn btn-default">List Products</a>
	</div><!-- .card-header -->
	<div class="card-body">
            @if(!$products->count())
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    You have no opportunity listed
                </div>    
            @else
   
                <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                    <table class="table table-striped responsive-utilities jambo_table ">
                        <thead>
                            <tr>
                                <th>Site Name</th>
                                <th>Image</th>
                                <th>Opportunity Name</th>
                                <th>Product</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Action</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>   
                          <?php $i = 0;?>
                        @foreach( $products as $product )
                            <tr>
                                <td>{!! $site_name[$i]!!}</td>
                                <td><img src="{!!asset($product->thumb_path.$product->thumb)!!}" width="50"></td>
                                <td>{!! $product->desc!!}</td>
                                <td>{!! $product_name[$i]!!}</td>
                                <td>{!! $product->start_date!!}</td>
                                <td>{!! $product->end_date!!}</td>
                                <td>
                                   <a href="{!!route('opportunities.create', $product->id)!!}" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class='zmdi zmdi-edit zmdi-hc-fw'></i>Edit</a>
                                </td>
                                <td>
                                  @if($product->status === "disabled")
                                  <a href="{!!route('opportunities.toggle', [$product->id, 'status'=>'enabled'])!!}"data-toggle="tooltip" data-placement="bottom" title="Enable" >Enable On Site</a>
                                  @else
                                  <a href="{!!route('opportunities.toggle', [$product->id, 'status'=>'disabled'])!!}" data-toggle="tooltip" data-placement="bottom" title="Disable" >Disable From Site</a>
                                  @endif
                                </td>
                            </tr>  
                            <?php $i++;?>
                        @endforeach
                        </tbody>
                    </table>

                    </div>
    
                <div class="row">
                    <div class="text-right col-md-12">
                        {!! $products->render() !!}
                    </div>
                </div>    
            @endif
        </div><!-- .card-body -->
    </div><!-- .card -->
@endsection