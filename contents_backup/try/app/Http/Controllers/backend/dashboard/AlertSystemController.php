<?php

namespace Gdoox\Http\Controllers\backend\dashboard;

use DB;
use Auth;
use Gdoox\User;
use Gdoox\Models\FieldMaster;
use Gdoox\UserRole;
use Gdoox\Role;
use Input;
use Illuminate\Support\Facades\Session;
//use Illuminate\Support\Facades\Request;
use Gdoox\Http\Requests;
use Illuminate\Http\Request;
use Gdoox\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Gdoox\SubUser;
use Illuminate\Support\Facades\Mail;
use Gdoox\Models\BusinessEcommerceCompany;
use Illuminate\Support\Facades\Route;
use Gdoox\Models\NavigationMenu;
use Gdoox\Models\Products;
use Gdoox\Models\AlertSystem;
use Gdoox\Models\ChatMessages;
use Gdoox\Models\ShoppingCart;
use Gdoox\Models\CompanyInvitation;
use Gdoox\Models\BusinessInfo;
use Gdoox\Models\BusinessPartner;
use Gdoox\Models\ComplaintMessages;
use MongoDate;


class AlertSystemController extends Controller {
  
  /**
     * Display Dashboard Index page.
     *
     * @return Dashboard
     */
    
    use \Gdoox\Helpers\backend\dashboard\RolesUsers;
    
