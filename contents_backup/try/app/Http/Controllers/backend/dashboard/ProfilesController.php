<?php

namespace Gdoox\Http\Controllers\backend\dashboard;

use Auth;
use DB;
use Gdoox\User;
use Gdoox\UserRole;
use Illuminate\Http\Request;
use Gdoox\Http\Requests;
use Gdoox\Models\FieldMaster;
use Gdoox\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Gdoox\Models\NavigationMenu;

class ProfilesController extends Controller
{
  use \Gdoox\Helpers\backend\dashboard\RolesUsers;
  use \Gdoox\Helpers\backend\dashboard\ImageUpload;
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('group','personal_profile')->where('parent', '13')->where('lang','en')->get();
        $route = Route::getCurrentRoute()->getName();
        
        $profile = User::find(Auth::user()->id);
        if(!empty($profile)){
            $user = UserRole::where('user_id', Auth::user()->id)->first();
            $role = $this->getRole($user->role_id);
            $fm_data = FieldMaster::where('title', '=', 'account_info')->where('lang', 'en')->first();

            return view('backend.dashboard.users.profiles.index',compact('route','nav_menu','profile','role','fm_data'));
        }
        else {  
          return response()->view('errors.404', [], 404);
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('group','personal_profile')->where('parent', '13')->where('lang','en')->get();
        $route = Route::getCurrentRoute()->getName();
        
        $profile = User::find($id);
        if(!empty($profile)){
            $user = UserRole::where('user_id', Auth::user()->id)->first();
            $role = $this->getRole($user->role_id);
            $fm_data = FieldMaster::where('title', '=', 'account_info')->where('lang', 'en')->first();
            return view('backend.dashboard.users.profiles.edit',compact('route','nav_menu','profile','role','fm_data'));
        }
        else {
            return response()->view('errors.404', [], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
         if(Auth::user()){
              $rules=['new_password'=>'confirmed|min:6'];
              $validator = Validator::make($request->all(), $rules);
              if($validator->fails()){
                  return back()->withErrors($validator)->withInput($request->all());                        
              }
              else{
                  $password=($request->new_password!='') ? bcrypt($request->new_password) : $request->password;
                  $success="Your Profile has been updated successfully";
                  $error="Wrong file please choose an image file";
                  if(!empty($request->profile_image)){
                      $path =  Auth::user()->directory_path."/profile_pic/";
                      $permission = 0777;
                      $pic_name = strtolower(Auth::user()->username)."_profile_pic.";
                      $profile_image = $this->uploadImage($request->profile_image, $pic_name, $path, $permission, true); 
                      User:: where('_id',$request->id)->update(['username'=>$request->username,'email'=>$request->email,'password'=>$password,'profile_image'=>$profile_image, 'profile_image_path' => $path ]);
                        
                      return Redirect::route('profile-index')->with('message',$success);
                  }
                  else {
                      $update = User:: where('_id',$request->id)->update(['username'=>$request->username,'email'=>$request->email,'password'=>$password]);
                   
                      return Redirect::route('profile-index')->with('message','Your Profile has been updated');
                  }
             }   
         }
        else{
         
              return redirect('auth/login')->with('message', 'Please Login First');
         }
    }
}
