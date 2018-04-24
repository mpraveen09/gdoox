<?php

namespace Gdoox\Http\Middleware;
//use Auth;
use DB;
use Closure;
use Illuminate\Contracts\Auth\Guard;

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
                    else{
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