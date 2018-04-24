<?php

namespace Gdoox\Http\Controllers\cart;
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
use Gdoox\Models\WishList;
use Gdoox\Models\ProductReviews;
use Gdoox\Models\AlertSystem;
use Illuminate\Support\Facades\Auth;
use Gdoox\Models\NavigationMenu;
use Illuminate\Support\Facades\Route;
use Gdoox\Models\PersonalSiteDetail;
use Gdoox\Models\CrmOpportunities;
use Gdoox\User;
use Form;
use Image;
use Input;

class ShoppingCartController extends Controller {
    
    public function addToCart(){
        $input = Request::all();
        if(Auth::user()) {
            $userid = Auth::user()->id;
            $user = User::where('_id','=',$userid)->first();
        }
  
        $product = Products::find($input['product_id']);
        $cookie_val = $_COOKIE['gdoox_shopping_cart'];
        // $cookie_val = Cookie::get('gdoox_shopping_cart');
        
        $find_product = ShoppingCart::where('product_id','=',$input['product_id'])->where('cart_id','=',$cookie_val)->where('status','=','0')->first();
        
        if(isset($find_product)){
            $find_product->qty = $find_product->qty + 1;
            $find_product->save();
            
            if(isset($userid)){
                $total = ShoppingCart::where('cart_id','=', $cookie_val)->orWhere('userid','=', $userid)->where('status','=','0')->count('product_id');
            }
            else {
                $total = ShoppingCart::where('cart_id','=', $cookie_val)->where('status','=','0')->count('product_id');
            }
        }
        else {
            $cart = new ShoppingCart();
            $cart->product_id = $input['product_id'];
            
            $cart->part_number = (isset($product->product_data[4]) ? $product->product_data[4] : 'N/A');
            $cart->seller_ref_code = (isset($product->product_data[308]) ? $product->product_data[308] : 'N/A');
            
            
            if(!empty($product->product_data[3])){
                $cart->product_name = $product->product_data[3];
            }
            elseif(!empty($product->product_data[6])){
                $cart->product_name = $product->product_data[6];
            }
            elseif(!empty($product->product_data[9])){
                $cart->product_name = $product->product_data[9];
            }
            elseif(!empty($product->product_data[481])){
                $cart->product_name = $product->product_data[481];
            }
            else {
                $cart->product_name = 'Not Available';
            }
            
            if(Auth::user()){
                $cart->userid = Auth::user()->id;
                
                
                $user = User::where('_id','=', Auth::user()->id)->first();
                $cart->email = Auth::user()->email;
            }
            else {
                $cart->userid = '';
                $cart->email = 'Not Available';
            }
            
            $cart->shopid = $input['shopid'];
            $cart->desc = $product->desc;
            $cart->thumb = $product->thumb;
            $cart->thumb_path = $product->thumb_path;
            
            if(isset($product->product_data[16])){
                $cart->price = $product->product_data[16];
            }
            elseif(isset($product->product_data[18])) {
                $cart->price = $product->product_data[18];
            }
            
            $cart->vat = $product->product_data[12];
            $cart->eco_tax = $product->product_data[603];
            $cart->duty_tax = $product->product_data[604];
            $cart->local_tax = $product->product_data[605];
            
            $proddata = array();
            
            if(isset($product->product_data[13])){
                $proddata['13'] = $product->product_data[13];
            }
            if(isset($product->product_data[14])){
                $proddata['14'] = $product->product_data[14];
            }
            if(isset($product->product_data[15])){
                $proddata['15'] = $product->product_data[15];
            }
            if(isset($product->product_data[16])){
                $proddata['16'] = $product->product_data[16];
            }
            if(isset($product->product_data[17])){
                $proddata['17'] = $product->product_data[17];
            }
            if(isset($product->product_data[18])){
                $proddata['18'] = $product->product_data[18];
            }
            
            $cart->product_data = $proddata;
            $cart->qty = 1;
            $cart->status = '0';
            $cart->viewed = '0';

            
            if(isset($cookie_val)){
                $cart->cart_id = $cookie_val;
                if($cart->save()){
                    if(isset($userid)){
                        $total = ShoppingCart::where('cart_id','=', $cookie_val)->orWhere('userid','=',$userid)->where('status','=','0')->count('product_id');    
                    }
                    else {
                        $total = ShoppingCart::where('cart_id','=', $cookie_val)->where('status','=','0')->count('product_id');
                    }             
                }
                else {
                    echo "Product Could not be Added, please try Again";
                    exit;
                } 
            }
        }

        // $cart_items= array();
        // Session::forget('cart_items');
        // Session::put("cart_items", $total);
        // session("cart_items" = $total);
        // Session::flush();
        session(['cart_items' => $total]);
        return json_encode(Session::get('cart_items'));
        return $total;
    }
    
