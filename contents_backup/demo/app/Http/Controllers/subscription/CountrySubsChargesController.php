<?php

namespace Gdoox\Http\Controllers\subscription;


use Gdoox\Http\Controllers\Controller;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Gdoox\Models\CrmFieldMaster;
use Gdoox\Models\CountrySubscriptionCharges;
use Gdoox\Models\DropdownOption;
use Gdoox\Models\CrmDropdownOptions;
use Gdoox\Models\CrmAccounts;
use Gdoox\Models\NavigationMenu;
use Gdoox\Models\DropdownOptions;
use Route;

use Gdoox\User;
use Illuminate\Support\Facades\Auth;

class CountrySubsChargesController extends Controller {
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
        try {
            if(Auth::user()){
                $charges = CountrySubscriptionCharges::orderBy('country')->where('status','1')->paginate(25);
                return view('subscription.country_subscription.index', compact('charges'));
            }
            else {
                return redirect('auth/login')->with('message',"Please Login!"); 
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }
    
    
    /**
     * Show the form for adding a new product.
     *
     * @return Response
     */    
    public function create(){
        try {
            if(Auth::user()){
                $status = array('1'=>'Active', '0'=>'Inactive');
                
                $assigned = array();
                $assigned_countries = CountrySubscriptionCharges::all();
                foreach($assigned_countries as $countries){
                    $assigned[$countries->country] = $countries->country;
                }
                
                $currency = array();
                $currency_name =  DropdownOptions::where('attr_id',13)->where('lang', $this->language)->first(); 
                foreach($currency_name->options as $currencyname){
                    $currency[substr($currencyname, -3)] = $currencyname;
                }
                
                $countries =  DropdownOption::where('name','countries')->where('type','drop_down')->where('lang','en')->first();
                foreach($countries->options as $countryname){
                    $country[$countryname] = $countryname;
                }
                
                $filtered_countries = array_diff_key($country, $assigned);
                
                return view('subscription.country_subscription.create', compact('filtered_countries','discount','status','currency'));
            }
            else {
               return redirect('auth/login')->with('message',"Please Login to Add Account!"); 
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
            // return Redirect::route('crm_accounts.index')->with('message','Oops! Something went Wrong. Please Try Again'); 
        }
    }   

 
  /*
   * Edit product
   */
    public function edit($id){
        try {
            if(Auth::user()){
                $data = CountrySubscriptionCharges::where('_id',$id)->first();
                $status = array('1'=>'Active', '0'=>'Inactive');
               
                $currency = array();
                $currency_name =  DropdownOptions::where('attr_id',13)->where('lang', $this->language)->first(); 
                foreach($currency_name->options as $currencyname){
                    $currency[substr($currencyname, -3)] = $currencyname;
                }
                
                $countries =  DropdownOption::where('name','countries')->where('type','drop_down')->where('lang','en')->first();
                foreach($countries->options as $countryname){
                    $country[$countryname] = $countryname;
                }
                
                return view('subscription.country_subscription.edit', compact('data','currency','country','status'));
            }
            else {
               return redirect('auth/login')->with('message',"Please Login to Add Account!"); 
            }
        }
        catch(\Exception $e) {
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
           // return Redirect::route('crm_accounts.index')->with('message','Oops! Something went Wrong. Please Try Again'); 
        }
    }
    
  

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(){
        try {
            if(Auth::user()){
                $request = Request::all();         
                $data = new CountrySubscriptionCharges();
                
                $data->country = $request['country'];
                $data->currency = $request['currency'];
                $data->multi_user_price = $request['multi_user_price'];
                $data->mono_user_price = $request['mono_user_price'];
                $data->personal_user_price = $request['personal_user_price'];
                $data->ecosystem_user_price = $request['ecosystem_user_price'];
                $data->multi_site_user_price = $request['multi_site_user_price'];
                $data->status = '1';
                
                if($data->save()){
                    Session::flash('message', 'Payments Added Successfully');
                    return Redirect::route('country-subscription.index');
                }
                else {
                    Session::flash('message', 'Payments could not be Added! Please Try Again');
                    return Redirect::route('country-subscription.create')->with(Request::all());
                }
            }
            else {
                return redirect('auth/login')->with('message',"Please Login to Add Account!"); 
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
            // return Redirect::route('crm_accounts.create')->with('message','Oops! Something went Wrong. Please Try Again'); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */

/*
 * Update product
 */
  public function update($id) {
        try {
            if(Auth::user()){
                $request = Request::all();
                $data = CountrySubscriptionCharges::where('_id','=',$id)->first();
                $data->currency = $request['currency'];
                $data->multi_user_price = $request['multi_user_price'];
                $data->mono_user_price = $request['mono_user_price'];
                $data->personal_user_price = $request['personal_user_price'];
                $data->ecosystem_user_price = $request['ecosystem_user_price'];
                $data->multi_site_user_price = $request['multi_site_user_price'];
                $data->status = '1';
               
                if($data->save()){
                    Session::flash('message', 'Payment Updated Successfully');
                    return Redirect::route('country-subscription.index');
                }
                else {
                    Session::flash('message', 'Payment could not be Updated! Please Try Again');
                    return Redirect::route('country-subscription.edit',$id)->with(Request::all());
                }
            }
            else {
                return redirect('auth/login')->with('message',"Please Login to Create Account!"); 
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
           //  return Redirect::route('crm_accounts.index')->with('message','Oops! Something went Wrong. Please Try Again'); 
        }
    }
        
    public function errorMessage($e){
            $error = "An error occured. ".
                "Line Number: ".$e->getLine()." ".
                "File Name: ".$e->getFile()." ".
                "Error Description: ".$e->getMessage(); 
            return $error;
    }
}
