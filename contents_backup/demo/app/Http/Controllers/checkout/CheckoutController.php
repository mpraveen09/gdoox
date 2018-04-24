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
use Gdoox\Models\ProductPayments;
use Gdoox\Models\PaymentMethod;
use Gdoox\User;
use Gdoox\Models\BusinessEcommerceCompany;

class CheckoutController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    
    private $language;
    public function __construct(){
        $this->language = session('app_language');
    }

    

    public function index(){
    }
    
    public function proceedToPayment(){
        $input = Request::all();
        $storeid = $input['storeid'];
        $cookie_val = $_COOKIE['gdoox_shopping_cart'];
        
        if(Auth::user()) {
            $required = "*";
            $countries = DropdownOption::where('name','countries')->where('type','drop_down')->where('lang', $this->language)->first();
            foreach($countries->options as $countryname){
                $country[$countryname] = $countryname;
            }
            
            $products = ShoppingCart::where('shopid','=', $storeid)->where('cart_id','=', $cookie_val)->where('userid','=', Auth::user()->id)->where('status','=','0')->project(array('userid','product_name','shopid','desc','price','qty','thumb', 'thumb_path','vat','eco_tax','duty_tax','local_tax'))->get();
            $address = ShoppingAddressDetails::where('user_id','=', Auth::user()->id)->first();
            $formFields = FieldMaster::where('title','=','checkout')->first();
                      
            return view('checkout.create', compact('products','formFields','required','country','address','storeid'));
        }
        else {
             return redirect('auth/login')->with('message',"Please Login!"); 
        }
    }
    
