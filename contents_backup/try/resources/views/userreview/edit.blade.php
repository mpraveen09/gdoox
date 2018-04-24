@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<h2>{!!$fm_data['labels']['form_title']!!}</h2>
@endsection

@section('right_col_title_right')
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
            <h2>Edit Review</h2>
        </div><!-- .card-header -->
        

        <div class="card-body card-padding">    
          
            {!! Form::model($reviews, [
                'method' => 'PUT',
                'route' => ['userreview.update', $reviews->_id],
                'class' => 'form-horizontal form-label-left',
                'novalidate'=>''
            ]) !!}

              
            
            {!! Form::hidden('rating',$reviews->rating , array('id'=>'rating')) !!}
            
            
              @if (!empty($fm_data['labels']['heading']))

              <div class="form-group clearfix">
                  @if(!empty($fm_data['labels']['review_title']))
                       {!! Form::label('review_title', $fm_data['labels']['review_title'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                  @endif

                  @if (!empty($fm_data['labels']['review_title']))
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      {!! Form::text('review_title', $reviews->review_title, array('required','placeholder' =>'','class'=>'form-control')) !!}
                      </div>    
                  @endif
              </div>
              
              <div class="form-group clearfix">
                  @if(!empty($fm_data['labels']['your_review']))
                       {!! Form::label('your_review', $fm_data['labels']['your_review'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                  @endif

                  @if (!empty($fm_data['labels']['your_review']))
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      {!! Form::textarea('review', $reviews->review, array('required','placeholder' =>'','class'=>'form-control')) !!}
                      </div>    
                  @endif
              </div>
              
              <div class="form-group clearfix">
                  @if(!empty($fm_data['labels']['your_rating']))
                       {!! Form::label('your_rating', $fm_data['labels']['your_rating'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                  @endif

                  @if (!empty($fm_data['labels']['your_rating']))
                      <div class="col-md-6 col-sm-6 col-xs-12 myclass">
                        <div class="rating-select">
                            <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw" id='1'></i>
                            <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw" id='2'></i>
                            <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw" id='3'></i>
                            <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw" id='4'></i>
                            <i class="mm btn-def zmdi zmdi-star zmdi-hc-fw" id='5'></i>
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
                      {!! Form::text('name', $reviews->name, array('required','placeholder' =>'','class'=>'form-control')) !!}
                      </div>    
                  @endif
              </div>
    
              <div class="form-group">
                  @if (!empty($fm_data['labels']['save']))
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
   
    var rating = {!! $reviews->rating !!}
    if(rating==1)
    {
        $("i[id$=1]").addClass('selected');
        $("i[id$=1]").addClass('btn-warning');
        $("i[id$=1]").removeClass('btn-default');
    }
    else if(rating==2)
    {
        $("i[id$=2]").addClass('selected');
        $("i[id$=1]").addClass('btn-warning');
        $("i[id$=1]").removeClass('btn-default');
        $("i[id$=2]").addClass('btn-warning');
        $("i[id$=2]").removeClass('btn-default');
    }
    else if(rating==3)
    {
        $("i[id$=3]").addClass('selected');
        $("i[id$=1]").addClass('btn-warning');
        $("i[id$=1]").removeClass('btn-default');
        $("i[id$=2]").addClass('btn-warning');
        $("i[id$=2]").removeClass('btn-default');
        $("i[id$=3]").addClass('btn-warning');
        $("i[id$=3]").removeClass('btn-default');
    }
    else if(rating==4)
    {
        $("i[id$=4]").addClass('selected');
        $("i[id$=1]").addClass('btn-warning');
        $("i[id$=1]").removeClass('btn-default');
        $("i[id$=2]").addClass('btn-warning');
        $("i[id$=2]").removeClass('btn-default');
        $("i[id$=3]").addClass('btn-warning');
        $("i[id$=3]").removeClass('btn-default');
        $("i[id$=4]").addClass('btn-warning');
        $("i[id$=4]").removeClass('btn-default');
    }
    else if(rating==5)
    {
        $("i[id$=5]").addClass('selected');
        $("i[id$=1]").addClass('btn-warning');
        $("i[id$=1]").removeClass('btn-default');
        $("i[id$=2]").addClass('btn-warning');
        $("i[id$=2]").removeClass('btn-default');
        $("i[id$=3]").addClass('btn-warning');
        $("i[id$=3]").removeClass('btn-default');
        $("i[id$=4]").addClass('btn-warning');
        $("i[id$=4]").removeClass('btn-default');
        $("i[id$=5]").addClass('btn-warning');
        $("i[id$=5]").removeClass('btn-default');
    }
   
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



