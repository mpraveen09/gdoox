<?php

namespace Gdoox\Http\Controllers\backend\catalog\products;


//use Illuminate\Http\Request;

use DB;
use Gdoox\Models\Products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Gdoox\Models\Attributes;
use Gdoox\Models\AttributesType;
use Gdoox\Models\AttributesAssoc;
use Gdoox\Models\DropdownOptions;
use Gdoox\Models\Categories;
use Gdoox\Models\CategoryAttribute;
use Gdoox\Models\EcomShops;
use Gdoox\Models\ProductHiddenAttributes;
use Gdoox\Http\Controllers\Controller;
use Form;
use Illuminate\Support\Facades\Route;
use Gdoox\Models\NavigationMenu;

class NetworkProductsController extends Controller {
  use \Gdoox\Helpers\backend\dashboard\ImageUpload;
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
          
          return view('backend.catalog.products.multi_items.index', compact('MultiItemProducts', 'field', 'product_type', 'term', 'sites'));
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
          $sites =  EcomShops::where('user_id', Auth::user()->id)->get();
          $site = array();
          foreach($sites as $esite){
                $site[$esite->slug] = $esite->ecomm_company_name;
          }
          
          return view('backend.catalog.products.multi_items.create', compact('field', 'site', 'product_type'));
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
    public function storeMultiItem()
    {
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
          
          $data=Request::all();
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
          return view('backend.catalog.products.multi_items.add_product', compact('products', 'id', 'multi_product', 'product_type', 'term'));
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
 
    
    public function editNetworkProduct($id){
      if(Auth::user()){
        try {
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('parent', '36')->where('group','business_ecosystem')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();
                $userid = Auth::user()->id;
                $flag = 'network_product';
                $product = Products::find($id);
                $purpose = $product->purpose;
                
                if(!empty($product)){
                        $prod_cats = $product->cat_ids;
                        //Fetch Ancestors of aall the selected categories
                        $catAnsForAttr = $this->fetchAncestorsForAll($prod_cats );
                        //Fetch Attr association/classifiction
                        $attrAssoc = $this->fetchAttributesAssoc();
                        
                        //Fetch Attributes 
                        $multItemAttr = ProductHiddenAttributes::where('type','multiitem')->first();
                        $attrForCats = $multItemAttr->attr_ids;
                        sort($attrForCats);

                        $prod_cats_name = array();
                        if(!empty($prod_cats)){
                            foreach ($prod_cats as $prod_cat){
                                $prod_cats_name[] = $this->fetchCatAncestors($prod_cat);
                            }
                        }
                        
                        // Create Add Product form fields
                        $productForm = $this->createProductForm($prod_cats, $prod_cats_name, $attrAssoc, $attrForCats, $userid, $product,"",$purpose);
                        
                        return view('backend.catalog.products.network_items.network_item_product', compact('nav_menu','route','productForm','id','flag','purpose'));
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
    
    
    function createProductForm($prod_cats, $prod_cats_name, $attrAssoc, $attrForCats, $userid, $product='', $productaction='', $purpose){    
        $formFields = array();
        // Do not show these attributes if the Purpose is to Buy the Products.
        $attr_not_to_show = array(14, 44, 45, 46, 47, 48, 49);
        $type = '';
//        if($prod_cats_name){
//              $formFields[] = '<div class="card">';
//              $formFields[] = '<div class="card-header bgm-green"><h2>You have selected the following categories</h2></div>';
//              $formFields[] = '<div style="padding: 26px 178px" class="card-body card-padding">';
//              foreach($prod_cats_name as $prod_cats_name_){
//                  $formFields[]='<h6><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> &nbsp;&nbsp; '.$prod_cats_name_.'</h6>';
//              }
//              $formFields[] = '</div></div>';
//        }
        
        foreach($prod_cats as $prod_cat) {
            $formFields[]= $this->createProductFormFields("cat_id[]", "", "", "hidden", "", "", "","", $prod_cat);
        }

        $formFields[] = $this->createProductFormFields("userid", "", "", "hidden", "", "", "","", $userid);
      
        // Attributes to hide these in the Product Edit Form.
        $hideattribute = ProductHiddenAttributes::where('type','=','editproduct')->first();
        if(!empty($hideattribute)){
            foreach($hideattribute->attr_ids as $key=>$val){
                $attributeids[] = $key;
            }
        }
        
        // Dont show Logistics and Packaging sections if the Product is Buy or Procurement.
        if($purpose==='buy'){
            unset($attrAssoc['LO']);
            unset($attrAssoc['PK']);
        }
        // Looping through the Attribute Associations
        foreach ($attrAssoc as $k=>$v) {
          $formFieldsTemp = array();
          foreach($attrForCats as $attrForCatk => $attrForCat){
                $attributes = Attributes::where('attr_id', strval($attrForCat) )->where('class', '=', $k)->where('lang','=',$this->language)->first();
                if(count($attributes)){
                    $attr_id = $attributes->attr_id;
                    if(strpos($attr_id,';')!== false || strpos($attr_id,'/')!== false) {
                        $disabled = "disabled";
                    } else {
                      $disabled = "";
                    }
                    
                    
                    if(isset($product->type)){
                        $type = $product->type;
                    }
                    elseif(isset ($product->disable_edit)) {
                        $type = $product->disable_edit;
                    }

//                    if(($productaction==='edit-product-variation') || $type==='temporary'){
//                        if($attr_id === '2' || $attr_id === 2){
//                              $siteslug = $this->getSites($userid);
//                              $formFieldsTemp[]= $this->createProductFormFields("attr_id[$attr_id]", $attributes->label, $attributes->desc, "TD", $attributes->len, "attr_".$attributes->class, $attributes->req,$siteslug, "",$disabled,'',$product,$attr_id);
//                        }
//                        else {
//                            $opt = array();
//                            if($attributes->field_type === "TD" || $attributes->field_type === "TM" ){
//                                // echo $attributes->dropdown_list ;
//                                $dropopt = DropdownOptions::where('_id', $attributes->dropdown_list )->where('lang', '=', 'en')->first();
//                                if(count($dropopt )){
//                                    foreach ($dropopt->options as $dropopt_) {
//                                        $opt[$dropopt_] = $dropopt_;
//                                    }
//                                }
//                            }
//                            //field type and length
//                            $a_type = AttributesType::where('lang', '=', 'en')->Where('id', '=', $attributes->field_type)->project(array('label'))->first();
//                            $fieldinfo = "<br/><small><i>";
//                            $fieldinfo .= $a_type->label;
//                            if(!empty($attributes->len)){
//                                $fieldinfo .= " (Length ". $attributes->len . ")";
//                            }
//                            $fieldinfo .= "</i></small>";
//                            $formFieldsTemp[] = $this->createProductFormFields("attr_id[$attr_id]", $attributes->label, $attributes->desc, $attributes->field_type, $attributes->len, "attr_".$attributes->class, $attributes->req,$opt, "",$disabled, $fieldinfo, $product,$attr_id);
//                        }
//                   }  

                    if($type=='temporary' && $type!=''){
                        if(in_array($attr_id, $attributeids)){ }
                        elseif($attr_id === '2' || $attr_id === 2){
                              $siteslug = $this->getSites($userid);
                              $formFieldsTemp[]= $this->createProductFormFields("attr_id[$attr_id]", $attributes->label, $attributes->desc, "TD", $attributes->len, "attr_".$attributes->class, $attributes->req,$siteslug, "",$disabled,'',$product,$attr_id);
                        }
                        else {
                                    $opt = array();
                                    if($attributes->field_type === "TD" || $attributes->field_type === "TM" ){
                                        // echo $attributes->dropdown_list ;
                                        $dropopt = DropdownOptions::where('attr_id', $attributes->attr_id)->where('lang', '=', $this->language)->first();
                                        if(count($dropopt )){
                                            foreach ($dropopt->options as $dropopt_) {
                                                $opt[$dropopt_] = $dropopt_;
                                            }
                                        }
                                    }
                                  //field type and length
                                  $a_type = AttributesType::where('lang','=',$this->language)->Where('id', '=', $attributes->field_type)->project(array('label'))->first();
                                  $fieldinfo = "<br/><small><i>";
                                  $fieldinfo .= $a_type->label;
                                  if(!empty($attributes->len)){
                                    $fieldinfo .= " (Length ". $attributes->len . ")";
                                  }
                                  $fieldinfo .= "</i></small>";
                                  
                                    if($purpose==='sell'){
                                        if($attr_id != '606' || $attr_id != 606){
                                                $formFieldsTemp[]= $this->createProductFormFields("attr_id[$attr_id]", $attributes->label, $attributes->desc, $attributes->field_type, $attributes->len, "attr_".$attributes->class, $attributes->req,$opt, "",$disabled, $fieldinfo, $product,$attr_id);
                                        }
                                    }
                                    else {
                                        // Check the Attribute Id in the arra, if exists do nothing.
                                        if(!in_array($attr_id, $attr_not_to_show)){
                                                $formFieldsTemp[]= $this->createProductFormFields("attr_id[$attr_id]", $attributes->label, $attributes->desc, $attributes->field_type, $attributes->len, "attr_".$attributes->class, $attributes->req,$opt, "",$disabled, $fieldinfo, $product,$attr_id);
                                        }
                                    } 
                            }
                    }
                    else {
                            if($attr_id === '2' || $attr_id === 2){
                                $siteslug = $this->getSites($userid);
                                $formFieldsTemp[]= $this->createProductFormFields("attr_id[$attr_id]", $attributes->label, $attributes->desc, "TD", $attributes->len, "attr_".$attributes->class, $attributes->req,$siteslug, "",$disabled,'',$product,$attr_id);
                            }
                            else {
                                    $opt = array();
                                    if($attributes->field_type === "TD" || $attributes->field_type === "TM" ){
                                        // echo $attributes->dropdown_list ;
                                        $dropopt = DropdownOptions::where('attr_id',$attributes->attr_id)->where('lang','=',$this->language)->first();
                                        if(count($dropopt )){
                                            foreach ($dropopt->options as $dropopt_) {
                                                $opt[$dropopt_] = $dropopt_;
                                            }
                                        }
                                    }
                                    //field type and length
                                    $a_type = AttributesType::where('lang','=', $this->language)->Where('id', '=', $attributes->field_type)->project(array('label'))->first();
                                    $fieldinfo = "<br/><small><i>";
                                    $fieldinfo .= $a_type->label;
                                    if(!empty($attributes->len)){
                                          $fieldinfo .= " (Length ". $attributes->len . ")";
                                    }
                                    $fieldinfo .= "</i></small>";
                                    
                                    if($purpose ==='sell'){
                                        if($attr_id != '606' || $attr_id != 606){
                                           $formFieldsTemp[] = $this->createProductFormFields("attr_id[$attr_id]", $attributes->label, $attributes->desc, $attributes->field_type, $attributes->len, "attr_".$attributes->class, $attributes->req,$opt, "",$disabled, $fieldinfo, $product,$attr_id);
                                        }
                                        else { }
                                    }
                                    else {
                                        // Check the Attribute Id in the arra, if exists do nothing.
                                        if(!in_array($attr_id, $attr_not_to_show)){
                                                $formFieldsTemp[]= $this->createProductFormFields("attr_id[$attr_id]", $attributes->label, $attributes->desc, $attributes->field_type, $attributes->len, "attr_".$attributes->class, $attributes->req,$opt, "",$disabled, $fieldinfo, $product,$attr_id);
                                        }
                                        else { }
                                    }   
                            }
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
      
      
            $formFields[]= "<div class='card'>
                <div class='card-header bgm-bluegray'><h2>SEO Details</h2></div>  
                    <div class='form-group clearfix'>
                        <label for='seo_title' class='control-label col-md-3 col-sm-3 col-xs-12'>SEO Title</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>";
                        if(isset($product->seo_title)){
                            $formFields[]= "<input type='text' id='seo_title' value='".$product->seo_title."' name='seo_title' class='form-control' placeholder='SEO Title'>";    
                        }
                        else {
                            $formFields[]= "<input type='text' id='seo_title' name='seo_title' class='form-control' placeholder='SEO Title'>";    
                        }
                            
                $formFields[]= "</div>
                    </div>

                    <div class='form-group clearfix'>
                        <label for='seo_description' class='control-label col-md-3 col-sm-3 col-xs-12'>SEO Description</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>";
                        if(isset($product->seo_description)){
                            $formFields[]= "<input type='text' id='seo_description' value='".$product->seo_description."' name='seo_description' class='form-control' placeholder='SEO Description'>";    
                        }
                        else {
                            $formFields[]= "<input type='text' id='seo_description' value='' name='seo_description' class='form-control' placeholder='SEO Description'>";    
                        }    
                        $formFields[]= "</div>
                    </div>

                    <div class='form-group clearfix'>
                        <label for='seo_keywords' class='control-label col-md-3 col-sm-3 col-xs-12'>SEO Keywords</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>";
                        if(isset($product->seo_description)){
                            $formFields[]= "<input type='text' id='seo_keywords' value='".$product->seo_keywords."' name='seo_keywords' class='form-control' placeholder='SEO Keywords'>";    
                        }
                        else {
                            $formFields[]= "<input type='text' id='seo_keywords' value='' name='seo_keywords' class='form-control' placeholder='SEO Keywords'>";    
                        }    
                        $formFields[]= "</div>
                    </div>
                <br />
           </div>";
                        
        if($purpose!=='buy'){
            $formFields[] = '<div class="card">
            <div class="card-header bgm-bluegray"><h2>Product Images</h2></div>';
            
            if (isset($product->product_images)) {
                $formFields[] = '<div class="card-body card-padding-sm">';                  
                    $formFields[] = '<div class="row">';
                    if(is_array($product->product_images)){
                        foreach($product->product_images as $key=>$val){
                        $formFields[] = '<div class="col-md-3 col-sm-6 col-xs-6">
                                <img width="200" height="200" src="'.asset($val).'" alt="">
                                <button type="button" class="delete_image btn btn-primary btn-xs waves-effect" data_product_id="'.$product->_id.'" data_img-name="'.$val.'">Delete This Image</button>
                            </div>';
                        }
                    }    
                    $formFields[] = '</div>';
                    $formFields[] = '</div><hr>';
                }

                $formFields[] = '<div class="item form-group">
                    <div class="prod_images">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" data-toggle="tooltip" data-placement="bottom">Image</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                                <div>
                                    <span class="btn btn-info btn-file waves-effect">
                                        <span class="fileinput-new">Select image</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input name="product_images[]" type="file" id="product_images">
                                    </span>
                                    <a href="#" class="btn btn-danger fileinput-exists waves-effect" data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                            <br>
                            <small><i>Image (uploaded from PC)</i></small>
                        </div>
                    </div>

                    <div id="images_div"></div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label class="control-label col-md-6 col-sm-6 col-xs-12" data-toggle="tooltip" data-placement="bottom"></label>
                        <div class="control-label col-md-3 col-sm-3 col-xs-12">
                            <button type="button" class="btn btn-round btn-primary add_images">Add More Images</button>
                        </div>
                    </div>
                </div>
                <br />
            </div>';
        }               
 
        if(!empty($product)){
            $formFields[] = '<input type="hidden" name="purpose" id="purpose" value="'.$product->purpose.'"/>';
        }
        return $formFields;
    }
    
    function createProductFormFields($attr_id, $label="", $desc="", $field_type="", $len="", $class="", $req="",$opt, $val="",$disabled="", $fieldinfo ="", $product="", $curr_attr=""){
      
      if(!empty($product) && !empty($product->product_data[$curr_attr])){
//        echo "--------------------------------<br/>";
          if($curr_attr==='14' || $curr_attr==='574') {
                $defaultValue = "";
          }
          else {
                $value = $product->product_data[$curr_attr];
                $defaultValue = str_replace('â€“', '-', $value);
          }
      }
      else {
         $defaultValue = "";
      }
      
        //$this->createProductFormFields($attr_id, $label, $desc, $field_type, $len, $class, $req);
        if($req==="M" || $req==="required"){ $req="required";}else{ $req=""; }
        switch ($field_type) {
            case "TD":
                //if($label !==""){
                $field = "<div class='item form-group ".$class."'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::select($attr_id, $opt, $defaultValue, ['class' => 'form-control col-md-7 col-xs-12', 
                                'placeholder' => '---', $req, $disabled])
                            . $fieldinfo
                        . "</div>
                    </div>";                    
                break;
            case "TM":
                //if($label !==""){
                if(count($opt) > 20){
                  $hgt = 250;
                }else{
                  $hgt = 150;
                }
              
                $field = "<div class='item form-group ".$class."'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::select($attr_id.'[]', $opt, $defaultValue, ['class' => 'form-control col-md-7 col-xs-12', 
                                'placeholder' => '---', $req, $disabled, 'multiple', 'style'=>'height: '.$hgt.'px;'])
                            . $fieldinfo
                        . "</div>
                    </div>";                    
                break;    
            case "TA":
                //if($label !==""){
                $field = "<div class='item form-group ".$class."'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::textarea($attr_id, $defaultValue, ['class' => 'form-control col-md-7 col-xs-12', 
                                'placeholder' => $label, $req, $disabled, 'maxlength'=> $len])
                            . $fieldinfo                    
                        . "</div>
                    </div>";                    
                break;      
            case "T":
                //if($label !==""){
                $field = "<div class='item form-group ".$class."'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::text($attr_id, $defaultValue, ['class' => 'form-control col-md-7 col-xs-12', 
                                'placeholder' => $label, $req, $disabled, 'maxlength'=> $len])
                            . $fieldinfo                    
                        . "</div>
                    </div>";                    
                break;      
            case "Y":// Year
            case "N":
                //if($label !==""){
                $field = "<div class='item form-group ".$class."'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::number($attr_id, $defaultValue, ['class' => 'form-control col-md-7 col-xs-12', 
                                'placeholder' => $label, $req, $disabled, 'maxlength'=> $len])
                            . $fieldinfo                    
                        . "</div>
                    </div>";                    
                break; 
            case "D":
                //if($label !==""){
                $field = "<div class='item form-group ".$class."'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::date($attr_id, $defaultValue, ['class' => 'form-control col-md-7 col-xs-12', 
                                 $req, $disabled, "min"=> date("Y-m-d"), 'maxlength'=> $len])
                            . $fieldinfo                    
                        . "</div>
                    </div>";                    
                break; 
            case "H":
                //if($label !==""){
                $field = "<div class='item form-group ".$class."'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::time($attr_id, $defaultValue, ['class' => 'form-control col-md-7 col-xs-12', 
                                 $req, $disabled, 'maxlength'=> $len])
                            . $fieldinfo                    
                        . "</div>
                    </div>";                    
                break;             
            case "I":
                //if($label !==""){
                $field = "<div class='item form-group ".$class."'>"
                            . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12','data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                            ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                                ."<div class='fileinput fileinput-new' data-provides='fileinput'>
                                    <div class='fileinput-preview thumbnail' data-trigger='fileinput'></div>
                                <div>
                                <span class='btn btn-info btn-file'>
                                    <span class='fileinput-new'>Select image</span>
                                    <span class='fileinput-exists'>Change</span>"
                                        . Form::file($attr_id, '', ['class' => 'form-control col-md-7 col-xs-12 upload-image','accept'=>'image/*',  $req, $disabled, 'maxlength'=> $len])
                                    ."</span>
                                <a href='#' class='btn btn-danger fileinput-exists' data-dismiss='fileinput'>Remove</a>
                            </div>
                        </div>"
                    . $fieldinfo                  
                . "</div>
              </div>";                  
                
               
                
