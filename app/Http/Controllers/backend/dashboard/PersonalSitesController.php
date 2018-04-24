<?php

namespace Gdoox\Http\Controllers\backend\dashboard;

use Illuminate\Http\Request;

use DB;
use Auth;
use Illuminate\Support\Facades\Validator;
use Gdoox\Models\FieldMaster;
use Gdoox\Models\BusinessInfo;
use Gdoox\Models\DropdownOption;
use Gdoox\Models\Categories;
use Gdoox\Models\BusinessEcommerceCompany;

use Gdoox\Http\Requests;
 use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Gdoox\Http\Controllers\Controller;

class PersonalSitesController extends Controller {
  use \Gdoox\Helpers\backend\dashboard\ImageUpload; 
       /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  
    private $language;
    public function __construct() {
			if (session()->has('app_language')) {
				//
			}else{
				session(['app_language' => 'en']);
			}  		
        $this->language = session('app_language');
    }

    public function edit($id){
        try {
            $required = "*";
            $personal_info = array();
            $selected_cat = array();
            
            $site_info = BusinessInfo::where('_id', $id)->where('type','personal')->first();  
            $fm_data = FieldMaster::where('title', 'personal_sites')->where('lang',$this->language)->first();
            $countries = DropdownOption::where('name','countries')->where('type','drop_down')->where('lang',$this->language)->first();
            $organizations = DropdownOption::where('name','organization')->where('lang',$this->language)->first();
            $activities = DropdownOption::where('name', 'activity_type')->where('lang',$this->language)->first();
            $site_opts = DropdownOption::where('name','business_operation')->where('lang',$this->language)->first();
            $markets = DropdownOption::where('name','market')->where('lang',$this->language)->first();
            
            if(empty($site_info)){
                return Redirect::route('personal-select_cat-index')->with('message', "The prsonal site is not present, please create a new");
            }
          
            if(!empty($site_info->personal_info)){
              foreach ($site_info->personal_info as $key => $value) {
                  $personal_info[$key] = $value;
              }
            }
          
            foreach ($site_info as $key => $value) {
                $personal_info[$key] = $value;
            }
            
            foreach ($site_info->category_id as $key => $value) {
                $val = Categories::where('cat_id','=',$value)->where('lang','=', $this->language)->first();
                $selected_cat[$value] = $val->name;
            }

            foreach($countries->options as $countryname){
                $country[$countryname]=$countryname;
            }
         
            foreach($organizations->options as $organizationname){
                $organization[$organizationname]=$organizationname;
            }

            foreach($activities->options as $activity_name){
              $activity[$activity_name]=$activity_name;
            }
         
            foreach($site_opts->options as $site_optname){
              $site_opt[$site_optname]=$site_optname;
            }

            foreach($markets->options as $marketname){
                $market[$marketname]=$marketname;
            }

            return view('backend.dashboard.personal_sites.edit',compact('fm_data','required','country','organization','activity','site_opt','market', 'site_info','selected_cat','personal_info'));
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
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
          try{
              $data = $request->all();
              $userid = Auth::id();
              $site = BusinessInfo::where('type', 'personal')->where('user_id',Auth::user()->id)->first();

              if(empty($site)){
                  return Redirect::route('personal-select_cat-index')->with('message', "The site is not present, please start creating a new one.");
              }  

              if(isset($data['slug'])){
                  $rules = array('site_name' => 'required|max:255|unique:business_info',);
                  $validator = Validator::make($request->all(), $rules);
                  if($validator->fails()){
                      return Redirect()->back()->withErrors($validator)->withInput($request->all());                        
                  }

                  $check_site_bi = BusinessInfo::where('type', 'personal')->where('slug','=',$data['slug'])->first();
                  if(!empty($check_site_bi)  && ( $check_site_bi->id !== $site->id  )){
                    return Redirect::route('personal-site-edit',[$site->id])
                        ->with('message', "The Name has already been Taken. Please Enter a different Name")
                        ->withInput($request->all()); 
                  }

                  $check_site_bec = BusinessEcommerceCompany::where('slug','=',$data['slug'])->first();
                  if(!empty($check_site_bec)){
                    return Redirect::route('personal-site-edit',[$site->id])
                        ->with('message', "The Name has already been Taken. Please Enter a different Name")
                        ->withInput($request->all());            
                  }
              }

              if(!empty($data['site_image'])){
                  $this->upload('site_image');
                  $data['site_image']=$this->image;
              }
              if(!empty($data['site_logo'])){
                  $this->upload('site_logo');
                  $data['site_logo']=$this->image;
              }

              $data['status'] = 1;

              BusinessInfo::where('_id', $id)->update($data);
              if(empty($data['slug'])){
                  return Redirect::route('site',$site->slug)->with('message', "Site Updated.");                      
              }
              else {
                return Redirect::route('cms.index')->with('message', "Site Created. Add Pages To Your New Site.");
              }

              if(count($site)<1){
                  if($validator->fails()){
                        return Redirect()->back()->withErrors($validator)->withInput($request->all());                        
                  }
                  else {
                        if(!empty($data['site_image'])){
                            $this->upload('site_image');
                            $data['site_image']=$this->image;
                        }
                        if(!empty($data['site_logo'])){
                            $this->upload('site_logo');
                            $data['site_logo']=$this->image;
                        }
                        $data['status']=1;
                        BusinessInfo::where('_id', $id)->update($data);  
                        //Redirect to Add pages site.
                        return Redirect::route('cms.index')->with('message', "Site Created. Add Pages To Your New Site.");
                  }
              }
              else {
                  if(empty($check_site_bi)  && empty($check_site_bi)){
                    $data=$request->all();
                  }
                  else {
                    return Redirect::route('personal-site-edit',[$site->id])->with('message', "The Name has already been Taken. Please Enter a different Name");
                  }
              }
        }
        catch(\Exception $e){
          $errors = $this->errorMessage($e);
          return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
      }
    }
        else {
            return redirect('auth/login')->with('message',"You must be login!"); 
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
