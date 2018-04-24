<?php

namespace Gdoox\Http\Controllers\subscription;


use Gdoox\Http\Controllers\Controller;

//use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Gdoox\Models\DropdownOptions;
use Gdoox\Models\DropdownOption;
use Gdoox\Models\GdooxSubscriptionPlanNames;
use Gdoox\Models\GdooxSubscriptionPlans;
use Gdoox\Models\GdooxSubscriptionTypes;
use Route;
use Gdoox\User;
use Illuminate\Support\Facades\Auth;


use Gdoox\Models\CountryDiscountPercent;
use Gdoox\Models\GdooxPlatformPlans;

class GdooxSubscriptionPlanConfigurationCountryController extends Controller { 
    use  \Gdoox\Helpers\backend\dashboard\RolesUsers;
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
//        try {
            if(Auth::user()){
                
                $countries=GdooxSubscriptionPlans::distinct('country')->orderBy('country', 'desc')->get();

                $SubscriptionPlanNames_ =  GdooxSubscriptionPlanNames::orderBy('display_order', 'asc')->where('display_type','<>','user')->get();
                foreach($SubscriptionPlanNames_ as $SubscriptionPlanName){
                    $SubscriptionPlanNames[$SubscriptionPlanName->plan_id] = $SubscriptionPlanName->label;
                }                  
                
                $i=0;
                                
                foreach($countries as $country){
                    $Subscription_Types =  GdooxSubscriptionTypes::orderBy('order', 'asc')->get();
                    $ii=0;
                    foreach($Subscription_Types as $Subscription_Type){
                        //$SubscriptionTypes[$Subscription_Type->user_type][$Subscription_Type->user_type] = $Subscription_Type->label;
                        $SubscriptionTypes[$country[0]][$ii]['user_id']= $Subscription_Type->user_type;
                        $SubscriptionTypes[$country[0]][$ii]['user_type']= $Subscription_Type->label;
                        $GdooxSubscriptionPlans=GdooxSubscriptionPlans::where('subscriptiontype',$Subscription_Type->user_type)->where('country','=',$country[0])->orderBy('updated_at', 'desc')->first();
                        $SubscriptionTypes[$country[0]][$ii]['id']= $GdooxSubscriptionPlans['_id'];
                        foreach($SubscriptionPlanNames as $k => $v){
                            //$SubscriptionPlanNames[$SubscriptionPlanName->plan_id] = $SubscriptionPlanName->label;
                            $SubscriptionTypes[$country[0]][$ii][$k]= $GdooxSubscriptionPlans[$k];
                        } 

                         $ii=$ii+1;
                    }
                    $i=$i+1;
                }    
//                echo "<pre>";
//                print_r($SubscriptionTypes);
//                echo "</pre>";
//                exit();
                return view('subscription.plan_configuration.country.index', compact('SubscriptionPlanNames','SubscriptionTypes','countries'));
            }
            else {
               return redirect('auth/login')->with('message',"Please Login to Add Account!"); 
            }
//        }
//        catch(\Exception $e) {
//            $errors = $this->errorMessage($e);
//            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
//        }

    }
    
    public function index_(){
        try {
            if(Auth::user()){
                $SubscriptionPlanNames_ =  GdooxSubscriptionPlanNames::orderBy('display_order', 'asc')->get();
                foreach($SubscriptionPlanNames_ as $SubscriptionPlanName){
                    $SubscriptionPlanNames[$SubscriptionPlanName->plan_id] = $SubscriptionPlanName->label;
                }                  
                $Subscription_Types =  GdooxSubscriptionTypes::orderBy('order', 'asc')->get();
//                $type=[];
                $i=0;
                foreach($Subscription_Types as $Subscription_Type){
                    //$SubscriptionTypes[$Subscription_Type->user_type][$Subscription_Type->user_type] = $Subscription_Type->label;
                    $SubscriptionTypes[$i]['user_id']= $Subscription_Type->user_type;
                    $SubscriptionTypes[$i]['user_type']= $Subscription_Type->label;
                    $GdooxSubscriptionPlans=GdooxSubscriptionPlans::where('subscriptiontype',$Subscription_Type->user_type)->where('default','!=','yes')->orderBy('updated_at', 'desc')->first();
//                    var_dump($GdooxSubscriptionPlans->subscriptiontype);
//                    echo "<br/><br/>";echo "<br/><br/>";
//                    $SubscriptionTypes[$i]['PlanValues'] = $GdooxSubscriptionPlans;
                    
//                    $SubscriptionTypes[$i]['PlanValues'] = $GdooxSubscriptionPlans;
                    foreach($SubscriptionPlanNames as $k => $v){
                        //$SubscriptionPlanNames[$SubscriptionPlanName->plan_id] = $SubscriptionPlanName->label;
                        $SubscriptionTypes[$i][$k]= $GdooxSubscriptionPlans[$k];
                    } 
//                                        
//                    foreach($GdooxSubscriptionPlans as $GdooxSubscriptionPlan){
//                        //$SubscriptionPlanNames[$SubscriptionPlanName->plan_id] = $SubscriptionPlanName->label;
//                        var_dump($GdooxSubscriptionPlan);
//                    }                     
                    
                    
                     $i=$i+1;
                }
                
//$users = User::whereIn('age', [16, 18, 20])->get();    
//                var_dump($type);
//$GdooxSubscriptionPlans=GdooxSubscriptionPlans::distinct('subscriptiontype')->whereIn('subscriptiontype',$type)->orderBy('updated_at', 'desc')->get();
              
//                print_r($SubscriptionTypes);
//                exit();
                return view('subscription.plan_configuration.index', compact('SubscriptionPlanNames','SubscriptionTypes'));
//                return view('subscription.plan_configuration.create', compact('countries','currencies','status','SubscriptionPlanNames'))
//                        ->with('SubscriptionTypes',$SubscriptionTypes);
            }
            else {
               return redirect('auth/login')->with('message',"Please Login to Add Account!"); 
            }
        }
        catch(\Exception $e) {
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }

    }
    
    
    /**
     * Show the form for adding a new product.
     *
     * @return Response
     */    
    public function create(Request $request){
        try {
            if(Auth::user()){
                $inputs = $request->all();
//                var_dump($inputs);

                $currencies = array();
                $countries = array();
                
                $currency_name =  DropdownOptions::where('attr_id', 13)->where('lang', $this->language)->first(); 
                foreach($currency_name->options as $currencyname){
                    $currencies[substr($currencyname, -3)] = $currencyname;
                }                
                $countries_names =  DropdownOption::where('name','countries')->where('type','drop_down')->where('lang','en')->first();
                foreach($countries_names->options as $countryname){
                    $countries[$countryname] = $countryname;
                }                
//GdooxSubscriptionPlanNames;
//GdooxSubscriptionPlans;
//GdooxSubscriptionTypes;
                $SubscriptionPlanNames =  GdooxSubscriptionPlanNames::orderBy('display_order', 'asc')->where('display_type','<>','user')->get();
//                foreach($countries_names->options as $countryname){
//                    $countries[$countryname] = $countryname;
//                }                 
                $Subscription_Types =  GdooxSubscriptionTypes::orderBy('order', 'asc')->get();
                foreach($Subscription_Types as $Subscription_Type){
                    $SubscriptionTypes[$Subscription_Type->user_type] = $Subscription_Type->label;
                }                
                
                if(!empty($inputs['_id']) ){
                    $GdooxSubscriptionPlans=GdooxSubscriptionPlans::find($inputs['_id']);
                }elseif(!empty($inputs['id']) && !empty($inputs['country'])){
                    $GdooxSubscriptionPlans=GdooxSubscriptionPlans::orderBy('updated_at', 'desc')->where('subscriptiontype', $inputs['id'])->where('country', $inputs['country'])->first(); 
                }elseif(!empty($inputs['id'])){
                    $GdooxSubscriptionPlans=GdooxSubscriptionPlans::orderBy('updated_at', 'desc')->where('subscriptiontype', $inputs['id'])->first(); 
                }else{
                    $GdooxSubscriptionPlans=GdooxSubscriptionPlans::orderBy('updated_at', 'desc')->first();
                }
                return view('subscription.plan_configuration.country.create', compact('countries','currencies','GdooxSubscriptionPlans','SubscriptionPlanNames','SubscriptionTypes','input'));
//                return view('subscription.plan_configuration.create', compact('countries','currencies','status','SubscriptionPlanNames'))
//                        ->with('SubscriptionTypes',$SubscriptionTypes);
            }
            else {
               return redirect('auth/login')->with('message',"Please Login to Add Account!"); 
            }
        }
        catch(\Exception $e) {
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }

    }   

    public function store(Request $request){
        $inputs = $request->all();
            $GdooxSubscriptionPlans = new GdooxSubscriptionPlans;
            
            foreach($inputs['plan_fields'] as $k=>$v){
                    $GdooxSubscriptionPlans[$k]=$v;
            }
            if($GdooxSubscriptionPlans->save()){
                Session::flash('message', 'Successfully Created New "Plan!"');
                return Redirect::route('plan_configuration_country.index');
            }
            else {
                return redirect()->back()->with('message','Plan could not be created. Please try Again');
            }            
        exit();
    }    
 
    public function show($id){
//        echo $id;
        $SubscriptionPlanNames =  GdooxSubscriptionPlanNames::orderBy('display_order', 'asc')->get();
        $GdooxSubscriptionPlans=GdooxSubscriptionPlans::find($id); 
        $Subscription_Types =  GdooxSubscriptionTypes::orderBy('order', 'asc')->where('user_type',$GdooxSubscriptionPlans->subscriptiontype)->where('display_type','<>','user')->first();

        return view('subscription.plan_configuration.country.show', compact('GdooxSubscriptionPlans','SubscriptionPlanNames', 'Subscription_Types'));

    }
    
    public function errorMessage($e){
            $error = "An error occured. ".
                "Line Number: ".$e->getLine()." ".
                "File Name: ".$e->getFile()." ".
                "Error Description: ".$e->getMessage(); 
            return $error;
    }
}
