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
use Gdoox\Models\CrmEmails;
use Illuminate\Support\Facades\Mail;
use Gdoox\Models\CrmTemplates;
use Illuminate\Support\Facades\Auth;
use Gdoox\Models\NavigationMenu;
use Route;
use Gdoox\User;
use Form;
use Image;
use Input;
use UUID;

class CrmEmailsController extends Controller {
    use  \Gdoox\Helpers\backend\dashboard\RolesUsers;
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(){
        try {
            if(Auth::user()) {
                $limit = 25;
                $userid = Auth::user()->id;
                list($route, $nav_menus) = $this->navigationTabs();
                $sent_emails = CrmEmails::where('user_id','=', $userid)->where('type','=','mail')->paginate($limit);
                $form_fields = CrmFieldMaster::where('title','=','crm_emails')->where('lang','=','en')->first();
                   return view('crm.crm_emails.index', compact('sent_emails','form_fields','route','nav_menus','sub_nav_menu'));
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
    
    public function viewEmailDrafts(){
        try {
            if(Auth::user()) {
                $limit = 25;
                $userid = Auth::user()->id;
                list($route, $nav_menus) = $this->navigationTabs();
                $sent_emails = CrmEmails::where('user_id','=', $userid)->where('type','=','draft')->paginate($limit);
                $form_fields = CrmFieldMaster::where('title','=','crm_emails')->where('lang','=','en')->first();
                return view('crm.crm_emails.drafts', compact('sent_emails','form_fields','route', 'nav_menus', 'sub_nav_menu'));
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
                $user_id = Auth::user()->id;
                $template = array();
                $variablename = array();
                $variablevalue = array();
                $groups = array();
                list($route, $nav_menus) = $this->navigationTabs();
                
                $personal_info = User::where('_id','=',$user_id)->first();
                $form_fields = CrmFieldMaster::where('title','=','crm_emails')->where('lang','=','en')->first();
                $user_emails = CrmContacts::where('user_id','=',$user_id)->project(array('email_address','first_name','last_name'))->get();         
                $user_templates = CrmTemplates::where('user_id','=',$user_id)->get();
                $variable_cat = CrmDropdownOptions::where('name','=','variable_category')->first();
                
                $usergroups = CrmContactsGroup::where('user_id','=',Auth::user()->id)->get();
                foreach ($usergroups as $group){
                    $groups[] = $group->group_name;
                }
                
                foreach($user_templates as $templates) {
                    $template[$templates->template_name] = $templates->template_name;
                }

                foreach($variable_cat->options as $assigned) {
                   $variablecat[$assigned] = $assigned;
                }

                return view('crm.crm_emails.create', compact('form_fields','user_emails','template','variablecat','variablename','variablevalue','personal_info','groups','route', 'nav_menus', 'sub_nav_menu'));
            }
            else {
               return redirect('auth/login')->with('message',"Please Login to Add Account!"); 
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
            // return Redirect::route('crm_emails.index')->with('message','Oops! Something went Wrong. Please Try Again'); 
        }
    }
    
    public function variableCatValues() {
        try {
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
        } catch (\Exception $e) {
              return Response::json ( array (
                  'error' => true,
                  'data' => $e
             ), 200 );
        }
    }
    
//    public function variableCatValues(){
//        if(Request::ajax()) {
//            $input = Request::all();
//            $variable_values = CrmDropdownOptions::where('type','=',$input['variable_cat'])->where('name','=','variable_category_values')->first();
//            
//            $i = 0;
//            $response = array();
//            foreach ($variable_values->options as $key=>$value) {
//                $response[$i]['key'] = $key;
//                $response[$i]['value'] = $value;
//                $i++;
//            }
//            
//            echo json_encode($response);
//        }
//    }

    
  /*
   * Edit product
   */
    public function edit($id) {
        try {
            if(Auth::user()){  
                $variablename = array();
                $variablevalue = array();
                list($route, $nav_menus) = $this->navigationTabs();
                
                $form_fields = CrmFieldMaster::where('title','=','crm_emails')->where('lang','=','en')->first();
                $user_templates = CrmTemplates::where('user_id','=',Auth::user()->id)->get();
                $userdata = CrmEmails::where('_id','=',$id)->first();

                $variable_cat = CrmDropdownOptions::where('name','=','variable_category')->first();

                $usergroups = CrmContactsGroup::where('user_id','=',Auth::user()->id)->get();
                foreach ($usergroups as $group){
                    $groups[] = $group->group_name;
                }
                
                foreach($user_templates as $templates) {
                    $template[$templates->template_name] = $templates->template_name;
                }

                foreach($variable_cat->options as $assigned) {
                   $variablecat[$assigned] = $assigned;
                }

                return view('crm.crm_emails.edit', compact('form_fields','id','userdata','template','variablecat','variablename','variablevalue','personal_info','groups','route','nav_menus','sub_nav_menu'));
            }
            else {
               return redirect('auth/login')->with('message',"Please Login to Edit Draft!");
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
            // return Redirect::route('crm_emails.index')->with('message','Oops! Something went Wrong. Please Try Again'); 
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
            $request = Request::all();
            $match = array();
            $to = array();
            $cc = array();
            $bcc = array();
            
            $data = new CrmEmails();
            if(Auth::user()){
                if($request['send_to']==='contacts'){
                    if(strpos($request['to'],",")){
                        $to_email = explode(",",$request['to']);
                        $length_to = sizeof($to_email);
                        for($i=0; $i < $length_to-1; $i++){
                            if(!empty($to_email)){
                                $to[] = $to_email[$i];
                            }
                        }
                        $data->group = '';
                    }
                    else {
                        $to[] = trim($request['to']);
                    }
                }
                else {
                    $groupname = $request['to_group'];
                    $data->group = $request['to_group'];
                    $contactgroups = CrmContacts::where('contact_group_name','=',$groupname)->get();
                    
                    if(empty($contactgroups)){
                       return redirect()->back()->withErrors('The Contact group dont have any contacts. Please add contacts to the group and try Again.');
                    }
                    
                    foreach($contactgroups as $groups){
                        if(!empty($groups->email_address)){
                            $to[] = $groups->email_address;
                        }
                    }
                }

                if(strpos($request['add_cc'],",")){
                    $to_cc = explode(",",$request['add_cc']);
                    $length_cc = sizeof($to_cc);
                    for($i=0; $i < $length_cc-1; $i++){
                        $cc[] =  trim($to_cc[$i]);
                    }
                }
                else {
                    if(!empty(trim($request['add_cc']))){
                        $cc[] = trim($request['add_cc']);
                    }
                }

                if(strpos($request['add_bcc'],",")){
                    $to_bcc = explode(",",$request['add_bcc']);
                    $length_bcc = sizeof($to_cc);
                    for($i=0; $i < $length_bcc-1; $i++){
                        $bcc[] =  trim($to_bcc[$i]);
                    }
                }
                else {
                    if(!empty(trim($request['add_bcc']))){
                        $bcc[] = trim($request['add_bcc']);
                    }
                }

               // Getting the inserted variables in array from the Email Content
                
                
                $var1 = str_replace("[","",$request['content']);
                $var2 = str_replace("]","",$var1);
                $template = $var2;            
                preg_match_all('~\[(.*?)]~s', $request['content'], $match);
                
                $data->user_id = Auth::user()->id;
                $data->from = $request['from'];
                if(array_key_exists('template', $request)){
                    $data->template = $request['template'];
                }
                else {
                    $data->template = '';
                }
                

                if($request['status']==='draft'){
                    $data->cc = $request['add_cc'];
                    $data->bcc = $request['add_bcc'];
                    $data->to_email = $request['to'];
                    $data->type = 'draft';

                    if($data->save()) {
                        Session::flash('message', 'Saved as Draft!');
                        return Redirect::route('crm_emails.drafts');
                    }
                    else {
                        Session::flash('message', 'Email Could not be saved as Draft! Please Try Again');
                        return Redirect::route('crm_emails.create')->with(Request::all());
                    }   
                }
                else {
                    $data->cc = $cc;
                    $data->bcc = $bcc;
                    $data->to_email = $to;
                    $data->type = 'mail';
                    
                    foreach($to as $key=>$val){
                        if(!empty($match[1])){
                            $contacts = CrmContacts::where('email_address','=',trim($val))->project(array('first_name','last_name','mobile','office_phone'))->first();
                            foreach($match[1] as $key=>$val) {
                                    $temp_var = str_replace('$','',$val);
                                    $data = $contacts->$temp_var;
                                    $final_val = str_replace($val, $data, $template);
                            }
                        }
                        else {
                            $final_val = $request['content'];
                        }
                        
                        $data->content = $final_val;

                        if($data->save()){
                            if(!empty($bcc) && !empty($cc)){
                                Mail::raw($final_val, function($message) use ($data,$bcc, $cc){
                                    $message->from(Auth::user()->email, Auth::user()->username);
                                    $message->bcc($bcc,Auth::user()->username);
                                    $message->cc($cc,Auth::user()->username);
                                    $message->to($data->to_email,$data->to_email)->subject('Gdoox CRM');
                             });
                            }
                            elseif(!empty($cc) && empty($bcc)){
                                Mail::raw($final_val, function($message) use ($data,$cc){
                                    $message->from(Auth::user()->email, Auth::user()->username);
                                    $message->cc($cc,Auth::user()->username);
                                    $message->to($data->to_email,$data->to_email)->subject('Gdoox CRM');
                                 });
                            }
                            elseif(!empty($bcc) && empty($cc)){
                                    Mail::raw($final_val, function($message) use ($data,$bcc){
                                    $message->from(Auth::user()->email, Auth::user()->username);
                                    $message->bcc($bcc,Auth::user()->username);
                                    $message->to($data->to_email,$data->to_email)->subject('Gdoox CRM');
                                 });
                            } 
                            else {
                                Mail::raw($final_val, function($message) use ($data){
                                $message->from(Auth::user()->email, Auth::user()->username);
                                $message->to($data->to_email,$data->to_email)->subject('Gdoox CRM');
                             });
                            }
                        }
                        else {
                            Session::flash('message', 'Email Could not be sent! Please Try Again');
                            return Redirect::route('crm_emails.create')->with(Request::all());
                        }
                    }


    //            for($i=0; $i < $length-1; $i++){
    //                $data->user_id = Auth::id();
    //                $data->from = $request['from'];
    //                $data->cc = $cc;
    //                $data->bcc = $bcc;
    //                $data->to_email = trim($to[$i]);
    //                $data->content = $request['content'];
    //
    //                $sent_to = CrmContacts::where('email_address','=',$data->to_email)->first();
    //
    //                $data->to_name= $sent_to->first_name.' '.$sent_to->last_name;
    //
    //                if($data->save())
    //                {
    //                    Mail::raw($request['content'], function($message) use ($data){
    //                        $message->from(Auth::user()->email, Auth::user()->username);
    //                        $message->to(trim($data->to_email),$data->to_email)->subject('Gdoox CRM');
    //                     });
    //                }
    //                else
    //                {
    //                    Session::flash('message', 'Email Could not be sent! Please Try Again');
    //                    return Redirect::route('crm_emails.create')->with(Request::all());
    //                }
    //            }

                    Session::flash('message', 'Email Sent Successfully');
                    return Redirect::route('crm_emails.index');
                }
            }
            else  {
                    return redirect('auth/login')->with('message',"Please Login to Send Email!"); 
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
            // return Redirect::route('crm_emails.create')->with('message','Oops! Something went Wrong. Please Try Again'); 
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
                $form_fields = CrmFieldMaster::where('title','=','crm_emails')->where('lang','=','en')->first();
                $userdata = CrmEmails::where('_id','=',$id)->first();
                return view('crm.crm_emails.show', compact('form_fields','userdata','route', 'nav_menus', 'sub_nav_menu'));
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
            $match = array();
            $to = array();
            $cc = array();
            $bcc = array();
            if(Auth::user()){
                    $request = Request::all();
                    $data = CrmEmails::where('_id','=',$id)->first();

                    if($request['send_to']==='contacts'){
                        if(strpos($request['to'],",")){
                            $to_email = explode(",",$request['to']);
                            $length_to = sizeof($to_email);
                            for($i=0; $i < $length_to-1; $i++){
                                if(!empty($to_email)){
                                    $to[] = $to_email[$i];
                                }
                            }
                            $data->group = '';
                        }
                        else {
                            $to[] = trim($request['to']);
                        }
                    }
                    else {
                        $groupname = $request['to'];
                        $data->group = $request['to'];
                        $contactgroups = CrmContacts::where('contact_group_name','=',$groupname)->get();
                        foreach($contactgroups as $groups){
                            if(!empty($groups->email_address)){
                                $to[] = $groups->email_address;
                            }
                        }
                    }

                    if(strpos($request['add_cc'],",")){
                        $to_cc = explode(",",$request['add_cc']);
                        $length_cc = sizeof($to_cc);
                        for($i=0; $i < $length_cc-1; $i++){
                            $cc[] = trim($to_cc[$i]);
                        }
                    }
                    else {
                        if(!empty(trim($request['add_cc']))){
                            $cc[] = trim($request['add_cc']);
                        }
                    }

                    if(strpos($request['add_bcc'],",")){
                        $to_bcc = explode(",",$request['add_bcc']);
                        $length_bcc = sizeof($to_cc);
                        for($i=0; $i < $length_bcc-1; $i++){
                            $bcc[] =  trim($to_bcc[$i]);
                        }
                    }
                    else {
                        if(!empty(trim($request['add_bcc']))){
                            $bcc[] = trim($request['add_bcc']);
                        }  
                    }


                    $data->from = $request['from'];
                    $data->template = $request['template'];
                    $data->content = $request['content'];

                    if($request['status']==='draft'){
                        $data->cc = $request['add_cc'];
                        $data->bcc = $request['add_bcc'];
                        $data->to_email = $request['to'];

                        if($data->save()) {
                            Session::flash('message', 'Saved as Draft!');
                            return Redirect::route('crm_emails.drafts');
                        }
                        else {
                            Session::flash('message', 'Email Could not be saved as Draft! Please Try Again');
                            return Redirect::route('crm_emails.create')->with(Request::all());
                        }   
                    }
                    else {
                        $data->cc = $cc;
                        $data->bcc = $bcc;
                        $data->to_email = $to;
                        $data->type = 'mail';

                        foreach($to as $key=>$val) {
                            $contacts = CrmContacts::where('email_address','=',trim($val))->project(array('first_name','last_name','mobile','office_phone'))->first();                

                            if(!empty($match[1])){
                                foreach($match[1] as $key=>$val){
                                    $temp_var = str_replace('$','',$val);
                                    $data = $contacts->$temp_var;
                                    $final_val = str_replace($val, $data, $template);
                                    $template = $final_val;
                                } 
                            }
                            else {
                               $final_val = $request['content']; 
                            }

                            $data->content = $final_val;

                            if($data->save()) {
                                if(!empty($bcc) && !empty($cc)){
                                    Mail::raw($final_val, function($message) use ($data,$bcc, $cc){
                                        $message->from(Auth::user()->email, Auth::user()->username);
                                        $message->bcc($bcc,Auth::user()->username);
                                        $message->cc($cc,Auth::user()->username);
                                        $message->to($data->to_email,$data->to_email)->subject('Gdoox CRM');
                                 });
                                }
                                elseif(!empty($cc) && empty($bcc)){
                                    Mail::raw($final_val, function($message) use ($data,$cc){
                                        $message->from(Auth::user()->email, Auth::user()->username);
                                        $message->cc($cc,Auth::user()->username);
                                        $message->to($data->to_email,$data->to_email)->subject('Gdoox CRM');
                                     });
                                }
                                elseif(!empty($bcc) && empty($cc)){
                                        Mail::raw($final_val, function($message) use ($data,$bcc){
                                        $message->from(Auth::user()->email, Auth::user()->username);
                                        $message->bcc($bcc,Auth::user()->username);
                                        $message->to($data->to_email,$data->to_email)->subject('Gdoox CRM');
                                     });
                                }
                                else {
                                    Mail::raw($final_val, function($message) use ($data){
                                    $message->from(Auth::user()->email, Auth::user()->username);
                                    $message->to($data->to_email,$data->to_email)->subject('Gdoox CRM');
                                 });
                                }
                            }
                            else {
                                Session::flash('message', 'Email Could not be sent! Please Try Again');
                                return Redirect::route('crm_emails.create')->with(Request::all());
                            }
                        }   

    //                $data->cc = $cc;
    //                $data->bcc = $bcc;
    //                $data->to_email = $to;
    //                $data->type='mail';
    //                if($data->save())
    //                {
    //                    if(!empty($bcc) && !empty($cc)){
    //                        Mail::raw($request['content'], function($message) use ($data,$bcc, $cc){
    //                            $message->from(Auth::user()->email, Auth::user()->username);
    //                            $message->bcc($bcc,Auth::user()->username);
    //                            $message->cc($cc,Auth::user()->username);
    //                            $message->to($data->to_email,$data->to_email)->subject('Gdoox CRM');
    //                     });
    //                    }
    //                    elseif(!empty($bcc) && empty($cc)){
    //                            Mail::raw($request['content'], function($message) use ($data,$bcc){
    //                            $message->from(Auth::user()->email, Auth::user()->username);
    //                            $message->bcc($bcc,Auth::user()->username);
    //                            $message->to($data->to_email,$data->to_email)->subject('Gdoox CRM');
    //                         });
    //                    }
    //                    elseif(!empty($cc) && empty($bcc)){
    //                        Mail::raw($request['content'], function($message) use ($data,$cc){
    //                            $message->from(Auth::user()->email, Auth::user()->username);
    //                            $message->cc($cc,Auth::user()->username);
    //                            $message->to($data->to_email,$data->to_email)->subject('Gdoox CRM');
    //                         });
    //                    }
    //                    else {
    //                        Mail::raw($request['content'], function($message) use ($data){
    //                        $message->from(Auth::user()->email, Auth::user()->username);
    //                        $message->to($data->to_email,$data->to_email)->subject('Gdoox CRM');
    //                     });
    //                    }
    //                }
    //                else
    //                {
    //                    Session::flash('message', 'Email Could not be sent! Please Try Again');
    //                    return Redirect::route('crm_emails.create')->with(Request::all());
    //                }

                        Session::flash('message', 'Email Sent Successfully');
                        return Redirect::route('crm_emails.index');
                    }
                }
            else {
                    return redirect('auth/login')->with('message',"Please Login to Send Email!"); 
            }
        }
        catch(Exception $e){
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
      catch (\Exception $e) {
              return Response::json ( array (
                  'error' => true,
                  'data' => $e
             ), 200 );
        }
    }
    
    public function selectTemplate(){
    try {
         if(Request::ajax()) {
             if(Auth::user()){
                 $userid = Auth::user()->id;
             }
             
             $input = Request::all();
             $template = CrmTemplates::where('user_id','=',$userid)->where('template_name','=',$input['template'])->first();
             return $template->body;
             
         }
        }
        catch (\Exception $e) {
              return Response::json ( array (
                  'error' => true,
                  'data' => $e
             ), 200 );
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
