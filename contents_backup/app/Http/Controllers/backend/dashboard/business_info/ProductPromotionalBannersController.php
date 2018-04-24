<?php

namespace Gdoox\Http\Controllers\backend\dashboard\business_info;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Gdoox\Models\FieldMaster;
use Gdoox\Models\BusinessEcommerceCompany;
use Gdoox\Models\Products;
use Gdoox\Models\SiteLogo;
use Gdoox\Models\SiteHeaderImage;
use Gdoox\Models\EcomShops;
use Gdoox\Models\CmsSite;
use Gdoox\Models\CertificationLogos;
use Gdoox\User;
use Gdoox\SubUser;
use Gdoox\Models\ProductPromotionalBanner;
use Gdoox\Models\BusinessInfo;
use Gdoox\Http\Requests;
use Gdoox\Http\Controllers\Controller;
use Gdoox\Models\NavigationMenu;
use Illuminate\Support\Facades\Route;

class ProductPromotionalBannersController extends Controller
{
  use \Gdoox\Helpers\backend\dashboard\ImageUpload;
  use \Gdoox\Helpers\backend\dashboard\RolesUsers;
  use \Gdoox\Helpers\backend\dashboard\HelperFunctions;
  /*
   * Add Product for mini banner 
   */
  public function SelectProduct(){
    if(Auth::user()){
      try{
            $required="*";
            $products=  Products::where('userid', Auth::user()->id)->where('status', '!=', 'disabled')->get();
            
            $role = $this->getRoleName(Auth::user()->id);
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'MARKETING')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
            
            return view('backend.dashboard.business_info.product_promo_banners.add_product', compact('products','nav_menu','route'));
      }
      catch (\Exception $e){
          $error = "An error occured. ".
                          "Line Number: ".$e->getLine()." ".
                          "File Name: ".$e->getFile()." ".
                          "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
      }
    }
    else{
              return redirect('auth/login')->with('message',"You must be login!"); 
    }
  }

  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
      if(Auth::user()){
        try {
            $role = $this->getRoleName(Auth::user()->id);
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'MARKETING')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
                
            $product_promos=  ProductPromotionalBanner::where('user_id', Auth::user()->id)->paginate(25);          
            return view('backend.dashboard.business_info.product_promo_banners.index', compact('route','nav_menu','product_promos'));
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
              return redirect('auth/login')->with('message',"You must be login!"); 
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id) {
      if(Auth::user()){
            $required="*";
            
            $role = $this->getRoleName(Auth::user()->id);
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'MARKETING')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
            
            return view('backend.dashboard.business_info.product_promo_banners.create', compact('nav_menu','route','id','required'));
      }
      else {
              return redirect('auth/login')->with('message',"You must be login!"); 
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      try {
        $data=$request->all();
        $check=  ProductPromotionalBanner::where('product_id', $data['product_id'])->where('user_id', Auth::user()->id)->first();
        if(!empty($check)){
            return redirect()->back()->withErrors('Product have already a promotional banner');
        }
        $product_promo = new ProductPromotionalBanner();
        $product_promo->user_id = $data['user_id'];
        $product_promo->product_id = $data['product_id'];
        $product_promo->site_slug = $this->productSiteName($data['product_id']);
        $product_promo->company_id = $this->CompanyId($this->productSiteName($data['product_id']));
        $product_promo->product_name = $this->productName($data['product_id']);
        $product_promo->product_promo_text = $data['product_promo_text'];
        $product_promo->banner_bg_color = $data['banner_bg_color'];
        $product_promo->product_promo_text_color = $data['product_promo_text_color'];
        if(isset($data['status']) && $data['status'] === 'enabled'){
            $product_promo->status =  'enabled';
            if($product_promo->save()){
                return Redirect::route('product_promo.index')->with('message', 'Product promotional banner created');
            }
        }
        $product_promo->status =  'disabled';
        if($product_promo->save()){
            return Redirect::route('{shopid}/show/', [$product_promo->site_slug, $product_promo->product_id, 'preview' => 'banner']);
        }
      }
      catch (\Exception $e){
          $error = "An error occured. ".
                          "Line Number: ".$e->getLine()." ".
                          "File Name: ".$e->getFile()." ".
                          "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
      }
    }
/*
 * 
 * Product promo banner preview
 */
//    public function ProductPromoPreview($shopid, $id){

        //  return view('backend.catalog.products.show', compact('productTabs','product', 'product_promo'));
//   }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      if(Auth::user()){
        try{
            $role = $this->getRoleName(Auth::user()->id);
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'MARKETING')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
            
            $products_promo= ProductPromotionalBanner::where('_id', $id)->first();
            $required="*";
   //       print_r($products_promo); die;
           return view('backend.dashboard.business_info.product_promo_banners.edit', compact('route','nav_menu','products_promo', 'required') );
        }
        catch (\Exception $e){
            $error = "An error occured. ".
                "Line Number: ".$e->getLine()." ".
                "File Name: ".$e->getFile()." ".
                "Error Description: ".$e->getMessage();
            return view('errors.custom_error')->withErrors($error);
        }
      }
      else{
              return redirect('auth/login')->with('message',"You must be login!"); 
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
      try {
        $data= ProductPromotionalBanner:: find($id);
        ProductPromotionalBanner:: where('_id', $id)->update($request->all());
//      return Redirect::route('product_promo.edit', $id);
        return Redirect::route('{shopid}/show/', [$data->site_slug, $data->product_id]);
      }
      catch (\Exception $e){
          $error = "An error occured. ".
            "Line Number: ".$e->getLine()." ".
            "File Name: ".$e->getFile()." ".
            "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
      }
    }
    /*
     * 
     */
    public function toggle($id, $status){
      try{
            $data_product_promo= ProductPromotionalBanner::where('_id', $id)->first();
            $data_product_promo->status=$status;
            if($data_product_promo->save()){
                return Redirect::route('product_promo.index')->with('message', "Banner status ".$status);
            }
      }
      catch (\Exception $e){
          $error = "An error occured. ".
                          "Line Number: ".$e->getLine()." ".
                          "File Name: ".$e->getFile()." ".
                          "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
      }
    }
}
