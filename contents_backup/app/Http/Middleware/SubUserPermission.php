<?php

namespace Gdoox\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;


class SubUserPermission
{
  use \Gdoox\Helpers\backend\dashboard\RolesUsers;
  use \Gdoox\Helpers\backend\dashboard\HelperFunctions;
  
    protected $auth;
    public function __construct(Guard $auth) {
      $this->auth=$auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
         if($this->auth->User()){
            $userID = $this->auth->user()->id;
            $parent_id = $this->getParentUser($userID);
            if(!empty($parent_id)){
                $permission2 =  $this->getSubUserPermission($userID);
                $action2 = $request->route()->getAction()['as'];
                if( in_array($action2, $permission2)){
                    return $next($request);
                }
                else {
                    return view('permission_denied');
                }
                return $next($request);
            }
            else {
                return $next($request);
            }
        }
         else {
              return  redirect('auth/login');
        }
    }
}
