<?php

namespace Gdoox\Http\Controllers\backend\dashboard;

use Illuminate\Http\Request;
use Gdoox\Models\Products;
use Gdoox\Models\BusinessEcommerceCompany;
use Illuminate\Support\Facades\Auth;
use Gdoox\Models\BusinessInfo;
use Illuminate\Support\Facades\Redirect;
use Gdoox\Http\Requests;
use Gdoox\Http\Controllers\Controller;
use Gdoox\Models\NavigationMenu;
use Illuminate\Support\Facades\Route;
use Gdoox\Models\AttributesAssoc;
use Gdoox\Http\Controllers\backend\catalog\products\ProductsController;
use Illuminate\Support\Facades\Input;

class ViewProductsController extends Controller
{
  
    // use \Gdoox\Helpers\backend\dashboard\HelperFunctions;    
    use \Gdoox\Helpers\backend\dashboard\RolesUsers;
    use \Gdoox\Helpers\backend\dashboard\AddProductFunctions;
    
    
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
                $data = $request->input('site_slug');
                
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('parent', '36')->where('group','business_ecosystem')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();
                
                $ecosystem = BusinessEcommerceCompany::where('type', 'business_ecosystem')->where('user_id', Auth::user()->id)->get();
                if($ecosystem->count()){
                    foreach($ecosystem as $eco){
                        $site['site_name']['all'] = "All";
                        $site['site_name'][$eco->slug] = $eco->ecomm_company_name;
                    }
                }
                
                if($data){
                    $projections = array('shopid','desc', 'thumb','postdate', 'thumb_path', 'product_images', 'product_data.47', 'product_data.48', 'product_data.49','status','old_slug');
                    $term['term'] = 1;
                    if($data=='all'){
                        foreach($ecosystem as $eco){
                              $slug[] = $eco->slug;
                        }
                        $products = Products::whereIn('shopid', $slug)->paginate(25, $projections);
                    }
                    else {
                        
                        $products = Products::where('shopid','=', $data)->paginate(25, $projections);
                        $slug = $eco->slug;
                    }
                }
                else {
                    $term['term'] = 0;
                }
                
                return view('backend.dashboard.business_partners.products.index',compact('route','nav_menu','ecosystem','site','data','products','term','data','slug'));
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

    
    
