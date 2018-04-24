@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('header_custom_css')        
    <!--header_custom_css-->
    <link href="{{ asset('/m-admin-ui/vendors/bower_components/summernote/dist/summernote.css') }}" rel="stylesheet">

@endsection

@section('right_col_title_left')
   <h2>Add Page</h2>
    <!--<div class="page-top-links">-->
      <a href="{!! route('cms.create')  !!}" class="btn btn-default">Create New</a>
      <a href="{!! route('cms.index')  !!}" class="btn btn-default">View All</a>
    <!--</div>-->
@endsection

@section('right_col_title_right')
@endsection
@section('right_col')
    @if($temp->count())
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h5>You have {!!count($temp)!!} pages in draft. You can save them from below link.</h5>
            <ul>
            @foreach($temp as $tmp)
            <li><a href="{!!route('cms.edit', [$tmp->id])!!}">{!!$tmp->page_title!!}</a></li>
            @endforeach
            </ul>
        </div>
    @endif
    <!-- if there are creation errors, they will show here -->
    @if (Session::has('message'))
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!!  Session::get('message')  !!}
        </div>
    @endif
    
    @if (HTML::ul($errors->all()))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!! HTML::ul($errors->all()) !!}
        </div>
    @endif

    
    <div class="card">
    <div class="card-header bgm-blue">
        <h2>Add New Page </h2>
    </div><!-- .card-header -->
    
    <div class="card-body card-padding">    
      {!! Form::open(array('route' => 'cms.store','method'=>'POST', 'class'=>'form-horizontal form-label-left')) !!}
            
            {!! Form::hidden('status', 0,array('placeholder' =>'','id'=>'status')) !!}
            
            <div class="form-group clearfix">
                    {!! Form::label('page_title', 'Page Title', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text("page_title", null,array("required","placeholder" =>"Page Title",'class'=>'form-control')) !!}
                    </div>
            </div>

            <div class="form-group clearfix">
                    {!! Form::label('infomation', 'Description', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        {!! Form::hidden('information', null,array('placeholder' =>'','class'=>'form-control','id'=>'information')) !!}
                            <div class="html-editor"></div>
                    </div>    
            </div>
           
            <div class="form-group clearfix">
                    {!! Form::label('sitename', 'Site Name', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::select('site_name', $sites, null, ['required', 'placeholder' => '----', 'class' => 'form-control', 'id' => 'site_name']) !!}
                    </div>
            </div>
            <div class="form-group clearfix">
              {!! Form::label('sort_order', 'Sort Order', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 

              <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::number("sort_order", 0,array("required","placeholder" =>"",'class'=>'form-control', "min"=>0, "max"=>999)) !!}
              </div>
            </div>
      
            <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                    <button id="send" type="submit" onclick="setContent();" class="btn btn-round btn-success">Save</button>
                    <button type="submit" onclick="setContent();" class="btn btn-round btn-primary" name="type" value="temp">Preview</button>
                </div>
            </div>
      {!! Form::close() !!}
    </div>
</div>

@endsection



@section('footer_add_js_files') 
    <script src="{{ asset('/m-admin-ui/vendors/bower_components/summernote/dist/summernote.min.js') }}"></script>
   
@endsection

@section('footer_add_js_script') 
    <script>
        function setContent() {
            var sHTML = $('.html-editor').code();
            $('#information').val(sHTML);  
        }   
        $(document).ready(function() {
            $('.html-editor').code($('#information').val());
        });
        </script>
@endsection