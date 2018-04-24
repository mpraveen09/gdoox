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
            <h2>Product Variations</h2>
	</div><!-- .card-header -->
        
<!--        <h3><?php // echo count($variationproducts); ?></h3>-->
        
<!--        {{ var_dump($variationproducts[0]->desc ) }}-->
        
        <div class="card-body">
<!--            <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">-->
                <table style="font-size: 13px;" id="example" class="display nowrap" cellspacing="0" width="100%">
<!--                <table style="font-size: 10px;" class="table table-striped responsive-utilities jambo_table ">-->
                    <thead> 
                        <th style="width: 200px;">Field Names:</th>
                        @foreach($variationproducts as $pdv)
                            <th>{!! $pdv->desc !!}</th>
                        @endforeach
                    </thead>
                    
                    <tbody>    
                        @foreach($variationproducts[0]['product_data'] as $pdk=>$pdv)
                            <tr  @if(in_array($pdk, $attrVarIds)) style="background-color: #ffcce0!important; border-bottom:1px solid #737373;" @endif>
                                <td  @if(in_array($pdk, $attrVarIds)) style="background-color: #ffcce0!important;" @endif>
                                    {!!  wordwrap($fieldattr[$pdk],25,"<br>\n") !!}
                                </td>
                                
                                @foreach($variationproducts as $variations)
                                    <td>
                                        @if(!empty($variationproducts[0]['product_data'][$pdk]))
                                            @if(is_array($variations->product_data[$pdk]))
                                               {!! implode (", ", $variations->product_data[$pdk]) !!}
                                            @else
                                                @if(in_array($pdk, $imageattrs))
                                                    <img src="{!! asset($variations->product_data[$pdk])!!}" alt="Product" width="50" height="42">
                                                @elseif($pdk === 73)
                                                    <a href="" class="prod_color">
                                                        <span class="cp-value2" style="width: 20px; height: 20px; background-color: {!! $variations->product_data[$pdk] !!}"></span>
                                                    </a>
                                                @else
                                                    {!! $variations->product_data[$pdk] !!}
                                                @endif   
                                            @endif
                                        @else
                                            Not Available
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>        
            <!--</div> -->
            <div class="col-md-12 text-center">
                <a href="{!! route('update-product-variation', $id) !!}" class="btn btn-round btn-success">Create</a>
                <a href="{!! route('edit-product-variation', ['productid'=>$id]) !!}" class="btn btn-round btn-success">Edit</a>
            </div>
            <br/><br/>
        </div><!-- .card-body -->
           
        
<!--	<div class="card-body">
            <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                <table class="table table-striped responsive-utilities jambo_table ">
                    <tbody>
                        <tr>
                            @foreach($variationproducts as $variations)
                            <td>
                                <table>
                                    <thead> 
                                        <th>{!! $variations->desc !!}</th>
                                    </thead>
                                    <tbody>
                                        
                                        @foreach($variations->product_data as $key=>$value)
                                            <tr>
                                                <td>
                                                    @if(!empty($value))
                                                        @if(!is_array($value))
                                                            {!! $key !!}/{!! $value !!}
                                                        @endif
                                                    @else
                                                        Not Available
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>  
        </div> .card-body -->
    </div><!-- .card -->
    

@endsection

@section('footer_add_js_script')
<style>
div.dataTables_wrapper {
        width: 99%;
        margin: 0 auto;
    }
    table.dataTable tbody td {
        padding: 5px 19px;
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable({
            scrollY: "300px",
            scrollX: true,
            scrollCollapse: true,
            bSort: false,
            paging: false,
             fixedColumns:   {
                leftColumns: 1
            }
        });

        $('#example_info').hide();
        $('#example_filter').hide();
    });
</script>
@endsection
