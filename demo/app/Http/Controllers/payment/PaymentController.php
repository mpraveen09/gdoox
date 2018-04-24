<?php

namespace Gdoox\Http\Controllers\payment;

use DB;
use Gdoox\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Gdoox\Models\GdooxPlatformPlans;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Gdoox\Models\CountrySubscriptionCharges;
use Gdoox\Models\GdooxSubscriptionInfo;
use Gdoox\Models\DropdownOption;
use Gdoox\User;
use Gdoox\UserRole;
use Gdoox\Role;
use Gdoox\Models\GdooxPaypalPayment;
use Gdoox\Models\GdooxSubscriptionPayments;
use Gdoox\Helpers\PaypalIPN;
use Carbon\Carbon;

use Gdoox\Models\GdooxSubscriptionPlanNames;
use Gdoox\Models\GdooxSubscriptionPlans;
use Gdoox\Models\GdooxSubscriptionTypes;
use Gdoox\Models\InviteUser;

class PaymentController extends Controller {
     use \Gdoox\Helpers\backend\dashboard\RolesUsers;
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
     
    public function accountPlans(){
        return view('payment.plans'); 
    }


    public function index(){
        
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(){
        if(Auth::user()){
            $user = User::where('_id', Auth::user()->id)->first();
//            echo Auth::user()->id;
            
            $countries =  DropdownOption::where('name','countries')->where('type','drop_down')->where('lang','en')->first();
            foreach($countries->options as $countryname){
                $country[$countryname] = $countryname;
            }

        //$roleID = $this->roleID(Auth::user()->id);
        //$userrole = $this->getRole($roleID);
        $roleID = UserRole::where('user_id' ,'=', Auth::user()->id)->first();
        
        if(!empty($roleID->role_id)){
            $userrole['role_id'] = $roleID->role_id;
            $role = Role::where('_id',$roleID->role_id)->first();
            $userrole['name'] = $role->name ;            
            $userrole['rank'] = $role->rank;
            if(!empty($userrole['rank'])){
                $roles = Role::where('level',2)->where('rank','<=',$userrole['rank'])->orderBy('rank','desc')->get();
            }else{
                $roles = Role::where('level',2)->orderBy('rank','desc')->get();
            }
            //$rolesdd=[];

                
        }else{
            //assign a role
            $roles = Role::where('level',2)->orderBy('rank','desc')->get();
        }
        
        foreach ($roles as $role){
            $rolesdd[$role->name]=$role->label;
        }        
//        var_dump($rolesdd);
        
        return view('payment.create', compact('user','plans','country','rolesdd','userrole'));
        
        $GdooxSubscriptionType=GdooxSubscriptionTypes::where('user_type', $userrole )->first();

//        var_dump($GdooxSubscriptionType->label);
//        exit();
//            return view('payment.create', compact('user','plans','country','GdooxSubscriptionType'));
        }
        else {
            return redirect('auth/login')->with('message','Please Login');
        }
    }
    
    public function planConfigure(Request $request){
        if(Auth::user()){
        // $paypal_id = 'merchant@gdoox.com'; // Business email ID
            $data = Request::all();

            $user = User::where('_id', Auth::user()->id)->first();

            $roleID=$this->getRoleID($data['plan']);
            $user_role = $this->roleID(Auth::user()->id);
            if(!empty($user_role ) ){
                $user_role = UserRole::where('user_id' ,'=', Auth::user()->id)->first();
                $user_role->role_id = $roleID;
                if($user_role->save()){

                }
            }else{
                $this->storeUserRole(Auth::user()->id, $roleID);
            }

            
            $GdooxPlan = GdooxSubscriptionPlans::orderBy('updated_at', 'desc')->where('subscriptiontype', $data['plan'])->where('country', $data['country'])->first();

            if(empty($GdooxPlan)){
                $GdooxPlan= GdooxSubscriptionPlans::orderBy('updated_at', 'desc')->where('subscriptiontype', $data['plan'])->where('default', 'yes')->first();
            }
//            var_dump($GdooxPlan);
            $PlanFields =  GdooxSubscriptionPlanNames::orderBy('display_order', 'asc')->get();
            
//            var_dump($PlanFields);
            $html_data=[];
            foreach ($PlanFields as $fields){
                if($fields->display_type !== "user"){

                        
                    $html_data[$fields->plan_id] =  [
                                                    "id" => $fields->plan_id,
                                                    "label" => $fields->label,
                                                    "type"=> $fields->type,
                                                    "display_order"=> $fields->display_order,
                                                    "val" => $GdooxPlan[$fields->plan_id],
                                                    "inputtype" => "readonly"
                                                ];
                    if($fields->type === "num" && (empty($GdooxPlan[$fields->plan_id]) || $GdooxPlan[$fields->plan_id]===0) ){

                    }else{                        
                        $PlanUField =  GdooxSubscriptionPlanNames::where('display_order', $fields->display_order . '_num')->first();
                        if(!empty($PlanUField)){
                        $html_data[$PlanUField->plan_id] =  [
                                                        "id" => $PlanUField->plan_id,
                                                        "label" => $PlanUField->label,
                                                        "type"=> $PlanUField->type,
                                                        "display_order"=> $PlanUField->display_order,
                                                        "display_type"=> $PlanUField->display_type,
                                                        "val" => "",
                                                        "inputtype" => "input_num"
                                                    ];                
                        }
                        $PlanUField =  GdooxSubscriptionPlanNames::where('display_order', $fields->display_order . '_price')->first();
                        if(!empty($PlanUField)){
                        $html_data[$PlanUField->plan_id] =  [
                                                        "id" => $PlanUField->plan_id,
                                                        "label" => $PlanUField->label,
                                                        "type"=> $PlanUField->type,
                                                        "display_order"=> $PlanUField->display_order,
                                                        "display_type"=> $PlanUField->display_type,
                                                        "val" => "",
                                                        "inputtype" => "input_auto"
                                                    ];         
                        }
                    }
                    
                }elseif($fields->type === 'total_price' || $fields->type === 'total_optional_price' ){
                    $html_data[$fields->plan_id] =  [
                                                    "id" => $fields->plan_id,
                                                    "label" => $fields->label,
                                                    "type"=> $fields->type,
                                                    "display_order"=> $fields->display_order,
                                                    "display_type"=> $fields->display_type,
                                                    "val" => "",
                                                    "inputtype" => "input_auto"
                                                ];
                }
            }            
            
//            echo "<pre>";
//            print_r($html_data);
            
            return view('payment.plan_conigure', compact('html_data','GdooxPlan','data','user'));
            
//            exit();
//            
//            $PlanFieldNames =  GdooxSubscriptionPlanNames::orderBy('display_order', 'asc')->where('display_type','<>','user')->get();
//            $UserFields =  GdooxSubscriptionPlanNames::orderBy('display_order', 'asc')->where('display_type','=','user')->get();
//            var_dump($UserFields);
//            foreach ($PlanFieldNames as $fields){
//                echo $fields->plan_id;
//                echo $fields->label;
//                echo $GdooxPlan[$fields->plan_id];
//                
//                $UField =  GdooxSubscriptionPlanNames::orderBy('display_order', 'asc')->where('display_type','=','user')
//                                ->where('display_type','=','user')->first();
//                
////                if($UserFields[''])
////                var_dump($k);
//            }
            
        }
        else {
            return redirect('auth/login')->with('message','Please Login');
        }           
    }

    public function proceedToPayment(Request $request){
        if(Auth::user()){
        // $paypal_id = 'merchant@gdoox.com'; // Business email ID
        $data = Request::all();
        
//        var_dump($data);
        

            
//        exit();
        
        $userrole = $data['plan_name'];
        $amount = $data['total_price'];
        
        $user = User::where('_id', Auth::user()->id)->first();
        
//        assign role
        
        $roleID=$this->getRoleID($data['plan_name']);
        $user_role = $this->roleID(Auth::user()->id);
        if(!empty($user_role ) ){
            $user_role = UserRole::where('user_id' ,'=', Auth::user()->id)->first();
            $user_role->role_id = $roleID;
            if($user_role->save()){
                
            }
        }else{
            $this->storeUserRole(Auth::user()->id, $roleID);
        }
//        exit();
        
//        $roleID = $this->roleID(Auth::user()->id);
//        $userrole = $this->getRole($roleID);
//        $GdooxSubscriptionCharges= GdooxSubscriptionPlans::orderBy('updated_at', 'desc')->where('subscriptiontype', $userrole)->where('country', $data['country'])->first();
//        
//        if(empty($GdooxSubscriptionCharges)){
//            $GdooxSubscriptionCharges= GdooxSubscriptionPlans::orderBy('updated_at', 'desc')->where('subscriptiontype', $userrole)->where('default', 'yes')->first();
//        }
        

        $GdooxSubscriptionCharges= GdooxSubscriptionPlans::find($data['plan']);


    
//        $GdooxSubscriptionType=GdooxSubscriptionTypes::where('user', $GdooxSubscriptionCharges->subscriptiontype)->first();
        $GdooxSubscriptionType=GdooxSubscriptionTypes::where('user_type', $userrole )->first();
        
//        $amount =$GdooxSubscriptionCharges->pricing;
        
                
        if($amount <=0){
            $subscription = GdooxSubscriptionInfo::where('userid', Auth::user()->id)->first();    
            $subsdate = Carbon::now();
            $subsdate->toDateTimeString();

            if(empty($subscription)){
                $subscription = new GdooxSubscriptionInfo();
                $subscription->first_login= $subsdate;
                $subscription->userid= Auth::user()->id;
            }
            $subscription->startdate = $subsdate; //Carbon::now();//time();
//            $subscription->subscribed_plan_type = $GdooxSubscriptionPlans->subscriptiontype;
//            $subscription->subscribed_plan_id = $GdooxSubscriptionPlans->_id;
            $subscription->subscribed_plan_type = $data['plan_name'];
            $subscription->subscribed_plan_id = $data['plan'];
            
            foreach($data as $k => $v){
                    if($k!=="_token"){
                        $subscription->$k = $v;
                    }
            }   
        
            if($subscription->save()){
                $zerocost=true;
                return view('payment.proceed_to_payment', compact('zerocost'));           
            }else{
                return Redirect::route('account-payment.create')->with('message','There is some problem, please try again.');
            }
        }


        $original_amount = $amount;
        $discount= InviteUser::where('email',$user->email)->orderBy('updated_at', 'desc')->first();
        if(!empty($discount)){
            if($userrole === "ecosystem-user"){
                $disc_percentage = $discount->business_eco_pecentage;
            }elseif($userrole === "company-network-user"){
                $disc_percentage = $discount->com_net_percentage;
            }elseif($userrole === "multi-user"){
                $disc_percentage = $discount->multi_ac_percentage;
            }elseif($userrole === "mono-user"){
                $disc_percentage = $discount->mono_ac_percentage;
            }elseif($userrole === "personal-user"){
                //$disc_percentage = $discount->business_eco_pecentage;
            }
        }
        if(!empty($disc_percentage)){
            $amount = $original_amount - round( ($original_amount / 100 * $disc_percentage  ), 2 );
        }
        
        $country=$data['country'];
        if(strtolower($country) === 'italy' || strtolower($country) === 'italia'){
            $vat = 22.5;
            $vat_amount = round( ($amount / 100 * $vat  ), 2 );
            
        }else{
            $vat = 0;
            $vat_amount = 0;
        }
        $paypalinfo = GdooxPaypalPayment::where('owner', 'Gdoox')->first();
        $paypal_id = $paypalinfo->paypal_id;
        
        $user = User::where('_id', Auth::user()->id)->first(); 
                
        
        //save user custom plan info
        $subscription = GdooxSubscriptionInfo::where('userid', Auth::user()->id)->first();    
//            $subsdate = Carbon::now();
//            $subsdate->toDateTimeString();

        if(empty($subscription)){
            $subscription = new GdooxSubscriptionInfo();
            $subscription->first_login= $subsdate;
            $subscription->userid= Auth::user()->id;
        }
//        $subscription->startdate = $subsdate; //Carbon::now();//time();
//            $subscription->subscribed_plan_type = $GdooxSubscriptionPlans->subscriptiontype;
//            $subscription->subscribed_plan_id = $GdooxSubscriptionPlans->_id;
        $subscription->subscribed_plan_type = $data['plan_name'];
        $subscription->subscribed_plan_id = $data['plan'];

        foreach($data as $k => $v){
                if($k!=="_token"){
                    $subscription->$k = $v;
                }
        }   

        if(!empty($disc_percentage)){
            $subscription->disc_percentage = $disc_percentage;
        }else{
            $subscription->disc_percentage = 0;
        }
        
        $subscription->final_amount = $amount;
        
        if($subscription->save()){


        }   
            
            
        //return view('payment.proceed_to_payment', compact('country','user','data','amount','vat','vat_amount','userrole'));
        return view('payment.proceed_to_payment', compact('original_amount','disc_percentage','country','user','plans','data','amount','vat','vat_amount','paypal_id','userrole','GdooxSubscriptionCharges','GdooxSubscriptionType'));
        
        }
        else {
            return redirect('auth/login')->with('message','Please Login');
        }    
        
        
        exit();
        
//
//
//
//        
//        $charges = CountrySubscriptionCharges::where('country', $data['country'])->first();
//        $item="";
//        if(!empty($charges)){
//            if($userrole ==='multi-site-user' || $userrole ==='company-network-user'){
//                // Company Network
//                $amount = $charges->multi_site_user_price; 
//                $currency = $charges->currency;
//                $item = "Company Network";
//            }
//            elseif($userrole === 'multi-user'){
//                $amount = $charges->multi_user_price; 
//                $currency = $charges->currency;
//                $item = "E-COM Plus";
//            }
//            elseif($userrole === 'mono-user'){
//                $amount = $charges->mono_user_price; 
//                $currency = $charges->currency;
//                $item = "E-COM";
//            }
//           elseif($userrole === 'personal-site-user'){
//               $amount = $charges->personal_user_price; 
//               $currency = $charges->currency;
//               $item = "ProficientUP";
//            }
//            else {
//                // Ecosystems User
//                $amount = $charges->ecosystem_user_price; 
//                $currency = $charges->currency;
//                $item = "Business Ecosystem";
//            }
//        }
//        else {
//            $plans = GdooxPlatformPlans::where('user', $userrole)->first();
//            $amount = $plans->price_per_year; 
//            $currency = $plans->currency;
//        }
//        
//        // Paypal Business Id.
////        $rules = array('paypal_business_id' => 'required');
////        $validator = Validator::make(Request::all(), $rules);
////        
////        if ($validator->fails()) {
////            return redirect()->back()->withErrors($validator)->withInput($request->all());                         
////        }
//
////        $paypal_id = $data['paypal_business_id'];
//
//        if($amount <=0){
//            $subscription = GdooxSubscriptionInfo::where('userid', Auth::user()->id)->first();    
//            $subsdate = Carbon::now();
//            $subsdate->toDateTimeString();
//
//            if(empty($subscription)){
//                $subscription = new GdooxSubscriptionInfo();
//                $subscription->first_login= $subsdate;
//                $subscription->userid= Auth::user()->id;
//            }
//            $subscription->startdate = $subsdate; //Carbon::now();//time();
//            if($subscription->save()){
//                $zerocost=true;
//                return view('payment.proceed_to_payment', compact('zerocost'));           
//            }else{
//                return Redirect::route('account-payment.create')->with('message','There is some problem, please try again.');
//            }
//        }
//
//        
//        $country=$data['country'];
//        if(strtolower($country) === 'italy' || strtolower($country) === 'italia'){
//            $vat = 22.5;
//            $vat_amount = round( ($amount / 100 * $vat  ), 2 );
//            
//        }else{
//            $vat = 0;
//            $vat_amount = 0;
//        }
//        $paypalinfo = GdooxPaypalPayment::where('owner', 'Gdoox')->first();
//        $paypal_id = $paypalinfo->paypal_id;
//        
//        $user = User::where('_id', Auth::user()->id)->first(); 
//                
//        return view('payment.proceed_to_payment', compact('country','user','plans','data','amount','vat','vat_amount','paypal_id','userrole','currency', 'item'));
    }
    
    public function fetchIPN(){
        //use PaypalIPN;
        $ipn = new PaypalIPN();
        // Use the sandbox endpoint during testing.
        //$ipn->useSandbox();
        $verified = $ipn->verifyIPN();
        if ($verified) {
            /*
             * Process IPN
             * A list of variables is available here:
             * https://developer.paypal.com/webapps/developer/docs/classic/ipn/integration-guide/IPNandPDTVariables/
             */

            $paypalinfo = GdooxPaypalPayment::where('owner', 'Gdoox')->first();
            $paypal_id = $paypalinfo->paypal_id;

            $txn_status="";
            // check that txn_id has not been previously processed
            $txn_id = GdooxSubscriptionPayments::where('txn_id', $_POST['txn_id'])->first();
            if(!empty($txn_id)){
                //Duplicate transaction
                $txn_status="Duplicate";
            }
            
            // check whether the payment_status is Completed
            if($_POST['payment_status'] === 'Completed'){
                $txn_status="Completed";
            }elseif($_POST['payment_status'] === 'Pending'){
                $txn_status="Pending";
                $status_reason= $_POST['pending_reason'];
            }else{
                $txn_status="Imcomplete";
                $status_reason= "Imcomplete";
            }            
            // check that receiver_email is your Primary PayPal email
            if($_POST['receiver_email'] === $paypal_id){
                $txn_email="OK";
            }
            // check that payment_amount/payment_currency are correct
                parse_str($_POST['custom'],$customArr);
                $roleID = $this->roleID($customArr['userid']);
                $userrole = $this->getRole($roleID);

                
                $GdooxSubscriptionCharges=GdooxSubscriptionPlans::find($customArr['plan_id']);
//                if(empty($GdooxSubscriptionCharges)){
//                    $GdooxSubscriptionCharges=GdooxSubscriptionPlans::orderBy('updated_at', 'desc')->where('subscriptiontype', $userrole)->where('default', 'yes')->first();
//                }
                $amount = $GdooxSubscriptionCharges->pricing; 
                $currency = $GdooxSubscriptionCharges->currency;                

                
                $subscription = GdooxSubscriptionInfo::where('userid', Auth::user()->id)->first();    
                $amount = $subscription->final_amount; 
                $currency = $subscription->currency;
                

		$user = User::where('_id', $customArr['userid'])->first();
//		$original_amount = $amount;
//                $discount= InviteUser::where('email',$user->email)->orderBy('updated_at', 'desc')->first();
//                if(!empty($discount)){
//                    if($userrole === "ecosystem-user"){
//                        $disc_percentage = $discount->business_eco_pecentage;
//                    }elseif($userrole === "company-network-user"){
//                        $disc_percentage = $discount->com_net_percentage;
//                    }elseif($userrole === "multi-user"){
//                        $disc_percentage = $discount->multi_ac_percentage;
//                    }elseif($userrole === "mono-user"){
//                        $disc_percentage = $discount->mono_ac_percentage;
//                    }elseif($userrole === "personal-user"){
//                        //$disc_percentage = $discount->business_eco_pecentage;
//                    }
//                }
//                if(!empty($disc_percentage)){
//                    $amount = $original_amount - round( ($original_amount / 100 * $disc_percentage  ), 2 );
//                }
//
//
//                
////                $charges = CountrySubscriptionCharges::where('country', $customArr['country'])->first();
////                $item="";
////                if(!empty($charges)){
////                    if($userrole ==='multi-site-user' || $userrole ==='company-network-user'){
////                        $amount = $charges->multi_site_user_price; 
////                        $currency = $charges->currency;
////                    }
////                    elseif($userrole === 'multi-user'){
////                        $amount = $charges->multi_user_price; 
////                        $currency = $charges->currency;
////                    }
////                    elseif($userrole === 'mono-user'){
////                        $amount = $charges->mono_user_price; 
////                        $currency = $charges->currency;
////                    }
////                   elseif($userrole === 'personal-site-user'){
////                       $amount = $charges->personal_user_price; 
////                       $currency = $charges->currency;
////                    }
////                    else {
////                        // Ecosystems User
////                        $amount = $charges->ecosystem_user_price; 
////                        $currency = $charges->currency;
////                    }
////                }
////                else {
////                    $plans = GdooxPlatformPlans::where('user', $userrole)->first();
////                    $amount = $plans->price_per_year; 
////                    $currency = $plans->currency;
////                }
//
                $country=$customArr['country'];
                if(strtolower($country) === 'italy' || strtolower($country) === 'italia'){
                    $vat = 22.5;
                    $vat_amount = round( ($amount / 100 * $vat  ), 2 );

                }else{
                    $vat = 0;
                    $vat_amount = 0;
                }
//
//                if($_POST['mc_currency'] === $currency && $_POST['mc_gross'] === ($amount + $vat_amount)){
//                    $txn_amt="OK";
//                    $status="valid";
//                }                

                if($_POST['mc_currency'] === $currency && $_POST['mc_gross'] === ($amount + $vat_amount)){
                    $txn_amt="OK";
                    $status="valid";
                }   
                
            // process the notification
            // assign posted variables to local variables            
            $subs_payment= new GdooxSubscriptionPayments();

            foreach($_POST as $key => $value) {
                if($key!=='custom'){
                    $subs_payment->$key = $value ;
                }
            }            
            foreach($customArr as $key => $value) {
                $subs_payment->$key = $value ;
            } 
            if($txn_email !== "OK"){
                $subs_payment->status = 'invalid';
                $subs_payment->status_reason = 'fake';
            }else{
                if($txn_status === "Completed"){
                    $subs_payment->status = 'valid';
                }elseif($txn_status === "Duplicate"){
                    $subs_payment->status = 'invalid';
                    $subs_payment->status_reason = "Duplicate";                   
                }else{
                    $subs_payment->status = 'invalid';
                    $subs_payment->status_reason = $status_reason;                   
                }
            }
            
            if($subs_payment->save()){
                $txn_data = GdooxSubscriptionPayments::where('payment_date', $_POST['payment_date'])
                        ->where('ipn_track_id', $_POST['ipn_track_id'])
                        ->where('txn_id', $_POST['txn_id'])
                        ->where('status', 'valid')->first();    
                if(!empty($txn_data)){
                    $subscription = GdooxSubscriptionInfo::where('userid', $txn_data->userid)->first();    
                    $subsdate = Carbon::now();
                    $subsdate->toDateTimeString();

                    if(empty($subscription)){
                        $subscription = new GdooxSubscriptionInfo();
                        $subscription->first_login= $subsdate;
                        $subscription->userid= $txn_data->userid;
                    }
                    //$subscription->startdate = $txn_data->payment_date;
                    $subscription->startdate = $subsdate; //Carbon::now();//time();
                    
                    $subscription->plan = $txn_data->transaction_subject;
                    $subscription->subscr_id = $txn_data->subscr_id;
                    $subscription->txn_id = $txn_data->txn_id;
                    $subscription->ipn_track_id = $txn_data->ipn_track_id;
                    $subscription->txn_doc_id = $txn_data->_id;

                    $subscription->subscribed_plan_type = $GdooxSubscriptionPlans->subscriptiontype;
                    $subscription->subscribed_plan_id = $GdooxSubscriptionPlans->_id;
                    
                    if($subscription->save()){
                        //All Good
                    }
                }
            }            
        }else{
            //IPN not verified
        }

        // Reply with an empty 200 response to indicate to paypal the IPN was received correctly.
        header("HTTP/1.1 200 OK");

    }    
    public function paymentSuccess(){
        
//            foreach($_POST as $key => $value) {
//              echo $key . " = " . $value . "<br>";
//            }        
//            exit();

                parse_str($_POST['custom'],$customArr);
            
                $txn_data = GdooxSubscriptionPayments::where('subscr_id', $_POST['subscr_id'])
                        ->where('payer_id', $_POST['payer_id'])
                        ->where('userid', $customArr['userid'])
                        ->where('status', 'valid')->first();    
                if(!empty($txn_data)){
                    return view('payment.payment_success');
                }
                
                $txn_data = GdooxSubscriptionPayments::where('subscr_id', $_POST['subscr_id'])
                        ->where('payer_id', $_POST['payer_id'])
                        ->where('userid', $customArr['userid'])
                        ->where('status', 'invalid')->first(); 
                if(!empty($txn_data)){
                    $txn_data->status_reason;
                    if($txn_data->status_reason === "fake" || $txn_data->status_reason === "Imcomplete" ){
                        return view('payment.payment_failure');
                    }elseif($txn_data->status_reason === "Pending" || $txn_data->status_reason === "Duplicate"){
                        $paystatus=$txn_data->status_reason;
                        return view('payment.payment_success', compact('paystatus'));
                    }else{
                        return view('payment.payment_failure');
                    }
                    
                }

                $txn_data = GdooxSubscriptionPayments::where('subscr_id', $_POST['subscr_id'])
                        ->where('payer_id', $_POST['payer_id'])
                        ->where('userid', $customArr['userid'])
                        ->where('status', 'invalid')->first();    
                if(!empty($txn_data)){
                    
                    return view('payment.payment_success');
                }
                
                exit();
                
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
        
        $roleID = $this->roleID($customArr['userid']);
        $userrole = $this->getRole($roleID);
        $user = User::where('_id', $customArr['userid'])->first(); 
        
        $custom = explode(',', $data['custom']);
        
        if($data['payment_status'] === 'Completed'){
            $payment_plan = new GdooxSubscriptionInfo();
            $payment_plan->first_name = $data['first_name'];
            $payment_plan->last_name = $data['last_name'];
            $payment_plan->userid = $customArr['userid'];
            $payment_plan->role = $userrole;
            $payment_plan->payment_plan = trim($custom[0]);
            $payment_plan->country = trim($custom[1]);
            $payment_plan->amount = $data['payment_gross']; 
            $payment_plan->currency = $data['mc_currency'];
            $payment_plan->email = $user->email;
            $payment_plan->payment_date = $data['payment_date'];
            $payment_plan->payment_status = $data['payment_status'];
            if($payment_plan->save()){
                return view('payment.payment_success');
            }
        }
        elseif($data['payment_status'] === 'Failed') {
            return view('payment.payment_failure');
        }
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request){
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id){
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id){
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id){

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id){
        //
    }
    
    
    public function errorMessage($e){
        $error = "An error occured. ".
            "Line Number: ".$e->getLine()." ".
            "File Name: ".$e->getFile()." ".
            "Error Description: ".$e->getMessage(); 
        return $error;
    }
}
