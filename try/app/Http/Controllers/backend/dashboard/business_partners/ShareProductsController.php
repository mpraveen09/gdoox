<?php

namespace Gdoox\Http\Controllers\backend\dashboard\business_partners;

use DB;
use Auth;
use Illuminate\Support\Facades\Validator;
use Gdoox\Models\FieldMaster;
use Gdoox\Models\ShareSite;
use Gdoox\Models\Products;
use Gdoox\Models\SharedProducts;

use Gdoox\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Gdoox\Http\Controllers\Controller;
use Gdoox\Models\NavigationMenu;
use Illuminate\Support\Facades\Route;

//  This is the controller which is created according to new Requirement created by Mukesh.
//  The Old one is PersonalSitesController.

class ShareProductsController extends Controller
{
    use  \Gdoox\Helpers\backend\dashboard\HelperFunctions;    
    use  \Gdoox\Helpers\backend\dashboard\RolesUsers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function selectBusinessPartner(){
        if(Auth::user()){
          try {
            $userid= Auth::id();
            $inviter_user= ShareSite::where('invitee_id','=',$userid)->get();
            $fm_data = FieldMaster::where('title', '=', 'personal_sites_new')->first();

            foreach($inviter_user as $users){
                $inviter_users[$users->inviter_id] = $users->inviter_name;
            }
            return view('backend.dashboard.business_partners.shared_users.invited_users',compact('fm_data','inviter_users'));   
          }
          catch (\Exception $e){
              $error = "An error occured. ".
                              "Line Number: ".$e->getLine()." ".
                              "File Name: ".$e->getFile()." ".
                              "Error Description: ".$e->getMessage();
              return view('errors.custom_error')->withErrors($error);
          }
        }
        else {
            return redirect('auth/login')->with('message',"Please Login to Add Information!"); 
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listProducts($store_id, $inviter_id){
        if(Auth::user()){
          try {      
              
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('parent', '36')->where('group','business_ecosystem')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();
                
                $inviter_name = $this->GetUserName($inviter_id);
                $invitee_name = $this->GetUserName(Auth::user()->id);
                $list_products = Products::where('shopid','=',$store_id)->where('type','!=','Company Network')->where('old_slug', 'exists', false)->paginate(25);
                $fm_data = FieldMaster::where('title', '=', 'personal_sites_new')->first();
                
                $shared_products = SharedProducts::where('store_id','=', $store_id)->where('inviter_id', $inviter_id)->get();
         
                $shared_status = array();
                if(!empty($shared_products)){
                    foreach($shared_products as $shared_products){
                        $shared_status[$shared_products->product_id] = $shared_products->share_status;
                    }
                }
      
                return view('backend.dashboard.business_partners.shared_users.list_products',compact('fm_data','list_products','userid','store_id','inviter_id','shared_status', 'invitee_name','inviter_name','nav_menu','route'));
          }
          catch (\Exception $e){
              $error = "An error occured. ".
                "Line Number: ".$e->getLine()." ".
                "File Name: ".$e->getFile()." ".
                "Error Description: ".$e->getMessage();
              return view('errors.custom_error')->withErrors($error);
          }
        }
        else {
            return redirect('auth/login')->with('message',"Please Login to Add Information!"); 
        }
    }
    
    public function shareProduct(){ 
        $data = Request::all();
        $already_shared = array();
        $count_shared_products = 0;
        $count_unshare_product = 0;
        $i = 0;
        $j = 0;
               
        $store_id = $data['store_id'];
        $invitee_id = Auth::user()->id;
        $inviter_id = $data['inviter_id'];
  
        if(isset($data['share_products'])){
            $check = SharedProducts::whereIn('product_id', $data['share_products'])->where('invitee_id','=', $invitee_id)->where('inviter_id', $inviter_id)->where('store_id', $store_id)->where('type','=','Ecosystem')->get();
            if(!empty($check)){
                foreach($check as $c){
                    $already_shared[] = $c->product_id;
                }
            }

            $not_shared_products = array_merge(array_diff($data['share_products'], $already_shared), array_diff($already_shared, $data['share_products'])); 

            $count_shared_products = count($not_shared_products);

            if(!empty($not_shared_products)){
                foreach($not_shared_products as $key=>$value){
                    $share= new SharedProducts();
                    $share->product_id = $value;
                    $share->invitee_id = $invitee_id;
                    $share->inviter_id = $inviter_id;
                    $share->store_id = $store_id;
                    $share->share_status='shared';
                    $share->type = 'Ecosystem';
                    $share->imported='no';
                    if($share->save()) {
                        $i++ ;
                    }  
                }  
            }
        }
        

        if(isset($data['unshare_products'])){
            if($data['type'] === 'Business Ecosystem'){
                $check = SharedProducts::whereIn('product_id', $data['unshare_products'])->where('invitee_id','=', $invitee_id)->where('inviter_id', $inviter_id)->where('store_id', $store_id)->where('type','=','Ecosystem')->get();
                
                $count_unshare_product =  $check->count();
                
                if(!empty($check)){
                    foreach($check as $val){
                        $val->share_status = 'unshared';
                        if($val->save()){
                            $j++;
                        }
                    }
                }
            }
        }
      
        if(($count_shared_products === $i) && ($count_unshare_product === $j)){
            return redirect()->route('invited-business-partners.list_products', array('slug'=>$store_id, 'id'=>$inviter_id))->with('message','Product Shared/Unshared Successfully');
        }
        else {
            return redirect()->route('invited-business-partners.list_products', array('slug'=>$store_id, 'id'=>$inviter_id))->with('message','Product could not Shared/Unshared. Please Try Again!');
        }  
    }
    
//    public function shareProduct(){
//        try {
//            if(Request::ajax()){
//                
//                $data = Request::all();
//                
//                $productid = $data['product_id'];
//                $inviteeid = $data['invitee_id'];
//                $inviterid = $data['inviter_id'];
//  
//                if(array_key_exists('type', $data)){
//                    $check= SharedProducts::where('product_id','=', $productid)->where('invitee_id','=', $inviteeid)->where('type','=','Company Network')->first();
//                }
//                else {
//                    $check= SharedProducts::where('product_id','=', $productid)->where('invitee_id','=', $inviteeid)->where('type','=','Ecosystem')->first();
//                }
//                
//                if(!empty($check)){
//                    $check->share_status='shared';
//                    if($check->save()){
//                        return 'shared';
//                    }
//                    else {
//                        return 'notshared';
//                    }
//                }
//                else {
//                        if(array_key_exists('type', $data)){
//                            $share= new SharedProducts();
//                            $share->product_id = $data['product_id'];
//                            $share->invitee_id = $data['invitee_id'];
//                            $share->inviter_id = $data['inviter_id'];
//                            $share->store_id = $data['store_id'];
//                            $share->share_status='shared';
//                            $share->type = 'Company Network';
//                            $share->imported='no';
//                            if($share->save()) {
//                                return 'shared';
//                            }
//                            else {
//                                return 'notshared';
//                            }
//                        }
//                        else {
//                            $share= new SharedProducts();
//                            $share->product_id = $data['product_id'];
//                            $share->invitee_id = $data['invitee_id'];
//                            $share->inviter_id = $data['inviter_id'];
//                            $share->store_id = $data['store_id'];
//                            $share->share_status='shared';
//                            $share->type = 'Ecosystem';
//                            $share->imported='no';
//                            if($share->save()) {
//                                return 'shared';
//                            }
//                            else {
//                                return 'notshared';
//                            }
//                     }  
//                 }
//            }
//        } 
//        catch (Exception $e) {
//              return Response::json ( array (
//                  'error' => true,
//                  'data' => $e
//              ), 200 );
//        } 
//    }
    
    public function unshareProduct(){
        try {
            if(Request::ajax()){
                
                $data = Request::all();
                
                if(array_key_exists('type', $data)) {
                    $unshared= SharedProducts::where('product_id','=',$data['product_id'])->where('invitee_id','=',$data['invitee_id'])->where('type','=','Company Network')->first();
                }
                else {
                    $unshared= SharedProducts::where('product_id','=',$data['product_id'])->where('invitee_id','=',$data['invitee_id'])->where('type','=','Ecosystem')->first();
                }
                
                
                $unshared->share_status = 'unshared';
                if($unshared->save()){
                    return 'unshared';
                }
                else 
                {
                    return 'notunshared';
                }
            }
        }
        catch (Exception $e) {
              return Response::json ( array (
                  'error' => true,
                  'data' => $e
              ), 200 );
        } 
    }
    
    
//    public function shareThisProduct(){
//        if(Auth::user()) {
//            try {
//              $values = Request::all();
//              $userid = Auth::id();
//              $shopid = $values['shop_id'];
//              $product_id = $values['product_id'];
//              $fm_data = FieldMaster::where('title', '=', 'personal_sites_new')->first();
//
//              $check_site = ShareSite::where('siteslug','=',$shopid)->where('type','!=','Company Network' )->first();
//
//              if(!empty($check_site)) {
//                  $sites = ShareSite::where('inviter_id','=',$userid)->get();
//                  foreach($sites as $site){
//                      $invited_sites[$site->siteslug] = $site->siteslug;
//                  }
//
//                  return view('site.list_shared_sites',compact('fm_data','invited_sites','shopid','product_id'));
//              }
//              else {
//                  return redirect()->back()->with('message','This site has not been shared');
//              }
//            }
//            catch (\Exception $e){
//                $error = "An error occured. ".
//                                "Line Number: ".$e->getLine()." ".
//                                "File Name: ".$e->getFile()." ".
//                                "Error Description: ".$e->getMessage();
//                return view('errors.custom_error')->withErrors($error);
//            }
//        }
//        else 
//        {
//             return redirect('auth/login')->with('message',"Please Login to Add Information!"); 
//        }
//    }
//    
//    
//    public function storeSharedProduct(){
//        
//        $data= Request::all();
//        
//        $storeid= $data['store_id'];
//        
//        $product_id= $data['product_id'];
//        
//        $check= SharedProducts::where('store_id','=',$storeid)->where('product_id','=',$product_id)->first();
//        
//        if(empty($check))
//        {
//            $site_data = ShareSite::where('inviter_id','=',Auth::id())->where('siteslug','=',$storeid)->first();
//            $share= new SharedProducts();
//            $share->product_id = $product_id;
//            $share->store_id = $storeid;
//            $share->invitee_id = $site_data->invitee_id;
//            $share->invitee_name = $site_data->invitee_name;
//            $share->inviter_id = $site_data->inviter_id;
//            $share->share_status='shared';
//            $share->imported='no';
//            if($share->save()){
//                return redirect('/site/'.$storeid.'/show/'.$product_id)->with('message','Product Successfully Shared with the Site'); 
//            }
//            else
//            {
//               return redirect('/site/'.$storeid.'/show/'.$product_id)->with('message','Product Could not be shared! Please Try Again');
//            }
//        }
//        else 
//        {
//            return redirect('/site/'.$storeid.'/show/'.$product_id)->with('message','Product Already shared with this Site!');
//        }
//        
//        
//        
//        
//    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

       /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {       
           
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
