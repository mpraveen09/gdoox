<?php

namespace Gdoox\Http\Controllers\backend\dashboard;

use DB;
//use Auth;
use Image;
use Input;
use Redirect;
use Gdoox\UserRole;
use Gdoox\backend\Profile;
use Gdoox\Http\Requests;
use Illuminate\Http\Request;
use Gdoox\Models\Invitation;
use Gdoox\Models\SocialInfo;
use Gdoox\Models\RelationInfo;
use Gdoox\Models\InterestInfo;
use Gdoox\Models\PersonalInfo;
use Gdoox\Models\DropdownOption;
use Gdoox\Models\FieldMaster;
use Gdoox\Models\TermsAndCondition;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Gdoox\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Gdoox\Models\NavigationMenu;

class PersonalInfoController extends Controller
{
  use \Gdoox\Helpers\backend\dashboard\RolesUsers;
  use \Gdoox\Helpers\backend\dashboard\UserInfoHelperFunctions;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
  
    private $language;
    public function __construct(){
         $this->language = session('app_language');
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create(){
        try {
            $required="*";
            
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('group','personal_profile')->where('parent', '13')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
            
            $personal_info = PersonalInfo::where('user_id', Auth::user()->id)->first();
            $fm_data = FieldMaster::where('title', '=', 'personal_info')->where('lang','=',$this->language)->first();
            $tc = TermsAndCondition::where('title', 'personal_info')->where('lang', 'en')->first();   
            $countries = DropdownOption::where('name','countries')->where('lang', $this->language)->first(); 
            foreach($countries->options as $countryname){
                $country[$countryname] = $countryname;
            }
            
            $working_field = DropdownOption::where('name','=','Working Field')->where('lang', $this->language)->first();
            foreach($working_field->options as $key=>$field){
                $workingfield[] = $field;
            }
       
            if(!empty($personal_info)){
                return Redirect::route('personal-info-edit',$personal_info->id);
            }
            else {
                return view('backend.dashboard.personal_profiles.personal_info.create',compact('workingfield','route','nav_menu','fm_data', 'country', 'required','tc'));
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
      public function store(Request $request) {
       try{
            if(Auth::user()){
                $data = new PersonalInfo();
                $data->_method = $request->_method;
                $data->_token = $request->_token;
                $data->user_id = Auth::user()->id;
                $data->first_name = $request->first_name;
                $data->second_name = $request->l_name;
                $data->surname = $request->surname;
                $data->initials = $request->initials;
                $data->dob = $request->dob;
                $data->street_add = $request->street_add;
                $data->city = $request->city;
                $data->country = $request->country;
                $data->zip = $request->zip;
                $data->private_ph_no1 = $request->private_ph_no1;
                $data->private_mob_no1 = $request->private_mob_no1;
                $data->business_phone_no1 = $request->business_phone_no1;
                $data->business_mob_no1 = $request->business_mob_no1;
                $data->skype = $request->skype;
                $data->msm = $request->msm;
                $data->blackberry = $request->blackberry;
                $data->personal_email = $request->personal_email;
                $data->business_email = $request->business_email;
                $data->job_description = $request->job_description;
                
                $data->dob_status = $request->dob_status;
                $data->street_add_status = $request->street_add_status;
                $data->zip_status = $request->zip_status;
                $data->business_phone_no1_status = $request->business_phone_no1_status;
                $data->business_mob_no1_status = $request->business_mob_no1_status;
                $data->skype_status = $request->skype_status;
                $data->msm_status = $request->msm_status;
                $data->blackberry_status = $request->blackberry_status;
                $data->business_email_status = $request->business_email_status;
                $data->working_field = $request->working_field;
                if($data->save()){
                    return Redirect::route('relation-info-create');
                }
                else {
                     return redirect()->back()->with('message','Something went Wrong! Personal Info could not be saved. Please try Again.');
                }
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
     * @return \Illuminate\Http\Response
     */
    public function show($id){

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        try {
            if(Auth::user()){
                $required="*";
                $selectedfield= array();
                $workingfield = array();
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('group','personal_profile')->where('parent', '13')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();
                
                $fm_data = FieldMaster::where('title', '=', 'personal_info')->where('lang', $this->language)->first();
                $tc = TermsAndCondition::where('title', 'personal_info')->where('lang', 'en')->first();
                
               
                $personal_info = PersonalInfo::where('user_id', Auth::user()->id)->first();
//                echo "<pre>";
//                print_r($personal_info);
//                exit;
                
                if(!empty($personal_info->working_field)){
                    foreach($personal_info->working_field as $info){
                        $selectedfield[] = $info;
                    }
                }
                
                $countries = DropdownOption::where('name','countries')->where('type','drop_down')->where('lang', $this->language)->first();  
                 foreach($countries->options as $countryname){
                    $country[$countryname] = $countryname;
                 }
                 
                $working_field = DropdownOption::where('name','=','Working Field')->where('lang', $this->language)->first();
                foreach($working_field->options as $key=>$field){
                    $workingfield[]= $field;
                }

               //  print_r($personal_info); die;
                return view('backend.dashboard.personal_profiles.personal_info.edit',compact('selectedfield','workingfield','nav_menu','route','fm_data', 'country', 'required', 'personal_info','tc'));
            }
            else {
                  return redirect('auth/login')->with('message',"You must be login!"); 
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        try {
            if(Auth::user()){
                $data = PersonalInfo::where('user_id', Auth::user()->id)->first();
     
                $data->_method = $request->_method;
                $data->_token = $request->_token;
                $data->user_id = Auth::user()->id;
                $data->first_name = $request->first_name;
                $data->second_name = $request->second_name;
                $data->surname = $request->surname;
                $data->initials = $request->initials;
                $data->dob = $request->dob;
                $data->street_add = $request->street_add;
                $data->city = $request->city;
                $data->country = $request->country;
                $data->zip = $request->zip;
                $data->private_ph_no1 = $request->private_ph_no1;
                $data->private_mob_no1 = $request->private_mob_no1;
                $data->business_phone_no1 = $request->business_phone_no1;
                $data->business_mob_no1 = $request->business_mob_no1;
                $data->skype = $request->skype;
                $data->msm = $request->msm;
                $data->blackberry = $request->blackberry;
                $data->personal_email = $request->personal_email;
                $data->business_email = $request->business_email;
                $data->job_description = $request->job_description;
                
                $data->dob_status = $request->dob_status;
                $data->street_add_status = $request->street_add_status;
                $data->zip_status = $request->zip_status;
                $data->business_phone_no1_status = $request->business_phone_no1_status;
                $data->business_mob_no1_status = $request->business_mob_no1_status;
                $data->skype_status = $request->skype_status;
                $data->msm_status = $request->msm_status;
                $data->blackberry_status = $request->blackberry_status;
                $data->business_email_status = $request->business_email_status;
                $data->working_field = $request->working_field;
                
                if($data->save()) {
                    return Redirect::route('relation-info-create');
                    // return Redirect::route('position.create');
                }
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
    }
     
     public function errorMessage($e){
        $error = "An error occured. ".
            "Line Number: ".$e->getLine()." ".
            "File Name: ".$e->getFile()." ".
            "Error Description: ".$e->getMessage(); 
        return $error;
    }
    
}