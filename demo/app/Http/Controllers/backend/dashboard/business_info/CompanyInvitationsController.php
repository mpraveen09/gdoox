<?php

namespace Gdoox\Http\Controllers\backend\dashboard\business_info;

use DB;
use Gdoox\Models\BusinessInfo;
use Illuminate\Support\Facades\Auth;
use Gdoox\Models\CompanyInvitation;
use Illuminate\Support\Facades\Request;
use Gdoox\Models\FieldMaster;
use Gdoox\Models\EcomShops;
use Gdoox\Models\DropdownOption;
use Gdoox\Models\Sectors;
use Gdoox\User;
use Illuminate\Support\Facades\Redirect;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Gdoox\Http\Controllers\Controller;
use Gdoox\Models\Categories;
use Gdoox\Models\Products;
use Gdoox\Models\ChattingUsersRelations;
use Gdoox\Models\ChatContacts;
use Gdoox\Models\PersonalInfo;
use Gdoox\UserRole;
use Gdoox\Role;
use Gdoox\Models\NavigationMenu;
use Illuminate\Support\Facades\Route;
use Gdoox\Models\AlertSystem;

class CompanyInvitationsController extends Controller
{
  use \Gdoox\Helpers\backend\dashboard\RolesUsers;
  use \Gdoox\Helpers\backend\dashboard\HelperFunctions;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
      try {
        if(Auth::user()){
            $category = array();
            $search = Request::all();

            $role = $this->getRoleName(Auth::user()->id);
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'MANAGE YOUR ALLIANCES')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();

            $fm_data = FieldMaster::where('title','business_info')->where('lang','en')->first();

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
            $category['category_name'] = ' Category';
            $category['all'] = 'All';

            if($search){
                $term['term']='1';
                $search_val = $search['keyword'];
  //            $estore=  EcomShops::where('user_id',  Auth::user()->id);
                if($search['filter']=='all'){
                  $business_info = BusinessInfo::where('ecomm_company_name','like','%'.$search_val.'%')
                      ->orWhere('company_name','like','%'.$search_val.'%')
                      ->orWhere('street_add','like','%'.$search_val.'%')
                      ->orWhere('city','like','%'.$search_val.'%')
                      ->orWhere('country','like','%'.$search_val.'%')
                      ->orWhere('desc','like','%'.$search_val.'%')
                      ->orWhere('org_type','like','%'.$search_val.'%')
                      ->where('user_id', '!=', Auth::user()->id)->where('status','=','Active')->paginate(25);
                }

                elseif($search['filter'] == 'category_name') {
                      $ids = array();
                      $cat_id = array();
                      $comp_ids = array();

                      $cat_ids = Categories::where('name','like','%'.addslashes($search['keyword']).'%')->orderBy('name')->project( array('cat_id','name') )->get();

                      if(count($cat_ids)){
                          foreach ($cat_ids as $cat) {
                              if (strpos($cat->cat_id,'-') !== false) {
                                   $index = strpos($cat->cat_id,'-');
                                   $parent_id = substr($cat->cat_id, 0, $index);
                                   $cat_id[$parent_id] = $parent_id;                  
                              }
                              else {
                                   $cat_id[$cat->cat_id] = $cat->cat_id;//$cat->name;      
                              }         
                          }
                      }


                      $business_sect = Sectors::where('category_name','like','%'.$search_val.'%')
                          ->where('user_id', '!=', Auth::user()->id)->where('type','=','business_sectors')
                              ->project( array('category_id','category_name') )->get();

                      if(count($business_sect)){
                          foreach($business_sect as $cats){
                              foreach ($cats->category_id as $key => $value) {
                                  if (strpos($value,'-') !== false) {
                                      $index = strpos($value,'-');
                                      $parent_id = substr($value, 0, $index);
                                      $cat_id[$parent_id] = $parent_id;                  
                                  }
                                  else {
                                       $cat_id[$value] = $value;//$cat->name;      
                                  }
                              }
                          }
                      }

                      if(!empty($cat_id)){
                          foreach($cat_id as $key=>$val){
                              $comp = Products::where('cat_ids', 'like', $val.'%')->where('userid', '!=', Auth::user()->id)->where('status','=','enabled')->project('company_id','shopid','userid')->get();
                              if(count($comp)){
                                  $companies[] = $comp;
                              }
                              else {
                                  $companies[] = '';
                              }
                          }
                      }


                      if(!empty($companies)){
                          foreach($companies as $company){
                              foreach($company as $comp){
                                  $comp_ids[$comp->company_id] = trim($comp->company_id);
                              }
                          }
                      }

                      if(!empty($comp_ids)){
                          foreach($comp_ids as $key=>$val){
                              $ids[] =  $val;
                          }
                      }

                      $business_info = BusinessInfo::whereIn('_id', $ids)->where('user_id', '!=', Auth::user()->id)->where('status','=','Active')->paginate(25);
               }

                else {
                    $business_info = BusinessInfo::where('status','=','Active')->where($search['filter'],'like','%'.trim($search_val).'%')
                      ->where('user_id', '!=', Auth::user()->id)->paginate(25);      
                }

                 return view('backend.dashboard.business_info.business_company_invitations.index',compact('fm_data','business_info','term','category','search_val','route','nav_menu'));
              // return view('backend.dashboard.search_business_info.index',compact('fm_data'))->with('business_info',$business_info)->with('term',$term)->with('category',$category)->with('estore',$estore);
            }
            else {
              $term['term']='0';
              $search_val= '';
              return view('backend.dashboard.business_info.business_company_invitations.index',compact('fm_data','category','term','search_val','route','nav_menu'));
          }
        }
        else{
             return redirect('auth/login')->with('message',"You must be login!"); 
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id){
      try {
            $business =  BusinessInfo::where('_id', $id)->first();
            $invitation =  CompanyInvitation::where('company_id',$id)->where('inviter_id',Auth::user()->id)->first();
        
            if(!empty($invitation)){
                 return Redirect::route('invite.company.index')->withErrors('This invitation is already sent. Please wait while owner reponse');
            }
            else {
                $business_company_invitation = new  CompanyInvitation();
                $business_company_invitation->company_id = $business->id;
                // $business_company_invitation->invitee_name = $this->GetUserName($business->user_id);
                // $business_company_invitation->invitor_name = $this->GetUserName(Auth::user()->id);
                $business_company_invitation->invitee_id = $business->user_id;
                $business_company_invitation->inviter_id = Auth::user()->id;
                $business_company_invitation->status = "Pending";
                $business_company_invitation->viewed = "0";

                // Chat User Ralation
                $users = array(Auth::user()->id , $business->user_id);
                $check_user_relation = ChattingUsersRelations::whereIn('users', $users)->where('type','=','singlechat')->first();
                if(empty($check_user_relation)){
                    
                    $chatuserrelations = new ChattingUsersRelations();
                    $chatuserrelations->user_id = Auth::user()->id;
                    $chatuserrelations->users = $users;
                    $chatuserrelations->type = 'singlechat';
                    $chatuserrelations->status = 'Pending';
                    if($chatuserrelations->save()){
                        $chat_id = ChattingUsersRelations::whereIn('users', $users)->where('type','=','singlechat')->first();
                        
                        $check_chat_contacts = ChatContacts::whereIn('users', $users)->where('type','=','singlechat')->first();      
                        
                        if(empty($check_chat_contacts)){
                            $contact_info_user = array();
                            $contact_info_contact = array();

        //                  Getting the personal Info and Logged In User.

                            $user_info_loggedin = PersonalInfo::where('user_id','=', Auth::user()->id)->first();
                            $user_loggedin= UserRole::where('user_id', Auth::user()->id)->first();
                            if(!empty($user_loggedin)){
                                $role_loggedin = Role::where('_id',$user_loggedin->role_id)->first();
                            }
                            
                            if(!empty($user_info_loggedin)){
                                    $user_name = $user_info_loggedin->f_name." ".$user_info_loggedin->l_name;
                            }
                            else if(!empty($role_loggedin)){
                                    $user_name = $role_loggedin->name;
                            }
                            else {
                                    $admin =  BusinessInfo::where('_id', Auth::user()->id)->first();
                                    $user_name = $admin->company_name;
                            }
                            
         //                 Getting the personal Info of the User Contact.
                            
                            $contact_info = PersonalInfo::where('user_id','=', $id)->first();
                            $contact_user = UserRole::where('user_id', $id)->first();
                            if(!empty($contact_user)){
                                 $contact_role = Role:: where('_id', $contact_user->role_id)->first();
                            }
                            
                            if(!empty($contact_info)){
                                    $contact_name = $contact_info->f_name." ".$contact_info->l_name;  
                            }
                            else if(!empty($contact_role)){
                                    $contact_name = $role->name;
                            }
                            else {
                                    $business =  BusinessInfo::where('_id', $id)->first();
                                    $contact_name = $business->company_name;
                            }
   
                        }
                
                        
                        $chatuseradmin = new ChatContacts();
                        $chatuseradmin->user_id = Auth::user()->id;
                        $chatuseradmin->request_by = Auth::user()->id;
                        $chatuseradmin->contact_id = $business->user_id;
                        $chatuseradmin->users = $users;
                        $chatuseradmin->status = '0';
                        $chatuseradmin->request = 'Pending';
                        $chatuseradmin->contact_name = $contact_name;
                        $chatuseradmin->chat_id = $chat_id->_id;
                        $chatuseradmin->type = 'singlechat';
                        $chatuseradmin->save();

                        $chatusercontact = new ChatContacts();
                        $chatusercontact->user_id = $business->user_id;
                        $chatusercontact->request_by = Auth::user()->id;
                        $chatusercontact->contact_id = Auth::user()->id;
                        $chatusercontact->users = $users;
                        $chatusercontact->status = '0';
                        $chatusercontact->request = 'Pending';
                        $chatusercontact->contact_name = $user_name;
                        $chatusercontact->chat_id = $chat_id->_id;
                        $chatusercontact->type = 'singlechat';
                        $chatusercontact->save();
                    }
                }

                
                if($business_company_invitation->save()){
                    return Redirect::route('invite.company.index')->with('message', 'Invitation sent.');
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
      if(Auth::user()){
        try {
            
            $role = $this->getRoleName(Auth::user()->id);
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'MANAGE YOUR ALLIANCES')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
          
            $businessinvitation=  CompanyInvitation::where('invitee_id', Auth::user()->id)->paginate(25);
            foreach($businessinvitation as $invitation){
                  $invitedata['inviter'][]=  $this->GetUserName($invitation->inviter_id);
                  $invitedata['company'][]=$this->getCompanyName($invitation->company_id);
                  $invitedata['company_id'][]=$invitation->company_id;
                  $invitedata['inviter_id'][]=$invitation->inviter_id;
                  $invitedata['status'][]=$invitation->status;
            }
          return view('backend.dashboard.business_info.business_company_invitations.show',compact('invitedata','businessinvitation','nav_menu','route'));
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
    public function update(Request $request, $company_id, $inviter_id) {
      try{
        $businessinvite=  CompanyInvitation::where('company_id',$company_id)->where('inviter_id',$inviter_id)->first();
        $businessinvite->status="Accept";
        if($businessinvite->save()){
             return Redirect::route('invite.company.show')->with('message','Invitation accepted');
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $company_id, $inviter_id)
    {
      try{
       $businessinvite=  CompanyInvitation::where('company_id',$company_id)->where('inviter_id',$inviter_id)->first();
       $businessinvite->status="Deny";
       if($businessinvite->save()){
            return Redirect::route('invite.company.show')->with('message','Invitation denied');
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
     * Get the invitation status
     */
    public function invitationStatus(){
      try{
 
        $invitationstatus =  CompanyInvitation::where('inviter_id', Auth::user()->id)->paginate(25);
        
        $role = $this->getRoleName(Auth::user()->id);
        $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'MANAGE YOUR ALLIANCES')->where('lang','en')->get();
        $route = Route::getCurrentRoute()->getName();
        
        if(!empty($invitationstatus)){
            foreach($invitationstatus as $invitation){
              $invitedata['invitee'][] = $this->GetUserName($invitation->invitee_id);
              $company =  BusinessInfo::where('_id', $invitation->company_id)->first();
              if(!empty($company)){
                   $invitedata['company'][] = $company->company_name;
              }
              else {
                   $invitedata['company'][] = '';
              }
//            $invitedata['company_id'][]=$invitation->company_id;
//            $invitedata['invitee_id'][]=$invitation->invitee_id;
              $invitedata['status'][] = $invitation->status;
            }
            
            $update = AlertSystem::where('user_id','=',Auth::user()->id)->first();
            $update->business_partner = array('read_at'=>date("Y-m-d H:i:s"),"notification"=>"");
            $update->save();
            
            return view('backend.dashboard.business_info.business_company_invitations.status',compact('invitationstatus','invitedata','nav_menu','route'));
        }
        else {
           return Redirect::route('invite.company.index')->withErrors("You haven't sent any invitation. Search the company and send invitation. ");
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
    
    public function inviteForChat($id){
        try {
                $business =  BusinessInfo::where('_id', $id)->first();
                $user_name = $contact_name = "";
                $contact_name = $business->company_name;
                $users = array(Auth::user()->id , $business->user_id);
                $check_user_relation = ChatContacts::where('user_id','=', Auth::user()->id)->where('contact_id','=', $business->user_id)->where('type','=','singlechat')->first();

                if(!empty($check_user_relation)){
                    return Redirect::route('invite.company.index')->withErrors('The Chat Request for this user is already there. Accept the Chat Request or wait for the Response');
                }
                else {
                    $chatuserrelations = new ChattingUsersRelations();
                    $chatuserrelations->user_id = Auth::user()->id;
                    $chatuserrelations->users = $users;
                    $chatuserrelations->type = 'singlechat';
                    $chatuserrelations->status = 'Pending';
                    
                    if($chatuserrelations->save()){
                        $chat_id = ChattingUsersRelations::whereIn('users', $users)->where('type','=','singlechat')->first(); 
                        // Getting the personal Info and Logged In User.
                        $user_info_loggedin = PersonalInfo::where('user_id','=', Auth::user()->id)->first();
                        $user_loggedin= UserRole::where('user_id', Auth::user()->id)->first();
                        if(!empty($user_loggedin)){
                            $role_loggedin = Role::where('_id',$user_loggedin->role_id)->first();
                        }

                        if(!empty($user_info_loggedin)){
                            $user_name = $user_info_loggedin->first_name." ".$user_info_loggedin->second_name." ".$user_info_loggedin->surname;
                        }
                        else if(!empty($role_loggedin)){
                            $user_name = $role_loggedin->name;
                        }
                        else {
                            $admin =  BusinessInfo::where('_id', Auth::user()->id)->first();
                            $user_name = $admin->company_name;
                        }
                            
                        // Getting the personal Info of the User Contact.

                        $contact_info = PersonalInfo::where('user_id','=', $id)->first();

                        $contact_user = UserRole::where('user_id', $id)->first();
                        if(!empty($contact_user)){
                             $contact_role = Role:: where('_id', $contact_user->role_id)->first();
                        }

                        if(!empty($contact_info)){
                                $contact_name = $contact_info->first_name." ".$contact_info->last_name;  
                        }
                        else if(!empty($contact_role)){
                                $contact_name = $contact_role->name;
                        }

                        $chatuseradmin = new ChatContacts();
                        $chatuseradmin->user_id = Auth::user()->id;
                        $chatuseradmin->request_by = Auth::user()->id;
                        $chatuseradmin->contact_id = $business->user_id;
                        $chatuseradmin->users = $users;
                        $chatuseradmin->status = '0';
                        $chatuseradmin->request = 'Pending';
                        $chatuseradmin->contact_name = $contact_name;
                        $chatuseradmin->chat_id = $chat_id->_id;
                        $chatuseradmin->type = 'singlechat';

                        $chatusercontact = new ChatContacts();
                        $chatusercontact->user_id = $business->user_id;
                        $chatusercontact->request_by = Auth::user()->id;
                        $chatusercontact->contact_id = Auth::user()->id;
                        $chatusercontact->users = $users;
                        $chatusercontact->status = '0';
                        $chatusercontact->request = 'Pending';
                        $chatusercontact->contact_name = $user_name;
                        $chatusercontact->chat_id = $chat_id->_id;
                        $chatusercontact->type = 'singlechat';

                        if($chatuseradmin->save() && $chatusercontact->save()){
                            return Redirect::route('invite.company.index')->with('message', 'Chat Invitation sent.');
                        }
                        else {
                            return Redirect::route('invite.company.index')->with('error', 'Something went Wrong! Chat request could not be sent. Please try Again.');
                        }
                    }
                }
                return Redirect::route('invite.company.index')->with('message', 'Chat Invitation sent.');
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
