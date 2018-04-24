<?php

namespace Gdoox\Http\Controllers\checkout;
use Gdoox\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Gdoox\Models\Exceptions;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Gdoox\Models\FieldMaster;
use Gdoox\Models\ShoppingCart;
use Illuminate\Support\Facades\Auth;
use Gdoox\Models\DropdownOption;
use Gdoox\Models\ShoppingAddressDetails;
use Gdoox\Models\OrderTracking;
use Gdoox\Models\Orders;


class CheckoutController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(){
    }

    public function create(){    
        $input = Request::all();
        if(Auth::user()) {
            $required = "*";
            $countries = DropdownOption::where('name','countries')->where('lang', 'en')->first();
            
            foreach($countries->options as $countryname){
                $country[$countryname] = $countryname;
            }
            
            $cookie_val = $_COOKIE['gdoox_shopping_cart'];
            $products = ShoppingCart::where('cart_id','=', $cookie_val)->orWhere('userid', '=' , Auth::user()->id)->where('status','=','0')->project(array('userid','product_name','shopid','desc','price','qty','thumb', 'thumb_path','vat','eco_tax','duty_tax','local_tax'))->get();
            $address = ShoppingAddressDetails::where('user_id','=', Auth::user()->id)->first();
            $formFields = FieldMaster::where('title','=','checkout')->first();
            return view('checkout.create',  compact('products', 'formFields','required','country','address'));
        }
        else {
             return redirect('auth/login')->with('message',"Please Login!"); 
        }
    }
    
    public function store(){
        if(Auth::user()){
            $request = Request::all();
            $storeid = $request['storeid'];
            
            $check = ShoppingAddressDetails::where('user_id','=',Auth::user()->id)->first();
            
            if(!empty($check)){
                return Redirect::route('checkout.payment_methods',['storeid'=>$storeid]);
            }
            else {
                $data = new ShoppingAddressDetails();
                $shipping_address = array();
                $billing_address = array();
                $shipping_address['s_first_name'] = $request['s_first_name'];
                $shipping_address['s_last_name'] = $request['s_last_name'];
                $shipping_address['s_street_add'] = $request['s_street_add'];
                $shipping_address['s_city'] = $request['s_city'];
                $shipping_address['s_country'] = $request['s_country'];
                $shipping_address['s_country_area'] = $request['s_country_area'];
                $shipping_address['s_ph_no'] = $request['s_ph_no'];

                $billing_address['b_first_name'] = $request['s_first_name'];
                $billing_address['b_last_name'] = $request['s_last_name'];
                $billing_address['b_street_add'] = $request['s_street_add'];
                $billing_address['b_city'] = $request['s_city'];
                $billing_address['b_country'] = $request['s_country'];
                $billing_address['b_country_area'] = $request['s_country_area'];
                $billing_address['b_ph_no'] = $request['s_ph_no'];

                $data->user_id = Auth::user()->id;
                $data->shipping_address = $shipping_address;
                $data->billing_address = $billing_address;
                
                if($data->save()){
                    return Redirect::route('checkout.payment_methods',['storeid'=>$storeid]);
                }
                else {
                    return Redirect::route('checkout.create')->with('error','Address Details could not be saved. Please try again');
                }
            }
        }
        
        
        if($errors->save()){
            return Redirect::route('dash-board')->with('error',"Error Report Added Successfully.");
        }
        else {
            Session::flash('message', 'Error Report Could not be added! Please Try Again');
            return Redirect::route('exceptions.create')->with(Request::all());
        }
    }
    
    public function show($id){
        
    }
    
    public function edit(){
        
    }
    
    public function update($param) {
        
    }
    
    public function proceedToPayment(){
        
        $input = Request::all();
        $storeid = $input['storeid'];
        
        if(Auth::user()) {
            $required="*";
            
            $countries = DropdownOption::where('name','countries')->where('lang', 'en')->first();
            foreach($countries->options as $countryname){
                $country[$countryname] = $countryname;
            }
            
            $cookie_val = $_COOKIE['gdoox_shopping_cart'];
            $products = ShoppingCart::where('shopid','=', $storeid)->where('userid', '=' , Auth::user()->id)->where('status','=','0')->project(array('userid','product_name','shopid','desc','price','qty','thumb', 'thumb_path','vat','eco_tax','duty_tax','local_tax'))->get();
            $address = ShoppingAddressDetails::where('user_id','=', Auth::user()->id)->first();
            $formFields = FieldMaster::where('title','=','checkout')->first();
            return view('checkout.create', compact('products','formFields','required','country','address','storeid'));
        }
        else {
             return redirect('auth/login')->with('message',"Please Login!"); 
        }
    }
    
    public function selectPaymentMethods(){
        $request = Request::all();
        $storeid = $request['storeid'];
        
        $required = "*";
        $month = ['1','2','3','4','5','6','7','8','9','10','12'];
        $year = ['2016','2017','2018','2019','2020'];
        $card_type = ['All Visa/MasterCard Debit Card','All Rupay Debit Cards','All SBI Debit Cards','Citibank Maestro Debit Card'];
        $bank = ['SBI','PNB','ICICI','Citibank','IndusInd'];
        $formFields = FieldMaster::where('title','=','checkout')->first();
        return view('checkout.payment_methods', compact('formFields','required','month','year','card_type','bank','storeid'));
    }
    
    public function createOrderId(){
            $str1 ='';
            $str2 ='';
            
            for($i=0; $i<4 ; $i++){
                $str1.= chr(rand(65, 90));
            }
 
            for($i=0; $i<4 ; $i++){
                $str2.= chr(rand(65, 90));
            }
            
            $orderid = $str1."-".rand(1000,99999)."-".$str2."-".rand(1000,99999);
            $check = OrderTracking::where('order_id','=', $orderid)->first();
            if(!empty($check)){
                $this->createOrderId();
            }
            else {
                return $orderid;
            }
    }
    
    public function createSuborderId(){
            $str1 ='';
            $str2 ='';
            for($i=0; $i<4 ; $i++){
                $str1.= chr(rand(65, 90));
            }

            for($i=0; $i<4 ; $i++){
                $str2.= chr(rand(65, 90));
            }
            
            $suborderid = $str1."-".rand(1000,99999)."-".$str2."-".rand(1000,99999);
            $check = OrderTracking::where('sub_order_id','=', $suborderid)->first();
            if(!empty($check)){
                $this->createSuborderId();
            }
            else {
                return $suborderid;
            }
    }

    public function paymentConfirm(){
    if(Auth::user()){
        $input = Request::all();
        $storeid = $input['storeid'];
        
        $address_details = ShoppingAddressDetails::where('user_id','=',Auth::user()->id)->first();
        $products = ShoppingCart::where('shopid','=', $storeid)->where('userid','=', Auth::user()->id)->where('status','=','0')->get();
        
        
        foreach($products as $product){
            $total_amt = 0;
            $order = new Orders();
            $ordertracking = new OrderTracking();
            // Payment Information for Orders Table.
            $transaction = array();
            $transaction['transaction_id'] = rand(1000, 9999);
            $transaction['payment_type'] = 'Internet Banking';
            $transaction['payment_status'] = 'Success';

            $items['product_name'] = $product->product_name;
            $items['product_id'] = $product->product_id;
            $items['qty'] = $product->qty;
            $items['image'] = $product->thumb_path.$product->thumb;
            
            if(!empty($product->vat) && $product->vat!== 0){  
               $vat = $product->price * ($product->vat/100);echo "<br>";
               $total_amt = $product->price + $vat;
            }

            if(!empty($product->eco_tax) && $product->eco_tax!== 0){  
                $eco_tax = $product->price * ($product->eco_tax/100);echo "<br>";
                $total_amt = $total_amt + $eco_tax;
            }

            if(!empty($product->duty_tax) && $product->duty_tax!== 0){  
                $duty_tax = $product->price * ($product->duty_tax/100);echo "<br>";
                $total_amt = $total_amt + $duty_tax;
            }

            if(!empty($product->local_tax) && $product->local_tax!== 0){ 
                $local_tax = $product->price * ($product->local_tax/100); echo "<br>";
                $total_amt = $total_amt + $local_tax;
            }

            $items['product_price'] = round($total_amt,2);
            
            $orderid = $this->createOrderId();
            $suborderid = $this->createSuborderId();
            
            $items['sub_order_id'] = $orderid;
            $order['order_id'] = $suborderid;
            $order['transaction'] = $transaction;
            $order['status'] = "Pending";
            $order['date'] = date('Y-m-d');
            $order['customer_id'] = Auth::user()->id;
            $order['store'] = $product->shopid;
            $order['shipping_address'] = $address_details->shipping_address;
            $order['billing_address'] = $address_details->billing_address;
            $order['contact_no'] = '';
            $order['items'] = $items;
            $order['user_id'] = Auth::user()->id;

            // Payment Information for OrderTracking Table.

            $ordertracking['order_id'] = $order['order_id'];
            $ordertracking['sub_order_id'] = $items['sub_order_id'];
            $ordertracking['product_name'] = $product->product_name;
            $ordertracking['product_id'] = $product->product_id;
            $ordertracking['price'] = round($total_amt,2);
            $ordertracking['store'] = $product->shopid;
            $ordertracking['status_log.order_date'] = date('d-m-Y');
            $ordertracking['customer_id'] = Auth::user()->id;
            $ordertracking['status'] = "Pending";

            if($order->save()){
                if($ordertracking->save()){
                    $cart = ShoppingCart::where('userid','=',Auth::user()->id)->where('product_id','=',$product->product_id)->first();
                    $cart->status = '1';
                    $cart->save();
                }
                else {
                    return redirect()->back()->with('message','Something went Wrong! Product could not be ordered. Please try Again.');
                }   
            }
            else {
                 return Redirect::route('userorders.index')->with('message','Product or Some Products could not be Ordered! Please check and try again');
            }
        }
        
        $check = ShoppingCart::where('userid','=', Auth::user()->id)->where('status','=','0')->first();
        if(!empty($check)){
            return Redirect::route('view_cart')->with('message','Product Ordered Successfully');
        }
        else {
            return Redirect::route('userorders.index')->with('message','Product Ordered Successfully');
        }   
    }
    else {
         return redirect('auth/login')->with('message',"Please Login!"); 
    }   
}
}


