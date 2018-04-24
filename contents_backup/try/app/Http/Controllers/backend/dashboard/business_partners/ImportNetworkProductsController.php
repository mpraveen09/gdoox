<?php

namespace Gdoox\Http\Controllers\backend\dashboard\business_partners;

use DB;
use Auth;
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
use Illuminate\Support\Facades\Route;
use Gdoox\Models\NavigationMenu;

//  This is the controller which is created according to new Requirement created by Mukesh.
//  The Old one is PersonalSitesController.

class ImportNetworkProductsController extends Controller {

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function listBusinessNetwork(){
        if(Auth::user()){
          try {
                $userid= Auth::user()->id;
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('parent', '7')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();

                $fm_data = FieldMaster::where('title', '=', 'personal_sites_new')->first();
                $network_company = BusinessEcommerceCompany::where('user_id','=', $userid)->where('type','=','business')->get();
                return view('backend.dashboard.business_partners.import_products.business_network',compact('route','nav_menu','fm_data','network_company','fm_data'));
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

    public function listSharedSites() {
        if(Auth::user()) {
          try {
            
            $data = Request::all();
            $sharedsites = array();
            
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('parent', '7')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
            $rules = array(
                'slug'=>'required'
            );
            $validator = Validator::make(Request::all(), $rules);

            if ($validator->fails()) {
                return Redirect('dashboard/business/company-network')->withErrors($validator)->withInput(Request::all());   
            }
            else {
                
                $fm_data = FieldMaster::where('title', '=', 'personal_sites_new')->first();
                // This is the Query which was used before to get the Partners when there was Share Site functionality.
                $personal_sites = ShareSite:: where('inviter_id', Auth::user()->id)->where('status', 'Shared')->where('type','=','Company Network')->get();
                // This is the Query to get the network sites for which the User has sent the request to Join  the Company Network.
                $net_partners = BusinessPartner::where('inviter_id', Auth::user()->id)->where('type','Company Network')->where('status','Accepted')->get();
                
                foreach ($personal_sites as $sites){
                    if(!in_array($sites->siteslug, $sharedsites)){
                        $sharedsites[] = $sites->siteslug;
                    }
                }
                
                foreach ($net_partners as $partners){
                    if(!in_array($partners->company_site_slug, $sharedsites)){
                        $sharedsites[] = $partners->company_site_slug;
                    }
                }
                
                return view('backend.dashboard.business_partners.import_products.network_shared_sites',compact('nav_menu','route','fm_data', 'personal_sites', 'data','sharedsites'));
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
    
    /*
     * View Partners product
     */
    
    public function viewPartnersProducts($site="", $networksite=""){
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
                $networksite = $data['site'];
                $site = $data['slug'];  
            }
            
            $productids = array();

            $fm_data = FieldMaster::where('title', '=', 'personal_sites_new')->first();
            $shared_products = SharedProducts::where('store_id', $networksite)->where('inviter_id', Auth::user()->id)->where("share_status", "shared")->where('type','=','Company Network')->where('imported','no')->get();
            foreach($shared_products as $shared){
                $productids[] = $shared->product_id;
            }
            
            $list_products = Products::whereIn('_id', $productids)->paginate(25);
            return view('backend.dashboard.business_partners.import_products.view_network_products',compact('list_products','site','networksite','fm_data'));
        }
        else {
            return redirect()->route('auth/login')->with('message', 'Please Login');
        }
    }
    
    /*
     * Import Partners product
     */
    
    public function importNetworkProducts(){
    if(Auth::user()){
        $data = Request::all();

        $productid = $data['productid'];
        $networksite = $data['networksite'];
        $site = $data['site'];

        $product = Products::where('_id','=', $productid)->first();            

        $clone_product = new Products();
        $clone_product->original_id = $productid;
        $clone_product->userid = Auth::user()->id;
        $clone_product->old_slug = $product->shopid;
        $clone_product->shopid = $site;
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
        $clone_product->network = 'Company Network';

        if($clone_product->save()){
            $change_status = SharedProducts::where('inviter_id','=', Auth::user()->id)->where('product_id','=', $productid)->first();
            $change_status->imported = 'yes';
            $change_status->shared_in = "";
            $change_status->save();
            return Redirect::route('import-network-products.view_products', ['slug'=>$site, 'site'=>$networksite])->with('message', 'Product Imported Successfully!!!');
        }
        else {
            return redirect()->back()->with('message','Something went Wrong! Please try Again');
        }

    }
    else {
        return redirect('auth/login')->with('message',"Please Login to Import Products!"); 
    }
}
            
    public function listCompany(){
        if(Auth::user()){
          try {
                $userid = Auth::user()->id;
                $networks = array();
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('parent', '7')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();

                $fm_data = FieldMaster::where('title', '=', 'personal_sites_new')->first();
                $network_company = BusinessEcommerceCompany::where('user_id','=', $userid)->where('type','=','business')->get();
                
                $assignednetsite = BusinessEcommerceCompany::where('user_id', Auth::user()->id)->where('type','Company Network Site')->first();
                
                foreach($network_company as $company){
                    $networks[$company->slug] = $company->slug;
                }
                
                return view('backend.dashboard.business_partners.import_products.company_network',compact('networks','route','nav_menu','fm_data','network_company','fm_data','assignednetsite'));
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
    
    public function viewProducts($from_store="", $to_store=""){
        if(Auth::user()){
            $data = Request::all();
            $importedproducts = array();
            
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('parent', '7')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
            
            if(!empty($data)){
                $from_store = $data['from_network'];
                $to_store = $data['to_network'];
            }
            
            $imported_products = Products::where('shopid', $to_store)->where('old_slug', $from_store)->where('userid', Auth::user()->id)->get();
            if(!empty($imported_products)){
                foreach($imported_products as $products){
                    $importedproducts[] = $products->original_id;
                }
            }

            $products = Products::whereNotIn('_id',$importedproducts)->where('shopid', $from_store)->where('product_type','!=','shared')->where('status','enabled')->get();      
          
            return view('backend.dashboard.business_partners.import_products.view_products',compact('from_store','fm_data','to_store','products','nav_menu','route'));
        }
        else {
            return redirect()->route('auth/login')->with('message','Please Login');
        }
    }
    
    public function importProductsToNetwork(){
        if(Auth::user()){
            $data = Request::all();
            $product_id = $data['productid'];
            $from_store = $data['from_store'];
            $to_store = $data['to_store'];
            
            $product = Products::where('_id', $product_id)->first();
                        
            $clone_product = new Products();
            $clone_product->original_id = $product_id;
            $clone_product->userid = Auth::user()->id;
            $clone_product->old_slug = $from_store;
            $clone_product->shopid = $to_store;
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
            $clone_product->network = 'Company Network';
            
            if($clone_product->save()){
                return Redirect::route('import-net-products.view_products', ['from_network'=>$from_store, 'to_network'=>$to_store])->with('message', 'Product Imported Successfully!!!');
            }
            else {
                return redirect()->back()->with('message','Something went Wrong! Please try Again');
            }

            return view('backend.dashboard.business_partners.import_products.view_products',compact('from_store','fm_data','to_store','products'));
        }
        else {
            return redirect()->route('auth/login')->with('message','Please Login');
        }
    }


//    public function importProducts(){
//        if(Auth::user()){
//          try {
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
//                $shared_products = SharedProducts::whereIn('store_id', $data['sites'])->where("status", "shared")->where('imported','=','no')
//                        ->where('type','=','Company Network')->project(array('product_id','store_id'))->get();
//               
//                if(!empty($shared_products)) {
//                    foreach ($shared_products as $value) {
//                        
//                        $products = Products::where('_id','=', $value->product_id)->first();
//
//                        $old_product =  Products::where('original_id', $products->id)->where('network','=','Company Network')->first();
//                        if(!empty($old_product)) {
//                            continue;
//                        }
//
//                        $clone_product = new Products();
//                        $clone_product->original_id = $value->product_id;
//                        $clone_product->userid = $userid;
//                        $clone_product->old_slug = $products->shopid;
//                        $clone_product->shopid = $data['slug'];
//                        $clone_product->product_type = "shared";
//                        $clone_product->status = "enabled";
//                        $clone_product->postdate = $products->postdate;
//                        $clone_product->thumb = $products->thumb;
//                        $clone_product->thumb_path = $products->thumb_path;
//                        $clone_product->desc = $products->desc;
//                        $clone_product->purpose = $products->purpose;
//                        $clone_product->cat_ids = $products->cat_ids;
//                        $clone_product->product_data = $products->product_data;
//                        $clone_product->product_images = $products->product_images;
//                        $clone_product->network = 'Company Network';
//                        $clone_product->save();
//
//                        $change_status = SharedProducts::where('store_id','=',$value->store_id)->where('type','=','Company Network')->where('product_id','=',$value->product_id)->first();
//                        $change_status->imported = 'yes';
//                        $change_status->shared_in = "";
//                        $change_status->save();
//                    }
//                    return Redirect('dashboard/business/company-network')->with('message','The products are Imported Successfully');
//                }
//                else {
//                    return Redirect('dashboard/business/company-network')->with('message','There are no products shared with this Store.');
//                }  
//            }
//          }
//          catch (\Exception $e){
//              $error = "An error occured. ".
//                    "Line Number: ".$e->getLine()." ".
//                    "File Name: ".$e->getFile()." ".
//                    "Error Description: ".$e->getMessage();
//              return view('errors.custom_error')->withErrors($error);
//          }
//        }
//        else
//        {
//            return redirect('auth/login')->with('message',"Please Login to Add Information!"); 
//        } 
//    }
}
