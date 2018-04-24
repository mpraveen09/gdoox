@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>  {!!$fm_data->labels['form_title']!!}</h2>-->
@endsection

@section('right_col_title_right')
      @if( !empty($site_info->slug) )
            <a href="{!! route('site', $site_info->slug)  !!}" type="submit" class="btn btn-default">View The Site</a>
      @endif
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
        <div class="card-header bgm-blue head-title">
          <h2>{!!$fm_data->labels['create']!!}</h2>
        </div><!-- .card-header -->
        <div class="card-body card-padding">    
          {!! Form::model($site_info, [
                  'method' => 'PUT',
                  'route' => ['personal-site-update', $site_info->id],
                  'class' => 'form-horizontal form-label-left',
                  'id'=>'personal_site',
                 'files'=>true
              ]) !!}

              @if (!empty($fm_data->labels))
                  @if(!empty($fm_data->labels['category_name']))
                    
                  <div class="form-group clearfix">
                        {!! Form::label('category_name', $fm_data->labels['category_name'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <ul id="ul_data" name='ul_data ' class="sidebar_cats">
                                @foreach ($selected_cat as $k1=>$top)
                                    <li data-cat_id="{!! $k1 !!}" id="{!! $k1 !!}" name='li_sub_data' class="">
                                        <i class="input-helper"></i>
                                         {!! Form::checkbox('category_id[]', $k1, true) !!}                                       
                                         {!! $top !!}
                                    </li>
                                @endforeach
                            </ul>
                            <a href="{!! route('personal-select_cat-edit', [$site_info->id])  !!}" class="btn btn-default">{!!$fm_data->labels['edit']!!}</a>
                        </div>    
                   </div>
                  @endif
                  
                  @if(!empty($fm_data->labels['site_name']))
                    <div class="form-group clearfix">
                        {!! Form::label('site_name', $fm_data->labels['site_name'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                       {!! Form::text('site_name', $site_info->site_name, array('required','placeholder' =>$fm_data->labels['site_name'],'class'=>'form-control', 'id'=>'site_title')) !!}
                       </div>    
                    </div>
                  @endif
                  
                  @if(!empty($fm_data->labels['slug']))
                    <div class="form-group clearfix">
                      {!! Form::label('slug', $fm_data->labels['slug'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      @if( empty($site_info->slug) )
                        {!! Form::text('slug', null, array('readonly','required','placeholder' =>'','class'=>'form-control', 'id'=>'site_slug')) !!}
                      @else
                        {!! Form::text('slug', null, array('readonly','disabled','placeholder' =>'','class'=>'form-control', 'id'=>'site_slug')) !!}
                        
                      @endif
                      </div>    
                    </div>
                  @endif
                  
                  @if(!empty($fm_data->labels['street_add']))
                    <div class="form-group clearfix">
                       {!! Form::label('street_add', $fm_data->labels['street_add'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                       <div class="col-md-6 col-sm-6 col-xs-12">
                      {!! Form::text('street_add', $site_info->street_add, array('placeholder' =>$fm_data->labels['street_add'],'class'=>'form-control')) !!}
                      </div>    
                    </div>
                  @endif

                  @if(!empty($fm_data->labels['city']))
                      <div class="form-group clearfix">
                          {!! Form::label('city', $fm_data->labels['city'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::text('city', $site_info->city, array('required','placeholder' =>$fm_data->labels['city'],'class'=>'form-control')) !!}
                          </div>    
                      </div>
                  @endif

                  @if(!empty($fm_data->labels['country']))
                        <div class="form-group clearfix">
                           {!! Form::label('country', $fm_data->labels['country'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                            <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::select('country', $country, $site_info->country, array('required', 'class'=>'form-control')) !!}
                            </div>   
                        </div>
                  @endif

                  @if(!empty($fm_data->labels['zip']))
                      <div class="form-group clearfix">
                           {!! Form::label('zip', $fm_data->labels['zip'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                            <div class="col-md-6 col-sm-6 col-xs-12">
                           {!! Form::text('zip', $site_info->zip, array('required','placeholder' =>$fm_data->labels['zip'],'class'=>'form-control')) !!}
                      </div>   
                    </div>
                  @endif

                  @if(!empty($fm_data->labels['phone_no1']))
                      <div class="form-group clearfix">
                        {!! Form::label('phone_no1', $fm_data->labels['phone_no1'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('phone_no1', $site_info->phone_no1, array('required','placeholder' =>$fm_data->labels['phone_no1'],'class'=>'form-control')) !!}
                        </div> 
                     </div>
                  @endif

                  @if(!empty($fm_data->labels['phone_no2']))
                      <div class="form-group clearfix">
                          {!! Form::label('phone_no2', $fm_data->labels['phone_no2'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                          <div class="col-md-6 col-sm-6 col-xs-12">
                         {!! Form::text('phone_no2', $site_info->phone_no2, array('placeholder' =>$fm_data->labels['phone_no2'],'class'=>'form-control')) !!}
                         </div>   
                      </div>
                  @endif

                  @if(!empty($fm_data->labels['fax_no']))
                    <div class="form-group clearfix">
                       {!! Form::label('fax_no', $fm_data->labels['phone_no2'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                       <div class="col-md-6 col-sm-6 col-xs-12">
                      {!! Form::text('fax_no', $site_info->fax_no, array('placeholder' =>$fm_data->labels['fax_no'],'class'=>'form-control')) !!}
                      </div>  
                   </div>
                  @endif

                  @if(!empty($fm_data->labels['mobile']))
                    <div class="form-group clearfix">
                        {!! Form::label('mobile', $fm_data->labels['mobile'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                       <div class="col-md-6 col-sm-6 col-xs-12">
                       {!! Form::text('mobile', $site_info->mobile, array('placeholder' =>$fm_data->labels['mobile'],'class'=>'form-control')) !!}
                       </div>    
                     </div>
                  @endif


                  @if(!empty($fm_data->labels['business_email1']))
                      <div class="form-group clearfix">
                          {!! Form::label('business_email1', $fm_data->labels['business_email1'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                          <div class="col-md-6 col-sm-6 col-xs-12">
                         {!! Form::email('business_email1', $site_info->business_email1, array('required', 'placeholder' =>$fm_data->labels['business_email1'],'class'=>'form-control')) !!}
                          </div>    
                    </div>
                  @endif

                  @if(!empty($fm_data->labels['business_email2']))
                    <div class="form-group clearfix">
                       {!! Form::label('business_email2', $fm_data->labels['business_email2'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                       <div class="col-md-6 col-sm-6 col-xs-12">
                       {!! Form::email('business_email2', $site_info->business_email2, array( 'placeholder' =>$fm_data->labels['business_email1'],'class'=>'form-control')) !!}
                       </div>    
                   </div>
                  @endif

                  @if(!empty($fm_data->labels['desc']))
                     <div class="form-group clearfix">
                        {!! Form::label('desc', $fm_data->labels['desc'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                       {!! Form::textarea('desc', $site_info->desc, array('size' => '30x4  ', 'placeholder' =>$fm_data->labels['desc'],'class'=>'form-control')) !!}
                       </div>    
                     </div>
                  @endif

                  @if(!empty($fm_data->labels['tags']))
                    <div class="form-group clearfix">
                       {!! Form::label('tags', $fm_data->labels['tags'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      {!! Form::text('tags', $site_info->tags, array('id' => 'tags_1','class'=>'tags form-control')) !!}
                       <div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
                      </div>   
                   </div>
                  @endif  

                  @if(!empty($fm_data->labels['org_type']))
                    <div class="form-group clearfix">
                       {!! Form::label('org_type', $fm_data->labels['org_type'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      {!! Form::select('org_type', $organization, $site_info->org_type, array('required', 'class'=>'form-control')) !!}
                      </div>    
                 </div>
                  @endif

                   @if(!empty($fm_data->labels['activity_type']))
                    <div class="form-group clearfix">
                       {!! Form::label('activity_type', $fm_data->labels['activity_type'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                      {!! Form::select('activity_type', $activity, $site_info->activity_type, array('required', 'class'=>'form-control')) !!}
                      </div>  
                    </div>
                  @endif

                  @if(!empty($fm_data->labels['operation']))
                    <div class="form-group clearfix">
                       {!! Form::label('operation', $fm_data->labels['operation'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                       <div class="col-md-6 col-sm-6 col-xs-12">
                      {!! Form::select('operation', $site_opt, $site_info->operation, array('required', 'placeholder' =>$fm_data->labels['operation'],'class'=>'form-control')) !!}
                      </div>   
                   </div>
                  @endif

                  @if(!empty($fm_data->labels['brands']))
                  <div class="form-group clearfix">
                       {!! Form::label('brands', $fm_data->labels['brands'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('brands',  $site_info->brands, array('placeholder' =>$fm_data->labels['brands'],'class'=>'form-control')) !!}
                      </div>    
                  </div>
                  @endif

                   @if(!empty($fm_data->labels['market']))
                  <div class="form-group clearfix">
                        {!! Form::label('market', $fm_data->labels['market'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::select('market', $market, $site_info->market, array('class'=>'form-control')) !!}
                        </div>  
                  </div>
                  @endif


                  @if(!empty($fm_data->labels['site_logo']))
                  <div class="form-group clearfix">
                       {!! Form::label('site_logo', $fm_data->labels['site_logo'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      {!! Form::file('site_logo', null, array('id'=>'site_logo','class'=>'form-control')) !!}
                    @if(!empty($site_info->site_logo))
                          {!! $img=$site_info->site_logo!!}
                          <br/>
                          <img src='{!!asset("uploads/$img")!!} 'class='' style="width:150px;">
                     @endif
                      <small>{!!$fm_data->labels['logo_desc']!!}</small>
                      </div>   
                  </div>
                  @endif
                  
                  @if (!empty($fm_data->labels['submit']))
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                             <button id="send" type="submit" class="btn btn-round btn-success">{!!$fm_data->labels['save']!!}</button>
                        </div>
                    </div>
                  @endif
             @endif
            {!! Form::close() !!}
        </div>
    </div>    
@endsection
@section('footer_add_js_script')

<script type="text/javascript">
$(document).ready(function(){
    var slug = $("#site_slug").val();
    @if( empty($site_info->slug) )
      $("#site_title").keyup(function(){
              var Text = $(this).val();
              Text = Text.toLowerCase();
              Text = Text.replace(/\s/g, '');
              $("#site_slug").val(Text);
        });
    @endif

    @if(isset($site_info->status) and $site_info->status !== 1)
      document.getElementById("site_image").required = true;
      document.getElementById("site_logo").required = true;
    @endif
      
   });
   
    $("#checkAll").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
    });
    
    
    $('#personal_site').on('change', 'input[type=checkbox]', function() {
        this.checked ? this.value = '0' : this.value = '1';
    });
    
</script>
@endsection

