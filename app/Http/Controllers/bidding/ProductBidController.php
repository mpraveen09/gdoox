<?php

namespace Gdoox\Http\Controllers\bidding;
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
use Gdoox\Models\ProductBiddings;
use Gdoox\User;
use Form;
use Image;
use Input;

class ProductBidController extends Controller {
    
    public function addBidAmount(){
        $input = Request::all();
        $prod_bidders = $bidding_users = $logs = array();
        
        if(Auth::user()) {
            $userid = Auth::user()->id;
            $user_info = User::where('_id', '=', $userid)->first();
        }
                
        $prod_bidders[$userid]['user_id'] = Auth::user()->id;
        $prod_bidders[$userid]['username'] = $user_info->username;
        $prod_bidders[$userid]['bid_amount'] = $input['bid_amt'];
        $prod_bidders[$userid]['date'] = date("Y-m-d H:i:s");
        
        $product = Products::find($input['product_id']);
        $prod_bidding = ProductBiddings::where('product_id', $input['product_id'])->first();

        if(!empty($prod_bidding)){
            $bid_amt = $input['bid_amt'];
            // Find  the Greatest Bid in case of Auction and Loweset Bid in case of Reverse Auction
            if($input['type']==='Auction'){
                $highest_bid_user = $user_info->username;
                foreach($prod_bidding->product_bid_users as $bid_user){
                    if($bid_user['bid_amount'] > $bid_amt){
                        $bid_amt = $bid_user['bid_amount'];
                        $highest_bid_user = $bid_user['username'];
                    }
                }
            }
            else {
                $lowest_bid_user = $user_info->username;
                foreach($prod_bidding->product_bid_users as $bid_user){
                    if($bid_user['bid_amount'] < $bid_amt){
                        $bid_amt = $bid_user['bid_amount'];
                        $lowest_bid_user = $bid_user['username'];
                    }
                }
            }
            
            foreach($prod_bidding->product_bid_users as $key=>$bid_users){
                $bidding_users[$key]['user_id'] = $bid_users['user_id'];
                $bidding_users[$key]['username'] = $bid_users['username'];
                $bidding_users[$key]['bid_amount'] = $bid_users['bid_amount'];
                $bidding_users[$key]['date'] = $bid_users['date'];
            }
            
            $bidding_users[$userid]['user_id'] = $userid;
            $bidding_users[$userid]['username'] = $user_info->username;
            $bidding_users[$userid]['bid_amount'] = $input['bid_amt'];
            $bidding_users[$userid]['date'] = date("Y-m-d H:i:s");
            
            // Conditions: If the Request is for the Auction
            if($input['type']==='Auction'){
                $prod_bidding->highest_bid_amt = $bid_amt;
                $prod_bidding->highest_bid_username = $highest_bid_user;
            }
            // Conditions: If the Request is for the Reverse Auction
            else {
                $prod_bidding->lowest_bid_amt = $bid_amt;
                $prod_bidding->lowest_bid_username = $lowest_bid_user;
            }
            
            $prod_bidding->product_bid_users = $bidding_users;
            $prod_bidding->bid_date = date("Y-m-d H:i:s");
            $log = "BID of Amount ".$input['bid_currency']." ".$input['bid_amt']." was done by ". $user_info->username;
            
            foreach($prod_bidding->product_bid_logs as $value){
                $logs[] = $value;
            }
            $logs[] = $log;
            
            $prod_bidding->product_bid_logs = $logs;
            if($prod_bidding->save()){
                $status['flag'] = 'success';
                $status['bid_amt'] = $bid_amt;
            }
            else {
                $status['flag'] = 'failure';
            }
            return json_encode($status);
        }
        else {
            $bids = new ProductBiddings();
            $bids->product_id = $product->_id;
            $bids->bid_date = date("Y-m-d H:i:s");
            $bids->product_bid_users = $prod_bidders;
            $bids->bid_currency = $input['bid_currency'];
            $bids->type = $input['type'];
            
            // Conditions: If the Request is for the Auction
            if($input['type']==='Auction'){
                $bids->highest_bid_amt = $input['bid_amt'];
                $bids->highest_bid_username = $user_info->username;
            }
            // Conditions: If the Request is for the Reverse Auction
            else {
                $bids->lowest_bid_amt = $input['bid_amt'];
                $bids->lowest_bid_username = $user_info->username;
            }
            
            $logs[] = "BID of Amount ".$input['bid_currency']." ".$input['bid_amt']." was done by ". $user_info->username;
            $bids->product_bid_logs = $logs;
                    
            if($bids->save()){
                $status['flag'] = 'success';
                $status['bid_amt'] =  $input['bid_amt'];
            }
            else {
                $status['flag'] = 'failure';
            }
            return json_encode($status);
        }
    }
    
    
    public function viewProductBids(){
        try {
            if(Request::ajax()){
                $html = "";
                $data = Request::all();
                $productid = $data['productid'];
                
                $product_bids =  ProductBiddings::where('product_id', $productid)->first();
                $html.= '<div class="row">';
                if($product_bids->count()){
                    foreach( $product_bids->product_bid_logs as $key=>$bids ){
                        echo $bids; echo "<br />";
                    } 
                }
                $html.='</div>';
                return $html;
            }
        }
        catch (Exception $e) {
            return Response::json ( array (
                  'error' => true,
                  'data' => $e
              ), 200 );
        }
    }
}
