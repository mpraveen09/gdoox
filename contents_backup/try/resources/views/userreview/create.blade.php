@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<h2>{!!$fm_data['labels']['form_title']!!}</h2>
@endsection

@section('right_col_title_right')
    <br>
    <br>
    <a href="{!! route('dashboard-index')  !!}" type="submit" class="btn btn-default"><i class='zmdi zmdi-home'></i></a>
    <button onclick="goBack()" class="btn btn-primary waves-effect">Back</button>
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

   <div class="card">
        <div class="card-header bgm-blue">
          <h2>{!!$fm_data['labels']['heading']!!}</h2>
        </div><!-- .card-header -->
        <div class="card-body card-padding">    
        
            {!! Form::open([
              'method' => 'POST',
              'route' => 'userreview.store',
              'class' => 'form-horizontal form-label-left',
              'novalidate'=>''
            ]) !!}    
            
              {!! Form::hidden('product_id', $product_id, array('id'=>'product_id')) !!}
              {!! Form::hidden('shopid', $shopid, array('id'=>'shopid')) !!}
              {!! Form::hidden('thumb', $thumb, array('id'=>'thumb')) !!}
              {!! Form::hidden('rating', '', array('id'=>'rating')) !!}
              
              @if (!empty($fm_data['labels']['heading']))

              <div class="form-group clearfix">
                  @if(!empty($fm_data['labels']['review_title']))
                       {!! Form::label('review_title', $fm_data['labels']['review_title'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                  @endif

                  @if (!empty($fm_data['labels']['review_title']))
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      {!! Form::text('review_title', '', array('required','placeholder' =>'','class'=>'form-control')) !!}
                      </div>    
                  @endif
              </div>
              
              <div class="form-group clearfix">
                  @if(!empty($fm_data['labels']['your_review']))
                       {!! Form::label('review', $fm_data['labels']['your_review'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                  @endif

                  @if (!empty($fm_data['labels']['your_review']))
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      {!! Form::textarea('review', '', array('required','placeholder' =>'','class'=>'form-control')) !!}
                      </div>    
                  @endif
              </div>
              
              <div class="form-group clearfix">
                  @if(!empty($fm_data['labels']['your_rating']))
                       {!! Form::label('your_rating', $fm_data['labels']['your_rating'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                  @endif

                  @if (!empty($fm_data['labels']['your_rating']))
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="rating-select">
                            <i class="mm btn-default btn-sm glyphicon glyphicon-star-empty" id='1'></i>
                            <i class="mm btn-default btn-sm glyphicon glyphicon-star-empty" id='2'></i>
                            <i class="mm btn-default btn-sm glyphicon glyphicon-star-empty" id='3'></i>
                            <i class="mm btn-default btn-sm glyphicon glyphicon-star-empty" id='4'></i>
                            <i class="mm btn-default btn-sm glyphicon glyphicon-star-empty" id='5'></i>
                        </div>
                      </div>
                  @endif
              </div>
              
              <div class="form-group clearfix">
                  @if(!empty($fm_data['labels']['name']))
                       {!! Form::label('name', $fm_data['labels']['name'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                  @endif

                  @if (!empty($fm_data['labels']['name']))
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      {!! Form::text('name', '', array('required','placeholder' =>'','class'=>'form-control')) !!}
                      </div>    
                  @endif
              </div>
    
              <div class="form-group">
                  @if (!empty($fm_data['labels']['submit']))
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                          {!!HTML::linkRoute('dashboard-index', $fm_data['labels']['cancel'], array(), array('class'=>"btn btn-round btn-primary"))!!}
                          <button id="send" type="submit" class="btn btn-round btn-success">{!!$fm_data['labels']['save']!!}</button>
                      </div>
                  @endif
              </div>
             @endif
        {!! Form::close() !!}
        </div>
   </div>


    

@endsection

@section('footer_add_js_script')
<style>
    .star-rating {
    line-height:32px;
    font-size:1.25em;
    cursor: pointer;
    }
</style>

<script type="text/javascript">
$(function(){
    $('.rating-select .mm').on('mouseover', function(){
        $(this).removeClass('btn-default').addClass('btn-warning');
        $(this).prevAll().removeClass('btn-default').addClass('btn-warning');
        $(this).nextAll().removeClass('btn-warning').addClass('btn-default');
    });

    $('.rating-select').on('mouseleave', function(){
        active = $(this).parent().find('.selected');
        if(active.length) {
            active.removeClass('btn-default').addClass('btn-warning');
            active.prevAll().removeClass('btn-default').addClass('btn-warning');
            active.nextAll().removeClass('btn-warning').addClass('btn-default');
        } else {
            $(this).find('.mm').removeClass('btn-warning').addClass('btn-default');
        }
    });

    $('.rating-select .mm').click(function(){
        if($(this).hasClass('selected')) {
            $('.rating-select .selected').removeClass('selected');
        } else {
            $('.rating-select .selected').removeClass('selected');
            $(this).addClass('selected');
            var rating = $(this).attr('id');
            $('#rating').val(rating);
        }
    });
});

function goBack() {
    window.history.back();
}
</script>

@endsection



