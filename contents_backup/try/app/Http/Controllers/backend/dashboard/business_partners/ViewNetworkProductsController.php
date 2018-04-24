<?php

namespace Gdoox\Http\Controllers\backend\dashboard\business_partners;

use Illuminate\Http\Request;
use Gdoox\Models\Products;
use Gdoox\Models\BusinessEcommerceCompany;
use Illuminate\Support\Facades\Auth;
use Gdoox\Models\BusinessInfo;
use Illuminate\Support\Facades\Redirect;
use Gdoox\Http\Requests;
use Gdoox\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Gdoox\Models\NavigationMenu;

class ViewNetworkProductsController extends Controller
{
  
    use  \Gdoox\Helpers\backend\dashboard\HelperFunctions;    
    use  \Gdoox\Helpers\backend\dashboard\RolesUsers;
    
    public function __construct() {
        $this->middleware('subuserpermission');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        try {
            if(Auth::user()){
                $site = array();
                
                $product_types = ['cross_selling', 'up_selling', 'bundle/combo','opportunities','multi_item'];
                
                $data = $request->input('site_slug');
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('parent', '7')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();
                
                $networksites =  BusinessEcommerceCompany::where('type', 'Company Network Site')->where('user_id', Auth::user()->id)->get();
                
                if($networksites->count()){
                    foreach($networksites as $network){
                        $site['site_name']['all'] = "All";
                        $site['site_name'][$network->network_site] = $network->network_site;
                    }
                }
                
                if($data){
                    $projections = array('shopid','desc', 'thumb','postdate','status','thumb_path', 'product_images', 'product_data.47', 'product_data.48', 'product_data.49','old_slug');
                    $term['term'] = 1;
                    if($data=='all'){
                        foreach($networksites as $network){
                            $slug[] = $network->network_site;
                        }
                        
                        $products =  Products::whereNotIn('product_type',$product_types)->whereIn('shopid', $slug)->where('network','!=','Ecosystem')->paginate(25, $projections);
                    }
                    else {
                        $products =  Products::whereNotIn('product_type',$product_types)->where('shopid','=', $data)->where('network','!=','Ecosystem')->paginate(25, $projections);
                        $slug = $network->network_site;
                    }
                }
                else {
                    $term['term'] = 0;
                }
                
                return view('backend.dashboard.business_partners.import_products.index',compact('route','nav_menu','networksites','site','data','products','term','data','slug'));
            }
            else {
                return redirect('auth/login')->with('message',"You must be login!"); 
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }

    
    public function indexAllProducts(Request $request){
        try {
            if(Auth::user()){
                $slug = array();
                $site = array();
                $projections = array('shopid','desc', 'thumb','postdate', 'status', 'thumb_path');
                $ecosystem = $request->get('sub_user_sites');
                if(!empty($ecosystem)){
                    foreach ($ecosystem as $eco){
                      $site['site_name']['all']="All";
                      $site['site_name'][$eco] = $this->SiteName($eco);
                      $slug[] = $eco;
                    }
                }
                else {
                    $ecosystem=  BusinessEcommerceCompany::where('type', '!=', 'business_ecosystem')->where('user_id', Auth::user()->id)->get();
                    if($ecosystem->count()){
                        foreach($ecosystem as $eco){
                            $site['site_name']['all']="All";
                            $site['site_name'][$eco->slug]=$eco->ecomm_company_name;
                            $slug[] = $eco->slug;
                        }
                    }
                }
                
                $data = $request->input('site_slug');

                if($data){
                    $term['term'] = 1;
                    if($data == 'all' ){
                        $products = Products::whereIn('shopid', $slug)->where('product_type', 'exists', false)->paginate(25, $projections);
                    }
                    else {
                      $products = Products::where('shopid','=', $data)->where('product_type', 'exists', false)->paginate(25, $projections);
                    }
                }
                else {
                    $term['term'] = 0;
                    $products =  Products::whereIn('shopid', $slug)->where('product_type', 'exists', false)->paginate(25, $projections);
                }
                return view('backend.catalog.products.index',compact('ecosystem','site','data','products','term','data','slug'));
            }
            else {
                return redirect('auth/login')->with('message',"You must be login!"); 
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        } 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    
    public function errorMessage($e){
        $error = "An error occured. ".
            "Line Number: ".$e->getLine()." ".
            "File Name: ".$e->getFile()." ".
            "Error Description: ".$e->getMessage(); 
        return $error;
    }
}
