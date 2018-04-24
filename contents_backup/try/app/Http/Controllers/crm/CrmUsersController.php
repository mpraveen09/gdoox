<?php

namespace Gdoox\Http\Controllers\crm;


use Gdoox\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Gdoox\Models\CrmFieldMaster;
use Gdoox\Models\CrmUsers;
use Gdoox\Models\DropdownOption;
use Gdoox\Models\CrmDropdownOptions;
use Gdoox\Models\CrmGroups;
use Gdoox\Models\BusinessInfo;
use Gdoox\Models\NavigationMenu;
use Gdoox\UserRole;
use Gdoox\Role;
use Gdoox\User;
use Route;
use Form;
use Image;
use Input;
use UUID;

class CrmUsersController extends Controller
{ 
    
    private $language;
    public function __construct(){
        $this->language = session('app_language');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(){
        try {
            $limit = 25;
            $data = Request::all();
            $fname = $lname = $department_val = $status_val = '';
            list($route, $nav_menus, $sub_nav_menu) = $this->navigationTabs();
            
            $form_fields = CrmFieldMaster::where('title','=','crm_users')->where('lang','=','en')->first();
            $department = array("Accounts"=>"Accounts","Admin"=>"Admin","HR"=>"HR","Marketing"=>"Marketing","Sales"=>"Sales");

            $user_status = CrmDropdownOptions::where('name','=','crm_user_status')->first();
            foreach($user_status->options as $stat) {
                $status[$stat] = $stat;
            }


            if(!empty($data)){    
                $builder = CrmUsers::query(); 

                if(!empty($data['first_name'])) {
                     $fname = $data['first_name'];
                     $builder->where('first_name','like', '%'.$fname.'%');
                }

                if(!empty($data['last_name'])) {
                    $lname = $data['last_name'];
                    $builder->where('last_name','like','%'.$lname.'%');
                }

                if(!empty($data['department'])) {
                     $department_val = $data['department'];
                     $builder->where('department','=', $department_val);
                }

                if(!empty($data['status'])) {
                     $status_val = $data['status'];
                     $builder->where('status','=', $status_val);
                }

                $users = $builder->orderBy('_id')->paginate($limit);   
            }
            else {
                $users = CrmUsers::where('flag','=','1')->paginate($limit);
            }
        
            return view('crm.crm_users.index', compact('status','department','users','form_fields','fname','lname','department_val','status_val','route', 'nav_menus', 'sub_nav_menu'));
        }
        catch(\Exception $e) {
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
           // Session::flash('message', "Oops! Something went Wrong. Please try Again");
           // return Redirect::back();
       }  
    }
    
    
    
    /**
     * Show the form for adding a new product.
     *
     * @return Response
     */    
    public function create(){
        try {
            if(Auth::user()){
                $createForm = array();
                $userid = Auth::user()->id;
                list($route, $nav_menus, $sub_nav_menu) = $this->navigationTabs();
                
                $form_data = CrmFieldMaster::where('title','=','crm_users')->where('lang','=','en')->first();     
                foreach($form_data->form_fields as $data){
                    $options = $this->getOptions($data['name']);
                    $createForm[] = $this->createForm($data['label'], $data['name'], $data['type'], $data['maxlength'], $data['required'],'', $options);
                }
                return view('crm.crm_users.create', compact('createForm','route','nav_menus','sub_nav_menu'));
            }
            else {
               return redirect('auth/login')->with('message',"Please Login to Add User!"); 
            }
        }
        catch(\Exception $e) {
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
           // Session::flash('message', "Oops! Something went Wrong. Please try Again");
           // return Redirect::back();
       }
    }    

    function createForm($lbl_name, $field_name='', $field_type='', $field_max_val='', $required='', $value='', $options='') {
        switch ($field_type) {    
        case "text":
            $Fields = "<div class='item form-group'>"
                . Form::label($lbl_name,'', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) 
                ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                . Form::$field_type($field_name, $value, [$required,'class' => 'form-control col-md-7 col-xs-12','placeholder' =>$lbl_name ])
                . "</div>
                 </div>";
        break;

        case "select":
            $Fields = "<div class='item form-group'>"
                . Form::label($lbl_name,'', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) 
                ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                . Form::select($field_name, $options, $value, ['class' => 'form-control col-md-7 col-xs-12', 'required', 'placeholder' => $lbl_name])
                . "</div>
             </div>";
        break;

        case "multiselect":
            $Fields = "<div class='item form-group'>"
                . Form::label($lbl_name,'',['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) 
                ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                . Form::select('user_group[]', $options, $value, ['class' => 'class="selectpicker" form-control col-md-7 col-xs-12','multiple','required', 'placeholder' => $lbl_name])
                . "</div>
             </div>";
        break;

        case "date":
            $Fields = "<div class='item form-group'>"
                . Form::label($lbl_name,'', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) 
                ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                . Form::$field_type($field_name, $value ,['class' => 'form-control col-md-7 col-xs-12','placeholder' =>$lbl_name ])
                . "</div>
                 </div>";
        break;

        case "textarea":
            $Fields = "<div class='item form-group'>"
                . Form::label($lbl_name,'', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) 
                ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                . Form::$field_type($field_name, $value ,['class' => 'form-control col-md-7 col-xs-12','placeholder' =>$lbl_name ])
                . "</div>
                 </div>";
        break;

        default:
            $Fields='';
            break;
     }
        return $Fields;
  }
    
    public function getOptions($field) {
        $comp = array();
        $groups = array();
        if($field==='country') {
            $countries =  DropdownOption::where('name','countries')->where('type','drop_down')->where('lang', $this->language)->first();
            foreach($countries->options as $countryname){
                $country[$countryname] = $countryname;
            }
            $options = $country;
        }
        
        elseif($field==='department') {
            $departments = CrmDropdownOptions::where('name','=','crm_department')->first();
            foreach($departments->options as $dept) {
                $department[$dept] = $dept;
            }
            $options = $department;
        }
        
        elseif($field==='company_name'){
            
            $role_id= UserRole::where('user_id','=',Auth::id())->project(array('role_id'))->first();
            $role= Role::where('_id','=',$role_id->role_id)->first();
            if($role->name==='superadmin')
            {
                $company= BusinessInfo::where('status','=','Active')->project(array('company_name'))->get();
                foreach($company as $val) {
                    $comp[$val->company_name] = $val->company_name;
                }
                $options = $comp;
            }
            else
            {
                $company= BusinessInfo::where('status','=','Active')->where('user_id','=',Auth::id())->project(array('company_name'))->first();
                foreach($company->company_name as $val) {
                    $comp[$val] = $val;
                }
                $options = $comp;
            }
        }
        
        elseif($field==='status') {
            $user_status = CrmDropdownOptions::where('name','=','crm_user_status')->first();
            foreach($user_status->options as $stat) {
                $status[$stat] = $stat;
            }
            $options = $status;
        }
        
//        elseif($field==='is_admin') {
//            $is_admin_flag = CrmDropdownOptions::where('name','=','crm_is_admin')->first();
//            foreach($is_admin_flag->options as $adm) {
//                $is_admin[$adm] = $adm;
//            }
//            $options = $is_admin;
//        }
//        
//        elseif($field==='is_group_admin') {
//            $is_grpadmin_flag = CrmDropdownOptions::where('name','=','crm_is_admin')->first();
//            foreach($is_grpadmin_flag->options as $adm) {
//                $is_group_admin[$adm] = $adm;
//            }
//            $options = $is_group_admin;
//        }
        
        elseif ($field==='user_group') {
            $userid= Auth::id();
            $crm_groups = CrmGroups::where('user_id','=',$userid)->get();
            
            foreach ($crm_groups as $value) {
                $groups[$value->group_name] = $value->group_name;
            }
            $options = $groups;
        }
        
        else {
            $options ='';
        }
        return $options;
    }
    /*
    * Edit product
    */
    public function edit($id){
        try{
            if(Auth::user()){
                 $createForm = array();
                 $value = "";
                 $userdata = CrmUsers::where('_id','=',$id)->first();
                 $form_data = CrmFieldMaster::where('title','=','crm_users')->where('lang','=','en')->first();
                 list($route, $nav_menus, $sub_nav_menu) = $this->navigationTabs();
                 
                 foreach($form_data->form_fields as $data){
                    if(!empty($userdata->$data['name'])){
                        $value = $userdata->$data['name'];
                    }
                    
                    $options = $this->getOptions($data['name']);
                    $createForm[] = $this->createForm($data['label'], $data['name'], $data['type'], 
                             $data['maxlength'], $data['required'], $value, $options);
                 }

                 return view('crm.crm_users.edit', compact('createForm','id','route', 'nav_menus', 'sub_nav_menu'));
            }
            else {
               return redirect('auth/login')->with('message',"Please Login to Add user!"); 
            }
        }
        catch(\Exception $e) {
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
           // return Redirect::route('crm_users.index')->with('message','Oops! Something went Wrong. Please Try Again'); 
       }
    }    

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(){
        try{
            if(Auth::user()){
                $company = BusinessInfo::where('user_id','=',Auth::id())->project('company_name')->first();
                $request = Request::all();
                $data = new CrmUsers();

                $data->user_id = Auth::id();
                $data->first_name = $request['first_name'];
                $data->company_name = $request['company_name'];
                $data->last_name = $request['last_name'];
                $data->user_name = $request['user_name'];
                $data->status = $request['status'];
                $data->role = '';
             // $data->is_admin= $request['is_admin'];
             // $data->is_group_admin=$request['is_group_admin'];
                $data->title = $request['title'];
            //  $data->user_group = $request['user_group'];
                $data->department = $request['department'];
                $data->phone = $request['phone'];
                $data->address = $request['address'];
                $data->email_address = $request['email_address'];
                $data->state = $request['state'];
                $data->city = $request['city'];
                $data->postal_code = $request['postal_code'];
                $data->country = $request['country'];
                $data->flag = '1';

                if($data->save()){
                    Session::flash('message', 'User Added Successfully');
                    return Redirect::route('crm_users.index');
                }
                else {
                    Session::flash('message', 'User could not be Added! Please Try Again');
                    return Redirect::route('crm_users.create')->with(Request::all());
                }
            }
            else {
                    return redirect('auth/login')->with('message',"Please Login to Add User!"); 
            }
        }
        catch(\Exception $e) {
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
           // Session::flash('message', "Oops! Something went Wrong. Please try Again");
           // return Redirect::back();
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id){
        try {
            if(Auth::user()){
                list($route, $nav_menus, $sub_nav_menu) = $this->navigationTabs();
                $form_fields = CrmFieldMaster::where('title','=','crm_users')->first();
                $userdata = CrmUsers::where('_id','=',$id)->first();
                return view('crm.crm_users.show', compact('form_fields','userdata','route','nav_menus','sub_nav_menu'));
            }
            else {
               return redirect('auth/login')->with('message',"Please Login to Create Task!"); 
            }
        }
        catch(\Exception $e) {
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
           // return Redirect::route('crm_users.index')->with('message','Oops! Something went Wrong. Please Try Again'); 
       }
    }
    

/*
 * Update product
 */
  public function update($id){
    try{
        if(Auth::user()){
            $request = Request::all();
            $data = CrmUsers::where('_id','=',$id)->first();

            $data->first_name = $request['first_name'];
            $data->last_name = $request['last_name'];
            $data->user_name = $request['user_name'];
            $data->status = $request['status'];
            $data->company_name = $request['company_name'];
         // $data->is_admin= $request['is_admin'];
         // $data->is_group_admin=$request['is_group_admin'];
            $data->title = $request['title'];
            $data->user_group = $request['user_group'];
            $data->department = $request['department'];
            $data->phone = $request['phone'];
            $data->address = $request['address'];
            $data->email_address = $request['email_address'];
            $data->state = $request['state'];
            $data->city = $request['city'];
            $data->postal_code = $request['postal_code'];
            $data->country = $request['country'];


            if($data->save()){
                Session::flash('message', 'User Updated Successfully');
                return Redirect::route('crm_users.index');
            }
            else {
                Session::flash('message', 'Task could not be Created! Please Try Again');
                return Redirect::route('crm_users.edit',$id)->with(Request::all());
            }
        }
        else {
                return redirect('auth/login')->with('message',"Please Login to Create Task!"); 
        }
    }
    catch(\Exception $e){
        $errors = $this->errorMessage($e);
        return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
       // return Redirect::route('crm_emails.index')->with('message','Oops! Something went Wrong. Please Try Again'); 
    }
  } 
  
  
  public function selectGroup(){
      try {
            if(Auth::user()) {
                $userid = Auth::id();
                $groups = array();
                list($route, $nav_menus, $sub_nav_menu) = $this->navigationTabs();
                
                $form_fields = CrmFieldMaster::where('title','=','crm_common_fields')->first();

                $user_groups = CrmGroups::where('user_id','=',$userid)->get();
                foreach($user_groups as $value){
                    $groups[$value->group_name] = $value->group_name;
                }

                return view('crm.crm_users.select_group',compact('groups','form_fields','route', 'nav_menus', 'sub_nav_menu'));
            }
            else {
                return redirect('auth/login')->with('message','Please Login');
            }
      }
      catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
            // Session::flash('message', "Oops! Something went Wrong. Please try Again");
            // return Redirect::back();
        }
  }
  
  public function selectUser(){
      try {
            if(Auth::user()) {
                $data =  Request::all();
                list($route, $nav_menus, $sub_nav_menu) = $this->navigationTabs();
                $group = $data['group'];      
                $userid = Auth::id();
                $form_fields = CrmFieldMaster::where('title','=','crm_common_fields')->first();
                $users = CrmUsers::where('user_id','=',$userid)->get();

                return view('crm.crm_users.select_user',compact('users','form_fields','group','route', 'nav_menus', 'sub_nav_menu'));

            }
            else {
                return redirect('auth/login')->with('message','Please Login');
            }
      }
      catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
          // Session::flash('message', "Oops! Something went Wrong. Please try Again");
          // return Redirect::back();
        }
  }
  
  public function addUserToGroup(){
      try {
        if(Auth::user()) {
              $data = Request::all();
              list($route, $nav_menus, $sub_nav_menu) = $this->navigationTabs();
              if (array_key_exists("users",$data)){
                    $userid = Auth::id();
                    $group[] = $data['group_name'];

                    $form_fields = CrmFieldMaster::where('title','=','crm_common_fields')->first();

                    $user_groups = CrmGroups::where('user_id','=', $userid)->get();
                    foreach($user_groups as $value){
                        $groups[$value->group_name] = $value->group_name;
                    }

                    foreach($data['users'] as $key=>$val){
                      CrmUsers::where('_id','=',$val)->push('user_group', $data['group_name']);
                    }
              }
              else {
                   Session::flash('message', "Please Select atleat one User to Add to Group");
                   return Redirect::back();
              }
            return view('crm.crm_users.select_group',compact('users','form_fields','groups','route', 'nav_menus', 'sub_nav_menu'));

        }
        else {
            return redirect('auth/login')->with('message','Please Login');
        }
      }
      catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }
    
    public function navigationTabs(){
        $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('group','crm')->where('lang','en')->get();
        $route = Route::getCurrentRoute()->getName();
        $sub_nav_menu = array();
        $nav_menus = array();

        foreach($nav_menu as $menu){
            $nav_menus[$menu->route] = $menu->name;
        }
        foreach ($nav_menu as $menu) {
            foreach($menu->child_routes as $child){
                $sub_nav_menu[$menu->route][] = $child;
            }
        } 
        return array($route, $nav_menus, $sub_nav_menu);
    }
    
    public function errorMessage($e){
            $error = "An error occured. ".
                "Line Number: ".$e->getLine()." ".
                "File Name: ".$e->getFile()." ".
                "Error Description: ".$e->getMessage(); 
            return $error;
    }
  
}
