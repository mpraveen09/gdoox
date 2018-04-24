<?php

namespace Gdoox\Http\Controllers\crm;


use Gdoox\Http\Controllers\Controller;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Gdoox\Models\CrmFieldMaster;
use Gdoox\Models\CrmUsers;
use Gdoox\Models\DropdownOption;
use Gdoox\Models\CrmDropdownOptions;
use Gdoox\Models\CrmAccounts;
use Gdoox\Models\NavigationMenu;
use Route;

use Gdoox\User;
use Illuminate\Support\Facades\Auth;

use Form;
use Image;
use Input;
use UUID;

class CrmAccountsController extends Controller { 
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
                $userid = Auth::id();
                $data = Request::all();
                $limit = 25;
                $name_val = $type_val = $industry_val = '';
                list($route, $nav_menus) = $this->navigationTabs();
                
                $form_fields = CrmFieldMaster::where('title','=','crm_accounts')->where('lang','=','en')->first();
                $industries = CrmDropdownOptions::where('name','=','crm_industry')->first();

                foreach($industries->options as $industries){
                    $industry[$industries] = $industries;
                }

                $accounts_type = CrmDropdownOptions::where('name','=','crm_accounts_type')->first();
                foreach($accounts_type->options as $types){
                    $type[$types] = $types;
                }

