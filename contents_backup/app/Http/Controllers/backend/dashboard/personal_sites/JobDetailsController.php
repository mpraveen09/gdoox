<?php

namespace Gdoox\Http\Controllers\backend\dashboard\personal_sites;

use Illuminate\Http\Request;
use DB;
use Gdoox\Models\FieldMaster;
use Gdoox\Models\PersonalSiteDetail;
use Gdoox\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Gdoox\Models\DropdownOption;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Gdoox\Http\Controllers\Controller;
use Gdoox\Models\NavigationMenu;

class JobDetailsController extends Controller {
    use  \Gdoox\Helpers\backend\dashboard\RolesUsers;
    /**
     * Show the form for creating a new resource.
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
    
    public function create(){
        try {
                $required="*";
                $org_cat = array();
                list($route, $nav_menu) = $this->navigationTabs();
                $jobdetails = PersonalSiteDetail::where('user_id', Auth::user()->id)->first();
                
                if(!empty($jobdetails->job_details)){        
                    return Redirect::route('jobdetail.edit',$jobdetails->user_id);
                }
                
                $fm_data = FieldMaster::where('title', 'job_details')->where('lang', $this->language)->first();
                
                $positions = DropdownOption::where('name','position')->where('lang', $this->language)->first(); 
                foreach($positions->options as $positionname){
                    $position[$positionname] = $positionname;
                }
                
                // $organizations = DropdownOption::where('name','organization')->where('lang','en')->first();
                
                $organizations = DropdownOption::where('name','organization_type')->where('parent','')->where('lang', $this->language)->first(); 
                foreach($organizations->options as $organizationname){
                    $organization[$organizationname] = $organizationname;
                }

           return view('backend.dashboard.personal_sites.job_details.create',compact('fm_data','required','jobdetails','position', 'organization','org_cat','route','nav_menu'));
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
      try {
            $data = $request->all();
            $jobdetails = array();
            $i = 1;
            $j = 0;
           
            $jobdetails[0]['company_name'] = $data['company_name'];
            $jobdetails[0]['from'] = $data['from'];
            $jobdetails[0]['to'] = $data['to'];
            $jobdetails[0]['org_type'] = $data['org_type'];
            $jobdetails[0]['org_category'] = $data['org_category'];
            $jobdetails[0]['position'] = $data['position'];
           
            if(!empty($data['old_company_name'])){
                foreach($data['old_company_name'] as $value){
                    $jobdetails[$i]['company_name'] = $value;
                    $jobdetails[$i]['from'] = $data['old_from'][$j];
                    $jobdetails[$i]['to'] = $data['old_to'][$j];
                    $jobdetails[$i]['org_type'] = $data['old_org_type'][$j];
                    $jobdetails[$i]['org_category'] = $data['old_org_category'][$j];
                    $jobdetails[$i]['position'] = $data["old_position_".$i];
                    $i++;
                }
            }
            
                       
            $data['user_id'] = Auth::user()->id;
            $details['type'] = 'personal';
            $details['job_details'] = $jobdetails;
            
            DB::Collection('personal_site_details')->where('user_id',Auth::user()->id)->update($details,['upsert'=>true]);
            
            return Redirect::route('jobdetail.edit',$data['user_id'])->with('message', "Your job details saved.");
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
      try{
            $required="*";
            $org_cat = array();
            $orgtype = array();
            $jobdetails = PersonalSiteDetail::where('user_id', Auth::user()->id)->first();
            list($route, $nav_menu) = $this->navigationTabs();
            
            $fm_data = FieldMaster::where('title', 'job_details')->where('lang', $this->language)->first();
            $positions =  DropdownOption::where('name','position')->where('lang', $this->language)->first();
            foreach($positions->options as $positionname){
                $position[$positionname] = $positionname;
            }
            
            $orgcat = DropdownOption::where('parent', $jobdetails->job_details[0]['org_type'])->where('lang', $this->language)->first();
            if(!empty($orgcat)){
                foreach($orgcat->options as $orgname){
                    $orgtype[$orgname] = $orgname;
                }
            }
            else {
                $orgtype['no_categories'] = "No Available Categories";
            }
            
            $organizations = DropdownOption::where('name','organization_type')->where('lang', $this->language)->first();
            foreach($organizations->options as $organizationname){
                $organization[$organizationname] = $organizationname;
            }
            
            return view('backend.dashboard.personal_sites.job_details.edit',compact('fm_data','required','jobdetails','position','organization','org_cat','orgtype','route','nav_menu'));
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
    public function update(Request $request){
      try{
            $data = $request->all();
            $jobdetails = array();
            $i = 1;
            $j = 0;
           
            $jobdetails[0]['company_name'] = $data['company_name'];
            $jobdetails[0]['from'] = $data['from'];
            $jobdetails[0]['to'] = $data['to'];
            $jobdetails[0]['org_type'] = $data['org_type'];
            $jobdetails[0]['org_category'] = $data['org_category'];
            $jobdetails[0]['position'] = $data['position'];
           
            foreach($data['old_company_name'] as $value){
                $jobdetails[$i]['company_name'] = $value;
                $jobdetails[$i]['from'] = $data['old_from'][$j];
                $jobdetails[$i]['to'] = $data['old_to'][$j];
                $jobdetails[$i]['org_type'] = $data['old_org_type'][$j];
                $jobdetails[$i]['org_category'] = $data['old_org_category'][$j];
                $jobdetails[$i]['position'] = $data["old_position_".$i];
                $i++;
            }
              
            $details['job_details'] = $jobdetails;
            $data['user_id'] = Auth::user()->id;
            $details['type'] = 'personal';

            // echo"<pre>";print_r($details); die;
            DB::Collection('personal_site_details')->where('user_id',Auth::user()->id)->update($details,['upsert'=>true]);

            return Redirect::route('jobdetail.edit')->with('message', "Your job details saved.");
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
    
    public function getOrganizationCategory(Request $request){
        if(Auth::user()){
            $data = $request->all();
            $orgtype = array();
            $i = 0;
            $organizations = DropdownOption::where('parent',$data['org_type'])->where('lang', $this->language)->first();
            if(!empty($organizations)){
                foreach($organizations->options as $organizationname){
                    $orgtype[$i]['org_name'] = $organizationname;
                    $i++;
                }
            }
            else{
                $orgtype[$i]['org_name'] = "No Available Categories";
            }
 
            return json_encode($orgtype);
        }
    }
}
