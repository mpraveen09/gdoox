<?php

namespace Gdoox\Http\Controllers\crm;

use Gdoox\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Gdoox\Models\CrmFieldMaster;
use Gdoox\Models\CrmTasks;
use Gdoox\Models\DropdownOption;
use Gdoox\Models\CrmDropdownOptions;
use Gdoox\Models\CrmUsers;
use Gdoox\Models\NavigationMenu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Gdoox\User;
use Gdoox\UserRole;
use Gdoox\Role;
use Form;
use Image;
use Input;
use UUID;

class CrmTasksController extends Controller {
    use  \Gdoox\Helpers\backend\dashboard\RolesUsers;
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(){
        try {
            if(Auth::user()){
                $limit = 25;
                $assigned = array();
                $subject_val = $assigned_val = $priority_val = $status_val = $frm_date_val = $to_date_val = '';
                
                list($route, $nav_menus) = $this->navigationTabs();
                
                $role_id = UserRole::where('user_id','=',Auth::user()->id)->project(array('role_id'))->first();  
                $role = Role::where('_id','=',$role_id->role_id)->first();            
                $form_fields = CrmFieldMaster::where('title','=','crm_tasks')->where('lang','=','en')->first();

                if($role->name==='superadmin' || $role->name==='admin') {
                    $tasks = CrmTasks::where('flag','=','1')->paginate($limit);
                }
                else {
                    $tasks = CrmTasks::where('flag','=','1')->where('assigned_to','=', Auth::user()->id)->paginate($limit);
                }

                // Fields for the Search From       

                $task_priority = CrmDropdownOptions::where('name','=','task_priority')->where('lang', 'en')->first();
                foreach($task_priority->options as $value) {
                    $priority[$value] = $value;
                }

                $users = CrmUsers::where('user_id','=',Auth::user()->id)->get();
                foreach ($users as $value) {
                    $assigned[$value->_id] = $value->first_name.' '.$value->last_name;
                }

                $task_status = CrmDropdownOptions::where('name','=','task_status')->where('lang', 'en')->first();
                foreach($task_status->options as $value) {
                    $status[$value] = $value;
                }
                
                return view('crm.crm_tasks.index', compact('users','assigned','task_priority','priority','status','tasks','form_fields','subject_val','assigned_val','priority_val','status_val','frm_date_val','to_date_val','route','nav_menus')); 
            }
            else {
                return redirect('auth/login')->with('message',"Please Login!");
            } 
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
            // Session::flash('message', "Oops! Something went Wrong. Please try Again");
            // return Redirect::back();
        }
    }
    
