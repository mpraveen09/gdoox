<?php

namespace Gdoox\Http\Controllers\backend\dashboard;

use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Gdoox\Models\FieldMaster;
use Gdoox\Models\PersonalSiteDetail;

use Gdoox\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Gdoox\Http\Controllers\Controller;
use Gdoox\Models\NavigationMenu;

//  This is the controller which is created according to new Requirement created by Mukesh.
//  The Old one is PersonalSitesController.

class UserOtherInfoController extends Controller {
    use  \Gdoox\Helpers\backend\dashboard\RolesUsers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index() {
        
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
                list($route, $nav_menu) = $this->navigationTabs();
                
                $check= PersonalSiteDetail::where('user_id', $userid)->first();
                if(!empty($check)) {
                   return Redirect::route('other-info-edit', $userid);
                }
                else {
                    $fm_data = FieldMaster::where('title', '=', 'personal_sites_new')->first();
                    return view('backend.dashboard.other_info.create',compact('fm_data','route','nav_menu'));
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
        try{
            if(Auth::user()){
                $userid= Auth::id();
                $request = Request::all();

                $check= PersonalSiteDetail::where('user_id',$userid)->first();
                if(!empty($check)){
                    $check->other_info=$request;
                    if($check->save()) {
                            Session::flash('message', 'Dear User, Your Information has been Updated Successfully!');
                            return Redirect::route('other-info-edit',$userid);
                    }
                    else {
                           return Redirect('dashboard/other_info/create')->with('message','The Information could not be saved! Please try again')->withInput(Request::all());  
                    }
                }
                else {
                        $data= new PersonalSiteDetail();
                        $data->user_id= $userid;
                        $data->other_info=$request;
                        $data->type= 'personal';

                        if($data->save()) {
                                Session::flash('message', 'Dear User, Your Information has been saved Successfully!');
                                return Redirect::route('other-info-edit',$userid);
                        }
                        else {
                               return Redirect('dashboard/other_info/create')->with('message','The Information could not be saved! Please try again')->withInput(Request::all());  
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
        try {
            $lang = session('app_language');
            list($route, $nav_menu) = $this->navigationTabs();
            $fm_data = FieldMaster::where('title', '=', 'personal_sites_new')->where('lang',$lang)->first();

            $info = PersonalSiteDetail::where('user_id','=',$id)->project('other_info')->first();
            return view('backend.dashboard.other_info.edit',compact('fm_data','info','route','nav_menu'))->with('id',$id);
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
        try {
            $request = Request::all();
            $check = PersonalSiteDetail::where('user_id',$id)->first();
            if(!empty($check)){
                $check->other_info=$request;
                $check->type= 'personal';
                if($check->save()) {
                    Session::flash('message', 'Dear User, Your Information has been Updated Successfully!');
                    return Redirect::route('other-info-create');
                }
                else {
                    return Redirect('dashboard/other_info/edit')->with('message','The Information could not be saved! Please try again')->withInput(Request::all());  
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