    public function index(){
        try {
            $userid = Auth::user()->id;
            $roleID = $this->roleID($userid);
            $rolename = $this->getRole($roleID);
            $message_count = '';
            $ab_cart_count='';
            $businesspartner='';
            $businessecosystem='';
            $companynetwork='';
            $buyermessages='';
            $sellermessages='';
            
            $check = AlertSystem::where('user_id','=', $userid)->first();
            $datetimenow = date('Y-m-d H:i:s');
           
            if(empty($check)){
                $data = new AlertSystem();
                $data->user_id = $userid;
                $data->role = $rolename;
                $data->chat_messages = array("read_at"=>$datetimenow,"notification"=>"");
                $data->ab_cart = array("read_at"=>$datetimenow,"notification"=>"");
                $data->business_partner = array("read_at"=>$datetimenow,"notification"=>"");
                $data->business_ecosystem = array("read_at"=>$datetimenow,"notification"=>"");
                $data->company_network = array("read_at"=>$datetimenow,"notification"=>"");
                $data->buyer_messages = array("read_at"=>$datetimenow,"notification"=>"");
                $data->seller_messages = array("read_at"=>$datetimenow,"notification"=>"");
                $data->db_updated =  date("Y-m-d H:i:s", time() + 30);
                $data->save();
                    
                $html="";
                $html.='<a data-toggle="dropdown" href="">
                        <i class="tm-icon zmdi zmdi-notifications"></i>';
                       // $html.='<i class="tmn-counts"></i>';
                $html.='</a>';
                return $html;
            }
            else {
                    $enddate = new MongoDate(strtotime($datetimenow));
                    if($check->chat_messages['read_at'] < $check->db_updated){
                        // Get the new Message Count.
                        $chdate = new MongoDate(strtotime($check->chat_messages['read_at']));
                        // $message_count = ChatMessages::whereRaw(['created_at' => array('$gt' => $chdate, '$lt' => $enddate)])->where('to_id','=',Auth::user()->id)->count();
                        $message_count = ChatMessages::whereRaw(['created_at' => array('$gt' => $chdate)])->where('to_id','=',Auth::user()->id)->count();
                    }
                    
                    
                    if($check->ab_cart['read_at'] < $check->db_updated){
                        // Get the Abandoned Cart Items Count.
                        $abdate = new MongoDate(strtotime($check->ab_cart['read_at']));
                        $ab_cart_count = ShoppingCart::whereRaw(['created_at' => array('$gt' => $abdate)])->where('userid','=',Auth::user()->id)->count();
                    }
                    
                    
                    if($check->business_partner['read_at'] < $check->db_updated){
                        // Getting the Internal Business Partnes who have accepted the request.
                        $bpdate = new MongoDate(strtotime($check->business_partner['read_at']));
                        $businesspartner = CompanyInvitation::whereRaw(['created_at' => array('$gt' => $bpdate)])->where('status','=','Accepted')->count();
                    }
                    
                    if($check->business_ecosystem['read_at'] < $check->db_updated){
                        // Getting the Business Ecosytem Partnes who have accepted the request.
                        $bedate = new MongoDate(strtotime($check->business_ecosystem['read_at']));
                        $businessecosystem = BusinessPartner::whereRaw(['created_at' => array('$gt' => $bedate)])->where('status','=','Accepted')->where('type','=','Business Ecosystem')->count();
                    }
                                        
                    if($check->company_network['read_at'] < $check->db_updated){
                        // Getting the Company Network Partnes who have accepted the request.
                        $cndate = new MongoDate(strtotime($check->company_network['read_at']));
                        $companynetwork = BusinessPartner::whereRaw(['created_at' => array('$gt' => $cndate)])->where('status','=','Accepted')->where('type','=','Company Network')->count();
                    }
                    
                    if($check->buyer_messages['read_at'] < $check->db_updated){
                        // Getting the Company Network Partnes who have accepted the request.
                        $bmdate = new MongoDate(strtotime($check->buyer_messages['read_at']));
                        $buyermessages = ComplaintMessages::whereRaw(['created_at' => array('$gt' => $bmdate)])->where('from','=','buyer')->count();
                    }
                    
                    if($check->seller_messages['read_at'] < $check->db_updated){
                        // Getting the Company Network Partnes who have accepted the request.
                        $smdate = new MongoDate(strtotime($check->seller_messages['read_at']));
                        $sellermessages = ComplaintMessages::whereRaw(['created_at' => array('$gt' => $smdate)])->where('from','=','seller')->count();
                    }
                    
                    $html="";

                    $html.='<a data-toggle="dropdown" href="">
                            <i class="tm-icon zmdi zmdi-notifications"></i>';
                            if($message_count!='0' || $ab_cart_count!='0' || $businesspartner!='0' || $businessecosystem!='0' || $companynetwork!='0' || $buyermessages!='0' || $sellermessages!='0'){
                                $html.='<i class="tmn-counts">New</i>';
                            }
                            else {
                                $html.='<i></i>';
                            }
                    $html.='</a>';

                    $html.='<div class="dropdown-menu dropdown-menu-lg pull-right">
                        <div class="listview">
                            <a class="tm-cart " href=""><i class="tmn-counts"></i></a>';
                            $htmlchat="";
                            if($message_count!='0'){
                                $htmlchat.="<div style='padding:5px 20px'>";
                                $htmlchat.="<a class='msg_count' href='".route('chat.create')."'>";
                                $htmlchat.= $message_count." New Messages";
                                $htmlchat.="</a>";
                                $htmlchat.="</div>";
                                $html.= $htmlchat;
                            }

                            $htmlabcart="";
                            if($ab_cart_count!='0'){
                                $htmlabcart.='<div style="padding:5px 20px">';
                                $htmlabcart.="<a href='".route('abandoned_cart')."'>";
                                $htmlabcart.= $ab_cart_count." Products Added to Abandoned Cart";
                                $htmlabcart.='</a>';
                                $htmlabcart.='</div>';
                                $html.= $htmlabcart;
                            }
                            
                            $htmlbpartner="";
                            if(!empty($businesspartner)){
                                $htmlbpartner.='<div style="padding:5px 20px">';
                                $htmlbpartner.="<a href='".route('invite.company.status')."'>";
                                $htmlbpartner.=$businesspartner." User(s) accepted your Company Invitation";
                                $htmlbpartner.='</a>';
                                $htmlbpartner.='</div>';
                                $html.= $htmlbpartner;
                            }
                            
                            $htmlcomnetwork= "";
                            if(!empty($companynetwork)){
                                $htmlcomnetwork.='<div style="padding:5px 20px">';
                                $htmlcomnetwork.="<a href='".route('company.network.show')."'>";
                                $htmlcomnetwork.=$companynetwork." User(s) accepted your Company Network Invitation";
                                $htmlcomnetwork.='</a>';
                                $htmlcomnetwork.='</div>';
                                $html.=$htmlcomnetwork;
                            }
                            
                            $htmlecom="";
                            if(!empty($businessecosystem)){
                                $htmlecom.='<div style="padding:5px 20px">';
                                $htmlecom.="<a href='".route('invite.partner.show')."'>";
                                $htmlecom.= $businessecosystem." User(s) accepted your Business Ecosystem Invitation";
                                $htmlecom.='</a>';
                                $htmlecom.='</div>';
                                $html.= $htmlecom;
                            }
                            
                            $htmlbuyermsg="";
                            if(!empty($buyermessages)){
                                $htmlbuyermsg.='<div style="padding:5px 20px">';
                                $htmlbuyermsg.="<a href='".route('contact-buyer-index')."'>";
                                $htmlbuyermsg.= $buyermessages." New Message from the Buyer";
                                $htmlbuyermsg.='</a>';
                                $htmlbuyermsg.='</div>';
                                $html.= $htmlbuyermsg;
                            }
                            
                            $htmlsellermsg="";
                            if(!empty($sellermessages)){
                                $htmlsellermsg.='<div style="padding:5px 20px">';
                                $htmlsellermsg.="";
                                $htmlsellermsg.= $sellermessages." New Message from the Seller";
                                $htmlsellermsg.='</a>';
                                $htmlsellermsg.='</div>';
                                $html.= $htmlsellermsg;
                            }
                            
                            
                                    
                        $html.='</div>';
                        $html.='</div>';

                        $check->chat_messages = array("read_at"=>$check->chat_messages['read_at'], "notification"=>$htmlchat);;
                        $check->ab_cart = array("read_at"=>$check->ab_cart['read_at'],"notification"=>$htmlabcart);
                        $check->business_partner = array("read_at"=>$check->business_partner['read_at'],"notification"=>$htmlbpartner);
                        $check->business_ecosystem = array("read_at"=>$check->business_ecosystem['read_at'],"notification"=>$htmlcomnetwork);
                        $check->company_network = array("read_at"=>$check->company_network['read_at'],"notification"=>$htmlecom);
                        
                        $check->buyer_messages = array("read_at"=>$check->buyer_messages['read_at'],"notification"=>$htmlbuyermsg);
                        $check->seller_messages = array("read_at"=>$check->seller_messages['read_at'],"notification"=>$htmlsellermsg);
                        
                        $check->db_updated = date('Y-m-d H:i:s');
                        if($check->save()) {
                           return $html;
                        }
                }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }

    public function dash_board(){
        try {
                if(Auth::user()){
                    $user_count = User::count();
                    $product_count = Products::count();
                    $ab_cart_count = ShoppingCart::where('status','=','0')->count();
                    
                    $nav_menu = NavigationMenu::where('lang','en')->get();
                    return view('backend.dashboard.users.index',compact('nav_menu','user_count','product_count', 'ab_cart_count'));
                }
                else {
                    Session::flash('message', 'Please login.');
                    return redirect('/auth/login');
                }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }
    
    public function statusChatMessages(){
        $user_id = Auth::user()->id();
        
    }
    
    
     
     public function errorMessage($e){
        $error = "An error occured. ".
            "Line Number: ".$e->getLine()." ".
            "File Name: ".$e->getFile()." ".
            "Error Description: ".$e->getMessage(); 
        return $error;
    }

}
