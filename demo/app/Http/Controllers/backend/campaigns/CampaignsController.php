<?php

namespace Gdoox\Http\Controllers\backend\campaigns;
use Gdoox\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Gdoox\Models\FieldMaster;
use Gdoox\Models\Campaigns;
use Gdoox\Models\CampaignRequests;
use Gdoox\Models\DropdownOption;
use Gdoox\UserRole;
use Gdoox\Role;
use Gdoox\Models\NavigationMenu;
use Illuminate\Support\Facades\Route;
use Gdoox\User;
use Illuminate\Support\Facades\Auth;
use Form;
use Image;
use Input;
use UUID;

class CampaignsController extends Controller { 
    use \Gdoox\Helpers\backend\dashboard\ImageUpload;
    use \Gdoox\Helpers\backend\dashboard\RolesUsers;
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
//    public function index(){
//        try {
//            if(Auth::user()){
//                $campaigns = Campaigns::orderBy('created_at', 'desc')->where('user_id', Auth::user()->id)->paginate(25);
//                $fm_data = FieldMaster::where('title','campaigns')->where('lang','en')->first();
//                
//                return view('backend.campaigns.index', compact('campaigns','fm_data'));
//            }
//            else {
//                return redirect('auth/login')->with('message',"Please Login!");
//            }
//        }
//        catch(\Exception $e){
//            $errors = $this->errorMessage($e);
//            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
//        }
//    }
    
    /**
     * Show the form for adding a new product.
     *
     * @return Response
     */ 
    
    
    private $language;
    public function __construct() {
        $this->language = session('app_language');
    }
    
