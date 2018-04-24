<?php

namespace Gdoox\Http\Controllers\backend\dashboard;

use Illuminate\Http\Request;
use Auth;
use DB;
use Redirect;
use Gdoox\Models\FieldMaster;
use Gdoox\Models\PositionInComapany;
use Gdoox\Models\TermsAndCondition;
use Gdoox\Models\DropdownOption;
use Gdoox\Http\Requests;
use Gdoox\Http\Controllers\Controller;
use Gdoox\Models\NavigationMenu;
use Illuminate\Support\Facades\Route;

class PositionInCompanyController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    private $language;
    public function __construct(){
			if (session()->has('app_language')) {
				//
			}else{
				session(['app_language' => 'en']);
			}  		
        $this->language = session('app_language');
    }

    public function create(){
        try {
            $position = PositionInComapany::where('user_id', Auth::user()->id)->first();
            if(!empty($position)){
                return Redirect::route('position.edit', $position->id);
            }
            else {
                return Redirect::route('position.create');
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
            $fm_data = FieldMaster::where('title', '=', 'position')->where('lang','=', $this->language)->first();
            $tc = TermsAndCondition::where('title', 'personal_info')->where('lang',$this->language)->first();
            $position = PositionInComapany::where('user_id', Auth::user()->id)->first();
            
            $options = DropdownOption::where('name', 'position')->where('lang', $this->language)->first();
            foreach($options->options as $optionname){
                $option[$optionname] = $optionname;
            }
            
            return view('backend.dashboard.personal_profiles.position.edit',compact('nav_menu','route','fm_data', 'position', 'tc', 'option'));
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
                 if(DB::Collection('per_position_in_company')->update($request->all())){
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
