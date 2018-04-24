<?php

namespace Gdoox\Http\Controllers\backend\dashboard;

use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Gdoox\Models\FieldMaster;
use Gdoox\Models\PersonalSiteDetail;
use Gdoox\Models\DropdownOption;
use Gdoox\Models\Categories;
use Gdoox\Models\BusinessEcommerceCompany;

use Gdoox\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Gdoox\Http\Controllers\Controller;
use Gdoox\Models\PersonalInfo;
use Gdoox\Models\NavigationMenu;
use Illuminate\Support\Facades\Route;
use File;

//  This is the controller which is created according to new Requirement created by Mukesh.
//  The Old one is PersonalSitesController.

class UserGeneralInfoController extends Controller
{
    
    use \Gdoox\Helpers\backend\dashboard\ImageUpload;
    use  \Gdoox\Helpers\backend\dashboard\HelperFunctions; 
    use  \Gdoox\Helpers\backend\dashboard\RolesUsers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(){
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        try{
            if(Auth::user()){
                $check= PersonalSiteDetail::where('user_id', Auth::user()->id)->first();
                $personal_info = PersonalInfo::where('user_id', Auth::user()->id)->first();
                
                $role = $this->getRoleName(Auth::user()->id);
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'CREATE PERSONAL SITE')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();
                
                if(!empty($check)){
                    return Redirect::route('general-info-edit', Auth::user()->id);
                }
                else {
                    $fm_data = FieldMaster::where('title', '=', 'personal_sites_new')->first();
                    
                    $countries = DropdownOption::where('name','countries')->where('lang', 'en')->first();
                    foreach($countries->options as $countryname){
                        $country[$countryname] = $countryname;
                    }
                    
                    $markets = DropdownOption::where('name','market_type')->where('lang', 'en')->first();
                    foreach($markets->options as $marketname){
                        $market[$marketname] = $marketname;
                    }
                    
                    return view('backend.dashboard.general_info.create',compact('fm_data','country','personal_info','market','nav_menu','route'));
                }
            }
            else {
                return redirect('auth/login')->with('message',"Please Login to Add Information!"); 
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
                $userid = Auth::user()->id;
                $request = Request::all();
                $permission = 0775;
                $path = Auth::user()->directory_path."site_images/".Auth::user()->id."/";
                
                $rules = array('first_name' => 'required|min:2|max:50',
                    'second_name'=>'min:2|max:50',   
                    'surname'=> 'required',
                    'dob'=>'required',
                    'street_add'=>'required',
                    'city'=>'required',
                    'country'=>'required',
                    'country_area'=>'required',
                    'private_ph_no'=>'required',
                    'private_mob_no'=>'required',
                    'fiscal_id'=>'required',
                    'personal_email'=>'required'
                );
            
                $validator = Validator::make(Request::all(), $rules);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput(Request::all());   
               // return Redirect('dashboard/general_info/create')->withErrors($validator)->withInput(Request::all());   
            }
            else {
                if(isset($request['site_logo'])){
                    $val = $request['site_logo'];
                    if(gettype($val) === "object"){
                        $image = $val->getClientOriginalName();
                        $extension = $val->getClientOriginalExtension();
                        $size = $val->getSize();
                        $mime = $val->getMimeType();
                        if(substr($mime, 0, 5) == 'image') {
                            if(!File::exists($path)) {
                                $target_dir = $this->make_directory($path, $permission, true);
                            }
                            $filename = "site_image-".$this->randomString() . "-". time().".".$extension;  
                            $val->move($path, $filename);
                            $site_image = $path.$filename;
                            $request['site_logo'] = $site_image;
                        }
                    }
                }
                
                $check= PersonalSiteDetail::where('user_id',$userid)->first();
                if(!empty($check)){
                    $check->general_info = $request;
                    $check->type = 'personal';
                    if($check->save()) {
                        Session::flash('message', 'Dear User, Your Information has been Updated Successfully!');
                        return Redirect::route('general-info-edit');
                    }
                    else {
                        return Redirect('dashboard/general_info/create')->with('message','The Information could not be saved! Please try again')->withInput(Request::all());  
                    }
                }
                else {
                    $data = new PersonalSiteDetail();
                    $data->user_id = $userid;
                    $data->general_info = $request;
                    
                    
                    $data->type = 'personal';
                    if($data->save()) {
                        Session::flash('message', 'Dear '.$data['first_name'].' Your Information has been saved Successfully! We will contact you soon. Thanks');
                        return Redirect::route('general-info-create');
                    }
                    else {
                        return Redirect('dashboard/general_info/create')->with('message','The Information could not be saved! Please try again')->withInput(Request::all());  
                    }
                }      
            }
        }
        else {
                return redirect('auth/login')->with('message',"Please Login to Add Information!"); 
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
    public function show($id)
    {
        //
    }

       /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        try{
            
            $role = $this->getRoleName(Auth::user()->id);
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'CREATE PERSONAL SITE')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
                
            $fm_data = FieldMaster::where('title', '=', 'personal_sites_new')->first();
            $countries=  DropdownOption::where('name','countries')->where('lang', 'en')->first();
            
            $general_info = PersonalSiteDetail::where('user_id',Auth::user()->id)->project('general_info')->first();
            $personal_info = PersonalInfo::where('user_id', Auth::user()->id)->first();
            
            $markets = DropdownOption::where('name','market_type')->where('lang', 'en')->first();
            foreach($markets->options as $marketname){
                $market[$marketname] = $marketname;
            }
           
            
            foreach($countries->options as $countryname){
                $country[$countryname] = $countryname;
            }
            
            return view('backend.dashboard.general_info.edit',compact('fm_data','country','general_info','personal_info','market','nav_menu','route'))->with('id',$id);
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
    public function update($id){
        try{
            $request= Request::all();
            $permission = 0775;
                
            $path = Auth::user()->directory_path."site_images/".Auth::user()->id."/";
            $rules = array('first_name' => 'required|min:2|max:50',
                'second_name'=>'min:2|max:50',   
                'surname'=> 'required',
                'dob'=>'required',
                'street_add'=>'required',
                'city'=>'required',
                'country'=>'required',
                'country_area'=>'required',
                'private_ph_no'=>'required',
                'private_mob_no'=>'required',
                'fiscal_id'=>'required',
                'personal_email'=>'required'
                );

            $validator = Validator::make(Request::all(), $rules);

            if ($validator->fails()) {
                return Redirect('dashboard/general_info/edit')->withErrors($validator)->withInput(Request::all());   
            }
            else {
                if(isset($request['site_logo'])){
                    $val = $request['site_logo'];
                    if(gettype($val) === "object"){
                        $image = $val->getClientOriginalName();
                        $extension = $val->getClientOriginalExtension();
                        $size = $val->getSize();
                        $mime = $val->getMimeType();
                        if(substr($mime, 0, 5) == 'image') {
                            if(!File::exists($path)) {
                                $target_dir = $this->make_directory($path, $permission, true);
                            }
                            $filename = "site_image-".$this->randomString() . "-". time().".".$extension;  
                            $val->move($path, $filename);
                            $site_image = $path.$filename;
                            $request['site_logo'] = $site_image;
                        }
                    }
                }
                
                $check = PersonalSiteDetail::where('user_id',$id)->first();
                if(!empty($check)){
                    $check->general_info = $request;
                    $check->type = 'personal';
                    if($check->save()) {
                            Session::flash('message', 'Dear User, Your Information has been Updated Successfully!');
                            return Redirect::route('general-info-create');
                    }
                    else {
                           return Redirect('dashboard/general_info/edit')->with('message','The Information could not be saved! Please try again')->withInput(Request::all());  
                    }
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
        //
    }
    
    



//    public function generalInfo()
//    {
//        if(Auth::user())
//        {
//            $fm_data = FieldMaster::where('title', '=', 'personal_sites_new')->first();
//            $countries=  DropdownOption::where('name','countries')->where('lang', 'en')->first();
//            foreach($countries->options as $countryname)
//            {
//              $country[$countryname]=$countryname;
//            }
//            return view('backend.dashboard.personal_site.general_info',compact('fm_data','country'));
//        }
//        else
//        {
//            return redirect('auth/login')->with('message',"Please Login to Add Information!"); 
//        }
//    }
//    
//    public function insertGeneralInfo()
//    {
//        $request = Request::all();
//        $rules = array('first_name' => 'required|min:2|max:50',
//            'second_name'=>'min:2|max:50',   
//            'surname'=> 'required');
//        
//        $validator = Validator::make(Request::all(), $rules);
//        
//        if ($validator->fails()) {
//            return Redirect('dashboard/personal_site/general-info')->withErrors($validator)->withInput(Request::all());   
//        }
//        
//        else
//        {
//            $data= new PersonalSiteDetail();
//            if(Auth::user()){
//                $userid= Auth::id();
//            }
//            else
//            {
//                $userid='';
//            }
//        
//            $data->user_id= $userid;
//            $data->general_info=$request;
//            
//            
//            if($data->save()) {
//                    Session::flash('message', 'Dear '.$data['first_name'].' Your Information has been saved Successfully! We will contact you soon. Thanks');
//                    return Redirect::route('dashboard/personal_site/general-info');
//            }
//            else {
//                   return Redirect('dashboard/personal_site/general-info')->with('message','The Information could not be saved! Please try again')->withInput(Request::all());  
//            }
//        }
//
//    }
//
//    public function jobExperience()
//    {
//       if(Auth::user())
//        {
//            $requierd="*";
//            $fm_data = FieldMaster::where('title', '=', 'personal_sites_new')->first();
//            return view('backend.dashboard.personal_site.job_experiences',compact('fm_data','required'));
//        }
//        else
//        {
//            return redirect('auth/login')->with('message',"Please Login to Add Information!"); 
//        }  
//    }
//    
//    public function insertProfessionalSkills(){       
//        if(Auth::user())
//        {
//            $request = Request::all(); 
//            $userid= Auth::id();
//
//            $final_lang_data= array();
//            $final_school_data= array();
//            $final_title_date= array();
//
//            foreach ($request['add_language'] as $key=>$value) {
//                $final_lang_data[$key]['language']=$value;
//                $final_lang_data[$key]['speaking']=$request['speaking_lang'][$key];
//                $final_lang_data[$key]['writing']=$request['writing_lang'][$key]; 
//            }
//
//            $final_lang_data[$key+1]['language']=$request['language'];
//            $final_lang_data[$key+1]['speaking']=$request['speaking'];
//            $final_lang_data[$key+1]['writing']=$request['writing']; 
//
//
//            foreach($request['school'] as $key=>$value){
//                $final_school_data[$key]['school']= $value;
//                $final_school_data[$key]['from_year']= $request['school_from_year'][$key];
//                $final_school_data[$key]['to_year']= $request['school_to_year'][$key];
//            }
//
//            foreach($request['title'] as $key=>$value){
//                $final_title_date[$key]['title']= $value;
//                $final_title_date[$key]['from_year']= $request['title_from_year'][$key];
//                $final_title_date[$key]['to_year']= $request['title_from_year'][$key];
//            }
// 
//            $check= PersonalSiteDetail::where('user_id','=',$userid)->first();
//            if(!empty($check))
//            {
//                $data= PersonalSiteDetail::where('user_id', $userid)->first();
//                $data->user_id= $userid;
//                $data->professional_skills=$request['professional_skills'];
//                $data->skills_tags=$request['skill_tags'];
//                $data->other_certifications= $request['other_certifications'];
//                $data->languages=$final_lang_data;
//                $data->schools=$final_school_data;
//                $data->titles=$final_title_date;
//                if($data->save()) {
//                    Session::flash('message', 'Your Information has been Updated Successfully!');
//                    return Redirect::route('job-experiences');
//                }
//                else {
//                   return Redirect('job-experiences')->with('message','The Information could not be Updated! Please try again')->withInput(Request::all());  
//                }
//                
//            }
//            else
//            {
//                $data= new PersonalSiteDetail();
//                $data->user_id= $userid;
//                $data->professional_skills=$request['professional_skills'];
//                $data->skills_tags=$request['skill_tags'];
//                $data->other_certifications= $request['other_certifications'];
//                $data->languages=$final_lang_data;
//                $data->schools=$final_school_data;
//                $data->titles=$final_title_date;
//                if($data->save()) {
//                    Session::flash('message', 'Your Information has been saved Successfully!');
//                    return Redirect::route('job-experiences');
//                }
//                else {
//                   return Redirect('job-experiences')->with('message','The Information could not be saved! Please try again')->withInput(Request::all());  
//                } 
//            }
//        }
//        else
//        {
//            return redirect('auth/login')->with('message',"Please Login to Add Information!"); 
//        } 
//    }

        public function errorMessage($e){
            $error = "An error occured. ".
                "Line Number: ".$e->getLine()." ".
                "File Name: ".$e->getFile()." ".
                "Error Description: ".$e->getMessage(); 
            return $error;
        }
    }
