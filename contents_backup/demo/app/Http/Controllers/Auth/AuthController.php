<?php

namespace Gdoox\Http\Controllers\Auth;

use DB;
use Auth;
use File;
use Validator;
use Gdoox\Role;
use Gdoox\User;
use Gdoox\UserRole;
use Gdoox\Helpers\UUID ;
use Gdoox\Models\InviteUser;
use Gdoox\Permission;
use Gdoox\Models\BusinessPartner;
use Gdoox\Models\PositionInComapany;
use Illuminate\Http\Request;
use Gdoox\Models\PersonalInfo;
use Gdoox\Models\SocialInfo;
use Gdoox\Models\InterestInfo;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Gdoox\Models\RelationInfo;
use Gdoox\Models\FieldMaster;
use Gdoox\Http\Controllers\Controller;
use Gdoox\Models\UserLanguagePreference;
use Gdoox\Models\GdooxSubscriptionInfo;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */
 
    protected $redirectPath = '/dashboard';
    protected $loginPath = '/auth/login';
	protected $redirectAfterLogout = 'http://gdoox.com/plans';

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    use \Gdoox\Helpers\backend\dashboard\RolesUsers;
    use \Gdoox\Helpers\backend\dashboard\UserInfoHelperFunctions;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */ 
    public function __construct() {
        $this->middleware('guest', ['except' => 'getLogout']);
        if(!isset($_COOKIE['gdoox_global_val']) || empty($_COOKIE['gdoox_global_val'])){
            $timestamp = time();
            $cookie = UUID::v4() . "-" . $timestamp;
            setcookie('gdoox_global_val', $cookie, time() + (86400 * 30), "/demo/");
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
            'username' => 'required|max:25|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }
    /*
     * Get login
     */
    public function getLogin() {
        if (view()->exists('auth.authenticate')) {
            $fm_data = FieldMaster::where('title', '=', 'register')->where('lang', 'en')->first();            
            return view('auth.authenticate', compact('fm_data'));
        }
        
        $fm_data = FieldMaster::where('title', '=', 'register')->where('lang', 'en')->first();
        return view('auth.login', compact('fm_data'));
    }
    /*
     * Post login 
     */
    public function postLogin(Request $request) {
        $this->validate($request, [
           'email' => 'required|email', 'password' => 'required',
        ]);
        
        if(!isset($_SESSION['app_language']) && empty($_SESSION['app_language'])) {
            session(['app_language' => 'en']);
        }
        
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'active' => 1])){
                $this->userPersonalInfo($request->email);
                $this->appLanguage();
                $email = $request->email;
                
                $userID = Auth::user()->id;
                $roleName = $this->getRoleName($userID);
                $users = array('superadmin','gdoox-member','team-member');
                if(!in_array($roleName, $users)){
                    $payments = GdooxSubscriptionInfo::where('email', $request->email)->first();
                    if(empty($payments)){
                        //return Redirect::route('account-payment.create',compact('email'))->with('message','Your Subscription is Due, Please complete the Subscription Payment.');
                    }
                }
                return redirect()->intended($this->redirectPath());
            }
            else {
                return redirect($this->loginPath()) // Change this to redirect elsewhere
                    ->withInput($request->only('email', 'remember'))
                    ->with('message','You must be active to login.');
            }    
        }
         
        return redirect($this->loginPath())
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
            $this->loginUsername() => $this->getFailedLoginMessage(), ]);
    }

    public function getRegister(Request $request) {
        $fm_data = FieldMaster::where('title', 'register')->where('lang', 'en')->first();
        $data = $request->all();
        $required = "*";
        return view('auth.register', compact('fm_data','required','email','data'));
    }
    
    /*
     * Register with invitation code
     */
    public function getInvitedRegister($code){
        $fm_data = FieldMaster::where('title', 'register')->where('lang', 'en')->first();
        $user = InviteUser::where('gdoox_code', $code)->project('email')->first();
        $email = $user->email;
        $required = "*";
        return view('auth.register', compact('fm_data','required','email'));
    }

  /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request){         
        $rules = array(
            'username' => 'required|max:25|unique:users|alpha_num|alpha_dash',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        );        
         
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            $this->throwValidationException($request, $validator);
        }

         $this->create($request->all());
         
         return Redirect('/thanks')->with('message', ' "User Created!" Please find the activation link on registered e-mail');
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data){   
        
            $user = new User();            
            $user->username = $data['username']; 
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->parent_id = isset(Auth::user()->id)?Auth::user()->id:"";
            $user->active = 0;
            $user->activation_key = str_random(10).$data['email'];
            if(isset($data['user_type'])){
                $user->role = $data['user_type'];
            }
            
            $path =  "/uploads/".date('Y')."/".date('m')."/".strtolower($user->username);
            $permission = 0777;
            $recursive = true;
            $this->make_directory($path, $permission, $recursive);
            $user->directory_path = $path;
            if ($user->save()) {
                $data = array(
                    'username' => $user->username,
                    'email' => $user->email,    
                    'activation_key' => URL::route('activate', $user->activation_key)
                );
            // =========adding activation code and sending male===================
                Mail::send('emails.activate', $data, function($message) use ($user) {
                     $message->from('info@gdoox.com', 'Gdoox');
                     $message->to($user->email,$user->username)->subject('Please activate your account');
                });
                
                $businesspartner = BusinessPartner::where('email', $user->email)->first();
                $role_id = $this->getRoleID('user');
                if(!empty($businesspartner->gdoox_code)){
                    $role_id = $this->getRoleID('mono-admin'); 
                    $this->storeUserRole($user->id, $role_id);
                    BusinessPartner::where('email', $user->email)->update(['register'=>1,'status'=>'Pending','type'=>'Internal','invitee_id'=>$user->id]);
                }
                else {
                    $this->storeUserRole($user->id, $role_id);
                }
                // InviteUser::where('email', $user->email)->update(['register'=>1]);
           }
           //   return $user;
      }
  
  public function getRoleId($role){
    $data = Role::where('name',$role)->first();
    if(!empty($data)){
       return $data->id;
    }
    else {
      return ;
    }
  }
