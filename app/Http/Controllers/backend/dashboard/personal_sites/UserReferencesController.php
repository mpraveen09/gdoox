<?php

namespace Gdoox\Http\Controllers\backend\dashboard\personal_sites;

use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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
use Gdoox\Models\NavigationMenu;

//  This is the controller which is created according to new Requirement created by Mukesh.
//  The Old one is PersonalSitesController.

class UserReferencesController  extends Controller {
    use  \Gdoox\Helpers\backend\dashboard\RolesUsers;
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user())
        {
          try{
            $userid= Auth::id();
            list($route, $nav_menu) = $this->navigationTabs();
            $fm_data = FieldMaster::where('title', '=', 'personal_sites_new')->first();

            $check= ReferencesandSponsors::where('user_id','=',$userid)->where('type','=','references')->first();

            if(!empty($check)){
               return Redirect::route('references-edit',$userid);
            }
            else {
                return view('backend.dashboard.personal_sites.user_references.create',compact('fm_data','nav_menu','route'));
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
                $references= array();
                $email_array= array();
 
                foreach ($request['name'] as $key=>$value) {
                    $references[$key]['name']= $value;
                    $references[$key]['surname']= $request['surname'][$key];
                    $references[$key]['email_address']= $request['email_address'][$key];
                    $references[$key]['status']= '1';
                }
                
                $data= new ReferencesandSponsors();
                
                $data->user_id = $userid;
                $data->type= 'references';
                $data->references = $references;

                if($data->save()) {
                    foreach($request['email_address'] as $key=>$val)
                    {
                        Mail::send('emails.reference', [], function($message) use ($val)
                        {     
                            $message->from('mukesh@uginfosystems.com','Gdoox');
                            $message->to($val)->subject('Gdoox Reference Mail');   
                        });
                    }
                    Session::flash('message', 'Your Reference Information has been saved Successfully!');
                    return Redirect::route('references-edit',$userid);
                }
                else {
                   return Redirect('references-create')->with('message','The Information could not be saved! Please try again')->withInput(Request::all());  
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
        $competency= array();
        list($route, $nav_menu) = $this->navigationTabs();
        $fm_data = FieldMaster::where('title', '=', 'personal_sites_new')->first();
        
        $info= ReferencesandSponsors::where('user_id',$userid)->where('type','=','references')->get();
        
        return view('backend.dashboard.personal_sites.user_references.edit',compact('fm_data','info','competency','nav_menu','route'))->with('userid',$userid);
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
        
        $data= ReferencesandSponsors::where('user_id', $id)->where('type','=','references')->first();
       
        if(!empty($data))
        {
                $prev_references= array();
                $new_references= array();
                $references= array();
                
                foreach ($request['prev_ref_name'] as $key=>$value) {
                    $prev_references[$key]['name']= $value;
                    $prev_references[$key]['surname']= $request['prev_ref_surname'][$key];
                    $prev_references[$key]['email_address']= $request['prev_ref_email_address'][$key];
                    $prev_references[$key]['status']= '1';
                }
               
                foreach ($request['name'] as $key=>$value) {
                    $new_references[$key]['name']= $value;
                    $new_references[$key]['surname']= $request['surname'][$key];
                    $new_references[$key]['email_address']= $request['email_address'][$key];
                    $new_references[$key]['status']= '1';
                }

                $references= array_merge($prev_references,$new_references);
                
                $data->type= 'references';
                $data->references= $references;
                if($data->save()) {
                foreach($request['email_address'] as $key=>$val)
                    {
                        Mail::send('emails.reference', [], function($message) use ($val)
                        {     
                            $message->from('mukesh@uginfosystems.com','Gdoox');
                            $message->to($val)->subject('Gdoox Reference Mail');   
                        });
                        
                   }
                Session::flash('message', 'Your Reference Inforamation has been Saved Successfully!');
                return Redirect::route('references-create');
            }
            else {
               return Redirect('references-edit')->with('message','The Information could not be Updated! Please try again')->withInput(Request::all());  
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
    
    public function navigationTabs(){
        $role = $this->getRoleName(Auth::user()->id);
        $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'CREATE PERSONAL SITE')->where('lang','en')->get();
        $route = Route::getCurrentRoute()->getName();
        return array($route, $nav_menu);
    }
}
