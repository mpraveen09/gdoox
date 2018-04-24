<?php

namespace Gdoox\Http\Controllers\backend\dashboard\business_info;

use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Gdoox\Http\Requests;
use Gdoox\User;
use Gdoox\SubUser;
use Gdoox\Models\DropdownOption;
use Gdoox\Models\BusinessPartner;
use Gdoox\Models\BusinessInfo;
use Gdoox\Models\BusinessEcommerceCompany;
use Gdoox\Models\EcomShops;
use Illuminate\Support\Facades\Validator;
use Gdoox\Models\FieldMaster;
use Illuminate\Support\Facades\Redirect;
use Gdoox\Http\Controllers\Controller;
use Gdoox\Models\ShareSite;
use Gdoox\Models\NavigationMenu;
use Illuminate\Support\Facades\Route;

class EcommerceSitesController extends Controller
{
      use \Gdoox\Helpers\backend\dashboard\RolesUsers;
      use \Gdoox\Helpers\backend\dashboard\ImageUpload;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
      
    private $language;
    public function __construct() {
        $this->language = session('app_language');
    }
    
    public function index(){ 
      if(Auth::user()){
        try {
                $term = 0;
                $admins = $networksites = array();
                $partners = array();
                $netpartners = array();
                
                $role = $this->getRoleName(Auth::user()->id);
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'CREATE E-COMMERCE SITE (CMS/DAM)')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();
                
                $fm_data = FieldMaster::where('title', '=', 'business_ecommerce_company')->where('lang','=', $this->language)->first();
                // Getting the Network Sites
                $network_sites = BusinessEcommerceCompany::Where('user_id','=', Auth::user()->id)->where('type','=','Company Network Site')->get();
                if(!empty($network_sites)){
                    foreach($network_sites as $network){
                        $networksites[] = $network->network_site;
                    }
                }
                
                $ecommerce_sites = BusinessEcommerceCompany::whereNotIn('slug',$networksites)->where('user_id','=', Auth::user()->id)->where('type','=','business')->paginate(25);
                $find_site_admins = BusinessEcommerceCompany::where('user_id','=', Auth::user()->id)->where('type','=','business')->get();
                
                
                foreach($find_site_admins as $key=>$findadmin){
                    $admins[$findadmin->slug][] = Auth::user()->username;
                    if(isset($findadmin->site_admin)){
                        foreach($findadmin->site_admin as $a){
                            $name = User::where('_id',$a)->first();
                            if(!in_array($name->username, $admins[$findadmin->slug])){
                                $admins[$findadmin->slug][] = $name->username;
                            }
                        }
                    }
                }
                
                $eco_system_sites = BusinessEcommerceCompany::Where('user_id','=', Auth::user()->id)->where('type','=','business_ecosystem')->paginate(25);
                $companies = BusinessInfo::Where('user_id','=',  Auth::user()->id)->where('type','=','business')->paginate(25);
                $site_partners = ShareSite::where('inviter_id','=',Auth::user()->id)->where('status','=','Shared')->get();
                $eco_system_admins = BusinessEcommerceCompany::Where('user_id','=', Auth::user()->id)->where('type','=','business_ecosystem')->get();
                
                foreach($eco_system_admins as $key=>$findadmin){
                    $admins[$findadmin->slug][] = Auth::user()->username;
                    if(isset($findadmin->site_admin)){
                        foreach($findadmin->site_admin as $a){
                            $name = User::where('_id',$a)->first();
                            if(!in_array($name->username, $admins[$findadmin->slug])){
                                $admins[$findadmin->slug][] = $name->username;
                            }
                        }
                    }
                }
                
                foreach ($site_partners as $value) {
                    if($value->type == 'Company Network'){
                        if(!in_array($value->invitee_id, $netpartners)){
                            $netpartners[] = $value->invitee_id;
                        }
                    }
                    else {
                        if(!in_array($value->invitee_id, $partners)){
                            $partners[] = $value->invitee_id;
                        }
                    }
                }
                
              // $com_partner = BusinessEcommerceCompany::whereIn('user_id', $partners)->project('ecomm_company_name','user_id','slug')->get();
                // Getting the Business Ecosystem Partners.
                $com_partner = BusinessPartner::where('inviter_id', Auth::user()->id)->where('status','Accepted')->where('type','Internal')->get();

                $markets = DropdownOption::where('name','market')->where('lang', $this->language)->first();
                foreach($markets->options as $marketname) {
                    $market[$marketname] = $marketname;
                }
                
                // Getting the Company Network Partners to whom the User has sent the Invite.
                $net_partners = BusinessPartner::where('inviter_id', Auth::user()->id)->where('type','Company Network')->where('status','Accepted')->get();
                
                // Getting the Company Network Partners who has sent invite to the User.

                $networkpartners = BusinessPartner::where('invitee_id', Auth::user()->id)->where('status','Accepted')->where('type','Company Network')->get();
                foreach ($networkpartners as $net){
                    if(!in_array($net->inviter_id, $netpartners)){
                        $netpartners[] = $net->inviter_id;
                    }
                }
                
                // Getting the Names of the Network Partners based on Ids in the $partners Array.
                $network_partner = BusinessEcommerceCompany::whereIn('user_id', $partners)->where('type','business')->get();

                // Conditions to Add Ecommerce site from the Index Page.
                $required = "*";
                if(!empty($_GET['company'])){
                    $ecom = $_GET['company'];
                    if($this->hasRole('multi-site-user') || $this->hasRole('ecosystem-user') || $this->hasRole('superadmin') || $this->hasRole('company-network-user')){
                        $term = 1;
                    }
                    else {
                        if(count($com_partner) >= 1) {
                            $term = 0;
                            return redirect()->back()->withErrors('You do not have permission to create more than one site.');
                        }
                        else {
                            $term = 1;
                        }
                    }
                }
                
                // Conditions to View and Edit the Ecommerce Site Values in the Index Page.
                if(!empty($_GET['id'])) {
                    $term = 2;
                    $ecompany =  BusinessEcommerceCompany::where('_id', $_GET['id'])->first();
                    $ecom = $ecompany->company;
                }
                
                // Conditions to Create a New Business Ecosystem Site.
                if(!empty($_GET['ecosystem'])){
                    $term = 3;
                    $fm_eco_data = FieldMaster::where('title', '=', 'business_ecosystem')->where('lang','=', $this->language)->first();
                    $company = BusinessInfo::where('user_id', Auth::user()->id)->lists('company_name');
                    $required = "*";
                    
                    foreach($company as $com){
                        $ecom[$com] = $com;
                    }
                }
                
                // Conditions to Edit the Business Ecosystem Site Details. 
                if(!empty($_GET['eco_sys_id'])){
                    $term = 4;
                    $company = BusinessInfo::where('user_id', Auth::user()->id)->lists('company_name');
                    foreach($company as $com){
                        $ecom[$com] = $com;
                    }
                    $eco_company =  BusinessEcommerceCompany::where('_id', $_GET['eco_sys_id'])->first();
                }

                return view('backend.dashboard.business_info.business_ecommerce_companies.index',compact('nav_menu','route','site_partners','com_partner','network_partner',
                'eco_system_sites','ecommerce_sites','companies', 'ecompany', 'fm_data', 'required','estores','site', 'market', 'ecom', 'term','admins','fm_eco_data','ecom','eco_company','network_sites','net_partners'));
                
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
         if(Auth::user()){
           try{
              $rules = array(
                'ecomm_company_name' => 'required|max:255|unique:business_ecommerce_companies',
                'policy_doc' => 'mimes:doc,docx,pdf'
                 );
              $validator = Validator::make($request->all(), $rules);

              if($validator->fails()){
                  return Redirect()->back()->withErrors($validator)->withInput($request->all());                        
              }
              else{
                   $data = $request->all();
                   if(!empty($data['policy_doc'])){
                      $path = Auth::user()->directory_path."/return_policy_docs/";
                      $permission = 0777;
                      $new_doc_name = "gdoox_".$data['slug']."_return_policy.";
                      $data['policy_doc'] = $this->upload($data['policy_doc'], $new_doc_name, $path, $permission, true);
                      $data['doc_path'] = $path;
                   }
                   
                  $company_id =  BusinessInfo::where('company_name', $data['company'])->first();
                  $data['company_id'] = $company_id->id;
                  $data['site_admin'] = [Auth::user()->id];
                  DB::collection('business_ecommerce_companies')->insert($data);
                  return Redirect::route('ecomm-index')->with('message', "E-commerce store created");                   
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
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
      try {
          $data= $request->all();
          $rules = array(
            'ecomm_company_name' => 'required|max:255',
            'policy_doc' => 'mimes:doc,docx,pdf'
             );
          $validator = Validator::make($request->all(), $rules);

          if($validator->fails()){
              return Redirect()->back()->withErrors($validator)->withInput($request->all());                        
          }
          else {
            if(!empty($data['policy_doc'])){
               $path = Auth::user()->directory_path."/return_policy_docs/";
               $permission = 0777;
               $new_doc_name = "gdoox_".$data['slug']."_return_policy.";
               $data['policy_doc'] = $this->upload($data['policy_doc'], $new_doc_name, $path, $permission, true);
               $data['doc_path'] = $path;
            }
           $save = BusinessEcommerceCompany::where('_id', $id)->where('type', 'business')->update($data,  array('upsert' => false));
          // var_dump($save);
           if($save){
                return Redirect::route('ecomm-index')->with('message',"Your e-store updated");
            }
            else {
                return Redirect::route('ecomm-index')->with('message',"some error");
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
/*
 * Exception
 */
    public function ExceptionHandle($e){
          $error = "An error occured. ".
            "Line Number: ".$e->getLine()." ".
            "File Name: ".$e->getFile()." ".
            "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
    }
}