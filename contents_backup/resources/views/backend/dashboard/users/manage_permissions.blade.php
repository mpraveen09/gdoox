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
    
    @include('navigation_tabs.general_tabs')
    
    <div class="card">
	<div class="card-header bgm-blue head-title">
            <h2>Manage Permission For Team Member ( {!! $user->username !!} )</h2>
	</div><!-- .card-header -->
  
        <input type="hidden" name='save_as' id="save_as" value=""/>
         
        <div class="card-body card-padding">
            <div class="form-group clearfix"> 
                <div class="col-md-5">
                    <div class="col-md-6 col-md-offset-3">
                        {!! Form::model($user, ['route'=>['store.permissions', $id]]) !!}
                            <input type="hidden" name='e_comsite' id="e_comsite" value="{!! $ecomsite  !!}"/>
                            <input type="hidden" name='type' value="ecomsite"/>
                            
                            @if(!isset($assigned_permissions->is_site_admin))
                                <input type="hidden" name='assign_as_admin' value="yes"/>
                                <button id="send" type="submit" class="btn btn-round btn-success">Assign as Site Admin Role</button>
                            @else
                                @if($assigned_permissions->is_site_admin==='no')
                                    <input type="hidden" name='assign_as_admin' value="yes"/>
                                    <button id="send" type="submit" class="btn btn-round btn-success">Assign as Site Admin Role</button>
                                @else 
                                    <input type="hidden" name='assign_as_admin' value="remove"/>
                                    <button id="send" type="submit" class="btn btn-round btn-danger">Remove Site Admin Role</button>
                                @endif
                            @endif
                            
                        {!! Form::close() !!}
                    </div>
                </div>
                
                <div class="col-md-1">OR</div>
                    {!! Form::model($user, [
                        'route'=>['store.permissions', $id],
                        'class' => 'form-horizontal form-label-left'
                        ]) 
                     !!}
                 
                        <input type="hidden" name='e_comsite' id="e_comsite" value="{!! $ecomsite  !!}"/>
                        <input type="hidden" name='type' value="ecomsite"/>
                        <input type="hidden" name='assign_as_admin' value="no"/>
                 
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
            </div> 
              
            <div class="form-group clearfix"> 
                <div class="col-md-5">
                    <div class="col-md-6 col-md-offset-3">
                        {!! Form::model($user, ['route'=>['store.permissions', $id]]) !!}
                            <input type="hidden" name='e_comsite' id="e_comsite" value=""/>
                            <input type="hidden" name='type' value="crm"/>
                            @if(!isset($assigned_crm_permissions->is_crm_admin))
                                <input type="hidden" name='assign_as_admin' value="yes"/>
                                <button id="send" type="submit" class="btn btn-round btn-success">Assign New CRM Admin Role</button>
                            @else
                                @if($assigned_crm_permissions->is_crm_admin==='no')
                                    <input type="hidden" name='assign_as_admin' value="yes"/>
                                    <button id="send" type="submit" class="btn btn-round btn-success">Assign New CRM Admin Role</button>
                                @else
                                    <input type="hidden" name='assign_as_admin' value="remove"/>
                                    <button id="send" type="submit" class="btn btn-round btn-danger">Remove CRM Admin Role</button>
                                @endif
                            @endif
                        {!! Form::close() !!}
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
                        <input type="hidden" name='assign_as_admin' value="no"/>
                 
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
            </div>
            
            <div class="form-group clearfix"> 
                <div class="col-md-5">
                    <div class="col-md-6 col-md-offset-3">
                        <b>Procurement</b>
                    </div>
                </div>
                <div class="col-md-1"></div>
                    {!! Form::model($user, [
                        'route'=>['store.permissions', $id],
                        'class' => 'form-horizontal form-label-left'
                        ]) 
                     !!}
                 
                        <input type="hidden" name='procurements' id="procurements" value=""/>
                        <input type="hidden" name='type' value="procurements"/>
                 
                        <div class="col-md-5">
                            @foreach($toplevel as $key=>$value)
                            @if($key === 'Procurement')
                                <p class="c-black f-500 m-b-20">{!! Form::checkbox('check_all_proc','check_all_proc','',array('id'=>'check_all_proc')) !!}{!! $value !!}</p> 
                                    @foreach($sublevel[$key] as $val)
                                    <div class="checkbox m-b-15">
                                        <label>
                                            @if(in_array($val,$assigned))
                                                {!! Form::checkbox('permission_procurement[]', $val, 'checked', array('class'=>'perm_procurement')) !!}
                                            @else
                                                {!! Form::checkbox('permission_procurement[]', $val,'', array('class'=>'perm_procurement') ) !!}
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
            </div>
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
            
            $(document).on(' change', 'input[name="check_all_proc"]', function() {
                $('.perm_procurement').prop("checked", this.checked);
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