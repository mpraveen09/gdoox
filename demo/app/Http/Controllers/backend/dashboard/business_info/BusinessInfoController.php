<?php

namespace Gdoox\Http\Controllers\backend\dashboard\business_info;

use DB;
use Gdoox\Models\BusinessInfo;
use Gdoox\Http\Requests;
use Gdoox\User;
use Gdoox\Models\FieldMaster;
use Gdoox\Models\DropdownOption;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Gdoox\Http\Controllers\Controller;
use Gdoox\Models\NavigationMenu;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class BusinessInfoController extends Controller
{
    use \Gdoox\Helpers\backend\dashboard\ImageUpload;
    use \Gdoox\Helpers\backend\dashboard\RolesUsers;
   // private $image;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    private $language;
    public function __construct() {
        $this->language = session('app_language');
    }
    
    public function index(){   
         if(Auth::user()){
           try {
                $role = $this->getRoleName(Auth::user()->id);
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('menu','COMPANY PROFILE')->where('user',$role)->where('lang','en')->get();            
                $route = Route::getCurrentRoute()->getName();
                
                $business_info = BusinessInfo::where('user_id', Auth::user()->id)->where('type','business')->paginate(25);
                $fm_data = FieldMaster::where('title','business_info')->where('lang', $this->language)->first();

                return view('backend.dashboard.business_info.index',compact('route','nav_menu','activity','country','organization','business_info','fm_data'));
           }
          catch (\Exception $e){
              $error = "An error occured. ".
                    "Line Number: ".$e->getLine()." ".
                    "File Name: ".$e->getFile()." ".
                    "Error Description: ".$e->getMessage();
              return view('errors.custom_error')->withErrors($error);
          }
        }
        else {
            return redirect('auth/login')->with('message',"You must be login!"); 
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
      try {
            $role = $this->getRoleName(Auth::user()->id);
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('menu','COMPANY PROFILE')->where('user',$role)->where('lang','en')->get();            
            $route = Route::getCurrentRoute()->getName();
                
            $company=  BusinessInfo::where('user_id', Auth::user()->id)->get();
            if(count($company) < 1 || Auth::user()->hasRole('superadmin')){
              $fm_data = FieldMaster::where('title', '=', 'business_info')->where('lang', $this->language)->first();
              $countries=  DropdownOption::where('name','countries')->where('type','drop_down')->where('lang', $this->language)->first();
              foreach($countries->options as $countryname){
                    $country[$countryname] = $countryname;
              }
              $positions = DropdownOption::where('name','position')->where('lang', $this->language)->first();  
              foreach($positions->options as $positionname){
                    $position[$positionname] = $positionname;
              }
              
              $organizations = DropdownOption::where('name','organization')->where('lang', $this->language)->first();
              foreach($organizations->options as $organizationname){
                    $organization[$organizationname] = $organizationname;
              }
              $company_dims=  DropdownOption::where('name','company_dimension')->where('lang', $this->language)->first();
              foreach($company_dims->options as $company_dimsize){
                    $company_dim[$company_dimsize]=$company_dimsize;
              }

              $activities=  DropdownOption::where('name', 'activity_type')->where('lang', $this->language)->first();
              foreach($activities->options as $activity_name){
                    $activity[$activity_name]=$activity_name;
              }

              $business_opts=  DropdownOption::where('name','business_operation')->where('lang', $this->language)->first();
              foreach($business_opts->options as $business_optname){
                    $business_opt[$business_optname]=$business_optname;
              }

              $accept_payments=  DropdownOption::where('name','payment_accepted')->where('lang', $this->language)->first();
              foreach($accept_payments->options as $accept_paymenttype){
                    $accept_payment[$accept_paymenttype]=$accept_paymenttype;
              }

              $markets=  DropdownOption::where('name','market')->where('lang', $this->language)->first();
              foreach($markets->options as $marketname){
                    $market[$marketname]=$marketname;
              }
              $credit_cards= DropdownOption::where('name','credit_card')->where('lang', $this->language)->first(); 
              foreach($credit_cards->options as $credit_cardoption){
                    $credit_card[$credit_cardoption]=$credit_cardoption;
              }
              $required="*";

             return view('backend.dashboard.business_info.create',compact('nav_menu','route','credit_card','market','accept_payment', 'fm_data', 'required','country', 'organization','position','company_dim','activity','business_opt'));// @return the view file with passing company_profiles variable
         }
            else {
               return redirect()->back()->withErrors('You are not allowed to create more than one company');
            }
      }
      catch (\Exception $e){
          $error = "An error occured. ".
                "Line Number: ".$e->getLine()." ".
                "File Name: ".$e->getFile()." ".
                "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){   
          if(Auth::user()){
            try {
              $rules = array(
                  'company_name' => 'required|max:255|unique:business_info',
                  'policy_doc' => 'mimes:doc,docx,pdf'
                );
              
              $validator = Validator::make($request->all(), $rules);

              if($validator->fails()){
                  return redirect()->back()->withErrors($validator)->withInput($request->all());                        
              }
              else {
                  $data = $request->all();
                   if(!empty($data['logo'])){
                      $path = Auth::user()->directory_path."/company_logo/";
                      $permission = 0777;
                      $new_image = "gdoox_".strtolower(Auth::user()->username)."_logo.";
                      $data['logo'] = $this->upload($data['logo'], $new_image, $path, $permission, true);
                      $data['logo_path'] = $path;
                  }
                  if(!empty($data['policy_doc']) ){
                     $path = Auth::user()->directory_path."/return_policy_docs/";
                     $permission = 0777;
                     $new_doc_name = "gdoox_return_policy.";
                     $data['policy_doc'] = $this->upload($data['policy_doc'], $new_doc_name, $path, $permission, true);
                     $data['doc_path'] = $path;
                  }
                  $data['status']="Inactive";
                  if($data['status']=="Inactive"){
                     $data['verify']="Verify/Activate";
                  }
                  $data['company_admin'] = [Auth::user()->id];
                  $data['type']='business';
                  DB::collection('business_info')->insert($data);

                  return Redirect::route('ecomm-index')->with('message', "Business profile created");
              }
            }
            catch (\Exception $e){
                $error = "An error occured. ".
                                "Line Number: ".$e->getLine()." ".
                                "File Name: ".$e->getFile()." ".
                                "Error Description: ".$e->getMessage();
                return view('errors.custom_error')->withErrors($error);
            }
          }
          else{
              return redirect('auth/login')->with('message',"You must be login!"); 
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $role = $this->getRoleName(Auth::user()->id);
        $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('menu','COMPANY PROFILE')->where('user',$role)->where('lang','en')->get();            
        $route = Route::getCurrentRoute()->getName();
            
        if(Auth::user()){
          try {
              $fm_data = FieldMaster::where('title', '=', 'business_info')->where('lang', $this->language)->first();
              $business=  BusinessInfo::where('_id', $id)->where('type','business')->first(); 

              return view('backend.dashboard.business_info.show',compact('nav_menu','route','business','fm_data'));
          }
          catch (\Exception $e){
              $error = "An error occured. ".
                "Line Number: ".$e->getLine()." ".
                "File Name: ".$e->getFile()." ".
                "Error Description: ".$e->getMessage();
              return view('errors.custom_error')->withErrors($error);
          }
        }
        else {
              return redirect('auth/login')->with('message',"You must be login!"); 
          }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        try {
            $role = $this->getRoleName(Auth::user()->id);
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('menu','COMPANY PROFILE')->where('user',$role)->where('lang','en')->get();            
            $route = Route::getCurrentRoute()->getName();
            
            $img_path = base_path()."/public/uploads/";
            $fm_data = FieldMaster::where('title', '=', 'business_info')->where('lang', $this->language)->first();
            $countries=  DropdownOption::where('name','countries')->where('type','drop_down')->where('lang', $this->language)->first();
            foreach($countries->options as $countryname)
            {
              $country[$countryname]=$countryname;
            }
            $positions= DropdownOption::where('name','position')->where('lang', $this->language)->first();  
            foreach($positions->options as $positionname)
            {
              $position[$positionname]=$positionname;
            }
   //print_r($position); die;
            $organizations=  DropdownOption::where('name','organization')->where('lang', $this->language)->first();
            foreach($organizations->options as $organizationname)
            {
              $organization[$organizationname]=$organizationname;
            }
//         print_r($organization);
//          $matches  = preg_grep ('/^-- (\w+)/i', $organization);
//          print_r($matches); die;
          
            $company_dims=  DropdownOption::where('name','company_dimension')->where('lang', $this->language)->first();
            foreach($company_dims->options as $company_dimsize)
            {
              $company_dim[$company_dimsize]=$company_dimsize;
            }

            $activities=  DropdownOption::where('name', 'activity_type')->where('lang', $this->language)->first();
            foreach($activities->options as $activity_name)
            {
              $activity[$activity_name]=$activity_name;
            }

            $business_opts=  DropdownOption::where('name','business_operation')->where('lang', $this->language)->first();
            foreach($business_opts->options as $business_optname){
              $business_opt[$business_optname]=$business_optname;
            }

            $accept_payments=  DropdownOption::where('name','payment_accepted')->where('lang', $this->language)->first();
            foreach($accept_payments->options as $accept_paymenttype){
              $accept_payment[$accept_paymenttype]=$accept_paymenttype;
            }

            $markets=  DropdownOption::where('name','market')->where('lang', $this->language)->first();
            foreach($markets->options as $marketname){
              $market[$marketname]=$marketname;
            }
            $credit_cards= DropdownOption::where('name','credit_card')->where('lang', $this->language)->first();
            foreach($credit_cards->options as $credit_cardoption){
              $credit_card[$credit_cardoption] = $credit_cardoption;
            }
            $required="*";

        
            $business_info= BusinessInfo::where('_id', '=', $id)->where('type','business')->first();
         
        return view('backend.dashboard.business_info.edit',compact('route','nav_menu','business_info','market','accept_payment', 'fm_data', 'required','country', 'organization','position','company_dim','activity','business_opt','credit_card'));
        }
        catch (\Exception $e){
            $error = "An error occured. ".
                            "Line Number: ".$e->getLine()." ".
                            "File Name: ".$e->getFile()." ".
                            "Error Description: ".$e->getMessage();
            return view('errors.custom_error')->withErrors($error);
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
      try{
        $data = $request->all();
        $rules = array(
            'company_name' => 'required|max:255',
            'policy_doc' => 'mimes:doc,docx,pdf'
            );
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){

            return redirect()->back()->withErrors($validator)->withInput($request->all());                        
        }
        else{
          if(!empty($data['logo'])){
             $path = Auth::user()->directory_path."/company_logo/";
             $permission = 0777;
             $new_image = "gdoox_".strtolower(Auth::user()->username)."_logo.";
             $data['logo'] = $this->upload($data['logo'], $new_image, $path, $permission, true);
             $data['logo_path'] = $path;
          }
            if(!empty($data['policy_doc'])){
               $path = Auth::user()->directory_path."/return_policy_docs/";
               $permission = 0777;
               $new_doc_name = "gdoox_return_policy.";
               $data['policy_doc'] = $this->upload($data['policy_doc'], $new_doc_name, $path, $permission, true);
               $data['doc_path'] = $path;
            }
          //             print_r($data); 
          $save= BusinessInfo::where('_id', $id)->update($data,  array('upsert' => false));
          // var_dump($save);
          if($save){
                 return Redirect::route('ecomm-index')->with('message',"Company information has been updated");
           }
        }
      }
      catch (\Exception $e){
          $error = "An error occured. ".
                          "Line Number: ".$e->getLine()." ".
                          "File Name: ".$e->getFile()." ".
                          "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
       if (Auth::user()) {
              DB::collection('company_profiles')->where('_id', '=', $id)->delete();
       }
        return redirect()->action('backend\dashboard\CompanyProfilesController@index');
    }
    
    public function VerifyCompany(){   
         if(Auth::user()){
            $role = $this->getRoleName(Auth::user()->id);
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('menu','COMPANY PROFILE')->where('user',$role)->where('lang','en')->get();            
            $route = Route::getCurrentRoute()->getName();
            
             $createdby=  User::where('_id',Auth::user()->id)->first();
             $business_info = BusinessInfo::where('user_id', Auth::user()->id)->orWhere('user_id',  $createdby->child_of)->where('type','business')->where('verify','Verify/Activate')->paginate(25);
             $fm_data=  FieldMaster::where('title','business_info')->where('lang', $this->language)->first();
             
             return view('backend.dashboard.business_info.verify_company',compact('nav_menu','route','activity','country','organization','business_info','fm_data'));
         }
         else {
             return redirect('auth/login')->with('message',"You must be login!"); 
         }
    }

}