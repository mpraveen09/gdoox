<?php

namespace Gdoox\Http\Controllers\backend\dashboard;

use DB;
use Auth;
use Gdoox\User;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Excel;
use Gdoox\Models\InviteUser;
use Gdoox\Models\FieldMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Gdoox\Http\Requests;
use Gdoox\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use Gdoox\Models\NavigationMenu;

class InviteMultiUsersController extends Controller
{
    use \Gdoox\Helpers\backend\dashboard\HelperFunctions;
    use \Gdoox\Helpers\backend\dashboard\ImageUpload;
    use \Gdoox\Helpers\backend\dashboard\RolesUsers;
  
   public function __construct(Excel $excel) {
        $this->excel = $excel;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        try {
            if(Auth::user()){
                $role = $this->getRoleName(Auth::user()->id);   
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'USER MANAGEMENT')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();
                
                $fm_data = FieldMaster::where('title', '=', 'invite_user')->where('lang', '=', 'en')->first();
                $required='*';
                return view('backend.dashboard.users.invite_multi_users.create',  compact('nav_menu','route','fm_data','required'));
             }
             else {
                 return redirect('auth/login')->with('message','You must be login');
             }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        try {
                $req = $request->all();
                $available_invites = 0;
                $new_invites = 0;
                $message = "";
                
                $rules = array(
                    'excelfile' => 'required',
//                  'file' => 'required|mimes:xls,et,xlsx',
                    'confirm'=>'required',
                );
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                     return Redirect()->back()->withErrors($validator)->withInput($request->all());                        
                }
                else {
                     $name = $request->file('excelfile')->getClientOriginalName();
                     $path = Auth::user()->directory_path."/invite_users/";
                     $mulituser = $this->upload($req['excelfile'], $name, $path, 0777, true);
                     $fileName = $path.$mulituser;
                     $code = '';
                     $col = 'B';
                     $row = '1048576';
                     
                     $users =  $this->UsersImport($fileName, $col, $row);
                     
                     $existingusers = User::all();
                     
                     if(!empty($existingusers)){
                         foreach($existingusers as $existing){
                            $existingemails[] = $existing->email;
                        }
                     }
                     
                     $exist_email_count = 0;
                     if(!empty($users)){
                         foreach($users as $key=>$user){
                            if(in_array($user['email'], $existingemails)){
                                unset($users[$key]);
                                $exist_email_count++;
                            }
                        }
                     }
                     
                     if($exist_email_count > 0){
                         $message.= $exist_email_count." Email Id(s) already Exist in the Gdoox Platfrom from the List and is already is User.<br />";
                     }
                     
                     foreach($users as $user){
                        // Check if Invitation is already Sent Before to the User.
                        $validate = InviteUser::where('email',$user['email'])->first();
                        
                        if(!empty($validate)){
                            $validate->mono_ac_percentage = $req['mono_ac_percentage'];
                            $validate->multi_ac_percentage = $req['multi_ac_percentage'];
                            $validate->com_net_percentage = $req['com_net_percentage'];
                            $validate->business_eco_pecentage = $req['business_eco_pecentage'];
                            $validate->register = 0;
                            
                            if($request->confirm == 1){
                                $code = $this->randomString(6);
                                if(!empty($validate->gdoox_code)){
                                    while ($validate->gdoox_code == $code){
                                        $code = $this->randomString(7);
                                    }
                                    $validate->gdoox_code = 'GDOOX-'.strtoupper($code);
                                }
                                else {
                                    $validate->gdoox_code =  'GDOOX-'.strtoupper($code);
                                }
                            }
                            if($validate->save()){
                                $available_invites++;
                                $this->sendInvitation($validate->name, $validate->email, $code, $validate);
                            }
                        }
                        else {
                                $data = new InviteUser();
                                $data->name = $user['name'];
                                $data->email = $user['email'];
                                $data->mono_ac_percentage = $req['mono_ac_percentage'];
                                $data->multi_ac_percentage = $req['multi_ac_percentage'];
                                $data->com_net_percentage = $req['com_net_percentage'];
                                $data->business_eco_pecentage = $req['business_eco_pecentage'];
                                $data->register = 0;
                                
                                $invitation_code =  InviteUser::where('gdoox_code', '=', $code)->first();

                                if($request->confirm == 1){
                                    $code = $this->randomString(6);
                                    if(!empty($invitation_code->gdoox_code)){
                                        while ($invitation_code->gdoox_code == $code){
                                            $code = $this->randomString(7);
                                        }
                                        $data->gdoox_code = 'GDOOX-'.strtoupper($code);
                                    }
                                    else {
                                        $data->gdoox_code =  'GDOOX-'.strtoupper($code);
                                    }
                                }
                                if($data->save()){
                                    $new_invites++;
                                    $this->sendInvitation($data->name, $data->email, $code, $data);
                                }
                        }
                        $count = $new_invites + $available_invites;
                    }
                    
                    $message.= "Invitation sent been sent to ".$count." Email Id(s).";
                    
                    return Redirect::route('invite-multi-user-create')->with('message', $message);
                }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }


    /*
     * @ Send email with $invite data
     */
    public function sendInvitation($name, $email, $gdooxCode, $data){
        
        if(!empty($gdooxCode)){
            $registration_link = URL::to('auth/user-register', array('email'=>urlencode($email),'code'=>$gdooxCode,));
            
            $invite = array(
                'name' => $name,
                'email' => $email,    
                'gdoox_code' => $gdooxCode,
                'registration_link' =>  URL::to('auth/user-register', array('email'=>urlencode($email), 'code'=>$gdooxCode))
            );
        }
        else {
            $registration_link = URL::to('auth/user-register', array('email'=>urlencode($email)));
            $invite = array(
                'name' => $name,
                'email' => $email,    
                'registration_link' =>  URL::to('auth/user-register', urlencode($email))
            );
        }

        Mail::send('emails.invite_users', ['registration_link'=>$registration_link, 'gdooxCode'=>$gdooxCode], function($message) use ($data) {
            $message->from(Auth::user()->email, Auth::user()->username);
            $message->to($data->email,$data->name)->subject('Register in Gdoox with your gdoox code');
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function errorMessage($e){
            $error = "An error occured. ".
                "Line Number: ".$e->getLine()." ".
                "File Name: ".$e->getFile()." ".
                "Error Description: ".$e->getMessage(); 
            return $error;
    }
}