    public function indexAllProducts(Request $request, $purpose=""){
        try { 
            if(Auth::user()){
                $slug = array();
                $limit = 20 ;
                $siteslug = $keyword = '';
                
                $data = $request->all();
                $site['site_name'] = array();
                $projections = array('shopid','desc', 'thumb','postdate', 'status', 'thumb_path','product_images','type','purpose');

                $ecosystem = $request->get('sub_user_sites');
                if(!empty($ecosystem)){
                    foreach ($ecosystem as $eco){
                      $site['site_name']['all']="All";
                      $site['site_name'][$eco] = $this->SiteName($eco);
                      $slug[] = $eco;
                    }
                }
                else {
                    $ecosystem = BusinessEcommerceCompany::where('type', '!=', 'business_ecosystem')->where('user_id', Auth::user()->id)->get();
                    if($ecosystem->count()){
                        foreach($ecosystem as $eco){
                            $site['site_name']['all']="All";
                            $site['site_name'][$eco->slug]=$eco->ecomm_company_name;
                            $slug[] = $eco->slug;
                        }
                    }
                }
                $builder = Products::query();
                if(isset($data['site_slug'])){
                    $siteslug = $data['site_slug'];
                    if($siteslug==='all'){
                        $builder->whereIn('shopid', $slug);
                    }
                    else {
                        if(!empty($siteslug)){
                            $builder->where('shopid', $siteslug);
                        }
                        else {
                            $builder->where('shopid', $slug);
                        }
                    }
                }
                else {
                    $builder->whereIn('shopid', $slug);
                }

                if(isset($data['keyword'])){
                    $keyword = $data['keyword'];
                    if(!empty($keyword)){
                        $product_desc = '%'.trim($keyword).'%';
                        $builder->where('desc','like', $product_desc)->orWhere('product_data.3','like',$product_desc)->orWhere('product_data.6','like',$product_desc)->orWhere('product_data.7','like',$product_desc);
                    }
                }
                
                if(!empty($purpose)){
                    $builder->where('purpose', 'buy');
                }
                else {
                    $builder->where('purpose', 'sell');
                }

                $products = $builder->orderBy('_id')->where('product_type', 'exists', false)->paginate($limit, $projections);


                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('parent', '61')->where('group','product_management')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();

                return view('backend.catalog.products.index',compact('nav_menu','route','ecosystem','site','data','products','slug','siteslug','keyword','purpose'));
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
    
//    public function indexAllProcurements(Request $request){
//        try { 
//            if(Auth::user()){
//                $slug = array();
//                $limit = 20 ;
//                $siteslug = $keyword = '';
//                
//                $data = $request->all();
//                $site['site_name'] = array();
//                $projections = array('shopid','desc', 'thumb','postdate', 'status', 'thumb_path','product_images','type');
//
//                $ecosystem = $request->get('sub_user_sites');
//                if(!empty($ecosystem)){
//                    foreach ($ecosystem as $eco){
//                      $site['site_name']['all']="All";
//                      $site['site_name'][$eco] = $this->SiteName($eco);
//                      $slug[] = $eco;
//                    }
//                }
//                else {
//                    $ecosystem = BusinessEcommerceCompany::where('type', '!=', 'business_ecosystem')->where('user_id', Auth::user()->id)->get();
//                    if($ecosystem->count()){
//                        foreach($ecosystem as $eco){
//                            $site['site_name']['all']="All";
//                            $site['site_name'][$eco->slug]=$eco->ecomm_company_name;
//                            $slug[] = $eco->slug;
//                        }
//                    }
//                }
//
//                $builder = Products::query();
//                if(isset($data['site_slug'])){
//                    $siteslug = $data['site_slug'];
//                    if($siteslug==='all'){
//                        $builder->whereIn('shopid', $slug);
//                    }
//                    else {
//                        if(!empty($siteslug)){
//                            $builder->where('shopid', $siteslug);
//                        }
//                        else {
//                            $builder->where('shopid', $slug);
//                        }
//                    }
//                }
//                else {
//                    $builder->whereIn('shopid', $slug);
//                }
//
//                if(isset($data['keyword'])){
//                    $keyword = $data['keyword'];
//                    if(!empty($keyword)){
//                        $product_desc = '%'.trim($keyword).'%';
//                        $builder->where('desc','like', $product_desc)->orWhere('product_data.3','like',$product_desc)->orWhere('product_data.6','like',$product_desc)->orWhere('product_data.7','like',$product_desc);
//                    }
//                }
//
//                $products = $builder->orderBy('_id')->where('product_type', 'exists', false)->where('purpose','buy')->paginate($limit, $projections);
//
//                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('parent', '61')->where('group','product_management')->where('lang','en')->get();
//                $route = Route::getCurrentRoute()->getName();
//
//                return view('backend.catalog.products.index_procurements',compact('nav_menu','route','ecosystem','site','data','products','slug','siteslug','keyword'));
//            }
//            else {
//                return redirect('auth/login')->with('message',"You must be login!"); 
//            }
//        }
//        catch(\Exception $e){
//            $errors = $this->errorMessage($e);
//            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
//        } 
//    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
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
    public function destroy($id){
        //
    }
    
    public function createDuplicateProduct($product_id){
        if(Auth::user()){
            return view('backend.catalog.products.duplicate_product',compact('product_id'));
        }
        else {
            return redirect('auth/login')->with('message',"You must be login!"); 
        }
    }
    
    public function saveDuplicateProduct($prodid){
        $data = Input::all();        
        $productdata = Products::where('_id','=', $prodid)->first();

        $prod_data = array();
        
        foreach($productdata->product_data as $key=>$value){
            if($key=='3') {
                $prod_data[$key] = $data['attr_id'][3];
            }
            elseif($key=='4') {
                $prod_data[$key] = $data['attr_id'][4];
            }
            else {
                if(is_array($value)){
                     $prod_data[$key] = $value;
                }
                else {
                     $prod_data[$key]= $value;
                }
            }
        }
        
        $product = new Products();
        $product->userid = Auth::user()->id;
        $product->user_id = Auth::user()->id;
        $product->desc = $data['attr_id'][3];
        $product->company_id = $productdata->company_id;
        $product->postedby = $productdata->postedby;
        $product->purpose = $productdata->purpose;
        $product->thumb = $productdata->thumb;
        $product->thumb_path = $productdata->thumb_path;
        $product->product_images = $productdata->product_images;
        $product->postdate = $productdata->postdate;
        $product->product_id = $prodid;
        $product->product_data = $prod_data;
        $product->old_slug = $productdata->shopid;
        $product->shopid = $productdata->shopid;
        $product->cat_ids = $productdata->cat_ids;
        $product->status = "disabled";
        $product->disable_edit="Yes";
        $product->duplicate = 'duplicate';
        $product->type = 'temporary';
        
        if($product->save()){
            $productid = Products::where('product_id','=', $prodid)->where('userid','=',Auth::user()->id)->where('duplicate','=','duplicate')->first();
            return Redirect::route('product.edit', $productid->_id);
        }
        else {
            return redirect()->back()->with('message','Product could not be Duplicated! Please try Again');
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
