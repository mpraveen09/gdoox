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
use Gdoox\Models\AlertSystem;
use Gdoox\Models\EcomShops;
use Gdoox\User;
use Form;
use Image;
use Input;

class ContactBuyerController extends Controller {
    use  \Gdoox\Helpers\backend\dashboard\RolesUsers;
    public function index(){
        if(Auth::user()){
            $limit = 50;
            $role = $this->getRoleName(Auth::user()->id);
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'ORDERS (OMS)')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
            
            $business_ecom_shops = EcomShops::where('user_id', Auth::user()->id)->get();
            foreach($business_ecom_shops as $ecom_shops){
                if(!empty($ecom_shops->slug)){
                    $mystores[] = $ecom_shops->slug;
                }
            }
            
            $messages = ComplaintMessages::orderBy('created_at','=','desc')->whereIn('store',$mystores)->where('from','=','buyer')->paginate($limit);
            
            $update = AlertSystem::where('user_id','=',Auth::user()->id)->first();
            $update->buyer_messages = array('read_at'=>date("Y-m-d H:i:s"),"notification"=>"");
            $update->save();
            
            return view('contact.contact-buyer.index',  compact('messages','nav_menu','route'));
        }
        else {
            return redirect('auth/login')->with('message',"Please Login!"); 
        }
    }
    
    public function create(){
        if(Auth::user()){
            $data = Request::all();
            
            $orderid = $data['orderid'];
            $suborderid = $data['suborderid'];
            $store = $data['store'];
            
            $subject = ComplaintMessages::where('store',$store)->where('orderid','=',$orderid)->where('sub_order_id','=',$suborderid)->first();
            
            return view('contact.contact-buyer.create',  compact('orderid','store','suborderid','subject'));
        }
        else {
            return redirect('auth/login')->with('message',"Please Login!"); 
        }
    }
    
    public function show($orderid){
       if(Auth::user()){
            $messages = ComplaintMessages::where('orderid','=',$orderid)->get();
            return view('contact.contact-buyer.show',  compact('messages','orderid'));  
        }
        else {
            return redirect('auth/login')->with('message',"Please Login!"); 
        }
    }

    public function store(){
        $data = Request::all();        
        $contactseller = new ComplaintMessages();
        $contactseller->user_id = Auth::user()->id;
        $contactseller->orderid = $data['orderid'];
        $contactseller->store = $data['store'];
        $contactseller->subject = $data['subject'];
        $contactseller->message = $data['message'];
        $contactseller->sub_order_id = $data['suborderid'];
        $contactseller->from = 'seller';
        
        if($contactseller->save()){
            return Redirect::route('contact-buyer-show',$data['orderid'])->with('message','Message sent Successfully to the Buyer');
        }
        else {
            return redirect()->back()->with('message','Message could not be Sent. Please try Again');
        } 
    }
    
    public function edit($id){
        
    }
    
    public function update($id){
        
    }
    
    public function destroy(Request $request, $id){
        
    }
}