//                $field = "<div class='item form-group ".$class."'>"
//                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
//                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
//                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
//                            . Form::file($attr_id, '', ['class' => 'form-control col-md-7 col-xs-12 upload-image', 
//                               'accept'=>'image/*',  $req, $disabled, 'maxlength'=> $len])
//                            . $fieldinfo                    
//                        . "</div>
//                    </div>";                    
                break;     
            case "F":
                //if($label !==""){
                $field = "<div class='item form-group ".$class."'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::file($attr_id, '', ['class' => 'form-control col-md-7 col-xs-12 upload-file', 
                                 'accept'=>'file_extension', $req, $disabled, 'maxlength'=> $len])
                            . $fieldinfo                    
                        . "</div>
                    </div>";                    
                break;    
            case "U":
            case "UA":
            case "UE":
            case "UI":                
                //if($label !==""){
                $field = "<div class='item form-group ".$class."'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::url($attr_id, $defaultValue, ['class' => 'form-control col-md-7 col-xs-12', 
                                'placeholder' => $label, $req, $disabled, 'maxlength'=> $len])
                            . $fieldinfo                    
                        . "</div>
                    </div>";                    
                break;            
            case "hidden":
                //$field=$this->createFieldHidden($attr_id, $field_type);
                $field = Form::hidden($attr_id, $val, $attributes = array());
                //Form::number('len', $attributes->len, ['class' => 'form-control col-md-7 col-xs-12', 'required'])
                break;
            case "CL":
                $field = "<div class='item form-group ".$class."'>"
                    . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                        'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                    ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                . "<div class='cp-container'><div class='input-group form-group'>
                    <!--span class='input-group-addon'><i class='zmdi zmdi-invert-colors'></i></span-->
                    <div class='fg-line dropdown'>"
                      . Form::text($attr_id, '#03A9F4', ['class' => 'form-control cp-value', 'data-toggle'=>'dropdown', $req, $disabled])
                                                
                       . "<div class='dropdown-menu'>
                        <div class='color-picker' data-cp-default='#03A9F4'></div>
                      </div>

                      <i class='cp-value'></i>
                    </div>"
                    .$fieldinfo.
                    "</div>
                  </div>"
                    . "</div>
                </div>";               
                break;  
            default:
                $field="";
        }     
        return $field;
        //Form::number('len', $attributes->len, ['class' => 'form-control col-md-7 col-xs-12', 'required'])
        //$this->createFieldHidden($attr_id, $label, $desc, $field_type, $len, $class, $req);
        
        
    }

    function fetchAttributesIds($catAnsForAttr){
      try{
        $attrArr =array();
        foreach ($catAnsForAttr as $cat) {
            $attrTmp = CategoryAttribute::Where('cat_id', '=', $cat)->project( array('attr_ids') )->first();//->take(1)->get();
            if(count($attrTmp)){
                foreach($attrTmp->attr_ids as $attr){
                    $attrArr[$attr]=$attr;
                }
            }
        }
        return $attrArr;      
      }
      catch (\Exception $e){
          $error = "An error occured. ".
                "Line Number: ".$e->getLine()." ".
                "File Name: ".$e->getFile()." ".
                "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
      }
  }
    
    function fetchAttributesAssoc(){
      try {
            $attrAssoc = array();
            $attrAssocTmp = AttributesAssoc::where('lang', '=', $this->language)->project( array('id','label') )->get();
            foreach($attrAssocTmp as $v){
                $attrAssoc[$v->id] = $v->label;
            }
            return $attrAssoc;
      }
      catch (\Exception $e){
          $error = "An error occured. ".
            "Line Number: ".$e->getLine()." ".
            "File Name: ".$e->getFile()." ".
            "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
      }
  }
    
    function fetchAncestorsForAll($prod_cats){
      try{
        $catAnsForAttr = array();
        foreach ($prod_cats as $cat) {
            $catAnsForAttrTemp = $this->fetchCategoryAnscestors($cat);
            foreach ($catAnsForAttrTemp as $k => $v) {
                $catAnsForAttr[$k] = $v;
            }
        }
        return $catAnsForAttr;
      }
      catch (\Exception $e){
          $error = "An error occured. ".
                "Line Number: ".$e->getLine()." ".
                "File Name: ".$e->getFile()." ".
                "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
      }
    }
    
    function fetchCategoryAnscestors($currentid){
      try{
        $parent = 0;
        $cat_hierachy=array();
        do {
            $sql = Categories::where('lang','=',$this->language)->Where('cat_id', '=', $currentid)->project( array('cat_id','parent') )->first();//->take(1)->get();
            if(count($sql)){
                //array_push($cat_hierachy, $sql->cat_id); 
                $cat_hierachy[$sql->cat_id] = $sql->cat_id;
                if(!empty($sql->parent)){
                    $currentid = $sql->parent;
                    $parent = 1;
                } else {
                    $parent = 0;
                }
            }else{
                $parent = 0;
            }
        }while($parent <> 0);        
        
        return $cat_hierachy;
      }
      catch (\Exception $e){
          $error = "An error occured. ".
                "Line Number: ".$e->getLine()." ".
                "File Name: ".$e->getFile()." ".
                "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
      }
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function editNetworkProduct($id){
//      if(Auth::user()){
//        try {
//                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('parent', '7')->where('lang','en')->get();
//                $route = Route::getCurrentRoute()->getName();
//                
//                $product = Products::find($id);
//                $attrAssoc = $this->fetchAttributesAssoc();
//                
//                 //Fetch Attributes 
//                $multItemAttr = ProductHiddenAttributes::where('type','multiitem')->first();
//                $attrForCats = $multItemAttr->attr_ids;
//                sort($attrForCats);
//        
//                $formFields = array();
//                $formFields[] = $this->createProductFormFields("userid", "", "", "hidden", "", "", "","", Auth::user()->id);
//                foreach ($attrAssoc as $k=>$v) {
//                    $formFieldsTemp = array();
//
//                    foreach($attrForCats as $attrForCatk => $attrForCat){
//                      $attributes = Attribute::where('attr_id', strval($attrForCat) )->where('class', '=', $k)->where('lang', '=', 'en')->first();
//                      if(!empty($attributes)){
//                        $attr_id = $attributes->attr_id;
//                        if (strpos($attr_id,';') !== false || strpos($attr_id,'/') !== false) {
//                            $disabled = "disabled";
//                        }else {
//                          $disabled = "";
//                        }
//                        
//                        if($attr_id === '2' || $attr_id === 2){
//                          $sites = $this->getSites(Auth::user()->id);
//                          
//                          $siteslug= array();
//                          foreach ($sites as $key => $value) {
//                              $siteslug[$value]= $value;
//                          }
//                          
//                          $formFieldsTemp[] = $this->createProductFormFields("attr_id[$attr_id]", $attributes->label, $attributes->desc, "TD", $attributes->len, "attr_".$attributes->class, $attributes->req, $siteslug, "",$disabled,'',$product,$attr_id);
//                        }
//                        else {
//                                $opt = array();
//                                if($attributes->field_type === "TD" || $attributes->field_type === "TM" ){
//                                    $dropopt =  DropdownOptions::where('_id', $attributes->dropdown_list )->where('lang', '=', 'en')->first();
//                                    if(count($dropopt )){
//                                        foreach ($dropopt->options as $dropopt_) {
//                                            $opt[$dropopt_]=$dropopt_;
//                                        }
//                                    }
//                                }
//
//                                //field type and length
//                                $a_type= AttributesType::where('lang', '=', 'en')->Where('id', '=', $attributes->field_type)->project(array('label'))->first();
//                                $fieldinfo = "<br/><small><i>";
//                                $fieldinfo .= $a_type->label;
//                                if(!empty($attributes->len)){
//                                    $fieldinfo .= " (Length ". $attributes->len . ")";
//                                }
//                                $fieldinfo .= "</i></small>";
//
//                                $formFieldsTemp[]= $this->createProductFormFields("attr_id[$attr_id]", $attributes->label, $attributes->desc, $attributes->field_type, $attributes->len, "attr_".$attributes->class, $attributes->req, $opt, "", $disabled, $fieldinfo, $product, $attr_id);
//                            }                    
//                        }                
//                    }
//
//                    if(!empty($formFieldsTemp)){
//                       $formFields[] = '<div class="card">';
//                       $formFields[] = '<div class="card-header bgm-bluegray"><h2>'.$v.'</h2></div>';// "<hr/><h4>$v</h4><hr/>";
//                       $formFields[] = '<div class="card-body card-padding">';
//                       foreach ($formFieldsTemp as $formFieldsTempV) {
//                           $formFields[] = $formFieldsTempV;
//                       }
//                       //$formFields[] = $formFieldsTemp[];
//                       $formFields[] = '</div></div>';
//                     }
//                  } 
//                return view('backend.catalog.products.network_items.network_item_product', compact('nav_menu','route','formFields','id'));
//            }
//        catch (\Exception $e){
//            $error = "An error occured. ".
//                "Line Number: ".$e->getLine()." ".
//                "File Name: ".$e->getFile()." ".
//                "Error Description: ".$e->getMessage();
//            return view('errors.custom_error')->withErrors($error);
//        }
//      }
//      else{
//        return redirect('auth/login')->with('message',"You must be login!"); 
//      }   
//    }
    
    

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
    

    
    /*
     * Store Price
     */
    
    public function storeNetworkItemDetails($id){
      if(Auth::user()){
        try {
                $data = Request::all();
                $product = Products::find($id);
                $productid = $id;
                $product->userid = $data['userid'];
                $product->shopid = $data['attr_id'][2];
                $product->postdate = $data['attr_id'][1];
                $product->desc = $data['attr_id'][3];
                $product->seo_title = $data['seo_title'];
                $product->seo_description = $data['seo_description'];
                $product->seo_keywords = $data['seo_keywords'];
                $product->type = '';
                
                $path = Auth::user()->directory_path."/products/".date('m')."/".date('d')."/";
                
                $permission = 0775;
                $product_images = array();
                if(isset($product->product_images)) {
                    if(!empty($product->product_images)){
                        foreach($product->product_images as $key=>$val){
                            $product_images[] = $val;
                        }
                    }
                }
                
                foreach($data['product_images'] as $key => $val){
                    if(gettype($val) === "object"){
                        $image = $val->getClientOriginalName();
                        $extension = $val->getClientOriginalExtension();
                        $size = $val->getSize();
                        $mime = $val->getMimeType();
                        if(substr($mime, 0, 5) == 'image') {
                            $filename = "prod-" . $this->randomString() . "-". time().".".$extension;  
                            $target_dir = $this->make_directory($path, $permission, true);
                            // $val->move( $target_dir, $filename);
                            $val->move($path, $filename);
                            $product_images[] = $path.$filename;
                        }
                    }
                }
                
                // Get the Image Object and Other Values and insert them into the Array.
                foreach($data['attr_id'] as $attr_id => $attr_val){
                    if(gettype($attr_val) === "object"){
                        $image = $attr_val->getClientOriginalName();
                        $extension = $attr_val->getClientOriginalExtension();
                        $size = $attr_val->getSize();
                        $mime = $attr_val->getMimeType();
                        if(substr($mime, 0, 5) == 'image') {
                            if(!File::exists($path)) {
                                $target_dir = $this->make_directory($path, $permission, true);
                            }

                            $filename = "prod-" . $this->randomString() . "-". time().".".$extension;  
                         // $attr_val->move($target_dir, $filename);
                            $attr_val->move($path, $filename);
                            $product->thumb = $filename;
                            $product->thumb_path = $path;
                        }
                        $product_attr[$attr_id] = $path.$filename;
                    }
                    else {
                        $product_attr[$attr_id] = $attr_val;
                    }
                }
                
                // Insert the values into the array which are not present in Edit Form.
                foreach($product->product_data as $key=>$value){
                    if(!array_key_exists($key, $product_attr)){
                        $product_attr[$key] = $value;
                    }
                }
                
                $product->product_data = $product_attr;
                $product->product_images = $product_images;

                if($product->save()){
                    Session::flash('message', 'Product Details Updated Successfully');
                    return Redirect::route("comnetwork.product.index", ['site_slug'=>$data['attr_id'][2]]);
                }
                else {
                    return redirect()->back()->with('message','Product Details could not be Updated. Please try Again.');
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
      else {
             return redirect('auth/login')->with('message',"You must be login!"); 
      }
    }
    
    
    public function fetchCatAncestors($currentid){
      try{
        $parent=0;
        $cat_hierachy="";
        do{
            $sql = Categories::where('lang','=',$this->language)->Where('cat_id', '=', $currentid)->orderBy('name')->project( array('name','parent') )->first();//->take(1)->get();
            if(count($sql)){
                if($cat_hierachy === ""){
                    $cat_hierachy = $sql->name ;
                }else{
                    $cat_hierachy = $sql->name . " / " . $cat_hierachy;
                }
                if(!empty($sql->parent)){
                    $currentid = $sql->parent;
                    $parent = 1;
                }else{
                    $parent = 0;
                }
            }else{
                $parent = 0;
            }
        }while($parent <> 0);
        //return $cat_hierachy;
        return $cat_hierachy;
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
    
  
    /*
     * List All Multi-Items
     */
 
    
    /*
     *Store Product to Multi-Item 
     */
   
}
