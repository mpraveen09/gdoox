<?php

namespace Gdoox\Http\Controllers\backend\certificationlogos;

use Gdoox\Http\Controllers\Controller;
use Gdoox\User;
use Gdoox\SubUser;
use Illuminate\Support\Facades\Auth;
use Gdoox\Models\FieldMaster;
use Gdoox\Models\BusinessInfo;
use Gdoox\Models\CertificationLogos;
use Gdoox\Models\BusinessEcommerceCompany;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Gdoox\Models\Categories;
use Gdoox\Models\NavigationMenu;
use Illuminate\Support\Facades\Route;


class CertificationLogosController extends Controller
{
    use \Gdoox\Helpers\backend\dashboard\ImageUpload; 
    use \Gdoox\Helpers\backend\dashboard\RolesUsers;
    use \Gdoox\Helpers\backend\dashboard\HelperFunctions;
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
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
    
    public function index() {
      try {
            $term = 0;
            $role = $this->getRoleName(Auth::user()->id);
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'CREATE E-COMMERCE SITE (CMS/DAM)')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
              
            $fm_data =  FieldMaster::where('title', '=', 'business_ecommerce_company')->where('lang','=', $this->language)->first();
            $estores=  BusinessEcommerceCompany::where('user_id','=',  Auth::user()->id)->paginate(25);
            $logos = CertificationLogos::where('userid', Auth::user()->id)->get();
            if (!empty($_GET['site_slug'])){
                  $site_name = $this->SiteName($_GET['site_slug']);
                  $site_slug = $_GET['site_slug'];
                  $term = 1;
              }
            elseif (!empty($_GET['id'])){
                  $get_logos = CertificationLogos::Where('_id','=',$_GET['id'])->first();
                  $term = 2;
            }
            return view('backend.certificationlogos.index', compact('nav_menu','route','fm_data','required','estores', 'site', 'term', 'get_logos', 'site_name', 'site_slug', 'logos'));
      }
      catch (\Exception $e){
          $error = "An error occured. ".
            "Line Number: ".$e->getLine()." ".
            "File Name: ".$e->getFile()." ".
            "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
      }
    }
    /*
     * Store data
     */
    public function store() {
      try {
        $files = Input::file('file');
        $data = Request::all();
        $userid = '';
        $rules = array('file' => 'required|mimes:png,gif,jpeg|max:1000');
        $validator = Validator::make(array('file'=> $files), $rules);
            
        if ($validator->fails()) {  
           return redirect()->back()->withErrors($validator)->withInput(Request::all());   
        }
        else {
            if(Auth::user()) {
                $userid = Auth::id();
            }
            
            $logo = new CertificationLogos;
            
            $path = Auth::user()->directory_path."/certification_logo/";
            $permission = 0777;
            $certification_logo_name = $data['site_slug'].".";
            $certification_logo = $this->upload($files, $certification_logo_name, $path, $permission, true);
            
            $logo->name = $data['name'];
            $logo->site_slug = $data['site_slug'];
            $logo->company_id = $this->CompanyId($data['site_slug']);
            $logo->url = $data['url'];
            $logo->userid = $userid;
            $logo->logo = $certification_logo;
            $logo->logo_path = $path;
            $logo->status = $data['status'];
            if($logo->save()){    
                return Redirect('certificationlogos')->with('message',"Certification Logo Saved Successfully.");   
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
//    public function show($id)
//    {
//      try{
//        $get_logos = CertificationLogos::Where('_id','=',$id)->first();
//        return view('backend.certificationlogos.show', compact('get_logos'));
//      }
//      catch (\Exception $e){
//          $error = "An error occured. ".
//                          "Line Number: ".$e->getLine()." ".
//                          "File Name: ".$e->getFile()." ".
//                          "Error Description: ".$e->getMessage();
//          return view('errors.custom_error')->withErrors($error);
//      }
//    }
//
//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  int  $id
//     * @return Response
//     */
//    public function edit($id)
//    {
//      try{
//        $get_logos = CertificationLogos::Where('_id','=',$id)->first();
//        return view('backend.certificationlogos.edit', compact('get_logos'));
//      }
//      catch (\Exception $e){
//          $error = "An error occured. ".
//                          "Line Number: ".$e->getLine()." ".
//                          "File Name: ".$e->getFile()." ".
//                          "Error Description: ".$e->getMessage();
//          return view('errors.custom_error')->withErrors($error);
//      }
//        
//    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
      try{
        $files = Input::file('file');
        $data = Request::all();
        $rules = array('name' => 'required');
        
        $validator = Validator::make(Request::all(), $rules);
            
        if ($validator->fails()) { 
            return redirect()->back()->withErrors($validator)->withInput(Request::all());
        }
        else {
            $logo= CertificationLogos::where('_id', '=', $id)->first();
            if(!empty($files)) {
                $path = Auth::user()->directory_path."/certification_logo/";
                $permission = 0777;
                $certification_logo_name = $data['site_slug'].".";
                $certification_logo = $this->upload($files, $certification_logo_name, $path, $permission, true);
                $logo->logo = $certification_logo;
                $logo->logo_path = $path;
//              $destinationPath = base_path()."/public/uploads/certification_logos/";
//              $filename = $files->getClientOriginalName();
//              $uploaded_logo= $destinationPath.$filename;
//              $upload_success = $files->move($destinationPath, $filename);
//              $logo->logo= "/uploads/certification_logos/".$filename;
            }
            
            $logo->name= $data['name'];
            $logo->url= $data['url'];
            $logo->status = $data['status'];
            
            if($logo->save()){
                return Redirect('certificationlogos')->with('message',"Updated Successfully.");   
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
     * @return Response
     */
//    public function destroy($id)
//    {
//      try{
//        $find_logo = CertificationLogos::find($id);
//
//        if($find_logo->delete())
//        {   
//            $get_logos = CertificationLogos::Where('shopid','=',$id)->get();
//            return Redirect('certificationlogos/addlogos/'.$data['shopid'])->with('message',"Certification Logo Deleted Successfully."); 
//        }
//        else {
//            echo "Certification Logo could not be Deleted! Please try Again";
//        }
//      }
//      catch (\Exception $e){
//          $error = "An error occured. ".
//                          "Line Number: ".$e->getLine()." ".
//                          "File Name: ".$e->getFile()." ".
//                          "Error Description: ".$e->getMessage();
//          return view('errors.custom_error')->withErrors($error);
//      }
//    }
//    
//    
//    public function addLogos($id)
//    {          
//      try{
//         $get_logos = CertificationLogos::Where('shopid','=',$id)->get();
//         return view('backend.certificationlogos.addlogos', compact('get_logos'))->with('shopid',$id);
//      }
//      catch (\Exception $e){
//          $error = "An error occured. ".
//                          "Line Number: ".$e->getLine()." ".
//                          "File Name: ".$e->getFile()." ".
//                          "Error Description: ".$e->getMessage();
//          return view('errors.custom_error')->withErrors($error);
//      }
//    }
    
     
}