    public function create(){
        try {
            if(Auth::user()) {
                $campaigntype = array();
                
                $role = $this->getRoleName(Auth::user()->id);
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'ADVERTISING')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();
                
                $campaign_type = DropdownOption::where('name','campaigns')->where('lang', $this->language)->first();
                foreach($campaign_type->options as $key=>$val){
                    $campaigntype[$val] = $val;
                }
                
                $fm_data = FieldMaster::where('title','campaigns')->where('lang', $this->language)->first();
                $campaigns = Campaigns::orderBy('created_at', 'desc')->where('user_id', Auth::user()->id)->paginate(25);
                
                $campaign_requests = CampaignRequests::orderBy('created_at', 'desc')->where('user_id', Auth::user()->id)->paginate(25);
                
                return view('backend.campaigns.create', compact('fm_data','campaigntype','campaigns','campaign_requests','nav_menu','route'));
            }
            else {
               return redirect('auth/login')->with('message',"Please Login to Create Task!"); 
            }
        }
        catch(\Exception $e){
           $errors = $this->errorMessage($e);
           return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }    

    
  /*
   * Edit product
   */
    public function edit($id){
        try {
            if(Auth::user()){
                $campaigntype = array();
                $campaign = Campaigns::where('_id', $id)->first();
                
                $role = $this->getRoleName(Auth::user()->id);
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'ADVERTISING')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();
                
                $campaign_type = DropdownOption::where('name','campaigns')->where('lang', $this->language)->first();
                foreach($campaign_type->options as $key=>$val){
                    $campaigntype[$val] = $val;
                }
                
                $fm_data = FieldMaster::where('title','campaigns')->where('lang', $this->language)->first();
                
                return view('backend.campaigns.edit', compact('fm_data','campaigntype','campaign','id','nav_menu','route'));
            }
            else {
               return redirect('auth/login')->with('message',"Please Login to Create Task!"); 
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
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request){
        try {
            if(Auth::user()){
                $data = $request->all();
                $file = $request->file('campaign_image');
                $rules = [
                    'import_file' => 'required',
                ];
                
                if(!empty($file)){
                    $filedata = [
                        'campaign_image'=>$file,
                        'extentions'=>$file->getClientOriginalExtension()
                    ];
                    $rules = [
                        'extentions' => 'jpeg,jpg,png,gif,tif'
                    ];
                }
                
                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                     return redirect()->back()->withErrors($validator)->withInput($request->all());                        
                }
         
                $path = Auth::user()->directory_path."/campaign_images/";
                $permission = 0777;
                $name = $file->getClientOriginalName();
                $new_name = preg_replace('/.[^.]*$/', '', $name).".";
                $import_file = $this->upload($file, $new_name, $path, $permission, true);
                $fileName = $path.$import_file;
                
                $campaign = new Campaigns();
                $campaign->user_id = Auth::user()->id;
                $campaign->campaign_name = $data['campaign_name'];
                $campaign->start_date = $data['start_date'];
                $campaign->end_date = $data['end_date'];
                $campaign->campaign_type = $data['campaign_type'];
                $campaign->campaign_image = $fileName;
                $campaign->status = 'Approved';
                $campaign->url = $data['url'];
                
                if($campaign->save()){
                    return redirect()->route('campaigns.create')->with('message','Campaign Created Successfully');
                }
                else {
                    return redirect()->back()->withErrors('message','Something went wrong! Please try Again.');
                }  
            }
            else {
                return redirect('auth/login')->with('message',"Please Login to Create Task!"); 
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
    
     public function update(Request $request, $id){
        try {
          if(Auth::user()){
              $data = $request->all();
              $file = $request->file('campaign_image');
              if(!empty($file)){
                    $filedata = [
                        'campaign_image'=>$file,
                        'extentions'=>$file->getClientOriginalExtension()
                    ];
                    $rules = [
                        'extentions' => 'jpeg,jpg,png,gif,tif'
                    ];

                    $validator = Validator::make($request->all(), $rules);
                    if ($validator->fails()) {
                         return redirect()->back()->withErrors($validator)->withInput($request->all());                        
                    }
                    $path = Auth::user()->directory_path."/campaign_images/";
                    $permission = 0777;
                    $name = $file->getClientOriginalName();
                    $new_name = preg_replace('/.[^.]*$/', '', $name).".";
                    $import_file = $this->upload($file, $new_name, $path, $permission, true);
                    $fileName = $path.$import_file;
                    $campaign->campaign_image = $fileName;
              }  

              

              $campaign = Campaigns::where('_id', $id)->first();
              $campaign->campaign_name = $data['campaign_name'];
              $campaign->start_date = $data['start_date'];
              $campaign->end_date = $data['end_date'];
              $campaign->campaign_type = $data['campaign_type'];
              $campaign->url = $data['url'];

              if($campaign->save()){
                  return redirect()->route('campaigns.create')->with('message','Campaign Updated Successfully');
              }
              else {
                  return redirect()->back()->withErrors('message','Something went wrong! Please try Again.');
              }  
          }
          else {
                  return redirect('auth/login')->with('message',"Please Login to Create Task!"); 
          }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
          // Session::flash('message', "Oops! Something went Wrong. Please try Again");
          // return Redirect::back();
        }
      }
    
    public function campaignRequest(Request $request){
        try {
            if(Auth::user()){
                $campaigntype = array();
                
                $role = $this->getRoleName(Auth::user()->id);
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'ADVERTISING')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();
                
                $campaign_type = DropdownOption::where('name','campaigns')->where('lang', $this->language)->first();
                foreach($campaign_type->options as $key=>$val){
                    $campaigntype[$val] = $val;
                }
                
                $fm_data = FieldMaster::where('title','campaigns')->where('lang', $this->language)->first();
                $campaigns = CampaignRequests::orderBy('created_at', 'desc')->where('user_id', Auth::user()->id)->paginate(25);
                return view('backend.campaigns.create_campaign', compact('fm_data','campaigntype','campaigns','nav_menu','route'));
            }
            else {
               return redirect('auth/login')->with('message',"Please Login to Create Task!"); 
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }
    
    public function storeCampaignRequest(Request $request){
        try {
            if(Auth::user()){
                $data = $request->all();
                $file = $request->file('campaign_image');
                $rules = [
                    'import_file' => 'required',
                ];
                
                if(!empty($file)){
                    $filedata = [
                        'campaign_image'=>$file,
                        'extentions'=>$file->getClientOriginalExtension()
                    ];
                    $rules = [
                        'extentions' => 'jpeg,jpg,png,gif,tif'
                    ];
                }
                
                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                     return redirect()->back()->withErrors($validator)->withInput($request->all());                        
                }
                
                $path = Auth::user()->directory_path."/campaign_images/";
                $permission = 0777;
                $name = $file->getClientOriginalName();
                $new_name = preg_replace('/.[^.]*$/', '', $name).".";
                $import_file = $this->upload($file, $new_name, $path, $permission, true);
                $fileName = $path.$import_file;
                
                $campaign_req = new CampaignRequests();
                $campaign_req->user_id = Auth::user()->id;
                $campaign_req->campaign_name = $data['campaign_name'];
                $campaign_req->start_date = $data['start_date'];
                $campaign_req->end_date = $data['end_date'];
                $campaign_req->campaign_type = $data['campaign_type'];
                $campaign_req->campaign_image = $fileName;
                $campaign_req->status = 'Pending';
                $campaign_req->url = $data['url'];
                
                if($campaign_req->save()){
                    return redirect()->route('campaigns.request')->with('message','Campaign Created Successfully');
                }
                else {
                    return redirect()->back()->withErrors('message','Something went wrong! Please try Again.');
                }
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }
    
    public function editCampaignRequest($id){
        try {
            if(Auth::user()){
                
                $role = $this->getRoleName(Auth::user()->id);
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'ADVERTISING')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();
                
                $campaign = CampaignRequests::where('_id', $id)->first();
                $campaigntype = array();
                $campaign_type = DropdownOption::where('name','campaigns')->where('lang', $this->language)->first();
                
                foreach($campaign_type->options as $key=>$val){
                    $campaigntype[$val] = $val;
                }
                
                $fm_data = FieldMaster::where('title','campaigns')->where('lang', $this->language)->first();
                
                return view('backend.campaigns.edit_campaign', compact('fm_data','campaigntype','campaign','id','nav_menu','route'));
            }
            else {
               return redirect('auth/login')->with('message',"Please Login to Create Task!"); 
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }
    
    public function updateCampaignRequest(Request $request, $id){
        try {
          if(Auth::user()){
              $data = $request->all();
              $file = $request->file('campaign_image');
              
              if(!empty($file)){
                    $filedata = [
                        'campaign_image'=>$file,
                        'extentions'=>$file->getClientOriginalExtension()
                    ];
                    $rules = [
                        'extentions' => 'jpeg,jpg,png,gif,tif'
                    ];
                  
                    $validator = Validator::make($request->all(), $rules);
                    if ($validator->fails()) {
                         return redirect()->back()->withErrors($validator)->withInput($request->all());                        
                    }
                    
                    $name = $file->getClientOriginalName();
                    $path = Auth::user()->directory_path."/campaign_images/";
                    $permission = 0777;

                    $new_name = preg_replace('/.[^.]*$/', '', $name).".";
                    $import_file = $this->upload($file, $new_name, $path, $permission, true);
                    $fileName = $path.$import_file;
                    $campaign_req->campaign_image = $fileName;
              }  

              

              $campaign_req = CampaignRequests::where('_id', $id)->first();
              $campaign_req->campaign_name = $data['campaign_name'];
              $campaign_req->start_date = $data['start_date'];
              $campaign_req->end_date = $data['end_date'];
              $campaign_req->campaign_type = $data['campaign_type'];
              $campaign_req->url = $data['url'];

              if($campaign_req->save()){
                  return redirect()->route('campaigns.request')->with('message','Campaign Updated Successfully');
              }
              else {
                  return redirect()->back()->withErrors('message','Something went wrong! Please try Again.');
              } 
          }
          else {
                  return redirect('auth/login')->with('message',"Please Login to Create Task!"); 
          }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
          // Session::flash('message', "Oops! Something went Wrong. Please try Again");
          // return Redirect::back();
        }
    }


//    public function indexCampaignRequest(){
//        try {
//            if(Auth::user()){
//                $campaigns = CampaignRequests::orderBy('created_at', 'desc')->where('user_id', Auth::user()->id)->paginate(25);
//                $fm_data = FieldMaster::where('title','campaigns')->where('lang','en')->first();
//                
//                return view('backend.campaigns.index_campaign', compact('campaigns','fm_data'));
//            }
//            else {
//                return redirect('auth/login')->with('message',"Please Login!");
//            }
//        }
//        catch(\Exception $e){
//            $errors = $this->errorMessage($e);
//            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
//        }
//    }
    /*
 * Update product
 */
   
    
    public function errorMessage($e){
            $error = "An error occured. ".
                "Line Number: ".$e->getLine()." ".
                "File Name: ".$e->getFile()." ".
                "Error Description: ".$e->getMessage(); 
            return $error;
    }

}