                if(!empty($data)) {

                        $builder = CrmAccounts::query();

                        if(!empty($data['name'])) {
                             $name = $data['name'];
                             $builder->where('name','like', '%'.$name.'%');
                        }

                        if(!empty($data['type'])) {
                             $type = $data['type'];
                             $builder->where('type','=', $type);
                        }

                        if(!empty($data['industry'])) {
                             $industry = $data['industry'];
                             $builder->where('type','=', $industry);
                        }

                        $accounts = $builder->orderBy('_id')->paginate($limit);
                }
                else {
                    $accounts = CrmAccounts::where('flag','=','1')->where('user_id','=', $userid)->paginate($limit);
                }
                return view('crm.crm_accounts.index', compact('accounts','form_fields','industry','type','name_val','industry_val','type_val','route', 'nav_menus', 'sub_nav_menu'));
            }
            else {
                return redirect('auth/login')->with('message',"Please Login!"); 
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
//          Session::flash('message', "Oops! Something went Wrong. Please try Again");
//          return Redirect::back();
        }
    }
    
    
    /**
     * Show the form for adding a new product.
     *
     * @return Response
     */    
    public function create(){
        try{
            if(Auth::user()){
                list($route, $nav_menus) = $this->navigationTabs();
                 $form_data = CrmFieldMaster::where('title','=','crm_accounts')->where('lang','=','en')->first();
                 foreach($form_data->form_fields as $data){
                     $options = $this->getOptions($data['name']);
                     $createForm[] = $this->createForm($data['label'], $data['name'], $data['type'], $data['maxlength'], $data['required'],'', $options);
                 }
                 return view('crm.crm_accounts.create', compact('createForm','route', 'nav_menus', 'sub_nav_menu'));
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

    
    function createForm($lbl_name, $field_name='', $field_type='', $field_max_val='', $required='', $value='', $options='') {
        switch ($field_type) {
           case "text":
               $Fields = "<div class='item form-group'>"
                   . Form::label($lbl_name,'', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) 
                   ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                   . Form::$field_type($field_name, $value, [$required,'class' => 'form-control col-md-7 col-xs-12','placeholder' =>$lbl_name ])
                   . "</div>
                    </div>";
           return $Fields;
           break;

           case "select":
               $Fields = "<div class='item form-group'>"
                   . Form::label($lbl_name,'', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) 
                   ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                   . Form::select($field_name, $options, $value, ['class' => 'form-control col-md-7 col-xs-12', 'required', 'placeholder' => $lbl_name])
                   . "</div>
                </div>";
               return $Fields;
           break;

           case "date":
               $Fields = "<div class='item form-group'>"
                   . Form::label($lbl_name,'', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) 
                   ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                   . Form::$field_type($field_name, $value ,['class' => 'form-control col-md-7 col-xs-12','placeholder' =>$lbl_name ])
                   . "</div>
                    </div>";
               return $Fields;
           break;

           case "textarea":
               $Fields = "<div class='item form-group'>"
                   . Form::label($lbl_name,'', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) 
                   ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                   . Form::$field_type($field_name, $value ,['class' => 'form-control col-md-7 col-xs-12','placeholder' =>$lbl_name ])
                   . "</div>
                    </div>";
               return $Fields;
           break;

           case "lable":
               $Fields = "<div class='item form-group'>"
                   . Form::label($lbl_name,'', ['class' => 'control-label col-md-2 col-sm-3 col-xs-12']) 
                   ."</div><hr>";
               return $Fields;
           break;

           default:
               $Fields='';
               return $Fields;
               break;
        }
    }

  
  public function getOptions($field) {
      try {
            $countries =  DropdownOption::where('name','countries')->where('type','drop_down')->where('lang', $this->language)->first();
            foreach($countries->options as $countryname)
            {
                $country[$countryname] = $countryname;
            }

            $industries = CrmDropdownOptions::where('name','=','crm_industry')->first();
            foreach($industries->options as $industries)
            {
                $industry[$industries] = $industries;
            }

            $accounts_type = CrmDropdownOptions::where('name','=','crm_accounts_type')->first();
            foreach($accounts_type->options as $types)
            {
                $type[$types] = $types;
            }

            if($field==='shipping_country') {
                $options = $country;
            }
            elseif ($field==='billing_country') {
                $options = $country;
            }
            elseif($field==='industry') {
                $options = $industry;
            }
            elseif($field==='type'){
                $options = $type;
            }
            else {
                $options = '';
            }
        return $options;
      }
      catch (\Exception $e) {
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
                list($route, $nav_menus) = $this->navigationTabs();
                $userdata = CrmAccounts::where('_id','=',$id)->first();
                $form_data = CrmFieldMaster::where('title','=','crm_accounts')->where('lang','=','en')->first();

                foreach($form_data->form_fields as $data){
                    $options = $this->getOptions($data['name']);

                    if(!empty($userdata->$data['name'])){
                          $value = $userdata->$data['name'];
                    }else{
                       $value = "";
                    }
                       $createForm[] = $this->createForm($data['label'], $data['name'], $data['type'], $data['maxlength'], $data['required'],$value, $options); 
                }
                return view('crm.crm_accounts.edit', compact('createForm','id','route', 'nav_menus', 'sub_nav_menu'));
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

                    $data = new CrmAccounts();

                    $data->user_id = Auth::id();

                    $data->name = $request['name'];
                    $data->phone = $request['phone'];
                    $data->website = $request['website'];
                    $data->fax = $request['fax'];

                    $data->billing_street = $request['billing_street'];
                    $data->billing_city = $request['billing_city'];
                    $data->billing_state = $request['billing_state'];
                    $data->billing_postalcode = $request['billing_postalcode'];
                    $data->billing_country = $request['billing_country'];

                    $data->shipping_street = $request['shipping_street'];
                    $data->shipping_city = $request['shipping_city'];
                    $data->shipping_state = $request['shipping_state'];
                    $data->shipping_postalcode = $request['shipping_postalcode'];
                    $data->shipping_country = $request['shipping_country'];

                    $data->type = $request['type'];
                    $data->industry = $request['industry'];
                    $data->annual_revenue = $request['annual_revenue'];
                    $data->employees = $request['employees'];

                    $data->flag = '1';

                    if($data->save())
                    {
                        Session::flash('message', 'Account Added Successfully');
                        return Redirect::route('crm_accounts.index');
                    }
                    else
                    {
                        Session::flash('message', 'Account could not be Added! Please Try Again');
                        return Redirect::route('crm_accounts.create')->with(Request::all());
                    }
            }
            else
            {
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
    public function show($id){
        try {
            if(Auth::user()){
                list($route, $nav_menus) = $this->navigationTabs();
                $form_fields = CrmFieldMaster::where('title','=','crm_accounts')->first();
                $userdata = CrmAccounts::where('_id','=',$id)->first();

                 return view('crm.crm_accounts.show', compact('form_fields','userdata','route', 'nav_menus', 'sub_nav_menu'));
            }
            else {
               return redirect('auth/login')->with('message',"Please Login to Create Account!"); 
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
            // return Redirect::route('crm_accounts.index')->with('message','Oops! Something went Wrong. Please Try Again'); 
        }
    }

/*
 * Update product
 */
  public function update($id) {
        try{
            if(Auth::user()){
                $request = Request::all();

                $data = CrmAccounts::where('_id','=',$id)->first();

                $data->name = $request['name'];
                $data->phone = $request['phone'];
                $data->website = $request['website'];
                $data->fax = $request['fax'];

                $data->billing_street = $request['billing_street'];
                $data->billing_city = $request['billing_city'];
                $data->billing_state = $request['billing_state'];
                $data->billing_postalcode = $request['billing_postalcode'];
                $data->billing_country = $request['billing_country'];

                $data->shipping_street = $request['shipping_street'];
                $data->shipping_city = $request['shipping_city'];
                $data->shipping_state = $request['shipping_state'];
                $data->shipping_postalcode = $request['shipping_postalcode'];
                $data->shipping_country = $request['shipping_country'];

                $data->type = $request['type'];
                $data->industry = $request['industry'];
                $data->annual_revenue = $request['annual_revenue'];
                $data->employees = $request['employees'];


                if($data->save())
                {
                    Session::flash('message', 'Account Updated Successfully');
                    return Redirect::route('crm_accounts.index');
                }
                else
                {
                    Session::flash('message', 'Account could not be Created! Please Try Again');
                    return Redirect::route('crm_accounts.edit',$id)->with(Request::all());
                }
            }
            else
            {
                return redirect('auth/login')->with('message',"Please Login to Create Account!"); 
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
           //  return Redirect::route('crm_accounts.index')->with('message','Oops! Something went Wrong. Please Try Again'); 
        }
    }
    
    public function navigationTabs(){
        
        $role = $this->getRoleName(Auth::user()->id);
        $nav_menus = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'CRM')->where('lang','en')->get();
        $route = Route::getCurrentRoute()->getName();
        
        return array($route, $nav_menus);
    }
    
    public function errorMessage($e){
            $error = "An error occured. ".
                "Line Number: ".$e->getLine()." ".
                "File Name: ".$e->getFile()." ".
                "Error Description: ".$e->getMessage(); 
            return $error;
    }
}
