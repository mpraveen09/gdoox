<?php

namespace Gdoox\Http\Controllers\b2b_price_request;
use DB;
use Gdoox\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Gdoox\Models\PersonalInfo;
use Gdoox\Models\Products;
use Gdoox\Models\ShoppingCart;
use Gdoox\Models\EcomShops;
use Gdoox\Models\Orders;
use Gdoox\Models\OrderTracking;
use Gdoox\Models\BusinessInfo;
use Gdoox\Models\DropdownOption;
use Illuminate\Support\Facades\Auth;
use Gdoox\Models\NavigationMenu;
use Illuminate\Support\Facades\Route;
use Gdoox\Models\B2BPriceRequests;
use Gdoox\Models\B2BProductPriceApprovals;
use Gdoox\Models\B2BStorePriceApprovals;

use Gdoox\User;
use Form;
use Image;
use Input;

class B2BPriceRequestController extends Controller {

    use \Gdoox\Helpers\backend\dashboard\HelperFunctions;
    use \Gdoox\Helpers\backend\dashboard\RolesUsers;
    
    public function index(){
        if(Auth::user()){
            try { 
                $stores = array();
                $limit = 50;
                $EcomShops = EcomShops::where('user_id', Auth::user()->id)->where('type','business')->get();
                
                if(!empty($EcomShops)){
                    foreach($EcomShops as $shops){
                        $stores[] = $shops->slug;
                    }
                }
                
                $requests = B2BPriceRequests::orderBy('created_at','=','desc')->whereIn('shopid', $stores)->where('status','Pending')->paginate($limit);
                return view('b2b_price_request.index', compact('requests'));
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
          return redirect('auth/login')->withErrors("Please Login First");         
      }
    }
    
    public function create(){
        if(Auth::user()){
            $data = Request::all();
            $shopid = $data['shopid'];
            $product_id = $data['product_id'];
            return view('b2b_price_request.create',compact('shopid','product_id'));
        }
        else {
            return redirect('auth/login')->withErrors("Please Login First");
        }  
    }
    
    public function show($id){
        if(Auth::user()){
            try {
                
                
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
          return redirect('auth/login')->withErrors("Please Login First");         
      }
    }

    public function store(){
        if(Auth::user()){
            $request = Request::all();
            
            $product_details = Products::where('_id', $request['product_id'])->first();
            
            $data = new B2BPriceRequests();
            $data->shopid = $request['shopid'];
            $data->product_id = $request['product_id'];
            $data->desc = $product_details->desc;
            $data->thumb = $product_details->thumb;
            $data->thumb_path = $product_details->thumb_path;
            $data->company = $this->Company($request['shopid']);
            $data->message = $request['message'];
            $data->userid = Auth::user()->id;
            $data->user_name = $this->GetUserName(Auth::user()->id);
            $data->user_company = $this->GetCompany(Auth::user()->id);
            $data->status = "Pending";
            
            if($data->save()){
                return view('b2b_price_request.success');
            }
            else {
                return redirect()->back()->with('message','Something went Wrong. Please try Again');
            }            
        }
        else {
            return redirect('auth/login')->withErrors("Please Login First");
        }
    }
    
    public function edit($id){
        
    }
    
    public function update($id){
        
    }
    
    public function destroy(Request $request, $id){
        
    }
    
    public function approveProductPriceReq($id){
        if(Auth::user()){
            $data = B2BPriceRequests::where('_id', $id)->first();
            
            $appr_request = new B2BProductPriceApprovals();
            $appr_request->req_ref_id = $id;
            $appr_request->shopid = $data->shopid;
            $appr_request->product_id = $data->product_id;
            $appr_request->req_user_id = $data->userid;
            $appr_request->status = 'Approved';
            
            if($appr_request->save()){
                $data->status = "Approved";
                if($data->save()){
                    return redirect('products/b2b/price-request')->with('message','Request Approved Successfully.');
                }
                else {
                    B2BProductPriceApprovals::where('req_ref_id', '=', $id)->delete();
                    return redirect()->back()->with('message','Something went Wrong! Please try Again.');
                }
            }
            else {
                return redirect()->back()->with('message','Something went Wrong! Please try Again.');
            } 
        }
        else {
            return redirect('auth/login')->withErrors("Please Login!");      
        }
    }
    
    public function approveStorePriceReq($id){
        if(Auth::user()){
            $data = B2BPriceRequests::where('_id', $id)->first();
            
            $appr_request = new B2BStorePriceApprovals();
            $appr_request->req_ref_id = $id;
            $appr_request->shopid = $data->shopid;
            $appr_request->product_id = $data->product_id;
            $appr_request->req_user_id = $data->userid;
            $appr_request->status = 'Approved';
            
            if($appr_request->save()){
                $data->status = "Approved";
                if($data->save()){
                    return redirect('products/b2b/price-request')->with('message','Request Approved Successfully.');
                }
                else {
                    B2BStorePriceApprovals::where('req_ref_id', '=', $id)->delete();
                    return redirect()->back()->with('message','Something went Wrong! Please try Again.');
                }
            }
            else {
                return redirect()->back()->with('message','Something went Wrong! Please try Again.');
            } 
        }
        else {
            return redirect('auth/login')->withErrors("Please Login!");      
        }
    }
    
}
