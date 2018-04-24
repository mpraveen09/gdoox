<?php

namespace Gdoox\Http\Controllers\backend\catalog\products;

use Illuminate\Http\Request;
use Gdoox\Models\Products;
use Gdoox\Models\AttributesAssoc;
use Gdoox\Models\Attributes;
use Gdoox\Models\AttributesType;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Gdoox\Models\EcomShops;
use Gdoox\Http\Requests;
use Gdoox\Models\DropdownOptions;
use Gdoox\Http\Controllers\Controller;
use Gdoox\Models\NavigationMenu;
use Illuminate\Support\Facades\Route;
use Form;
use DB;
use Image;
use Input;
use UUID;

class OpportunitiesController extends Controller
{
    use \Gdoox\Helpers\backend\dashboard\HelperFunctions;
    use \Gdoox\Helpers\backend\dashboard\RolesUsers;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
      if(Auth::user()){
        try {
            $product_name = array();
            
            $role = $this->getRoleName(Auth::user()->id);
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'MARKETING')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
          
            $products = Products::where('userid', '=', Auth::user()->id )->where('product_type', '=', 'opportunities')->paginate(25);
            
            foreach ($products as $product){
                $product_name[] = $this->productName($product->original_id);
                $site_name[] = $this->SiteName($product->shopid);
            }
          return view('backend.catalog.products.opportunities.index', compact('nav_menu','route','products', 'product_name', 'site_name'));
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
    /*
     *List All Products 
     */
    public function products(){
      if(Auth::user()){
        try{
            $role = $this->getRoleName(Auth::user()->id);
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'MARKETING')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
            
            $products = Products::where('userid', '=', Auth::user()->id )->where('product_type', 'exists', false)->where('status', '!=', 'disabled')->paginate(25);
            return view('backend.catalog.products.opportunities.products', compact('products','nav_menu','route'));
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
    /*
     * Manage product
     */
    public function manage($id){
        if(Auth::user()){
          try {
                $role = $this->getRoleName(Auth::user()->id);
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'MARKETING')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();

                $product = Products::find($id);
                foreach($product->product_data as $attrkey=>$attrval){
                    $temporary[]=  Attributes::where('attr_id', '=', strval($attrkey))->where('class', '=', "PZ")->first();
                }

                $attributes = array_filter($temporary);
                return view('backend.catalog.products.opportunities.manage', compact('product', 'attributes','nav_menu','route'));
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
  /*
   * Extract Opportunity Product
   */
    public function extract($id){
        if(Auth::user()){
          try{
            $old_product = Products::find($id);
            $product = new Products();
            $product->original_id = $old_product->id;
            $product->userid = Auth::user()->id;
            $product->desc = $old_product->product_data[3];
            $product->shopid = $old_product->product_data[2];
            $product->company_id = $this->CompanyId($old_product->product_data[2]);
            $product->postdate = $old_product->product_data[1];
            $product->postedby = Auth::user()->id;
            $product->thumb = $old_product->thumb;
            $product->thumb_path = $old_product->thumb_path;
            $product->cat_ids = $old_product->cat_ids;
            $product->product_data = $old_product->product_data;
            $product->product_type = "opportunities";
            $product->status = "disabled";
            $product->shared_in = "";
            if($product->save()){
                return Redirect::route('opportunities.create', $product->id);
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
       else{
            return redirect('auth/login')->with('message',"You must be login!"); 
      }
    }
    /*
     * Create Opportunity
     */
    public function create($id){
      try{
          
        $role = $this->getRoleName(Auth::user()->id);
        $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'MARKETING')->where('lang','en')->get();
        $route = Route::getCurrentRoute()->getName();
            
        $product =  Products::find($id);
        foreach($product->product_data as $attrkey => $attrval){
            $temporary[] = Attributes::where('attr_id', '=', strval($attrkey))->where('class', '=', "PZ")->first();
        }
        $attributes = array_filter($temporary);
        foreach($attributes as $attrib){
            if($attrib->attr_id != 78){
                $opt = array();
                if($attrib->field_type === "TD" || $attrib->field_type === "TM" ){
                    $dropopt =  DropdownOptions::where('_id', $attrib->dropdown_list )->where('lang', '=', 'en')->first();
                    if(count($dropopt )){
                        foreach ($dropopt->options as $dropopt_) {
                            $opt[$dropopt_]=$dropopt_;
                        }
                    }
                }
                $form[] = $this->createProductFormFields("attr_id[".$attrib->attr_id."]", $attrib->label, $desc="", $attrib->field_type, $attrib->len, $attrib->class, $attrib->req,$opt, $val="",$disabled="", $fieldinfo ="", $product, $attrib->attr_id);
            }
        }
        
        $field['shop_id'] = $this->FetchAttributes("2");
        $field['post_date'] =  $this->FetchAttributes("1");
        $field['product_name'] =  $this->FetchAttributes('3');
        $field['part_no'] = $this->FetchAttributes("4"); 
        $field["seller_ref_code"] = $this->FetchAttributes("308");
                
        $sites =  EcomShops::where('user_id', Auth::user()->id)->get();
        $site = array();
        foreach($sites as $esite){
          $site[$esite->slug] = $esite->ecomm_company_name;
        }
//         print_r($form);
        return view('backend.catalog.products.opportunities.create', compact('nav_menu','route','product', 'attributes', 'field', 'site', 'form'));
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
     * Save Opportunity
     */
    public function save(Request $request, $id){
      try{
        $data = $request->all();
        
        $product = Products::find($id);
        $product->desc = $data['attr_id'][3];
        $product->shopid = $data['attr_id'][2];
        $product->company_id = $this->CompanyId($data['attr_id'][2]);
        $product->postdate = $data['attr_id'][1];
        $product->postedby = Auth::user()->id;
        $product->start_date = $data['opportunity_start_date'];
        $product->end_date = $data['opportunity_end_date'];
        
        $product->old_b2b_price = $data['attr_id'][15];
        $product->old_b2c_price = $data['attr_id'][16];
        
        $temp = $product->product_data;
        foreach ($data['attr_id'] as $key => $val){
            $temp[$key] = $val;
        }
        
        $temp[15] = $data['new_price_b2b'];
        $temp[16] = $data['new_price_b2c'];
        
        $product->product_data = $temp;
        
        if($product->save()){
           return Redirect::route('opportunities.index')->with('message', 'Opportunity created');
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
     * site enable or disable
     */
    
    public function toggle($id){
      if(Auth::user()){
        try{
            $product = Products::find($id);
            if(empty($product->start_date) || empty($product->end_date)) {
                return redirect()->back()->withErrors('You can not enable this product without start date and end date. Please fill the start date and end date');
            }

            if($_GET['status'] === "enabled") {
               DB::collection('products')->where('_id', $id)->update(['status'=>$_GET['status'], 'disable_edit'=>'Yes']);
             }
             else {
               DB::collection('products')->where('_id', $id)->update(['status'=>$_GET['status']]);
             }
              return Redirect::route('opportunities.index')->with('message', "Opportunity product has been ".$_GET['status']);
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

}