    public function listCart(){
        $i = 0;
        $cookie_val = $_COOKIE['gdoox_shopping_cart'];
        $user_tree_array="";
        $response = array();
        
        if(Auth::user()){
            $userid= Auth::user()->id;
            $product_list = ShoppingCart::where('cart_id','=',$cookie_val)->orWhere('userid','=',$userid)->get(array('shopid', 'product_id'));
        }
        else {
            $product_list = ShoppingCart::where('cart_id','=',$cookie_val)->get(array('shopid', 'product_id'));
        }

        foreach($product_list as $product){
                $response[ $product->shopid ][] = $product->product_id;
        }
        foreach($response as $k => $v){
            $user_tree_array .= '<div style="padding:5px 20px"><a href="'. route('view_cart') . '/' .$k .'">View Cart - ' . $k .' -- '. count($v).' item(s)</a></div>';
        }
        return $user_tree_array;//json_encode($user_tree_array);
    }
    
    public function viewCart($shopid=""){
      $input = Request::all();
      $cookie_val = $_COOKIE['gdoox_shopping_cart'];
      if(Auth::user()) {
          $userid= Auth::user()->id;
          if(!empty($shopid)) {
              if(isset($userid)) {
                  $products = ShoppingCart::where('cart_id','=', $cookie_val)->orWhere('userid', '=' , $userid)->Where('shopid','=',$shopid)->where('status','=','0')->project(array('userid','product_name','shopid','desc','price','qty','thumb', 'thumb_path','vat','eco_tax','duty_tax','local_tax'))->get();
                  $shopids = ShoppingCart::distinct('shopid')->Where('cart_id','=', $cookie_val)->orWhere('userid','=',$userid)->Where('shopid','=',$shopid)->where('status','=','0')->get();
              }
              else {
                  $products = ShoppingCart::where('status','=','0')->Where('shopid','=',$shopid)->Where('cart_id','=', $cookie_val)->project(array('userid','product_name','shopid','desc','price','qty','thumb', 'thumb_path','vat','eco_tax','duty_tax','local_tax'))->get();
                  $shopids = ShoppingCart::distinct('shopid')->Where('shopid','=',$shopid)->orWhere('cart_id','=', $cookie_val)->where('status','=','0')->get();
              }
          }
          else {
              if(isset($userid)) {
                  $products = ShoppingCart::Where('cart_id','=', $cookie_val)->orwhere('userid', '=' , $userid)->where('status','=','0')->project(array('userid','product_name','shopid','desc','price','qty','thumb', 'thumb_path','vat','eco_tax','duty_tax','local_tax'))->get();
                  $shopids = ShoppingCart::distinct('shopid')->Where('cart_id','=', $cookie_val)->orWhere('userid','=',$userid)->where('status','=','0')->get();
              }
              else {
                  $products = ShoppingCart::where('status','=','0')->Where('cart_id','=', $cookie_val)->project(array('userid', 'product_name', 'shopid', 'desc', 'price', 'qty', 'thumb', 'thumb_path','vat','eco_tax','duty_tax','local_tax'))->get();
                  $shopids = ShoppingCart::distinct('shopid')->Where('cart_id','=', $cookie_val)->where('status','=','0')->get();
              } 
          }

          return view('cart.viewcart',compact('products','shopids'));
      }
      else {
           return redirect('auth/login')->with('message',"Please Login!"); 
      }
    }
    
