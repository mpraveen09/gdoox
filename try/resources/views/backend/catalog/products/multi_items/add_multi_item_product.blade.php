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
    
    @include('navigation_tabs.marketing_tabs')
    
    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>{!!$product_type['title']!!} Products</h2>
            <a href="{!! route($product_type['type'].'.create')  !!}" class="btn btn-round btn-default">Create New</a>
            <a href="{!! route($product_type['type'].'.index')  !!}" class="btn btn-round btn-default">View All</a>
        </div><!-- .card-header -->
    
        @if(!empty($multiproduct->purpose))
<!--            <div class="card">
                <div class="card-header bgm-red"><h2>What do you want to do</h2></div>
                <div class="card-body card-padding">
                  <p> I want to {!!$multiproduct->purpose!!}</p>
                </div>
            </div>            -->
        @endif
        <div class="row">
            <div class="col-md-12">
                {!! Form::open([
                    'method' => 'POST',
                    'route' => [$product_type["type"].'.store_multi_item_details', $product->id],
                    'class' => 'form-horizontal form-label-left',
                    'novalidate'=>'',
                    'files' => true
                ]) !!}             
                @foreach( $formFields as $formField )
                        {!!  $formField   !!}
                @endforeach 
            <div class="col-md-12 text-center">
                <button id="send_prod_cat" type="submit" class="btn btn-round btn-success">Add This Product</button>    
                <br/><br/>
            </div>
            {!! Form::close() !!}
                <br/>
            </div>
        </div> 
    </div>
@endsection


@section('footer_add_js_script')

<script type="text/javascript">
$(document).ready(function(){
    @if(!empty($multiproduct->disable_quantity) && $multiproduct->disable_quantity === "Yes")
        $("input[name='attr_id[8]']").prop("readonly", true);
    @endif
});

 function goBack() {
        window.history.back();
    }
</script>

