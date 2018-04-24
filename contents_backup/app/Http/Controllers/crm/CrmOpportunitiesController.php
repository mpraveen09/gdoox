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
use Gdoox\Models\DropdownOptions;
use Gdoox\Models\CrmDropdownOptions;
use Gdoox\Models\CrmOpportunities;
use Gdoox\Models\ShoppingCart;
use Gdoox\Models\EcomShops;
use Gdoox\Models\DistributionNetwork;
use Gdoox\Models\BusinessPartner;
use Gdoox\Models\NavigationMenu;
use Gdoox\Models\Products;
use Route;

use Gdoox\User;
use Illuminate\Support\Facades\Auth;

use Form;
use Image;
use Input;
use UUID;

class CrmOpportunitiesController extends Controller {
    use  \Gdoox\Helpers\backend\dashboard\RolesUsers;
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    
    private $language;
    public function __construct() {
		if (session()->has('app_language')) {
			//
		}else{
			session(['app_language' => 'en']);
		}  		
        $this->language = session('app_language');
    }
    
    public function index() {
        try {
            if(Auth::user()) {
                 $userid = Auth::id();
                 $data = Request::all();
                 $limit = 25;
                 $opportunities = $ab_cart_opportunities = $sales_opportunities = $closing_date = $externalpartners = $type= "";
                 list($route, $nav_menus) = $this->navigationTabs();
                 
                 $form_fields= CrmFieldMaster::where('title','=','crm_opportunities')->where('lang','=','en')->first();
                 $opportunitytype = array(
                        'Abandoned Cart'=>'Abandoned Cart',
                        'Sponsors'=>'Sponsors',
                        'Partners'=>'Partners',
                        'Crm Opportunities'=>'Crm Opportunities',
                        'Sales Representatives'=>'Sales Representatives',
                        'Invitation-External Partners'=>'Invitation (External Partners)'
                    );
 
                 if(!empty($data)){
                    switch ($data['opportunity_type']) {
                    case "Abandoned Cart":
                            $users = User::where('active','=',1)->get();
                            foreach($users as $value) {
                                $user_name[$value->_id] = $value->username;
                            }
                            $stores = EcomShops::where('user_id','=', $userid)->get();
                            foreach ($stores as $value) {
                                $shopids[] = $value->slug;
                                $store[$value->slug] = $value->ecomm_company_name;
                            }
                            $ab_cart_opportunities = ShoppingCart::where('status','=','0')->whereIn('shopid', $shopids)->paginate($limit);
                        break;
                    case "Sponsors":
                        $sponsors = '';
                        break;
                    case "Partners":
                        $partners = '';
                        break;
                    case "Sales Representatives":
                        $sales_opportunities = DistributionNetwork::where('type_id','=','individual_sales_representative')->paginate($limit);
                        break;
                    case "Crm Opportunities":
                        $opportunities = CrmOpportunities::where('flag','=','1')->where('user_id','=', $userid)->paginate($limit);
                        break;
                    case "Invitation-External Partners":
                        $externalpartners = BusinessPartner::where('type','=','External')->where('status','=','Accept/Deny')->paginate($limit);
                        break;
                    default:
                        $opportunities = CrmOpportunities::where('flag','=','1')->where('user_id','=', $userid)->paginate($limit);
                    }
                }
                return view('crm.crm_opportunities.index', compact('user_name','opportunitytype','opportunities','form_fields','ab_cart_opportunities','store','shopids','sales_opportunities','sponsors','partners','externalpartners','route', 'nav_menus', 'sub_nav_menu'));
            }
            else {
                 return redirect('auth/login')->with('message',"Please Login!"); 
            }
        }
        catch(Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
            // Session::flash('message', "Oops! Something went Wrong. Please try Again");
            // return Redirect::back();
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
                 $form_data= CrmFieldMaster::where('title','=','crm_opportunities')->where('lang','=','en')->first();
                 
                 foreach($form_data->form_fields as $data){
                     $options = $this->getOptions($data['name']);
                     $createForm[] = $this->createForm($data['label'], $data['name'], $data['type'], $data['maxlength'], $data['required'],'', $options);
                 }
                 return view('crm.crm_opportunities.create', compact('createForm','business_type','route','nav_menus','sub_nav_menu'));
            }
            else {
               return redirect('auth/login')->with('message',"Please Login to Add Account!"); 
            }
        }
        catch(Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
            // Session::flash('message', "Oops! Something went Wrong. Please try Again");
            // return Redirect::route('crm_opportunities.create'); 
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
 
        if($field=== 'currency') {
            $currency_name =  DropdownOptions::where('attr_id',13)->where('lang', $this->language)->first(); 
            foreach($currency_name->options as $currencyname){
                $currency[$currencyname] = $currencyname;
            }
            $options = $currency;
        }
        
        elseif ($field=== 'type') {
            $businesstype = CrmDropdownOptions::where('name','=','crm_business_type')->first();
            foreach($businesstype->options as $types)
            {
                $business_type[$types] = $types;
            }
            $options = $business_type;
        }
        
        elseif($field=== 'sales_stage') {
            $salesstage = CrmDropdownOptions::where('name','=','crm_sales_stage')->first();
            foreach($salesstage->options as $salesstage)
            {
                $sales_stage[$salesstage] = $salesstage;
            }
            $options = $sales_stage;
        }
        
        elseif($field=== 'lead_source'){
            $leadsource = CrmDropdownOptions::where('name','=','crm_lead_source')->first();
            foreach($leadsource->options as $source)
            {
                $lead_source[$source] = $source;
            }
            $options = $lead_source;
        }
        
        else {
            $options = '';
        }
        
        return $options;
  }
    
