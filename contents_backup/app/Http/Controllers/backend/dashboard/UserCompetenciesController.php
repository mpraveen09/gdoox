<?php

namespace Gdoox\Http\Controllers\backend\dashboard;

use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Gdoox\Models\NavigationMenu;
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

//  This is the controller which is created according to new Requirement created by Mukesh.
//  The Old one is PersonalSitesController.

class UserCompetenciesController  extends Controller {
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
                $userid = Auth::id();
                $competency = array();

                $fm_data = FieldMaster::where('title', '=', 'personal_sites_new')->first();
                list($route, $nav_menu) = $this->navigationTabs();
                $competencies_options = DropdownOption::where('name','=','Competencies')->where('lang', $this->language)->first();
                foreach ($competencies_options->options as $key => $value) {
                    $competency[trim($value)] = $value;
                }

                $competencies = PersonalSiteDetail::where('user_id', $userid)->first();
                
//                echo "<pre>";
//                if(isset($competencies->competencies)){
//                    print_r($competencies->competencies);
//                }
//                exit;
                
                return view('backend.dashboard.user_competencies.create',compact('fm_data','competency','competencies','route','nav_menu'));
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
                $data = PersonalSiteDetail::where('user_id','=',$userid)->first();

                $competencies = array();
             
                if(isset($data->competencies)){
                    foreach($data->competencies as $key=>$value){
                        $competencies[$key]['competencies'] = $value['competencies'];
                        $competencies[$key]['short_description'] = $value['short_description'];
                        $competencies[$key]['competencies_tags'] = $value['competencies_tags'];
                        $competencies[$key]['extensive_description'] = $value['extensive_description'];
                    }
                    $competencies[$key+1]['competencies'] = $request['competencies'];
                    $competencies[$key+1]['short_description'] = $request['short_description'];
                    $competencies[$key+1]['competencies_tags'] = $request['competencies_tags'];
                    $competencies[$key+1]['extensive_description'] = $request['extensive_description'];
                }
                else {
                    $competencies[0]['competencies'] = $request['competencies'];
                    $competencies[0]['short_description'] = $request['short_description'];
                    $competencies[0]['competencies_tags'] = $request['competencies_tags'];
                    $competencies[0]['extensive_description'] = $request['extensive_description'];
                }
                
                if(!empty($data)){
                    $data->user_id = $userid;
                    $data->type= 'personal';
                    $data->competencies= $competencies;
                    if($data->save()) {
                        Session::flash('message', 'Competency has been Saved Successfully!');
                        return Redirect::route('competencies-create');
                    }
                    else {
                       return Redirect::route('competencies-create')->with('message','The Information could not be Updated! Please try again')->withInput(Request::all());  
                    } 
                }
                else {
                    $new = new PersonalSiteDetail();

                    $new->user_id= $userid;
                    $new->type= 'personal';
                    $new->competencies = $competencies;
                    if($new->save()) {
                        Session::flash('message', 'Competency has been saved Successfully!');
                        return Redirect::route('competencies-create')->with('message','Your Information has been saved Successfully!');  
//                      return Redirect::route('competencies-edit',$userid);
                    }
                    else {
                       return Redirect::route('competencies-create')->with('message','The Information could not be saved! Please try again')->withInput(Request::all());  
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
            $required="*";
            $userid = Auth::user()->id;
            list($route, $nav_menu) = $this->navigationTabs();
            $competencies = PersonalSiteDetail::where('user_id', $userid)->first();
            $values = $competencies->competencies[$id];
            
            $fm_data = FieldMaster::where('title', '=', 'personal_sites_new')->where('lang', $this->language)->first();
            $competency_fields = DropdownOption::where('name','=','Competencies')->where('lang', $this->language)->first();
            foreach ($competency_fields->options as $value) {
                $competency[trim($value)] = $value;
            }
            return view('backend.dashboard.user_competencies.edit',compact('fm_data','info','competency','required','values','nav_menu','route'))->with('id',$id);
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
            
            $request = Request::all();
            $competencies = array();
            $data = PersonalSiteDetail::where('user_id', Auth::user()->id)->first();
            
            foreach($data->competencies as $key=>$value){
                if($key == $id){
                        $competencies[$id]['competencies'] = $request['competencies'];
                        $competencies[$id]['short_description'] = $request['short_description'];
                        $competencies[$id]['competencies_tags'] = $request['competencies_tags'];
                        $competencies[$id]['extensive_description'] = $request['extensive_description'];
                }
                else {
                    $competencies[$key]['competencies'] = $value['competencies'];
                    $competencies[$key]['short_description'] = $value['short_description'];
                    $competencies[$key]['competencies_tags'] = $value['competencies_tags'];
                    $competencies[$key]['extensive_description'] = $value['extensive_description'];
                }
            }

            $data->competencies = $competencies;
            if($data->save()) {
                Session::flash('message', 'Competency has been Updated Successfully!');
                return Redirect::route('competencies-create');
            }
            else {
               return Redirect('competencies-edit')->with('message','The Information could not be Updated! Please try again')->withInput(Request::all());  
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
    public function destroy($id)
    {
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
