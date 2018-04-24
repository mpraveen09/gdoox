<?php

namespace Gdoox\Http\Controllers\orders;
use Gdoox\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
// use Illuminate\Http\Request;
use Gdoox\Models\Orders;
use Gdoox\Models\OrderTracking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Gdoox\Models\NavigationMenu;
use Gdoox\Models\DropdownOption;
use Gdoox\Models\ProductReturns;

class UserOrdersController extends Controller {
    use  \Gdoox\Helpers\backend\dashboard\RolesUsers;
    
    private $language;
    public function __construct(){
        $this->language = session('app_language');
    }

    public function index(){
        if(Auth::user()){
            try {                 
                $limit = 25;
                $trackingids = array();
                $projections = ['items','created_at','order_id','store'];
                $orders = Orders::where('user_id','=', Auth::user()->id)->paginate($limit, $projections);
                
                $role = $this->getRoleName(Auth::user()->id);
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'ORDERS (OMS)')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();
                
                $subOrderIds = array();
                foreach($orders as $order){
                    foreach($order->items as $key=>$items){
                        if($key === 'sub_order_id'){
                            $subOrderIds[] = $items;
                        }
                    }
                }
                
                $tracking = OrderTracking::whereIn('sub_order_id', $subOrderIds)->where('customer_id','=',Auth::user()->id)->get();
                
                foreach($tracking as $values){
                    $trackingids[$values->sub_order_id] = $values->status_log;
                }
                
                
//                echo "<pre>";
//                print_r($trackingids);
//                exit;
                
                return view('userorders.index', compact('nav_menu','route','orders','tracking','trackingids'));
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
    
    public function show($orderid,$suborderid){
        if(Auth::user()){
            try {
                $productdetail = array();
                $role = $this->getRoleName(Auth::user()->id);
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'ORDERS (OMS)')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();
                
                $order_details = Orders::where('user_id','=',Auth::user()->id)->where('order_id','=', $orderid)->first();
                
                if($suborderid === $order_details->items['sub_order_id']){
                    $productdetail['sub_order_id'] = $order_details->items['sub_order_id'];
                    $productdetail['product_name'] = $order_details->items['product_name'];
                    $productdetail['qty'] = $order_details->items['qty'];
                    $productdetail['prduct_price'] = $order_details->items['product_price'];
                    $productdetail['store'] = $order_details->store;
                    $productdetail['image'] = $order_details->items['image'];
                }
                    
                $tracking = OrderTracking::where('sub_order_id', $suborderid)->where('customer_id','=',Auth::user()->id)->project('sub_order_id','status','status_log','price')->first();

                return view('userorders.show', compact('nav_menu','route','order_details','suborderid','orderid','productdetail','suborderid','tracking'));
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
    
    public function returnProduct(){
        if(Auth::user()){
            $data = Request::all();
            $reasons = array();
            $orderid = $data['orderid'];
            $suborderid = $data['suborderid'];
            $storeid = $data['store'];
            
            $role = $this->getRoleName(Auth::user()->id);
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'ORDERS (OMS)')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
            
            $returnstatus = ProductReturns::where('order_id','=',$orderid)->where('sub_order_id','=',$suborderid)->where('store','=',$storeid)->first();
            $product = OrderTracking::where('order_id','=',$orderid)->where('sub_order_id','=',$suborderid)->where('store','=',$storeid)->first();
            
            $returnreasons = DropdownOption::where('name','=','Return Reasons')->where('lang','=', $this->language)->first();
            foreach($returnreasons->options as $key=>$val){
                $reasons[$val] = $val;
            }
 
            return view('userorders.return_product', compact('reasons','product','returnstatus','nav_menu','route')); 
        }
        else {
            return redirect('auth/login')->withErrors("You are not Loggedin.Please Login");         
        }
    }
    
    public function storeReturnProduct(){
        if(Auth::user()){
            $html = "";
            
            if (Request::ajax()){
                $data = Request::all();
                $storeid = $data['store'];
                $orderid = $data['orderid'];
                $suborderid = $data['suborderid'];
                $reason = $data['reason'];
                
                $products = OrderTracking::where('sub_order_id','=',$suborderid)->first();
                
                
                $check = ProductReturns::where('order_id','=',$orderid)->where('sub_order_id','=',$suborderid)->where('store','=',$storeid)->first();
                if(empty($check)){
                    $productreturns = new ProductReturns();
                    $productreturns->store = $storeid;
                    $productreturns->order_id = $orderid;
                    $productreturns->sub_order_id = $suborderid;
                    $productreturns->product_name = $products->product_name;
                    $productreturns->reason = $reason;
                    $productreturns->return_accepted = '';
                }
                else {
                    if($check->return_accepted==='false'){
                        $html = "<div style='background:#ff8080'>Order Status: Order Return Request Rejected by the Seller. Please Contact the seller for more Assistance.</div>"; 
                        return $html;
                    }
                    elseif($check->return_accepted==='true'){
                        $html = "<div style='background:#99ff99'>Order Status: Order Return Request Already Sent to the Seller! Seller has Accepted your Request.</div>"; 
                        return $html;
                    }
                    else {
                        $html = "<div style='background:#ff8080'>Order Status: Order Return Request Already Sent to the Seller! Wait for the Seller Response.</div>"; 
                        return $html;
                    }
                }

                if($productreturns->save()){
                   $html = "<div style='background:#99ff99'>Order Status: Order Return Request Sent to the Seller</div>";
                }
                else {
                   $html = "<div style='background:#ff8080'>Order Status: Order Return Request Could not be Sent to the Seller. Please try Again</div>";
                }
                return $html;
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
