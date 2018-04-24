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
    
     @include('navigation_tabs.business_ecosystem_tabs')
    
    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>Edit Product</h2>
        </div><!-- .card-header -->
    
        <div class="row">
            <div class="col-md-12">
                    {!! Form::open([
                        'method' => 'POST',
                        'route' => ['ecosys.store_product_info', $id],
                        'class' => 'form-horizontal form-label-left',
                        'novalidate'=>'',
                        'files' => true
                    ]) !!}
                    
                    {!! Form::hidden('purpose',$purpose) !!}
                    {!! Form::hidden('flag',$flag) !!}
                    
                    @foreach( $productForm as $formField)
                            {!!  $formField   !!}
                    @endforeach
                
                    <div class="col-md-12 text-center">
                        <button id="send_prod_cat" type="submit" class="btn btn-round btn-success">Update Product</button>    
                        <br/><br/>
                    </div>
                {!! Form::close() !!}
                <br/>
            </div>
        </div> 
    </div>
@endsection


@section('footer_add_js_script')

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
        alert(x);
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
          case 4:
              var price_show = [23,24,25,33];
              break;
          default:
              return;
            break;
        } 
        
        price_show.forEach(function(entry) {
          $("[name='attr_id["+entry+"]']").prop( "disabled", false );
          $("[name='attr_id["+entry+"]']").closest(".form-group").fadeIn(500);
        });            


      });

    });
</script>    
@endsection
