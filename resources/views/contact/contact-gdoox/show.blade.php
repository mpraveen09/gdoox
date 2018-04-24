@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
   <!--<h2>CRM</h2>-->
    <!--<div class="page-top-links">-->
    <!--</div>-->
@endsection

@section('right_col_title_right')
@endsection

@section('right_col')
        <!-- if there are creation errors, they will show here -->
        @if (HTML::ul($errors->all()))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                {!! HTML::ul($errors->all()) !!}
            </div>
        @endif

    
       <div class="card">
            <div class="card-header bgm-blue head-title">
                <h2>Messages</h2>
            </div><!-- .card-header -->
            <div class="card-body card-padding">                    
                <table class="table">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>From</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach($messages->message as $key=>$val)
                          <tr>
                              <td>{!! $i !!}</td>
                              <td>
                                  @if($key==='superadmin')
                                       You:
                                  @else 
                                        {!! $key !!}:
                                  @endif
                              </td>
                              <td>{!! $val !!}</td>
                          </tr>
                          <?php $i++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
         <div class="card">
            <div class="card-header bgm-blue head-title">
                <h2>Reply</h2>
            </div><!-- .card-header -->
            <div class="card-body card-padding">    
                {!! Form::open([
                        'method' => 'PUT',
                        'route' => 'contact-gdoox-reply',
                        'class' => 'form-horizontal form-label-left'
                   ]) !!}
                   
                    {!! Form::hidden('_id', $messages->_id) !!}
                    <div class="form-group clearfix">
                        {!! Form::label('subject','Subject', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('subject', $messages->subject, array('readonly','placeholder' =>'Subject','class'=>'form-control')) !!}
                        </div>    
                    </div>
                   
                    <div class="form-group clearfix">
                        {!! Form::label('message','Message', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::textarea('message', '', array('required','placeholder' =>'Message','class'=>'form-control')) !!}
                        </div>    
                    </div>
                   
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button id="send" type="submit" class="btn btn-round btn-success">Send Message</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
@endsection

@section('footer_add_js_script')

<script>

</script>
@endsection


