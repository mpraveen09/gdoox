<?php

namespace Gdoox\Helpers\backend\dashboard;

use DB;
use Gdoox\UserRole;
use Gdoox\Role;
use Gdoox\User;
use Gdoox\SubUser;
use Gdoox\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Gdoox\Models\TeamMemberPermission;

trait RolesUsers
{
   /**
     * Store  User Role in the  'user_role' collection
     *
     * @return Response
     */
    public function storeUserRole($userID, $roleID){
         $user_role = new UserRole();
         $roles = $user_role->fill(['user_id'=>$userID,'role_id'=>$roleID]);
         $user_role->save(); 
    }
    /*
     * 
     * Get Sub User permission
     */
    public function getSubUserPermission($subuserid){
         $data = SubUser:: where('sub_user_id', $subuserid)->first();
         if(!empty($data->permission)){
           return $data->permission;
         }
         else {
           return array();
         }
    }
    /*
     * Get Parent User
     */
     public function getParentUser($subuserid){
       $parent = '';
       $data = SubUser::where('sub_user_id', $subuserid)->first();
       if(!empty($data->parent_id)){
           $parent = $data->parent_id;
       }
       return $parent;
      } 
     /**
     * Display a Role ID with the argument role name
     *
     * @return Response
     */
    public function getRoleID($role)
    {
         $data = Role::where('name',$role)->first();
         return $data->id;
    }
   
    /*
     * Get role_id with argument user_id
     */
    public function roleID($userID){
        $data = UserRole::where('user_id' ,'=', $userID)->first();
        return $data->role_id;
    }
    
    
    public function getRoleName($userID){
        $data = UserRole::where('user_id' ,'=', $userID)->first();
        $role = Role:: where('_id',$data->role_id)->first();
        return $role['name'] ;
    }
   
    /*
     * Get the role_id with the argument role level
     */
    
    public function get_Role_ID($level){
        $data = Role::where('level', '=',$level)->first();  
        return $data->_id;
    }
    /**
     * Display a Role with role id
     *
     * @return Response
     */
    public function getRole($role_id){
         $role = Role:: where('_id',$role_id)->first();
         return $role['name'] ;
    }
    /**
     * Display a Role with username
     *
     * @return Response
     */
    public function UserRoleName($username){
         $user = User::where('username',$username)->first();
         $role_id = $this->roleID($user->id);
         $role= Role:: where('_id',$role_id)->first();
         return $role['name'] ;
    }
     /**
     * Display a Role Level.
     *
     * @return Response
     */
    public function getRoleLevel($role_id){
         $role= Role:: where('_id',$role_id)->first();
        
         return $role['level'] ;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getPermission($role_id){
         $permission='';
         $data = Role:: where('_id',$role_id)->first();
         return $data->permission;
    }
    
    public function getTeamMemberPermission(){
        $perm = array();
        
        $datasite = TeamMemberPermission::where('team_member_id', Auth::user()->id)->first();
        $datacrm = TeamMemberPermission::where('team_member_id', Auth::user()->id)->where('type','crm')->first();
        
        if(!empty($datasite)){
            $perm = $datasite->routes; 
        }
        
        if(!empty($datacrm)){
            $perm = $datacrm->routes; 
        }
        
        return $perm;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getActivate($code)
    { 
        $user= User::where('activation_key', '=', $code)->where('active', '=', 0)->first();
       // print_r($user); die;
        if($user){
           // $user=$user->first();
            $user->active=1;
            $user->activation_key='';

            if($user->save()){
                  return redirect('auth/login')->with('message','Activated! You can now sign in!');
            }
        }
         return redirect('auth/register')->with('message','Could not activate your account. Try again later.');
    }
    /*
     * Check Role of user
     */
    public function hasRole($role)
     {
        $roleID=$this->roleID(Auth::user()->id);
        $rolename= $this->getRole($roleID); 
        if($rolename==$role){
            return true;
        }
        return false;
    }
    /*
     * Get UserName
     */
    public function GetUserName($userid){
      $user=  User::where('_id', $userid)->first();
      if(!empty($user)){
          return $user->username;
      }
      else{
        return "-";
      }
      
    }
    /*
     * Get User Email
     */
    public function GetUserEmail($userid){
      $user=  User::where('_id',$userid)->first();
//      echo"<pre>";print_r($user); die;
      if(!empty($user)){
          return $user->email;
      }
      else{
        return "-";
      }
      
    }
        
}
