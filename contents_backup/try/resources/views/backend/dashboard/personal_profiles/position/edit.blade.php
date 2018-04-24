@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
@endsection

@section('right_col_title_right')
@endsection

@section('right_col')

@if (Session::has('message'))
<div class="alert alert-info">{!!  Session::get('message')  !!}</div>
@endif

   @include('navigation_tabs.personal_profile_tabs')
   
   <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>@if(!empty($fm_data->labels['heading'])){!!$fm_data->labels['heading']!!}@endif</h2>
        </div><!-- .card-header -->
        <div class="card-body card-padding">
            @if($errors->any())
              <ul class="parsley-errors-list filled text-center">
                    {!! implode('', $errors->all('<li class="parsley-required">:message</li>'))!!}
              </ul>
            @endif
            {!! Form::open(array('route' => 'position.update', 'method'=>'PUT', 'class'=>'form-horizontal form-label-left')) !!}
                {!!Form::hidden('user_id', Auth::user()->id)!!}
                @if (!empty($fm_data->labels))
                    <div class="form-group clearfix">
                        @if(!empty($fm_data->labels['position']))
                           {!! Form::label('position', $fm_data->labels['position'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                          <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::select('position', $option, $position->position, array('placeholder' =>'-select-', 'class'=>'form-control')) !!}
                          </div> 
                        @endif
                    </div>
                
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button id="send" type="submit" class="btn btn-round btn-success">Save & Next</button>
                        </div>
                    </div>
                 @endif
            {!! Form::close() !!}
         </div>
   </div>   
@endsection