/*
 * Store users personal, social, interest, relation information at the time of login
 */
  protected function userPersonalInfo($email){
        $personaldata = PersonalInfo::where('user_id', Auth::user()->id)->first();
        $position = PositionInComapany::where('user_id', Auth::user()->id)->first();
    //  $socialdata = SocialInfo::where('user_id', Auth::user()->id)->first();
        $interestdata = InterestInfo::where('user_id', Auth::user()->id)->first();
        $relationdata = RelationInfo::where('user_id', Auth::user()->id)->first();
        if(empty($personaldata)) $this->storeUserPersonalInfo($email, Auth::user()->id);
        if(empty($position)) $this->storePosition($email, Auth::user()->id);
        if(empty($interestdata)) $this->storeUserInterestInfo($email, Auth::user()->id);
        if(empty($relationdata)) $this->storeUserRelationInfo($email, Auth::user()->id);
        
//        if(empty($personaldata) && empty($position) && empty($interestdata) && empty($relationdata) ){
//            $this->storeUserPersonalInfo($email, Auth::user()->id);
//            $this->storeUserSocialInfo($email, Auth::user()->id);
//            $this->storePosition($email, Auth::user()->id);
//            $this->storeUserInterestInfo($email, Auth::user()->id);
//            $this->storeUserRelationInfo($email, Auth::user()->id);
//       }
   }
   
   protected function appLanguage(){
       if(Auth::user()){
            $applang = UserLanguagePreference::where('user_id', Auth::user()->id)->orWhere('cookie_id', $_COOKIE['gdoox_global_val'])->first();
            if(!empty($applang)){
                session(['app_language' => $applang->language]);
            }
            else {
                $lang = new UserLanguagePreference();
                $lang->language = 'en';
                $lang->cookie_id = $_COOKIE['gdoox_global_val'];
                $lang->user_id = Auth::user()->id;
                $lang->save();
                session(['app_language' => 'en']);
            }
        }
        return;
   }
}