    public function addQuantity(){
      try{
        if(Request::ajax()){
            $input = Request::all(); 
            $response = array();

            $find_product = ShoppingCart::find($input['id']);
            $find_product->qty = $input['qty'];
            $find_product->save();

            $products = ShoppingCart::where('_id','=',$input['id'])->Where('status','=','0')->project(array('price','qty'))->get();

            foreach($products as $attributes){
                    $response['price'] = $attributes['qty']* $attributes['price'];
                    $response['qty'] = $attributes['qty'];
            }
            return $response;
        }
      } 
      catch (Exception $e) {
            echo "Something went Wrong! Please try Again";
      }
    }
    
    public function removeItem() {
        try{
          $input = Request::all();
          if(Auth::user()){
             $userid= Auth::user()->id;
          }
          // $cookie_val = Cookie::get('gdoox_shopping_cart');
          $cookie_val = $_COOKIE['gdoox_shopping_cart'];

          $find_product = ShoppingCart::find($input['id']);

          if($find_product->delete()){
              if(isset($userid)){
                       $total = ShoppingCart::where('cart_id','=', $cookie_val)->orWhere('userid','=',$userid)->where('status','=','0')->count('product_id');
              }
              else {
                  $total = ShoppingCart::where('status','=','0')->where('cart_id','=', $cookie_val)->count('product_id');
              }

              session(['cart_items' => $total]);

              return Redirect::route('view_cart');
//                  return json_encode(Session::get('cart_items'));
          }
          else {
              echo "Item could not be Delete! Please try Again";
            }
//            }
        }
        catch (Exception $e) {
              echo "Something went Wrong! Please try Again";
        }
    }
    
    public function addToWishlist() {
        $input = Request::all();
        if(Auth::user()){
            $userid= Auth::user()->id;
            $wishlist= new WishList();
            $wishlist->product_id = $input['product_id'];
            $wishlist->userid = $userid;
            $wishlist->shopid = $input['shopid'];

            if($wishlist->save()){
                $response= array();
                $wishlist = WishList::Where('userid','=',$userid)->where('product_id','=',$input['product_id'])->where('shopid','=',$input['shopid'])->first();
                $response['message']= '<i class="zmdi zmdi-favorite zmdi-hc-fw"></i>Added to Wishlist';
                $response['product_id']= $wishlist->product_id;
                return $response;
            }
        }
        else {
                Session::flash('message', 'Please Login First');
                return redirect('auth/login');  
        }
    }
    
    public function showWishList(){
        if(Auth::user()){
            $userid = Auth::user()->id;
        }
        
        $wishlists = WishList::Where('userid','=',$userid)->get();
        
        foreach ($wishlists as $wishlist) {
            $products[]= Products::Where('_id','=',$wishlist->product_id)->project(array('desc','thumb','shopid','product_data', 'thumb_path'))->first();
        }
        
        // $products = Products::Where('status','=','Active')->get();
        
        return view('cart.wishlist',compact('products'));
    }
    
    public function removeWishListItem(){
        try{
           if(Request::ajax()){
               $input = Request::all();
               if(Auth::user()){
                   $userid= Auth::user()->id;
               }

               $find_product = WishList::where('userid','=',$userid)->where('product_id','=',$input['product_id'])->where('shopid','=',$input['shopid'])->first();

               if($find_product->delete()){    
                  $find = WishList::where('userid','=',$userid)->get();
                  if(!empty($find_product)){
                      return;
                  }
                   else {
                       return 1;
                   }
               }
               else {
                   echo "Item could not be Delete! Please try Again";
               }
           }
       }
        catch (Exception $e) {
              echo "Something went Wrong! Please try Again";
        }
    }
    
