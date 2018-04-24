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
use Gdoox\Models\CrmContactsGroup;
use Gdoox\Models\CrmContacts;
use Gdoox\Models\NavigationMenu;
use Route;

use Gdoox\User;
use Illuminate\Support\Facades\Auth;

use Form;
use Image;
use Input;
use UUID;

class CrmContactsGroupController extends Controller {
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
                $userid = Auth::id();
                
                list($route, $nav_menus) = $this->navigationTabs();
                $groups = CrmContactsGroup::where('flag','=','1')->where('user_id','=', $userid)->paginate($limit);
                $form_fields = CrmFieldMaster::where('title','=','crm_groups')->where('lang','=','en')->first();
                return view('crm.crm_contact_groups.index', compact('groups','form_fields','route', 'nav_menus', 'sub_nav_menu'));
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
    
    
    /**
     * Show the form for adding a new product.
     *
     * @return Response
     */    
    public function create(){
        try {
            if(Auth::user()){
                list($route, $nav_menus) = $this->navigationTabs();
                $form_data = CrmFieldMaster::where('title','=','crm_contact_groups')->where('lang','=','en')->first();
                foreach($form_data->form_fields as $data){
                    $createForm[] = $this->createForm($data['label'], $data['name'], $data['type'], $data['maxlength'], $data['required'],'', '');
                }
                return view('crm.crm_contact_groups.create', compact('createForm','route', 'nav_menus', 'sub_nav_menu'));
            }
            else {
               return redirect('auth/login')->with('message',"Please Login to Add Account!"); 
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
            // return Redirect::route('crm_contactsgroup.index')->with('message','Oops! Something went Wrong. Please Try Again'); 
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
           return $Fields;
           break;

           case "select":
               $Fields = "<div class='item form-group'>"
                   . Form::label($lbl_name,'', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) 
                   ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                   . Form::select($field_name, $options, $value, ['class' => 'form-control col-md-7 col-xs-12', 'required', 'placeholder' => $lbl_name])
                   . "</div>
                </div>";
               return $Fields;
           break;

           case "date":
               $Fields = "<div class='item form-group'>"
                   . Form::label($lbl_name,'', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) 
                   ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                   . Form::$field_type($field_name, $value ,['class' => 'form-control col-md-7 col-xs-12','placeholder' =>$lbl_name ])
                   . "</div>
                    </div>";
               return $Fields;
           break;

           case "textarea":
               $Fields = "<div class='item form-group'>"
                   . Form::label($lbl_name,'', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) 
                   ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                   . Form::$field_type($field_name, $value ,['class' => 'form-control col-md-7 col-xs-12','placeholder' =>$lbl_name ])
                   . "</div>
                    </div>";
               return $Fields;
           break;

           case "lable":
               $Fields = "<div class='item form-group'>"
                   . Form::label($lbl_name,'', ['class' => 'control-label col-md-2 col-sm-3 col-xs-12']) 
                   ."</div><hr>";
               return $Fields;
           break;

           default:
               $Fields='';
               return $Fields;
               break;
        }
  }

    
  /*
   * Edit product
   */
    public function edit($id){
        try {
            if(Auth::user()){
                $createForm = array();
                list($route, $nav_menus) = $this->navigationTabs();
                $userdata = CrmContactsGroup::where('_id','=',$id)->first();
                $form_data = CrmFieldMaster::where('title','=','crm_contact_groups')->where('lang','=','en')->first();

                foreach($form_data->form_fields as $data){
                    if(!empty($userdata->$data['name'])){
                        $value=$userdata->$data['name'];
                    } else {
                        $value="";
                    }

                    $createForm[] = $this->createForm($data['label'], $data['name'], $data['type'], $data['maxlength'], $data['required'],$value, '');
                 }

                 return view('crm.crm_contact_groups.edit', compact('createForm','id','route', 'nav_menus', 'sub_nav_menu'));
            }
            else {
               return redirect('auth/login')->with('message',"Please Login to Add Contact Group!");
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
            // return Redirect::route('crm_contactsgroup.index')->with('message','Oops! Something went Wrong. Please Try Again'); 
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
                $request = Request::all();
                $data = new CrmContactsGroup();
                $data->user_id = Auth::id();
                $data->group_name = $request['group_name'];
                $data->description = $request['description'];                
                $data->flag = '1';

                if($data->save()){
                    Session::flash('message', 'Contact Group Added Successfully');
                    return Redirect::route('crm_contactsgroup.index');
                }
                else {
                    Session::flash('message', 'Contact Group could not be Added! Please Try Again');
                    return Redirect::route('crm_contactsgroup.create')->with(Request::all());
                }
            }
            else {
                    return redirect('auth/login')->with('message',"Please Login to Add Contact Group!"); 
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
            // return Redirect::route('crm_contactsgroup.create')->with('message','Oops! Something went Wrong. Please Try Again'); 
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
            if(Auth::user()) {
                list($route, $nav_menus) = $this->navigationTabs();
                 $form_fields = CrmFieldMaster::where('title','=','crm_groups')->first();
                 $userdata = CrmContactsGroup::where('_id','=',$id)->first();
                 return view('crm.crm_contact_groups.show', compact('form_fields','userdata','route', 'nav_menus', 'sub_nav_menu'));
            }
            else {
               return redirect('auth/login')->with('message',"Please Login to View Contact Group!"); 
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
            // return Redirect::route('crm_contactsgroup.index')->with('message','Oops! Something went Wrong. Please Try Again'); 
        }
    }

/*
 * Update product
 */
  public function update($id){
      try{
        if(Auth::user()){
            $request = Request::all();
            $data = CrmContactsGroup::where('_id','=',$id)->first();

            $data->group_name = $request['group_name'];
            $data->description = $request['description'];

            if($data->save()) {
                Session::flash('message', 'Contact Group Updated Successfully');
                return Redirect::route('crm_contactsgroup.index');
            }
            else {
                Session::flash('message', 'Contact Group could not be Created! Please Try Again');
                return Redirect::route('crm_contactsgroup.edit',$id)->with(Request::all());
            }
        }
        else {
                return redirect('auth/login')->with('message',"Please Login to Create Contact Group!"); 
        }
      }
      catch(Exception $e){
          $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
          // return Redirect::route('crm_contactsgroup.index')->with('message','Oops! Something went Wrong. Please Try Again'); 
      }
  }
  
  public function viewGroupContacts(){
      try {
            if(Auth::user()) {
                  $data = Request::all();
                  list($route, $nav_menus) = $this->navigationTabs();
                  $group_contacts = CrmContacts::where('user_id','=',Auth::id())->where('contact_group_name','=',$data['group'])->get();
                  $form_fields = CrmFieldMaster::where('title','=','crm_groups')->where('lang','=','en')->first();
                  return view('crm.crm_contact_groups.group_contacts', compact('group_contacts','form_fields','userdata','route', 'nav_menus', 'sub_nav_menu'));
            }
            else {
                    return redirect('auth/login')->with('message',"Please Login to View Group Contacts!"); 
            }
      }
      catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
         // Session::flash('message', "Oops! Something went Wrong. Please try Again");
         // return Redirect::back();
      }
  }
  
  public function navigationTabs(){
        $role = $this->getRoleName(Auth::user()->id);
        $nav_menus = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'CRM')->where('lang','en')->get();
        $route = Route::getCurrentRoute()->getName();
        
        return array($route, $nav_menus);
    }
    
  public function errorMessage($e){
        $error = "An error occured. ".
            "Line Number: ".$e->getLine()." ".
            "File Name: ".$e->getFile()." ".
            "Error Description: ".$e->getMessage(); 
        return $error;
    }
  
}
