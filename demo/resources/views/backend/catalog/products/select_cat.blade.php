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
 
    @include('navigation_tabs.general_tabs')
    
    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>Select Product Categories</h2>
        </div><!-- .card-header -->
        
        <div class="card-body card-padding">
            @if($purpose==='buy')
                <div class="row">
                    {!! Form::open([
                        'method' => 'POST',
                        'route' => 'marketplace',
                        'class' => 'form-horizontal form-label-left',
                        'novalidate'=>'',
                        'id'=>'product_search'
                        ]) !!}
                            <div class="col-md-4 col-sm-4 col-xs-10  form-group top_search" style="padding: 10px 0; margin-left: 0px;">
                                <div class="input-group">
                                    {!! Form::text('keyword',null, array('required','id'=>'keyword','placeholder'=>'Search Product...','class'=>'form-control')) !!}
                                    {!! Form::hidden('action','buy', array('id'=>'action')) !!}
                                    
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn  waves-effect" ><i class="zmdi zmdi-search"></i></button>
                                    </span>
                                </div>
                            </div> 
                    {!! Form::close() !!} 
                
            
                    <div class="col-md-12 col-sm-12 col-xs-12  form-group top_search" style="padding: 0px 0; margin-left: 0px;">
                       {!! Form::label('classify_post', "Classify your post. Select the type of request you are posting:") !!}  
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-4 col-sm-4 col-xs-12" style="margin-left: -25px;">
                            {!! Form::select('classify_post', $classify, null, array('required','placeholder'=>'-----Select-----', 'class'=>'col-md-4 col-sm-4 col-xs-12 form-control')) !!}
                        </div>                     
                    </div>
                </div>
            <br />
            @endif
            
            <div class="row">
                {!! Form::open([
                    'method' => 'POST',
                    'class' => 'form-horizontal form-label-left',
                    'novalidate'=>'',
                    'id'=>'cat_search'
                ]) !!}
                    
                    <div class="col-md-4 col-sm-4 col-xs-10  form-group top_search" style="padding: 10px 0; margin-left: 0px;">
                        <div class="input-group">
                            {!! Form::text('term',null, array('','id'=>'term','placeholder'=>'Search Product Categories...','class'=>'form-control'))!!}
                            <span class="input-group-btn">
                                <button id="search_category" type="submit" name="search_category" class="btn  waves-effect" ><i class="zmdi zmdi-search"></i></button>
                            </span>
                        </div>
                    </div> 
                {!! Form::close() !!} 
            </div>
           

            @if (!$categories->count())
                <div class="alert alert-warning">You have no Categories</div>
            @else
                    @if($purpose==='buy')
                        {!! Form::open([
                            'method' => 'POST',
                            'route' => array('products.add.buy'),
                            'class' => 'form-horizontal form-label-left',
                            'novalidate'=>''
                        ]) !!} 

                    @else 
                            {!! Form::open([
                                'method' => 'POST',
                                'route' => array('products/add'),
                                'class' => 'form-horizontal form-label-left',
                                'novalidate'=>''
                            ]) !!} 
                    @endif

                    <div class="div_wait row prod_cats">
                        <div class="col-md-12">
                            <b>Please select the Product Categories from the list to add Product</b>
                        </div>
                    </div>

                    <div style="background-color: #009900; display: none" class="div_proceed row prod_cats">
                        <div class="col-md-12">
                            <b>You can click Next to add Product or select more category from the List</b>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h5>Show Selected Categories Here</h5>
                        </div>
                        @if(Auth::user())
                            {!! Form::hidden("userid", Auth::user()->id) !!}
                            {!! Form::hidden('classify','',array('id'=>'classify')) !!}
                        @else
                            {!! Form::hidden("userid", "") !!}
                        @endif

                        <div class="col-md-10">
                            <div class="selected_cats"></div>
                            <br/>
                        </div>

                        <div class="col-md-2">
                            <button id="send_prod_cat" type="submit" class="btn btn-round btn-success">Next</button>              
                        </div>      
                    </div>
            {!! Form::close() !!}
            
            
            
            
            <div class="row cat_help">
                <div class="col-md-12 prod_cat_sub"> 
                    <div class="div_msg" style="display: none;"><b>Do you also want to add these leaf categories. Please click to Select</b></div>
                    <div class="prod_cat_sub_new"></div>
                </div>
            </div>
            
            <br>
            <br>

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
//      $(document).on("click","#search_category",function(e) {
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
                      $('#prod_cat_sub_div').html();
                      $('.prod_cat_root').html(data);
                },
                error:function(data){
                   alert('There is an error: '+data.data);
                }
            });        
            return;
        });

        $(document).on("click",".prod_cat_root li",function(e) {
            e.stopPropagation();
//            var offset = $( this ).offset();
//            console.log(offset.top);
            var position = $( this ).position();
            console.log(position.top);
            
            
            $(".prod_cat_root li").removeClass('active');    
            var parenttxt = $(this).html();
            var $post = {};
            $post.parent = $(this).attr('data-cat_id');
            $post.term = $('input#term').val();

            $('.prod_cat_sub_div').html("");
            $('.prod_cat_sub_head').html("Loading....");
            $('.prod_cat_sub_head').css("margin-top", position.top +"px");
            

            $.ajax({
                url: "{!! URL::route('fetchsubcats')  !!}",
                data: $post,
                cache: false,
                success: function(data){
                    //alert(data.data);
//                      $('.prod_cat_sub_head').html("Loading....");
//                      $('.prod_cat_sub_head').css("margin-top", position.top +"px");

                      $('.prod_cat_sub_new').html("");
                      $('.prod_cat_sub_head').html(parenttxt);
                      $('.prod_cat_sub_div').html(data.data);
                },
                error:function(data){
                  // console.log(data.data);
                   alert('There is an error: '+data.data);
                }
            });
            $(".prod_cat_sub_div li, .prod_cat_sub_div ul").removeClass("active");
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
            
            var $post = {};
            $(".prod_cat_sub_div li, .prod_cat_sub_div ul").removeClass("active");
            $post.category_id = $(this).attr('data-cat_id');
            
            if(count === 1){
                var child = $(this).children().html();
            }
            if(count === 0 ){
                var neighbour = $(this).parent().html(); 
            }
            
            $.ajax({
                url: "{!! URL::route('fetchcatancestors')  !!}",
                data: $post,
                cache: false,
                success: function(data){
                    $('.selected_cats').html(data.data);
                    if(count === 1 && child !== '') {   
                        $('.prod_cat_sub_new').html(child);
                        $('.div_msg').show();
                    }
                    if(count === 0  && neighbour !== ''){
                        $('.prod_cat_sub_new').html(neighbour);
                        $('.div_msg').show();
                    } 
                    checkSelectedCats();
                },
                error:function(data){
                    alert('There is an error: '+data.data);
                }
            });
            $(".prod_cat_sub_div li, .prod_cat_sub_div ul").removeClass("active");
            $(this).addClass('active');        
        });
        
        $(document).on("click",".prod_cat_sub_new li",function(e) {
            e.stopPropagation();            
            var temp = $(this).html();
            var count = (temp.match(/<ul>/g) || []).length;
            if(count > 1){ return; }//stop if not leaf or above leaf li cat
            if($(this).hasClass("active")){
                return false;
            }     
            var $post = {};
            $post.category_id = $(this).attr('data-cat_id');

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
            $(".prod_cat_sub_new").find("[data-cat_id='" + $(this).attr('data-cat_id') + "']").removeClass("active");
            $(this).parent().remove();
            if ($('.selected_cats').is(':empty')){
               $('.prod_cat_sub').html('');
            }
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
            if($.trim( $(".selected_cats").html()) !== ""){
                $("#send_prod_cat").show();
                $(".div_proceed").show();
                $(".div_wait").hide();
            }
            else {
                $("#send_prod_cat").hide();
                $(".div_proceed").hide();
                $(".div_wait").show();
            }
        }
        
        $('#classify_post').on('change',function(){
            // alert($(this).val());
            $('#classify').val($(this).val());
        });
    });
</script>    

@endsection