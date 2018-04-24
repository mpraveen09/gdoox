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

    @if (HTML::ul($errors->all()))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!! HTML::ul($errors->all()) !!}
        </div>
    @endif
    
    @if (Session::has('message'))
        <div class="alert alert-info">{!!  Session::get('message')  !!}</div>
    @endif
    
    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>Variation</h2>
        </div><!-- .card-header -->
            @if($productvars->count() > 0)
                <div class="card-body card-padding">
                    <h4>Available Variations</h4>
                </div>
        
                <div class="card-body card-padding">
                    <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                        <table class="table table-striped responsive-utilities jambo_table ">
                            <thead>
                                @foreach($product->product_data as $k1=>$v1)
                                    @if(array_key_exists($k1, $variationids))
                                        <th>{!! $variationids[$k1] !!}</th>
                                    @endif
                                @endforeach
                                <th>Quantity</th>
                                <th>Price</th>
                            </thead>
                            
                            <tbody>
                                @foreach($productvars as $vars)
                                <tr>
                                    @foreach($vars->product_data as $k1=>$v1)
                                        @if(array_key_exists($k1, $variationids))
                                            <td>
                                                @if($k1===73)
                                                    <button type="button" style="width: 20px; height: 20px; background-color: {!! $v1 !!};" class="btn btn3"></button>
                                                @else
                                                    @if($v1!=='')
                                                        {!! $v1 !!}
                                                    @else
                                                        N/A
                                                    @endif
                                                @endif
                                            </td>
                                        @endif
                                    @endforeach
                                    <td>
                                        @if(isset($vars->product_data[8]))
                                            {!! $vars->product_data[8] !!}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if(isset($vars->product_data[16]))
                                            {!! $vars->product_data[16] !!}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>  
                                @endforeach
                            </tbody>
                         </table>
                    </div>
                </div>
            @endif
            
            <hr>
<!--    </div>
    
    <div class="card">-->
        <div class="jumbotron">
            <p>Do you want to create a Variation for this product to change Color, Size, Price etc.
            If Yes please click on the Button "Yes Make a Variation", otherwise click Cancel to return to the Product List. </p> 
        </div>
 
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12 text-center">
                        <button type="button" id="show_variation_form" class="btn btn-primary btn-success">Add Variations</button>
                        @if($purpose === 'sell')
                            <a href="{!! route('products/list')  !!}" class="btn btn-primary waves-effect">Cancel</a>    
                        @else
                            <a href="{!! route('products/procurements',$purpose)  !!}" class="btn btn-primary waves-effect">Cancel</a>    
                        @endif
                    <br/><br/>
                </div>
                <br/>
            </div>
        </div>
    </div>
 
    {!! Form::open([
        'method' => 'POST',
        'route' => 'create.variation',
        'class' => 'form-horizontal form-label-left',
        'files' => true,
        ]) !!}
        
        
        @if(isset($productForm))
            @if(!empty($productForm))

            {!! Form::hidden('productid',$productid) !!}
            {!! Form::hidden('flag', $flag) !!}

            <div class="card" id="variation_div" style="display: none;">
                <div class="card-header bgm-blue head-title">
                    <h2>Add Variations</h2>
                </div><!-- .card-header -->
                <br />

                <div id="ProdVarDiv">
                    <div id="variations" class="variations">
                        <div class="card-header bgm-bluegray head-title"></div>
                        <div class="row">
                            <div class="col-md-12">
                                @foreach($productForm as $productFormfield )
                                    {!!  $productFormfield   !!}
                                @endforeach 
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12" style="margin: 10px">
                        <div class="col-md-12 text-center">
                            <button type="button" class="btn btn-round btn-primary add_variations">Add More</button> 
                            <br/><br/>
                        </div>
                        <br/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12" style="margin: 10px">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-round btn-primary">Save</button> 
                            <br/><br/>
                        </div>
                        <br/>
                    </div>
                </div> 
            </div>

            @endif
        @endif
        
        @if(isset($variationProductForm))
            @if(!empty($variationProductForm))

                <div class="card" id="variation_div">
                    <div class="card-header bgm-blue head-title">
                        <h2>Edit Variations</h2>
                    </div><!-- .card-header -->
                    <br />
                    
                    {!! Form::hidden('flag', $flag) !!}
                    {!! Form::hidden('productid',$productid) !!}
                    
                    @foreach($variationProductForm as $varProductForm)
                        <div id="ProdVarDiv">
                            <div id="variations" class="variations">
                                <div class="row">
                                    <div class="col-md-12">
                                        @foreach($varProductForm as $productFormfield )
                                            {!!  $productFormfield   !!}
                                        @endforeach 
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- <div class="row">
                        <div class="col-md-12" style="margin: 10px">
                            <div class="col-md-12 text-center">
                                <button type="button" class="btn btn-round btn-primary add_variations">Add More</button> 
                                <br/><br/>
                            </div>
                            <br/>
                        </div>
                    </div>-->

                    <div class="row">
                        <div class="col-md-12" style="margin: 10px">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-round btn-primary">Save</button> 
                                <br/><br/>
                            </div>
                            <br/>
                        </div>
                    </div> 
                </div>
            @endif
        @endif
        
    {!! Form::close() !!}
@endsection


@section('footer_add_js_script')

<script type="text/javascript">
     $( document ).ready(function() {
         $('#show_variation_form').on('click',function(){
            $('#variation_div').show();
         });
         
        $('div').on( "click", '.add_variations', function(e){
            e.preventDefault();
            var newTextBoxDiv = $(document.createElement('div')).attr("class","variations_copy");
            newTextBoxDiv.html($("#variations").html());
            newTextBoxDiv.append('<div class="col-md-12 col-sm-12 col-xs-12"><a href="" class="remove_variation" style="float:right"><i class="zmdi zmdi-delete zmdi-hc-fw" style="font-size:23px;"></i></a></div>');

            newTextBoxDiv.find(".fileinput-preview").each(function() {
                 $(this).children().remove();
            });
            
            newTextBoxDiv.find('.color-picker').each(function(){
                var colorOutput = $(this).closest('.cp-container').find('.cp-value');
                $(this).farbtastic(colorOutput);
            });

            newTextBoxDiv.appendTo("#ProdVarDiv");
            return false;
        });
        
        $('div').on( "click", '.remove_variation', function(e){
            e.preventDefault();
            $(this).closest('.variations_copy').remove();
            return false;
        });

//        $(document).on('change', '.org_type', function(){
//            var org_type = $(this).val();
//            var ref = $(this);
//        }); 
    });    
</script>

@endsection
