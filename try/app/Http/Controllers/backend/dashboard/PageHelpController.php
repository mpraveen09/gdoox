<?php

namespace Gdoox\Http\Controllers\backend\dashboard;

use Illuminate\Http\Request;
use Gdoox\Models\PageHelp;
use Gdoox\Http\Controllers\Controller;

class PageHelpController extends Controller {
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    
    public function store(Request $request){
      try {
        if($request->ajax()){
            $data = PageHelp::where('route_name','=', trim($request->route_name))->where('lang','=', trim($request->lang))->first();
            if(!empty($data)){
              $data->help_text = stripslashes($request->help_text);
              if($data->save()){
                    return ['success' => true];
              }
              else {
                   return ['success' => false];
              }
            }
            else
                {
                    if(!empty($request->lang)){
                        $lang = $request->lang;
                    }
                    else {
                        $lang = "en";
                    }
                    
                    $pagehelp = new PageHelp;
                    $pagehelp->route_name = $request->route_name;
                    $pagehelp->help_title = $request->help_title;
                    $pagehelp->help_text = $request->help_text;
                    $pagehelp->lang = $request->lang;
                    if($pagehelp->save()){
                         return ['success' => true, 'data' => $data];
                    }
                    else {
                        return ['success' => false];
                    }
//                    DB::collection('page_help')->where('route_name', $request->route_name)->where('lang', $lang)->update($data, ['upsert' => true]); 
                  // return ['success' => true, 'errors' => $errors];
            }
        }
      } catch (Exception $ex) {
            $errors = $this->errorMessage($e);
      }
    }
//    public function store(Request $request)
//    {
//        if(Auth::user()){
//          try{
//            if(!empty($request->lang)){
//              $lang = $request->lang;
//            }
//            else {
//              $lang = "en";
//            }
//            $data = ['route_name' => $request->route_name, 'help_title' => $request->help_title, 'help_text' => addslashes($request->help_text), 'lang' => $lang];
//            DB::collection('page_help')->where('route_name', $request->route_name)->where('lang', $lang)->update($data, ['upsert' => true]); 
//            
//            return redirect()->back();
////                    
////            if(!empty($_SERVER['HTTP_REFERER'])){
////              $refurl=$_SERVER['HTTP_REFERER'];
////            }else{
////              return redirect()->route($request->route_name);            
////            }
//          }
//          catch (Exception $e) {
//              $errors = $this->errorMessage($e);
//          }
//        }
//        else{
//             return redirect('auth/login')->with('message',"You must be login!"); 
//        }
//    }
    /*
     * Help data 
     */
    public function HelpData(Request $request){
      try{
        if($request->ajax()){
            $data = PageHelp::where('route_name', $request->route)->where('lang', $request->lang)->first();
            if(!empty($data)){
              $data->help_text = stripslashes($data->help_text);
              return ['success' => true, 'data' => $data];
            }
            else{
              $errors = ["No data found"];
              return ['success' => false, 'errors' => $errors];
            }
        }
      } catch (Exception $ex) {
              $errors = $this->errorMessage($e);
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
