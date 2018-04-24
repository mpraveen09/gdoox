<?php

namespace Gdoox\Http\Middleware;
//use Auth;
use DB;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Gdoox\Models\GdooxSubscriptionInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use Carbon\Carbon;
class Permission 
{
  use \Gdoox\Helpers\backend\dashboard\RolesUsers;
  use \Gdoox\Helpers\backend\dashboard\HelperFunctions;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $auth;
    public function __construct(Guard $auth) {
      $this->auth = $auth;
    }
    
            
    public function handle($request, Closure $next){
         if($this->auth->User()){
            $userID = $this->auth->user()->id;
            $roleID = $this->roleID($userID);
            $roleName = $this->getRoleName($userID);
            
            // If the roles are in the following array, the payment subscription should not be asked.
            $users = array('superadmin','gdoox-member','team-member');
            if(!in_array($roleName, $users)){
                $payments = GdooxSubscriptionInfo::where('userid', Auth::user()->id)->first();
				
				//22 dec 2016 // Deep
				if(empty($payments)){
					$subsinfo= new GdooxSubscriptionInfo;

					$subsinfo->userid = Auth::user()->id;
					$first_login = Carbon::now();
					$first_login->toDateTimeString();
					$subsinfo->first_login = $first_login; //Carbon::now();//time();
					if($subsinfo->save()){
						//saved first login info
					}
					else {
						//error in logging first login date
					}
				}else{

					
				 	$first_login = new Carbon($payments->first_login['date']);
					$now = Carbon::now();
					$difference = ($first_login->diff($now)->days );
					
					if($difference >= 0 && $difference < 15){
						//Trial OK
					}else{
						
						if(!empty($payments->startdate)){
							$startdate = new Carbon($payments->startdate['date']);
							$now = Carbon::now();
							$difference = ($startdate->diff($now)->days );

							if($difference >= 0 && $difference < 365){
								//Subscription OK
							}else{
								return Redirect::route('account-payment.create',compact('email'))
									->with('message','Subscription renewal is Due, Please complete the Subscription Payment.');							
							}
						}else{
								return Redirect::route('account-payment.create',compact('email'))
									->with('message','Your Trial Period Expired and Subscription is Due, Please complete the Subscription Payment.');				
						}
						

					}
				}
				//
				
				
				//if(empty($payments)){
				//	return Redirect::route('account-payment.create',compact('email'))->with('message','Your Subscription is Due, Please complete the Subscription Payment.');
				//}
            }
            
            $permission =  $this->getPermission($roleID);
            $team_membr_permission = $this->getTeamMemberPermission();
            
            $parent_id = $this->getParentUser($userID);
            $action = $request->route()->getAction()['as'];
            if(in_array($action, $permission)){
              return $next($request);
            }
            elseif(in_array($action, $team_membr_permission)){
                return $next($request);
            }
            else {
                $team_member_permission = $this->siteAdminPermission($userID);
                if(!empty($parent_id)){
                  $gdoox_member_permission =  $this->getSubUserPermission($userID);
                  if( in_array($action, $gdoox_member_permission)){
                      return $next($request);
                  }
                  else {
                      return view('permission_denied');
                  }
                }
                if(!empty($team_member_permission)){
                    if(in_array($action, $team_member_permission)){
                        return $next($request);
                    }
                    else {
                        return view('permission_denied');
                    }
                }
                return view('permission_denied');
            }
        }
         else {
              return  redirect('auth/login');
        }
    }
}