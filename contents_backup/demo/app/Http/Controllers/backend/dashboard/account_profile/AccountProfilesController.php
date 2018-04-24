<?php

namespace Gdoox\Http\Controllers\backend\dashboard\account_profile;

use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\Validator;
use Gdoox\Models\FieldMaster;
use Gdoox\Models\BusinessInfo;
use Gdoox\Models\DropdownOption;
use Gdoox\Models\Categories;
use Gdoox\Models\BusinessEcommerceCompany;
use Gdoox\Models\BusinessAccountProfile;
use Gdoox\Http\Requests;
use Gdoox\Models\DropdownOptions;
 use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Gdoox\Http\Controllers\Controller;

class AccountProfilesController extends Controller
{
       /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    private $language;
    public function __construct() {
        $this->language = session('app_language');
    }
    
    public function edit(){
        try{
                $accountProfile = BusinessAccountProfile::where('user_id', Auth::user()->id)->where('type','account_profile')->first();
                $fm_data = FieldMaster::where('title', 'account_profile')->where('lang', $this->language)->first();
          
                $countries=  DropdownOption::where('name','countries')->where('type','drop_down')->where('lang', $this->language)->first();
                foreach($countries->options as $countryname) {
                    $country[$countryname] = $countryname;
                }
         
                $positions=  DropdownOption::where('name','position')->where('lang', $this->language)->first();
                foreach($positions->options as $positionname){
                    $position[$positionname]=$positionname;
                }
                $languages=DropdownOption::where('name','User Languages')->where('lang', $this->language)->first();
                //         print_r($languages); die;
                foreach($languages->options as $languagename){
                    $language[$languagename]=$languagename;
                }
                $positions= DropdownOption::where('name','position')->where('lang',$this->language)->first();  
                foreach($positions->options as $positionname){
                    $position[$positionname]=$positionname;
                }
                $required="*";
                if(!empty($accountProfile)){        
                     return view('backend.dashboard.account_profiles.edit',compact('fm_data','required','country','accountProfile','selected_cat','position','language','position'));
                }
                else {
                    return view('backend.dashboard.account_profiles.create',compact('fm_data','required','country','accountProfile','selected_cat','position','language','position'));
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
    public function update(Request $request){
        try{
            $data=$request->all();
            DB::Collection('business_account_profile')->where('user_id',Auth::user()->id)->where('type', 'account_profile')->update($data,['upsert'=>true]); 
            return Redirect::route('acc_profile.edit')->with('message', "Your account is created.");
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
