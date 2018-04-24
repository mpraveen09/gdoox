@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <h3>Select Product Categories</h3>
@endsection

@section('right_col_title_right')
@endsection

@section('right_col')
    <!-- will be used to show any messages -->
    @if (Session::has('message'))
        <div class="alert alert-info">{!!  Session::get('message')  !!}</div>
    @endif

    @if (HTML::ul($errors->all()))
        <div class="alert alert-error">{!! HTML::ul($errors->all()) !!}</div>
    @endif    
    
    @if ( ! $categories->count()  )
        <div class="alert alert-warning">You have no Categories</div>
    @else
        <!--div class="row">
            <div class="col-md-4 col-sm-4 col-xs-10  form-group top_search" style="padding: 20px 0;">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search categories...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>            

        </div-->
        <div class="row">
            <div class="col-md-12">
                <h5>Show Selected Categories Here</h5>
            </div>

            {!! Form::open([
                'method' => 'POST',
                'route' => 'products/add',
                'class' => 'form-horizontal form-label-left',
                'novalidate'=>''
            ]) !!}                
            <div class="col-md-10">
                <div class="selected_cats">
                    
                </div>
                
                <br/>
            </div>
            <div class="col-md-2">
                <button id="send_prod_cat" type="submit" class="btn btn-round btn-success">Next</button>              
            </div>
            {!! Form::close() !!}                

        </div>        
        <div class="row">
            <div class="col-md-4">
                <h5>To Select, click on a root category </h5>
                <ul class="prod_cat_root">
                    @foreach( $categories as $category )
                        <li data-cat_id="{!!  $category->cat_id   !!}">
                            {!!  $category->name   !!}
                        </li>
                    @endforeach                
                </ul>
            </div>
            <div class="col-md-8 prod_cat_sub">
                <h5 class="prod_cat_sub_head"></h5>
                <div class="prod_cat_sub_div">
                    
                </div>
            </div>
        </div>        

        
      
        
    

    @endif    

    
@endsection

@section('footer_add_js_script')
<script>
    $(document).ready(function(){
        
        checkSelectedCats();
        
        $(document).on("click",".prod_cat_root li",function(e) {
            e.stopPropagation();
            $(".prod_cat_root li").removeClass('active');     
            
            var parenttxt = $(this).html();
            var $post             = {};
            $post.parent          = $(this).attr('data-cat_id');

            $.ajax({
                url: "{!! URL::route('fetchsubcats')  !!}",
                data: $post,
                cache: false,
                success: function(data){
                      //$('.prod_cat_sub_head').html("");
                      $('.prod_cat_sub_head').html(parenttxt);
                      $('.prod_cat_sub_div').html(data.data);
                },
                error:function(data){
                   //console.log(data.data);
                   alert('There is an error: '+data.data);
                }
                
                
            });
            $(this).addClass('active');      
        });
        
        $(document).on("click",".prod_cat_sub_div li",function(e) {
            e.stopPropagation();            
            if($(this).hasClass("active")){
                return false;
            }            
            var $post             = {};
            $post.category_id          = $(this).attr('data-cat_id');

            $.ajax({
                url: "{!! URL::route('fetchcatancestors')  !!}",
                data: $post,
                cache: false,
                success: function(data){
                    $('.selected_cats').append(data.data);
                    checkSelectedCats();
                },
                error:function(data){
                   alert('There is an error: '+data.data);
                }
                
            });
            $(this).addClass('active');        
        });
        
        $(document).on("click",".prod_cats .glyphicon",function(e) {
            $(".prod_cat_sub_div ul").find("[data-cat_id='" + $(this).attr('data-cat_id') + "']").removeClass("active");
            $(this).parent().remove();
            checkSelectedCats();
        });
        
        function checkSelectedCats(){
            if($.trim( $(".selected_cats").html() ) !== ""){
                $("#send_prod_cat").show();
            }else{
                $("#send_prod_cat").hide();
            }
        }
        
    });
</script>    
@endsection