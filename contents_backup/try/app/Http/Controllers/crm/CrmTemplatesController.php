<?php

namespace Gdoox\Http\Controllers\crm;

use Gdoox\Http\Controllers\Controller;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Gdoox\Models\CrmFieldMaster;
use Gdoox\Models\CrmUsers;
use Gdoox\Models\DropdownOption;
use Gdoox\Models\DropdownOptions;
use Gdoox\Models\CrmDropdownOptions;
use Gdoox\Models\CrmGroups;
use Gdoox\Models\CrmContacts;
use Gdoox\Models\CrmEmails;
use Gdoox\Models\CrmTemplates;
use Gdoox\Models\NavigationMenu;
use Route;

use Gdoox\User;


use Form;
use Image;
use Input;
use UUID;

class CrmTemplatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(){
        try {
            if(Auth::user()){
                $limit = 25;
                $userid = Auth::id();
                list($route, $nav_menus, $sub_nav_menu) = $this->navigationTabs();
                $templates = CrmTemplates::where('user_id','=', $userid)->paginate($limit);
                $form_fields = CrmFieldMaster::where('title','=','crm_templates')->where('lang','=','en')->first();
                return view('crm.crm_templates.index', compact('templates','form_fields','route','nav_menus','sub_nav_menu'));
            }
            else {
                return redirect('auth/login')->with('message',"Please Login to View Templates!"); 
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
        try{
            if(Auth::user())
            {
                $userid = Auth::id();
                $assignedto = array();
                $variablename = array();
                $variablevalue = array();
                
                list($route, $nav_menus, $sub_nav_menu) = $this->navigationTabs();
                $template_type = CrmDropdownOptions::where('name','=','crm_template_type')->first();
                foreach($template_type->options as $options) {
                    $type[$options] = $options;
                }
                
                $assigned_to= CrmUsers::where('user_id', '=', $userid)->project(array('first_name','last_name'))->get();          
                foreach($assigned_to as $assigned) {
                   $assignedto[$assigned->first_name.' '.$assigned->last_name] = $assigned->first_name.' '.$assigned->last_name;
                }

                $variable_cat = CrmDropdownOptions::where('name','=','variable_category')->first();
                foreach($variable_cat->options as $assigned) {
                   $variablecat[$assigned] = $assigned;
                }

               $form_fields = CrmFieldMaster::where('title','=','crm_templates')->where('lang','=','en')->first();

               return view('crm.crm_templates.create', compact('form_fields','type','assignedto','variablecat','variablename','variablevalue','route','nav_menus','sub_nav_menu'));
            }
            else {
               return redirect('auth/login')->with('message',"Please Login to Create Template!"); 
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
            // return Redirect::route('crm_templates.index')->with('message','Oops! Something went Wrong. Please Try Again'); 
        }
    }
    
    public function variableCatValues(){
        try{
            if(Request::ajax()) {
                $input = Request::all();
                $variable_values = CrmDropdownOptions::where('type','=',$input['variable_cat'])->where('name','=','variable_category_values')->first();

                $i = 0;
                $response = array();
                foreach ($variable_values->options as $key=>$value) {
                    $response[$i]['key'] = $key;
                    $response[$i]['value'] = $value;
                    $i++;
                }

                echo json_encode($response);
            }
        }
        catch(\Exception $e){
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
                $userid = Auth::id();
                $variablename = array();
                $variablevalue = array();
                list($route, $nav_menus, $sub_nav_menu) = $this->navigationTabs();
                $templates = CrmTemplates::where('_id','=',$id)->first();
                $form_fields = CrmFieldMaster::where('title','=','crm_templates')->where('lang','=','en')->first();

                $template_type = CrmDropdownOptions::where('name','=','crm_template_type')->first();
                foreach($template_type->options as $options) {
                    $type[$options] = $options;
                }

                $assigned_to = CrmUsers::where('user_id', '=', $userid)->project(array('first_name','last_name'))->get(); 
                foreach($assigned_to as $assigned) {
                   $assignedto[$assigned->first_name.' '.$assigned->last_name] = $assigned->first_name.' '.$assigned->last_name;
                }

                $variable_cat = CrmDropdownOptions::where('name','=','variable_category')->first();
                foreach($variable_cat->options as $assigned) {
                   $variablecat[$assigned] = $assigned;
                }
                return view('crm.crm_templates.edit', compact('templates','id','form_fields','type','assignedto','variablecat','variablename','variablevalue','route', 'nav_menus', 'sub_nav_menu'));
            }
            else{
               return redirect('auth/login')->with('message',"Please Login to Add Group!");
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
          // return Redirect::route('crm_templates.index')->with('message','Oops! Something went Wrong. Please Try Again'); 
        }
    }    
    
  

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(){
        try {
            if(Auth::user()){
                $userid = Auth::id(); 
                $request = Request::all();
                $data = new CrmTemplates();

                $data->user_id = $userid;
                $data->template_name = $request['template_name'];
                $data->type = $request['type'];
                $data->assigned_to = $request['assigned_to'];
                $data->description = $request['description'];
                $data->subject = $request['subject'];
                $data->body = $request['body'];
                $data->files = $request['files'];

                if($data->save()){
                    Session::flash('message', 'Template Created Successfully');
                    return Redirect::route('crm_templates.create');
                }
                else{
                    Session::flash('message', 'Template Could not be created! Please Try Again');
                    return Redirect::route('crm_templates.create')->with(Request::all());
                }
            }
            else {
                return redirect('auth/login')->with('message',"Please Login to Create Email!"); 
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id){
        try{
            if(Auth::user()){
                list($route, $nav_menus, $sub_nav_menu) = $this->navigationTabs();
                $form_fields = CrmFieldMaster::where('title','=','crm_emails')->where('lang','=','en')->first();
                $userdata = CrmEmails::where('_id','=',$id)->first();
                return view('crm.crm_emails.show', compact('form_fields','userdata','route','nav_menus','sub_nav_menu'));
            }
            else {
               return redirect('auth/login')->with('message',"Please Login to View Group!"); 
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
          // return Redirect::route('crm_emails.index')->with('message','Oops! Something went Wrong. Please Try Again'); 
        }
    }
    
/*
 * Update product
 */
  public function update($id){
      try {
        if(Auth::user()) {
            $request = Request::all();
            $data = CrmTemplates::where('_id','=',$id)->first();         
            
            $data->template_name = $request['template_name'];
            $data->type = $request['type'];
            $data->assigned_to = $request['assigned_to'];
            $data->description = $request['description'];
            $data->subject = $request['subject'];
            $data->body = $request['body'];
            $data->files = $request['files'];

            if($data->save()){
                Session::flash('message', 'Template Updated Successfully');
                return Redirect::route('crm_templates.index');
            }
            else {
                Session::flash('message', 'Template Could Not be Updated! Please Try Again');
                return Redirect::route('crm_templates.edit',$id)->with(Request::all());
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
  
  public function searchEmailId() {
      try {
        if(Request::ajax()) {
            $input = Request::all();
            $emails = CrmContacts::where('email_address', 'like', '%'.$input['term'].'%')->orWhere('first_name','like','%'.$input['term'].'%')->project( array('email_address','first_name','last_name'))->get();
            $i = 0;
            $response = array();
            foreach($emails as $mail){
              $response[$i]['name'] = $mail['email_address']." (".$mail['first_name'].' '.$mail['last_name'].")";
              $response[$i]['email'] = $mail['email_address'];
              $i++;
            }
            echo json_encode($response);
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
