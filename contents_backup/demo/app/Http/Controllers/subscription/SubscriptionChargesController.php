<?php

namespace Gdoox\Http\Controllers\subscription;


use Gdoox\Http\Controllers\Controller;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Gdoox\Models\CountryDiscountPercent;
use Gdoox\Models\DropdownOptions;
use Gdoox\Models\GdooxPlatformPlans;
use Route;
use Gdoox\User;
use Illuminate\Support\Facades\Auth;

class SubscriptionChargesController extends Controller { 
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
                $charges = GdooxPlatformPlans::all();
                return view('subscription.subscription_charges.index', compact('charges'));
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
                $status = array('1'=>'Active', '0'=>'Inactive');
                $currency = array();
                
                $currency_name =  DropdownOptions::where('attr_id',13)->where('lang', $this->language)->first(); 
                foreach($currency_name->options as $currencyname){
                    $currency[substr($currencyname, -3)] = $currencyname;
                }                
                $editcharges = GdooxPlatformPlans::where('_id', $id)->first();
                return view('subscription.subscription_charges.edit', compact('editcharges','currency','status'));
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
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    

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

                $data = GdooxPlatformPlans::where('_id','=',$id)->first();
                $data->price_per_year = $request['price_per_year'];
                $data->currency = $request['currency'];
                $data->status = $request['status'];
               
                if($data->save()){
                    Session::flash('message', 'Subscription Percentage Updated Successfully');
                    return Redirect::route('subscription-charges.index');
                }
                else {
                    Session::flash('message', 'Account could not be Created! Please Try Again');
                    return Redirect::route('subscription-charges.edit',$id)->with(Request::all());
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
