<?php

namespace Gdoox\Http\Controllers\backend\dashboard\business_partners;

use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Gdoox\Models\FieldMaster;
use Gdoox\Models\ShareSite;
use Gdoox\Models\Products;
use Gdoox\Models\SharedProducts;
use Gdoox\Models\BusinessInfo;
use Gdoox\Models\BusinessPartner;
use Gdoox\User;
use Gdoox\Http\Requests;
use Gdoox\Models\BusinessEcommerceCompany;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Gdoox\Http\Controllers\Controller;
use Gdoox\Models\NavigationMenu;
use Illuminate\Support\Facades\Route;

//  This is the controller which is created according to new Requirement created by Mukesh.
//  The Old one is PersonalSitesController.

class BusinessEcosystemController extends Controller
{
    use \Gdoox\Helpers\backend\dashboard\HelperFunctions;
    use \Gdoox\Helpers\backend\dashboard\RolesUsers;

    /*
     * 
     */
    
    public function indexall(){
        if(Auth::user()){
          try {    
            $role = $this->getRoleName(Auth::user()->id);
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'BUSINESS ECOSYSTEM')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
            
            $business_ecosystem = BusinessEcommerceCompany::where('user_id', Auth::user()->id)->where('type','=','business_ecosystem')->paginate(25);
            
            return view('backend.dashboard.business_partners.business_ecosystems.indexall',compact('business_ecosystem','route','nav_menu'));
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if(Auth::user()){
          try {
                $required='*';
                $sharedSites = ShareSite::where('invitee_id', Auth::user()->id)->where('status','=','Shared')
                        ->where('type','!=', 'used')->where('siteslug', 'exists', true)->where('request_type','join')->get();

                if(count($sharedSites)){
                    foreach($sharedSites as $sharesite){
                        $sharesite['site_name'] = $this->SiteName($sharesite->siteslug);
                    }
                    return view('backend.dashboard.business_partners.business_ecosystems.index',compact('sharedSites','required'));
                }

                $sharedSites = ShareSite::where('inviter_id', Auth::user()->id)->where('status','Share')
                    ->where('type','!=', 'used')->where('request_type','!=','partner')->where('siteslug', 'exists', true)->where('request_type','!=' , 'join')->get();

                foreach($sharedSites as $sharesite){
                    $sharesite['site_name'] = $this->SiteName($sharesite->siteslug);
                }

                return view('backend.dashboard.business_partners.business_ecosystems.index',compact('sharedSites','required'));
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
      if(Auth::user()){
        try{
          $sitedata = Request::all();
          $fm_data = FieldMaster::where('title', '=', 'business_ecosystem')->where('lang','=', 'en')->first();
          $company = BusinessInfo::where('user_id', Auth::user()->id)->lists('company_name');
  //        print_r($company); die;
          $required="*";
          foreach($company as $com){
             $ecom[$com] = $com;
          }    

          return view('backend.dashboard.business_partners.business_ecosystems.create',compact('fm_data','required','sitedata','ecom'));
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
    /*
     * 
     * Add sites to the Business Ecosystem
     */
    public function addSite($id){
        if(Auth::user()){
          try {
                $required='*';
                $role = $this->getRoleName(Auth::user()->id);
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'BUSINESS ECOSYSTEM')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();
            
                $sharedSites = ShareSite::where('invitee_id', Auth::user()->id)->where('status','Share')
                  ->where('type','!=', 'used')->where('siteslug', 'exists', true)->where('request_type','join')->get();
                if(count($sharedSites)){
                    foreach($sharedSites as $sharesite){
                        $sharesite['site_name']=  $this->SiteName($sharesite->siteslug);
                    }
                    return view('backend.dashboard.business_partners.business_ecosystems.index',compact('sharedSites','required', 'id'));
                }

                $sharedSites = ShareSite::where('inviter_id', Auth::user()->id)->where('status','Share')
                  ->where('type','!=', 'used')->where('request_type','!=','partner')->where('siteslug', 'exists', true)->where('request_type','!=' , 'join')->get();
                
                foreach($sharedSites as $sharesite){
                      $sharesite['site_name']=  $this->SiteName($sharesite->siteslug);
                }

            return view('backend.dashboard.business_partners.business_ecosystems.add_site',compact('route','nav_menu','sharedSites','required', 'id'));
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
    public function store(){
        if(Auth::user()){
           try {
              $rules = array(
                    'ecomm_company_name' => 'required|max:255|unique:business_ecommerce_companies',
              );
              $validator = Validator::make(Request::all(), $rules);

              if($validator->fails()){
                  return Redirect()->back()->withErrors($validator)->withInput(Request::all());                        
              }
              else {
                   $data = Request::all();
                   $estoredata = new BusinessEcommerceCompany();
                   $estoredata->user_id = $data['user_id'];
                   $estoredata->ecomm_company_name = $data['ecomm_company_name'];
                   $estoredata->slug = $data['slug'];
                   $estoredata->email = $data['email'];
                   $estoredata->type = $data['type'];
                   $estoredata->company = $data['company'];
                   if(isset($data['partner_sites'])){
                      $estoredata->partner_sites = $data['partner_sites'];
                   }
                   if($estoredata->save()){
                      if(isset($data['partner_sites'])){
                         foreach($estoredata->partner_sites as $site){
                            ShareSite::where('invitee_id',$estoredata->user_id)->where('siteslug',$site)->where('request_type', 'join')->update(['type'=>'used']);
                            ShareSite::where('inviter_id',$estoredata->user_id)->where('siteslug', $site)->where('request_type','!=','partner')->where('request_type', '!=', 'join')->update(['type'=>'used']);
                         }
                       }
                       return Redirect::route('ecosys.site.indexall')->with('message', "Business ecosystem created");   
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
        else {
            return redirect('auth/login')->with('message',"You must be login!"); 
        }
    }
    /*
     * 
     */
    public function storesite(){
         if(Auth::user()){
           try{
             $data = Request::all();
//             echo $data['site_id']; die;
             $estoredata=  BusinessEcommerceCompany::where('_id', $data['site_id'])->first();
              if(isset($data['partner_sites'])){
                  $estoredata->partner_sites=$data['partner_sites'];
               }
              if($estoredata->save()){
                 if(isset($data['partner_sites'])){
                    foreach($estoredata->partner_sites as $site){
                       ShareSite::where('invitee_id',$estoredata->user_id)->where('siteslug',$site)->where('request_type', 'join')->update(['type'=>'used']);
                       ShareSite::where('inviter_id',$estoredata->user_id)->where('siteslug', $site)->where('request_type','!=','partner')->where('request_type', '!=', 'join')->update(['type'=>'used']);
                    }
                  }
                  return Redirect::route('ecosys.site.indexall')->with('message', "Partner site added.");   
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
        else{
             return redirect('auth/login')->with('message',"You must be login!"); 
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
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'BUSINESS ECOSYSTEM')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
            
            $business_ecosystem=  BusinessEcommerceCompany::where('_id',$id)->first();
            $fm_data =  FieldMaster::where('title', '=', 'business_ecommerce_company')->where('lang','=', 'en')->first();
            
            for($i=0;$i<count($business_ecosystem->partner_sites);$i++){
                $partner_company[]=$this->Company($business_ecosystem->partner_sites[$i]);
                $partner_user[]= $this->GetUserName($this->SiteUser($business_ecosystem->partner_sites[$i]));
            }
          
          return view('backend.dashboard.business_partners.business_ecosystems.show',compact('route','nav_menu','fm_data', 'business_ecosystem', 'partner_company','partner_user'));
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        if(Auth::user()){
          try{
                $required="*";
                $role = $this->getRoleName(Auth::user()->id);
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'BUSINESS ECOSYSTEM')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();
            
                $business_ecosystem=  BusinessEcommerceCompany::where('_id',$id)->first();
                $company=  BusinessInfo::where('user_id', Auth::user()->id)->lists('company_name');
                $fm_data =  FieldMaster::where('title', '=', 'business_ecommerce_company')->where('lang','=', 'en')->first();
                
                foreach($company as $com){
                    $ecom[$com]=$com;
                }
                
                for($i=0;$i<count($business_ecosystem->partner_sites);$i++){
                    $partner_company[]=$this->Company($business_ecosystem->partner_sites[$i]);
                    $partner_user[]= $this->GetUserName($this->SiteUserId($business_ecosystem->partner_sites[$i]));
                }
            return view('backend.dashboard.business_partners.business_ecosystems.edit',compact('route','nav_menu','fm_data', 'required','business_ecosystem','ecom','partner_company','partner_user'));
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( $id){
         $data= Request::all();
         $save= BusinessEcommerceCompany::where('_id', $id)->where('type', 'business_ecosystem')->update($data,  array('upsert' => false));
       
         return Redirect::route('ecosys.site.indexall')->with('message',"Updated");
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function selectEcosystemBusinessPartner(){
        if(Auth::user()) {
          try{
            $userid= Auth::id();
            
            $role = $this->getRoleName(Auth::user()->id);
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'BUSINESS ECOSYSTEM')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
            
            $invited_users= ShareSite::where('inviter_id','=',$userid)->get();
            $fm_data = FieldMaster::where('title', '=', 'personal_sites_new')->first();
            
            if($invited_users->count()){
                foreach($invited_users as $users){
                    $invited_user_name[$users->invitee_id] = $users->invitee_name;
                }
                    
                return view('backend.dashboard.shared_users.invited_users',compact('fm_data','invited_user_name','nav_menu','route'));
            }
            else {
                    $invited_user_name='';
                    return Redirect::route('backend.dashboard.shared_users.invited_users',compact('fm_data','invited_user_name'))->with('message','There are no Invited Users');
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listProducts(){
        if(Auth::user()){
          try{
            $userid = Auth::id();
            $data = Request::all();
            
            $role = $this->getRoleName(Auth::user()->id);
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'BUSINESS ECOSYSTEM')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
            
            $invited_user_id = $data['invited_user'];
            $store_id = ShareSite::where('invitee_id','=', $invited_user_id)->first();
            $list_products= Products::where('shopid','=',$store_id->siteslug)->get();
            $fm_data = FieldMaster::where('title', '=', 'personal_sites_new')->first();
            
            $shared_products = SharedProducts::where('inviter_id','=',$userid)->where('store_id','=',$store_id->siteslug)->get();
            
            $shared_status = array();
            
            foreach($shared_products as $shared_products) {
                $shared_status[$shared_products->product_id]= $shared_products->status;
            }

            return view('backend.dashboard.shared_users.list_products',compact('fm_data','list_products','userid','store_id','invited_user_id','shared_status','nav_menu','route'));
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
    
    public function shareProduct(){
        try {
            if(Request::ajax()){
                $data= Request::all();
                $check= SharedProducts::where('product_id','=',$data['product_id'])->where('invitee_id','=',$data['invitee_id'])->first();
                if(!empty($check)) { 
                    $check->status='shared';
                    if($check->save()){
                        return 'shared';
                    }
                    else  {
                        return 'notshared';
                    }
                }
                else {
                    $share= new SharedProducts();
                    $share->product_id = $data['product_id'];
                    $share->invitee_id = $data['invitee_id'];
                    $share->invitee_name = $data['invitee_name'];
                    $share->inviter_id = Auth::id();
                    $share->store_id = $data['store_id'];
                    $share->status='shared';
                    if($share->save()){
                        return 'shared';
                    }
                    else {
                        return 'notshared';
                    }
                }
            }
        } 
        catch (Exception $e) {
              return Response::json ( array (
                  'error' => true,
                  'data' => $e
              ), 200 );
        } 
    }
    
    public function unshareProduct(){
        try {
            if(Request::ajax()){
                $data = Request::all();
                $unshared = SharedProducts::where('product_id','=',  $data['product_id'])->where('invitee_id','=',$data['invitee_id'])->first();
                $unshared->status = 'unshared';
                if($unshared->save()){
                    return 'unshared';
                }
                else {
                    return 'notunshared';
                }
            }
        } 
        catch (Exception $e) {
              return Response::json ( array (
                  'error' => true,
                  'data' => $e
              ), 200 );
        } 
    }
    
    public function storeEcosystemSite(){
        if(Auth::user()){
           try {
              $rules = array(
                    'ecomm_company_name' => 'required|max:255|unique:business_ecommerce_companies',
              );
              
              $validator = Validator::make(Request::all(), $rules);

              if($validator->fails()){
                  return Redirect()->back()->withErrors($validator)->withInput(Request::all());                        
              }
              else {
                   $data = Request::all();
                   $estoredata = new BusinessEcommerceCompany();
                   $estoredata->user_id = $data['user_id'];
                   $estoredata->ecomm_company_name = $data['ecomm_company_name'];
                   $estoredata->slug = $data['slug'];
                   $estoredata->email = $data['email'];
                   $estoredata->type = $data['type'];
                   $estoredata->company = $data['company'];
                   if(isset($data['partner_sites'])){
                      $estoredata->partner_sites = $data['partner_sites'];
                   }
                   if($estoredata->save()){
                       return Redirect::route('ecomm-index')->with('message', "Business Ecosystem Site created successfully.");   
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
        else {
            return redirect('auth/login')->with('message',"You must be login!"); 
        }
    }
    
    public function updateEcosystemSite(){
        if(Auth::user()){
           try {
              $rules = array(
                    'ecomm_company_name' => 'required|max:255|unique:business_ecommerce_companies, $data["_id"]',
              );
              
              $validator = Validator::make(Request::all(), $rules);  
              
              if($validator->fails()){
                  return Redirect()->back()->withErrors($validator)->withInput(Request::all());                        
              }
              else {
                    $data = Request::all();
                    $estoredata = BusinessEcommerceCompany::where('_id', $data['_id'])->first();
                    $estoredata->ecomm_company_name = $data['ecomm_company_name'];
                    $estoredata->email = $data['email'];
                    $estoredata->company = $data['company'];
                    if($estoredata->save()){
                        return Redirect::route('ecomm-index')->with('message', "Business Ecosystem Site Updated successfully.");   
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
        else {
            return redirect('auth/login')->with('message',"You must be login!"); 
        }
    }
}