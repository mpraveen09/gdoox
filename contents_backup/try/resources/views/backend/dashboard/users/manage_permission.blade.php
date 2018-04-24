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
    
<div class="card">
	<div class="card-header bgm-blue head-title">
		<h2>Manage Permission For Gdoox Member</h2>
	</div><!-- .card-header -->
        
      <div class="card-body card-padding">  
            {!! Form::model($user,['route'=>['gdoox_member.store_permission', $user->id],'class' => 'form-horizontal form-label-left myform']) !!}
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12">
                   <h4>Assign Permission to {!!$user->username!!}</h4>
                    <ul>                               
                        <li data-cat_id="" id="" name='li_sub_data' class=""><i class="input-helper"></i>
                          <?php $perm= isset($permission->permission) ? $permission->permission : array();?>
                           
                          {!! Form::checkbox('all', "all", in_array('all', $perm), array('id' => 'checkall', 'class'=>'parent')) !!} 
                          All
                           <ul class="sub-ul">
                                <li>
                                  {!! Form::checkbox('permission[]', 'attributes.index', in_array('attributes.index', $perm), ['class'=>'child']  ) !!}Attribute List
                                </li>
                                <li>
                                  {!! Form::checkbox('permission[]', 'attributesassoc.index', in_array('attributesassoc.index', $perm), ['class'=>'child']  ) !!}Attribute Association
                                </li>
                                <li>
                                  {!! Form::checkbox('permission[]', 'attributestype.index', in_array('attributestype.index', $perm), ['class'=>'child']  ) !!}Attribute Data Type
                                </li>
                                <li>
                                  {!! Form::checkbox('permission[]', 'dropdownoptions.index', in_array('dropdownoptions.index', $perm), ['class'=>'child']  ) !!}Dropdown Option List
                                </li>
                                <li>
                                  {!! Form::checkbox('permission[]', 'categories.index', in_array('categories.index', $perm), ['class'=>'child']  ) !!}Add Category
                                </li>
                                <li>
                                  {!! Form::checkbox('permission[]', 'category-upload-create', in_array('category-upload-create', $perm), ['class'=>'child']  ) !!}Import Category
                                </li>
                                <li>
                                  {!! Form::checkbox('permission[]', 'crm_contacts.columns', in_array('crm_contacts.columns', $perm), ['class'=>'child']  ) !!}Export Excel Structure
                                </li>
                                <li>
                                  {!! Form::checkbox('permission[]', 'crm_contacts.upload_excel', in_array('crm_contacts.upload_excel', $perm), ['class'=>'child']  ) !!}Import Contacts
                                </li>
                                <li>
                                  {!! Form::checkbox('permission[]', 'tasks.index', in_array('tasks.index', $perm), ['class'=>'child']  ) !!}CRM Task
                                </li>
                                <li>
                                  {!! Form::checkbox('permission[]', 'crm_users.index', in_array('crm_users.index', $perm), ['class'=>'child']  ) !!}Users
                                </li>
                                <li>
                                  {!! Form::checkbox('permission[]', 'select_group', in_array('select_group', $perm), ['class'=>'child']  ) !!}Add Users to Groups
                                </li>
                                <li>
                                  {!! Form::checkbox('permission[]', 'crm_accounts.index', in_array('crm_accounts.index', $perm), ['class'=>'child']  ) !!}Manage Accounts
                                </li>
                                <li>
                                  {!! Form::checkbox('permission[]', 'crm_opportunities.index', in_array('crm_opportunities.index', $perm), ['class'=>'child']  ) !!}Opportunities
                                </li>
                                <li>
                                  {!! Form::checkbox('permission[]', 'crm_groups.index', in_array('crm_groups.index', $perm), ['class'=>'child']  ) !!}Manage Groups
                                </li>
                                <li>
                                  {!! Form::checkbox('permission[]', 'crm_contacts.index', in_array('crm_contacts.index', $perm), ['class'=>'child']  ) !!}Manage Contacts
                                </li>
                                <li>
                                  {!! Form::checkbox('permission[]', 'crm_emails.index', in_array('crm_emails.index', $perm), ['class'=>'child']  ) !!}Manage Email's
                                </li>
                                <li>
                                  {!! Form::checkbox('permission[]', 'crm_emails.drafts', in_array('crm_emails.drafts', $perm), ['class'=>'child']  ) !!}View Drafts
                                </li>
                                <li>
                                  {!! Form::checkbox('permission[]', 'crm_templates.index', in_array('crm_templates.index', $perm), ['class'=>'child']  ) !!}Manage Templates
                                </li>
                           </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-md-offset-1">
                  <a href="{!!route('gdoox_member.view_all')!!}" type="submit" class="btn btn-round btn-primary">Cancel</a>
                  <button id="send" type="submit" class="btn btn-round btn-success">Save</button>
              </div>
            </div>
 
        {!! Form::close() !!}
	</div>
</div><!-- .card -->
@endsection
@section('footer_add_js_script')
<script type="text/javascript">
    $(function(){
       $('.parent').click(function(){
          $(this).parent().find('.sub-ul:first .child').prop('checked',$(this).is(':checked'));
       });
     });
</script>
@endsection