    public function searchTask(){
        try {
            if(Auth::user()) {
                $data = Request::all();
                $limit = 25;
                $assigned = array();
                list($route, $nav_menus) = $this->navigationTabs();
                $form_fields = CrmFieldMaster::where('title','=','crm_tasks')->where('lang','=','en')->first();
                
                $subject_val = $assigned_val = $priority_val = $status_val = $frm_date_val = $to_date_val = '';
                
                $task_priority = CrmDropdownOptions::where('name','=','task_priority')->where('lang', 'en')->first();
                foreach($task_priority->options as $value) {
                    $priority[$value] = $value;
                }

                $users = CrmUsers::where('user_id','=',Auth::user()->id)->get();
                foreach ($users as $value) {
                    $assigned[$value->_id] = $value->first_name.' '.$value->last_name;
                }

                $task_status = CrmDropdownOptions::where('name','=','task_status')->where('lang', 'en')->first();
                foreach($task_status->options as $value) {
                    $status[$value] = $value;
                }

            // Query Builder for Search Filter for Tasks

               $builder = CrmTasks::query();

                if(!empty($data['subject'])){
                     $subject_val = $data['subject'];
                     $builder->where('subject','like', '%'.$subject_val.'%');
                }

                if(!empty($data['assigned'])){
                     $assigned_val = $data['assigned'];
                     $builder->where('assigned_to','=', $assigned_val);
                }

                if(!empty($data['priority'])){
                     $priority_val = $data['priority'];
                     $builder->where('priority','=', $priority_val);
                }

                if(!empty($data['status'])){
                     $status_val = $data['status'];
                     $builder->where('status','=', $status_val);
                }

                if(!empty($term['from_date'])){
                    $frm_date_val = $term['from_date'];
                    $from_date = date('Y-m-d',strtotime($term['from_date']));
                    if(empty($term['to_date'])){
                        $to_date = date('Y-m-d');
                    }
                 }

                if(!empty($term['to_date'])){
                    $to_date_val = $term['to_date'];
                    $to_date = date('Y-m-d',strtotime($term['to_date']));
                    if(empty($term['from_date'])){
                         $from_date = date('Y-m-d');
                     }
                }

                if(!empty($from_date) && !empty($to_date)){
                    $builder->where('start_date','>',$from_date)->where('due_date','<',$to_date);
                }

                $tasks = $builder->orderBy('_id')->paginate($limit);

                return view('crm.crm_tasks.index', compact('users','assigned','task_priority','priority','status','tasks','form_fields','subject_val','assigned_val','priority_val','status_val','frm_date_val','to_date_val','route', 'nav_menus', 'sub_nav_menu'));

            }
            else {
               return redirect('auth/login')->with('message',"Please Login to Search Task!"); 
            }
        }
        catch(\Exception $e){
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
            if(Auth::user()) {
                $createForm = array();
                $priority = array();
                $status = array();
                $assigned = array();
                $action = array();
                
                list($route, $nav_menus) = $this->navigationTabs();
                
                $task_priority = CrmDropdownOptions::where('name','=','task_priority')->where('lang', 'en')->first();
                foreach($task_priority->options as $value) {
                    $priority[$value] = $value;
                }

                $task_status = CrmDropdownOptions::where('name','=','task_status')->where('lang', 'en')->first();
                foreach($task_status->options as $value) {
                    $status[$value] = $value;
                }

                $assinged_to = CrmUsers::where('user_id','=',Auth::user()->id)->get();               
                foreach ($assinged_to as $value) {
                    $assigned[$value->_id] = $value->first_name.' '.$value->last_name;
                }
                
                $actions = CrmDropdownOptions::where('name','=','task_actions')->where('lang','=','en')->first(); 
                foreach($actions->options as $value){
                    $action[$value] = $value;
                }

//                    $actions = CrmDropdownOptions::where('name','=','action_towards')->where('lang','=','en')->first();
//                    foreach($actions->options as $value){
//                        $actiont[$value] = $value;
//                    }
                
//                 foreach($form_data->form_fields as $data) {
//                     $options = $this->getOptions($data['name']);
//                     $createForm[] = $this->createForm($data['label'], $data['name'], $data['type'], $data['maxlength'], $data['required'],'', $options);
//                 }

                 return view('crm.crm_tasks.create', compact('createForm','priority','status','assigned','action','route', 'nav_menus', 'sub_nav_menu'));
            }
            else {
               return redirect('auth/login')->with('message',"Please Login to Create Task!"); 
            }
        }
        catch(\Exception $e){
           $errors = $this->errorMessage($e);
           return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }    

    function createForm($lbl_name, $field_name='', $field_type='', $field_max_val='', $required='', $value='', $options) {      
        switch ($field_type) {
           case "hidden":
               $Fields = "<div class='item form-group'>"
                   . Form::$field_type($field_name, '', ['id'=>$field_name,'class' => 'form-control col-md-7 col-xs-12'])
                   ."</div>";
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
                   . Form::select($field_name, $options, $value, ['id'=>$field_name,'class' => 'form-control col-md-7 col-xs-12', 'required', 'placeholder' => $lbl_name])
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
        $assinged = array();
        $options = '';
        if($field==='priority') {
            $task_priority = CrmDropdownOptions::where('name','=','task_priority')->where('lang', 'en')->first();
            foreach($task_priority->options as $value) {
                $priority[$value] = $value;
            }
            $options = $priority;
        }
        
        elseif($field==='status') {
            $task_status = CrmDropdownOptions::where('name','=','task_status')->where('lang', 'en')->first();
            foreach($task_status->options as $value) {
                $status[$value] = $value;
            }
            $options = $status;
        }
        elseif($field==='assigned_to') {
            $assinged_to = CrmUsers::where('user_id','=',Auth::user()->id)->get();               
            foreach ($assinged_to as $value) {
                $assinged[$value->_id] = $value->first_name.' '.$value->last_name;
            }
            $options = $assinged;
        }
        elseif($field==='action') {
            $actions = CrmDropdownOptions::where('name','=','task_actions')->where('lang','=','en')->first(); 
            foreach($actions->options as $value){
                $action[$value] = $value;
            }
            $options = $action;
        }
        elseif($field==='action_towards'){
            $actions = CrmDropdownOptions::where('name','=','action_towards')->where('lang','=','en')->first();
            foreach($actions->options as $value){
                $actiont[$value] = $value;
            }
            $options = $actiont;
        }
        
        return $options;
    }
  /*
   * Edit product
   */
    public function edit($id){
        try{
            if(Auth::user()){
                list($route, $nav_menus) = $this->navigationTabs();
                $form_data = CrmFieldMaster::where('title','=','crm_tasks')->first();
                $userdata = CrmTasks::where('_id','=',$id)->first();
                $role_id = UserRole::where('user_id','=',Auth::user()->id)->project(array('role_id'))->first();
                $role = Role::where('_id','=',$role_id->role_id)->first();

                foreach($form_data->form_fields as $data){
                   if(!empty($userdata->$data['name'])){
                       $value = $userdata->$data['name'];
                   }
                   else{
                       $value = "";
                   }

                   if($role->name==='admin' || $role->name==='superadmin'){
                       $options = $this->getOptions($data['name']);
                       $createForm[] = $this->createForm($data['label'], $data['name'], $data['type'], 
                               $data['maxlength'], $data['required'], $value, $options);
                   }
                   else {
                       if($data['name']!=='assigned_to'){
                            $options = $this->getOptions($data['name']);
                            $createForm[] = $this->createForm($data['label'], $data['name'], $data['type'], 
                                $data['maxlength'], $data['required'], $value, $options);
                       }
                   } 
                }
                return view('crm.crm_tasks.edit', compact('createForm','id','route', 'nav_menus', 'sub_nav_menu'));
            }
            else {
               return redirect('auth/login')->with('message',"Please Login to Create Task!"); 
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
            // Session::flash('message', "Oops! Something went Wrong. Please try Again");
            // return Redirect::back();
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
                $data = new CrmTasks();
                $data->user_id = Auth::user()->id;
                $data->subject = $request['subject'];
                $data->start_date = $request['start_date'];
                $data->due_date = $request['due_date'];
                $data->priority = $request['priority'];
                $data->status = $request['status'];
                $data->action = $request['action'];
                $data->assigned_by = Auth::user()->id;
                $data->assigned_to = $request['assigned_to'];
                $data->assigned_to_name = $request['assigned_to_name'];
                $data->description = $request['description'];
                $data->flag = '1';

                if($data->save()){
                    Session::flash('message', 'Task Created Successfully');
                    return Redirect::route('tasks.index');
                }
                else{
                    Session::flash('message', 'Task could not be Created! Please Try Again');
                    return Redirect::route('tasks.index')->with(Request::all());
                }
            }
            else {
                    return redirect('auth/login')->with('message',"Please Login to Create Task!"); 
            }
        }
        catch(\Exception $e){
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
                 list($route, $nav_menus) = $this->navigationTabs();
                 $form_fields = CrmFieldMaster::where('title','=','crm_tasks')->first();
                 $userdata = CrmTasks::where('_id','=',$id)->first();
                 return view('crm.crm_tasks.show', compact('form_fields','userdata','route', 'nav_menus', 'sub_nav_menu'));
            }
            else {
               return redirect('auth/login')->with('message',"Please Login to Create Task!"); 
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
           // Session::flash('message', "Oops! Something went Wrong. Please try Again");
           // return Redirect::back();
        }
    }
    



/*
 * Update product
 */
  public function update($id){
      try{
        if(Auth::user()){
            $request = Request::all();
            $data = CrmTasks::where('_id','=',$id)->first();

            $data->subject = $request['subject'];
            $data->start_date = $request['start_date'];
            $data->due_date = $request['due_date'];
            $data->priority = $request['priority'];
            $data->status = $request['status'];
            $data->related_to = $request['related_to'];
            $data->assigned_by = Auth::user()->id;
            $data->assigned_to = $request['assigned_to'];
            $data->assigned_to_name = $request['assigned_to_name'];
            $data->description = $request['description'];

            if($data->save()) {
                Session::flash('message', 'Task Updated Successfully');
                return Redirect::route('tasks.index');
            }
            else { 
                Session::flash('message', 'Task could not be Created! Please Try Again');
                return Redirect::route('tasks.edit',$id)->with(Request::all());
            }
        }
        else {
                return redirect('auth/login')->with('message',"Please Login to Create Task!"); 
        }
      }
      catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
          // Session::flash('message', "Oops! Something went Wrong. Please try Again");
          // return Redirect::back();
        }
    }
    
    public function errorMessage($e){
            $error = "An error occured. ".
                "Line Number: ".$e->getLine()." ".
                "File Name: ".$e->getFile()." ".
                "Error Description: ".$e->getMessage(); 
            return $error;
    }
    
    public function navigationTabs(){
        
        $role = $this->getRoleName(Auth::user()->id);
        $nav_menus = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'CRM')->where('lang','en')->get();
        $route = Route::getCurrentRoute()->getName();
        
        return array($route, $nav_menus);
    }
}
