<?php

namespace Gdoox\Http\Controllers\backend\dashboard\business_info;

use DB;
use Gdoox\Models\BusinessInfo;
use Illuminate\Support\Facades\Auth;
use Gdoox\Models\BusinessVerificationLog;
use Gdoox\Http\Requests;
use Gdoox\Models\FieldMaster;
use Imagick;
use Gdoox\Models\DropdownOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Gdoox\Http\Controllers\Controller;
use Gdoox\Models\NavigationMenu;
use Illuminate\Support\Facades\Route;

class BusinessDetailsController extends Controller                               
{
    use \Gdoox\Helpers\backend\dashboard\ImageUpload;
    use \Gdoox\Helpers\backend\dashboard\RolesUsers;
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
        if(Auth::user()){
          try {
                $role = $this->getRoleName(Auth::user()->id);
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('menu','GDOOX PLATFORM MANAGEMENT TEAM')->where('user',$role)->where('lang','en')->get();            
                $route = Route::getCurrentRoute()->getName();

                $fm_data = FieldMaster::where('title', '=', 'business_info')->where('lang','=', $this->language)->first();
                $business_info = BusinessInfo::where('type','business')->paginate(25);
                return view('backend.dashboard.business_info.business_details.index',compact('fm_data', 'business_info','nav_menu','route'));
          }
          catch (\Exception $e){
              $error = "An error occured. ".
                    "Line Number: ".$e->getLine()." ".
                    "File Name: ".$e->getFile()." ".
                    "Error Description: ".$e->getMessage();
              return view('errors.custom_error')->withErrors($error);
          }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        if(Auth::user()){
          try {
                $role = $this->getRoleName(Auth::user()->id);
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('menu','GDOOX PLATFORM MANAGEMENT TEAM')->where('user',$role)->where('lang','en')->get();            
                $route = Route::getCurrentRoute()->getName();
                
                $fm_data = FieldMaster::where('title', '=', 'business_info')->where('lang', $this->language)->first();
                $business = BusinessInfo::where('_id', $id)->first();
                $verification_info = BusinessVerificationLog::where('company_id', $business->id)->first();
                
                return view('backend.dashboard.business_info.business_details.show',compact('business','fm_data','verification_info','nav_menu', 'route'));
          }
          catch (\Exception $e){
              $error = "An error occured. ".
                              "Line Number: ".$e->getLine()." ".
                              "File Name: ".$e->getFile()." ".
                              "Error Description: ".$e->getMessage();
              return view('errors.custom_error')->withErrors($error);
          }
        }
        else {
              return redirect('auth/login')->with('message',"You must be login!"); 
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
      try {
        $business=['status'=>'Active',
            'verify'=>'Verified',
          ];    
        $business_verify=['verification_check'=>'Yes',
            'checked_by'=>Auth::user()->id,
            'verification'=>true,
            ];
        DB::collection('business_info')->where('_id',$id)->update($business);
        DB::collection('business_verification_logs')->where('company_id', $id)->update($business_verify);
        
        return Redirect::route('business-details-index')->with('message','Company Verification done');
      }
      catch (\Exception $e){
          $error = "An error occured. ".
            "Line Number: ".$e->getLine()." ".
            "File Name: ".$e->getFile()." ".
            "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
      }
    }
}
