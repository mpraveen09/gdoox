@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <h3> {!!  $product->desc   !!}</h3>
@endsection

@section('right_col_title_right')
    <!--<a href="{!! route('store/list')  !!}" class="btn btn-round btn-default">View All</a>-->
@endsection
@section('right_col')

    <!-- will be used to show any messages -->
    @if (Session::has('message'))
        <div class="alert alert-info">{!!  Session::get('message')  !!}</div>
    @endif

    <div class="card">
      <div class="card-header bgm-blue">
          <h2></h2>
      </div><!-- .card-header -->
        
      <div class="card-body card-padding">
        <div class="row">
          <div class="col-md-7 col-sm-7 col-xs-12">
            <div class="product-image">
                <img src="{!!  $product->thumb  !!}" alt="Product" />
            </div>
              <!-- <div class="product_gallery">
                <a>
                    <img src="{!!  $product->thumb  !!}" alt="prodcuct" />
                </a>
                <a>
                    <img src="{!!  $product->thumb  !!}" alt="prodcuct" />
                </a>
                <a>
                    <img src="{!!  $product->thumb  !!}" alt="prodcuct" />
                </a>
            </div>-->
          </div>

          <div class="col-md-5 col-sm-5 col-xs-12" style="border:0px solid #e5e5e5;">
            <h3 class="prod_title">{!!  $product->desc  !!}</h3>
            <p>{!!  $product->product_data[6]  !!}</p>
            <br>
            <br>
            <br>
            <div class="">
              <div class="product_price">
                <h1 class="price">
                  @if(!empty($product->product_data[15]))
                    <!--Price: B2B {!! $product->product_data[15]  !!} {!!  substr($product->product_data[13], -3) !!}-->
                    Price: B2B <button class="btn btn-warning btn-xs waves-effect">Request B2B Price</button>
                    <br/>
                  @endif
                  @if(!empty($product->product_data[16]))
                    Price: B2C {!! $product->product_data[16]  !!} {!!  substr($product->product_data[13], -3) !!}
                    <br/>
                  @endif
                  @if(!empty($product->product_data[20]))
                    Price: Auction {!! $product->product_data[20]  !!} {!!  substr($product->product_data[13], -3) !!}
                    <br/>
                  @endif
                  @if(!empty($product->product_data[33]))
                    Price: Reverse Auction {!! $product->product_data[33]  !!} {!! substr($product->product_data[13], -3) !!}
                    <br/>
                  @endif

                </h1>                                  
                <br>
              </div>
              </div>

              <div class="test">
                  <button type="button" class="btn btn-default btn-lg add_to_cart" id="add_to_cart">Add to Cart</button>
                  <button type="button" class="btn btn-default btn-lg">Add to Wishlist</button>
              </div>

              <div class="product_social">
                  <ul class="list-inline">
                      <li><a href="#"><i class="fa fa-facebook-square"></i></a>
                      </li>
                      <li><a href="#"><i class="fa fa-twitter-square"></i></a>
                      </li>
                      <li><a href="#"><i class="fa fa-envelope-square"></i></a>
                      </li>
                      <li><a href="#"><i class="fa fa-rss-square"></i></a>
                      </li>
                  </ul>
              </div>
          </div>
          </div>    

          <div class="row">
              <div class="col-md-12 ">
                  @foreach( $productTabs as $productTab )
                          {!!  $productTab   !!}
                  @endforeach 
              </div>
          </div>
        </div>
    </div>
@endsection

@section('footer_add_js_script')

<script type="text/javascript">
    jQuery(function($) {
        $("#add_to_cart").click(function() 
            var product_id = '{!! $product->id !!}';
            var product_desc =  '{!! $product->desc !!}';
                $.ajax({
                    url: "{!! URL::route('add_to_cart')  !!}",
                    data: {
                            product_id: product_id,
                            product_desc: product_desc
                    },
                    success: function(data) {
                        $('.tmn-counts').html(data);
                    }
                }); 
            });
        });
</script>

@endsection




