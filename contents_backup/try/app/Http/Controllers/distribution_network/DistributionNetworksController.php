<?php

namespace Gdoox\Http\Controllers\distribution_network;
use DB;
use Auth;
//use Illuminate\Http\Request;
use Gdoox\Http\Requests;
use Gdoox\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

use Gdoox\Models\FieldMaster;
use Gdoox\Models\TermsAndCondition;
use Gdoox\Models\DropdownOption;
use Gdoox\Models\DistributionNetwork;

class DistributionNetworksController extends \Gdoox\Http\Controllers\backend\FieldMasterController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    
    private $language;
    public function __construct(){
        $this->language = session('app_language');
    }
    
    public function index() {
        try{
            if(Auth::user()){
                $network_types= DropdownOption::where('name','=','Distribution Network')->first();
                $types = DistributionNetwork::distinct()->get(array('type'));
                return view('distribution_network.index',  compact('types','network_types'));
    //          $networks= DistributionNetwork::orderBy('_id','asc')->paginate(25);
    //          return view('distribution_network.index',  compact('networks'));
            }
            else {
                return redirect('auth/login')->with('message',"Please Login to View Distributed Network!"); 
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);;
        } 
    }
    
    public function create() {
        try{
            $fm_data= FieldMaster::where('title','=','distribution_network')->Where('lang', $this->language)->first();
            $tc =  TermsAndCondition::where('title', 'personal_info')->where('lang', 'en')->first();
            $countries=  DropdownOption::where('name','countries')->where('type','drop_down')->where('lang', $this->language)->first();

            foreach($countries->options as $countryname){
              $country[$countryname]=$countryname;
            }

            $network_type= DropdownOption::where('name','=','Distribution Network')->where('lang', $this->language)->first();

            $types = array();
            foreach($network_type->options as $key=>$options){
                if($key==0) {
                    $types[]='<li class="active"><a href="#sales" aria-controls="sales" role="tab" data-toggle="tab">'."$options".'</a></li>';
                }
                elseif($key==1) {
                     $types[]='<li><a href="#network" aria-controls="network" role="tab" data-toggle="tab">'."$options".'</a></li>';
                }
                elseif($key==2) {
                     $types[]='<li><a href="#association" aria-controls="association" role="tab" data-toggle="tab">'."$options".'</a></li>';
                }
                elseif($key==3) {
                    $types[]='<li><a href="#organization" aria-controls="organization" role="tab" data-toggle="tab">'."$options".'</a></li>';
                }
            }

            $terms= TermsAndCondition::where('title','=','personal_info')->first();
            return view('distribution_network.create',  compact('fm_data','terms','network_type','types','country','tc'));
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);;
        }
    }
    
    public function store() {
        try{
            $data= Request::all();
            $rules = array('first_name' => 'required|min:2|max:50',
                'last_name'=>'required|max:50',   
                'country_of_work'=> 'required',
                'region' => 'required|max:100',
                'business_email' => 'required|email',
                'business_phone' => 'required',
                'skype_account' => 'required',
//                't_n_c_1'=> 'required',
//                't_n_c_2'=> 'required',
//                't_n_c_3'=> 'required'
                );

            $validator = Validator::make(Request::all(), $rules);

            if ($validator->fails()) {  
                return Redirect('distribution_network/create')->withErrors($validator)->withInput(Request::all());   
            }
            else {
                    $network = new DistributionNetwork;
                    if(array_key_exists('company_name',$data)){
                         $network->company = $data['company_name'];
                    }

                    if(array_key_exists('gender', $data)){
                        $network->gender = $data['gender'];
                    }

                    if(array_key_exists('country_of_living', $data)){
                        $network->country_of_living = $data['country_of_living'];
                    }

                    if(array_key_exists('age', $data)){
                        $network->age = $data['age'];
                    }

                    if(array_key_exists('vat', $data)){
                         $network->vat = $data['vat'];
                    }

                    $network->type_id = $data['type_id'];
                    $network->type = $data['type'];
                    $network->first_name = $data['first_name'];
                    $network->last_name = $data['last_name'];
                    $network->country_of_work = $data['country_of_work'];
                    $network->region = $data['region'];
                    $network->business_email = $data['business_email'];
                    $network->business_phone = $data['business_phone'];
                    $network->business_mob = $data['business_mob'];
                    $network->skype_account = $data['skype_account']; 
                    if(isset($data['market_area'])){
                      $network->market_area = $data['market_area']; 
                    } 
                    if(isset($data['business_area'])){
                      $network->business_area = $data['business_area']; 
                    }
                    if(isset($data['your_business'])){
                      $network->your_business = $data['your_business']; 
                    }
                    if(isset($data['discover_platform'])){
                        $network->discover_platform = $data['discover_platform']; 
                    }
                    if(isset($data['your_organization'])){
                      $network->your_organization = $data['your_organization']; 
                    }
                    if(isset($data['agents'])){
                      $network->agents = $data['agents']; 
                    }
                    if(isset($data['position'])){
                      $network->position = $data['position']; 
                    }
                    
//                    $network->t_n_c_1 = $data['t_n_c_1'];
//                    $network->t_n_c_2 = $data['t_n_c_2'];
//                    $network->t_n_c_3 = $data['t_n_c_3'];

                    if($network->save()) {
                        // =========adding activation code and sending male===================
                        Mail::raw('A new Distributed Network Registration has been done!', function($message)
                        {
                            $message->subject('Registration Status');
                            $message->from('info@gdoox.com', 'Gdoox');
                            $message->to('mukesh@uginfosystems.com');
                        });

                        Session::flash('message', 'Dear '.$data['first_name'].' Your Information has been saved Successfully! We will contact you soon. Thanks');
                        return Redirect::route('distributionnetwork.create');
                    }
                    else {
                       return Redirect('distribution_network/create')->with('message','The Information could not be saved! Please try again')->withInput(Request::all());  
                    }
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);;
        }
    }

    public function edit($id) {
        try {
            if(Auth::user()){
                $fm_data = FieldMaster::where('title','=','distribution_network')->first();
                $tc =  TermsAndCondition::where('title', 'personal_info')->where('lang', 'en')->first();
                $countries =  DropdownOption::where('name','countries')->where('type','drop_down')->where('lang',$this->language)->first();
                $terms = TermsAndCondition::where('title','=','personal_info')->where('lang', 'en')->first();

                foreach($countries->options as $countryname){
                  $country[$countryname]=$countryname;
                }

                $networks = DistributionNetwork::where('_id','=',$id)->first();

                return view('distribution_network.edit',compact('fm_data','terms','networks','types','country','tc'));
            }
            else {
                return redirect('auth/login')->with('message',"Please Login to Edit Distributed Network!"); 
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);;
        }
    }
    
    public function update($id) {
        try{
            $data= Request::all();
            $rules = array('first_name' => 'required|min:2|max:50',
                'last_name'=>'required|max:50',   
                'country_of_work'=> 'required',
                'region' => 'required|max:100',
                'business_email' => 'required|email',
                'business_phone' => 'required',
                'skype_account' => 'required',
                't_n_c_1'=> 'required',
                't_n_c_2'=> 'required',
                't_n_c_3'=> 'required');
        
            $validator = Validator::make(Request::all(), $rules);
        
            if ($validator->fails()) {  
                return Redirect('distribution_network/create')->withErrors($validator)->withInput(Request::all());   
            }
            else {
                    $network= DistributionNetwork::where('_id', '=', $id)->first();
                    if(array_key_exists('company_name',$data)){
                         $network->company = $data['company_name'];
                    }

                    if(array_key_exists('gender', $data)){
                        $network->gender = $data['gender'];
                    }

                    if(array_key_exists('country_of_living', $data)){
                        $network->country_of_living = $data['country_of_living'];
                    }

                    if(array_key_exists('age', $data)){
                        $network->age = $data['age'];
                    }

                    if(array_key_exists('vat', $data)){
                         $network->vat = $data['vat'];
                    }

                    $network->type = $data['type'];
                    $network->first_name = $data['first_name'];
                    $network->last_name = $data['last_name'];
                    $network->country_of_work = $data['country_of_work'];
                    $network->region = $data['region'];
                    $network->business_email = $data['business_email'];
                    $network->business_phone = $data['business_phone'];
                    $network->business_mob = $data['business_mob'];
                    $network->skype_account = $data['skype_account']; 
                    if(!empty($data['market_area'])){
                      $network->market_area = $data['market_area']; 
                    } 
                    if(!empty($data['business_area'])){
                      $network->business_area = $data['business_area']; 
                    }
                    if(!empty($data['your_business'])){
                      $network->your_business = $data['your_business']; 
                    }
                    if(!empty($data['discover_platform'])){
                        $network->discover_platform = $data['discover_platform']; 
                    }
                    if(!empty($data['discover_platform'])){
                      $network->your_organization = $data['your_organization']; 
                    }
                    if(!empty($data['discover_platform'])){
                      $network->agents = $data['agents']; 
                    }
                    if(!empty($data['discover_platform'])){
                      $network->position = $data['position']; 
                    }
                    $network->t_n_c_1= $data['t_n_c_1'];
                    $network->t_n_c_2= $data['t_n_c_2'];
                    $network->t_n_c_3= $data['t_n_c_3'];
                    if($network->save()) {
                        Session::flash('message', 'Data Updated Successfully!');
                        return Redirect::route('distributionnetwork.index');
                    }
                    else {
                       return Redirect('distribution_network/edit')->with('message','The Information could not be updated! Please try again')->withInput(Request::all());  
                    }
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);;
        }
    }
    
    public function show($id){
        try {
            $network = DistributionNetwork::where('_id','=',$id)->first();
            $fm_data = FieldMaster::where('title','=','distribution_network')->where('lang', $this->language)->first();
            $tc =  TermsAndCondition::where('title', 'personal_info')->where('lang', 'en')->first();
            return view('distribution_network.show',compact('fm_data','network','tc'));
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);;
        }
    }
    
     public function viewNetwork($val) {
        try{
           $term = '';
           $type = trim($val);
           if($type === 'View All') {
               $networks = DistributionNetwork::orderBy('_id','desc')->paginate(50);
           }
           else {
               $networks = DistributionNetwork::where('type', $type)->paginate(50);
           }

           return view('distribution_network.view_network', compact('networks'))->with('type', $type)->with('term',$term);
        }
        catch(\Exception $e){
           $errors = $this->errorMessage($e);
           return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);;
       }
    }
    
    
    public function searchNetwork(){
        try {
            $input= Request::all();
            $val = explode(' ',trim($input['term']));
            $term= trim($val[0]);
            $type= trim($input['type']);

            $networks = DistributionNetwork::where('type','=',$type)->where('first_name', 'like', '%'.$term.'%')->paginate(50);
            return view('distribution_network.view_network',  compact('networks'))->with('type',$type)->with('term',$input['term']);
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);;
        }
    }
    
    public function autoNetworkSearch(){
        try{
            if(Request::ajax()){
                $input = Request::all();
                $networks= DistributionNetwork::where('first_name', 'like', '%'.$input['term'].'%')->project( array('first_name','last_name'))->get();
                $i = 0;
                $response = array();
                foreach($networks as $network){
                    $response[$i]['name'] = $network['first_name'].' '.$network['last_name'];
                    $i++;
                }
                echo json_encode($response);
            }
        } 
        catch (Exception $e) {
              return Response::json ( array (
                  'error' => true,
                  'data' => $e
              ), 200 );
        } 
    }
            
    function fetchAttributesAssoc(){
        try{
            $attrAssoc = array();
            $attrAssocTmp = AttributesAssoc::where('lang', '=', $this->language)->project( array('id','label') )->get();
            foreach($attrAssocTmp as $v){
                $attrAssoc[$v->id] = $v->label;
            } 
            return $attrAssoc;
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);;
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
