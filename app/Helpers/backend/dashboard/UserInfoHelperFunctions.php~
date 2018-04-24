<?php
/*
 * This trait is used for store document data in the collection
 */
namespace Gdoox\Helpers\backend\dashboard;

use DB;
use Auth;
use File;
use Validator;
use Gdoox\User;
use Gdoox\Permission;
use Illuminate\Http\Request;
use Gdoox\Models\PositionInComapany;
use Gdoox\Models\PersonalInfo;
use Gdoox\Models\SocialInfo;
use Gdoox\Models\InterestInfo;
use Gdoox\Models\RelationInfo;

trait UserInfoHelperFunctions{
  /*
   * Storing user email, id in personal_info collection
   */
  
  public function storeUserPersonalInfo($email, $user_id){
      $personal_info=new PersonalInfo;
      $personal_info->email=$email;
      $personal_info->user_id=$user_id; 
      $personal_info->save();          
  }
  /*
   * Storing user email, id in pr_position_in_company collection
   */
  
  public function storePosition($email, $user_id){
      $position = new PositionInComapany;
      $position->email=$email;
      $position->user_id=$user_id; 
      $position->save();          
  }
//  /*
//   * Storing user email, id in social_info collection
//   */
//  
//  public function storeUserSocialInfo($email, $user_id){
//      $social_info=new SocialInfo;
//      $social_info->email=$email;
//      $social_info->user_id=$user_id;
//      $social_info->save(); 
//  }
  /*
   * Storing user email, id in interest_info collection
   */
  
  public function storeUserInterestInfo($email, $user_id){
      $interest_info=new InterestInfo();
      $interest_info->email=$email;
      $interest_info->user_id=$user_id;
      $interest_info->save();     
  }
  
  /*
   * Storing user email, id in gdoox_relations collection
   */
  
  public function storeUserRelationInfo($email, $user_id){
      $relation_info=new RelationInfo();
      $relation_info->email=$email;
      $relation_info->user_id=$user_id;
      $relation_info->save();                  
  }
  /*
   * Make directories
   */
    public function make_directory($path, $permission, $recursive){
      $dir_path = public_path($path); 
      if(!File::exists($dir_path)){
        //$dir = File::makeDirectory($dir_path, $permission, $recursive);
        $dir = File::makeDirectory($dir_path, $permission, $recursive, TRUE);// updated to force suppress errors - Deep 26/09/2016
          return $dir;
      }
      else {
        return $dir_path;
      }
    }
}
