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
    
    @if (Session::has('message'))
        <div class="alert alert-info">{!!  Session::get('message')  !!}</div>
    @endif
    
    @include('navigation_tabs.crm_tabs')
    
    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>Select Contacts</h2>
            <a href="{!! route('crm_emails.index')  !!}" class="btn  btn-default">View All</a>
            <button class="btn btn-info waves-effect" onclick="goBack()">Go Back</button>
        </div>
        
        @if(empty($users))
            <div class="card-body card-padding">
                No more contacts to show, All the Contacts added to this group.
            </div>
        @endif
        
        <div class="card-body card-padding">
                {!! Form::open([
                    'method' => 'POST',
                    'route' => 'add_contact_to_group',
                    'class' => 'form-horizontal form-label-left'
                ]) !!}
               
                {!! Form::hidden('group_name',$group) !!}
                
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <ul id="ul_data" name='ul_data ' class="sidebar_cats">
                            @foreach($users as $user)
                                <li data-cat_id="" id="" name='li_sub_data' class="">
                                   <i class="input-helper"></i>
                                   {!! Form::checkbox('users[]', $user->_id, false ,array('id' => 'users')) !!}  {!! $user->first_name.' '.$user->last_name !!} ( {!! $user->email_address !!} )
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="ln_solid"></div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                       <a href="{!! route('select_group')  !!}" type="submit" class="btn btn-round btn-primary">{!! $form_fields->labels['cancel'] !!}</a>
                       <button id="send" type="submit" class="btn btn-round btn-success">{!! $form_fields->labels['next'] !!}</button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>  
    </div>
@endsection


@section('footer_add_js_script')

@endsection