//    public function create(){    
//        $input = Request::all();
//        if(Auth::user()) {
//            $required = "*";
//            $cookie_val = $_COOKIE['gdoox_shopping_cart'];
//            $countries = DropdownOption::where('name','countries')->where('type','drop_down')->where('lang', $this->language)->first();
//            foreach($countries->options as $countryname){
//                $country[$countryname] = $countryname;
//            }
//
//            $products = ShoppingCart::where('cart_id','=', $cookie_val)->orWhere('userid', '=' , Auth::user()->id)->where('status','=','0')->project(array('userid','product_name','shopid','desc','price','qty','thumb', 'thumb_path','vat','eco_tax','duty_tax','local_tax'))->get();
//            
//            $address = ShoppingAddressDetails::where('user_id','=', Auth::user()->id)->first();
//            $formFields = FieldMaster::where('title','=','checkout')->first();
//            return view('checkout.create',  compact('products', 'formFields','required','country','address'));
//        }
//        else {
//             return redirect('auth/login')->with('message',"Please Login!"); 
//        }
//    }
    
    public function store(){
        if(Auth::user()){
            $request = Request::all();
            $storeid = $request['storeid'];
            
            $check = ShoppingAddressDetails::where('user_id','=',Auth::user()->id)->first();
                       
            if(!empty($check)){
                list($shipping_address, $billing_address) = $this->getAddress($request);
                $check->shipping_address = $shipping_address;
                $check->billing_address = $billing_address;
                if($check->save()){
                    return Redirect::route('checkout.payment_methods',['storeid'=>$storeid,'net_payable_amount'=>$request['net_payable_amount']]);
                }
                else {
                    return Redirect::route('checkout.create')->with('error','Address Details could not be saved. Please try again');
                } 
            }
            else {
                $data = new ShoppingAddressDetails();
                $data->user_id = Auth::user()->id;
                list($shipping_address, $billing_address) = $this->getAddress($request);
                $data->shipping_address = $shipping_address;
                $data->billing_address = $billing_address;
                
                if($data->save()){
                    return Redirect::route('checkout.payment_methods',['storeid'=>$storeid,'net_payable_amount'=>$request['net_payable_amount']]);
                }
                else {
                    return Redirect::route('checkout.create')->with('error','Address Details could not be saved. Please try again');
                }
            }
        }
    }
    
    public function show($id){
        
    }
    
    public function edit(){
        
    }
    
    public function update($param) {
        
    }
    
    
    public function selectPaymentMethods(){
        // $paypal_id = 'merchant@gdoox.com'; // Business email ID
        $request = Request::all();        
        $storeid = $request['storeid'];
        
        $site_owner = BusinessEcommerceCompany::Where('slug','=', $storeid)->first();
       
        $currency_code = 'EUR';
        
        if(!empty($site_owner) && !empty($site_owner->user_id)){
            $merchant_id = PaymentMethod::where('user_id', $site_owner->user_id)->first();
        }
        
        if(!empty($merchant_id)){
            echo $paypal_id = $merchant_id->paypal_id;
            //return redirect()->route('payment-method-index')->with('message','The Paypal Method and Merchant Id is not set. Please set a Merchant Id.');
        }//else{
        //if(!isset($merchant_id->paypal_business_id)){
            //return redirect()->route('payment-method-index')->with('message','The Paypal Method and Merchant Id is not set. Please set a Merchant Id.');
        //}
        else {
            //$paypal_id = $merchant_id->paypal_business_id;
        }
        $products = ShoppingCart::where('shopid','=', $storeid)->where('userid', '=' , Auth::user()->id)->where('status','=','0')->get();
        // To check the Currency Code of the Product.
        // In case the Product is a Shared Product this can not be followed 
        // because the Currency can be different and the price will vary according to this.
        
        if(!empty($products[0]->product_data[13])){
            $currency_code = substr($products[0]->product_data[13], -3);
        }
        
        $address = ShoppingAddressDetails::where('user_id','=', Auth::user()->id)->first();
        $user = User::where('_id', Auth::user()->id)->first();
        $orderid = $this->createOrderId();
        $formFields = FieldMaster::where('title','=','checkout')->first();
        
        return view('checkout.payment_methods', compact('formFields','required','storeid','request','address','paypal_id','user','orderid','products','merchant_id','currency_code'));
        
//        $month = ['1','2','3','4','5','6','7','8','9','10','12'];
//        $year = ['2016','2017','2018','2019','2020'];
//        $card_type = ['All Visa/MasterCard Debit Card','All Rupay Debit Cards','All SBI Debit Cards','Citibank Maestro Debit Card'];
//        $bank = ['SBI','PNB','ICICI','Citibank','IndusInd'];
    }
    
    public function paymentSuccess(){
        
        $data = Request::all();        
//        The Paypal payment Status:
//
//        Canceled_Reversal: A reversal has been canceled. For example, you won a dispute with the customer, and the funds for the transaction that was reversed have been returned to you.
//        Completed: The payment has been completed, and the funds have been added successfully to your account balance.
//        Created: A German ELV payment is made using Express Checkout.
//        Denied: You denied the payment. This happens only if the payment was previously pending because of possible reasons described for the pending_reason variable or the Fraud_Management_Filters_x variable.
//        Expired: This authorization has expired and cannot be captured.
//        Failed: The payment has failed. This happens only if the payment was made from your customer’s bank account.
//        Pending: The payment is pending. See pending_reason for more information.
//        Refunded: You refunded the payment.
//        Reversed: A payment was reversed due to a chargeback or other type of reversal. The funds have been removed from your account balance and returned to the buyer. The reason for the reversal is specified in the ReasonCode element.
//        Processed: A payment has been accepted.
//        Voided: This authorization has been voided.
        
        $user = User::where('_id', Auth::user()->id)->first(); 
        
        if($data['payment_status'] === 'Completed'){
            $custom = explode(",", $data['custom']);
            $payment_plan = new ProductPayments();
            $payment_plan->first_name = $data['first_name'];
            $payment_plan->last_name = $data['last_name'];
            $payment_plan->userid = Auth::user()->id;
            $payment_plan->item_name = $data['item_name'];
            $payment_plan->amount = (Int)$data['payment_gross']; 
            $payment_plan->order_id = trim($custom[0]);
            $payment_plan->currency = $data['mc_currency'];
            $payment_plan->email = $user->email;
            $payment_plan->payer_id = $data['payer_id'];
            
            $payment_plan->payment_date = $data['payment_date'];
            $payment_plan->payment_status = $data['payment_status'];
            if($payment_plan->save()){
                return redirect()->route('checkout.payment_confirm',['status'=>$data['payment_status'],'orderid'=>trim($custom[0]),'storeid'=>trim($custom[0])])->with('message','Payment Completed Successfully');
            }
        }
        elseif($data['payment_status'] === 'Failed') {
            return view('orders.payment_failure');
        }
    }
    
    
    public function paymentConfirm(){
        if(Auth::user()){
            $input = Request::all();         
            $storeid = $input['storeid'];
            $orderid = $input['orderid'];
            $payment_status = $input['payment_status'];
            
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
                $transaction['payment_status'] = $payment_status;

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

                $suborderid = $this->createSuborderId();

                $items['sub_order_id'] = $suborderid;
                $order['order_id'] = $orderid;
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
                $order['payment_status'] = $payment_status;

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
    
    public function getAddress($req){
        
        $address1 = array();
        $address2 = array();
        
        $address1['s_first_name'] = $req['s_first_name'];
        $address1['s_last_name'] = $req['s_last_name'];
        $address1['s_company_name'] = $req['s_company_name'];
        $address1['s_street_add'] = $req['s_street_add'];
        $address1['s_city'] = $req['s_city'];
        $address1['s_country'] = $req['s_country'];
        $address1['s_country_area'] = $req['s_country_area'];
        $address1['s_ph_no'] = $req['s_ph_no'];

        $address2['b_first_name'] = $req['b_first_name'];
        $address2['b_last_name'] = $req['b_last_name'];
        $address2['b_company_name'] = $req['b_company_name'];
        $address2['b_street_add'] = $req['b_street_add'];
        $address2['b_city'] = $req['b_city'];
        $address2['b_country'] = $req['b_country'];
        $address2['b_country_area'] = $req['b_country_area'];
        $address2['b_ph_no'] = $req['b_ph_no'];
        
        return array($address1, $address2);
    }
    
}


