<?php

namespace Gdoox\Http\Controllers\backend\dashboard\business_info;

use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Gdoox\Http\Requests;
use Gdoox\User;
use Gdoox\SubUser;
use Gdoox\Role;
use Gdoox\Models\BusinessInfo;
use Gdoox\Models\BusinessEcommerceCompany;
use Illuminate\Support\Facades\Validator;
use Gdoox\Models\FieldMaster;
use Gdoox\Models\SiteHeaderImage;
use Illuminate\Support\Facades\Redirect;
use Gdoox\Http\Controllers\Controller;
use Gdoox\Models\NavigationMenu;
use Illuminate\Support\Facades\Route;
use Gdoox\Models\PersonalSiteDetail;

class SiteHeaderImagesController extends Controller
{
  use \Gdoox\Helpers\backend\dashboard\ImageUpload;
  use \Gdoox\Helpers\backend\dashboard\HelperFunctions;
  use \Gdoox\Helpers\backend\dashboard\RolesUsers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
      if(Auth::user()){
        try {
            $term = 0;
            $estores = array();
            $fm_data = FieldMaster::where('title', '=', 'business_ecommerce_company')->where('lang','=', 'en')->first();
            // $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('parent', '48')->where('group','create_ecommerce_site')->where('lang','en')->get();
            // $route = Route::getCurrentRoute()->getName();

            $user_role = $this->UserRoleName(Auth::user()->username);

            if($user_role==='personal-site-user'){
                $personalsite = PersonalSiteDetail::where('user_id', Auth::user()->id)->first();
                if(!empty($personalsite)){
                    $estores['site_name'][] = $personalsite->site_name;
                    $estores['slug'][]= $personalsite->slug;
                }

                if (!empty($_GET['site_slug'])){
                    $site_name = $personalsite->site_name;
                    $site_slug = $_GET['site_slug'];
                    $term = 1;
                }
                elseif (!empty($_GET['id'])){
                    $imagedata= SiteHeaderImage::where('_id', $_GET['id'])->first();
                    $term = 2;
                }  
            }
            else {
                $ecommsite = BusinessEcommerceCompany::where('user_id','=',  Auth::user()->id)->get();
                foreach ($ecommsite as $value) {
                    if(isset($value->ecomm_company_name)){
                        $estores['site_name'][]= $value->ecomm_company_name;
                        $estores['slug'][] = $value->slug;
                    }
                }

                if (!empty($_GET['site_slug'])){
                    $site_name = $this->SiteName($_GET['site_slug']);
                    $site_slug = $_GET['site_slug'];
                    $term = 1;
                }
                elseif (!empty($_GET['id'])){
                    $imagedata= SiteHeaderImage::where('_id', $_GET['id'])->first();
                    $term = 2;
                }
            }

            $esites = SiteHeaderImage::Where('user_id', '=', Auth::user()->id)->get();
            
          
//            foreach ($personalsite as $value) {
//               if(isset( $value->site_name)){
//                  $estores['site_name'][] = $value->site_name;
//                  $estores['slug'][]= $value->slug;
//               }
//            }
             
            return view('backend.dashboard.business_info.business_ecommerce_companies.site_header_images.index', compact('route','nav_menu','fm_data', 'imagedata', 'site_name', 'site_slug', 'term', 'required', 'esites', 'estores','site'));
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
      try{
        $imagedata = $request->all();   
        $user_role = $this->UserRoleName(Auth::user()->username);
        $permission = 0775;
        $rules = array(
            'site_images' => 'required|mimes:jpg,png,gif,jpeg',
         );
        $validator = Validator::make($request->all(), $rules);

        // process the validation
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());                        
        }
        else {
                $imagedata['user_id'] = Auth::user()->id;
                $path = Auth::user()->directory_path."site_header_images/";
                
                $site_image = $imagedata['site_slug']."_header".rand(1,100).".";
                $site_header_image = $this->uploadImage($imagedata['site_images'], $site_image, $path, $permission, true);
                
                if($user_role!='personal-site-user' ){
                     $imagedata['company_id'] = $this->CompanyId($imagedata['site_slug']);
                }
                
                $imagedata['site_images'] = $site_header_image;
                $imagedata['site_images_path'] = $path;

                DB::Collection('site_header_images')->insert($imagedata);
                $image = SiteHeaderImage::where('site_slug', $imagedata['site_slug'])->first();

                return Redirect::route('site.header.images.index')->with('message','Site image uploaded successfully.');
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
      try{
        $data= $request->all();
        if(isset($data['site_images'])){
            $path = Auth::user()->directory_path."site_header_images/";
            $permission = 0775;
            $site_image = $data['site_slug']."_header".rand(1,100).".";
            $site_header_image = $this->uploadImage($data['site_images'], $site_image, $path, $permission, true);
            $data['site_images'] = $site_header_image;
            $data['site_images_path'] = $path;
        }
        DB::Collection('site_header_images')->where('_id', $id)->update($data);
        return Redirect::route('site.header.images.index')->with('message',"Updated Successfully.");   
      }
      catch (\Exception $e){
          $error = "An error occured. ".
                          "Line Number: ".$e->getLine()." ".
                          "File Name: ".$e->getFile()." ".
                          "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
      }
    }
}
