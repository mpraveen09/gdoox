<?php

namespace Gdoox\Http\Controllers\backend\dashboard\business_partners;

use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Gdoox\Models\FieldMaster;
use Gdoox\Models\ShareSite;
use Gdoox\Models\Products;
use Gdoox\Models\SharedProducts;
use Gdoox\Models\BusinessInfo;
use Gdoox\Models\BusinessPartner;
use Gdoox\User;
use Gdoox\Http\Requests;
use Gdoox\Models\BusinessEcommerceCompany;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Gdoox\Http\Controllers\Controller;
use Gdoox\Models\NavigationMenu;
use Illuminate\Support\Facades\Route;

//  This is the controller which is created according to new Requirement created by Mukesh.
//  The Old one is PersonalSitesController.

class ImportEcomProductsController extends Controller {
    use \Gdoox\Helpers\backend\dashboard\RolesUsers;
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /*
     * List my Ecommerce Companies.
     */
    
    public function listBusinessEcom(){
        if(Auth::user()){
          try {
                $userid = Auth::id();
                
                $role = $this->getRoleName(Auth::user()->id);
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'BUSINESS ECOSYSTEM')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();
                
                $fm_data = FieldMaster::where('title', '=', 'personal_sites_new')->first();
                $ecom_company = BusinessEcommerceCompany::where('user_id','=', $userid)->where('type','=','business_ecosystem')->get();     
                return view('backend.dashboard.business_partners.import_products.business_ecom',compact('route','nav_menu','fm_data','ecom_company','fm_data'));
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
            return redirect('auth/login')->with('message',"Please Login to Add Information!"); 
        }
    }
    
    /*
     * Import Partners Sites
     */
    
    public function listSharedSites() {
        if(Auth::user()) {
          try {
                $userid = Auth::id();
                $data = Request::all();
                $rules = array(
                    'ecosystem_slug'=>'required'
                );
                
                $validator = Validator::make(Request::all(), $rules);
                if ($validator->fails()) {
                    return Redirect('dashboard/business/ecosystem')->withErrors($validator)->withInput(Request::all());   
                }
                else {
                        $role = $this->getRoleName(Auth::user()->id);
                        $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'BUSINESS ECOSYSTEM')->where('lang','en')->get();
                        $route = Route::getCurrentRoute()->getName();

                        $fm_data = FieldMaster::where('title', '=', 'personal_sites_new')->first();
                        $personal_sites = ShareSite:: where('inviter_id', Auth::user()->id)->where('status', 'Shared')->where('type','!=','Company Network')->get();

                        return view('backend.dashboard.business_partners.import_products.shared_sites',compact('nav_menu','route','fm_data', 'personal_sites', 'data'));
                }
          }
          catch (\Exception $e) {
              $error = "An error occured. ".
                    "Line Number: ".$e->getLine()." ".
                    "File Name: ".$e->getFile()." ".
                    "Error Description: ".$e->getMessage();
              return view('errors.custom_error')->withErrors($error);
          }
        }
        else {
            return redirect('auth/login')->with('message',"Please Login to Add Information!"); 
        }
    }
    /*
     * Import Partners product
     */
    
    public function viewProducts(){
        if(Auth::user()){  
            $data = Request::all();
            if(!empty($data)){
                $rules = array(
                    'site'=>'required'
                );

                $validator = Validator::make(Request::all(), $rules);
                if ($validator->fails()) {
                    return Redirect()->back()->withErrors($validator)->withInput(Request::all());   
                }
                
                $site = $data['site'];
                $ecosystemsite = $data['slug'];  
            }

            $productids = array();
            
            $role = $this->getRoleName(Auth::user()->id);
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'BUSINESS ECOSYSTEM')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
            
            $fm_data = FieldMaster::where('title', '=', 'personal_sites_new')->first();
            $shared_products = SharedProducts::where('store_id', $site)->where("share_status", "shared")->where('type','!=','Company Network')->where('imported','no')->get();
            foreach($shared_products as $shared){
                $productids[] = $shared->product_id;
            }
            
            $list_products = Products::whereIn('_id', $productids)->paginate(3);

            return view('backend.dashboard.business_partners.import_products.view_ecom_products',compact('list_products','site','fm_data','ecosystemsite','nav_menu','route'));
        }
        else {
            return redirect('auth/login')->with('message',"You are not Logged In. Please Login."); 
        }
        
    }
    
    public function importSharedProducts(){
        if(Auth::user()){
            $data = Request::all();
            $productid = $data['productid'];
            $ecosystemsite = $data['ecosystemsite'];
            $site = $data['site'];
            
            $product = Products::where('_id','=', $productid)->first();            

            $clone_product = new Products();
            $clone_product->original_id = $productid;
            $clone_product->userid = Auth::user()->id;
            $clone_product->old_slug = $product->shopid;
            $clone_product->shopid = $ecosystemsite;
            $clone_product->product_type= "shared";
            $clone_product->status= "enabled";
            $clone_product->postdate = $product->postdate;
            $clone_product->thumb = $product->thumb;
            $clone_product->thumb_path = $product->thumb_path;
            $clone_product->desc = $product->desc;
            $clone_product->purpose= $product->purpose;
            $clone_product->product_data = $product->product_data;
            if(!empty($product->cat_ids)){
                $clone_product->cat_ids = $product->cat_ids;
            }
            else {
                $empty = array();
                $clone_product->cat_ids = $empty;
            }
            if(isset($product->product_images)){
                $clone_product->product_images = $product->product_images;
            }
            
            $clone_product->network = 'Ecosystem';

            if($clone_product->save()){
                $change_status = SharedProducts::where('inviter_id','=', Auth::user()->id)->where('product_id','=', $productid)->first();
                $change_status->imported = 'yes';
                $change_status->shared_in = "";
                $change_status->save();
                return Redirect::route('import-ecom-products.view_products', ['slug'=>$ecosystemsite, 'site'=>$site])->with('message', 'Product Imported Successfully!!!');
            }
            else {
                return redirect()->back()->with('message','Something went Wrong! Please try Again');
            }
            
        }
        else {
            return redirect('auth/login')->with('message',"Please Login to Import Products!"); 
        }
    }


