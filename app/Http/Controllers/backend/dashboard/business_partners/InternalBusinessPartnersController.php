<?php

namespace Gdoox\Http\Controllers\backend\dashboard\business_partners;

use DB;
use Illuminate\Support\Facades\Auth;
use Gdoox\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Gdoox\Models\BusinessPartner;
use Gdoox\Models\InviteUser;
use Gdoox\Models\FieldMaster;
use Illuminate\Http\Request;
use Gdoox\Models\BusinessInfo;
use Gdoox\Models\BusinessEcommerceCompany;
use Illuminate\Support\Facades\Session;
use Gdoox\Http\Requests;
use Gdoox\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Gdoox\Models\NavigationMenu;
use Illuminate\Support\Facades\Route;
use Gdoox\Models\Products;
use Gdoox\Models\Categories;
use Gdoox\Models\EcomShops;

class InternalBusinessPartnersController extends Controller
{
    use \Gdoox\Helpers\backend\dashboard\HelperFunctions;
    use  \Gdoox\Helpers\backend\dashboard\RolesUsers ;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){        
        if(Auth::user()){
        try {
            
            $role = $this->getRoleName(Auth::user()->id);
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'BUSINESS ECOSYSTEM')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
                
            $business_info = BusinessInfo:: where('user_id', Auth::user()->id)->get();
            if(!$business_info->count()){
                return redirect()->back()->withErrors('You have no company profile. Please create a company and e-store first');
            }

            $category = array();
            $search = $request->all();
            
            $fm_data = FieldMaster::where('title','business_info')->where('lang','en')->first();
            $category = $this->searchCategories($fm_data);
            
            
            if(array_key_exists('term', $search)){
                if($search['term']=='search'){
                    $search_val = $search['keyword'];
                    $term = $search['term'];
                    if($search['filter']=='all'){
                         $business_info = BusinessInfo::with('searchstore')->where('ecomm_company_name','like','%'.$search_val.'%')
                            ->orWhere('company_name','like','%'.$search_val.'%')
                            ->orWhere('street_add','like','%'.$search_val.'%')
                            ->orWhere('city','like','%'.$search_val.'%')
                            ->orWhere('country','like','%'.$search_val.'%')
                            ->orWhere('desc','like','%'.$search_val.'%')
                            ->orWhere('org_type','like','%'.$search_val.'%')
                            ->where('user_id', '!=', Auth::user()->id)
                            ->where('type','business')
                            ->where('status','=','Active')->paginate(25);
                         
//                            foreach($business_info as $business){
//                                if($business['relations']['searchstore']){
//                                    foreach($business['relations']['searchstore'] as $val){
//                                        echo $val->ecomm_company_name."=====".$val->slug;
//                                    }
//                                }
//                                else {
//                                    echo "Not Available";
//                                }
//                            }
                    }
                    else {
                        $business_info = BusinessInfo::where('status','=','Active')->where($search['filter'],'like','%'.trim($search_val).'%')
                            ->where('user_id', '!=', Auth::user()->id)->paginate(25);
                    }
                     return view('backend.dashboard.business_partners.internal_partners.create',compact('route','nav_menu','fm_data','category','business_info','term','category','search_val'));
                }
                elseif($search['term']=='invite') {
                    $error = "";
                    $term = $search['term'];
                    $search_val = $search['keyword'];
                    $user_id = $search['user_id'];
                    $company_name = $search['company_name'];
                    $company_site_slug = $search['com_site_slug'];
                    
                    $check_inviter_status = BusinessPartner::where('inviter_id', Auth::user()->id)->where('invitee_id', $user_id)->where('company_site_slug','=', $company_site_slug)->where('type','!=','Company Network')->first();
                    
                    if(!empty($check_inviter_status)){
                        if($check_inviter_status->status==='Accepted'){
                            $error = "You have already sent Invitation Request to ".$company_name." to join your Ecosystem \"".$check_inviter_status->ecosystem_name."\" for the site \"".$company_site_slug."\" and the request is Accepted.";
                        }
                        else {
                            $error = "You have already sent Invitation Request to ".$company_name." to join your Ecosystem \"".$check_inviter_status->ecosystem_name."\" for the site \"".$company_site_slug."\" and the request is still Pending.";
                        }
                        return redirect()->back()->withErrors($error);                       
                    }
                    else {
                        $check_invitee_status = BusinessPartner::where('invitee_id', Auth::user()->id)->where('inviter_id', $user_id)->where('type','!=','Company Network')->first();
                        if(!empty($check_invitee_status)){
                            if($check_invitee_status->status==='Accepted'){
                                $error = "You have already Accepted request from ".$company_name." to join his Ecosystem \"".$check_inviter_status->ecosystem_name."\" for the site \"".$company_site_slug."\"";
                            }
                            else {
                                $error = "You have received Invitation request from ".$company_name." to join his Ecosystem \"".$check_inviter_status->ecosystem_name."\" for site ".$company_site_slug."\". Please Accept the Invitation Request";
                            }
                            return redirect()->back()->withErrors($error);                        
                        }
                    }
                    
                    $ecosystemcomp = array();
                    $ecosystemcomp[''] = 'Select';
                    $ecomcompanies = EcomShops::where('type','=','business_ecosystem')->where('user_id','=',Auth::user()->id)->get();
                    
                    if(!empty($ecomcompanies->count())){
                        foreach ($ecomcompanies as $ecom) {
                            $ecosystemcomp[$ecom->slug] = $ecom->ecomm_company_name;
                        }
                    }
                    else {
                        return redirect()->route('ecosys.site.create')->with('message','You dont have any Business Ecosystem. Please create a Business Ecosytem and then Invite Business Partners');
                    }
                     
                    return view('backend.dashboard.business_partners.internal_partners.create',compact('route','nav_menu','fm_data','business_info','term','category','search_val','user_id','company_name','company_site_slug','ecosystemcomp'));
                }
            }          
            else {
                $term = 'form';
                $search_val= '';
                return view('backend.dashboard.business_partners.internal_partners.create',compact('route','nav_menu','fm_data','category','term','search_val'));
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
/*
 * Join request page
 * 
 */
     public function joinRequest($shopid){
       if(Auth::user()){
         try{
                $role = $this->getRoleName(Auth::user()->id);
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'BUSINESS ECOSYSTEM')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();
            
                $user_email=  $this->GetUserEmail(Auth::user()->id);
                $user_id=Auth::user()->id;
                $owner_id=  $this->SiteUserId($shopid);
                $owner_email=  $this->GetUserEmail($owner_id);

                return view('backend.dashboard.business_partners.internal_partners.joinrequest',compact('shopid','user_id','owner_id','user_email','owner_email','nav_menu','route'));
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
 * Become a partner request
 * 
 */
     public function partnerRequest($shopid){
       if(Auth::user()){
         try {
            $role = $this->getRoleName(Auth::user()->id);
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'BUSINESS ECOSYSTEM')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
                
            $data['user_email'] =  $this->GetUserEmail(Auth::user()->id);
            $data['user_id'] = Auth::user()->id;
            $data['owner_id']=  $this->SiteUserId($shopid);
            $data['owner_email'] = $this->GetUserEmail($data['owner_id']);

            return view('backend.dashboard.business_partners.internal_partners.partner_request',compact('shopid','data','nav_menu','route'));
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
        $data = $request->all();
        $id = $data['user_id'];

        if(Auth::user()){
            try {
                $checkinvite=  BusinessPartner::where('inviter_id', Auth::user()->id)->where('invitee_id',$id)->where('company_site_slug', $data['company_site_slug'])->where('type','!=','Company Network')->first();
                if(!empty($checkinvite) ){
                    return redirect()->back()->withErrors('You have already sent the partnership invitation to this person');                        
                }
                
                $info = BusinessInfo::where('user_id', $id)->first();
                // When request type is available in invitation

                if(isset($data['request_type'])){
                    $partner = new BusinessPartner();  
                    $partner->name =  $this->GetUserName($data['invitee_id']); 
                    $partner->email =  $data['invitee_email'];
                    $partner->invitee_id = $data['invitee_id'];
                    $partner->inviter_id = Auth::user()->id;
                    $partner->inviter_email = Auth::user()->email;
                    $partner->site_slug = $data['site_slug'];
                    $partner->invitation_date = date("Y-m-d", time());
                    $partner->ecosystem_name = $data['ecosystem_name'];
                    $partner->ecosystem_slug = $data['ecosystem_slug'];
                    $partner->company_site_slug = $data['company_site_slug'];
                    $partner->company_name = $info->company_name;
                    $partner->status = "Pending";
                    $partner->request_type = $data['request_type'];
                    $partner->type = 'Internal';
                    if(isset($data['interest']) || isset($data['message'])){
                        $partner->interested_in = $data['interest'];
                        $partner->message = $data['message'];
                    }
                    $partner->register = 1;
                     if($partner->save()){
                      $data = array(
                         'username' => $partner->name,
                         'email' => $partner->email,    
                         'site' => $partner->site_slug,
                         'inviter' => $partner->inviter_email,
                         );
                      Mail::send('emails.join_business', $data, function($message) use ($partner) {
                           $message->from($partner->inviter_email, $this->GetUserName($partner->inviter_id));
                           $message->to($partner->email,$partner->name)->subject('Internal invitation with Gdoox code');
                      });
                    }
                    return Redirect::route('site', $partner->site_slug)->with('message','Request Sent.');
                }
                else {
                  // When there is no request type
                    $partner= new BusinessPartner();            
                    $partner->name =  $this->GetUserName($id); //$id is invitee id who get the invitation
                    $partner->email =  $this->GetUserEmail($id);
                    $partner->invitee_id = $id;
                    $partner->message = $data['message'];
                    $partner->inviter_id = Auth::user()->id;
                    $partner->inviter_email = Auth::user()->email;
                    $partner->ecosystem_name = $data['ecosystem_name'];
                    $partner->ecosystem_slug = $data['ecosystem_slug'];
                    $partner->status = "Pending";
                    $partner->company_site_slug = $data['company_site_slug'];
                    $partner->company_name = $info->company_name;
                    $partner->invitation_date = date("Y-m-d", time());
                    $partner->type = 'Internal';
                    $partner->register = 1;
                    $code = $this->randomString(6);
                    
                    $invitation_code = BusinessPartner::where('gdoox_code', '=', $code)->first();
                    if(!empty($invitation_code->gdoox_code)){
                        $partner->gdoox_code = 'B-ECOSYS-'.strtoupper($this->randomString(7));
                    }
                    else {
                        $partner->gdoox_code =  'B-ECOSYS-'.strtoupper($this->randomString(6));
                    }
                    
                    if($partner->save()){
                        $data = array(
                           'username' => $partner->name,
                           'email' =>$partner->email,
                           'gdoox_code' =>$partner->gdoox_code,
                           'inviter' =>$partner->inviter_email,
                        );
                        Mail::send('emails.internal_business_partners', $data, function($message) use ($partner) {
                             $message->from($partner->inviter_email, $this->GetUserName($partner->inviter_id));
                             $message->to($partner->email,$partner->name)->subject('Internal invitation with Gdoox code');
                          });
                    }
                      
                    return Redirect::route('invite.inter.partner.create')->with('message','Invitation Sent.');
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
    
    public function Resend($id){
      try{
        $olddata =  BusinessPartner::where('_id', '=', $id)->first();
        $diff = date_diff(date_create(date("Y-m-d", time())), date_create($olddata->invitation_date));    
        $days = $diff->format("%R%a days");
  //      print_r($days); die;
        if($olddata->status === "Denied" && $days<10){
          $remaining = 10-$days;
          if($remaining > 1){
                $time="days";
          }
          else {
            $time="day";
          }
          return redirect()->back()->withErrors('Your invitation has been denied by the user. You can not resend invitation till '.$remaining. " more ". $time);
        }
        if($olddata->status != "Accepted" ){
          $invitedata = new BusinessPartner();
          $invitedata->name = $olddata->name; 
          $invitedata->email = $olddata->email;
          $invitedata->message = $olddata->message;
          $invitedata->inviter_id = Auth::user()->id; 
          $invitedata->inviter_email = Auth::user()->email;
          $invitedata->invitation_date = date("Y-m-d", time());
          $invitedata->status = "Pending"; 
          $invitedata->type = 'Internal';
          $invitedata->register = 1;
          if($invitedata->save()){
                $data = array(
                   'username' => $invitedata->name,
                   'email'=>$invitedata->email,    
                   'gdoox_code' =>$invitedata->gdoox_code,
                   'inviter'=>$invitedata->inviter_email,
                   'registration_link'=> URL::to('auth/register',$invitedata->gdoox_code)
                   );
                  Mail::send('emails.internal_business_partners', $data, function($message) use ($invitedata) {
                       $message->from($invitedata->inviter_email, $this->GetUserName($invitedata->inviter_id));
                       $message->to($invitedata->email,$invitedata->name)->subject('Internal invitation with Gdoox code');
                  });
                $olddata->status="Expired";
                $invitedata->expiry_date=date("Y-m-d", time());
                $olddata->save();
                    return Redirect::route('invite.partner.show')->with('message','Invitation Sent.');
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
    
    public function fetchCompanySiteCategories(Request $request){
        $data = $request->all();
        $shopid = $data['comp_slug'];
        
        $products = Products::orderBy('_id')
            ->where("shopid","=", $shopid)
            ->where('postdate', '<=', date("Y-m-d"))
            ->where('status', '!=', 'disabled')
            ->where('product_type', '!=', 'opportunities')
            ->get();
        
        $prod_cats=array();
        $prod_cats_count=array();
        
        foreach ($products as $product) {
            foreach ($product->cat_ids as $cat) {
                $catinfo = Categories::where("cat_id", "=", $cat)->where("lang", "=", "en")
                        ->project(array('name'))->first();
                if(!empty($catinfo)){
                  $prod_cats[$cat]= $catinfo->name;
                  $prod_cats_count[$cat][]= $cat;
                }
            }
        }
        
        $products_counts = array();     
        foreach ($prod_cats as $cat_id => $cat_name) {
            $products_counts[$cat_id]= count($prod_cats_count[$cat_id]);
        }

        $products_list= array();

        foreach ($prod_cats as $cat_id => $cat_name) {
             $sub_cat_id = explode('-', $cat_id);
             $categories = Categories::where('lang', '=', 'en')
                     ->Where('parent', '=', 0)
                     ->Where('cat_id', '=', $sub_cat_id[0])
                     ->project( array('name'))
                     ->first();
             $products_list[$categories->name] = $categories->name;
             // $products_list[$sub_cat_id[0]]['values'][$cat_id] = $cat_name;    
        }
        
        $html="";
        $html.='<ul style="list-style: none; background-color: #b3e0ff">';
            foreach($products_list as $key=>$list){
                $html.="<li>".$list."</li>";
            }
        $html.="</ul>";
        return $html;
    }
    
    public function searchCategories($fm_data){
        $category = array();
        $category['company_name'] = $fm_data->labels['company_name'];
        $category['street_add'] = $fm_data->labels['street_add'];
        $category['city'] = $fm_data->labels['city'];
        $category['country'] = $fm_data->labels['country'];
        $category['zip'] = $fm_data->labels['zip'];
        $category['desc'] = $fm_data->labels['desc'];
        $category['org_type'] = $fm_data->labels['org_type']; 
        $category['actvity_type'] = $fm_data->labels['actvity_type'];
        $category['operation'] = $fm_data->labels['operation'];
        $category['ecomm_company_name'] = 'Site Name';
        $category['all'] = 'All';
        return $category;
    }
}
