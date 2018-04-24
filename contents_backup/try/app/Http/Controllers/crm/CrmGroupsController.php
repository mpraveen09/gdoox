<?php

namespace Gdoox\Http\Controllers\crm;


use Gdoox\Http\Controllers\Controller;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Gdoox\Models\CrmFieldMaster;
use Gdoox\Models\CrmUsers;
use Gdoox\Models\DropdownOption;
use Gdoox\Models\DropdownOptions;
use Gdoox\Models\CrmDropdownOptions;
use Gdoox\Models\CrmGroups;
use Gdoox\Models\NavigationMenu;
use Route;


use Gdoox\User;
use Illuminate\Support\Facades\Auth;

use Form;
use Image;
use Input;
use UUID;

class CrmGroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(){
        try {
            if(Auth::user()){
                $userid = Auth::id();
                $limit = 25;
                list($route, $nav_menus, $sub_nav_menu) = $this->navigationTabs();
                $groups = CrmGroups::where('flag','=','1')->where('user_id','=', $userid)->paginate($limit);
                $form_fields = CrmFieldMaster::where('title','=','crm_groups')->where('lang','=','en')->first();
                return view('crm.crm_groups.index', compact('groups','form_fields', 'route', 'nav_menus', 'sub_nav_menu'));
            }
            else {
                return redirect('auth/login')->with('message',"Please Login!"); 
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }


    /**
     * Show the form for adding a new product.
     *
     * @return Response
     */    
    public function create(){
        try {
            if(Auth::user()) {
                 $createForm = array();   
                 list($route, $nav_menus, $sub_nav_menu) = $this->navigationTabs();
                 $form_data = CrmFieldMaster::where('title','=','crm_groups')->where('lang','=','en')->first();
                 foreach($form_data->form_fields as $data){
                     $options = $this->getOptions($data['name']);
                     $createForm[] = $this->createForm($data['label'], $data['name'], $data['type'], $data['maxlength'], $data['required'],'', $options);
                 }
                 return view('crm.crm_groups.create', compact('createForm','route','nav_menus','sub_nav_menu'));
            }
            else {
               return redirect('auth/login')->with('message',"Please Login to Add Account!"); 
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
         // return Redirect::route('crm_groups.index')->with('message','Oops! Something went Wrong. Please Try Again'); 
        }
    }    

    function createForm($lbl_name, $field_name='', $field_type='', $field_max_val='', $required='', $value='', $options='') {
        switch ($field_type) {

           case "hidden":
               $Fields = "<div class='item form-group'>"
                   . Form::$field_type($field_name, $value, ['id'=>$field_name,'class' => 'form-control col-md-7 col-xs-12','placeholder' =>$lbl_name ])
                   . "</div>";
           break;

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
                   . Form::select($field_name, $options, $value, ['id'=>$field_name,'class' => 'form-control col-md-7 col-xs-12', $required , 'placeholder' => $lbl_name])
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

           case "lable":
               $Fields = "<div class='item form-group'>"
                   . Form::label($lbl_name,'', ['class' => 'control-label col-md-2 col-sm-3 col-xs-12']) 
                   ."</div><hr>"; 
           break;

           default:
               $Fields='';
               break;
        }
        return $Fields;
    }

    public function getOptions($field){
      try {
            $groupadmin = array();
            if($field==='group_admin') {
                $group_admin = CrmUsers::where('user_id','=',Auth::id())->get();
                foreach ($group_admin as $value) {
                    $groupadmin[$value->_id] = $value->first_name.' '.$value->last_name;
                }
                $options = $groupadmin;
            }
            else {
                $options = '';
            }
            return $options;
      }
      catch (\Exception $e) {
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
      }
  }


  /*
   * Edit product
   */
    public function edit($id){
        try {
            if(Auth::user()){
                $createForm = array();
                $userdata = CrmGroups::where('_id','=',$id)->first();
                $form_data = CrmFieldMaster::where('title','=','crm_groups')->where('lang','=','en')->first();
                list($route, $nav_menus, $sub_nav_menu) = $this->navigationTabs();
                
                foreach($form_data->form_fields as $data){
                    if(!empty($userdata->$data['name'])){
                        $value = $userdata->$data['name'];
                    } 
                    else {
                        $value = "";
                    }

                    $options = $this->getOptions($data['name']);
                    $createForm[] = $this->createForm($data['label'], $data['name'], $data['type'], $data['maxlength'], $data['required'],$value, $options);
                }
                return view('crm.crm_groups.edit', compact('createForm','id','route','nav_menus','sub_nav_menu'));
            }
            else {
               return redirect('auth/login')->with('message',"Please Login to Add Group!");
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
            // return Redirect::route('crm_groups.index')->with('message','Oops! Something went Wrong. Please Try Again'); 
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
                $request = Request::all();
                $data = new CrmGroups();
                $data->user_id = Auth::id();
                $data->group_name = $request['group_name'];
                $data->group_admin = $request['group_admin'];
                $data->group_admin_name = $request['group_admin_name'];
                $data->description = $request['description'];
                $data->flag = '1';
                if(!empty($request['group_admin'])){
                    $users= CrmUsers::where('_id','=',$request['group_admin'])->first();
                    $users->role = 'groupadmin';
                    $users->save();
                }
                if($data->save()){
                    Session::flash('message', 'Group Added Successfully');
                    return Redirect::route('crm_groups.index');
                }
                else {
                    Session::flash('message', 'Group could not be Added! Please Try Again');
                    return Redirect::route('crm_groups.create')->with(Request::all());
                }
            }
            else {
                    return redirect('auth/login')->with('message',"Please Login to Add Group!"); 
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
            // return Redirect::route('crm_groups.create')->with('message','Oops! Something went Wrong. Please Try Again'); 
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
                 $form_fields = CrmFieldMaster::where('title','=','crm_groups')->first();
                 $userdata = CrmGroups::where('_id','=',$id)->first();
                 list($route, $nav_menus, $sub_nav_menu) = $this->navigationTabs();
                 return view('crm.crm_groups.show', compact('form_fields','userdata','route', 'nav_menus', 'sub_nav_menu'));
            }
            else {
               return redirect('auth/login')->with('message',"Please Login to View Group!"); 
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
            // return Redirect::route('crm_groups.index')->with('message','Oops! Something went Wrong. Please Try Again'); 
        }
    }
    /*
     * Update product
     */
    public function update($id){
        try{
            if(Auth::user()){
                $request = Request::all();
                $data = CrmGroups::where('_id','=',$id)->first();
                $user = CrmUsers::where('_id','=',$data->group_admin)->first();
                if(!empty($user)){
                    $user->role = '';
                    $user->save();
                }
                
                $data->group_name = $request['group_name'];
                $data->group_admin = $request['group_admin'];
                $data->group_admin_name = $request['group_admin_name'];
                $data->description = $request['description']; 

                $users = CrmUsers::where('_id','=',$request['group_admin'])->first();
                $users->role = 'groupadmin';
                $users->save();

                if($data->save()){
                    Session::flash('message', 'Group Updated Successfully');
                    return Redirect::route('crm_groups.index');
                }
                else {
                    Session::flash('message', 'Group could not be Created! Please Try Again');
                    return Redirect::route('crm_groups.edit',$id)->with(Request::all());
                }
            }
            else {
                    return redirect('auth/login')->with('message',"Please Login to Create Group!"); 
            }
        }
        catch(\Exception $e) {
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
            // Session::flash('message', "Oops! Something went Wrong. Please try Again");
            // return Redirect::back();
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
