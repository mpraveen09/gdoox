<?php

namespace Gdoox\Http\Controllers\backend\dashboard;

use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Gdoox\Models\FieldMaster;
use Gdoox\Models\PersonalSiteDetail;
use Gdoox\Models\DropdownOption;
use Gdoox\Models\DropdownOptions;
use Gdoox\Models\Categories;
use Gdoox\Models\BusinessEcommerceCompany;

use Gdoox\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Gdoox\Http\Controllers\Controller;
use Gdoox\Models\NavigationMenu;

//  This is the controller which is created according to new Requirement created by Mukesh.
//  The Old one is PersonalSitesController.

class UserProfessionalSkillsController extends Controller {
    
    use  \Gdoox\Helpers\backend\dashboard\RolesUsers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    private $language;
    public function __construct() {
		if (session()->has('app_language')) {
			//
		}else{
			session(['app_language' => 'en']);
		}  		
        $this->language = session('app_language');
    }

    public function index() {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        try {
            if(Auth::user()){
                $userid = Auth::id();
                $lang = array();
                $prof = array();
                
                list($route, $nav_menu) = $this->navigationTabs();
                
                $languages = DropdownOption::where('name','=','User Languages')->where('lang', $this->language)->first();
                
                $proficiency = DropdownOption::where('name','=','Language Proficiency')->where('lang', $this->language)->first();
                foreach ($languages->options as $key => $value) {
                    $lang[trim($value)] = $value;
                }
                foreach ($proficiency->options as $key => $value) {
                    $prof[trim($value)] = $value;
                }


                $check= PersonalSiteDetail::where('user_id',$userid)->first();
                $fm_data = FieldMaster::where('title', '=', 'personal_sites_new')->first();
                $requierd="*";
                if(!empty($check)){
                   return Redirect::route('professional-skills-edit',$userid);
                }
                else {
                    return view('backend.dashboard.professional_skills.create',compact('fm_data','required','lang','prof','route','nav_menu'));
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
    public function store(Request $request){
        try {
            if(Auth::user()){
                $request = Request::all();                 
                $userid = Auth::id();

                $languages = array();
                $certifications = array();
                $educationdata = array();

//                foreach ($request['add_language'] as $key=>$value) {
//                    $other_language[$key]['language'] = $value;
//                    $other_language[$key]['speaking'] = $request['speaking_lang'][$key];
//                    $other_language[$key]['writing'] = $request['writing_lang'][$key]; 
//                }
                
                if(!empty($request['language'])){
                    foreach ($request['language'] as $key=>$value) {
                        $languages[$key]['language'] = $value;
                        $languages[$key]['understanding'] = $request['understanding'][$key];
                        $languages[$key]['speaking'] = $request['speaking'][$key];
                        $languages[$key]['writing'] = $request['writing'][$key];
                    }
                }
                
                if(!empty($request['school'])){
                    foreach($request['school'] as $key=>$value){
                        $educationdata[$key]['school']= $value;
                        $educationdata[$key]['title']= $request['title'][$key];
                        $educationdata[$key]['from_year']= $request['school_from_year'][$key];
                        $educationdata[$key]['to_year']= $request['school_to_year'][$key];
                    }
                }
                if(!empty($request['certifications'])){
                    foreach ($request['certifications'] as $key=>$value) {
                        $certifications[$key]['certification'] = $value;
                        $certifications[$key]['name_of_institute'] = $request['name_of_institute'][$key];
                        $certifications[$key]['date'] = $request['date'][$key];
                    }
                }
                
//                echo "<pre>";
//                print_r($languages);
//                echo "<br />";
//                print_r($certifications);
//                echo "<br />";
//                print_r($educationdata);
//                exit;
//                foreach($request['title'] as $key=>$value){
//                    $final_title_date[$key]['title']= $value;
//                    $final_title_date[$key]['from_year']= $request['title_from_year'][$key];
//                    $final_title_date[$key]['to_year']= $request['title_from_year'][$key];
//                }

                $check= PersonalSiteDetail::where('user_id','=',$userid)->first();
                if(!empty($check)){
                    $new = array();
                    $data = PersonalSiteDetail::where('user_id', $userid)->first(); 
                    
                    $new['skills'] = $request['skills'];
                    $new['skills_tags'] = $request['skill_tags'];
                    $new['mother_tongue'] = $request['mother_tongue'];
                    $new['certifications'] = $certifications;
                    $new['schools'] = $educationdata;
                    $new['languages']= $languages;

                    $data->user_id = $userid;
                    $data->professional_skills= $new;
                    if($data->save()) {
                        Session::flash('message', 'Your Information has been Updated Successfully!');
                        return Redirect::route('professional-skills-create');
                    }
                    else {
                       return Redirect('professional-skills-create')->with('message','The Information could not be Updated! Please try again')->withInput(Request::all());  
                    }
                }
                else {
                    $new = array();
                    $data = new PersonalSiteDetail();
                    $new['skills'] = $request['skills'];
                    $new['skills_tags'] = $request['skill_tags'];
                    $new['mother_tongue'] = $request['mother_tongue'];
                    $new['certifications'] = $certifications;
                    $new['schools'] = $educationdata;
                    $new['languages']= $languages;
                    $data->user_id = $userid;
                    $data->type = 'personal';
                    $data->professional_skills = $new;
                    if($data->save()) {
                        Session::flash('message', 'Your Information has been saved Successfully!');
                        return Redirect::route('professional-skills-edit',$userid);
                    }
                    else {
                       return Redirect('professional-skills-create')->with('message','The Information could not be saved! Please try again')->withInput(Request::all());  
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
    public function show($id) {
        //
    }

       /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        try {
            $requierd="*";
            $lang = array();
            $prof = array();
            list($route, $nav_menu) = $this->navigationTabs();
            
            $fm_data = FieldMaster::where('title', '=', 'personal_sites_new')->first();
            $info = PersonalSiteDetail::where('user_id',$id)->project('professional_skills')->first();
            $languages = DropdownOption::where('name','=','User Languages')->where('lang', $this->language)->first();

            $proficiency = DropdownOption::where('name','=','Language Proficiency')->where('lang', $this->language)->first();
            foreach ($languages->options as $key => $value) {
                $lang[trim($value)] = $value;
            }
            
            foreach ($proficiency->options as $key => $value) {
                $prof[trim($value)] = $value;
            }

            return view('backend.dashboard.professional_skills.edit',compact('fm_data','required','info','lang','prof','route','nav_menu'))->with('id',$id);
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
            $data = PersonalSiteDetail::where('user_id', $id)->first();
            
            if(!empty($data)){
                $languages = array();
                $certifications = array();
                $educationdata = array();

//                foreach ($request['add_language'] as $key=>$value) {
//                    $other_language[$key]['language'] = $value;
//                    $other_language[$key]['speaking'] = $request['speaking_lang'][$key];
//                    $other_language[$key]['writing'] = $request['writing_lang'][$key]; 
//                }

                if(!empty($request['language'])){
                    foreach ($request['language'] as $key=>$value) {
                        $languages[$key]['language'] = $value;
                        $languages[$key]['understanding'] = $request['understanding'][$key];
                        $languages[$key]['speaking'] = $request['speaking'][$key];
                        $languages[$key]['writing'] = $request['writing'][$key];
                    }
                }
                
                if(!empty($request['school'])){
                    foreach($request['school'] as $key=>$value){
                        $educationdata[$key]['school']= $value;
                        $educationdata[$key]['title']= $request['title'][$key];
                        $educationdata[$key]['from_year']= $request['school_from_year'][$key];
                        $educationdata[$key]['to_year']= $request['school_to_year'][$key];
                    }
                }
                if(!empty($request['certifications'])){
                    foreach ($request['certifications'] as $key=>$value) {
                        $certifications[$key]['certification'] = $value;
                        $certifications[$key]['name_of_institute'] = $request['name_of_institute'][$key];
                        $certifications[$key]['date'] = $request['date'][$key];
                    }
                }
            
                $new = array();
                $new['skills'] = $request['skills'];
                $new['skills_tags'] = $request['skill_tags'];
                $new['mother_tongue'] = $request['mother_tongue'];
                $new['certifications'] = $certifications;
                $new['schools'] = $educationdata;
                $new['languages']= $languages;

 
                $data->professional_skills = $new;
                if($data->save()) {
                    Session::flash('message', 'Your Information has been Updated Successfully!');
                    return Redirect::route('professional-skills-create');
                }
                else {
                   return Redirect('professional-skills-edit')->with('message','The Information could not be Updated! Please try again')->withInput(Request::all());  
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
    public function destroy($id) {
        //
    }
    
    public function navigationTabs(){
        
        $role = $this->getRoleName(Auth::user()->id);
        $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'CREATE PERSONAL SITE')->where('lang','en')->get();
        $route = Route::getCurrentRoute()->getName();
        
        return array($route, $nav_menu);
    }
    
    public function errorMessage($e){
        $error = "An error occured. ".
            "Line Number: ".$e->getLine()." ".
            "File Name: ".$e->getFile()." ".
            "Error Description: ".$e->getMessage(); 
        return $error;
    }
}
