<?php

namespace Gdoox\Http\Controllers\backend\dashboard\business_partners;

use DB;
use Auth;
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
use Illuminate\Support\Facades\Route;
use Gdoox\Models\NavigationMenu;
use Gdoox\Models\AlertSystem;


class CompanyNetworkPartnersController extends Controller
{
    use \Gdoox\Helpers\backend\dashboard\HelperFunctions;
    use  \Gdoox\Helpers\backend\dashboard\RolesUsers ;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
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
           
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('parent', '7')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
             
            $business_info = BusinessInfo::where('user_id', Auth::user()->id)->get();
            
            
            if(!$business_info->count()){
                return redirect()->back()->with('message','You have no company profile. Please create a company and e-store first');
            }
            
            $search = $request->all();
            
            $fm_data=  FieldMaster::where('title','business_info')->where('lang','en')->first();
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
                    }
                    else {
                        $business_info = BusinessInfo::with('searchstore')->where('status','=','Active')->where($search['filter'],'like','%'.trim($search_val).'%')
                            ->where('user_id', '!=', Auth::user()->id)->paginate(25);
                    }
                    
                     return view('backend.dashboard.business_partners.company_networks.create',compact('route','nav_menu','fm_data','business_info','term','category','search_val'));
                }
                elseif($search['term']=='invite') {
                    $term = $search['term'];
                    $search_val = $search['keyword'];
                    $user_id = $search['user_id'];
                    $company_name = $search['company_name'];
                    $company_site_slug = $search['com_site_slug'];
                    
                    $check_inviter_status = BusinessPartner::where('inviter_id', Auth::user()->id)->where('invitee_id', $user_id)->where('company_site_slug','=',$company_site_slug)->where('type','=','Company Network')->first();
                    
                    if(!empty($check_inviter_status)){
                        if($check_inviter_status->status==='Accepted'){
                            $error = "You have already sent Invitation Request to ".$company_name." for the site ".$company_site_slug." to join your Company Network and the request is Accepted.";
                        }
                        else {
                            $error = "You have already sent Invitation Request to ".$company_name." for the site ".$company_site_slug." to join your Company Network and the request is still Pending.";
                        }
                        return redirect()->back()->withErrors($error);                       
                    }
                    else {
                        $check_invitee_status = BusinessPartner::where('invitee_id', Auth::user()->id)->where('inviter_id', $user_id)->where('type','=','Company Network')->first();
                        if(!empty($check_invitee_status)){
                            if($check_invitee_status->status==='Accepted'){
                                $error = "You have already Accepted request from ".$company_name." to join his Company Network site ".$company_site_slug."";
                            }
                            else {
                                $error = "You have received Invitation request from ".$company_name." to join his Company Network for site ".$company_site_slug.". Please Accept the Invitation Request";
                            }
                            return redirect()->back()->withErrors($error);                        
                        }
                    }
                    
                    return view('backend.dashboard.business_partners.company_networks.create',compact('route','nav_menu','fm_data','business_info','term','category','search_val','user_id','company_name','company_site_slug'));
                }
            }           
            else {
                    $term = 'form';
                    $search_val= '';
                    return view('backend.dashboard.business_partners.company_networks.create',compact('nav_menu','route','fm_data','category','term','search_val'));
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
                $checkinvite=  BusinessPartner::where('inviter_id', Auth::user()->id)->where('invitee_id',$id)->where('type','=','Company Network')->first();
                if(!empty($checkinvite) ){
                    return redirect()->back()->withErrors('You have already sent the partnership invitation to this person');                        
                }
             
            // When no any request type
              $partner= new BusinessPartner();         
              $partner->name =  $this->GetUserName($id); //$id is invitee id who get the invitation
              $partner->email =  $this->GetUserEmail($id);
              $partner->invitee_id = $id;
              $partner->company_name = $data['company_name'];
              $partner->company_site_slug = $data['company_site_slug'];
              $partner->message = $data['message'];
              $partner->inviter_id = Auth::user()->id;
              $partner->inviter_email = Auth::user()->email;
              $partner->status = "Pending"; 
              $partner->invitation_date = date("Y-m-d", time());
              $partner->type = 'Company Network';
              $partner->register = 1;
              $code = $this->randomString(6);
              $invitation_code = BusinessPartner::where('gdoox_code', '=', $code)->first();
              
              if(!empty($invitation_code->gdoox_code)){
                  $partner->gdoox_code = 'COMNET'.strtoupper($this->randomString(7));
              }
              else {
                  $partner->gdoox_code = 'COMNET'.strtoupper($this->randomString(6));
              }
              
              if($partner->save()){
                  $data = array(
                     'username' => $partner->name,
                     'email' =>$partner->email,
                     'gdoox_code' =>$partner->gdoox_code,
                     'inviter' =>$partner->inviter_email,
                     );
                  
                  Mail::send('emails.company_network_partners', $data, function($message) use ($partner) {
                       $message->from($partner->inviter_email, $this->GetUserName($partner->inviter_id));
                       $message->to($partner->email,$partner->name)->subject('Company Network invitation with Gdoox code');
                    });
                }
              return Redirect::route('company.network.invite.create')->with('message','Invitation Sent.');
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
     * Show resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     * @return \Illuminate\Http\Response
     */
    
    public function show() {
    if (Auth::user()) {
        try { 
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('parent', '7')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
            
            $networkinvitation = BusinessPartner::where('invitee_id', Auth::user()->id)->where('type', '=', 'Company Network')->orderBy('invitation_date', 'desc')->paginate(25);
            
            if (count($networkinvitation)) {
                foreach ($networkinvitation as $invitation) {
                    $invitedata['inviter'][] = $this->GetUserName($invitation->inviter_id);
                    $invitedata['inviter_email'][] = $invitation->inviter_email;
                    $invitedata['email'][] = $invitation->email;
                    $invitedata['message'][] = $invitation->message;
                    $invitedata['company_site_slug'][] = $invitation->company_site_slug;
                    $invitedata['inviter_id'][] = $invitation->inviter_id;
                    $invitedata['status'][] = $invitation->status;
                    $invitedata['invitation_date'][] = $invitation->invitation_date;
                    $invitedata['inviter_company'][] = $this->GetCompany($invitation->inviter_id);
                }
            }

            $invitationstatus = BusinessPartner::where('inviter_id', Auth::user()->id)->where('type', '=', 'Company Network')->orderBy('invitation_date', 'desc')->paginate(25);
            if (count($invitationstatus) > 0) {
                foreach ($invitationstatus as $invitation) {
                    $invitedata['invitee'][] = $invitation->name;
                    $invitedata['invitee_email'][] = $invitation->email;
                    $invitedata['type'][] = $invitation->type;
                    $invitedata['message'][] = $invitation->message;
                    $invitedata['company_site_slug'][] = $invitation->company_site_slug;
                    $invitedata['status'][] = $invitation->status;
                    $invitedata['invitation_date'][] = $invitation->invitation_date;
                    $invitedata['id'][] = $invitation->id;
                } 
            }
            
            $fm_data =  FieldMaster::where('title','business_info')->where('lang','en')->first();
            $category = $this->searchCategories($fm_data);
            
            $update = AlertSystem::where('user_id','=',Auth::user()->id)->first();
            $update->company_network = array('read_at'=>date("Y-m-d H:i:s"),"notification"=>"");
            $update->save();
            
            return view('backend.dashboard.business_partners.company_networks.show', compact('nav_menu','route','invitedata', 'networkinvitation','invitationstatus', 'invitedata','fm_data','category'));
        } catch (\Exception $e) {
            $error = "An error occured. " .
                    "Line Number: " . $e->getLine() . " " .
                    "File Name: " . $e->getFile() . " " .
                    "Error Description: " . $e->getMessage();
            return view('errors.custom_error')->withErrors($error);
        }
    } else {
        return redirect('auth/login')->with('message', "You must be login!");
    }
}
    
    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $site, $inviter_id) {
        try {
            $networkrequest = BusinessPartner::where('company_site_slug', $site)->where('inviter_id', $inviter_id)->where('type', '=', 'Company Network')->first();
            if (count($networkrequest)) {
                $networkrequest->status = "Accepted";
                $networkrequest->accepted_date = date("Y-m-d", time());
                if ($networkrequest->save()) {
                    return Redirect::route('company.network.show')->with('message', 'Invitation Accepted');
                }
            }
        } catch (\Exception $e) {
            $error = "An error occured. " .
                    "Line Number: " . $e->getLine() . " " .
                    "File Name: " . $e->getFile() . " " .
                    "Error Description: " . $e->getMessage();
            return view('errors.custom_error')->withErrors($error);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    
    public function destroy($site, $inviter_id) {
        if (Auth::user()) {
            try {
                $businessinvite = BusinessPartner::where('company_site_slug', $site)->where('inviter_id', $inviter_id)->where('type','=','Company Network')->first();
                $businessinvite->status = "Denied";
                $businessinvite->deny_date = date("Y-m-d", time());
                if ($businessinvite->save()) {
                    return Redirect::route('company.network.show')->with('message', 'Invitation Denied');
                }
            } catch (\Exception $e) {
                $error = "An error occured. " .
                        "Line Number: " . $e->getLine() . " " .
                        "File Name: " . $e->getFile() . " " .
                        "Error Description: " . $e->getMessage();
                return view('errors.custom_error')->withErrors($error);
            }
        } else {
            return redirect('auth/login')->with('message', "You must be login!");
        }
    }
    
    public function Resend($id){
      try {
        $olddata =  BusinessPartner::where('_id', '=', $id)->first();
        $diff = date_diff(date_create(date("Y-m-d", time())), date_create($olddata->invitation_date));    
        $days = $diff->format("%R%a days");

        if($olddata->status === "Denied" && $days < 10){
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
                  
                $olddata->status = "Expired";
                $invitedata->expiry_date = date("Y-m-d", time());
                if($olddata->save()){
                    return Redirect::route('company.network.show')->with('message','Invitation Sent.');
                }
                else {
                    return redirect()->back()->withErrors('Invitation could not be sent! Please try again.');  
                }     
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
