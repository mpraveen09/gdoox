<?php

namespace Gdoox\Http\Controllers\backend\dashboard;

use DB;
use Auth;
use Gdoox\User;
use Gdoox\Models\FieldMaster;
use Gdoox\UserRole;
use Gdoox\Role;
use Input;
use Illuminate\Support\Facades\Session;
//use Illuminate\Support\Facades\Request;
use Gdoox\Http\Requests;
use Illuminate\Http\Request;
use Gdoox\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Gdoox\Models\BusinessInfo;
use Gdoox\Models\EcomShops;

use Gdoox\SubUser;
use Illuminate\Support\Facades\Mail;
use Gdoox\Models\BusinessEcommerceCompany;
use Illuminate\Support\Facades\Route;
use Gdoox\Models\NavigationMenu;
use Gdoox\Models\Products;
use Gdoox\Models\PersonalSiteDetail;
use Gdoox\Models\ShoppingCart;
use Gdoox\Models\PersonalInfo;
use Gdoox\Models\TeamMemberPermissionFields;
use Gdoox\Models\TeamMemberPermission;
use Gdoox\Models\InviteUser;

class UsersController extends Controller
{
  
  use \Gdoox\Helpers\backend\dashboard\RolesUsers;
  use \Gdoox\Helpers\backend\dashboard\UserInfoHelperFunctions;
  /**
     * Display Dashboard Index page.
     *
     * @return Dashboard
     */
    public function index(){
        try {
            if(Auth::user()){
              //Redirect user to thier sites, if present
              if(Auth::user()->hasRole('user')){
                  $site_info = PersonalSiteDetail::where('user_id', Auth::user()->id)->project('slug')->first();
                  if(!empty($site_info->slug)){
                    return redirect('/site/'.$site_info->slug);
                  }           
              }
              else {
                  $site_info =  BusinessEcommerceCompany::where('type', '=', 'business')
                      ->where('user_id',Auth::user()->id)->project('slug')->first();
                  if(!empty($site_info)){
                    return redirect('/site/'.$site_info->slug);
                  }           
                // other multi site add later
              }
              
              $user_count = User::count();
              $product_count = Products::count();
              $ab_cart_count = ShoppingCart::where('status','=','0')->count();
              $nav_menu = NavigationMenu::where('lang','en')->get();
              
              //If not site exists for the user
              return view('backend.dashboard.users.index',compact('ab_cart_count','nav_menu','nav_menu','user_count','product_count'));
            }
            else {
              Session::flash('message', 'Please login.');
              return redirect('/auth/login');
            }   
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }

    public function dash_board(){
        try {
                if(Auth::user()){
                    $user_count = User::count();
                    $product_count = Products::count();
                    $ab_cart_count = ShoppingCart::where('status','=','0')->count();
                    
                    $nav_menu = NavigationMenu::where('lang','en')->get();
                    return view('backend.dashboard.users.index',compact('nav_menu','user_count','product_count', 'ab_cart_count'));
                }
                else {
                    Session::flash('message', 'Please login.');
                    return redirect('/auth/login');
                }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }
    
    /**
     * Show the form for creating a new user.
     *
     * @return form
     */
    public function create(){
        try {
            if(Auth::user()){
                
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('parent', '1')->get();
                $route = Route::getCurrentRoute()->getName();
                
                $roles = Role::get();
                $roleid = $this->roleID(Auth::user()->id);
                $rolelevel = $this->getRoleLevel($roleid);
                foreach($roles as $role){
                    if(($role->level) >$rolelevel){
                        $rolename[$role->name]=$role->name;
                    }
                }  
                
                $fm_data = FieldMaster::where('title', '=', 'register')->where('lang', 'en')->first();
                $required = "*";

                return view('backend.dashboard.users.create')->with(compact('nav_menu','route','rolename','fm_data','required'));
            } 
            else {
                  Session::flash('message', 'Please Login First');
                  return redirect('auth/login');
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
     }

    /**
     * Store a newly created User in users collection.
     *
     * @param  Request  $request
     * @return user in the collection
     */
    public function store(Request $request){
        try {
            if(Auth::user()){
                
            $rules = array(
                'username' => 'required|max:25|unique:users|alpha_num|alpha_dash',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|confirmed|min:6',
             );
            
            $validator = Validator::make($request->all(), $rules);
            // process the validation
            if ($validator->fails()) {
                return Redirect('dashboard/user/create')->withErrors($validator)->withInput($request->all());                        
            }
            else {
            // store
                $user = new User();        
//                $user->name = $request->input('name'); 
//                $user->surname = $request->input('surname');
                $user->username = $request->input('username'); 
                $user->email = $request->input('email');
                $user->password = bcrypt($request->input('password'));
                $user->active = 0;
                if(Auth::user()){
                    $user->created_by = Auth::user()->id;
                    $user->parent_id = Auth::user()->id;
                }
                $user->activation_key = str_random(10).$request->input('email');
                $path = "uploads/".date('Y')."/".date('m')."/".strtolower($user->username)."/";
                $permission = 0777;
                $recursive = true;
                $this->make_directory($path, $permission, $recursive);
                $user->directory_path = $path;
                if ($user->save()) {
                    $data = array(
                    'username' => $user->username,
                    'email'=>$user->email,    
                    'activation_key' => \Illuminate\Support\Facades\URL::route('activate', $user->activation_key)
                    );
                    
                    // =========adding activation code and sending male===================
                   Mail::send('emails.activate', $data, function($message) use ($user) {
                        $message->from(Auth::user()->email, Auth::user()->username);
                        $message->to($user->email,$user->username)->subject('Please activate your account');
                    });

                    $user->role = $request->input('role');
                    $role_id =  $this->getRoleID($user->role);
                    $this->storeUserRole($user->id, $role_id);
                    // redirect
                    Session::flash('message', 'User Created Successfully, Activation Link has also been sent on the Registered Mail Id');
                    return Redirect::route('users');
                }
            }
          } 
            else {
              Session::flash('message', 'You must be login');
              return redirect('auth/login');
          }
        }
        catch(\Exception $e){
          $errors = $this->errorMessage($e);
          return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
     }
        
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id){
        try {
            if(Auth::user()){
                if(!empty($_GET['colleague'])){
                   $colleague = $_GET['colleague'];
                }

                 $user = User::where('_id', $id)->first();
                 $roles = UserRole::where('user_id',$user->id)->first();
                 $role = $this->getRole($roles->role_id);
                 $level =  $this->getRoleLevel($roles->role_id);
                 $fm_data = FieldMaster::where('title', '=', 'register')->first();
                 return view('backend.dashboard.users.show',compact('user', 'role', 'level','fm_data', 'colleague'));
            }   
            else {
                 Session::flash('message', 'Please Login First');
                 return redirect('auth/login');         
            }
         }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id){
        try {
            if(Auth::user()){
                if(!empty($_GET['colleague'])){
                   $colleague = $_GET['colleague'];
                }

                $user = User::find($id);
                $roless = UserRole::where('user_id',$user->id)->first();

                $userRole = $this->getRole($roless->role_id);
                $level =  $this->getRoleLevel($roless->role_id);

                $roleID = $this->roleID(Auth::user()->id);
                $userrole = $this->getRole($roleID);

                $roles=  Role::get();
                
                foreach($roles as $role){
                    if(($role->level) > Session::get('level')){
                           $rolename[$role->name] = $role->name;
                    }
                }
               
               $fm_data = FieldMaster::where('title', '=', 'register')->where('lang','en')->first();
               return view('backend.dashboard.users.edit',compact('user', 'userRole','rolename', 'level', 'fm_data', 'colleague','userrole'));
            }   
            else {
                Session::flash('message', 'Please Login First');
                return redirect('auth/login');         
            }
        }
        catch(\Exception $e){
          $errors = $this->errorMessage($e);
          return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id){
      try {
          //$password=($request->change_password!='') ? bcrypt($request->change_password) : $request->password;
            $user= ['email'=>$request->input('email'),
                    'name'=>$request->input('name'),
                    'password'=>$request->input('password')]; 
          
          User::where('_id', $id)->update($user, array('upsert' => true));
          
          if(!isset($request->colleague)){// Check for team member is set else company admins
              $roleID = $this->getRoleID($request->role);
              $userRole = array('role_id'=>$roleID);
              UserRole::where('user_id', $request->id)->update($userRole, array('upsert' => true));
              return redirect()->route('users')->with('message','User has been successfully updated');
          }
          else {
              return redirect()->route('colleague.all')->with('message','User has been successfully updated');
          }
      }
      catch(\Exception $e){
          $errors = $this->errorMessage($e);
          return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id){
         $user=  User::where('_id', $id)->first();
         if($user){
            $user->active=0;
            if($user->save()){
                return redirect()->back()->with('message','User has been deactivated successfully!');
            }
         }
    }
    
    public function showAll(Request $request){
        try {
         if($this->hasRole('superadmin') || $this->hasRole('multi-user-admin') || $this->hasRole('multi-site-admin')){
             $term = $request->input('term');
             $fm_data = FieldMaster::where('title', '=', 'register')->where('lang','en')->first();
             $role_id = $this->roleID(Auth::user()->id);//=@get the role_id===;
             $user_role = $this->getRole($role_id);//==@get the user role============
             $rolelevel = $this->getRoleLevel($role_id);//==@get the role level========= 
             
             if($this->hasRole('superadmin')){
                $allusers = User::get();
             } else {
                $allusers = User::where('parent_id', Auth::user()->id)->get();
             }
             
             $ids = array();
             $users = array();
             $roles = array();
             $allowedby = array();
             $createdby = array();
             foreach($allusers as $user){
                  $roleID = $this->roleID($user->id);
                  $role = $this->getRole($roleID);
                  $level = $this->getRoleLevel($roleID);           
                  if($rolelevel<$level){
                      if(count($user)){
                          $createdby[] = $this->GetUserName($user->parent_id); 
                          $users[] = $user;
                          $roles[] = $role;
                          $levels[] = $level;
                      }
                  }
             }//die;
             
             foreach($users as $key=>$value){
                 $ids[] = $value->_id;
             }
             
            $companies = BusinessEcommerceCompany::whereIn('user_id', $ids)->get();
            if(!empty($companies)) {
                foreach($companies as $company){
                    $comp[$company->user_id] = $company->ecomm_company_name;
                }
            }
            
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('parent', '1')->get();
            $route = Route::getCurrentRoute()->getName();
            return view('backend.dashboard.users.show_all',compact('nav_menu','route','users','roles','level','fm_data','createdby','levels','comp'))->with('term',$term);
                      
         }
         else {
              Session::flash('message', 'Please must be login first');
              return redirect('/auth/login');
            }  
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
     }
     /*
      * Search User from users list
      * 
      * @return search result in view
      */
    public function userSearch(Request $request) {
         try {
            $term= $request->input('term');
            $fm_data = FieldMaster::where('title', '=', 'register')->where('lang','en')->first();
            $role_id= $this->roleID(Auth::user()->id); //=@get the role_id===
            $user_role = $this->getRole($role_id); //==@get the user role============
            $rolelevel= $this->getRoleLevel($role_id); //==@get the role level========= 

            $allusers=User::where('username','like','%'.$term.'%')->orWhere('email','like','%'.$term.'%')->get();
            foreach($allusers as $user){
                 $roleID=$this->roleID($user->id);
                 $role=$this->getRole($roleID);
                 $level=$this->getRoleLevel($roleID);
                 if($level>$rolelevel){
                     if(count($user)>0){
                         $users[]=$user;
                     }
                 }
            }
           return view('backend.dashboard.users.show_all',compact('users','role','level','fm_data'))->with('term',$term);
         }
         catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
     }

    /**
     * Activate the registered user using activation link
     *
     * @return Response
     */
    public function activate($code){
        try {
            $user = User::where('activation_key', '=', $code)->where('active', '=', 0)->first();
            if(!empty($user)){
                $created = new \DateTime(date_format($user->updated_at, 'Y-m-d'));
                $now = new \DateTime(date("Y-m-d"));
                $interval = $created->diff($now)->days;
                if($interval < 7){
                  $user->active = 0;
                  $user->activation_key = '';
                   if($user->save()){
                       Session::flash('message', 'Your account has been activated.');
                       return redirect()->route('platform.info')->with('message','Your account has been activated.');
                      // return redirect('auth/login')->with('message','Activated! You can now sign in!');
                   }
                }
                else {
                   return redirect('auth/register')->with('message','Your activation key has been expired. Please Register again');  
                }
            }
            else {
                 return redirect()->route('platform.info')->with('message','You have already Activated your Account. Please Login with the Registered Email Id and Password!.');
//               return redirect('auth/login')->with('message','You have already Activated your Account. Please Login with the Registered Email Id and Password!');
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }
    
    public function platformInfo(){
        try {
           return view('auth.platform_info');
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }

    public function reactivate($id){
        try {
            $user= User::where('active', '=', 0)->where('_id', $id)->first();
            $user->active=1;
            $user->activation_key='';
            if($user->save()){
                 return redirect()->back()->with('message','User has been activated!');
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }
    
    /*
     * Allow the user to access 
     */
    
    public function allow($id){
        try {
                $user =  User::where('_id', $id)->first();
                $toplevel = array();
                $sublevel = array();
                $assigned = array();
                $ecomsites = array();

                $labels = TeamMemberPermissionFields::where('type','permissions')->where('lang','en')->get();
                $labelsmain = TeamMemberPermissionFields::where('type','permission_group')->where('lang','en')->get();


                $assigned_permissions = TeamMemberPermission::where('admin',Auth::user()->id)->where('team_member_id', $id)->first();

                $assigned_crm_permissions = TeamMemberPermission::where('admin',Auth::user()->id)->where('team_member_id', $id)->where('type','crm')->first();
            
                if(!empty($labelsmain)){
                    foreach($labelsmain as $main){
                        $toplevel[$main->name] = $main->label;
                    }
                }

                // Change the group by name when added to database. group will change, name will not change.
                if(!empty($labels)){
                    foreach($labels as $label){
                        $sublevel[$label->group][] = $label->label;
                    }
                }

                if(!empty($assigned_permissions)){
                    foreach($assigned_permissions->route_ids as $assignedper){
                        $assigned[] = $assignedper;
                    }
                }
            
                if(!empty($assigned_crm_permissions)){
                    foreach($assigned_crm_permissions->route_ids as $assignedcrm){
                        $assigned[] = $assignedcrm;
                    }
                }

                $ecommSites = BusinessEcommerceCompany::where('user_id',Auth::user()->id)->where('type','!=','Company Network Site')->get();
                $permission = EcomShops::where('site_admin_id', $id)->get();
            
                foreach($ecommSites as $sites){
                    $ecomsites[$sites->slug] = $sites->ecomm_company_name;
                }

                $fm_data = FieldMaster::where('title', '=', 'register')->where('lang','en')->first(); 
                return view('backend.dashboard.users.allow_access',compact('user','fm_data','personalSites', 'ecommSites', 'permission', 'temp', 'perm','toplevel','sublevel','id','assigned','ecomsites'));
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }
    
    public function manageTeamMemberPermissions(Request $request, $id){
        if(Auth::user()){
            $data = $request->all();
            $rules = array(
                'ecomsite'=>'required'
            );
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput($request->all());                        
            }
            
            $ecomsite = $data['ecomsite'];
            
            $user =  User::where('_id', $id)->first();
            $toplevel = array();
            $sublevel = array();
            $assigned = array();
            $ecomsites = array();

            $labels = TeamMemberPermissionFields::where('type','permissions')->where('lang','en')->get();
            $labelsmain = TeamMemberPermissionFields::where('type','permission_group')->where('lang','en')->get();
            
            $assigned_permissions = TeamMemberPermission::where('admin',Auth::user()->id)->where('team_member_id', $id)->where('e_comsite',$ecomsite)->first();
            $assigned_crm_permissions = TeamMemberPermission::where('admin',Auth::user()->id)->where('team_member_id', $id)->where('type','crm')->first();
            $assigned_proc_permissions = TeamMemberPermission::where('admin',Auth::user()->id)->where('team_member_id', $id)->where('type','procurements')->first();
            
            if(!empty($labelsmain)){
                foreach($labelsmain as $main){
                    $toplevel[$main->name] = $main->label;
                }
            }
            
            // Change the group by name when added to database. group will change, name will not change.
            if(!empty($labels)){
                foreach($labels as $label){
                    $sublevel[$label->group][] = $label->label;
                }
            }
            
            if(!empty($assigned_permissions)){
                foreach($assigned_permissions->route_ids as $assignedper){
                    $assigned[] = $assignedper;
                }
            }
            
            if(!empty($assigned_crm_permissions)){
                foreach($assigned_crm_permissions->route_ids as $assignedcrm){
                    $assigned[] = $assignedcrm;
                }
            }
            
            if(!empty($assigned_proc_permissions)){
                foreach($assigned_proc_permissions->route_ids as $assignedproc){
                    $assigned[] = $assignedproc;
                }
            }

            $permission = EcomShops::where('site_admin_id', $id)->get();
 
            $fm_data = FieldMaster::where('title', '=', 'register')->where('lang','en')->first(); 
            return view('backend.dashboard.users.manage_permissions',compact('user','fm_data','personalSites', 'ecomsite', 'permission', 'temp', 'perm','toplevel','sublevel','id','assigned','ecomsites','assigned_crm_permissions','assigned_permissions'));
 
        }
        else {
            return redirect()->route('auth/login')->with('message','Please Login');
        }
    }
    
    
    public function storeTeamMemberPermissions(Request $request, $id){
        if(Auth::user()){
            $user = User::where('_id', $id)->first();
            $roles = UserRole::where('user_id',$user->id)->first();
            $role = $this->getRole($roles->role_id);
            $all_permissions = array();
            $all_labels = array();

            $data = $request->all();
            
            $type = $data['type'];
            $assign_as_admin = $data['assign_as_admin'];

            if($type==='ecomsite'){ 
                if($assign_as_admin==='yes'){
                    $ecomsite = $data['e_comsite'];
                    $admin_permissions = TeamMemberPermissionFields::where('group','Manage e-commerce Site')->get();
                    foreach($admin_permissions as $perms){
                        foreach($perms->routes as $key=>$val){
                            if(!empty($val)){
                                $all_permissions[] = $val;   
                            }
                        }
                        // Getting all the Labels of the Routes;
                        $all_labels [] = $perms->label;
                    }

                    $checkroute = TeamMemberPermission::where('admin',Auth::user()->id)->where('e_comsite', $ecomsite)->where('team_member_id',$id)->where('type','ecomsite')->first(); 

                    if(empty($checkroute)){
                        $createroute = new TeamMemberPermission();
                        $createroute->admin = Auth::user()->id;
                        $createroute->team_member_id = $id;
                        $createroute->route_ids = $all_labels;
                        $createroute->e_comsite = $ecomsite;
                        $createroute->routes = $all_permissions;
                        $createroute->role = $role;
                        $createroute->type = 'ecomsite';
                        $createroute->is_site_admin = 'yes';

                        if($createroute->save()){
                            return redirect()->route('user-allow', $id)->with('message','Permissions Granted Successfully');
                        }
                        else {
                            return redirect()->back()->with('message','Something went wrong! Please try Again');
                        }
                    }
                    else {
                            $checkroute->route_ids = $all_labels;
                            $checkroute->routes = $all_permissions;
                            $checkroute->is_site_admin = 'yes';
                            if($checkroute->save()){
                                return redirect()->route('user-allow', $id)->with('message','Permissions Updated Successfully');
                            }
                            else {
                                return redirect()->back()->with('message','Something went wrong! Please try Again');
                            }
                        }     
                }
                elseif($assign_as_admin==='remove'){
                    $ecomsite = $data['e_comsite'];
                    $removeroute = TeamMemberPermission::where('admin',Auth::user()->id)->where('e_comsite', $ecomsite)->where('team_member_id',$id)->where('type','ecomsite')->first();
                    $remove = array();
                    $removeroute->route_ids = $remove;
                    $removeroute->routes = $remove;
                    $removeroute->is_site_admin = 'no';
                    if($removeroute->save()){
                        return redirect()->route('user-allow', $id)->with('message','Permissions Updated Successfully');
                    }
                    else {
                        return redirect()->back()->with('message','Something went wrong! Please try Again');
                    }
                }
                else {
                    $rules = array(
                        'permission' => 'required',
                        'e_comsite'=>'required'
                    );
                    
                    $validator = Validator::make($request->all(), $rules);
                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput($request->all());                        
                    }
                    
                    $ecomsite = $data['e_comsite'];
                    $permissions = $data['permission'];
                    $routes = $this->getRoutes($permissions);

                    $checkroute = TeamMemberPermission::where('admin',Auth::user()->id)->where('e_comsite', $ecomsite)->where('team_member_id',$id)->where('type','ecomsite')->first(); 
                    
                    if(empty($checkroute)){
                        $createroute = new TeamMemberPermission();
                        $createroute->admin = Auth::user()->id;
                        $createroute->team_member_id = $id;
                        $createroute->route_ids = $permissions;
                        $createroute->e_comsite = $ecomsite;
                        $createroute->routes = $routes;
                        $createroute->role = $role;
                        $createroute->type = 'ecomsite';
                        $createroute->is_site_admin = 'no';

                        if($createroute->save()){
                            return Redirect::route('user-allow', $id)->with('message','Permissions Granted Successfully');
                        }
                        else {
                            return redirect()->back()->with('message','Something went wrong! Please try Again');
                        }
                    }
                    else {
                            $checkroute->route_ids = $permissions;
                            $checkroute->routes = $routes;
                            $checkroute->is_site_admin = 'no';
                            if($checkroute->save()){
                                return Redirect::route('user-allow', $id)->with('message','Permissions Updated Successfully');
                            }
                            else {
                                return redirect()->back()->with('message','Something went wrong! Please try Again');
                            }
                    }  
                }
            }

            elseif($type==='procurements'){
                $rules = array(
                    'permission_procurement' => 'required',
                );

                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());                        
                }

                $permissions = $data['permission_procurement'];
                $routes = $this->getRoutes($permissions);
                $checkroute = TeamMemberPermission::where('admin',Auth::user()->id)->where('team_member_id',$id)->where('type','procurements')->first();
                if(empty($checkroute)){
                    $createroute = new TeamMemberPermission();
                    $createroute->admin = Auth::user()->id;
                    $createroute->team_member_id = $id;
                    $createroute->route_ids = $permissions;
                    $createroute->routes = $routes;
                    $createroute->role = $role;
                    $createroute->type = 'procurements';

                    if($createroute->save()){
                        return Redirect::route('user-allow', $id)->with('message','Permissions Granted Successfully');
                    }
                    else {
                        return redirect()->back()->with('message','Something went wrong! Please try Again');
                    }
                }
                else {
                    $checkroute->route_ids = $permissions;
                    $checkroute->routes = $routes;
                    if($checkroute->save()){
                        return Redirect::route('user-allow', $id)->with('message','Permissions Updated Successfully');
                    }
                    else {
                        return redirect()->back()->with('message','Something went wrong! Please try Again');
                    }
                }   
            }

            else {
                if($assign_as_admin==='yes'){
                    $admin_permissions = TeamMemberPermissionFields::where('group','CRM Administrator')->get();
                    foreach($admin_permissions as $perms){
                        foreach($perms->routes as $key=>$val){
                            if(!empty($val)){
                                $all_permissions[] = $val;   
                            }
                        }
                        // Getting all the Labels of the Routes;
                        $all_labels [] = $perms->label;
                    }

                    $checkroute = TeamMemberPermission::where('admin',Auth::user()->id)->where('team_member_id',$id)->where('type','crm')->first(); 

                    if(empty($checkroute)){
                        $createroute = new TeamMemberPermission();
                        $createroute->admin = Auth::user()->id;
                        $createroute->team_member_id = $id;
                        $createroute->route_ids = $all_labels;
                        $createroute->routes = $all_permissions;
                        $createroute->role = $role;
                        $createroute->type = 'crm';
                        $createroute->is_crm_admin = 'yes';

                        if($createroute->save()){
                            return Redirect::route('user-allow', $id)->with('message','Permissions Granted Successfully');
                        }
                        else {
                            return redirect()->back()->with('message','Something went wrong! Please try Again');
                        }
                    }
                    else {
                            $checkroute->route_ids = $all_labels;
                            $checkroute->routes = $all_permissions;
                            $checkroute->is_crm_admin = 'no';
                            if($checkroute->save()){
                                return Redirect::route('user-allow', $id)->with('message','Permissions Updated Successfully');
                            }
                            else {
                                return redirect()->back()->with('message','Something went wrong! Please try Again');
                            }
                        }     
                }
                elseif($assign_as_admin==='remove'){
                    $removeroute = TeamMemberPermission::where('admin',Auth::user()->id)->where('team_member_id',$id)->where('type','crm')->first();
                    $remove = array();
                    $removeroute->route_ids = $remove;
                    $removeroute->routes = $remove;
                    $removeroute->is_crm_admin = 'no';
                    if($removeroute->save()){
                        return Redirect::route('user-allow', $id)->with('message','Permissions Updated Successfully');
                    }
                    else {
                        return redirect()->back()->with('message','Something went wrong! Please try Again');
                    }
                }
                else {
                    $rules = array(
                        'permission_crm' => 'required',
                    );

                    $validator = Validator::make($request->all(), $rules);
                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput($request->all());                        
                    }

                    $permissions = $data['permission_crm'];
                    $routes = $this->getRoutes($permissions);
                    $checkroute = TeamMemberPermission::where('admin',Auth::user()->id)->where('team_member_id',$id)->where('type','crm')->first();

                    if(empty($checkroute)){
                        $createroute = new TeamMemberPermission();
                        $createroute->admin = Auth::user()->id;
                        $createroute->team_member_id = $id;
                        $createroute->route_ids = $permissions;
                        $createroute->routes = $routes;
                        $createroute->role = $role;
                        $createroute->type = 'crm';
                        $createroute->is_crm_admin = 'no';

                        if($createroute->save()){
                            return Redirect::route('user-allow', $id)->with('message','Permissions Granted Successfully');
                        }
                        else {
                            return redirect()->back()->with('message','Something went wrong! Please try Again');
                        }
                    }
                    else {
                        $checkroute->route_ids = $permissions;
                        $checkroute->routes = $routes;
                        $checkroute->is_crm_admin = 'no';
                        if($checkroute->save()){
                            return Redirect::route('user-allow', $id)->with('message','Permissions Updated Successfully');
                        }
                        else {
                            return redirect()->back()->with('message','Something went wrong! Please try Again');
                        }
                    }
                } 
            } 
        }
        else {
            return redirect()->route('auth/login')->with('message','Please Login');
        }
    }
    
    public function getRoutes($permissions){
        $permroutes = TeamMemberPermissionFields::whereIn('name', $permissions)->get();  
        $routes = array();

        foreach($permroutes as $proutes){
            foreach($proutes->routes as $key=>$value){
                if(!empty($value)){
                    $routes[] = $value;
                }
            }
        }
        return $routes;
    }
    
    /*
     * Create Site Admin
     */
    public function siteAdminCreate(Request $request, $id){
        try {
          if($request->ajax()){
            $site = EcomShops::where('slug', $request->site_slug)->first();
            if(empty($site->site_admin_id)){
                $data = ['site_admin_id' => $id, 'permission' => $request->permission, 'response_status' => 'Pending'];
                DB::collection('business_ecommerce_companies')->where('slug', $request->site_slug)->update($data, ['upsert' => true]);
                return ['success' => true];
            }
            else {
                $errors = ['Site has already an admin. Please remove that admin first or give custom permission to this user for site'];
                return ['success' => false, 'errors' => $errors ];
            }
          }
       }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return ['success' => false, 'errors' => $errors ];
        } 
    }

    /*
     * Remove Site Admin
     */
    public function siteAdminRemove(Request $request, $id){
        try {
          if($request->ajax()){
            $site = EcomShops::where('slug', $request->site_slug)->first();
            $site->unset('site_admin_id');
            $site->unset('permission');
            $site->unset('response_status');
            $site->save();
            return ['success' => true];
          }
       }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return ['success' => false, 'errors' => $errors ];
        } 
    }
/*
 * 
 */
    public function storeTeamMemberPermission(){
      try{
        return Redirect::route('colleague.all');
      } 
      catch (Exception $ex) {
            $errors = $this->errorMessage($e);
            return ['success' => false, 'errors' => $errors ];
      }
    }

    /*
     * All Gdoox Members
     */
    
    public function allGdooxMember(){
      if(Auth::user()){
        try {
            $fm_data = FieldMaster::where('title', '=', 'register')->where('lang','en')->first();
            
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('parent', '1')->get();
            $route = Route::getCurrentRoute()->getName();
          
            $role_id = $this->roleID(Auth::user()->id);//=@get the role_id===;
            $user_role = $this->getRole($role_id);//==@get the user role============
            $rolelevel = $this->getRoleLevel($role_id);//==@get the role level========= 
            if($this->hasRole('superadmin')){
               $allusers = User::get();
            } else {
               $allusers = User::where('parent_id', Auth::user()->id)->get();
            }
            $users = array();
            $roles = array();
            $allowedby = array();
            $createdby = array();
            foreach($allusers as $user){
                $roleID = $this->roleID($user->id);
                $role = $this->getRole($roleID);
                $level = $this->getRoleLevel($roleID);           
                if($role == "gdoox-member"){
                    if(count($user)){
                        $createdby[] = $this->GetUserName($user->parent_id); 
                        $users[] = $user;
                        $roles[] = $role;
//                      $levels[]=$level;
                    }
                }
           }
            return view('backend.dashboard.users.all_gdoox_member',compact('route','nav_menu','users','roles','level','fm_data','createdby','levels'));
        } catch (Exception $ex) {
              $errors = $this->errorMessage($e);
              return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
      }
       else{
           return redirect('auth/login')->with('message', 'Please Login First');
       }
    }
    
    /*
     * Create Gdoox Member
     */
    public function createGdooxMember(){
      if(Auth::user()){
        try { 
            $required = "*";
            $roleid = $this->roleID(Auth::user()->id);
            $rolelevel = $this->getRoleLevel($roleid);
            $rolename = "gdoox-member";
            $term = "gdoox-member";

            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('parent', '1')->get();
            $route = Route::getCurrentRoute()->getName();
         
          $fm_data = FieldMaster::where('title', '=', 'register')->where('lang', 'en')->first();
          
          return view('backend.dashboard.users.invite_colleague')->with(compact('route','nav_menu','rolename','fm_data','required', 'term'));
        } catch (Exception $ex) {
              $errors = $this->errorMessage($e);
              return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
      }
      else {
            Session::flash('message', 'Please Login First');
            return redirect('auth/login');
      }
    }
    /*
     * Store Gdoox Member
     */
    public function store_gdoox_member(Request $request){
      try{
        $rules = array(
        'username' => 'required|max:25|unique:users|alpha_num|alpha_dash',
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required|confirmed|min:6',
         );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());                        
        }
        else {
            $user= new User();
//            $user->name = $request->input('name');
//            $user->surname = $request->input('surname');
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->active = 1;
            if(Auth::user()){
                  $user->created_by=Auth::user()->id;
                  $user->parent_id=Auth::user()->id;
            }
            $user->activation_key='';
            if ($user->save()) {
                $user->role = $request->input('role');
                $role_id = $this->getRoleID($user->role);
                $this->storeUserRole($user->id, $role_id);
                Session::flash('message', 'Gdoox member added');
                return Redirect::route('gdoox_member.view_all');
            }
        }
      } catch (Exception $ex) {
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
      }
    }
    /*
     *Manage Permission for gdoox members 
     */
    public function managePermisson($id){
      if(Auth::user()){
        try {
                $user = User::where('_id', $id)->first();
                $permission = SubUser::where('sub_user_id', $id)->where('parent_id', Auth::user()->id)->first();
                $fm_data = FieldMaster::where('title', '=', 'register')->where('lang','en')->first(); 
            
                return view('backend.dashboard.users.manage_permission',compact('user', 'fm_data', 'permission'));
        }
        catch (Exception $ex) {
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
      }
      else {
          Session::flash('message', 'Please Login First');
          return redirect('auth/login');
      }
    }
/*
 *Store permission of Gdoox Member 
 */
    public function storeGdooxMemberPermission(Request $request, $id){
      try{
            $data = [
                'sub_user_id' => $id, 
                'parent_id' => Auth::user()->id, 
                'permission' =>$request->permission
            ];

            DB::collection('sub_users')->where('sub_user_id', $id)->where('parent_id', Auth::user()->id)->update($data, ['upsert' => true]);
            return Redirect::route('gdoox_member.view_all')->with('message', 'Gdoox Member permission updated');
        }
        catch (Exception $ex) {
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
      }
    }
/**
* Show the form for creating a new user.
*
* @return form
*/
    public function InviteColleague() {
        if(Auth::user()){ 
            try {
                
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('group','managing_account')->where('parent', '20')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();
          
                $company = BusinessInfo::where('user_id', Auth::user()->id)->first();
                $sites = array();
                if(!empty($company)){
                    $sites = EcomShops::where('company_id', $company->id)->get();
                    $required="*";
                    $rolename = "team-member";
                    $fm_data = FieldMaster::where('title', '=', 'register')->where('lang', 'en')->first();
                    $term = "team-member";
                    return view('backend.dashboard.users.invite_colleague')->with(compact('route','nav_menu','rolename','fm_data','required', 'term'));
                }
                else{
                  return redirect()->back()->withErrors("You have not any company. Create your company.");
                }
            }
            catch(\Exception $e){
                $errors = $this->errorMessage($e);
                return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
            } 
        } 
        else {
              Session::flash('message', 'Please Login First');
              return redirect('auth/login');
        }
     }
     /*
      * Store Team Member
      */
    public function store_team_member(Request $request){
      try {
        if(Auth::user()){ 
          $rules = array(
              'username' => 'required|max:25|unique:users|alpha_num|alpha_dash',
              'email' => 'required|email|max:255|unique:users',
              'password' => 'required|confirmed|min:6',
           );
          $validator = Validator::make($request->all(), $rules);
          if ($validator->fails()) {
              return redirect()->back()->withErrors($validator)->withInput($request->all());                        
          }
          else {
              $user= new User();
              $team_member = array();
//                $user->name = ""; 
//                $user->surname = "";
              $user->username = $request->input('username'); 
              $user->email = $request->input('email');
              $user->password = bcrypt($request->input('password'));
              $user->active = 1;
              if(Auth::user()){
                  $user->created_by = Auth::user()->id;
                  $user->parent_id = Auth::user()->id;
              }

              $user->activation_key='';
              if ($user->save()) {
                  $company_user = BusinessInfo::where('user_id', Auth::user()->id)->first();
                  $team_members = array();
                  if(!empty($company_user->team_members)){
                      $team_members = $company_user->team_members;
                  }
                      $company_user->team_members = array_merge($team_members, [$user->id]) ;
                      $company_user->save();
                      $user->role = $request->input('role');
                      $role_id = $this->getRoleID($user->role);
                      $this->storeUserRole($user->id, $role_id);
                      Session::flash('message', 'Team member added');
                      return Redirect::route('colleague.all');
                  }
              }
          }
          else {
              Session::flash('message', 'You must be login');
              return redirect('auth/login');
        }
      }
      catch(\Exception $e){
        $errors = $this->errorMessage($e);
        return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
      }
   }

    public function AllColleague(Request $request){
        try {
            $users = array();
            $roles = array();
            $allowedby = array();
            $createdby = array();
            $site = array();
            $name = array();
            $surname = array();
            
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('group','managing_account')->where('parent', '20')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
            $fm_data = FieldMaster::where('title', '=', 'register')->where('lang','en')->first();
            
            
            if($this->hasRole('superadmin') || $this->hasRole('multi-user') || $this->hasRole('ecosystem-user') || $this->hasRole('multi-site-user')){
                $term = $request->input('term');
                $role_id = $this->roleID(Auth::user()->id);//=@get the role_id===;
                // $user_role = $this->getRole($role_id);//==@get the user role============
                $rolelevel = $this->getRoleLevel($role_id);//==@get the role level========= 
                
                $userinfo = BusinessInfo::where('user_id', Auth::user()->id)->first();

                if(!empty($userinfo)){
                    $site = EcomShops::where('company_id', $userinfo->id)->get();
                    
                    if(!empty($userinfo->team_members)){
                        foreach($userinfo->team_members as $user){
                            $roleID = $this->roleID($user); //Team Members Role id
                            $role = $this->getRole($roleID);
                            $level = $this->getRoleLevel($roleID); //Team Members Role Level          
                            if($rolelevel < $level){
                                if(count($user)){
                                    $memberinfo = PersonalInfo::where('user_id', $user)->first();
                                    if($memberinfo){
                                        $name[] = $memberinfo->first_name;
                                        $surname[] = $memberinfo->surname;
                                    }
                                    else {
                                        $name[] = "N/A";
                                        $surname[] = "N/A";
                                    }
                                    
                                    $users[] = User::where('_id', $user)->first();
                                    $createdby[] =  $this->GetUserName($userinfo->user_id); 
                                    $roles[] = $role;
                                    $levels[] = $level;
                                }
                            }
                        }
                    } 
                }
               return view('backend.dashboard.users.all_colleague',compact('route','nav_menu','users','roles','level','fm_data','createdby','levels','site','name','surname'))->with('term',$term);
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }    
     }
      
    public function EditColleague(Request $request){
        try {
           if(Auth::user()){
               
               $data = $request->all();
               $id = $data['id'];
               
               $user = User::find($id);
               $roless = UserRole::where('user_id',$user->id)->first();

               $userRole = $this->getRole($roless->role_id);
               $level =  $this->getRoleLevel($roless->role_id);

               $roleID = $this->roleID(Auth::user()->id);
               $userrole = $this->getRole($roleID);

               $roles=  Role::get();
               foreach($roles as $role){
                   if(($role->level) > Session::get('level')){
                          $rolename[$role->name] = $role->name;
                   }
               }

              $fm_data = FieldMaster::where('title', '=', 'register')->where('lang','en')->first();
              return view('backend.dashboard.users.edit_colleague',compact('user', 'userRole','rolename', 'level', 'fm_data', 'colleague','userrole'));
           }   
           else {
               Session::flash('message', 'Please Login First');
               return redirect('auth/login');         
           }
       }
       catch(\Exception $e){
         $errors = $this->errorMessage($e);
         return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
       }
    }

    public function UpdateColleague(Request $request){
         try {
                $request->all();
                $id = $request['id'];

                $rules = array(
                    'password' => 'required|confirmed|min:6',
                    'email' => 'required|email|max:60|unique:users,email,'.$id.',_id'
                );
                
                $validator = Validator::make($request->all(), $rules);
                // process the validation
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());                        
                }
                
                if($request->input('password') == $request->input('pwd')){
                    $password = $request->input('password');
                }
                else {
                    $password = bcrypt($request->input('password'));
                }
                
                $user = ['email'=>$request->input('email'),
                'name'=>$request->input('name'),
                'password'=>$password];
          
                User::where('_id', $id)->update($user, array('upsert' => true));
                return redirect()->route('colleague.all')->with('message','User has been successfully updated');
      }
      catch(\Exception $e){
          $errors = $this->errorMessage($e);
          return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
      }
     }
     
    public function registerUser($email, $gdoox_code=""){
        try {
            $required = "*";
            $fm_data = FieldMaster::where('title', 'register')->where('lang', 'en')->first();
            $partner = InviteUser::where('email', $email)->first();
            return view('auth.register', compact('fm_data', 'required', 'email','gdoox_code','partner'));
            
        } catch (\Exception $e) {
            $error = "An error occured. " .
                "Line Number: " . $e->getLine() . " " .
                "File Name: " . $e->getFile() . " " .
                "Error Description: " . $e->getMessage();
            return view('errors.custom_error')->withErrors($error);
        }
    }

    public function errorMessage($e){
      $error = "An error occured. ".
          "Line Number: ".$e->getLine()." ".
          "File Name: ".$e->getFile()." ".
          "Error Description: ".$e->getMessage(); 
      return $error;
  }

}
