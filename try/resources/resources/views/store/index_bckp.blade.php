@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <h2>Gdoox Marketplace</h2>
@endsection

@section('right_col')
<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{!!  Session::get('message')  !!}</div>
@endif

@if ( !$products->count() )
    <div class="alert alert-warning">You have no Products</div>
@else

    <div class="row">
            <div class="card-body">
            {!! Form::model('$products', [
                'method' => 'GET',
                'class' => 'form-label-left',
                'novalidate'=>''
                ]) !!}   
            <h3 class="text-center">Categories</h3>
            <div class="well card" style="overflow: auto;">

                <ul id="ul_data" name='ul_data'>
                    @foreach ($products_list as $k1=>$top)
                    <li data-cat_id="{!! $k1 !!}" id="{!! $k1 !!}" name='li_sub_data'>
                        <i class="input-helper"></i>
                        {!! $top['name'] !!}
                        <ul id="ul_sub_data" name='ul_sub_data'>
                            @foreach($top['values'] as $k2=>$child)
                            <li data-cat_id="{!! $k2 !!}" id="{!! $k2 !!}" name='li_sub_data'>
                                <label class="checkbox checkbox-inline m-r-20">
                                    @if(in_array($k2,$filtered_cat))
                                    {!! Form::checkbox('cat_id[]', $k2, array('checked')) !!}
                                    @else
                                    {!! Form::checkbox('cat_id[]', $k2) !!}
                                    @endif
                                    <i class="input-helper"></i>    
                                    {!! $child !!} ({!! $products_counts[$k2] !!})
                                </label> 
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    @endforeach
                 </ul>
                <hr>
                
                <div class="form-group clearfix">      
                    <button class="btn btn-primary waves-effect waves-effect">Filter</button>
                </div>
            </div>
<!--         {!! Form::close()!!}-->
         </div>
    </div>
    
    
    <div class="card-body card-padding">
        <div class="row">
<!--            {!! Form::model($products, [
                'method' => 'GET',
                'class' => 'form-horizontal form-label-left',
                'novalidate'=>''
            ]) !!}-->
            <div class="col-md-4  form-group top_search" style="padding: 20px 0; margin-left: 0px;">
                <div class="input-group">
                    {!! Form::text('keyword',$keyword,array('','placeholder'=>'Search Categories...','class'=>'form-control searchallshopcategories'))!!}
                    <span class="input-group-btn">
                        <button class="btn btn-default btn-icon-text waves-effect"><i class="zmdi zmdi-search"></i></button>
                    </span>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    <?php $pcnt=0 ;?>
        @foreach( $products as $product )           
            @if($pcnt % 2==1)
                <div class="row">   
                    @endif

                    <div class="col-md-3 col-sm-3 col-xs-6 ">
                        <div class="card">
                            <div class="card-body">
                                <a href="<?php echo URL('shop/'.$product->shopid.'/show', $product->id)?>" class="prod_thumb">
                                @if ($product->thumb !== "") 
                                    <img src="{!!  $product->thumb  !!}" alt="prodcuct" />
                                @else
                                    <img src="{{ asset('images/product_img.png') }}" alt="prodcuct" />
                                @endif
                                </a>
                            </div>

                            <div class="card-body card-padding">
                                <h6>{!!  $product->desc  !!}</h6>
                                <p>Post Date: {!!  $product->postdate  !!}</p>
                                <h6>{!!  $product->product_data[16]  !!}</h6>
                                <p>Price : {!!  $product->product_data[13] !!} {!! $product->product_data[16]  !!}</p>
                                <br/>
                                <a href="<?php echo URL('shop/'.$product->shopid.'/show', $product->id)?>" class="btn btn-info">View Detail</a>
                            </div>
                        </div>
                    </div>
                    @if( $pcnt === 4 )
                </div>   
            @endif                        
            <?php $pcnt++; ?>                        
        @endforeach
    <!--</div>-->
@endif
@endsection


@section('footer_add_js_script')
<style>
    .ui-menu-item{
        width: 300px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;        
        font-size: 11px;
    }   
    .ui-widget-content{
        max-height: 400px;
        overflow: scroll;
    }
</style>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
    jQuery(function($) {
        $(".searchallshopcategories").autocomplete({
            source: function( request, response ) {   
                $.ajax({
                    url: "{!! URL::route('auto_search_shop_all_categ')  !!}",
                    dataType: "json",
                    data: {
                            term: request.term,
                    },
                    success: function(json) {
                        response( $.map( json, function( item ) {
                            return {
                                value: item.attribute
                            }
                        }));
                    }
                });
            },
            autoFocus: true,
            minLength: 3,
            });
        });
</script>

@endsection