//    public function importProducts(){
//        if(Auth::user()) {
//          try{
//            $userid= Auth::id();
//            $data = Request::all();
//            
//            $rules = array(
//                'sites'=>'required'
//            );
//
//            $validator = Validator::make(Request::all(), $rules);
//
//            if ($validator->fails()) {
//                return Redirect::back()->withErrors($validator)->withInput(Request::all());   
//            }
//            else {
//                $shared_products = SharedProducts::whereIn('store_id', $data['sites'])->where("product_type", "shared")->where('type','!=','Company Network')->project(array('product_id','store_id'))->get();
//                if(!empty($shared_products)) {
//                    foreach ($shared_products as $value) {
//                        $products = Products::where('_id','=', $value->product_id)->first();
//                        $old_product =  Products::where('original_id', $products->id)->where('network','=','Ecosystem')->first();
//                        if(!empty($old_product)) {
//                            continue;
//                        }
//                        
//                        $clone_product = new Products();
//                        $clone_product->original_id = $value->product_id;
//                        $clone_product->userid = $userid;
//                        $clone_product->old_slug = $products->shopid;
//                        $clone_product->shopid = $data['slug'];
//                        $clone_product->product_type= "shared";
//                        $clone_product->status= "enabled";
//                        $clone_product->postdate = $products->postdate;
//                        $clone_product->thumb = $products->thumb;
//                        $clone_product->thumb_path = $products->thumb_path;
//                        $clone_product->desc = $products->desc;
//                        $clone_product->purpose= $products->purpose;
//                        $clone_product->cat_ids= $products->cat_ids;
//                        $clone_product->product_data = $products->product_data;
//                        $clone_product->network = 'Ecosystem';
//                        $clone_product->save();
//                        $change_status = SharedProducts::where('store_id','=',$value->store_id)->where('product_id','=',$value->product_id)->first();
//                        $change_status->imported = 'yes';
//                        $change_status->shared_in = "";
//                        $change_status->save();
//                    }
//                    return Redirect('dashboard/business/ecosystem')->with('message','The products are Imported Successfully');
//                }
//                else {
//                    return Redirect('dashboard/business/ecosystem')->with('message','There are no products shared with this Store.');
//                }  
//            }
//          }
//          catch (\Exception $e){
//              $error = "An error occured. ".
//                              "Line Number: ".$e->getLine()." ".
//                              "File Name: ".$e->getFile()." ".
//                              "Error Description: ".$e->getMessage();
//              return view('errors.custom_error')->withErrors($error);
//          }
//        }
//        else
//        {
//            return redirect('auth/login')->with('message',"Please Login to Add Information!"); 
//        } 
//    }

    public function listCompany(){
        if(Auth::user()){
          try {
                $userid= Auth::id();
                
                $role = $this->getRoleName(Auth::user()->id);
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'BUSINESS ECOSYSTEM')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();
                
                $fm_data = FieldMaster::where('title', '=', 'personal_sites_new')->first();
                $companies= BusinessEcommerceCompany::where('user_id','=',$userid)->where('type','=','business_ecosystem')->get();
                return view('backend.dashboard.business_partners.import_products.business_companies',compact('nav_menu','route','fm_data','companies','fm_data'));   
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
            return redirect('auth/login')->with('message',"Please Login to Add Information!"); 
        }
    }

    public function listSites(){
        if(Auth::user()){
          try{
            $userid= Auth::id();
            $data = Request::all();
            
            $rules = array(
                'company_name'=>'required'
             );

            $validator = Validator::make(Request::all(), $rules);

            if ($validator->fails()) {
                return Redirect('dashboard/business/myecosystem')->withErrors($validator)->withInput(Request::all());   
            }
            else {
                $role = $this->getRoleName(Auth::user()->id);
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'BUSINESS ECOSYSTEM')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();
                
                $fm_data = FieldMaster::where('title', '=', 'personal_sites_new')->first();
                $personal_sites= BusinessEcommerceCompany::where('user_id','=',$userid)->where('type','=','business')->get();
                return view('backend.dashboard.business_partners.import_products.business_sites',compact('route','nav_menu','fm_data','personal_sites'))->with('ecom_slug',$data['company_name']);
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
        else {
            return redirect('auth/login')->with('message',"Please Login to Add Information!"); 
        }
    }
    
    public function viewMyProducts($ecom_slug="", $site=""){
        if(Auth::user()){
            $data = Request::all();
            $ecom_slug = $data['ecom_slug'];
            $site = $data['site'];
            $imported = array();
            
            $role = $this->getRoleName(Auth::user()->id);
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'BUSINESS ECOSYSTEM')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
            
            $imported_products = Products::where('shopid', $ecom_slug)->where('old_slug',$site)->where('product_type','=','shared')->get();
            foreach ($imported_products as $products) {
                $imported[] = $products->original_id;
            }

            $list_products = Products::whereNotIn('_id', $imported)->where('shopid', $site)->where('status','enabled')->where('product_type','!=','shared')->where('product_type','!=','opportunities')->where('product_type','!=','multi_item')->paginate(25);
            return view('backend.dashboard.business_partners.import_products.view_my_products',compact('ecom_slug','site','list_products','route','nav_menu'));
        }
        else {
            return redirect()->route('auth/login')->with('message','Please Login');
        }
    }
    
    public function importMyProducts(){
        if(Auth::user()){
            $data = Request::all();
            
            $productid = $data['productid'];
            $ecom_slug = $data['ecom_slug'];
            $site = $data['site'];
            
            $product = Products::where('_id','=', $productid)->first();            

            $clone_product = new Products();
            $clone_product->original_id = $productid;
            $clone_product->userid = Auth::user()->id;
            $clone_product->old_slug = $site;
            $clone_product->shopid = $ecom_slug;
            $clone_product->product_type= "shared";
            $clone_product->status= "enabled";
            $clone_product->postdate = $product->postdate;
            $clone_product->thumb = $product->thumb;
            $clone_product->thumb_path = $product->thumb_path;
            $clone_product->desc = $product->desc;
            $clone_product->purpose= $product->purpose;
            $clone_product->product_data = $product->product_data;
            if(!empty($product->cat_ids)){
                $clone_product->cat_ids = $product->cat_ids;
            }
            else {
                $empty = array();
                $clone_product->cat_ids = $empty;
            }
            if(isset($product->product_images)){
                $clone_product->product_images = $product->product_images;
            }
            $clone_product->network = 'Ecosystem';
            
            if($clone_product->save()){
                return Redirect::route('ecom.view_my_products', ['ecom_slug'=>$ecom_slug, 'site'=>$site])->with('message', 'Product Imported Successfully!!!');
            }
            else {
                return redirect()->back()->with('message','Something went Wrong! Please try Again');
            }
            
        }
        else {
            return redirect()->route('auth/login')->with('message','Please Login');
        }
    }

    public function importSiteProducts(){
        if(Auth::user()) {
          try {
            $userid= Auth::id();
            $data = Request::all();
            
            $rules = array(
                'sites'=>'required'
            );

            $validator = Validator::make(Request::all(), $rules);

            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator)->withInput(Request::all());   
            }
            else {
                $my_products = Products::whereIn('shopid', $data['sites'])->where('userid','=',$userid)->where('status', 'enabled')->where('product_type', '!=', 'opportunities')->get();
                if($my_products->count()){
                    foreach ($my_products as $value) {
                        $clone_product = new Products();
                        $clone_product->userid = $userid;
                        $clone_product->old_slug = $value->shopid;
                        $clone_product->desc = $value->desc;
                        $clone_product->shopid = $data['ecom_slug'];
                        $clone_product->postdate = $value->postdate;
                        $clone_product->desc = $value->desc;
                        $clone_product->thumb = $value->thumb;
                        $clone_product->thumb_path = $value->thumb_path;
                        $clone_product->product_id = $value->id;
                        $clone_product->purpose= $value->purpose;
                        $clone_product->cat_ids= $value->cat_ids;
                        $clone_product->product_data = $value->product_data;
                        $clone_product->network = 'MyEcosystem';
                        if(isset($product->product_images)){
                            $clone_product->product_images = $value->product_images;
                        }
                        $clone_product->save();
                    }  
                    return Redirect('dashboard/business/myecosystem')->with('message','The products are Imported Successfully');
                }
                else {
                    return Redirect('dashboard/business/myecosystem')->with('message','There are no products to share.');
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
        else {
            return redirect('auth/login')->with('message',"Please Login to Add Information!"); 
        } 
    }
}