  /*
   * Edit product
   */
    public function edit($id){
        try{
            if(Auth::user()){
                $userdata = CrmOpportunities::where('_id','=',$id)->first();
                $form_data = CrmFieldMaster::where('title','=','crm_opportunities')->where('lang','=','en')->first();
                list($route, $nav_menus) = $this->navigationTabs();
                
                foreach($form_data->form_fields as $data){
                 $options = $this->getOptions($data['name']);

                    if(!empty($userdata->$data['name'])){
                       $value = $userdata->$data['name'];
                    }else{
                       $value = "";
                    }
                    $createForm[] = $this->createForm($data['label'], $data['name'], $data['type'], $data['maxlength'], $data['required'],$value, $options);
                }
                return view('crm.crm_opportunities.edit', compact('createForm','id', 'route', 'nav_menus', 'sub_nav_menu'));
            }
            else {
               return redirect('auth/login')->with('message',"Please Login to Add Opportunity!");
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
           // Session::flash('message', "Oops! Something went Wrong. Please try Again");
           // return Redirect::route('crm_groups.index');
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
            $data = new CrmOpportunities();

            $data->user_id = Auth::user()->id;

            $data->opportunity_name = $request['opportunity_name'];
            $data->account_name = $request['account_name'];
            $data->currency = $request['currency'];
            $data->excected_closing_date = $request['excected_closing_date'];

            $data->opportunity_amt = $request['opportunity_amt'];
            $data->type = $request['type'];
            $data->sales_stage = $request['sales_stage'];
            $data->lead_source = $request['lead_source'];

            $data->probability = $request['probability'];
            $data->campaign = $request['campaign'];
            $data->next_step = $request['next_step'];
            $data->discussion = $request['discussion'];

            $data->flag = '1';

            if($data->save()){
                Session::flash('message', 'Opportunity Added Successfully');
                return Redirect::route('crm_opportunities.index');
            }
            else{
                Session::flash('message', 'Opportunity could not be Added! Please Try Again');
                return Redirect::route('crm_opportunities.create')->with(Request::all());
            }
        }
        else{
                return redirect('auth/login')->with('message',"Please Login to Add Account!"); 
        }
      }
      catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
          // return Redirect::route('crm_groups.create')->with('message','Oops! Something went Wrong. Please Try Again'); 
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id){
        try{
            if(Auth::user()){
                list($route, $nav_menus) = $this->navigationTabs();
                 $form_fields = CrmFieldMaster::where('title','=','crm_opportunities')->first();
                 $userdata = CrmOpportunities::where('_id','=',$id)->first();
                 return view('crm.crm_opportunities.show', compact('form_fields','userdata'));
            }
            else{
               return redirect('auth/login')->with('message',"Please Login to Create Account!"); 
            }
        
            return view('crm.crm_opportunities.show', compact('task_data','route','nav_menus','sub_nav_menu'));
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
          // return Redirect::route('crm_opportunities.index')->with('message','Oops! Something went Wrong. Please Try Again'); 
        }
    }

/*
 * Update product
 */
    public function update($id){
    try{
        if(Auth::user()){
            $request = Request::all();
            $data = CrmOpportunities::where('_id','=',$id)->first();
            $data->opportunity_name = $request['opportunity_name'];
            $data->account_name = $request['account_name'];
            $data->currency = $request['currency'];
            $data->excected_closing_date = $request['excected_closing_date'];

            $data->opportunity_amt = $request['opportunity_amt'];
            $data->type = $request['type'];
            $data->sales_stage = $request['sales_stage'];
            $data->lead_source = $request['lead_source'];

            $data->probability = $request['probability'];
            $data->campaign = $request['campaign'];
            $data->next_step = $request['next_step'];
            $data->discussion = $request['discussion'];


            if($data->save()){
                Session::flash('message', 'Account Updated Successfully');
                return Redirect::route('crm_opportunities.index');
            }
            else {
                Session::flash('message', 'Account could not be Created! Please Try Again');
                return Redirect::route('crm_opportunities.edit',$id)->with(Request::all());
            }
    }
        else {
            return redirect('auth/login')->with('message',"Please Login to Create Account!"); 
        }
    }
    catch(\Exception $e){
        $errors = $this->errorMessage($e);
        return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
    }
  }
  
  
    public function createProductOpportunity($id){
        if(Auth::user()){
              $currency = array();
              $business_type = array();
              $sales_stage = array();
              $lead_source = array();
              
              $product = ShoppingCart::where('product_id',$id)->first();
              $opportunity = CrmOpportunities::where('product_id',$id)->where('user_id',Auth::user()->id)->first();

             list($route, $nav_menus) = $this->navigationTabs();
              $form_fields = CrmFieldMaster::where('title','=','ab_cart_opportunities')->where('lang','=','en')->first(); 

              $currency_name =  DropdownOptions::where('name','Currency List')->where('lang', 'en')->first(); 
              foreach($currency_name->options as $currencyname){
                  $currency[$currencyname] = $currencyname;
              }

              $businesstype = CrmDropdownOptions::where('name','=','crm_business_type')->first();
              foreach($businesstype->options as $types){
                  $business_type[$types] = $types;
              }

              $salesstage = CrmDropdownOptions::where('name','=','crm_sales_stage')->first();
              foreach($salesstage->options as $salesstage){
                  $sales_stage[$salesstage] = $salesstage;
              }

              $leadsource = CrmDropdownOptions::where('name','=','crm_lead_source')->first();
              foreach($leadsource->options as $source){
                  $lead_source[$source] = $source;
              }
              
              if(!empty($opportunity)){
                  return view('crm.crm_opportunities.crm_edit_managed_product', compact('id','lead_source','sales_stage','business_type','form_fields','business_type','route','nav_menus','sub_nav_menu','currency','opportunity'));
              }
              else {
                  return view('crm.crm_opportunities.crm_manage_product', compact('id','lead_source','sales_stage','business_type','form_fields','business_type','route','nav_menus','sub_nav_menu','currency','product'));
              }
        }
        else {
            return redirect('auth/login')->with('message',"Please Login!"); 
        }
    }
    