    public function writeReview($shopid, $prodid){        
        $data= Request::all();
        $fm_data = DB::collection('field_master')->where('title', '=', 'review_form_info')->first();
       
        if(array_key_exists('key', $data)){    
            $review= new ProductReviews();
            if(Auth::user()){
                $userid = Auth::user()->id;
                $review->user_id = $userid;
            }
            else {
                 $review->user_id = '';
            }

            $review->shopid =$shopid;
            $review->product_id = $prodid;
            $review->review_title = $data['review_title'];
            $review->review = $data['review'];
            $review->rating = $data['rating'];
            $review->name = $data['name'];

            if($review->save()){
                $response= array();
                $i = 0;
                $get_reviews = ProductReviews::Where('product_id','=',$data['product_id'])->where('shopid','=',$data['shopid'])->get();

                foreach($get_reviews as $get_review) {
                    $response[$i]['shopid']= $get_review->shopid;
                    $response[$i]['review_title']= $get_review->review_title;
                    $response[$i]['review']= $get_review->review;
                    $response[$i]['rating']= $get_review->rating;
                    $response[$i]['product_id']= $get_review->product_id;
                    $response[$i]['name']= $get_review->name;
                    $i++;
                }
                Session::flash('message', 'Review Added Successfully');

                return view('store.write_review', compact('fm_data'))
                   ->with('product_id', $data['product_id'])
                   ->with('shopid', $data['shopid'])->with('response',$response);
            }
        }
        else {
            $product_id= $data['product_id'];
            $shopid= $data['shopid'];
            // $get_reviews = ProductReviews::Where('shopid','=',$shop_id)->where('product_id','=',$product_id)->get();   
            return view('store.write_review',compact('fm_data'))->with('product_id',$product_id)->with('shopid',$shopid);
       } 
    }
    
    public function abandonedCart(){
        if(Auth::user()){
            $abandoned_cart = array();
            $store_name = array();
            $user_name = array();
            $shopids = array();
            $userids = array();
            
            $userid = Auth::user()->id;
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('parent', '61')->where('group','product_management')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
            

            $update = AlertSystem::where('user_id','=',Auth::user()->id)->first();
            $update->ab_cart = array('read_at'=>date("Y-m-d H:i:s"),"notification"=>"");
            $update->save();
            
            
            $stores = BusinessEcommerceCompany::where('user_id','=', $userid)->get();
            if(!empty($stores)){
                foreach ($stores as $value) {
                    $shopids[] = $value->slug;
                    $store[$value->slug] = $value->ecomm_company_name;
                }
            }
            
                      
            $products = ShoppingCart::where('status','=','0')->whereIn('shopid', $shopids)->get();
            if(!empty($products)){
                foreach($products as $product){
                    $userids[$product->userid] = $product->userid;
                }
            }
            
            $users = User::where('active','=',1)->whereIn('_id',$userids)->get();
            if(!empty($users)){
                foreach($users as $value) {
                    $user_name[$value->_id] = $value->username;
                }
            }
            $customerdata = PersonalInfo::whereIn('user_id',$userids)->get();
            if(!empty($customerdata)){
                foreach($customerdata as $customer){
                    $user_name[$customer->user_id] = $customer->first_name." ".$customer->second_name." ".$customer->surname ;
                }
            }

            return view('cart.abandoned_cart', compact('nav_menu','route','products','store','user_name'))->with('user_id', $userid);    
        }
        else {
            return redirect('auth/login')->with('message',"Please Login to View Abandoned Cart!"); 
        }
    }
    
    public function abandonedCartProduct($shopid,$prodid) {
        if(Auth::user()) {
            
            $userid = Auth::user()->id;
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('parent', '61')->where('group','product_management')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
            
            $product = ShoppingCart::where('status','=','0')->where('shopid','=',$shopid)->where('_id','=',$prodid)->first();
            $user = User::where('active','=',1)->where('_id',$product->userid)->first();
            $userdetails = PersonalInfo::where('user_id', $product->userid)->first();
           
            $customer = PersonalInfo::where('user_id',$product->userid)->first();
            if(!empty($customer)){
                $user_name = $customer->first_name." ".$customer->second_name." ".$customer->surname;
            }

            return view('cart.view_abandoned_cart', compact('route','nav_menu','product','userdetails','user_name','user','opportunity'))->with('user_id', $userid);    
        }
        else {
            return redirect('auth/login')->with('message',"Please Login to View Abandoned Cart!"); 
        }
    }
}
