<?php

namespace Gdoox\Http\Controllers\backend\dashboard;

use Illuminate\Http\Request;
use Gdoox\Http\Controllers\Controller;
use Gdoox\Models\UserLanguagePreference;
use Gdoox\Helpers\UUID;
use Illuminate\Support\Facades\Auth;


class WebApplicationLangController extends Controller {
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
  
    /*
     * Help data 
     */
    public function setLanguage(Request $request){

            $request->session()->forget('app_language');
            session(['app_language' => $request->lang]);
            $cookie_id = $_COOKIE['gdoox_global_val'];

            if(Auth::user()){
                $data = UserLanguagePreference::where('user_id', Auth::user()->id)->orWhere('cookie_id', $cookie_id)->first();
                if(!empty($data)){
                    $data->language = $request->lang;
                    $data->user_id = Auth::user()->id;
                    $data->save();
                    if($request->session()->has('app_language')){
                        return ['success' => true];
                    }
                    else {
                        return ['success' => false];
                    }
                }
                else {
                    $data = new UserLanguagePreference();
                    $data->user_id = Auth::user()->id;
                    $data->language = $request->lang;
                    $data->cookie_id = $cookie_id;
                    $data->save();
                    if($request->session()->has('app_language')){
                        return ['success' => true];
                    }
                    else {
                        return ['success' => false];
                    }
                }
            }
            else {
                if(!empty($cookie_id)){
                    $data = UserLanguagePreference::where('cookie_id', $cookie_id)->first();
                    if(!empty($data)){
                        $data->language = $request->lang;
                        $data->save();
                        if($request->session()->has('app_language')){
                            return ['success' => true];
                        }
                        else {
                            return ['success' => false];
                        }
                    }
                }
                else {
                    $timestamp = time();
                    $cookie_value = UUID::v4() . "-" . $timestamp;
                    setcookie('gdoox_global_val', $cookie_value, time() + (86400 * 30), "/");
                    $data = new UserLanguagePreference();
                    $data->user_id = '';
                    $data->language = $request->lang;
                    $data->cookie_id = $cookie_id;
                    $data->save();
                    if($request->session()->has('app_language')){
                        return ['success' => true];
                    }
                    else {
                        return ['success' => false];
                    }
                }
            }
            
            
    }
/*
 * Exception Handling
 */
    public function errorMessage($e){
        $error = "An error occured. ".
            "Line Number: ".$e->getLine()." ".
            "File Name: ".$e->getFile()." ".
            "Error Description: ".$e->getMessage(); 
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
    }
}
