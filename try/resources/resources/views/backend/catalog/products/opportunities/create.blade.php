@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')

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
   
    @include('navigation_tabs.marketing_tabs')
   
    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>Opportunity Product</h2>
            <!--<div class="page-top-links">-->
            <a href="{!! route('opportunities.product')  !!}" class="btn btn-default">List Products</a>
            <a href="{!! route('opportunities.index')  !!}" class="btn btn-default">View All</a>
        </div><!-- .card-header -->
        <div class="card-body card-padding">    
          {!! Form::model($product, array(
                    'method'=>'PUT', 
                    'route' => ['opportunities.save', $product->id], 
                    'class'=>'form-horizontal form-label-left')
                    ) !!}

                  <div class="form-group clearfix">
                      @if(!empty($field['shop_id']))
                          {!! Form::label('shopid', 'Site Name', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12', 'data-toggle'=>"tooltip", 'data-placement'=>"bottom", 'title'=>'')) !!} 
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::select("attr_id[".$field['shop_id']->attr_id."]", $site, $product->shopid, array('class'=>'form-control')) !!}
                          </div>    
                      @endif
                  </div>

                  <div class="form-group clearfix">
                      @if(!empty($field['post_date']))
                           {!! Form::label($field['post_date']->desc, $field['post_date']->label."*", array('class'=>'control-label col-md-3 col-sm-3 col-xs-12', 'data-toggle'=>"tooltip", 'data-placement'=>"bottom", 'title'=>$field['post_date']->desc)) !!} 
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::date("attr_id[".$field['post_date']->attr_id."]", $product->product_data[$field['post_date']->attr_id], array('required', 'class'=>'form-control', 'id'=>'postdate', 'min'=>$product->product_data[$field['post_date']->attr_id], 'readonly')) !!}
                          </div>    
                      @endif
                  </div>
              
                  <div class="form-group clearfix">
                      @if(!empty($field['product_name']))
                           {!! Form::label($field['product_name']->desc, $field['product_name']->label."*", array('class'=>'control-label col-md-3 col-sm-3 col-xs-12', 'data-toggle'=>"tooltip", 'data-placement'=>"bottom", 'title'=>$field['product_name']->desc)) !!} 
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::text("attr_id[".$field['product_name']->attr_id."]", $product->desc, array('required', 'class'=>'form-control')) !!}
                          </div>    
                      @endif
                  </div>   
                    
                  @foreach($form as $frm)
                        {!!$frm!!}
                  @endforeach
                  
                  {!!Form::hidden('attr_id[14]', $product->product_data[14])!!}
                  
                  <div class="form-group clearfix">
                        {!! Form::label($field['seller_ref_code']->desc, $field['seller_ref_code']->label."*", array('class'=>'control-label col-md-3 col-sm-3 col-xs-12', 'data-toggle'=>"tooltip", 'data-placement'=>"bottom", 'title'=>$field['seller_ref_code']->desc)) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text("attr_id[".$field['seller_ref_code']->attr_id."]", $product->product_data[$field['seller_ref_code']->attr_id], array('id'=>'seller_ref_code','required', 'class'=>'form-control')) !!}
                        </div>    
                  </div>
                  
                  <div id="new_price_div">
                        <div class="form-group clearfix">
                            {!! Form::label("New Price (B2B)", "Opportunity Price (B2B)"."*", array('class'=>'control-label col-md-3 col-sm-3 col-xs-12', 'data-toggle'=>"tooltip", 'data-placement'=>"bottom", 'title'=>"New Price (B2B)")) !!} 
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::text("new_price_b2b", $product->opportunity_b2b_price , array('required', 'class'=>'form-control')) !!}
                            </div>    
                        </div>
                  
                        <div class="form-group clearfix">
                            {!! Form::label("New Price (B2C)", "Opportunity Price (B2C)"."*", array('class'=>'control-label col-md-3 col-sm-3 col-xs-12', 'data-toggle'=>"tooltip", 'data-placement'=>"bottom", 'title'=>"New Price (B2C)")) !!}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::text("new_price_b2c", $product->opportunity_b2c_price , array('required', 'class'=>'form-control')) !!}
                            </div>    
                        </div>
                  </div>
                  
                  
                <?php $startdate = !empty($product->start_date)?$product->start_date:null;?>
                <div class="form-group clearfix">
                         {!! Form::label('opportunity_start_date', "Opportunity Start Date"."*", array('class'=>'control-label col-md-3 col-sm-3 col-xs-12', 'data-toggle'=>"tooltip", 'data-placement'=>"bottom", 'title'=>'Opportunity Start Date')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php $mindate=($product->product_data[$field['post_date']->attr_id] >= date("Y-m-d"))?$product->product_data[$field['post_date']->attr_id]:date("Y-m-d"); ?>
                        {!! Form::date("opportunity_start_date", $startdate, array('required', 'class'=>'form-control', "id"=>"from", 'min'=>$mindate)) !!}
                        </div>    
                </div>
                <?php $enddate = !empty($product->end_date)?$product->end_date:null;?>
                <div class="form-group clearfix">
                         {!! Form::label('opportunity_end_date', "Opportunity End Date"."*", array('class'=>'control-label col-md-3 col-sm-3 col-xs-12', 'data-toggle'=>"tooltip", 'data-placement'=>"bottom", 'title'=>'Opportunity End Date')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::date("opportunity_end_date", $enddate, array('required', 'class'=>'form-control',  "id"=>"to")) !!}
                        </div>    
                </div>
                
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                         <button id="send" type="submit" class="btn btn-round btn-success">Save</button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>    
@endsection


@section('footer_add_js_script')
  <script type="text/javascript">
    $(document).ready(function(){
        $('#from').change(function (){
              var start_date = $("#from").val();
              var myDate = new Date(new Date(start_date).getTime()+(1*24*60*60*1000));
              var dd = myDate.getDate();
              var mm = myDate.getMonth() + 1;
              if(mm<10){
                mm = "0"+mm;
              }
              var y = myDate.getFullYear();
              var end_date = y + '-' + mm + '-' + dd;
             $("#to").attr('min', end_date)
        });
    });
    
    
    $(window).on("load",function(){
        $("#new_price_div").insertAfter("#old_price_div");
        document.getElementById("attr_id['15']").disabled = true;
        document.getElementById("attr_id['16']").disabled = true;
        document.getElementById("attr_id['14']").disabled = true;
        document.getElementById("seller_ref_code").disabled = true;
    });
    
    
    //------------  disable the fields-----------
    $(document).ready(function(){
        // $("select[name='attr_id[14]']").prop("readonly", true);
        @if(!empty($product->disable_edit) && $product->disable_edit === "Yes")
            document.getElementById("attr_id['8']").disabled = true;
           // $("input[name='attr_id[8]']").prop("readonly", true);
           @foreach($attributes as $attribute)
                document.getElementById("attr_id['{!! $attribute->attr_id !!}']").disabled = true;
                // $("input[name='attr_id[{!!$attribute->attr_id!!}]']").prop("readonly", true);
           @endforeach
        @endif
    });

     function goBack() {
            window.history.back();
    }
  </script>

@endsection
