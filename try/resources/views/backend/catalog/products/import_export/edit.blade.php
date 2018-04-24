  @extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2> Import Products</h2>-->
<!--<div class="page-top-links">-->

<!--</div>-->
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
    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>View Files</h2>
            <a href="{!!route('import_product.import')!!}" class="btn btn-default">Import</a>
            <a href="{!!route('import_product.list_product')!!}" class="btn btn-default">List Product</a>
        </div><!-- .card-header -->
        
        <div class="card-body card-padding">
                  <div class="row">
                      {!! Form::open([
                          'method' => 'POST',
                          'route' =>[ 'import_product.update', $product->id],
                          'class' => 'form-horizontal form-label-left',
                          'novalidate'=>'',
                          'files' => true
                      ]) !!}                
                      <div class="col-md-12">
                          @foreach( $productForm as $productFormfield )
                                  {!!  $productFormfield   !!}
                          @endforeach 

                          <br/>
                      </div>

                      <div class="col-md-12 text-center">
                          <button id="send_prod_cat" type="submit" class="btn btn-round btn-success">Update</button>    
                          <br/><br/>
                      </div>

                      {!! Form::close() !!}                

                  </div>        
        </div>
    </div>
@endsection    
@section('footer_add_js_files') 
  <script type="text/javascript">
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
</script>    
@endsection