    public function storeProductOpportunity($id){
        if(Auth::user()){
            $request = Request::all();
            $product = ShoppingCart::where('product_id',$id)->first();
            
            $data = new CrmOpportunities();
            
            $data->user_id = Auth::user()->id;
            $data->product_id = $product->product_id;
            $data->product_name = $request['product_name'];
            $data->email =  $request['email'];
            $data->opportunity_name =  $request['opportunity_name'];
            $data->opportunity_amt =  $request['opportunity_amt'];
            $data->excected_closing_date =  $request['excected_closing_date'];
            $data->type =  $request['type'];
            $data->sales_stage =  $request['sales_stage'];
            $data->lead_source =  $request['lead_source'];
            $data->probability =  $request['probability'];
            $data->next_step = $request['next_step'];
            $data->discussion =  $request['discussion'];
            $data->flag = '1';
            
            if($data->save()){
                return Redirect::route('view_abandoned_cart',[$product->shopid, $product->_id])->with('message','The Opportunity Created Successfully');
            }
            else {
                return redirect()->back()->with('message','Something went wrong! Please try again to save the Opportunity');
            }
        }
        else {
            return redirect('auth/login')->with('message',"Please Login!"); 
        }
    }
    
    public function updateProductOpportunity($id){
        if(Auth::user()){
            $request = Request::all();
            $product = ShoppingCart::where('product_id',$id)->first();
            $data = CrmOpportunities::where('product_id',$id)->where('user_id', Auth::user()->id)->first();
            
            $data->opportunity_name =  $request['opportunity_name'];
            $data->excected_closing_date =  $request['excected_closing_date'];
            $data->type =  $request['type'];
            $data->sales_stage =  $request['sales_stage'];
            $data->lead_source =  $request['lead_source'];
            $data->probability =  $request['probability'];
            $data->next_step = $request['next_step'];
            $data->discussion =  $request['discussion'];
            
            if($data->save()){
                return Redirect::route('view_abandoned_cart',[$product->shopid, $product->_id])->with('message','The Opportunity Updated Successfully');
            }
            else {
                return redirect()->back()->with('message','Something went wrong! Please try again to save the Opportunity');
            }
        }
        else {
            return redirect('auth/login')->with('message',"Please Login!"); 
        }
    }
    
    public function indexProductOpportunity(){
        if(Auth::user()){
            $userid = Auth::user()->id;
            $limit = 20;
            list($route, $nav_menus) = $this->navigationTabs();
            $form_fields = CrmFieldMaster::where('title','=','crm_opportunities')->where('lang','=','en')->first();
            
            $opportunities = CrmOpportunities::where('flag','=','1')->where('user_id','=', $userid)->paginate($limit);

            return view('crm.crm_opportunities.ab_cart_index', compact('opportunities', 'form_fields', 'store', 'shopids', 'route', 'nav_menus', 'sub_nav_menu'));
        }
        else {
             return redirect('auth/login')->with('message',"Please Login!"); 
        }
    }
    
    public function createCartProductOpportunity(){
        if(Auth::user()){
            echo "<h3>Work In Progress</h3>";
            exit;
        }
        else {
            return redirect('auth/login')->with('message', 'Please Login');
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