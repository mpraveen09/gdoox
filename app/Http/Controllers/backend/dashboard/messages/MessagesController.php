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
use Gdoox\Models\PersonalInfo;
use Gdoox\Models\SocialInfo;
use Gdoox\Models\DropdownOption;
use Gdoox\Models\FieldMaster;
use Illuminate\Support\Facades\Auth;
use Gdoox\Models\TermsAndCondition;
use Illuminate\Support\Facades\Session;
use Gdoox\Http\Controllers\Controller;
use Gdoox\Models\NavigationMenu;
use Illuminate\Support\Facades\Route;

class MessagesController extends Controller {
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        try {
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('group','personal_profile')->where('parent', '13')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
            
            $social_info = SocialInfo::where('user_id', Auth::user()->id)->first();
            if(!empty($social_info)){
                return Redirect::route('social-info-edit',$social_info->id);
            }
            else {
                $fm_data = FieldMaster::where('title', '=', 'social_info')->where('lang','=', 'en')->first();
                $tc = TermsAndCondition::where('title', 'personal_info')->where('lang', 'en')->first();
                $social_info = SocialInfo::where('user_id', Auth::user()->id)->first();
                return view('backend.dashboard.personal_profiles.social_info.create',compact('route','nav_menu','fm_data','social_info','tc'));
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }
    
    public function store(Request $request) {
        try{
            if(Auth::user()){
                if(DB::Collection('social_info')->insert($request->all())){
                    return Redirect::route('relation-info-create');
                }
                else {
                     return redirect()->back()->with('message','Something went Wrong! Social Info could not be saved. Please try Again.');
                }
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
    public function edit($id)
    {
        try{
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('group','personal_profile')->where('parent', '13')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
            
            $fm_data =  FieldMaster::where('title', '=', 'social_info')->where('lang','=', 'en')->first();
            $tc=  TermsAndCondition::where('title', 'personal_info')->where('lang', 'en')->first();
            $social_info=  SocialInfo::where('user_id', Auth::user()->id)->first();
             
            return view('backend.dashboard.personal_profiles.social_info.edit',compact('route','nav_menu','fm_data','social_info','tc'));
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
        try{
            if(Auth::user()){
                 if(DB::Collection('social_info')->where('user_id','=', Auth::user()->id)->update($request->all())){
                     return Redirect::route('relation-info-create');
                 }
             }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }
/*
 * 
 */
    public function errorMessage($e){
            $error = "An error occured. ".
                "Line Number: ".$e->getLine()." ".
                "File Name: ".$e->getFile()." ".
                "Error Description: ".$e->getMessage(); 
            return $error;
    }
    
}
