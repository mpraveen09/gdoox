<?php

namespace Gdoox\Http\Controllers\backend\dashboard;

use DB;
use Auth;
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

class UserAboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        try{
            if(Auth::user()){
                $userid= Auth::id();
                $check= PersonalSiteDetail::where('user_id',$userid)->first();
                $fm_data = FieldMaster::where('title', '=', 'personal_sites_new')->first();
                if(!empty($check)){
                   return Redirect::route('personal-about-us-edit',$userid);
                }
                else
                {
                    return view('backend.dashboard.about_us.create',compact('fm_data'));
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

                $rules = array(
                    'about_us'=>'required|min:5',
                    );

                $validator = Validator::make(Request::all(), $rules);

                if ($validator->fails()) {
                    return Redirect('dashboard/about_us/create')->withErrors($validator)->withInput(Request::all());   
                }
                else {

                    $check= PersonalSiteDetail::where('user_id',$userid)->first();
                    if(!empty($check)){
                        $check->about_us=$request;
                        $check->type='personal';
                        if($check->save()) {
                                Session::flash('message', 'Dear User, Your Information has been Updated Successfully!');
                                return Redirect::route('general-info-edit');
                        }
                        else {
                               return Redirect('dashboard/about_us/create')->with('message','The Information could not be saved! Please try again')->withInput(Request::all());  
                        }
                    }
                    else{
                        $data= new PersonalSiteDetail();
                        $data->user_id= $userid;
                        $data->about_us=$request['about_us'];
                        $data->type='personal';
                        if($data->save()) {
                                Session::flash('message', 'Dear User Your Information has been saved Successfully! We will contact you soon. Thanks');
                                return Redirect::route('general-info-create');
                        }
                        else {
                               return Redirect('dashboard/about_us/create')->with('message','The Information could not be saved! Please try again')->withInput(Request::all());  
                        }
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
    public function edit($userid){
        try{
            if(Auth::user()){
                $fm_data = FieldMaster::where('title', '=', 'personal_sites_new')->first();
                $info= PersonalSiteDetail::where('user_id','=',$userid)->first();

                return view('backend.dashboard.about_us.edit',compact('fm_data','info'))->with('userid',$userid);
            }
            else{
              return redirect('auth/login')->with('message',"Please Login to Add Information!"); 
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
    public function update($userid){
        try{
        $request= Request::all();
        $rules = array(
                'about_us'=>'required'
                );

            $validator = Validator::make(Request::all(), $rules);

            if ($validator->fails()) {
                return Redirect('dashboard/about_us/edit')->withErrors($validator)->withInput(Request::all());   
            }
            else
            {
                $check= PersonalSiteDetail::where('user_id',$userid)->first();
                if(!empty($check))
                {
                    $check->about_us = $request['about_us'];
                    $check->type='personal';
                    if($check->save()) {
                            Session::flash('message', 'Dear User, Your Information has been Updated Successfully!');
                            return Redirect::route('personal-about-us-create');
                    }
                    else {
                           return Redirect('dashboard/about_us/edit')->with('message','The Information could not be saved! Please try again')->withInput(Request::all());  
                    }
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
    
    public function errorMessage($e){
            $error = "An error occured. ".
                "Line Number: ".$e->getLine()." ".
                "File Name: ".$e->getFile()." ".
                "Error Description: ".$e->getMessage(); 
            return $error;
    }
}
