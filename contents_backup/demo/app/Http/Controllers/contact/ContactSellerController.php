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
use Gdoox\User;
use Form;
use Image;
use Input;

class ContactSellerController extends Controller {
    use  \Gdoox\Helpers\backend\dashboard\RolesUsers;
    
    public function index(){
        
    }
    
    public function create(){
        if(Auth::user()){
            $data = Request::all();
            
            $orderid = $data['orderid'];
            $suborderid = $data['suborderid'];
            $store = $data['store'];
            
            $role = $this->getRoleName(Auth::user()->id);
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'ORDERS (OMS)')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
            
            $messages = ComplaintMessages::where('orderid','=',$orderid)->where('sub_order_id','=',$suborderid)->get();
            
            return view('contact.contact-seller.create',  compact('orderid','store','suborderid','messages','role','nav_menu','route'));
        }
        else {
            return redirect('auth/login')->with('message',"Please Login!"); 
        }
    }
    
    public function show(){
       
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
        $contactseller->from = 'buyer';
        
        if($contactseller->save()){
             return Redirect::route('contact-seller-create',['orderid'=>$data['orderid'],'suborderid'=>$data['suborderid'],'store'=>$data['store']])->with('message','Message sent Successfully to the Seller');
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
