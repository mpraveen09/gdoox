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
use Gdoox\Models\BusinessInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Gdoox\Http\Requests;
use Gdoox\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Gdoox\Models\NavigationMenu;
use Illuminate\Support\Facades\Route;
use Gdoox\Models\ShareSite;
use Gdoox\Models\EcomShops;

class ExternalBusinessPartnersController extends Controller {

use \Gdoox\Helpers\backend\dashboard\HelperFunctions;
use \Gdoox\Helpers\backend\dashboard\RolesUsers;

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        try {
            if(Auth::user()){
                $required = '*';
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('parent', '36')->where('group','business_ecosystem')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();
                
                $fm_data = FieldMaster::where('title', '=', 'invite_user')->where('lang', '=', 'en')->first();
                $business_info = BusinessInfo:: where('user_id', Auth::user()->id)->get();
                if (!$business_info->count()) {
                    return redirect()->back()->withErrors('You have no company profile. Please create a company and e-store first');
                }
                
                return view('backend.dashboard.business_partners.external_partners.create', compact('fm_data', 'required','nav_menu','route'));
            } else {
                return redirect('auth/login')->with('message', "You must be login!");
            }
        } catch (\Exception $e) {
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message', 'Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        try {
            if (Auth::user()) {
                $check = BusinessPartner::where('inviter_id', Auth::user()->id)->where('email', $request->email)->where('type','!=','Company Network')->first();
                if (!empty($check)) {
                    return redirect()->back()->withErrors('You have already sent the partnership invitation to this person');
                }

                $rules = array(
                    'email' => 'required|email|unique:business_partners',
                );

                $validator = Validator::make($request->all(), $rules);
                $partner = new BusinessPartner();

                // process the validation
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                } 
                else {
                    $code = $this->randomString(6);
                    $invitation_code = BusinessPartner::where('gdoox_code', '=', $code)->first();

                    if (!empty($invitation_code->gdoox_code)) {
                        $partner->gdoox_code = 'B-ECOSYS-'.strtoupper($this->randomString(7));
                    } else {
                        $partner->gdoox_code = 'B-ECOSYS-'.strtoupper($this->randomString(6));
                    }


                    $partner->name = $request->input('name');
                    $partner->email = $request->input('email');
                    $partner->inviter_id = Auth::user()->id;
                    $partner->inviter_email = Auth::user()->email;
                    $partner->invitation_date = date("Y-m-d", time());
                    $partner->status = "Accept/Deny";
                    $partner->type = 'External';
                    $partner->viewed = '0';
                    $partner->register = 0;
                    if ($partner->save()) {
                        $data = array('username' => $partner->name,
                            'email' => $partner->email,
                            'gdoox_code' => $partner->gdoox_code,
                            'inviter' => $partner->inviter_email,
                            'registration_link' => URL::to('auth/register', $partner->gdoox_code));

                        Mail::send('emails.external_business_partners', $data, function($message) use ($partner) {
                            $message->from($partner->inviter_email, $this->GetUserName($partner->inviter_id));
                            $message->to($partner->email, $partner->name)->subject('New invitation with Gdoox code');
                        });
                    }
                    // die;
                    return Redirect::route('invite.ext.partner.create')->with('message', 'Invitation Sent.');
                }
            } else {
                return redirect('auth/login')->with('message', "You must be login!");
            }
        } catch (\Exception $e) {
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message', 'Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show() {
        if (Auth::user()) {
            try {
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('parent', '36')->where('group','business_ecosystem')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();
                
                $joinrequest = BusinessPartner::where('invitee_id', Auth::user()->id)->where('request_type', '=', 'join')->where('type','!=','Company Network')->paginate(25);
                if (count($joinrequest)) {
                    foreach ($joinrequest as $request) {
                        $joindata['inviter'][] = $this->GetUserName($request->inviter_id);
                        $joindata['inviter_email'][] = $request->inviter_email;
                        $joindata['email'][] = $request->email;
                        $joindata['inviter_id'][] = $request->inviter_id;
                        $joindata['status'][] = $request->status;
                        $joindata['request_site'][] = $request->site_slug;
                        $joindata['invitation_date'][] = $request->invitation_date;
                        $joindata['inviter_company'][] = $this->GetCompany($request->inviter_id);
                    }
                }

                $businessinvitation = BusinessPartner::where('invitee_id', Auth::user()->id)->where('request_type', '!=', 'join')->where('type','!=','Company Network')->orderBy('invitation_date', 'desc')->paginate(25);
                if (count($businessinvitation)) {
                    foreach ($businessinvitation as $invitation) {
                        $invitedata['inviter'][] = $this->GetUserName($invitation->inviter_id);
                        $invitedata['inviter_email'][] = $invitation->inviter_email;
                        $invitedata['email'][] = $invitation->email;
                        $invitedata['company_site_slug'][] = $invitation->company_site_slug;
                        $invitedata['message'][] = $invitation->message;
                        $invitedata['inviter_id'][] = $invitation->inviter_id;
                        $invitedata['status'][] = $invitation->status;
                        $invitedata['invitation_date'][] = $invitation->invitation_date;
                        $invitedata['inviter_company'][] = $this->GetCompany($invitation->inviter_id);
                    }
                }

                $joinstatus = BusinessPartner::where('inviter_id', Auth::user()->id)->where('request_type', '=', 'join')->where('type','!=','Company Network')->orderBy('invitation_date', 'desc')->paginate(25);
                if (count($joinstatus) > 0) {
                    foreach ($joinstatus as $join) {
                        $joindata['invitee'][] = $join->name;
                        $joindata['invitee_email'][] = $join->email;
                        $joindata['type'][] = $join->type;
                        $joindata['status'][] = $join->status;
                        $joindata['for_site'][] = $join->site_slug;
                        $joindata['invitation_date'][] = $join->invitation_date;
                        $joindata['id'][] = $join->id;
                    }
                }

                $invitationstatus = BusinessPartner::where('inviter_id', Auth::user()->id)->where('request_type', '!=', 'join')->where('type','!=','Company Network')->orderBy('invitation_date', 'desc')->paginate(25);
                if (count($invitationstatus) > 0) {
                    foreach ($invitationstatus as $invitation) {
                        $invitedata['invitee'][] = $invitation->name;
                        $invitedata['invitee_email'][] = $invitation->email;
                        $invitedata['invitee_company'][] = $this->GetCompany($invitation->invitee_id);
                        $invitedata['type'][] = $invitation->type;
                        $invitedata['message'][] = $invitation->message;
                        $invitedata['status'][] = $invitation->status;
                        $invitedata['invitation_date'][] = $invitation->invitation_date;
                        $invitedata['id'][] = $invitation->id;
                    }
                }
                
                $fm_data =  FieldMaster::where('title','business_info')->where('lang','en')->first();
                $category = $this->searchCategories($fm_data);

                return view('backend.dashboard.business_partners.show', compact('nav_menu','route','invitedata', 'businessinvitation', 'joindata', 'joinrequest', 'invitationstatus', 'invitedata', 'joinstatus', 'joindata','fm_data','category'));
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
    public function update(Request $request, $company_site_slug, $inviter_id) {
        try {
            $businessrequest = BusinessPartner::where('company_site_slug', $company_site_slug)->where('inviter_id', $inviter_id)->where('type','!=','Company Network')->where('request_type', '=', 'join')->first();
           
            if (count($businessrequest)) {
                $businessrequest->status = "Accepted";
                $businessrequest->accepted_date = date("Y-m-d", time());
                if ($businessrequest->save()) {
                    return Redirect::route('invite.partner.show')->with('message', 'Invitation accepted');
                }
            }
            
            $businessinvite = BusinessPartner::where('company_site_slug', $company_site_slug)->where('inviter_id', $inviter_id)->where('type','!=','Company Network')->where('request_type', '!=', 'join')->first();
            $businessinvite->status = "Accepted";
            $businessinvite->accepted_date = date("Y-m-d", time());
              
            // $ecomshop = EcomShops::where('user_id',Auth::user()->id)->first();
            $invitercomp = EcomShops::where('user_id',$businessinvite->inviter_id)->first();
            
            $sharedata = new ShareSite();
            $sharedata['invitee_id'] =  $businessinvite->invitee_id;
            $sharedata['inviter_id'] =  $businessinvite->inviter_id;
            $sharedata['invited_comp_site_slug'] = $businessinvite->company_site_slug;
            $sharedata['ecosystem_name'] = $businessinvite->ecosystem_name;
            $sharedata['ecosystem_slug'] = $businessinvite->ecosystem_slug;
            // $sharedata['siteslug'] = $ecomshop->slug;
            $sharedata['siteslug'] = $company_site_slug;
            $sharedata['message'] = "Invitation Accepted";
            $sharedata['type'] = 'Business Ecosystem';
            $sharedata['status'] = 'Shared';
            $sharedata['message'] = $sharedata['message'];
            $sharedata['inviter_name'] = $this->GetUserName($sharedata['inviter_id']);
            $sharedata['inviter_company'] = $invitercomp->company;
                        
            if ($businessinvite->save()) {
                if($sharedata->save()){
                    return Redirect::route('invited-business-partners.list_products', [$businessinvite->company_site_slug, $inviter_id])
                            ->with('message', 'Invitation Accepted and the Site is Shared, Please share your products with the Inviting Company');
                    // return Redirect::route('invite.partner.show')->with('message', 'Invitation Accepted and the Site is Shared');
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
    public function destroy($company_site_slug, $inviter_id) {
        if (Auth::user()) {
            try {
                $businessinvite = BusinessPartner::where('company_site_slug', $company_site_slug)->where('inviter_id', $inviter_id)->where('type','!=','Company Network')->first();
                $businessinvite->status = "Denied";
                $businessinvite->deny_date = date("Y-m-d", time());
                if ($businessinvite->save()) {
                    return Redirect::route('invite.partner.show')->with('message', 'Invitation denied');
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

    
    public function PartnerRegister($code) {
        try {
            $required = "*";
            $fm_data = FieldMaster::where('title', 'register')->where('lang', 'en')->first();
            $partner = BusinessPartner::where('gdoox_code', $code)->project('email')->first();
            $email = $partner->email;
            return view('auth.register', compact('fm_data', 'required', 'email'));
            
        } catch (\Exception $e) {
            $error = "An error occured. " .
                    "Line Number: " . $e->getLine() . " " .
                    "File Name: " . $e->getFile() . " " .
                    "Error Description: " . $e->getMessage();
            return view('errors.custom_error')->withErrors($error);
        }
    }

    /*
     * Get the invitation status
     */
    
//  The code of this func has been moved to show method of this controller to club accept/deny and invitation status
    
//    public function status() {
//        if (Auth::user()) {
//            try {
//                $joinstatus = BusinessPartner::where('inviter_id', Auth::user()->id)->where('request_type', '=', 'join')->orderBy('invitation_date', 'desc')->paginate(25);
//                if (count($joinstatus) > 0) {
//                    foreach ($joinstatus as $join) {
//                        $joindata['invitee'][] = $join->name;
//                        $joindata['invitee_email'][] = $join->email;
//                        $joindata['type'][] = $join->type;
//                        $joindata['status'][] = $join->status;
//                        $joindata['for_site'][] = $join->site_slug;
//                        $joindata['invitation_date'][] = $join->invitation_date;
//                        $joindata['id'][] = $join->id;
//                    }
//                }
//
//                $invitationstatus = BusinessPartner::where('inviter_id', Auth::user()->id)->where('request_type', '!=', 'join')->orderBy('invitation_date', 'desc')->paginate(25);
//                if (count($invitationstatus) > 0) {
//                    foreach ($invitationstatus as $invitation) {
//                        $invitedata['invitee'][] = $invitation->name;
//                        $invitedata['invitee_email'][] = $invitation->email;
//                        $invitedata['type'][] = $invitation->type;
//                        $invitedata['status'][] = $invitation->status;
//                        $invitedata['invitation_date'][] = $invitation->invitation_date;
//                        $invitedata['id'][] = $invitation->id;
//                    }
//                }
//
//                return view('backend.dashboard.business_partners.status', compact('invitationstatus', 'invitedata', 'joinstatus', 'joindata'));
//            } catch (\Exception $e) {
//                $error = "An error occured. " .
//                        "Line Number: " . $e->getLine() . " " .
//                        "File Name: " . $e->getFile() . " " .
//                        "Error Description: " . $e->getMessage();
//                return view('errors.custom_error')->withErrors($error);
//            }
//        } else {
//            return redirect('auth/login')->with('message', "You must be login!");
//        }
//    }
    
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
    
    public function errorMessage($e) {
        $error = "An error occured. " .
                "Line Number: " . $e->getLine() . " " .
                "File Name: " . $e->getFile() . " " .
                "Error Description: " . $e->getMessage();
        return $error;
    }

}
