@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>  {!!$fm_data->labels['form_title']!!}</h2>-->
@endsection

@section('right_col_title_right')
 @endsection


@section('header_add_js_script')        
@endsection

@section('right_col')

@if (Session::has('message'))
<div class="alert alert-info">{!!  Session::get('message')  !!}</div>
@endif

    @include('navigation_tabs.general_tabs')

   <div class="card">
        <div class="card-header bgm-blue head-title">
          <h2>{!!$fm_data->labels['create']!!}</h2>
          <a href="{!! route('dashboard-index')  !!}" type="submit" class="btn btn-default"><i class='zmdi zmdi-home'></i></a>
        </div><!-- .card-header -->
        <div class="card-body card-padding">    
        @if($errors->any())
          <ul class="parsley-errors-list filled text-center">
                {!! implode('', $errors->all('<li class="parsley-required">:message</li>'))!!}
          </ul>
        @endif
        
        {!! Form::open([
            'method' => 'POST',
            'route' => 'interest-info-store',
            'class' => 'form-horizontal'
            ]) !!}

            {!!Form::hidden('user_id', Auth::user()->id)!!}
              @if (!empty($fm_data->labels))
                 <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['sport']))
                           {!! Form::label('sport', $fm_data->labels['sport'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 

                           <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::text('sport', '', array('placeholder' =>$fm_data->labels['sport'],'class'=>'form-control')) !!}
                          </div>    
                      @endif
                  </div>

                 <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['books']))
                           {!! Form::label('books', $fm_data->labels['books'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
 
                           <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::text('books', '', array('placeholder' =>$fm_data->labels['books'],'class'=>'form-control')) !!}
                          </div>    
                      @endif
                  </div>

                 <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['music']))
                           {!! Form::label('music', $fm_data->labels['music'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 

                           <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::text('music', '', array('placeholder' =>$fm_data->labels['music'],'class'=>'form-control')) !!}
                          </div>    
                      @endif
                  </div>

                 <div class="form-group clearfix">
                      @if(!empty($fm_data->labels['games_music']))
                           {!! Form::label('games_music', $fm_data->labels['games_music'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 

                           <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::text('games_music', '', array('placeholder' =>$fm_data->labels['games_music'],'class'=>'form-control')) !!}
                          </div>    
                      @endif
                  </div>
               
                  <div class="form-group clearfix">
                      @if(!empty($tc))
                           <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          {!! Form::checkbox('t_n_c', null, null, array('required','class'=>'field')) !!}
                           {!! $tc->desc!!} 
                           @if(!empty($tc->doc_title))
                           {!! HTML::link($tc->doc_link, $tc->doc_title)!!}
                           @endif
                          </div>    
                      @endif
                  </div>
              

                <div class="form-group">
                  @if (!empty($fm_data->labels['submit']))
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          {!!HTML::linkRoute('dashboard-index', $fm_data->labels['cancel'], array(), array('class'=>"btn btn-round btn-primary"))!!}
                          <button id="send" type="submit" class="btn btn-round btn-success">Save & Next</button>
                      </div>
                  @endif
              </div>
             @endif
        {!! Form::close() !!}
     </div>
   </div>    
@endsection