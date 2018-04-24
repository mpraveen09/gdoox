<?php

namespace Gdoox\Http\Controllers\backend\dashboard;

use DB;
use Image;
use Input;
use Redirect;
use Gdoox\UserRole;
use Gdoox\backend\Profile;
use Gdoox\Http\Requests;
use Illuminate\Http\Request;
use Gdoox\Models\Invitation;
use Gdoox\Models\SocialInfo;
use Gdoox\Models\InterestInfo;
use Gdoox\Models\PersonalInfo;
use Gdoox\Models\DropdownOption;
use Gdoox\Models\FieldMaster;
use Gdoox\Models\TermsAndCondition;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Gdoox\Http\Controllers\Controller;
use Gdoox\Models\NavigationMenu;
use Illuminate\Support\Facades\Route;

class InterestInfoController extends Controller
{
    use \Gdoox\Helpers\backend\dashboard\RolesUsers;
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        try {
            $language = session('app_language');
            $role = $this->getRoleName(Auth::user()->id);
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('menu','PERSONAL PROFILE')->where('user',$role)->where('lang','en')->get();            
            $route = Route::getCurrentRoute()->getName();
            
            $interest_info = InterestInfo::where('user_id', Auth::user()->id)->first();
            if(!empty($interest_info)){
                return Redirect::route('interest-info-edit',$interest_info->id);
            }
            else {
                $fm_data = FieldMaster::where('title', '=', 'interest_info')->where('lang','=',$language)->first();
                $tc = TermsAndCondition::where('title', 'personal_info')->where('lang', $language)->first();
                return view('backend.dashboard.personal_profiles.interest_info.create',compact('nav_menu','route','fm_data','tc'));
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        try {
            $language = session('app_language');
            $role = $this->getRoleName(Auth::user()->id);
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('menu','PERSONAL PROFILE')->where('user',$role)->where('lang','en')->get();            
            $route = Route::getCurrentRoute()->getName();
            
            $fm_data = FieldMaster::where('title', '=', 'interest_info')->where('lang',$language)->first();
            $tc = TermsAndCondition::where('title', 'personal_info')->where('lang',$language)->first();
            $interest_info = InterestInfo::where('user_id', Auth::user()->id)->first();
            return view('backend.dashboard.personal_profiles.interest_info.edit',compact('route','nav_menu','fm_data','interest_info','tc'));
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }
    
    public function store(Request $request) {
        try {
            if(Auth::user()){
                if(DB::Collection('interest_info')->insert($request->all())){
                    return Redirect::route('business-sectors-index');
                }
                else {
                     return redirect()->back()->with('message','Something went Wrong! Interest Info could not be saved. Please try Again.');
                }
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
                if(DB::Collection('interest_info')->where('user_id','=', Auth::user()->id)->update($request->all())){            
                   return Redirect::route('business-sectors-index');
                }
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }
/*
 * Error Message
 */
    public function errorMessage($e){
            $error = "An error occured. ".
                "Line Number: ".$e->getLine()." ".
                "File Name: ".$e->getFile()." ".
                "Error Description: ".$e->getMessage(); 
            return $error;
    }
}
