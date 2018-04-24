
  @if(!empty($certificationlogo) && count($certificationlogo) )
  <div class="card">
     <div class="card-header bgm-blue">
        <h2>Certification Logos</h2>
     </div>
    <div class="card-body card-padding-sm">
      <div class="row">
        @foreach($certificationlogo as $logo)
        <div class="col-md-3">
          <img src="{!!asset($logo->logo_path.$logo->logo)!!}" style="width: auto; max-height: 150px;">
        </div>
        @endforeach
      </div>
    </div>
 </div>
  @endif

   
<div class="card">
    <div class="card-header card-padding-sm bgm-blue">
        <h2>Contact Us</h2>
    </div>
    <div class="card-body card-padding">
      {!! Form::open(array('action'=>'store\StoreController@sendmessage','class'=>'form-horizontal form-label-left')) !!}
        <div class="form-group clearfix">
           {!! Form::label('title', 'Title', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
          <div class="col-md-6 col-sm-6 col-xs-12">
          {!! Form::text('title', null, array('required','class'=>'form-control')) !!}
          </div>   
        </div>
        <div class="form-group clearfix">
           {!! Form::label('email', 'Email address', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
          <div class="col-md-6 col-sm-6 col-xs-12">
          {!! Form::email('email', null, array('required','class'=>'form-control')) !!}
          </div>   
        </div>
        <div class="form-group clearfix">
           {!! Form::label('message', 'Your message', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
          <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::textarea('message', null, array('size' => '30x4  ', 'class'=>'form-control')) !!}
          </div>   
        </div>
        <div class="form-group clearfix">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                   <button id="send" type="submit" class="btn btn-round btn-success">Send</button>
              </div>
        </div>

      {!!Form::close()!!}
    </div>              
  </div>