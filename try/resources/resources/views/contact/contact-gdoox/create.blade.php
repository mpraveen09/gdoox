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

        @if (Session::has('message'))
            <div class="alert alert-info">{!!  Session::get('message')  !!}</div>
        @endif
        <!-- if there are creation errors, they will show here -->
        @if (HTML::ul($errors->all()))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                {!! HTML::ul($errors->all()) !!}
            </div>
        @endif
    
        @include('navigation_tabs.general_tabs')
        <div class="card">
             <div class="card-header bgm-blue head-title">
                 <h2>Contact Gdoox</h2>
                 <a href="{!! route('dashboard-index') !!}" type="submit" class="btn btn-default"><i class='zmdi zmdi-home'></i></a>
             </div><!-- .card-header -->
             <div class="card-body card-padding">    
                 {!! Form::open([
                         'method' => 'POST',
                         'route' => 'contact-gdoox-store',
                         'class' => 'form-horizontal form-label-left'
                    ]) !!}


                     <div class="form-group clearfix">
                         {!! Form::label('subject','Subject', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                         <div class="col-md-6 col-sm-6 col-xs-12">
                             {!! Form::text('subject','', array('required','placeholder' =>'Subject','class'=>'form-control')) !!}
                         </div>    
                     </div>

 <!--                <div class="form-group clearfix">
                         {!! Form::label('store','Select Store', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                         <div class="col-md-6 col-sm-6 col-xs-12">
                             {!! Form::select('store',$stores,'',array('required','placeholder' =>'Subject','class'=>'form-control')) !!}
                         </div>   
                     </div>-->

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
        
        <div class="card">
            <div class="card-header bgm-blue head-title">
                <h2>Messages</h2>
            </div>
            @if(!$messages->count())
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            There are no Messages
                        </div>  
                    </div>
                </div>     
            @else
                <div class="row">
                    <div class="text-right col-md-12">
                         {!! $messages->render() !!}
                    </div>
                </div>

                <div class="card-body card-padding">  
                    <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                        <table class="table table-striped responsive-utilities jambo_table ">
                            <thead>
                                 <th>Subject</th>
                                 <th>Date</th>
                                 <th>Action</th>
                            </thead>

                            <tbody>
                                @foreach($messages as $message)
                                    <tr>
                                        <td>{!! $message->subject !!}</td>
                                        <td>{!! $message->created_at !!}</td>
                                        <th>
                                            <a href="{!! route('contact-gdoox-create', ['_id'=>$message->_id,'flag'=>'view']) !!}">View</a> &nbsp;
                                        </th>
                                    </tr>
                                 @endforeach
                            </tbody>  
                        </table>
                  </div>
               </div>
                <div class="row">
                    <div class="text-right col-md-12">
                         {!! $messages->render() !!}
                    </div>
                </div>
            @endif   
        </div>    
        
        
        @if($flag==='view')
            <div class="card">
                 <div class="card-header bgm-blue head-title">
                     <h2>Messages (Subject: {!! $msg->subject !!})</h2>
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
                             <?php $j = 1; ?>
                             @foreach($msg->message as $k=>$v)
                               <tr>
                                   <td>{!! $j !!}</td>
                                   <td>{!! $k !!}</td>
                                   <td>{!! $v !!}</td>
                               </tr>
                               <?php $j++; ?>
                             @endforeach
                         </tbody>
                     </table>
                 </div>
             </div>
        @endif
@endsection

@section('footer_add_js_script')

<script>

</script>
@endsection


