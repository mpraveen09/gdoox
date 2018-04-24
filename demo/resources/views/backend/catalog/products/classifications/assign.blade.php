  @extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>Product Management</h2>-->
@endsection

@section('right_col_title_right')
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
    
    @include('navigation_tabs.general_tabs')
    
    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>Assign Product Classifications/Labels</h2>
        </div><!-- .card-header -->
          {!! Form::open(array('route' => 'products/classifications/storeproductlabel', 'method'=>'POST', 'class'=>'form-horizontal form-label-left')) !!}
            <div class="card-body card-padding">

                {!!Form::hidden('product_id', $product->_id)!!}
                {!!Form::hidden('user_id', $product->userid)!!}
                
                <div class="col-md-12 ">
                      <div class="col-md-1">
                          @if(!empty($product->shopid))
                              <h6>{!!  $product->shopid  !!}</h6>
                                {!!Form::hidden('shop_id', $product->shopid)!!}
                          @endif
                      </div>

                      <div class="col-md-3">
                          <a href="{!! route('products/show', $product->id)  !!}" class="prod_thumb">
                              @if(isset($product->product_images))
                                  @if(!empty($product->product_images))
                                     <?php $count = count($product->product_images); ?>
                                      <img src="{!! asset($product->product_images[$count-1])  !!}" alt="Product Image" width="100px;" height="100px;"/>
                                  @else
                                      @if(!empty($product->thumb))
                                          @if (file_exists($product->thumb_path.$product->thumb))
                                              <img src="{!!  asset($product->thumb_path.$product->thumb)  !!}" alt="Product Image" width="100px;" height="100px;"/>
                                          @else
                                              <img src="{{ asset('images/product_img.png') }}" alt="Product Image" width="100px;" height="150px;" />
                                          @endif
                                      @else
                                          <img src="{{ asset('images/product_img.png') }}" alt="Product Image" width="100px;" height="150px;" />
                                      @endif
                                  @endif
                              @else
                                  @if(!empty($product->thumb))
                                          @if (file_exists($product->thumb_path.$product->thumb))
                                              <img src="{!!  asset($product->thumb_path.$product->thumb)  !!}" alt="Product Image" width="100px;" height="100px;"/>
                                          @else
                                              <img src="{{ asset('images/product_img.png') }}" alt="Product Image" width="100px;" height="150px;" />
                                          @endif
                                      @else
                                          <img src="{{ asset('images/product_img.png') }}" alt="Product Image" width="100px;" height="150px;" />
                                      @endif
                              @endif
                          </a>
                      </div>

                      <div class="col-md-3">
                          @if(!empty($product->desc))
                            <h6>{!!  $product->desc  !!}</h6>
                          @endif
                      </div>

                      <div class="col-md-2">
                          @if(!empty($product->postdate))
                            <p>Post Date: {!!  $product->postdate  !!}</p>
                          @endif
                      </div>

                      
                </div>                
                
                
                <div class="form-group clearfix">
                @if(!empty($pc))
                    {!! Form::label('class_label_id','Select Product Classification/Label', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        @if(!empty($pci)) 
                            @if(array_key_exists($pci, $pc)) 
                                {!! Form::select('class_label_id', $pc, $pci, array('required','placeholder' => 'Select A Label', 'class'=>'form-control')) !!}
                                <br/>
                                The selected Classification/Label (<strong>{!! $pc[$pci] !!}</strong>) already assigned to the above product. <br/>Do you want to change it? 
                            @else
                                {!! Form::select('class_label_id', $pc, null, array('required','placeholder' => 'Select A Label', 'class'=>'form-control')) !!}
                            @endif
                        @else
                            {!! Form::select('class_label_id', $pc, null, array('required','placeholder' => 'Select A Label', 'class'=>'form-control')) !!}
                        @endif
                    </div>    
                @else
                    <br/>
                    You have no labels created. Create from <a href="{!! route('classifications_labels.create')!!}">here</a>
                @endif
                </div>
                

                
                <div class="form-group clearfix">     
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <a href="{!! route('classifications_labels.index')  !!}" class="btn btn-round btn-danger">Cancel</a>
                        @if(!empty($pc))
                        <button type="submit" class="btn btn-primary waves-effect">Assign</button>
                        @endif
                    </div>
                </div>
            </div> 
          {!! Form::close() !!}
    </div>

        </div><!-- .card-body -->
    </div>

@endsection   
