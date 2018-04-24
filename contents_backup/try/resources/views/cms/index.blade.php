@extends('layout.backend.master')
@extends('layout.backend.userinfo')
@section('header_custom_css')        
    <!--header_custom_css-->

@endsection
@section('right_col_title_left')
    <h2>Site Pages</h2>
    <!--<div class="page-top-links">-->
<!--      <a href="{!! route('cms.create')  !!}" class="btn btn-default">Create New</a>
      <a href="{!! route('cms.index')  !!}" class="btn btn-default">View All</a>-->
    <!--</div>-->
@endsection

@section('right_col_title_right')
@endsection

@section('right_col')
      <!-- will be used to show any messages -->
    @if (Session::has('message'))
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!!  Session::get('message')  !!}
        </div>
    @endif
    
    @include('navigation_tabs.general_tabs')
    
    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>CMS Sites</h2>
        </div><!-- .card-header -->
        
            @if (count($pagesite)<1)
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    You have no Site
                </div>                 
            @else
                <div class="card-body card-padding">   
                    <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                        <table class="table table-striped responsive-utilities jambo_table ">
                            <thead>
                                <tr>
                                    <th>Site Name</th>
                                    <th>Site Slug</th>
                                    <th>Number of pages</th>
                                    <th>Action</th>
                                    <th>Page Information</th>
                                </tr>
                            </thead>
                            <tbody>    
                            @for( $i=0;$i<count($pagesite['sitename']);$i++)
                                <tr>
                                    <td>
                                        {!! $pagesite['sitename'][$i]  !!}
                                    </td>
                                    <td>
                                      {!! $pagesite['slug'][$i] !!} 
                                    </td>
                                    <td>
                                      {!!$count[$i]!!}
                                    </td>
                                    <td>                               
                                      <a href="{!! route('cms.index', ['slug' => $pagesite['slug'][$i]] )!!}" class="btn btn-default">Add</a>                                
                                    </td>
                                    <td colspan="4">
                                      <table class="table">
                                        <thead><tr><th>Page Name</th><th>Status</th><th>Action</th></tr></thead>
                                      @foreach($pages as $page)
                                          @foreach($page as $cmspages)
                                              @if($cmspages->slug == $pagesite['slug'][$i])
                                              <tr>
                                                <td>
                                                  <a href ="{!!route('cms.page', [$cmspages->slug, preg_replace('/[^a-zA-Z]+/', '', $cmspages->page_title), $cmspages->id ])!!}" target="_blank">{!!$cmspages->page_title!!}</a>
                                                </td>
                                                <td>{!!$cmspages->status!!}</td>
                                                <td>
                                                    <a href="{!! route('cms.index', ['id' => $cmspages->id] )!!}">Edit</a>|
                                                    <a href="{!! route('cms.page', [$cmspages->slug, preg_replace('/[^a-zA-Z]+/', '', $cmspages->page_title), $cmspages->id ])!!}" target="_blank">View</a>
                                                </td>
                                              </tr>
                                              @endif
                                          @endforeach
                                      @endforeach
                                      </table>
                                    </td>
        <!--                            <td>                               
                                        <a href="{!! route('cms.site.pages', $pagesite['slug'][$i] )!!}"><i class='zmdi zmdi-eye zmdi-hc-fw'></i> View</a>                                
                                    </td>-->
                                </tr> 
                            @endfor
                            </tbody>
                        </table>
                    </div>    
                </div>
            @endif
