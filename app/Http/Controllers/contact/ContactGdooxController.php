<?php

namespace Gdoox\Http\Controllers\contact;
use DB;
use Gdoox\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Gdoox\Models\PersonalInfo;
use Gdoox\Models\Products;
use Gdoox\Models\ShoppingCart;
use Gdoox\Models\BusinessEcommerceCompany;
use Gdoox\Models\Orders;
use Gdoox\Models\OrderTracking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Gdoox\Models\NavigationMenu;
use Gdoox\Models\ComplaintMessages;
use Gdoox\Models\EcomShops;
use Gdoox\User;
use Form;
use Image;
use Input;

class ContactGdooxController extends Controller {
    use  \Gdoox\Helpers\backend\dashboard\RolesUsers;
    public function index(){
        if(Auth::user()){ 
            $limit = 50;
            $role = $this->getRoleName(Auth::user()->id);
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'ORDERS (OMS)')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
            
            $user = User::where('_id', Auth::user()->id)->first();
            $username = $user->username;
            
            if($username==='superadmin'){
                $messages = ComplaintMessages::orderBy('created_at','desc')->where('to','=','Gdoox')->paginate($limit);
            }                                                  
            else {
                $messages = ComplaintMessages::orderBy('created_at','desc')->where('user_id','=', Auth::user()->id)->where('to','=','Gdoox')->paginate($limit);
            }

            return view('contact.contact-gdoox.index',  compact('messages','user','username','nav_menu','route'));  
        }
        else {
            return redirect('auth/login')->with('message',"Please Login!"); 
        }
    }
    
    public function create(){
        if(Auth::user()){
            $flag = '';
            $stores = array();
            $order_ids = array();
            $data = Request::all();
            $role = $this->getRoleName(Auth::user()->id);
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'ORDERS (OMS)')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
            
//            $orderids = Orders::where('status','!=','Pending')->where('user_id','=',Auth::user()->id)->get();
//            foreach ($orderids as $orderid) {
//                $order_ids[] = $orderid->order_id;
//            }
//            
//            foreach ($orderids as $orderid) {
//                $stores[] = $orderid->store;
//            }
            
            if(isset($data['flag'])){
                $flag = $data['flag'];
                $msg = ComplaintMessages::where('_id', $data['_id'])->first();
            }
            
            $messages = ComplaintMessages::where('user_id', Auth::user()->id)->paginate(25);
            
            return view('contact.contact-gdoox.create',  compact('stores','order_ids','nav_menu','route','messages','flag','msg'));
   
        }
        else {
            return redirect('auth/login')->with('message',"Please Login!"); 
        }
    }
    
//    public function show($orderid){
//       if(Auth::user()){
//            $messages = ComplaintMessages::where('orderid','=',$orderid)->get();
//            return view('contact.contact-buyer.show',  compact('messages','orderid'));  
//        }
//        else {
//            return redirect('auth/login')->with('message',"Please Login!"); 
//        }
//    }

    public function store(){
        $data = Request::all();
        
        $message = array();
        $message[$this->GetUserName(Auth::user()->id)] = $data['message'];
        $messages = new ComplaintMessages();
        $messages->user_id = Auth::user()->id;
        $messages->user_name = $this->GetUserName(Auth::user()->id);
        $messages->subject = $data['subject'];
        $messages->message = $message;
        $messages->from = '';
        $messages->to = 'Gdoox';
        
        if($messages->save()){
            Session::flash('message','Message sent Successfully to the Gdoox');
            return Redirect::route('contact-gdoox-create')->with('message','Message sent Successfully to the Gdoox');
        }
        else {
            return redirect()->back()->with('message','Message could not be Sent. Please try Again');
        } 
    }
    
    public function edit($id){
        
    }
    
    public function show($id){
        if(Auth::user()){
            $messages = ComplaintMessages::where('_id', $id)->first();
            return view('contact.contact-gdoox.show',  compact('messages'));  
        }
        else {
            return redirect('auth/login')->with('message','Please Login');
        }
    }
    
    public function replyToMessages(){
        if(Auth::user()){            
            $messages = array();
            $request = Request::all();
            $id = $request['_id'];
            
            $data = ComplaintMessages::where('_id', $id)->first();
            if(!empty($data)){
                foreach($data->message as $k=>$v){
                    $messages[$k] = $v;
                }
            }
            
            $messages[$this->GetUserName(Auth::user()->id)] = $request['message'];
            
            $data->message = $messages;
            if($data->save()){
                return redirect()->route('contact-gdoox-show', $id)->with('message','Message Sent Successfully');
            }
            else {
                return redirect()->back()->with('message','Something went Wrong! Not able to Send Message. Please Try Again.');
            }
        }
        else {
           return redirect('auth/login')->with('message','Please Login'); 
        }
    }

        public function update($id){
        
    }
    
    public function destroy(Request $request, $id){
        
    }
}
