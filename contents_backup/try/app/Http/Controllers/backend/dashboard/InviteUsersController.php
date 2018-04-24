<?php

namespace Gdoox\Http\Controllers\backend\dashboard;

use DB;
use Auth;
use Gdoox\User;
use Gdoox\Models\InviteUser;
use Gdoox\Models\FieldMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Gdoox\Http\Requests;
use Illuminate\Support\Facades\Mail;
use Gdoox\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Gdoox\Models\NavigationMenu;

class InviteUsersController extends Controller
{
  use \Gdoox\Helpers\backend\dashboard\HelperFunctions;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            if(Auth::user()){
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('parent', '1')->get();
                $route = Route::getCurrentRoute()->getName();
                
                $fm_data= FieldMaster::where('title', '=', 'invite_user')->where('lang', '=', 'en')->first();
                $required='*';
                return view('backend.dashboard.users.invite_users.create',  compact('nav_menu','route','fm_data', 'required'));
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
        try{
            if(Auth::user()){ 
                $rules = array(
                'email' => 'required|email|max:255|unique:invite_users',
                 );
                $validator = Validator::make($request->all(), $rules);
                $user= new InviteUser();            
                // process the validation
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput($request->all());                        
                }
                else {
                    $code= $this->randomString(6);
                    $invitation_code=  InviteUser::where('gdoox_code', '=', $code)->first();
                    if($request->confirm==1){
                        if(!empty($invitation_code->gdoox_code)){
                            $user->gdoox_code = 'GDOOX-'.strtoupper($this->randomString(7));
                        }
                        else {
                            $user->gdoox_code=  'GDOOX-'.strtoupper($this->randomString(6));
                        }
                    }
                    $user->username=$request->input('name'); 
                    $user->email=$request->input('email');
                    $user->register=0;
                    if($user->save()){
                        $data = array(
                           'username' => $user->username,
                           'email'=>$user->email,    
                           'gdoox_code' =>$user->gdoox_code,
                           'registration_link'=>  \Illuminate\Support\Facades\URL::to('auth/register',$user->gdoox_code)
                           );
                        Mail::send('emails.invite_users', $data, function($message) use ($user) {
                             $message->from(Auth::user()->email, Auth::user()->username);
                             $message->to($user->email,$user->name)->subject('Register in Gdoox with your gdoox code');
                        });
                    }
                    return Redirect::route('invite-user-create')->with('message','Invitation Sent.');

                }    
            }
            else{
                return redirect('auth/login')->with('message','You must be login');
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
