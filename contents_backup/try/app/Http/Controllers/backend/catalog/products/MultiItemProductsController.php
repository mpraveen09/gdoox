<?php

namespace Gdoox\Http\Controllers\backend\catalog\products;

use Illuminate\Support\Facades\Request;
//use Illuminate\Http\Request;

use DB;
use Gdoox\Models\Products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Gdoox\Models\Attribute;
use Gdoox\Models\AttributesType;
use Gdoox\Models\FieldMaster;
use Gdoox\Models\DropdownOptions;
use Gdoox\Models\Categories;
use Gdoox\Models\CategoryAttribute;
use Gdoox\Models\EcomShops;
use Gdoox\Http\Requests;
use Gdoox\Http\Controllers\Controller;
use Gdoox\Models\ProductHiddenAttributes;
use Gdoox\Models\NavigationMenu;
use Illuminate\Support\Facades\Route;
use Form;

class MultiItemProductsController extends ProductsController
{
  use \Gdoox\Helpers\backend\dashboard\HelperFunctions;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
    private $language;
    public function __construct(){
        $this->language = session('app_language');
    }
    
    public function indexing(){
      if(Auth::user()){
        try {
                $action = Request::route()->getAction();
                $product_type['type'] = $action['type'];
                switch ($product_type['type']) {
                  case "multi_item":
                      $product_type['title'] = "Multi-Item";
                      break;
                  case "cross_selling":
                      $product_type['title'] = "Cross-Selling";
                      break;
                  case "up_selling":
                      $product_type['title'] = "Up-Selling";
                      break;
                  case "bundle/combo":
                      $product_type['title'] = "Bundle/Combo";
                      break;
                } 
                
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('parent', '61')->where('group','product_management')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();
                
                $MultiItemProducts = Products::where('userid', Auth::user()->id)->where('product_type', '=', $product_type['type'])->paginate(25);

                $field['shop_id'] = $this->FetchAttributes("6006");
                $field['post_date'] =  $this->FetchAttributes("1");
                $field['product_name'] =  $this->FetchAttributes('3');
                $business_sites = EcomShops::where('user_id', '=', Auth::user()->id)->get();
                foreach ($business_sites as $value) {
                    $sites[$value->slug] = $value->ecomm_company_name;
                }
                $term = Request::input('term');
                if(!empty($term)){
                  $MultiItemProducts= Products::where('shopid', $term)
                      ->where('userid', Auth::user()->id)
                      ->where('product_type', $product_type['type'])
                      ->orderBy('postdate')->paginate(25);
                }
          
          return view('backend.catalog.products.multi_items.index', compact('nav_menu','route','MultiItemProducts', 'field', 'product_type', 'term', 'sites'));
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
      if(Auth::user()){
        try {
          $action = Request::route()->getAction();
          $product_type['type']=$action['type'];
                switch ($product_type['type']) {
          case "multi_item":
              $product_type['title'] = "Multi-Item";
              break;
          case "cross_selling":
              $product_type['title'] = "Cross-Selling";
              break;
          case "up_selling":
              $product_type['title'] = "Up-Selling";
              break;
          case "bundle/combo":
              $product_type['title'] = "Bundle/Combo";
              break;
        } 

            $field['shop_id'] = $this->FetchAttributes("6006");
            $field['post_date'] =  $this->FetchAttributes("1");
            $field['product_name'] =  $this->FetchAttributes('3');
          
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('parent', '61')->where('group','product_management')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
          
            $sites =  EcomShops::where('user_id', Auth::user()->id)->get();
            $site = array();
            foreach($sites as $esite){
                  $site[$esite->slug] = $esite->ecomm_company_name;
            }
          
          return view('backend.catalog.products.multi_items.create', compact('route','nav_menu','field', 'site', 'product_type'));
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeMultiItem(){
      if(Auth::user()){
        try{
          $action = Request::route()->getAction();
          $product_type['type'] = $action['type'];
          switch ($product_type['type']) {
            case "multi_item":
                $product_type['title'] = "Multi-Item";
                break;
            case "cross_selling":
                $product_type['title'] = "Cross-Selling";
                break;
            case "up_selling":
                $product_type['title'] = "Up-Selling";
                break;
            case "bundle/combo":
                $product_type['title'] = "Bundle/Combo";
                break;
          } 
          
          $data = Request::all();
          $multi_product = new Products();
          $multi_product->userid = $data['user_id'];
          $multi_product->shopid = $data['attr_id'][6006];
          $multi_product->postdate = $data['attr_id'][1];
          $multi_product->desc = $data['attr_id'][3];
          $multi_product->purpose=$data['prod_type'];
          $multi_product->product_data=$data['attr_id'];
          $multi_product->product_type= $product_type['type'];
          $multi_product->status='disabled';
          $multi_product->shared_in = "";

          if($multi_product->save() ) {
              return Redirect::route($product_type["type"].'.add_product', $multi_product->id);
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
     * Add products
     */
   
    public function AddProduct($id){
      if(Auth::user()){
        try {
            $action = Request::route()->getAction();
            $product_type['type']=$action['type'];
            switch ($product_type['type']) {
              case "multi_item":
                  $product_type['title']="Multi-Item";
                  break;
              case "cross_selling":
                  $product_type['title']="Cross-Selling";
                  break;
              case "up_selling":
                  $product_type['title']="Up-Selling";
                  break;
              case "bundle/combo":
                  $product_type['title']="Bundle/Combo";
                  break;
            }
          
            $multi_product =  Products::where('_id', $id)->first();
            
            if(!empty($multi_product->disable_quantity) && $multi_product->disable_quantity === "Yes"){
                return Redirect::route($product_type["type"].'.index')->with('message', "You can not add/remove products now");
            }
            
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('parent', '61')->where('group','product_management')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
            
            $products =  Products::where('userid', Auth::user()->id)->where('product_type', 'exists', false)->where('purpose', $multi_product->purpose)->where('status', '!=', 'disabled')->paginate(20);
            $term = Request::input('term');
            if(!empty($term)){
              $products = Products::where('desc', 'like', '%'.addslashes($term).'%')
                  ->where('userid', Auth::user()->id)
                  ->where('product_type', 'exists', false)
                  ->where('purpose', 'sell')
                  ->where('status', '!=', 'disabled')
                  ->orderBy('postdate')->paginate(20);
            }
           
          return view('backend.catalog.products.multi_items.add_product', compact('products', 'id', 'multi_product', 'product_type', 'term','nav_menu','route'));
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
     * Auto Search
     */
    public function AutoSearch() {
    try{
        if(Request::ajax()){
            $input = Request::all();
            $products= Products::where('desc', 'like', '%'.$input['term'].'%')
                                  ->where('userid', Auth::user()->id)
                                  ->where('product_type', 'exists', false)
                                  ->where('purpose', "sell")
                                  ->where('status', '!=', 'disabled')
                                  ->project( array('desc','postdate')) ->get();
            $i = 0;
            $response = array();
            foreach($products as $product){
                    $response[$i]['desc'] = $product['desc'];
                    $response[$i]['postdate'] = $product['postdate'];
                    $i++;
            }
            echo json_encode($response);
        }
    } 
    catch (Exception $e) {
          return Response::json ( array (
              'error' => true,
              'data' => $e
          ), 200 );
    }
}


    
    /*
     * Store Products
     */
    public function storeProduct(Request $request, $id){
      if(Auth::user()){
        $action = Request::route()->getAction();
        $product_type['type']=$action['type'];
        try {
            if(Request::ajax()){
                $data= Request::all();
                $product=  Products::where('_id', $data['product_id'])->first();
                $multi_products=  Products::find($id);
                DB::collection('products')->where('_id', $id)->push('cat_ids', $product->cat_ids);
                $temporary=$multi_products->multi_item_products;
                $temporary[]=$data['product_id'];
                $multi_products->multi_item_products=$temporary;
//                $multi_products=  Products::find($id);
                 foreach ($multi_products->multi_item_products as $multiproduct){
                   $products[]=  Products::where('_id', $multiproduct)->first();
                 }
                 foreach($products as $singleProduct){
                   $thumbs[] = $singleProduct->thumb;
                   $thumbs_path[] = $singleProduct->thumb_path;
                 }
                $multi_products->postedby=Auth::user()->id;
                $multi_products->thumb=$thumbs[0];
                $multi_products->thumb_path=$thumbs_path[0];
                $multi_products->thumbs=$thumbs;
                $multi_products->thumbs_path=$thumbs_path;
                if($multi_products->save()){
                  return 'Added';
                }
                else
                {
                    return 'Not Added';
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
        else{
             return redirect('auth/login')->with('message',"You must be login!"); 
        }
    }
    /*
     *Remove Product 
     */
    public function RemoveProduct($id){
      if(Auth::user()){
        $action = Request::route()->getAction();
        $product_type['type']=$action['type'];
          try {
                if(Request::ajax()){
                    $data= Request::all();

                   $product=  Products::where('_id', $data['product_id'])->first();
                   $multi_products=  Products::find($id);
                   $multi_products->cat_ids=array();
                   $multi_products->save();
                   DB::collection('products')->where('_id', $id)->pull('multi_item_products', [$data['product_id']]);
                   $multi_products=  Products::find($id);
                   $multi_items=$multi_products->multi_item_products;
                   if(!empty($multi_items)){
                       foreach ($multi_items as $item){
                         $allproducts[]= Products::where('_id', $item)->first();
                       }
                       foreach($allproducts as $prod){
                         $cat_ids[]=$prod->cat_ids[0];
                       }
                    }
                   else{
                       $cat_ids=array();
                   }
                   $multi_products->cat_ids=$cat_ids;
                   if($multi_products->save()){
                       return 'removed';
                   }
                   else
                   {
                       return 'Not Removed';
                   }
                  }
               } 
               catch (Exception $e) {
                     return Response::json ( array (
                         'error' => true,
                         'data' => $e
                     ), 200 );
               } 
      }else{
             return redirect('auth/login')->with('message',"You must be login!"); 
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editMultiItem($id){
      if(Auth::user()){
        try {
                $action = Request::route()->getAction();
                $product_type['type']=$action['type'];
                switch ($product_type['type']) {
                  case "multi_item":
                      $product_type['title']="Multi-Item";
                      break;
                  case "cross_selling":
                      $product_type['title']="Cross-Selling";
                      break;
                  case "up_selling":
                      $product_type['title']="Up-Selling";
                      break;
                  case "bundle/combo":
                      $product_type['title']="Bundle/Combo";
                      break;
                }
                
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('parent', '61')->where('group','product_management')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();

                $multiproduct = Products::find($id);
                if(!isset($multiproduct->multi_item_products) &&empty($multiproduct->multi_item_products)){
                    return Redirect::route($product_type["type"].'.add_product', $multiproduct->id)->with('message', "Please add products in ".$product_type["type"]."  product");
                }
                
                $attrAssoc = $this->fetchAttributesAssoc();
                //Fetch Attributes
                $multItemAttr= ProductHiddenAttributes::where('type','=','multiitem')->first();
                $attrForCats = $multItemAttr->attr_ids;
                sort($attrForCats);
        
                $formFields=array();
                $formFields[]= $this->createProductFormFields("userid", "", "", "hidden", "", "", "","", Auth::user()->id);
                foreach ($attrAssoc as $k=>$v) {
                  $formFieldsTemp=array();

                  foreach($attrForCats as $attrForCatk => $attrForCat){
                    $attributes = Attribute::where('attr_id', strval($attrForCat) )->where('class', '=', $k)->where('lang', '=', $this->language)->first();
                    $product = Products::find($id);
                    if(!empty($attributes)){
                      $attr_id=$attributes->attr_id;
                      if (strpos($attr_id,';') !== false || strpos($attr_id,'/') !== false) {
                          $disabled="disabled";
                      }else{
                        $disabled="";
                      }
                      if($attr_id === '2' || $attr_id === 2){
                        $siteslug = $this->getSites(Auth::user()->id);
                        $formFieldsTemp[] = $this->createProductFormFields("attr_id[$attr_id]", $attributes->label, $attributes->desc, "TD", $attributes->len, "attr_".$attributes->class, $attributes->req, $siteslug, "",$disabled,'',$product,$attr_id);
                      }else{

                        $opt=array();
                        if($attributes->field_type === "TD" || $attributes->field_type === "TM" ){
                            //echo $attributes->dropdown_list ;
                            $dropopt =  DropdownOptions::where('attr_id', $attributes->attr_id )->where('lang','=',$this->language)->first();
                            if(count($dropopt )){
                                foreach ($dropopt->options as $dropopt_) {
                                    $opt[$dropopt_]=$dropopt_;
                                }
                            }
                        }

                        //field type and length
                        $a_type= AttributesType::where('lang', '=', $this->language)->Where('id', '=', $attributes->field_type)->project(array('label'))->first();
                        $fieldinfo = "<br/><small><i>";
                        $fieldinfo .= $a_type->label;
                        if(!empty($attributes->len)){
                            $fieldinfo .= " (Length ". $attributes->len . ")";
                        }
                        $fieldinfo .= "</i></small>";
                        $formFieldsTemp[]= $this->createProductFormFields("attr_id[$attr_id]", $attributes->label, $attributes->desc, $attributes->field_type, $attributes->len, "attr_".$attributes->class, $attributes->req, $opt, "", $disabled, $fieldinfo, $product, $attr_id);
                      }                    
                    }                  
                  }

                if(!empty($formFieldsTemp)){
                      $formFields[] = '<div class="card">';
                      $formFields[] = '<div class="card-header bgm-bluegray"><h2>'.$v.'</h2></div>';// "<hr/><h4>$v</h4><hr/>";
                      $formFields[] = '<div class="card-body card-padding">';
                      foreach ($formFieldsTemp as $formFieldsTempV) {
                          $formFields[] = $formFieldsTempV;
                      }
                      //$formFields[] = $formFieldsTemp[];
                      $formFields[] = '</div></div>';
                    } 
                  } 
                  
           return view('backend.catalog.products.multi_items.add_multi_item_product', compact('route','nav_menu','formFields', 'product', 'product_type', 'multiproduct'));
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
//    public function updateMultiItem($id)
//    {
//      if(Auth::user()){
//        $action = Request::route()->getAction();
//        $product_type['type']=$action['type'];
//        $data=Request::all();
//        $multi_product = Products::find($id);
//        $multi_product->shopid = $data['attr_id'][2];
//        $multi_product->postdate = $data['attr_id'][1];
//        $multi_product->desc = $data['attr_id'][3];
//        $multi_product->product_data=$data['attr_id'];
//        if($multi_product->save() ){
//            return Redirect::route($product_type["type"].'.add_product', $multi_product->id);
//        }
//      }
//      else{
//             return redirect('auth/login')->with('message',"You must be login!"); 
//      }
//    }

    /*
     * Add Product Price
     */
    
    public function AddMultiItemDetails($id){
      if(Auth::user()){
        try{
            $action = Request::route()->getAction();
    //      print_r($action); die;  
            $product_type['type']=$action['type'];
            switch ($product_type['type']) {
              case "multi_item":
                  $product_type['title']="Multi-Item";
                  break;
              case "cross_selling":
                  $product_type['title']="Cross-Selling";
                  break;
              case "up_selling":
                  $product_type['title']="Up-Selling";
                  break;
              case "bundle/combo":
                  $product_type['title']="Bundle/Combo";
                  break;
            } 
            
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('parent', '61')->where('group','product_management')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
                
            $multiproduct = Products::find($id);
            if(!isset($multiproduct->multi_item_products) &&empty($multiproduct->multi_item_products)){
                return Redirect::route($product_type["type"].'.add_product', $multiproduct->id)->with('message', "Please add products in ".$product_type["type"]."  product");
            }
    //        print_r($product_type); die;  
            $attrAssoc = $this->fetchAttributesAssoc();
            //Fetch Attributes 
            $attrForCats = array();
            $multItemAttr= ProductHiddenAttributes::where('type','=','multiitem')->first();
            // $multItemAttr= MultiItemAttribute::first();
            $attrForCats = $multItemAttr->attr_ids;
            sort($attrForCats);

            $formFields = array();
            $formFields[] = $this->createProductFormFields("userid", "", "", "hidden", "", "", "","", Auth::user()->id);
            foreach ($attrAssoc as $k=>$v) {
              $formFieldsTemp=array();

              foreach($attrForCats as $attrForCatk => $attrForCat){
                $attributes = Attribute::where('attr_id', strval($attrForCat) )->where('class', '=', $k)->where('lang', '=', $this->language)->first();
      //          print_r($attributes); die;
                if(count($attributes)){
                  $attr_id=$attributes->attr_id;
                  if (strpos($attr_id,';') !== false || strpos($attr_id,'/') !== false) {
                        $disabled="disabled";
                  } else {
                        $disabled="";
                  }
                  $product = Products::find($id);
                  if($attr_id === '2' || $attr_id === 2){
                        $siteslug = $this->getSites(Auth::user()->id);
                        $formFieldsTemp[]= $this->createProductFormFields("attr_id[$attr_id]", $attributes->label, $attributes->desc, "TD", $attributes->len, "attr_".$attributes->class, $attributes->req,$siteslug, "",$disabled,'',$product,$attr_id);
                    }
                    else {
                        $opt = array();
                        if($attributes->field_type === "TD" || $attributes->field_type === "TM" ){
                            $dropopt =  DropdownOptions::where('attr_id', $attributes->attr_id )->where('lang', '=', $this->language)->first();
                            if(count($dropopt )){
                                foreach ($dropopt->options as $dropopt_) {
                                    $opt[$dropopt_]=$dropopt_;
                                }
                            }
                        }

                        //field type and length
                        $a_type= AttributesType::where('lang', '=', $this->language)->Where('id', '=', $attributes->field_type)->project(array('label'))->first();
                        $fieldinfo = "<br/><small><i>";
                        $fieldinfo .= $a_type->label;
                        if(!empty($attributes->len)){
                            $fieldinfo .= " (Length ". $attributes->len . ")";
                        }
                        $fieldinfo .= "</i></small>";
                        $formFieldsTemp[]= $this->createProductFormFields("attr_id[$attr_id]", $attributes->label, $attributes->desc, $attributes->field_type, $attributes->len, "attr_".$attributes->class, $attributes->req,$opt, "",$disabled, $fieldinfo, $product, $attr_id);
                  }                    
                }                  
              }

              if(!empty($formFieldsTemp)){
                  $formFields[] = '<div class="card">';
                  $formFields[] = '<div class="card-header bgm-bluegray"><h2>'.$v.'</h2></div>';// "<hr/><h4>$v</h4><hr/>";
                  $formFields[] = '<div class="card-body card-padding">';
                  foreach ($formFieldsTemp as $formFieldsTempV) {
                      $formFields[] = $formFieldsTempV;
                  }
                  //$formFields[] = $formFieldsTemp[];
                  $formFields[] = '</div></div>';
              } 
            }
            return view('backend.catalog.products.multi_items.add_multi_item_product', compact('formFields', 'product', 'product_type', 'multiproduct','nav_menu','route'));
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
     * Store Price
     */
    
    public function StoreMultiItemDetails($id){
      if(Auth::user()){
        try {
                $action = Request::route()->getAction();
                $product_type['type']=$action['type'];
                $product_type['type']=$action['type'];
                switch ($product_type['type']) {
                  case "multi_item":
                      $product_type['title']="Multi-Item";
                      break;
                  case "cross_selling":
                      $product_type['title']="Cross-Selling";
                      break;
                  case "up_selling":
                      $product_type['title']="Up-Selling";
                      break;
                  case "bundle/combo":
                      $product_type['title']="Bundle/Combo";
                      break;
                } 
                
                $data = Request::all();
                // $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('parent', '61')->where('group','product_management')->where('lang','en')->get();
                // $route = Route::getCurrentRoute()->getName();

      //        echo "<pre>";print_r($data); die;
                $multi_product=  Products::find($id);
                
//                echo "<pre>";
//                print_r($multi_product);
//                exit;
                
                foreach ($multi_product->multi_item_products as $multiproduct){
                    $products[] = Products::where('_id', $multiproduct)->first();
                }
                
                foreach($products as $singleProduct){
                  $thumbs[] = $singleProduct->thumb;
                }
                
                $multi_product->userid = $data['userid'];
                $multi_product->shopid = $data['attr_id'][2];
                $multi_product->postdate = $data['attr_id'][1];
                $multi_product->desc = $data['attr_id'][3];
                $multi_product->product_data=$data['attr_id'];
                $multi_product->status='disabled';
                $multi_product->shared_in = "";
                if($multi_product->save()){
                    return Redirect::route($product_type["type"].'.index')->with('message', $product_type["title"]." product created");
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
     * Add Product Quantity
     */
    
//    public function AddQuantity($id){
//      if(Auth::user()){
//        $action = Request::route()->getAction();
//        $product_type['type']=$action['type'];
//        $multi_item_product = Products::find($id);
//        $field['quantity']= $this->FetchAttributes("8");
//        
//        return view('backend.catalog.products.multi_items.add_quantity', compact('field', 'site', 'multi_item_product', 'id'));
//      }
//      else{
//             return redirect('auth/login')->with('message',"You must be login!"); 
//      }
//    }
    /*
     * Store Quantity
     */
    
//    public function StoreQuantity($id){
//      if(Auth::user()){
//        $data= Request::all();
//        $item[] = $data['attr_id'];
//        $multi_item_product = Products::find($id);
//        $temp=$multi_item_product->product_data;
//        $temp[8]=$data['attr_id'][8];
//        $multi_item_product->product_data=$temp;
////        print_r($item); die;
//        if($multi_item_product->save()){
//          
//          return Redirect::route($product_type["type"].'.index')->with('message', "Multi-item product quantity updated");
//        }
//      }
//      else{
//             return redirect('auth/login')->with('message',"You must be login!"); 
//      }
//    }
    /*
     * site enable or disable
     */
    
    public function toggle($id){
      if(Auth::user()){
        $action = Request::route()->getAction();
        $product_type['type'] = $action['type'];
        switch ($product_type['type']) {
          case "multi_item":
              $product_type['title']="Multi-Item";
              break;
          case "cross_selling":
              $product_type['title']="Cross-Selling";
              break;
          case "up_selling":
              $product_type['title']="Up-Selling";
              break;
          case "bundle/combo":
              $product_type['title']="Bundle/Combo";
              break;
        } 
          $product = Products::find($id);
          if(empty($product->cat_ids) || empty($product->product_data[8])){
              return redirect()->back()->withErrors('You can not enable this product without adding product and product quantity.');
          }
          if($_GET['status'] === "enabled"){
              DB::collection('products')->where('_id', $id)->update(['status'=>$_GET['status'], 'disable_quantity'=>'Yes']);
          }
          else{
              DB::collection('products')->where('_id', $id)->update(['status'=>$_GET['status']]);
          }
          
          return Redirect::route($product_type["type"].'.index')->with('message', $product_type['title']." product has been ".$_GET['status']);
      }
      else{
             return redirect('auth/login')->with('message',"You must be login!"); 
      }
    }
    /*
     * List All Multi-Items
     */
    public function ListAll($id){
      if(Auth::user()){
        $action = Request::route()->getAction();
        $product_type['type']=$action['type'];
        switch ($product_type['type']) {
          case "multi_item":
              $product_type['title']="Multi-Item";
              break;
          case "cross_selling":
              $product_type['title']="Cross-Selling";
              break;
          case "up_selling":
              $product_type['title']="Up-Selling";
              break;
          case "bundle/combo":
              $product_type['title']="Bundle/Combo";
              break;
        } 
        $product= Products::find($id);
        $MultiItemProducts= Products::where('userid', Auth::user()->id)->where('product_type', '=', $product_type['type'])->paginate(25);

        return view('backend.catalog.products.multi_items.list_all', compact('MultiItemProducts', 'product_type','product', 'id'));
     }
    else{
           return redirect('auth/login')->with('message',"You must be login!"); 
      }
    }
    
    /*
     *Store Product to Multi-Item 
     */
    public function StoreItem(){
      if(Auth::user()){
            $action = Request::route()->getAction();
            $product_type['type'] = $action['type'];
            $data = Request::all();
            $product =  Products::where('_id', $data['product_id'])->first();
            $multi_products =  Products::find($data['multi_item_id']);
            DB::collection('products')->where('_id', $data['multi_item_id'])->push('cat_ids', $product->cat_ids);
            $temporary = $multi_products->multi_item_products;
            $temporary[] = $data['product_id'];
            $multi_products->multi_item_products = $temporary;
            if(!empty($multi_products->thumbs)){
                $temp = $multi_products->thumbs;
            }
            $temp[] = $product->thumb;
            $multi_products->thumbs = $temp;
            if($multi_products->save()){
              
            }
       }
        else{
             return redirect('auth/login')->with('message',"You must be login!"); 
        }
    }
    
    public function viewProductConfiguration(){
//        try {
//            if(Request::ajax()){
            
                $html = "";
                $data = Request::all();
                $productid = $data['productid'];
                
                $multi_product =  Products::where('_id', $productid)->first();
                $products =  Products::whereIn('_id', $multi_product->multi_item_products)->get();
                
                
                $html.= '<div class="row">';
                if($products->count()){
                    foreach( $products as $product ){
                        $html.= '<div class="col-md-12 ">';
                          $html.= '<div class="col-md-4">';
                                $html.= "<a target='_blank' href=".route('products/show', $product->id)." class='prod_thumb'>";
                                  if (!empty($product->thumb)){
                                        $html.= "<img src=".asset($product->thumb_path.$product->thumb)." alt='Product' width='100px' height='100px'/>";
                                  }
                                  else {
                                        $html.= "<img src=".asset('images/product_img.png')."alt='Product' width='100px' height='100px' />";
                                  }
                                $html.='</a>
                            </div>
                            <div class="col-md-4">';
                                if(!empty($product->desc)){
                                  $html.='<h6>'.$product->desc.'</h6>';
                                }
                            $html.='</div>
                            <div class="col-md-4">';
                                if(!empty($product->postdate)){
                                     $html.='<p>Post Date:'.$product->postdate.'</p>';
                                }
                            $html.='</div>
                        </div>';
                    }
                }
                else {
                    $html.= '<div class="col-md-12 ">There are No Products</div>';
                }
                $html.='</div>';
                return $html;
//            }
//        } 
//        catch (Exception $e) {
//            return Response::json ( array (
//                  'error' => true,
//                  'data' => $e
//              ), 200 );
//        }
    }
}
