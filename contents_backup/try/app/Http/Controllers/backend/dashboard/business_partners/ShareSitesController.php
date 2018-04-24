<?php

namespace Gdoox\Http\Controllers\backend\dashboard\business_partners;

use DB;
use Auth;
use Gdoox\User;
use Gdoox\Http\Requests;
use Illuminate\Http\Request;
use Gdoox\Models\ShareSite;
use Gdoox\Models\InviteUser;
use Gdoox\Models\FieldMaster;
use Gdoox\Models\BusinessInfo;
use Illuminate\Support\Facades\URL;
use Gdoox\Models\BusinessPartner;
use Illuminate\Support\Facades\Mail;
use Gdoox\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Gdoox\Models\BusinessEcommerceCompany;
use Gdoox\Models\NavigationMenu;
use Illuminate\Support\Facades\Route;

class ShareSitesController extends Controller
{
  use \Gdoox\Helpers\backend\dashboard\RolesUsers;
  use \Gdoox\Helpers\backend\dashboard\HelperFunctions;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * Code written By Sanjay Singh Samwant.
     */
    public function index(){
        if(Auth::user()){
            $inviter_name = array();
            $invitee_id = $inviter_id = '';
            $inviter_companies = array();
           
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('parent', '36')->where('group','business_ecosystem')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
            
            $sharesites = ShareSite::where('inviter_id', Auth::user()->id)->where('status','Shared')->where('request_type','=','join')->get();
            
            if(count($sharesites)){
                foreach ($sharesites as $values){
                    $site['company_name'] = $this->Company($values->siteslug); 
                    $site['share_with'] = $this->GetUserName($values->inviter_id);
                    $sites[] = $values;
                }
            }

            $partnerusers = BusinessPartner::where('status', 'Accepted')
                ->where('inviter_id', Auth::user()->id)
                ->where('request_type','=','join')->get();

            if(count($partnerusers)){
                foreach($partnerusers as $user){
                    $inviter_companies[$this->userCompanies($user->inviter_id)] = $this->userCompanies($user->inviter_id);  
                    $inviter_id = $user->inviter_id;
                    $inviter_name[$user->inviter_id] = $this->GetUserName($user->inviter_id);
                    $invitee_id = $user->invitee_id;
                    $request_type = $user->request_type;
                 }
                $e_sites = BusinessEcommerceCompany::where('user_id', Auth::user()->id)->where('type','!=','business_ecosystem')->where('type','!=','Company Network Site')->project('slug', 'ecomm_company_name')->get();
                if(!empty($e_site)){
                    $required="*";
                    return view('backend.dashboard.business_partners.share_sites.index', compact('nav_menu','route','invitee_id', 'inviter_id', 'inviter_name', 'inviter_companies', 'e_sites','required','sharesites','sites','request_type', 'partnerusers'));
                }
                else {
                    return redirect()->back()->withErrors("You don't have site, please create site");
                }
            }
            
  //-------------------------------Without Request type ------------------
            try {
                
                $sharesites = ShareSite::where('invitee_id', Auth::user()->id)->where('status','Shared')->where('type','Business Ecosystem')
                    ->where('request_type','!=','partner')->where('request_type','!=','join')->get();

                $sites = array();
                if(count($sharesites)){
                    foreach ($sharesites as $site){
                        $site['company_name'] = $this->Company($site->siteslug); 
                        $site['share_with'] = $this->GetUserName($site->inviter_id);
                        $sites[] = $site;
                    }
                }
                    
//                    echo "<pre>";
//                    print_r($site);
//                    print_r($sites);
//                    exit;
                    
                    $partnerusers = BusinessPartner::where('status', 'Accepted')->where('invitee_id', Auth::user()->id)->where('ecosystem_name', 'exists', true)
                             ->where('request_type','!=','partner')->where('request_type','!=','join')->get(); 
                    
                    
                     $required = "*";
                     if(count($partnerusers)){
                        foreach($partnerusers as $user){
                            $inviter_companies = $this->userCompanies($user->inviter_id);  
                            $inviter_id = $user->inviter_id;
                            $inviter_name[$user->inviter_id] = $this->GetUserName($user->inviter_id);
                            $invitee_id = $user->invitee_id;
                         }
                      }
                      
                      $e_sites = BusinessEcommerceCompany::where('user_id', Auth::user()->id)
                            ->where('type', '!=', 'business_ecosystem')->where('type','!=','Company Network Site')->project('slug', 'ecomm_company_name')->get();
                      
                      if(empty($e_sites)){
                            return redirect()->back()->withErrors("You don't have site, please create site");
                      }
                      return view('backend.dashboard.business_partners.share_sites.index', compact('nav_menu','route','invitee_id', 'inviter_id', 'inviter_name', 'inviter_companies','e_sites','required','sharesites','sites','partnerusers'));
                  }
            catch (\Exception $e){
                $error = "An error occured. ".
                    "Line Number: ".$e->getLine()." ".
                    "File Name: ".$e->getFile()." ".
                    "Error Description: ".$e->getMessage();
                  return view('errors.custom_error')->withErrors($error);
            }
           }
        else{
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
      try {
            $sharedata = $request->all();
            $sharesites = ShareSite::where('invitee_id', $request->invitee_id)
                ->where('inviter_id', $request->inviter_id)
                ->where('siteslug',$sharedata['siteslug'])->where('type','=','Business Ecosystem')->first();
        
            if(!empty($sharesites) && $sharesites->status == "Shared"){
                return redirect()->back()->withErrors("You can not share same site again. Please choose another site or create another e-commerce site.");
            }
            elseif(!empty($sharesites) && $sharesites->status == "Unshared"){
                DB::Collection('share_sites')->update(['status' => 'Shared']);
                return Redirect::route('invited-business-partners.list_products', [$sharedata['siteslug'], $sharedata['inviter_id']])->with('message','Site shared.');
            }
            else {
                $sharedata['type'] = 'Business Ecosystem';
                $sharedata['status'] = 'Shared';
                $sharedata['message'] = $sharedata['message'];
                $sharedata['inviter_name'] =  $this->GetUserName($sharedata['inviter_id']);
                DB::Collection('share_sites')->insert($sharedata);
                return Redirect::route('invited-business-partners.list_products', [$sharedata['siteslug'], $sharedata['inviter_id']])->with('message','Site shared.');
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
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
      try {
            DB::Collection('share_sites')->where('siteslug',$id)->update(['status'=>'Unshared']);
            return Redirect::route('share.site.index');
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