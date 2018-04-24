<?php

namespace Gdoox\Http\Controllers\backend\dashboard\business_info;

use DB;
use Gdoox\Models\BusinessInfo;
use Illuminate\Support\Facades\Auth;
use Gdoox\Models\BusinessCompanyInvitation;
use Illuminate\Support\Facades\Request;
use Gdoox\Models\FieldMaster;
use Gdoox\Models\EcomShops;
use Gdoox\Models\DropdownOption;
use Gdoox\Models\BusinessSectors;
use Gdoox\User;
use Illuminate\Support\Facades\Redirect;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Gdoox\Http\Controllers\Controller;

class BusinessCompanyInvitationsController extends Controller
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
          $fm_data=  FieldMaster::where('title','business_info')->where('lang','en')->first();

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
          $category['category_name'] = 'Business Category';
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
                  $interest = BusinessSectors::where('category_name','like','%'.$search_val.'%')
                        ->where('user_id', '!=', Auth::user()->id)->where('type','=','business_sectors')->get();
                  
                  foreach($interest as $val) {
                        $ids[] = trim($val->user_id);
                  }
                  
                  $business_info = BusinessInfo::whereIn('user_id', $ids)->where('status','=','Active')->paginate(25);
              }

              else {
                  $business_info = BusinessInfo::where('status','=','Active')->where($search['filter'],'like','%'.trim($search_val).'%')
                    ->where('user_id', '!=', Auth::user()->id)->paginate(25);      
              }

               return view('backend.dashboard.business_info.business_company_invitations.index',compact('fm_data','business_info','term','category','search_val'));
            // return view('backend.dashboard.search_business_info.index',compact('fm_data'))->with('business_info',$business_info)->with('term',$term)->with('category',$category)->with('estore',$estore);
          }
          else
          {   
              $term['term']='0';
              $search_val= '';
              return view('backend.dashboard.business_info.business_company_invitations.index',compact('fm_data','category','term','search_val'));
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
    public function store($id)
    {
      try{
        $business=  BusinessInfo::where('_id', $id)->first();
        $invitation=  BusinessCompanyInvitation::where('company_id',$id)->where('inviter_id',Auth::user()->id)->first();
        if(!empty($invitation)){
             return Redirect::route('invite.business.company.index')->withErrors('This invitation is already sent. Please wait while owner reponse');
        }
        else{
            $business_company_invitation=new  BusinessCompanyInvitation();
            $business_company_invitation->company_id=$business->id;
    //        $business_company_invitation->invitee_name=$this->GetUserName($business->user_id);
    //        $business_company_invitation->invitor_name=  $this->GetUserName(Auth::user()->id);
            $business_company_invitation->invitee_id=$business->user_id;
            $business_company_invitation->inviter_id=Auth::user()->id;
            $business_company_invitation->status="Pending";
            if($business_company_invitation->save()){
                return Redirect::route('invite.business.company.index')->with('message', 'Invitation sent.');
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
        try{
          $businessinvitation=  BusinessCompanyInvitation::where('invitee_id', Auth::user()->id)->paginate(25);
          foreach($businessinvitation as $invitation){
            $invitedata['inviter'][]=  $this->GetUserName($invitation->inviter_id);
            $invitedata['company'][]=$this->getCompanyName($invitation->company_id);
            $invitedata['company_id'][]=$invitation->company_id;
            $invitedata['inviter_id'][]=$invitation->inviter_id;
            $invitedata['status'][]=$invitation->status;
          }
  //        print_r($invitedata); die;
          return view('backend.dashboard.business_info.business_company_invitations.show',compact('invitedata','businessinvitation'));
//        print_r($businessinvitation);
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
    public function update(Request $request, $company_id, $inviter_id)
    {
      try{
        $businessinvite=  BusinessCompanyInvitation::where('company_id',$company_id)->where('inviter_id',$inviter_id)->first();
        $businessinvite->status="Accept";
        if($businessinvite->save()){
             return Redirect::route('invite.business.company.show')->with('message','Invitation accepted');
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
       $businessinvite=  BusinessCompanyInvitation::where('company_id',$company_id)->where('inviter_id',$inviter_id)->first();
       $businessinvite->status="Deny";
       if($businessinvite->save()){
            return Redirect::route('invite.business.company.show')->with('message','Invitation denied');
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
    public function InvitationStatus(){
      try{
        $invitationstatus=  BusinessCompanyInvitation::where('inviter_id', Auth::user()->id)->paginate(25);
//        echo"<pre>";print_r($invitationstatus); die;
        if(count($invitationstatus)>0){
            foreach($invitationstatus as $invitation){
              $invitedata['invitee'][]=  $this->GetUserName($invitation->invitee_id);
              $invitedata['company'][]=$this->getCompanyName($invitation->company_id);
//              $invitedata['company_id'][]=$invitation->company_id;
//              $invitedata['invitee_id'][]=$invitation->invitee_id;
              $invitedata['status'][]=$invitation->status;
            }
            return view('backend.dashboard.business_info.business_company_invitations.status',compact('invitationstatus','invitedata'));
        }
        else{
           return Redirect::route('invite.business.company.index')->withErrors("You haven't sent any invitation. Search the company and send invitation. ");
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
