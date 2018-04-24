@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <!--<h2>Product Categories</h2>-->
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
 
   
    
    <div class="card">
        <div class="card-header bgm-blue head-title">
          <h2>Select Product Categories</h2>
        </div><!-- .card-header -->
        <div class="card-body card-padding">    

                @if ( ! $categories->count()  )
                    <div class="alert alert-warning">You have no Categories</div>
                @else
                
                    <div class="row">
                        {!! Form::open([
                            'method' => 'POST',
                            'class' => 'form-horizontal form-label-left',
                            'novalidate'=>'',
                            'id'=>'cat_search'
                        ]) !!}  
                        <div class="col-md-4 col-sm-4 col-xs-10  form-group top_search" style="padding: 20px 0; margin-left: 0px;">
                            <div class="input-group">
                                {!! Form::text('term',null, array('','id'=>'term','placeholder'=>'Search Product Categories...','class'=>'searchproductcat form-control'))!!}
<!--                            <input type="text" class="form-control" placeholder="Search categories...">-->
                                <span class="input-group-btn">
<!--                                 <button id="search_category" name="search_category" class="btn btn-default btn-icon-text waves-effect">Go!</button>-->
                            <button id="search_category" type="submit" name="search_category" class="btn  waves-effect" >
                                <i class="zmdi zmdi-search"></i></button>
                                </span>
                            </div>
                        </div> 
                        {!! Form::close() !!} 
                    </div>
                
                    <div class="row">
                        <div class="col-md-12">
                            <h5>Show Selected Categories Here</h5>
                        </div>
                        {!! Form::open(['action'=>'backend\dashboard\SelectCategoriesController@update', 'class' => 'form-horizontal form-label-left', 'novalidate'=>'']) !!}                
                        @if(Auth::user())
                            {!! Form::hidden("userid", Auth::user()->id) !!}
                        @else
                            {!! Form::hidden("userid", "") !!}
                        @endif              
                        <div class="col-md-10">
                            <div class="selected_cats"></div>
                            <br/>
                        </div>
                        
                        <div></div>
                        
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
                            <div class="prod_cat_sub_div"></div>
                        </div>
                    </div>        
                @endif    
                
        </div>
    </div>                
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
<script>
    $(document).ready(function(){

        checkSelectedCats();

//        $(document).on("click","#search_category",function(e) {
        $(document).on("submit","#cat_search",function(e) {
            e.preventDefault();
            var term = $('#term').val();
            $.ajax({
                url: "{!! URL::route('searchcategory')  !!}",
                data: {
                    term : term
                },
                cache: false,
                success: function(data){
                      $('.prod_cat_root').html(data);
                },
                error:function(data){
                   // console.log(data.data);
                   alert('There is an error: '+data.data);
                }
            });        
            return;
        });

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
            var temp = $(this).html();
            var count = (temp.match(/<ul>/g) || []).length;

            if(count > 1){ return; }//stop if not leaf or above leaf li cat

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
        
        jQuery(function($) {
        $(".searchproductcat").autocomplete({
            source: function( request, response ) {   
                $.ajax({
                    url: "{!! URL::route('search_product_cat')  !!}",
                    dataType: "json",
                    data: {
                            term: request.term,
                    },
                    success: function(json) {
                        response( $.map( json, function( item ) {
                            return {
                                value: item.name
                            }
                        }));
                    }
                });
            },
            autoFocus: true,
            minLength: 3,
            });
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