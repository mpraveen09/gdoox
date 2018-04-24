<?php

namespace Gdoox\Http\Controllers\backend\productcatalog;

use Gdoox\Http\Controllers\Controller;
use Gdoox\User;
use Gdoox\SubUser;
use Illuminate\Support\Facades\Auth;
use Gdoox\Models\FieldMaster;
use Gdoox\Models\BusinessInfo;
use Gdoox\Models\ProductCatalog;
use Gdoox\Models\BusinessEcommerceCompany;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Gdoox\Models\Categories;
use Illuminate\Support\Facades\Route;
use Gdoox\Models\NavigationMenu;


class ProductCatalogController extends Controller
{
    use \Gdoox\Helpers\backend\dashboard\ImageUpload; 
    use \Gdoox\Helpers\backend\dashboard\RolesUsers;
    use \Gdoox\Helpers\backend\dashboard\HelperFunctions;
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    private $language;
    public function __construct() {
        $this->language = session('app_language');
    }

    public function index(){
        if(Auth::user()){
          try {
                $term = 0;
                $site_name = '';
              
                $role = $this->getRoleName(Auth::user()->id);
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'CREATE E-COMMERCE SITE (CMS/DAM)')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();
              
                $fm_data = FieldMaster::where('title', '=', 'business_ecommerce_company')->where('lang','=', $this->language)->first();
                $estores = BusinessEcommerceCompany::where('user_id','=',  Auth::user()->id)->paginate(25);
                $catalogs = ProductCatalog::where('userid', Auth::user()->id)->get();
                if (!empty($_GET['site_slug'])){
                    $site_name = $this->SiteName($_GET['site_slug']);
                    $site_slug = $_GET['site_slug'];
                    $term = 1;
                }
                elseif (!empty($_GET['id'])){
                    $catalog= ProductCatalog::where('_id', $_GET['id'])->first();
                    $term = 2;
                }
              
                return view('backend.productcatalog.index', compact('nav_menu','route','fm_data','required','estores','site', 'catalogs', 'site_name', 'site_slug', 'catalog', 'term'));
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
     * @param  Request  $request
     * @return Response
     */
    
    public function store() {
      try {
        $files = Input::file('file');
        $data = Request::all();
        $rules = array('file' => 'required|mimes:pdf|max:1000');
        
        $validator = Validator::make(array('file'=> $files), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput(Request::all());   
        }
    
        else {
            if(Auth::user()){
                $userid= Auth::id();
            }
            else {
                $userid= '';
            }
        
            $catalog = new ProductCatalog;
            $uploaded_catalog = array();
            $path = Auth::user()->directory_path."/product_catalogs/";
            $permission = 0777;
            $catalog_name = "catalog_".$data['site_slug'].".".rand(1,1000);
            $product_catalog = $this->upload($files, $catalog_name, $path, $permission, true);
            $catalog->site_slug = $data['site_slug'];
            $catalog->company_id = $this->CompanyId($data['site_slug']);
            $catalog->userid = $userid;
            $catalog->product_catalog = $product_catalog;
            $catalog->product_catalog_path = $path;
            $catalog->status = $data['status'];
            if($catalog->save()){
                return Redirect('productcatalog')->with('message',"Product Catalog Uploaded Successfully.");   
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
    public function show($id){
        $get_catalog = ProductCatalog::Where('_id','=',$id)->first();
        return view('backend.productcatalog.show', compact('get_catalog'));
    }
//
//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  int  $id
//     * @return Response
//     */
//    public function edit($id)
//    {
//        $get_catalog = ProductCatalog::Where('_id','=',$id)->first();
//        return view('backend.productcatalog.edit', compact('get_catalog'));
//    }
//
    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
      try{
        $files = Input::file('file');
        $data= Request::all();
 
        $catalog_img= ProductCatalog::where('_id', '=', $id)->first();

        if(!empty($files))
        {
            $path = Auth::user()->directory_path."/product_catalogs/";
            $permission = 0777;
            $catalog_name = "catalog_".$data['site_slug']."_".rand(1,1000).".";
            $product_catalog = $this->upload($files, $catalog_name, $path, $permission, true);
            $catalog_img->product_catalog = $product_catalog;
        }
        $catalog_img->status = $data['status'];

        if($catalog_img->save()){
            return Redirect('productcatalog')->with('message',"Updated Successfully.");   
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
//        //
//    }
//    
//    public function selectStore()
//    {
//        $createdby=  User::where('_id',Auth::user()->id)->first();
//        $siteuser=User::where('_id', Auth::user()->id)->first();
//        $subuser= SubUser::where('parent_id', $createdby->parent_id)->first();
//        if(!empty($subuser->permission)){
//            foreach($subuser->permission as $key=>$val){
//                $site[]=$key;
//            }
//        }
//        if(!empty($siteuser) || (!empty($site))){
//            $fm_data =  FieldMaster::where('title', '=', 'business_ecommerce_company')->where('lang','=', 'en')->first();
//            $estores=  BusinessEcommerceCompany::Where('user_id',  $createdby->child_of)->orWhere('user_id','=',  Auth::user()->id)->paginate(25);
//
//            return view('backend.productcatalog.selectstore', compact('fm_data','required','estores','site'));
//        }
//    }
//    
//    public function addCatalog($id)
//    {          
//         $get_catalog = ProductCatalog::Where('shopid','=',$id)->get();
//         return view('backend.productcatalog.addcatalog', compact('get_catalog'))->with('shopid',$id);
//    }
    
    public function errorMessage($e){
        $error = "An error occured. ".
            "Line Number: ".$e->getLine()." ".
            "File Name: ".$e->getFile()." ".
            "Error Description: ".$e->getMessage(); 
        return $error;
    } 
}
