<?php

namespace Gdoox\Http\Controllers\backend\dashboard;

use Illuminate\Http\Request;

use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Gdoox\Models\FieldMaster;
use Gdoox\Models\PersonalSiteDetail;
use Gdoox\Models\BusinessEcommerceCompany;

use Gdoox\Http\Requests;
 use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Gdoox\Http\Controllers\Controller;
use Gdoox\Models\NavigationMenu;
use Illuminate\Support\Facades\Route;

class UserPersonalSitesController extends Controller {
    use  \Gdoox\Helpers\backend\dashboard\RolesUsers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    private $language;
    public function __construct() {
		if (session()->has('app_language')) {
			//
		}else{
			session(['app_language' => 'en']);
		}  		
        $this->language = session('app_language');
    }
    
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
                $required="*";
                $userid = Auth::user()->id;
                
                $role = $this->getRoleName(Auth::user()->id);
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'CREATE PERSONAL SITE')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();
                
                $fm_data=  FieldMaster::where('title', 'personal_sites')->where('lang',$this->language)->first(); 
                $site_info = PersonalSiteDetail::where('user_id', $userid)->first();
                if(!empty($site_info)){
                    return Redirect::route('create-personal-site-edit',$userid);
                   //  return view('backend.dashboard.user_personal_sites.edit',compact('fm_data','required','site_info'))->with('userid',$userid); 
                }
                else {
                    return view('backend.dashboard.user_personal_sites.create',compact('fm_data','required','nav_menu','route'))->with('userid',$userid);
                }
            }
            else  {
                return redirect('auth/login')->with('message',"Please Login!"); 
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
        try {
            if(Auth::user()){
                    $userid = Auth::user()->id;
                    $data = $request->all();
                    
                    $rules = array(
                        'site_name' => 'required|max:150|unique:business_info',
                        'slug' => 'required|max:100'
                     );
                    
                    $validator = Validator::make($request->all(), $rules);

                    if($validator->fails()){
                        return Redirect()->back()->withErrors($validator)->withInput($request->all());                        
                    }
                    else {
                        if(isset($data['slug'])) {
                            $check_site_bi = PersonalSiteDetail::where('slug','=',$data['slug'])->first();
                            if(!empty($check_site_bi)  && ( $check_site_bi->user_id !== $userid  )){
                                return Redirect::route('create-personal-site-edit',$userid)
                                      ->with('message', "The Name has already been Taken. Please Enter a different Name")
                                      ->withInput($request->all()); 
                            }

                            $check_site_bec = BusinessEcommerceCompany::where('slug','=',$data['slug'])->first();
                            if(!empty($check_site_bec)){
                              return Redirect::route('create-personal-site-edit',$userid)
                                      ->with('message', "The Name has already been Taken. Please Enter a different Name")
                                      ->withInput($request->all());            
                            }
                            
                            $sitedetail = PersonalSiteDetail::where('user_id', Auth::user()->id)->first();
                            if(!empty($sitedetail)){
                                $sitedetail->status = 1;
                                $sitedetail->type= 'personal';
                                $sitedetail->site_name = $data['site_name'];
                                $sitedetail->slug = $data['slug'];
                                if($sitedetail->save()){
                                    return Redirect::route('create-personal-site-edit',$userid)
                                        ->with('message', "The Site Name has has been Updated!");
                                }
                                else {
                                    return Redirect::route('create-personal-site-create')
                                        ->with('message', "Something went wrong! Could not be updated. Please try Again Later");
                                }
                            }
                            else{
                                $new_data = new PersonalSiteDetail();
                                $new_data->status = 1;
                                $new_data->user_id = $userid;
                                $new_data->type= 'personal';
                                $new_data->site_name = $data['site_name'];
                                $new_data->slug = $data['slug'];
                                if($new_data->save()){
                                    return Redirect::route('create-personal-site-edit',$userid)
                                        ->with('message', "The Site Name has has been Updated!");
                                }
                                else{
                                    return Redirect::route('create-personal-site-create')
                                        ->with('message', "Something went wrong! Could not be updated. Please try Again Later");
                                }
                            }
                        } 
                    }    
                }
            else {
              return redirect('auth/login')->with('message',"You must be login!"); 
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
        try {
            $required="*";
            $role = $this->getRoleName(Auth::user()->id);
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'CREATE PERSONAL SITE')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
                
            $site_info = PersonalSiteDetail::where('user_id', $userid)->first();
            
            $fm_data=  FieldMaster::where('title', 'personal_sites')->where('lang', $this->language)->first(); 
            return view('backend.dashboard.user_personal_sites.edit',compact('fm_data','required','site_info','nav_menu','route'))->with('userid', $userid);
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
    public function update(Request $request, $userid){
    try{
        if(Auth::user()){
          $data = $request->all();
                   
          if(isset($data['slug'])){
              $rules = array('site_name' => 'required|max:255|unique:business_info',);
              $validator = Validator::make($request->all(), $rules);
              if($validator->fails()){
                  return Redirect()->back()->withErrors($validator)->withInput($request->all());                        
              }

              $check_site_bi = PersonalSiteDetail::where('slug','=',$data['slug'])->first();
              if(!empty($check_site_bi)  && ( $check_site_bi->user_id !== $userid  )){
                return Redirect::route('create-personal-site-edit',$userid)
                        ->with('message', "The Name has already been Taken. Please Enter a different Name")
                        ->withInput($request->all()); 
              }

              $check_site_bec = BusinessEcommerceCompany::where('slug','=',$data['slug'])->first();
              if(!empty($check_site_bec)){
                return Redirect::route('create-personal-site-edit',$userid)
                        ->with('message', "The Name has already been Taken. Please Enter a different Name")
                        ->withInput($request->all());            
              }

              $new_data = PersonalSiteDetail::where('user_id','=', $userid)->first();
              $new_data->status = 1;
              $new_data->type= 'personal';
              $new_data->site_name = $data['site_name'];
              $new_data->slug = $data['slug'];
              if($new_data->save()){
                  return Redirect::route('create-personal-site-edit',$userid)
                      ->with('message', "The Site Name has has been Updated!");
              }
              else {
                  return Redirect::route('create-personal-site-edit',$userid)
                    ->with('message', "Something went wrong! Could not be updated. Please try Again Later");
              }
          }
        }
        else {
            return redirect('auth/login')->with('message',"You must be login!"); 
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
