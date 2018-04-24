@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
<!--<h2>  </h2>-->
@endsection

@section('right_col_title_right')
@endsection

@section('right_col')


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
	<div class="card-header bgm-blue head-title">
            <h2>Manage Permission For Team Member ( {!! $user->username !!} )</h2>
	</div><!-- .card-header -->
  
        <input type="hidden" name='save_as' id="save_as" value=""/>
         
        <div class="card-body card-padding">
            {!! Form::model($user, [
                'route'=>['manage.permissions', $id],
                    'class' => 'form-horizontal form-label-left'
                    ]) 
                 !!}
                <div class="form-group">
                    <div class="form-group clearfix">
                        {!! Form::label('ecomsite','Select Ecommerce Site', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::select('ecomsite', $ecomsites,'', array('id'=>'ecomsite','placeholder'=>'Please Select Site','required', 'class'=>'form-control')) !!}
                        </div>    
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                         <button id="send" type="submit" class="btn btn-round btn-success">Proceed</button>
                    </div>
                </div>
                {!! Form::close() !!}
            <br/>
            <br/>
<!--            <div class="form-group"> 
                <div class="col-md-5">
                    <div class="col-md-6 col-md-offset-3">
                        <button id="send" type="button" onclick="saveAsAdmin()" class="btn btn-round btn-success">Assign as Site Admin Role</button>
                    </div>
                </div>
                    <div class="col-md-1">OR</div>
                    {!! Form::model($user, [
                        'route'=>['store.permissions', $id],
                        'class' => 'form-horizontal form-label-left'
                        ]) 
                     !!}
                 
                        <input type="hidden" name='e_comsite' id="e_comsite" value=""/>
                        <input type="hidden" name='type' value="ecomsite"/>
                 
                        <div class="col-md-5">
                            @foreach($toplevel as $key=>$value)
                                @if($key === 'Manage e-commerce Site')
                                <p class="c-black f-500 m-b-20">{!! Form::checkbox('check_all','check_all','',array('id'=>'check_all')) !!}{!! $value !!}</p> 
                                    @foreach($sublevel[$key] as $val)
                                    <div class="checkbox m-b-15">
                                        <label>
                                            @if(in_array($val,$assigned))
                                                {!! Form::checkbox('permission[]', $val, 'checked', array('class'=>'perm')) !!}
                                            @else
                                                {!! Form::checkbox('permission[]', $val,'', array('class'=>'perm') ) !!}
                                            @endif
                                            <i class="input-helper"></i>
                                            {!! $val !!}
                                        </label>
                                    </div>
                                    @endforeach
                                @endif
                            @endforeach
                            <div>
                                <button id="send" type="submit" onclick="savePermissions()" class="btn btn-round btn-success">Save</button>
                            </div>
                        </div>
                {!! Form::close() !!}
            </div> -->
            
            
            
<!--            <div class="form-group"> 
                <div class="col-md-5">
                    <div class="col-md-6 col-md-offset-3">
                        <button id="send" type="button" class="btn btn-round btn-success">Assign New CRM Admin Role</button>
                    </div>
                </div>
                    <div class="col-md-1">OR</div>
                    {!! Form::model($user, [
                        'route'=>['store.permissions', $id],
                        'class' => 'form-horizontal form-label-left'
                        ]) 
                     !!}
                 
                        <input type="hidden" name='e_comsite' id="e_comsite" value=""/>
                        <input type="hidden" name='type' value="crm"/>
                 
                        <div class="col-md-5">
                            @foreach($toplevel as $key=>$value)
                            @if($key === 'CRM Administrator')
                                <p class="c-black f-500 m-b-20">{!! Form::checkbox('check_all_crm','check_all_crm','',array('id'=>'check_all_crm')) !!}{!! $value !!}</p> 
                                    @foreach($sublevel[$key] as $val)
                                    <div class="checkbox m-b-15">
                                        <label>
                                            @if(in_array($val,$assigned))
                                                {!! Form::checkbox('permission_crm[]', $val, 'checked', array('class'=>'perm_crm')) !!}
                                            @else
                                                {!! Form::checkbox('permission_crm[]', $val,'', array('class'=>'perm_crm') ) !!}
                                            @endif
                                            <i class="input-helper"></i>
                                            {!! $val !!}
                                        </label>
                                    </div>
                                    @endforeach
                                @endif
                            @endforeach
                            <div>
                                <button id="send" type="submit" onclick="savePermissions()" class="btn btn-round btn-success">Save</button>
                            </div>
                        </div>
                {!! Form::close() !!}
            </div>-->
        </div>
        
<!--         <div class="card-body card-padding">  
                {!! Form::model($user, ['route'=>['colleague.all'], 'class' => 'form-horizontal form-label-left myform']) !!}
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="col-md-6">
                                @foreach($toplevel as $key=>$value)
                                    <ul class="sub-ul">
                                         {!! $value !!}
                                         @foreach($sublevel[$key] as $val)
                                            <li>
                                                {!! Form::checkbox('permission[]', $val) !!} {!! $val !!}
                                            </li>
                                         @endforeach
                                    </ul>
                                @endforeach
                            </div>                            
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-md-offset-3">
                          <button id="send" type="submit" class="btn btn-round btn-success">Save</button>
                      </div>
                    </div>
                {!! Form::close() !!}
          </div>-->
        
        
        
        
      <div class="card-body card-padding">  
        @if ( !$ecommSites->count())
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                You have no site listed
            </div>    
        @else
        {!! Form::model($user, ['route'=>['colleague.all'], 'class' => 'form-horizontal form-label-left myform']) !!}
        <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <?php $i = 0;?>
                @foreach($ecommSites as $ecommSite)
                <div class="col-md-4 site_admin">
<!--                      <h4>{!!$ecommSite['ecomm_company_name']!!}</h4>-->
<!--                      @if(!empty($permission[$i]) &&  $permission[$i]->slug == $ecommSite['slug'])
                              <button type="button" class="btn btn-danger btn-xs add_site_admin" style="display: none;" >Assign Site Admin Role To ({!!$user->username!!})</button>
                              <button type="button" class="btn btn-danger btn-xs remove_site_admin">Remove Site Admin Role From ({!!$user->username!!})</button>
                          @else
                              <button type="button" class="btn btn-danger btn-xs add_site_admin" >Assign Site Admin Role To ({!!$user->username!!})</button>
                              <button type="button" class="btn btn-danger btn-xs remove_site_admin"  style="display: none;">Remove Site Admin Role From ({!!$user->username!!})</button>
                          @endif-->
<!--                          <h5 class="text-center">OR</h5><strong>(Manually define the permission to this user)</strong>-->
                          <!--<li data-cat_id="" id="" name='li_sub_data' class=""><i class="input-helper"></i>-->
<!--                             <ul class="sub-ul">
                                  {!!Form::hidden('site_slug', $ecommSite['slug'], ['class' => 'child site_slug'])!!}

                                  <?php $perm = (!empty($permission[$i])  && $permission[$i]->slug == $ecommSite['slug']) ? $permission[$i]->permission : array(); 
  //                              print_r($perm);die;?>
                                  <li>
                                      {!! Form::checkbox('permission[]', 'products/add', in_array('products/add', $perm), ['class'=>'child']  ) !!}Add Product
                                  </li>
                                  <li>
                                      {!! Form::checkbox('permission[]', 'products.add.buy', in_array('products.add.buy', $perm), ['class'=>'child']  ) !!}Add Procurement
                                  </li>
                                  <li>
                                      {!! Form::checkbox('permission[]', 'products/edit', in_array('products/edit', $perm), ['class'=>'child']   ) !!}Edit Product
                                  </li>
                                  <li>
                                      {!! Form::checkbox('permission[]', 'products/list', in_array('products/list', $perm), ['class'=>'child']   ) !!}Manage Product
                                  </li>
                                  <li>
                                      {!! Form::checkbox('permission[]', 'cms.create', in_array('cms.create', $perm), ['class'=>'child']   ) !!}Add Page On Site
                                  </li>
                                  <li>
                                      {!! Form::checkbox('permission[]', 'cms.edit', in_array('cms.edit', $perm), ['class'=>'child']   ) !!}Edit Page On Site
                                  </li>
                                  <li>
                                      {!! Form::checkbox('permission[]', 'cms.index', in_array('cms.index', $perm), ['class'=>'child']   ) !!} Manage Site
                                  </li>
                                  <li>
                                      {!! Form::checkbox('permission[]', 'cms.index', in_array('cms.index', $perm), ['class'=>'child']   ) !!} Manage Ecosystem Site
                                  </li>

                             </ul>-->
                          <!--</li>-->
                          <?php $i ++;?>
                </div>
                @endforeach
            </div>
        </div>
        <div class="ln_solid"></div>
        <div class="form-group">
<!--          <div class="col-md-6 col-md-offset-3">
              <button id="send" type="submit" class="btn btn-round btn-success">Save</button>
          </div>-->
        </div>
    {!! Form::close() !!}
    @endif
  </div>
</div><!-- .card -->
@endsection
@section('footer_add_js_script')
<script type="text/javascript">
    
    $(document).ready(function(){
        $(document).ready(function() {
            $(document).on(' change', 'input[name="check_all"]', function() {
                $('.perm').prop("checked", this.checked);
            });
            
            $(document).on(' change', 'input[name="check_all_crm"]', function() {
                $('.perm_crm').prop("checked", this.checked);
            });
            
            $(document).on('change', '#ecomsite', function() {
               var ecomstore = $(this).val();
               $('#e_comsite').val(ecomstore);
            });
        });
     });
    
    function savePermissions(){
//        var store = $('#e_comsite').val();
//        var stop = false;
//        if(jQuery('#permission input[type=checkbox]:checked').length) {
//            return true;
//        }
//        else {
//            alert("Please select atleast one Permission");
//            return stop;
//        }
//        
//        if(store===''){
//            alert("Please Select Ecommerse Site");
//            return stop;
//        }
    }
  
  $(document).ready(function(){
    $('.remove_site_admin').each(function(){
         if($(this).css('display') != "none"){
            $(this).parent().find('.child').prop({'disabled':'disabled'});
          }
     });
  });
//  $(".add_site_admin").on('click', function(){
//        ref = $(this);
//        if($(ref).parent().find('.child').prop({'checked':'checked'})){
//            var data = $(ref).parent().find('.child').serialize();
//            $(ref).parent().find('.child').prop({'disabled':'disabled'});
//            $.ajax({
//              url:"{!!route('site_admin', $user->id)!!}",
//              data: data,
//              type:'POST',
//              success:function(data){
//                if(data.success == true){
//                  $(ref).parent().find('.remove_site_admin').show();
//                  $(ref).hide();
//                }
//                else{
//                  alert(data.errors);
//                  location.reload();
//                }
//              }
//            });
//        }
//  });
//  $(".remove_site_admin").on('click', function(){
//        ref = $(this);
//        if($(ref).parent().find('.child').attr('checked', false)){
//            var site_slug =$(ref).parent().find(".site_slug").val();
//            $.ajax({
//              url:"{!!route('site_admin.remove')!!}",
//              data: {'site_slug':site_slug},
//              type:'POST',
//              success:function(data){
//                if(data.success == true){
//                  $(ref).parent().find('.add_site_admin').show();
//                  $(ref).hide();
//                   $(ref).parent().find('.child').prop('disabled', false);
//                }
//              }
//            });
//        }
//  });
</script>
@endsection