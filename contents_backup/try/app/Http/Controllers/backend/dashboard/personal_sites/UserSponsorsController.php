<?php

namespace Gdoox\Http\Controllers\backend\dashboard\personal_sites;

use DB;
use Auth;
use Illuminate\Support\Facades\Validator;
use Gdoox\Models\FieldMaster;
use Gdoox\Models\PersonalSiteDetail;
use Gdoox\Models\DropdownOptions;
use Gdoox\Models\Categories;
use Gdoox\Models\BusinessEcommerceCompany;
use Gdoox\Models\ReferencesandSponsors;

use Gdoox\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Gdoox\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

//  This is the controller which is created according to new Requirement created by Mukesh.
//  The Old one is PersonalSitesController.

class UserSponsorsController  extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        try{
            if(Auth::user()){
                $userid= Auth::id();
                $sponsors= array();

                $fm_data = FieldMaster::where('title', '=', 'personal_sites_new')->first();
                $check= ReferencesandSponsors::where('user_id','=',$userid)->where('type','=','sponsors')->first();

                if(!empty($check)){
                   return Redirect::route('sponsors-edit',$userid);
                }
                else {
                    return view('backend.dashboard.personal_sites.user_sponsors.create',compact('fm_data'));
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
    public function store(Request $request)
    {
        if(Auth::user())
        {
          try{
            $request = Request::all(); 
            $userid= Auth::id();
            $sponsors= array();
            $email_array= array();

            foreach ($request['name'] as $key=>$value) {
                $sponsors[$key]['name']= $value;
                $sponsors[$key]['surname']= $request['surname'][$key];
                $sponsors[$key]['email_address']= $request['email_address'][$key];
                $sponsors[$key]['status']= '1';
            }

            $data= new ReferencesandSponsors();

            $data->user_id = $userid;
            $data->type= 'sponsors';
            $data->sponsors = $sponsors;

            if($data->save()) {
                foreach($request['email_address'] as $key=>$val)
                {
                    Mail::send('emails.reference', [], function($message) use ($val)
                    {     
                        $message->from('mukesh@uginfosystems.com','Gdoox');
                        $message->to($val)->subject('Gdoox Mail');   
                    });
                }
                Session::flash('message', 'Your Sponsor Information has been saved Successfully!');
                return Redirect::route('sponsors-edit',$userid);
              }
              else {
                 return Redirect('sponsors-create')->with('message','The Information could not be saved! Please try again')->withInput(Request::all());  
              }
          }
          catch (\Exception $e){
              $error = "An error occured. ".
                              "Line Number: ".$e->getLine()." ".
                              "File Name: ".$e->getFile()." ".
                              "Error Description: ".$e->getMessage();
              return view('errors.custom_error')->withErrors($error);
          }
        }
        else
        {
            return redirect('auth/login')->with('message',"Please Login to Add Information!"); 
        }
    }
       /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($userid)
    {
      try{
        $requierd="*";  
        $fm_data = FieldMaster::where('title', '=', 'personal_sites_new')->first();
        
        $info= ReferencesandSponsors::where('user_id',$userid)->where('type','=','sponsors')->get();
        
        return view('backend.dashboard.personal_sites.user_sponsors.edit',compact('fm_data','info'))->with('userid',$userid);
      }
      catch (\Exception $e){
          $error = "An error occured. ".
                          "Line Number: ".$e->getLine()." ".
                          "File Name: ".$e->getFile()." ".
                          "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
      try{
        $request= Request::all(); 
        $data= ReferencesandSponsors::where('user_id', $id)->where('type','=','sponsors')->first();
       
        if(!empty($data))
        {
                $prev_sponsors= array();
                $new_sponsors= array();
                $sponsors= array();
                
                foreach ($request['prev_sponsor_name'] as $key=>$value) {
                    $prev_sponsors[$key]['name']= $value;
                    $prev_sponsors[$key]['surname']= $request['prev_sponsor_surname'][$key];
                    $prev_sponsors[$key]['email_address']= $request['prev_sponsor_email'][$key];
                    $prev_sponsors[$key]['status']= '1';
                }
               
                foreach ($request['name'] as $key=>$value) {
                    $new_sponsors[$key]['name']= $value;
                    $new_sponsors[$key]['surname']= $request['surname'][$key];
                    $new_sponsors[$key]['email_address']= $request['email_address'][$key];
                    $new_sponsors[$key]['status']= '1';
                }

                $sponsors= array_merge($prev_sponsors,$new_sponsors);
                
                $data->type= 'sponsors';
                $data->sponsors= $sponsors;
                if($data->save()) {
                foreach($request['email_address'] as $key=>$val)
                    {
                        Mail::send('emails.reference', [], function($message) use ($val)
                        {     
                            $message->from('mukesh@uginfosystems.com','Gdoox');
                            $message->to($val)->subject('Gdoox Mail');   
                        });
                        
                   }
                Session::flash('message', 'Your Sponsor Inforamation has been Saved Successfully!');
                return Redirect::route('sponsors-create');
            }
            else {
               return Redirect('sponsors-edit')->with('message','The Information could not be Updated! Please try again')->withInput(Request::all());  
            }
          }
      }
      catch (\Exception $e){
          $error = "An error occured. ".
                          "Line Number: ".$e->getLine()." ".
                          "File Name: ".$e->getFile()." ".
                          "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
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