<script>
    $(document).ready(function(){
      $("[disabled]").closest(".form-group").fadeOut(500);
      $( "select" ).change(function() {
            var curElem=$(this).attr("name");
            var curElemTrim= curElem.slice(0, -1);

            //Disbale child inputs
            if($("[name^='"+curElemTrim+";']").length){
                $("[name^='"+curElemTrim+";']").val("");
                $("[name^='"+curElemTrim+";']").prop( "disabled", true );
                $("[name^='"+curElemTrim+";']").closest(".form-group").fadeOut(500);
            }
            if($("[name^='"+curElemTrim+"/']").length){
                $("[name^='"+curElemTrim+"/']").val("");
                $("[name^='"+curElemTrim+"/']").prop( "disabled", true );
                $("[name^='"+curElemTrim+"/']").closest(".form-group").fadeOut(500);
            }

            var curSelect=$(this).prop('selectedIndex');
            if($("[name='"+curElemTrim+";"+curSelect+"]']").length){
                $("[name='"+curElemTrim+";"+curSelect+"]']").prop( "disabled", false );
                //select with parent element and insert after parent of current dropdown
                $("[name='"+curElemTrim+";"+curSelect+"]']").closest(".form-group").insertAfter( $(this).closest(".form-group") );
                $("[name='"+curElemTrim+";"+curSelect+"]']").closest(".form-group").fadeIn(500);
            }
            if($("[name^='"+curElemTrim+";"+curSelect+"/']").length){
                $("[name^='"+curElemTrim+";"+curSelect+"/']").prop( "disabled", false );
                //select with parent element and insert after parent of current dropdown
                $("[name^='"+curElemTrim+";"+curSelect+"/']").closest(".form-group").insertAfter( $(this).closest(".form-group") );
                $("[name^='"+curElemTrim+";"+curSelect+"/']").closest(".form-group").fadeIn(500);
            }       
      });
        
      //For Sale Type Option Selection
      var price_attr = [15,16,17,18,19,20,21,22,23,24,25,26,27,29,"29a",30,31,33];
      price_attr.forEach(function(entry) {
            $("[name='attr_id["+entry+"]']").prop( "disabled", true);
            $("[name='attr_id["+entry+"]']").closest(".form-group").fadeOut(500);
      });
      
      $("select[name='attr_id[14]']").change(function() {
        price_attr.forEach(function(entry) {
            $("[name='attr_id["+entry+"]']").val("");
            $("[name='attr_id["+entry+"]']").prop( "disabled", true );
            $("[name='attr_id["+entry+"]']").closest(".form-group").fadeOut(500);
        });            
        
        var x = document.getElementById("attr_id[14]").selectedIndex;

        switch (x) {
          case 1:
              var price_show = [15,16];
              break;
          case 2:
              var price_show = [27,29,"29a",30,31];
              break;
          case 3:
              var price_show = [20,21,22,23,24,25,26];
              break;
//          case 4:
//              var price_show = [23,24,25,33];
//              break;
          default:
              return;
            break;
        } 
//commented on 01 march 2016        
//        switch (x) {
//          case 1:
//              var price_show = [15,16,17];
//              break;
//          case 2:
//              var price_show = [18,19];
//              break;
//          case 3:
//              var price_show = [20,21,22,23,24,25];
//              break;
//          case 4:
//              var price_show = [23,24,25,33];
//              break;
//          default:
//              return;
//            break;
//        }        
//        switch ($(this).val()) {
//          case "Price":
//              var price_show = [15,16,17,18,19];
//              break;
//          case "Auction":
//              var price_show = [20,21,22,23,24,25];
//              break;
//          case "Reverse Auction":
//              var price_show = [23,24,25,33];
//              break;
//          default:
//              return;
//            break;
//        }
        
        price_show.forEach(function(entry) {
            $("[name='attr_id["+entry+"]']").prop( "disabled", false );
            $("[name='attr_id["+entry+"]']").closest(".form-group").fadeIn(500);
        });            
      });
      
      $("select[name='attr_id[606]']").change(function() {
        price_attr.forEach(function(entry) {
            $("[name='attr_id["+entry+"]']").val("");
            $("[name='attr_id["+entry+"]']").prop( "disabled", true );
            $("[name='attr_id["+entry+"]']").closest(".form-group").fadeOut(500);
        });            
        
        var y = document.getElementById("attr_id[606]").selectedIndex;

        switch (y) {
          case 1:
              var price_show = [18,19];
              break;
          case 2:
              var price_show = [27,29,"29a",30,31];
              break;
          case 3:
              var price_show = [33];
              break;
//          case 4:
//              var price_show = [23,24,25,33];
//              break;
          default:
              return;
            break;
        } 
//commented on 01 march 2016        
//        switch (x) {
//          case 1:
//              var price_show = [15,16,17];
//              break;
//          case 2:
//              var price_show = [18,19];
//              break;
//          case 3:
//              var price_show = [20,21,22,23,24,25];
//              break;
//          case 4:
//              var price_show = [23,24,25,33];
//              break;
//          default:
//              return;
//            break;
//        }        
//        switch ($(this).val()) {
//          case "Price":
//              var price_show = [15,16,17,18,19];
//              break;
//          case "Auction":
//              var price_show = [20,21,22,23,24,25];
//              break;
//          case "Reverse Auction":
//              var price_show = [23,24,25,33];
//              break;
//          default:
//              return;
//            break;
//        }
        
        price_show.forEach(function(entry) {
          $("[name='attr_id["+entry+"]']").prop( "disabled", false );
          $("[name='attr_id["+entry+"]']").closest(".form-group").fadeIn(500);
        });            
      });
    });
    
    $(window).on("load",function(){
           var x = $("select[name='attr_id[606]']").parent().parent().parent().children().first();
           $("select[name='attr_id[606]']").parent().parent().insertAfter(x);
    });
    
    
//    $(document).ready(function(){
//        $('#productForm input').on('change', function() {
//            var flag = $('input[name="prod_type"]:checked', '#productForm').val();
//            if(flag==='sell'){
//                $("select[name='attr_id[14]'] option[value='Price - To Buy']").attr("disabled","disabled");
//                $("select[name='attr_id[14]'] option[value='Price - To Sell']").removeAttr("disabled");
//                $("select[name='attr_id[14]'] option[value='Reverse Auction']").attr("disabled","disabled");
//                $("select[name='attr_id[14]'] option[value='Auction']").removeAttr("disabled");
//            }
//            else {
//                $("select[name='attr_id[14]'] option[value='Price - To Buy']").removeAttr("disabled");
//                $("select[name='attr_id[14]'] option[value='Price - To Sell']").attr("disabled","disabled");
//                $("select[name='attr_id[14]'] option[value='Auction']").attr("disabled","disabled");
//                $("select[name='attr_id[14]'] option[value='Reverse Auction']").removeAttr("disabled");
//            }
//        });
//    });
</script>

