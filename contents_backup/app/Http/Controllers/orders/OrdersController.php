<?php

namespace Gdoox\Http\Controllers\orders;
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
use Gdoox\Models\ProductReturns;
use Gdoox\User;
use Form;
use Image;
use Input;

class OrdersController extends Controller {
    use  \Gdoox\Helpers\backend\dashboard\RolesUsers;
    
    private $language;
    public function __construct() {
		if (session()->has('app_language')) {
			//
		}else{
			session(['app_language' => 'en']);
		}  		
        $this->language = session('app_language');
    }

    public function index(){
        if(Auth::user()){
            try {
                $limit = 25;
                $mystores = array();
                
                // $projections = ['items','created_at','order_id'];
                
                $role = $this->getRoleName(Auth::user()->id);
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'ORDERS (OMS)')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();
                
                $business_ecom_shops = EcomShops::where('user_id', Auth::user()->id)->get();
                foreach($business_ecom_shops as $ecom_shops){
                    $mystores[] = $ecom_shops->slug;
                }
                
                $orders = Orders::orderBy('created_at','=','desc')->whereIn('store', $mystores)->paginate($limit);
                
                return view('orders.index', compact('orders','nav_menu','route'));
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
        
        
    }
    
    public function show($suborderid){
        if(Auth::user()){
            try {
                
                $orderstates = array();
                $productdetail = array();
                
                $role = $this->getRoleName(Auth::user()->id);
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'ORDERS (OMS)')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();
                
                $order_details = Orders::where('items.sub_order_id','=', $suborderid)->first();

                $productdetail['sub_order_id'] = $order_details->items['sub_order_id'];
                $productdetail['product_name'] = $order_details->items['product_name'];
                $productdetail['qty'] = $order_details->items['qty'];
                $productdetail['prduct_price'] = $order_details->items['product_price'];
                $productdetail['store'] = $order_details->store;
                $productdetail['image'] = $order_details->items['image'];
                
                $status_log = OrderTracking::where('sub_order_id', $suborderid)->first();
                $states = DropdownOption::where('name','=','Order Status')->where('lang', $this->language)->first();
                
                $orderstates[''] = "Select";
                foreach($states->options as $key=>$state){
                    $orderstates[$state] = $state;
                }
                
                return view('orders.show', compact('route','nav_menu','orderstates','order_details','suborderid','orderid','productdetail','suborderid','status_log'));
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
    
    public function changeProductStatus(){
        if(Auth::user()){
            try {
                $data = Request::all();
                $html= "";
                $suborderid = $data['suborderid'];
                $status = $data['status'];
                $data = Orders::where('items.sub_order_id','=', $suborderid)->first();
                $data->status = $status;
                
                if($data->save()){
                    $ordertracking = OrderTracking::where('sub_order_id','=', $suborderid)->first();
                    
                    $ordertracking->status = $status;
                    $log = array();
                    $date = date('d-m-Y');
                    
                    foreach ($ordertracking->status_log as $key=>$value) {
                        $log[$key] = $value;
                    }
                    
                    if($status==='Approved'){
                        $log['approved_date'] =  $date;
                        $html.="<div style='background-color: rgba(76, 175, 80, 0.67);'>Product approved on ".$date."</div>";
                    }
                    elseif ($status==='Canceled') {
                        $log['cancelled_date'] = $date;
                        $html.="<div style='background-color: rgba(255, 193, 7, 0.57);'>Product Cancelled on ".$date."</div>";
                    }
                    elseif ($status==='Delivered') {
                        $log['delivered_date'] = $date;
                        $html.="<div style='background-color: rgba(76, 175, 80, 0.67);'>Product Delivered on ".$date."</div>";
                    }
                    elseif ($status==='Shipped') {
                        $log['shipped_date'] = $date;
                        $html.="<div>Product Shipped on ".$date."</div>";
                    }
                    elseif ($status==='Refunded') {
                        $log['refund_date'] = $date;
                        $html.="<div>Amount Refunded on ".$date."</div>";
                    }
                    elseif ($status==='Payment Accepted') {
                        $log['payment_accepted_date'] = $date;
                        $html.="<div>Payment Accepted on ".$date."</div>";
                    }
                    elseif ($status==='Payment Error') {
                        $log['payment_error_date'] = $date;
                        $html.="<div>Payment Error on ".$date."</div>";
                    }
                    elseif ($status==='Processing') {
                        $log['payment_processing_date'] = $date;
                        $html.="<div>Payment Processed on ".$date."</div>";
                    }
                    
                    $ordertracking->status_log = $log;
                    if($ordertracking->save()){
//                        $date = date('d-m-Y');                       
//                        if($status==='Approved'){
//                            DB::collection('order_tracking')->where('sub_order_id','=', $suborderid)->push('status_log', array('approved_date'=>$date));
//                            $html.="<div>Product approved on ".$date."</div>";
//                        }
//                        elseif ($status==='Canceled') {
//                            DB::collection('order_tracking')->where('sub_order_id','=',$suborderid)->push('status_log.cancelled_date', $date);
//                            $html.="<div>Product Cancelled on ".$date."</div>";
//                        }
//                        elseif ($status==='Delivered') {
//                            DB::collection('order_tracking')->where('sub_order_id','=',$suborderid)->push('status_log.delivered_date', $date);
//                            $html.="<div>Product Delivered on ".$date."</div>";
//                        }
//                        elseif ($status==='Shipped') {
//                            DB::collection('order_tracking')->where('sub_order_id','=',$suborderid)->push('status_log.shipped_date', $date);
//                            $html.="<div>Product Shipped on ".$date."</div>";
//                        }
//                        elseif ($status==='Refunded') {
//                            DB::collection('order_tracking')->where('sub_order_id','=',$suborderid)->push('status_log.refund_date', $date);
//                            $html.="<div>Amount Refunded on ".$date."</div>";
//                        }
//                        elseif ($status==='Payment Accepted') {
//                            DB::collection('order_tracking')->where('sub_order_id','=',$suborderid)->push('status_log.payment_accepted_date', $date);
//                            $html.="<div>Payment Accepted on ".$date."</div>";
//                        }
//                        elseif ($status==='Payment Error') {
//                            DB::collection('order_tracking')->where('sub_order_id','=',$suborderid)->push('status_log.payment_error_date', $date);
//                            $html.="<div>Payment Error on ".$date."</div>";
//                        }
//                        elseif ($status==='Processing') {
//                            DB::collection('order_tracking')->where('sub_order_id','=',$suborderid)->push('status_log.payment_processing_date', $date);
//                            $html.="<div>Payment Processed on ".$date."</div>";
//                        }
                        return $html;
                    }
                    else {
                        return 'failure';
                    }  
                }
                else {
                     return 'failure';
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
          return redirect('auth/login')->withErrors("Please Login First");         
      }
    }
    
    public function returnProductRequest(){
        if(Auth::user()){
            
            $role = $this->getRoleName(Auth::user()->id);
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'ORDERS (OMS)')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
                
            $business_ecom_shops = EcomShops::where('user_id', Auth::user()->id)->get();
            foreach($business_ecom_shops as $ecom_shops){
                $mystores[] = $ecom_shops->slug;
            }
            
            $returnrequests = ProductReturns::orderBy('created_at','desc')->whereIn('store',$mystores)->get();

            return view('orders.product_return_requests', compact('returnrequests','nav_menu','route'));
            
        }
        else {
             return redirect('auth/login')->withErrors("Please Login First");       
        }
    }
    
    public function storeReturnProductRequest(){
        if(Auth::user()){
            $val="";
            if (Request::ajax()){
                $data = Request::all();
                $log = array();
                $date = date('d-m-Y');
                $storeid = $data['store'];
                $suborderid = $data['suborderid'];
                $action = $data['action'];

                $product = ProductReturns::where('store','=', $storeid)->where('sub_order_id','=',$suborderid)->first();
                 if($product){
                    $ordertracking = OrderTracking::where('sub_order_id','=', $suborderid)->where('store','=',$storeid)->first();
                    foreach ($ordertracking->status_log as $key=>$value) {
                        $log[$key] = $value;
                    }

                    if($action==='Accept'){
                        $log['return_accepted_date'] = $date;
                        $product->return_accepted='true';
                        $val="Accepted";
                    }
                    else {
                        $log['return_rejected_date'] = $date;
                        $product->return_accepted='false'; 
                        $val="Rejected";
                    }
                    if($product->save()){
                           $ordertracking->status_log = $log;
                           $ordertracking->save();
                           return $val; 
                    }
                    else {
                        return 'error';
                    }
                 }
            }
        }
    }

    public function store(){
        
    }
    
    public function edit($id){
        
    }
    
    public function update($id){
        
    }
    
    public function destroy(Request $request, $id){
        
    }
    
}
