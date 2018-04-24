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
    
    public function index(){
        if(Auth::user()){ 
            $limit = 50;
            
            $user =  User::where('_id', Auth::user()->id)->first();
            $username = $user->username;
            
            if($username==='superadmin'){
                $messages = ComplaintMessages::orderBy('created_at','desc')->where('to','=','Gdoox')->paginate($limit);
            }                                                  
            else {
                $messages = ComplaintMessages::orderBy('created_at','desc')->where('user_id','=', Auth::user()->id)->where('to','=','Gdoox')->paginate($limit);
            }

            return view('contact.contact-gdoox.index',  compact('messages','user','username'));  
        }
        else {
            return redirect('auth/login')->with('message',"Please Login!"); 
        }
    }
    
    public function create(){
        if(Auth::user()){
            $stores = array();
            $order_ids = array();
            
            $orderids = Orders::where('status','!=','Pending')->where('user_id','=',Auth::user()->id)->get();
            foreach ($orderids as $orderid) {
                $order_ids[] = $orderid->order_id;
            }
            
            foreach ($orderids as $orderid) {
                $stores[] = $orderid->store;
            }
            
            return view('contact.contact-gdoox.create',  compact('stores','order_ids'));
            
            
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
        $contactseller = new ComplaintMessages();
        $contactseller->user_id = Auth::user()->id;
        $contactseller->subject = $data['subject'];
        $contactseller->message = $data['message'];
        $contactseller->from = '';
        $contactseller->to = 'Gdoox';
        
        if($contactseller->save()){
            return Redirect::route('contact-gdoox-index')->with('message','Message sent Successfully to the Gdoox');
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
