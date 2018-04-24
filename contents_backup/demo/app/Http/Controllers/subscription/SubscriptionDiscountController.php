<?php

namespace Gdoox\Http\Controllers\subscription;


use Gdoox\Http\Controllers\Controller;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Gdoox\Models\CrmFieldMaster;
use Gdoox\Models\CountryDiscountPercent;
use Gdoox\Models\DropdownOption;
use Gdoox\Models\CrmDropdownOptions;
use Gdoox\Models\CrmAccounts;
use Gdoox\Models\NavigationMenu;
use Route;

use Gdoox\User;
use Illuminate\Support\Facades\Auth;

class SubscriptionDiscountController extends Controller { 
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
                $discounts = CountryDiscountPercent::orderBy('discount','asc')->where('status','1')->paginate(25);
                return view('subscription.subscription_discounts.index', compact('discounts'));
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
                
                $assigned_countries = CountryDiscountPercent::all();
                foreach($assigned_countries as $countries){
                    $assigned[$countries->country] = $countries->country;
                }
                
                $countries =  DropdownOption::where('name','countries')->where('type','drop_down')->where('lang','en')->first();
                foreach($countries->options as $countryname){
                    $country[$countryname] = $countryname;
                }
                
                $country_discounts = DropdownOption::where('name','subscription_discounts')->where('lang','en')->first();
                foreach($country_discounts->options as $discounts){
                    $discount[trim(str_replace('%','', $discounts))] = $discounts;
                }
                
                $filtered_countries = array_diff_key($country, $assigned);
                
                return view('subscription.subscription_discounts.create', compact('filtered_countries','discount','status'));
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
                $data = CountryDiscountPercent::where('_id',$id)->first();
                $status = array('1'=>'Active', '0'=>'Inactive');

                $countries =  DropdownOption::where('name','countries')->where('type','drop_down')->where('lang','en')->first();
                foreach($countries->options as $countryname){
                    $country[$countryname] = $countryname;
                }
                
                $country_discounts = DropdownOption::where('name','subscription_discounts')->where('lang','en')->first();
                foreach($country_discounts->options as $discounts){
                    $discount[trim(str_replace('%','', $discounts))] = $discounts;
                }
                
                return view('subscription.subscription_discounts.edit', compact('data','discount','country','status'));
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
                
                $data = new CountryDiscountPercent();
                $data->country = $request['country'];
                $data->discount = $request['discount'];
                $data->status = '1';
                if($data->save()){
                    Session::flash('message', 'Discount Added Successfully');
                    return Redirect::route('gdoox-subscription.index');
                }
                else {
                    Session::flash('message', 'Discount could not be Added! Please Try Again');
                    return Redirect::route('gdoox-subscription.create')->with(Request::all());
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
        try{
            if(Auth::user()){
                $request = Request::all();

                $data = CountryDiscountPercent::where('_id','=',$id)->first();
                $data->discount = $request['discount'];
                $data->status = $request['status'];
               
                if($data->save()){
                    Session::flash('message', 'Subscription Percentage Updated Successfully');
                    return Redirect::route('gdoox-subscription.index');
                }
                else
                {
                    Session::flash('message', 'Subscription Percentage not Created! Please Try Again');
                    return Redirect::route('gdoox-subscription.edit',$id)->with(Request::all());
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
