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
use Gdoox\Models\RelationInfo;
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

class RelationInfoController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    private $language;
    public function __construct(){
         $this->language = session('app_language');
    }
    
    public function create(){
        try {
            $required = '*';
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('group','personal_profile')->where('parent', '13')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
            
            $relation_info= RelationInfo::where('user_id', Auth::user()->id)->first();
            if(!empty($relation_info)){
                return Redirect::route('relation-info-edit', $relation_info->id);
            }
            else {
                $fm_data = FieldMaster::where('title', '=', 'relation_info')->where('lang', $this->language)->first();
                $tc = TermsAndCondition::where('title', 'personal_info')->where('lang', 'en')->first();
                $relations = DropdownOption::where('name','relation_with_gdoox')->where('lang', $this->language)->first(); 
                foreach($relations->options as $relationname){
                    $relation[$relationname] = $relationname;
                }
                
                return view('backend.dashboard.personal_profiles.relation_info.create',compact('nav_menu','route','fm_data', 'relation', 'required','tc'));
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
    public function edit($id){
        try {
            $required="*";
            
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('group','personal_profile')->where('parent', '13')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
            
            $fm_data = FieldMaster::where('title','=','relation_info')->where('lang', $this->language)->first();
            $tc =  TermsAndCondition::where('title', 'personal_info')->where('lang', 'en')->first();
            $relation_info = RelationInfo::where('user_id', Auth::user()->id)->first();
            $relations = DropdownOption::where('name','relation_with_gdoox')->where('lang', $this->language)->first(); 
            foreach($relations->options as $relationname){
                $relation[$relationname]=$relationname;
            }       
            return view('backend.dashboard.personal_profiles.relation_info.edit',compact('route','nav_menu','fm_data', 'relation_info', 'relation', 'required','tc'));
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }
    
    public function store(Request $request) {
        try {
            if(Auth::user()){
                if(DB::Collection('relation_info')->insert($request->all())){
                    return Redirect::route('interest-info-create');
                }
                else {
                     return redirect()->back()->with('message','Something went Wrong! Relation Info could not be saved. Please try Again.');
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
                if(DB::Collection('relation_info')->where('user_id','=', Auth::user()->id)->update($request->all())){ 
                   return Redirect::route('interest-info-create');
                }
               }
           }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }
    
    public function errorMessage($e){
            $error = "An error occured. ".
                "Line Number: ".$e->getLine()." ".
                "File Name: ".$e->getFile()." ".
                "Error Description: ".$e->getMessage(); 
            return $error;
    }
}