<!--<script>
    $(document).ready(function(){
      $("[disabled]").closest(".form-group").fadeOut(500);
      
      $( "select" ).change(function() {
        var curElem=$(this).attr("name");
        var curElemTrim= curElem.slice(0, -1);
        
        //Disbale child inputs
        if($("[name^='"+curElemTrim+";']").length){
          $("[name^='"+curElemTrim+";']").val("");
          $("[name^='"+curElemTrim+";']").prop( "disabled", true );
          $("[name^='"+curElemTrim+";']").closest(".form-group").fadeOut(500);
        }
        if($("[name^='"+curElemTrim+"/']").length){
          $("[name^='"+curElemTrim+"/']").val("");
          $("[name^='"+curElemTrim+"/']").prop( "disabled", true );
          $("[name^='"+curElemTrim+"/']").closest(".form-group").fadeOut(500);
        }
        
        var curSelect=$(this).prop('selectedIndex');
        if($("[name='"+curElemTrim+";"+curSelect+"]']").length){
          $("[name='"+curElemTrim+";"+curSelect+"]']").prop( "disabled", false );
          //select with parent element and insert after parent of current dropdown
          $("[name='"+curElemTrim+";"+curSelect+"]']").closest(".form-group").insertAfter( $(this).closest(".form-group") );
          $("[name='"+curElemTrim+";"+curSelect+"]']").closest(".form-group").fadeIn(500);
        }
        if($("[name^='"+curElemTrim+";"+curSelect+"/']").length){
          $("[name^='"+curElemTrim+";"+curSelect+"/']").prop( "disabled", false );
          //select with parent element and insert after parent of current dropdown
          $("[name^='"+curElemTrim+";"+curSelect+"/']").closest(".form-group").insertAfter( $(this).closest(".form-group") );
          $("[name^='"+curElemTrim+";"+curSelect+"/']").closest(".form-group").fadeIn(500);
        }       
      });
        
        
        
      //For Sale Type Option Selection
      var price_attr = [15,16,17,18,19,20,21,22,23,24,25,33];
      price_attr.forEach(function(entry) {
          $("[name='attr_id["+entry+"]']").prop( "disabled", true );
          $("[name='attr_id["+entry+"]']").closest(".form-group").fadeOut(500);
      });
      
      $( "select[name='attr_id[14]']" ).change(function() {
            price_attr.forEach(function(entry) {
                $("[name='attr_id["+entry+"]']").val("");
                $("[name='attr_id["+entry+"]']").prop( "disabled", true );
                $("[name='attr_id["+entry+"]']").closest(".form-group").fadeOut(500);
            });            
        
            var x = document.getElementById("attr_id[14]").selectedIndex;
            switch (x) {
              case 1:
                  var price_show = [15,16,17];
                  break;
              case 2:
                  var price_show = [18,19];
                  break;
              case 3:
                  var price_show = [20,21,22,23,24,25];
                  break;
              case 4:
                  var price_show = [23,24,25,33];
                  break;
              default:
                  return;
                break;
            }        
//        switch ($(this).val()) {
//          case "Price":
//              var price_show = [15,16,17,18,19];
//              break;
//          case "Auction":
//              var price_show = [20,21,22,23,24,25];
//              break;
//          case "Reverse Auction":
//              var price_show = [23,24,25,33];
//              break;
//          default:
//              return;
//            break;
//        }
        
        price_show.forEach(function(entry) {
            $("[name='attr_id["+entry+"]']").prop( "disabled", false );
            $("[name='attr_id["+entry+"]']").closest(".form-group").fadeIn(500);
        });
      });
    });
</script>    -->
@endsection