</div>
 @if($term == 1)
    @if($temp->count())
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h5>You have {!!count($temp)!!} pages in draft. You can save them from below link.</h5>
            <ul>
            @foreach($temp as $tmp)
            <li><a href="{!!route('cms.index', ['id' => $tmp->id])!!}">{!!$tmp->page_title!!}</a></li>
            @endforeach
            </ul>
        </div>
    @endif
     <div class="card">
    <div class="card-header bgm-blue">
        <h2>Add New Page </h2>
    </div><!-- .card-header -->
    
    <div class="card-body card-padding">    
      {!! Form::open(array('route' => 'cms.store','method'=>'POST', 'class'=>'form-horizontal form-label-left')) !!}
            
            {!! Form::hidden('status', 0, array('placeholder' => '', 'id' => 'status')) !!}
            
            <div class="form-group clearfix">
                {!! Form::label('page_title', 'Page Title', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text("page_title", null,array("required","placeholder" =>"Page Title",'class'=>'form-control')) !!}
                </div>
            </div>

            <div class="form-group clearfix">
                {!! Form::label('infomation', 'Description', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                <div class="col-md-9 col-sm-9 col-xs-12">
                    {!! Form::hidden('information', null, array('class'=>'form-control', 'id'=>'information')) !!}
                        <div class="html-editor"></div> 
                </div>    
            </div>
           
            <div class="form-group clearfix">
                {!! Form::label('sitename', 'Site Name', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('site_name', $site_slug, ['required', 'readonly', 'placeholder' => '----','class' => 'form-control','id'=>'site_name']) !!}
                </div>
            </div>
            
             <div class="form-group clearfix">
                {!! Form::label('seo_title', 'SEO Title', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('seo_title', '', ['placeholder' => 'SEO Title','class' => 'form-control','id'=>'seo_title']) !!}
                </div>
            </div>
            
            <div class="form-group clearfix">
                {!! Form::label('seo_description', 'SEO Description', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('seo_description', '', ['placeholder' => 'SEO Description','class' => 'form-control','id'=>'seo_description']) !!}
                </div>
            </div>
            
            <div class="form-group clearfix">
                {!! Form::label('seo_keywords', 'SEO Keywords', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('seo_keywords', '', ['placeholder' => 'SEO Keywords','class' => 'form-control','id'=>'seo_keywords']) !!}
                </div>
            </div>
            
            <div class="form-group clearfix">
                {!! Form::label('sort_order', 'Sort Order', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                <div class="col-md-6 col-sm-6 col-xs-12">
                  {!! Form::number("sort_order", '',array("required","placeholder" =>"",'class'=>'form-control', "min"=>0, "max"=>999)) !!}
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
 @elseif($term == 2)
     @if($temp->count())
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h5>You have already this page in draft. You can save it from below link.</h5>
            <ul>
            @foreach($temp as $tmp)
            <li><a href="{!!route('cms.index', ['id' => $tmp->id])!!}">{!!$tmp->page_title!!}</a></li>
            @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
    <div class="card-header bgm-blue">
        <h2>{!! $sitepages->page_title !!}</h2>
    </div><!-- .card-header -->
    
    <div class="card-body card-padding">    
        {!! Form::model($sitepages, [
            'method' => 'PUT',
            'route' => ['cms.update', $sitepages->_id],
            'class' => 'form-horizontal form-label-left',
            'novalidate' => ''
        ]) !!}

            {!! Form::hidden("user_id", $sitepages->user_id, array("required")) !!}
        
            <div class="form-group clearfix">
                    {!! Form::label('page_title', 'Page Title', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                    
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text("page_title", $sitepages->page_title, array("required", "placeholder" =>"", 'class'=>'form-control')) !!}
                    </div>
            </div>

            <div class="form-group clearfix">
                     {!! Form::label('infomation', 'Description', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        {!! Form::hidden('information', $sitepages->description, array('class'=>'form-control', 'id'=>'information')) !!}
                            <div class="html-editor"></div> 
                    </div>    
            </div>
            <div class="form-group clearfix">
                    {!! Form::label('sitename', 'Site Name', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('site_name', $sitepages->slug, ['required', 'readonly', 'placeholder' => '-Select Site-', 'class' => 'form-control', 'id'=>'site_name']) !!}
                    </div>
            </div>
            
            <div class="form-group clearfix">
                {!! Form::label('seo_title', 'SEO Title', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('seo_title', $sitepages->seo_title, ['placeholder' => 'SEO Title','class' => 'form-control','id'=>'seo_title']) !!}
                </div>
            </div>
            
            <div class="form-group clearfix">
                {!! Form::label('seo_description', 'SEO Description', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('seo_description', $sitepages->seo_description, ['placeholder' => 'SEO Description','class' => 'form-control','id'=>'seo_description']) !!}
                </div>
            </div>
            
            <div class="form-group clearfix">
                {!! Form::label('seo_keywords', 'SEO Keywords', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('seo_keywords', $sitepages->seo_keywords, ['placeholder' => 'SEO Keywords','class' => 'form-control','id'=>'seo_keywords']) !!}
                </div>
            </div>
            
            <div class="form-group clearfix">
                {!! Form::label('sort_order', 'Sort Order', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                <div class="col-md-6 col-sm-6 col-xs-12">
                  {!! Form::number("sort_order", $sitepages->sort_order,array("required","placeholder" =>"",'class'=>'form-control', "min"=>0, "max"=>999)) !!}
                </div>
            </div>
            
            <div class="form-group clearfix">
                    {!! Form::label('status','Status', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                    <div class="col-md-6 col-sm-6 col-xs-12">
                         {!! Form::select('status', $status , $sitepages->status, ['required','placeholder' => '--','class' => 'form-control','id'=>'status']) !!}
                    </div>
            </div>
      
            <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                    <button id="send" type="submit" onclick="setContentedit();" class="btn btn-round btn-success">Save</button>
                    <button type="submit" onclick="setContentedit();" class="btn btn-round btn-primary" name="type" value="temp">Preview</button>
                </div>
            </div>
      {!! Form::close() !!}
    </div>
</div>
 @endif
@endsection
@section('footer_add_js_files') 
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
  function setContentedit() {
      var sHTML = $('.html-editor').code();
      $('#information').val(sHTML);  
  }
 @if($term == 2) 
  $(document).ready(function() {
      var editor_data= "<?php echo $sitepages->description?>";
      $('.html-editor').code(editor_data);
  });
@endif  
</script>
@endsection
