<?php

namespace Gdoox\Http\Controllers\backend\dashboard\business_partners;

use DB;
use Illuminate\Support\Facades\Auth;
use Gdoox\User;
use Gdoox\Http\Requests;
use Illuminate\Http\Request;
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
use Gdoox\Models\Products;
use Gdoox\Models\ShareSite;
use Gdoox\Models\SharedProducts;
use Illuminate\Support\Facades\Route;
use Gdoox\Models\NavigationMenu;
use Gdoox\Models\DropdownOption;

class NetworkShareSitesController extends Controller
{
  use \Gdoox\Helpers\backend\dashboard\RolesUsers;
  use \Gdoox\Helpers\backend\dashboard\HelperFunctions;
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
                $partners = $companies = array();
   
                $role = $this->getRoleName(Auth::user()->id);
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'COMPANY NETWORK')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();
                
                $sharesites =  ShareSite::where('invitee_id', Auth::user()->id)->where('status','Shared')->where('type','=','Company Network')->get();
                
                $sites = array();
                if(count($sharesites)){
                    foreach ($sharesites as $site){
                        $site['company_name'] = $this->Company($site->siteslug); 
                        $site['share_with'] = $this->GetUserName($site->inviter_id);
                        $sites[] = $site;
                    }
                }
                
                $partnerusers = BusinessPartner::where('status', 'Accepted')->where('invitee_id', Auth::user()->id)->where('type','=','Company Network')->get();
                if(!empty($partnerusers)){
                    foreach($partnerusers as $users){
                        $partners[] = $users->inviter_id;
                    }
                }
                
                $partnercompanies = BusinessInfo::whereIn('user_id', $partners)->get();
                if(!empty($partnercompanies)){
                    foreach ($partnercompanies as $company){
                        $companies[$company->user_id] = $company->company_name;
                    }
                }

//                $userinfo = array();
//                if(count($partnerusers)){
//                    foreach($partnerusers as $user){
//                        $userinfo['company']= $this->userCompanies($user->inviter_id);  
//                        $userinfo['inviter_id'] = $user->inviter_id;
//                        $userinfo['inviter_name'] =  $this->GetUserName($user->inviter_id);
//                        $userinfo['invitee_id'] = $user->invitee_id;
//                     }
//                  }
                
                
//                 $required="*";
//                 if(count($partnerusers)){
//                    foreach($partnerusers as $user){
//                        $inviter_companies = $this->userCompanies($user->inviter_id);  
//                        $inviter_id = $user->inviter_id;
//                        $inviter_name[$user->inviter_id] =  $this->GetUserName($user->inviter_id);
//                        $invitee_id = $user->invitee_id;
//                     }
//                  }
                  
//                  $e_sites= BusinessEcommerceCompany::where('user_id', Auth::user()->id)
//                    ->where('type', 'Company Network')
//                    ->project('slug', 'ecomm_company_name')->get();
                  
//                    if(empty($e_sites)){
//                          return redirect()->back()->withErrors("You don't have site, please create site");
//                    }
                    
                  return view('backend.dashboard.business_partners.network_share_sites.index', compact('nav_menu','route','partnerusers','companies'));
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
                ->where('siteslug',$sharedata['siteslug'])->where('type','=','Company Network')->first();
        
            if(!empty($sharesites) && $sharesites->status == "Shared"){
                return redirect()->back()->withErrors("You have already shared this site with this Company Network. Please choose another site.");
            }
        
            else if(!empty($sharesites) && $sharesites->status == "Unshared"){
                DB::Collection('share_sites')->update(['status' => 'Shared']);
                return Redirect::route('list_my_site_products', [$sharedata['siteslug'], $sharedata['inviter_id']])->with('message','Your Site shared with the Network Company.');
            }
        
            else {
                $sharedata['status'] = 'Shared';
                $sharedata['type'] = 'Company Network';
                $sharedata['inviter_name'] =  $this->GetUserName($sharedata['inviter_id']);
                DB::Collection('share_sites')->insert($sharedata);
                return Redirect::route('list_my_site_products', [$sharedata['siteslug'], $sharedata['inviter_id']])->with('message','Your Site shared with the Network Company.');
            }
      }
      catch (\Exception $e) {
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
    public function update(Request $request, $slug){
      try {
            DB::Collection('business_partners')->where('company_site_slug', $slug)->where('invitee_id', Auth::user()->id)->update(['status'=>'Deny']);
            return Redirect::route('network.share.site.index')->with('message','The sites is Unshared Successfully');
      }
      catch (\Exception $e) {
          $error = "An error occured. ".
                          "Line Number: ".$e->getLine()." ".
                          "File Name: ".$e->getFile()." ".
                          "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
      }
    }
    
    public function listProducts($store_id, $inviter_id){
        if(Auth::user()){
          try {
                $userid = Auth::id();
                
                $role = $this->getRoleName(Auth::user()->id);
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'COMPANY NETWORK')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();
                
                $inviter_name = $this->GetUserName($inviter_id);            
                $list_products = Products::where('shopid','=',$store_id)->where('old_slug', 'exists', false)->paginate(25);
                $fm_data = FieldMaster::where('title', '=', 'personal_sites_new')->where('lang', $this->language)->first();

                $shared_products = SharedProducts::where('store_id','=',$store_id)->where('type','=','Company Network')->get();

                $shared_status = array();
                if(!empty($shared_products)) {
                    foreach($shared_products as $shared_products) {
                        $shared_status[$shared_products->product_id] = $shared_products->share_status;
                    }
                }
                
                return view('backend.dashboard.business_partners.network_share_sites.list_products',compact('fm_data','list_products','userid','store_id','inviter_id','shared_status', 'inviter_name','nav_menu','route'));
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
            return redirect('auth/login')->with('message',"Please Login to Add Information!"); 
        }
    }
    
    public function shareProduct(Request $request){ 
        $data = $request->all();
        $already_shared = array();
        $count_shared_products = 0;
        $count_unshare_product = 0;
        $i = 0;
        $j = 0;  
        
        $store_id = $data['store_id'];
        $invitee_id = Auth::user()->id;
        $inviter_id = $data['inviter_id'];
  
        if(isset($data['share_products'])){
            $check = SharedProducts::whereIn('product_id', $data['share_products'])->where('invitee_id','=', $invitee_id)->where('inviter_id', $inviter_id)->where('store_id', $store_id)->where('type','=','Company Network')->get();
            if(!empty($check)){
                foreach($check as $c){
                    $already_shared[] = $c->product_id;
                }
            }

            $not_shared_products = array_merge(array_diff($data['share_products'], $already_shared), array_diff($already_shared, $data['share_products'])); 

            $count_shared_products = count($not_shared_products);

            if(!empty($not_shared_products)){
                foreach($not_shared_products as $key=>$value){
                    $share= new SharedProducts();
                    $share->product_id = $value;
                    $share->invitee_id = $invitee_id;
                    $share->inviter_id = $inviter_id;
                    $share->store_id = $store_id;
                    $share->share_status='shared';
                    $share->type = 'Company Network';
                    $share->imported='no';
                    if($share->save()) {
                        $i++ ;
                    }  
                }  
            }
        }
        

        if(isset($data['unshare_products'])){
            if($data['type'] === 'Company Network'){
                $check = SharedProducts::whereIn('product_id', $data['unshare_products'])->where('invitee_id','=', $invitee_id)->where('inviter_id', $inviter_id)->where('store_id', $store_id)->where('type','=','Company Network')->get();
                
                $count_unshare_product =  $check->count();
                
                if(!empty($check)){
                    foreach($check as $val){
                        $val->share_status = 'unshared';
                        if($val->save()){
                            $j++;
                        }
                    }
                }
            }
        }
      
        if(($count_shared_products === $i) && ($count_unshare_product === $j)){
            return redirect()->route('list_my_site_products', array('slug'=>$store_id, 'id'=>$inviter_id))->with('message','Product Shared/Unshared Successfully');
        }
        else {
            return redirect()->route('list_my_site_products', array('slug'=>$store_id, 'id'=>$inviter_id))->with('message','Product could not Shared/Unshared. Please Try Again!');
        }  
    }
    
//    public function shareProduct(){
//        try {
//            if(Request::ajax()){
//                $data = Request::all();
//                $productid = $data['product_id'];
//                $inviteeid = $data['invitee_id'];
//
//                $check = SharedProducts::where('product_id','=',$productid)->where('invitee_id','=', $inviteeid)->where('type','=','Company Network')->first();
//              
//                if(!empty($check)) {
//                    $check->status='shared';
//                    if($check->save()){
//                        return 'shared';
//                    }
//                    else {
//                        return 'notshared';
//                    }
//                }
//                else
//                    {
//                        $share= new SharedProducts();
//                        $share->product_id = $productid;
//                        $share->invitee_id = $inviteeid;
//                        $share->inviter_id = $data['inviter_id'];
//                        $share->store_id = $data['store_id'];
//                        $share->type = 'Company Network';
//                        $share->status='shared';
//                        $share->imported='no';
//                            if($share->save()){
//                                return 'shared';
//                            }
//                            else {
//                                return 'notshared';
//                            }
//                    }
//            }
//        } 
//        catch (Exception $e) {
//              return Response::json ( array (
//                  'error' => true,
//                  'data' => $e
//              ), 200 );
//        } 
//    }
//    
//    public function unshareProduct(){
//        try {
//            if(Request::ajax()){
//                
//                $data= Request::all();
//                $productid = $data['product_id'];
//                $inviteeid = $data['invitee_id'];
//                
//                $unshared= SharedProducts::where('product_id','=',  $productid)->where('invitee_id','=', $inviteeid)->where('type','=','Company Network')->first();
//                
//                $unshared->status = 'unshared';
//                if($unshared->save()){
//                    return 'unshared';
//                }
//                else 
//                {
//                    return 'notunshared';
//                }
//            }
//        } 
//        catch (Exception $e) {
//              return Response::json ( array (
//                  'error' => true,
//                  'data' => $e
//              ), 200 );
//        } 
//    }
    
    public function shareThisProduct(){
        if(Auth::user()){
            try {
              $values= Request::all();
              $userid= Auth::id();
              $shopid= $values['shop_id'];
              $product_id= $values['product_id'];
              $fm_data = FieldMaster::where('title', '=', 'personal_sites_new')->first();
              
                $role = $this->getRoleName(Auth::user()->id);
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'COMPANY NETWORK')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();
              
              $check_site= ShareSite::where('siteslug','=',$shopid)->first();

              if(!empty($check_site)){
                  $sites = ShareSite::where('inviter_id','=',$userid)->get();
                  foreach($sites as $site){
                      $invited_sites[$site->siteslug] = $site->siteslug;
                  }

                  return view('site.list_shared_sites',compact('fm_data','invited_sites','shopid','product_id','nav_menu','route'));
              }
              else {
                  return redirect()->back()->with('message','This site has not been shared');
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
        else  {
             return redirect('auth/login')->with('message',"Please Login to Add Information!"); 
        }
    }
    
    public function storeSharedProduct(){
        
        $data = Request::all();
        $storeid = $data['store_id'];
        $product_id = $data['product_id'];
        $check = SharedProducts::where('store_id','=',$storeid)->where('product_id','=',$product_id)->first();
        
        if(empty($check)){
            $site_data = ShareSite::where('inviter_id','=',Auth::id())->where('siteslug','=',$storeid)->first();
            $share= new SharedProducts();
            $share->product_id = $product_id;
            $share->store_id = $storeid;
            $share->invitee_id = $site_data->invitee_id;
            $share->invitee_name = $site_data->invitee_name;
            $share->inviter_id = $site_data->inviter_id;
            $share->status='shared';
            $share->imported='no';
            if($share->save()){
                return redirect('/site/'.$storeid.'/show/'.$product_id)->with('message','Product Successfully Shared with the Site'); 
            }
            else {
               return redirect('/site/'.$storeid.'/show/'.$product_id)->with('message','Product Could not be shared! Please Try Again');
            }
        }
        else {
            return redirect('/site/'.$storeid.'/show/'.$product_id)->with('message','Product Already shared with this Site!');
        }   
    }
    
    public function viewSites(){
        if(Auth::user()){
            try {
                $userid = Auth::user()->id;
                $networks = array();
                $assigned = array();
                $admins = array();
                $partners = array();
                $term = 0;
                
                // Getting the Navigation Menus.
                $role = $this->getRoleName(Auth::user()->id);
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'COMPANY NETWORK')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();
                
                
                $fm_data = FieldMaster::where('title', '=', 'business_ecommerce_company')->where('lang','=', $this->language)->first();
               
                // Getting the already assigned Sites as Company Network Sites.
                $assigned_sites = BusinessEcommerceCompany::where('user_id','=', $userid)->where('type','=','Company Network Site')->get();
                if(!empty($assigned_sites)){
                    foreach($assigned_sites as $sites){
                        $assigned[] = $sites->network_site;
                    }
                }
                
                
                // Getting the Ecommerce Companies to Select then as Network Site
                $bcomcompanies = BusinessEcommerceCompany::whereNotIn('slug', $assigned)->where('user_id','=', $userid)->where('type','=','business')->get();
                if(!empty($bcomcompanies)){
                    foreach($bcomcompanies as $company){
                        $networks[$company->slug] = $company->slug;
                    }
                }

                // Getting the Site Admins
                $find_site_admins = BusinessEcommerceCompany::Where('user_id','=', Auth::user()->id)->where('type','=','business')->get();
                if(!empty($find_site_admins)){
                    foreach($find_site_admins as $key=>$findadmin){
                        $admins[$findadmin->slug][] = Auth::user()->username;
                        if(isset($findadmin->site_admin)){
                            foreach($findadmin->site_admin as $a){
                                if(!in_array($a, $admins)){
                                    $name = User::where('_id',$a)->first();
                                    $admins[$findadmin->slug][] = $name->username;
                                }
                            }
                        }
                    }
                }
                
                // Getting the Company Network Partners who has sent invite to the User.
                $networkpartners = BusinessPartner::where('invitee_id', Auth::user()->id)->where('status','Accepted')->get();
                if(!empty($networkpartners)){
                    foreach ($networkpartners as $net){
                        if(!in_array($net->inviter_id, $partners)){
                            $partners[] = $net->inviter_id;
                        }
                    }
                }
                // Getting the Names of the Network Partners based on Ids in the $partners Array.
                $network_partner = BusinessEcommerceCompany::whereIn('user_id', $partners)->where('type','business')->get();

                // Getting the Network Sites
                $network_sites = BusinessEcommerceCompany::Where('user_id','=', Auth::user()->id)->where('type','=','Company Network Site')->get();
                $companies = BusinessInfo::Where('user_id','=',  Auth::user()->id)->where('type','=','business')->where('status','Active')->get();
                
                // This part of the Code is executed when the User click on the Add New in the Form and show the form to add Site.
                $required="*";
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
                // To edit the Site Information
                if(!empty($_GET['site'])) {
                    $term = 2;
                    $ecompany =  BusinessEcommerceCompany::where('slug', $_GET['site'])->where('type','business')->first();
                    $ecom = $ecompany->company;
                }
                
                $markets = DropdownOption::where('name','market')->where('lang', $this->language)->first();
                foreach($markets->options as $marketname) {
                      $market[$marketname] = $marketname;
                }
                
                return view('backend.dashboard.business_partners.network_share_sites.assign_network_site',compact('networks','route','nav_menu','fm_data',
                'network_company','fm_data','assigned_site','network_sites','companies','admins','network_partner','required','term','ecom','market','ecompany'));
          }
          catch (\Exception $e) {
              $error = "An error occured. ".
                "Line Number: ".$e->getLine()." ".
                "File Name: ".$e->getFile()." ".
                "Error Description: ".$e->getMessage();
              return view('errors.custom_error')->withErrors($error);
          }
        }
        else {
            return redirect()->route('auth/login')->with('message','Please Login!');
        }
    }
    
    public function storeAssignedNetworkSite(Request $req){
        if(Auth::user()){
            $request = $req->all();
            //$checksite = BusinessEcommerceCompany::where('user_id', Auth::user()->id)->where('type','Company Network Site')->first();
            
//            if(empty($checksite)){
                $data = new BusinessEcommerceCompany();
                $data->user_id = Auth::user()->id;
                $data->type = 'Company Network Site';
                $data->network_site = $request['network_site'];
                
                if($data->save()){
                    return redirect()->route('company.network.assign.site')->with('message', 'Network Site Assigned Successfully.');
                }
                else {
                    return redirect()->back()->with('message','Network Site could not be assigned. Something Went Wrong! Please try Again');
                }
//            }
//            else {
//                $checksite->network_site = $request['network_site'];
//                if($checksite->save()){
//                    return redirect()->route('company.network.assign.site')->with('message', 'Network Site Changed Successfully.');
//                }
//                else {
//                    return redirect()->back()->with('message','Network Site could not be assigned. Something Went Wrong! Please try Again');
//                }
//            }
        }
        else {
            return redirect()->route('auth/login')->with('message','Please Login');
        }
    }
    
    public function addSite(Request $request){
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
          else {
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
              return Redirect::route('company.network.assign.site')->with('message', "Site created successfully");                   
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

    public function updateSite(Request $request){
      try {
          $data = $request->all();
          $id = $data['id'];
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
          
                if($save){
                       return Redirect::route('company.network.assign.site')->with('message',"Your e-store updated");
                 }
                 else {
                       return Redirect::route('company.network.assign.site')->with('message',"some error");
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
}